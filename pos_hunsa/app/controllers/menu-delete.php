<?php 

$errors = [];

$id = $_GET['id'] ?? null;
$menuClass = new Menu_info();

$row = $menuClass->first(['menu_id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	
	$menuClass->delete($row['menu_id'],'menu_id');
  	
	//delete old image
	if(file_exists($row['image']))
	{
		unlink($row['image']);
	}

	redirect('admin&tab=menu');
 

}



if(Auth::access('admin')){
	require views_path('menu/menu-delete');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
