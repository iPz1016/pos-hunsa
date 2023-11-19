<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$menuClass = new Menu_info();

	if (!empty($_FILES['menu_img']['name'])) {
		$_POST['menu_img'] = $_FILES['menu_img'];
	}

	$errors = $menuClass->validate($_POST);
	if (empty($errors)) {

		$folder = "assets/images/menu/";
		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}

		$destination = $folder . strtolower(pathinfo($_POST['menu_img']['name'])['basename']);

		move_uploaded_file($_POST['menu_img']['tmp_name'], $destination);
		$_POST['menu_img'] = $destination;

		$menuClass->insert($_POST);

		redirect('admin&tab=menu');
	}
}

if(Auth::access('admin')){
	require views_path('menu/menu-new');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
