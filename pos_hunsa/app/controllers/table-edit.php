<?php

$errors = [];

$tableClass = new Table_info;
$id = $_GET['id'];

$row = $tableClass->first(['table_id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['disable'] == 1) {
        $orderClass = new Orders;
        $table_info = $orderClass->first(['table_id' => $id]);
        if (!$table_info) {
            $data['table_id'] = $id;
            $data['disable'] = 1;
            $tableClass->update($id, $data, 'table_id');
            redirect('admin&tab=tables');
        } else {
            $errors['disable'] = 'This table is busy, cannot disable.';
        }
    } else
    if ($_POST['disable'] == 0) {

        $data['table_id'] = $id;
        $data['disable'] = 0;
        $tableClass->update($id, $data, 'table_id');
        redirect('admin&tab=tables');
    }
}

if (Auth::access('manager')) {
    require views_path('tables/tables-edit');
} else {

    Auth::setMessage("You dont have access to the admin page");
    require views_path('auth/denied');
}
