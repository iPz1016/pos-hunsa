<?php

$errors = [];
// Get the menu ID from the query parameters or set it to null if not present
$id = $_GET['id'] ?? null;
$menuClass = new Menu_info();

// Get the menu row based on the menu ID
$row = $menuClass->first(['menu_id' => $id]);

// Check if the request method is POST and a menu row exists
if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
	
	$orderClass = new Orders;
	// Check if there are orders containing the menu item
	$order_exist = $orderClass->first(['menu_id'=>$id]);

	//If menu is currently in order then cannot delete
	if (!$order_exist) {

		// Delete the menu item
		$menuClass->delete($row['menu_id'], 'menu_id');

		//Delete old image
		if (file_exists($row['menu_img'])) {
			unlink($row['menu_img']);

			//Delete cropped image
			$exp = explode('.', $row['menu_img']);
			$crop = $exp[0] . '_cropped.' . $exp[1];
			if (file_exists($crop)) {
				unlink(($crop));
			}

		}
		// Redirect to the admin menu page
		redirect('admin&tab=menu');
	} else {
		// If the menu is currently in customer orders, set an error message
		$errors['error'] = 'This menu is currently in order(s).<br> Please try again later.';
	}
}


// Check if the user has manager access
if (Auth::access('manager')) {
	// Require the menu-delete view for managers
	require views_path('menu/menu-delete');
} else {
	// Set an access denied message for users without manager access
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
