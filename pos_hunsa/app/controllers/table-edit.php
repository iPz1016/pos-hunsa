<?php

$errors = [];

$tableClass = new Table_info;
// Get the table ID from the GET parameters
$id = $_GET['id'];

// Get the table information for the specified ID
$row = $tableClass->first(['table_id' => $id]);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if the 'disable' field is set in the POST data
    if ($_POST['disable'] == 1) {
        $orderClass = new Orders;
        $table_info = $orderClass->first(['table_id' => $id]);
        
        // If the table is not busy, update and redirect
        if (!$table_info) {
            $data['table_id'] = $id;
            $data['disable'] = 1;
            $tableClass->update($id, $data, 'table_id');
            redirect('admin&tab=tables');
        } else {
            
            // If disable is set to 1 and the table is busy, set an error
            $errors['disable'] = 'This table is busy, cannot disable.';
        }
    } else
        // If disable is set to 0, update and redirect
        if ($_POST['disable'] == 0) {

            $data['table_id'] = $id;
            $data['disable'] = 0;
            $tableClass->update($id, $data, 'table_id');
            redirect('admin&tab=tables');
        }
}

// Check if the logged-in user has manager access
if (Auth::access('manager')) {
    require views_path('tables/tables-edit');
} else {
    // Display an error message for users who don't have permission to delete tables
    Auth::setMessage("You dont have access to the admin page");
    require views_path('auth/denied');
}
