<?php
// Orders class
class Orders extends Model
{   
    // Database orders table
    protected $table = "orders";
    
    // Allowed columns that can be accessed or modified
    protected $allowed_columns = [

        'orders_id',
        'menu_id',
        'table_id',
        'onhold_qty',
        'served_qty'
    ];

    // Validate input data for orders.
    // @param array $data The data to be validated.
    // @return array An array containing validation errors, if any.
    public function validate($data)
    {
        $errors = [];
        return $errors;
    }

    // Retrieve distinct orders for take-home.
    // @return array An array containing distinct order IDs for take-home orders.
    public function get_take_home_order()
    {
        $query = "SELECT DISTINCT o.orders_id
        FROM $this->table o 
        WHERE (o.table_id IS NULL)
        ORDER BY o.orders_id asc;";
        $db = new Database;
        return $db->query($query);
    }

    // Retrieve available tables with associated orders.
    // @return array An array containing available tables with associated orders.
    public function get_available_table()
    {
        $query = "SELECT t.table_id,t.disable,o.orders_id FROM table_info t
        LEFT JOIN 
        (
            SELECT DISTINCT  orders_id,table_id 
            FROM $this->table  
            WHERE table_id IS NOT NULL
        ) AS o
        ON t.table_id=o.table_id
        ORDER BY t.table_id asc;";
        $db = new Database;
        return $db->query($query);
    }

    // Update order details.
    // @param array $data The data to be updated.
    public function update_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "UPDATE $this->table
					SET orders_id = :orders_id, menu_id =:menu_id, table_id =:table_id, onhold_qty =:onhold_qty, served_qty =:served_qty 
					WHERE orders_id =:orders_id AND menu_id =:menu_id";
        $db = new Database;
        $db->query($query, $clean_array);
    }

    // Delete menu in specific order using order ID and menu ID.
    // @param array $data The data for the order to be deleted.
    public function delete_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "DELETE FROM $this->table
					WHERE orders_id=:orders_id AND menu_id=:menu_id";

        $db = new Database;
        $db->query($query, $clean_array);
    }

    // Delete all orders for a specific order ID.
    // @param array $data The data for the orders to be deleted.
    public function delete_all_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "DELETE FROM $this->table
					WHERE orders_id=:orders_id";

        $db = new Database;
        $db->query($query, $clean_array);
    }
}
