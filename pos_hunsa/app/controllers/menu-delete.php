<?php

$errors = [];

$id = $_GET['id'] ?? null;
$menuClass = new Menu_info();

$row = $menuClass->first(['menu_id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

	$orderClass = new Orders;
	$order_exist = $orderClass->first(['menu_id'=>$id]);

	//if menu is currently in order then cannot delete
	if (!$order_exist) {

		$menuClass->delete($row['menu_id'], 'menu_id');

		//delete old image
		if (file_exists($row['menu_img'])) {
			unlink($row['menu_img']);

			//delete cropped image
			$exp = explode('.', $row['menu_img']);
			$crop = $exp[0] . '_cropped.' . $exp[1];
			if (file_exists($crop)) {
				unlink(($crop));
			}

		}
		redirect('admin&tab=menu');
	} else {
		$errors['error'] = 'This menu is currently in order(s).<br> Please try again later.';
	}
}



if (Auth::access('manager')) {
	require views_path('menu/menu-delete');
} else {

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
