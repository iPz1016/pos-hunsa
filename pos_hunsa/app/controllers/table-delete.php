<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$tableClass = new Table_info;
    if($_POST['number'])
    {
        if($tableClass->deletable_table($_POST['number']))
        {
            $tableClass->delete_table($_POST['number']);
            redirect('admin&tab=tables');
        }
        else
        {
            $errors['number'] = 'There are some busy tables, cannot delete.';
        }
        
    }

}

if(Auth::access('admin')){
	require views_path('tables/tables-delete');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
