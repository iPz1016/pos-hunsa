<?php


/**
 * Table_info class
 */
class Table_info extends Model
{

    protected $table = "table_info";
    protected $allowed_columns = [
        'table_id',
        'disable',
    ];

    public function new_table($number)
    {
        $all_table = $this->getAll(300, 0, 'asc', 'table_id');

        if ($all_table) {
            $table_count = count($all_table);
        } else {
            $table_count = 0;
        }

        if ($table_count + $number > 50)
            return false;

        for ($i = 0; $i < $number; $i++) {
            $all_table = $this->getAll(300, 0, 'asc', 'table_id');

            if ($all_table) {
                $table_count = count($all_table);
            } else {
                $table_count = 0;
            }

            $data['table_id'] = $table_count + 1;
            $data['disable'] = 0;
            $this->insert($data);
        }
        return true;
    }

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

    public function deletable_table($number)
    {
        $table_info = $this->get_table_status();

        for ($i = count($table_info) - 1; $i >= count($table_info) - $number; $i--) {
            if ($i < 0) {
                return -2;
            }
            if ($table_info[$i]['orders_id']) {
                return -1;
            }
        }
        return 1;
    }

    public function delete_table($number)
    {
        $check = $this->deletable_table($number);
        if ($check == 1) {
            $table_info = $this->getAll(300, 0, 'asc', 'table_id');

            for ($i = count($table_info); $i > count($table_info) - $number; $i--) {
                $this->delete($i, 'table_id');
            }
        }
        return $check;
    }
}
