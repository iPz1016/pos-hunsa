<?php


/**
 * History class
 */
class History extends Model
{

    protected $table = "history";
    protected $allowed_columns = [
        'id',
        'orders_id',
        'menu_id',
        'table_id',
        'staff_id',
        'menu_name',
        'qty',
        'menu_price',
        'time'
    ];
    public function validate($data, $id = null)
    {
        $errors = [];

        //check description
        if (empty($data['menu_name'])) {
            $errors['menu_name'] = "Menu name is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_name'])) {
            $errors['menu_name'] = "Only letters allowed in menu name";
        }

        //check qty
        if (empty($data['qty'])) {
            $errors['qty'] = "Menu quantity is required";
        } else
			if (!preg_match('/^[0-9]+$/', $data['qty'])) {
            $errors['qty'] = "quantity must be a number";
        }

        //check amount
        if (empty($data['menu_price'])) {
            $errors['menu_price'] = "Menu price is required";
        } else
			if (!preg_match('/^[0-9.]+$/', $data['menu_price'])) {
            $errors['menu_price'] = "amount must be a number";
        }


        return $errors;
    }
}
