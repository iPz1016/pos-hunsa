<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$tableClass = new Table_info;
    if($_POST['number'])
    {
        for($i=0;$i<$_POST['number'];$i++)
        {
            $all_table = $tableClass->getAll(300,0,'asc','table_id');
            $table_count = count($all_table);
            $data['table_id'] = $table_count+1;
            $data['disable'] = 0;
            $tableClass->insert($data);
        }
        redirect('admin&tab=tables');
    }

}

if(Auth::access('admin')){
	require views_path('tables/tables-new');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
