<?php


/**
 * orders class
 */
class Table_info extends Model
{

    protected $table = "table_info";
    protected $allowed_columns = [
        'table_id',
        'disable',
    ];
    public function deletable_table($number)
    {
        $sql = "SELECT DISTINCT t.table_id,o.orders_id FROM table_info t 
        LEFT JOIN orders o 
        ON t.table_id = o.table_id  
        ORDER BY t.table_id ASC";
        $db = new Database;
        $table_info = $db->query($sql);

        for($i = count($table_info)-1 ; $i >= count($table_info)-$number ; $i--)
        {
            if($i<0 || $table_info[$i]['orders_id'])
            {
                return false;
            }
        }
        return true;
    }

    public function delete_table($number)  
    {
        if($this->deletable_table($number))
        {
            $table_info = $this->getAll(300,0,'asc','table_id');

            for($i = count($table_info) ; $i > count($table_info)-$number ; $i--)
            {
                $this->delete($i,'table_id');
            }
            return true;
        }
        else
        {
            return false;
        }
    }

}
