<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tableClass = new Table_info;
    if ($_POST['number']) {
        $check = $tableClass->new_table($_POST['number']);
        if($check)
        {
            redirect('admin&tab=tables');
        }
        else
        {
            $errors['new_table'] = 'Total tables should not greater than 50 tables.';
        }
        
    }
}

if (Auth::access('manager')) {
    require views_path('tables/tables-new');
} else {

    Auth::setMessage("You dont have access to the admin page");
    require views_path('auth/denied');
}
