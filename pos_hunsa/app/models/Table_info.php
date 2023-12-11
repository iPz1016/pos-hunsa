<?php


// Table_info class
class Table_info extends Model
{
    // Table name in the database (table_info)
    protected $table = "table_info";

    // Allowed columns for insertion and update
    protected $allowed_columns = [
        'table_id',
        'disable',
    ];

    // Add new tables to the database.
    // @param int $number The number of tables to add.
    // @return bool True if tables were added successfully, false otherwise.
    public function new_table($number)
    {   
        // Get all existing tables
        $all_table = $this->getAll(300, 0, 'asc', 'table_id');

        // Calculate the current table count
        if ($all_table) {
            $table_count = count($all_table);
        } else {
            $table_count = 0;
        }

        // Check if adding the specified number of tables exceeds the limit (50)
        if ($table_count + $number > 50)
            return false;

        // Add the new tables to the database
        for ($i = 0; $i < $number; $i++) {
            // Retrieve updated table count
            $all_table = $this->getAll(300, 0, 'asc', 'table_id');
            if ($all_table) {
                $table_count = count($all_table);
            } else {
                $table_count = 0;
            }

            // Set data for the new table
            $data['table_id'] = $table_count + 1;
            $data['disable'] = 0;
            
            // Insert the new table into the database
            $this->insert($data);
        }
        return true;
    }

    // Get the status of all tables, including associated orders.
    // @return array|null An array containing table information (table_id, orders_id, disable).
    public function get_table_status()
    {
        $sql = "SELECT DISTINCT t.table_id,o.orders_id,t.disable FROM table_info t 
        LEFT JOIN orders o 
        ON t.table_id = o.table_id  
        ORDER BY t.table_id ASC";
        $db = new Database;
        $table_info = $db->query($sql);

        return $table_info;
    }

    // Check if a specified number of tables can be deleted.
    // @param int $number The number of tables to check for deletability.
    // @return int Return codes:
    //      1 - deletable, -1 - has associated orders, 
    //      -2 - insufficient tables, -3 - error fetching table info.
    public function deletable_table($number)
    {
        $table_info = $this->get_table_status();
        
        // Check if fetching table info failed
        if(!$table_info)
        {
            return -3;
        }
        // Check deletability for the specified number of tables
        for ($i = count($table_info) - 1; $i >= count($table_info) - $number; $i--) {
            if ($i < 0) {
                return -2; // Insufficient tables
            }
            if ($table_info[$i]['orders_id']) {
                return -1; // Tables have associated orders
            }
        }
        return 1; // Deletable
    }

    // Delete a specified number of tables from the database.
    // @param int $number The number of tables to delete.
    // @return int Return codes from deletable_table method.
    public function delete_table($number)
    {
        $check = $this->deletable_table($number);
        if ($check == 1) {
            $table_info = $this->getAll(300, 0, 'asc', 'table_id');

            for ($i = count($table_info); $i > count($table_info) - $number; $i--) {
                $this->delete($i, 'table_id');
            }
        }
        // Return the result of deletable_table check
        return $check; 
    }
}
