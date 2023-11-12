<?php


/**
 * History class
 */
class History extends Model
{

    protected $table = "history";
    protected $allowed_columns = [

        'orders_id',
        'menu_id',
        'table_id',
        'staff_id',
        'menu_name',
        'qty',
        'menu_price',
        'time'	
    ];

}
