<?php


/**
 * orders class
 */
class Orders extends Model
{

    protected $table = "orders";
    protected $allowed_columns = [

        'orders_id',
        'menu_id',
        'table_id',
        'onhold_qty',
        'served_qty'
    ];


    public function validate($data)
    {
        $errors = [];

        return $errors;
    }
    public function get_take_home_order()
    {
        $query = "SELECT DISTINCT o.orders_id
        FROM $this->table o 
        WHERE (o.table_id IS NULL)
        ORDER BY o.orders_id asc;";
        $db = new Database;
        return $db->query($query);
    }

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

    public function update_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "UPDATE $this->table
					SET orders_id = :orders_id, menu_id =:menu_id, table_id =:table_id, onhold_qty =:onhold_qty, served_qty =:served_qty 
					WHERE orders_id =:orders_id AND menu_id =:menu_id";
        $db = new Database;
        $db->query($query, $clean_array);
    }

    public function delete_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "DELETE FROM $this->table
					WHERE orders_id=:orders_id AND menu_id=:menu_id";

        $db = new Database;
        $db->query($query, $clean_array);
    }

    public function delete_all_order($data)
    {
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $query = "DELETE FROM $this->table
					WHERE orders_id=:orders_id";

        $db = new Database;
        $db->query($query, $clean_array);
    }
}
