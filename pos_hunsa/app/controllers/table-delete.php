<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$tableClass = new Table_info;
    if($_POST['number'])
    {
        $check = $tableClass->deletable_table($_POST['number']);
        if($check==1)
        {
            $tableClass->delete_table($_POST['number']);
            redirect('admin&tab=tables');
        }
        else if($check== -1)
        {
            $errors['number'] = 'There are some busy tables, cannot delete.';
        }
        else if($check== -2)
        {
            $errors['number'] = 'The deleted amount should less or equal to total tables.';
        }
        
    }

}

if(Auth::access('manager')){
	require views_path('tables/tables-delete');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
