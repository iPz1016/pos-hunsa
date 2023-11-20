<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tableClass = new Table_info;
    if ($_POST['number']) {
        $tableClass->new_table($_POST['number']);
        redirect('admin&tab=tables');
    }
}

if (Auth::access('admin')) {
    require views_path('tables/tables-new');
} else {

    Auth::setMessage("You dont have access to the admin page");
    require views_path('auth/denied');
}
