<?php 

$errors = [];

$id = $_GET['id'] ?? null;
$menuClass = new Menu_info();

$row = $menuClass->first(['menu_id'=>$id]);
$menu_type = $menuClass->get_menu_type();

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	
	if(!empty($_FILES['menu_img']['name']))
	{
		$_POST['menu_img'] = $_FILES['menu_img'];
	}

	$errors = $menuClass->validate($_POST,$row['menu_id']);
	if(empty($errors)){
		
		$folder = "assets/images/menu/";
		if(!file_exists($folder))
		{
			mkdir($folder,0777,true);
		}

		if(!empty($_POST['menu_img']))
		{
			$destination = $folder . strtolower(pathinfo($_POST['menu_img']['name'])['basename']);
			move_uploaded_file($_POST['menu_img']['tmp_name'], $destination);
			$_POST['menu_img'] = $destination;

			//delete old image
			if(file_exists($row['menu_img']))
			{
				unlink($row['menu_img']);
			}
		}

		$menuClass->update($row['menu_id'],$_POST,"menu_id");

		redirect('admin&tab=menu');
	}


}


if(Auth::access('admin')){
	require views_path('menu/menu-edit');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
