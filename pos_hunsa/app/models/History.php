<?php

// History class
class History extends Model
{
    // Database table name
    protected $table = "history";

    // Allowed columns for insertion and updating
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

    // Validates the data before insertion or updating.
    // @param array $data Data to be validated
    // @param int|null $id ID for updating (optional)
    // @return array Array of validation errors (empty if no errors)
    public function validate($data, $id = null)
    {
        $errors = [];

        // Check Menu name and validate input from users.
        // Display error massage if input text is not valid.
        if (empty($data['menu_name'])) {
            $errors['menu_name'] = "Menu Name is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_name'])) {
            $errors['menu_name'] = "Only letters are allowed in the Menu Name.";
        }

        // Check Quantity and validate input from users.
        // Display an error message if users do not input a number.
        if (empty($data['qty'])) {
            $errors['qty'] = "Menu Quantity is required";
        } else
			if (!preg_match('/^[0-9]+$/', $data['qty'])) {
            $errors['qty'] = "Quantity must be a number";
        }

        // Check Amount and validate input from users.
        // Display an error message if users do not input a number.
        if (empty($data['menu_price'])) {
            $errors['menu_price'] = "Menu Price is required";
        } else
			if (!preg_match('/^[0-9.]+$/', $data['menu_price'])) {
            $errors['menu_price'] = "Amount must be a number";
        }
        return $errors;
    }
}
