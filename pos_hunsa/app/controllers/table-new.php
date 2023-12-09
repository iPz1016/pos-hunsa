<?php

$errors = [];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tableClass = new Table_info;
    
    // Check if the 'number' field is set in the POST data
    if ($_POST['number']) {
        // Attempt to create a new table with the given number
        $check = $tableClass->new_table($_POST['number']);

        // If the new table is successfully created, redirect to the tables page
        if($check)
        {
            redirect('admin&tab=tables');
        }
        else
        {   
            // If creating a new table fails, set an error
            $errors['new_table'] = 'Total tables should not greater than 50 tables.';
        }
        
    }
}

// Check if the logged-in user has manager access
if (Auth::access('manager')) {
    require views_path('tables/tables-new');
} else {
    // Display an error message for users who don't have permission to delete tables
    Auth::setMessage("You dont have access to the admin page");
    require views_path('auth/denied');
}
