<?php
// Initialize an array to store errors
$errors = [];

$menuClass = new Menu_info();
// Get the available menu types
$menu_type = $menuClass->get_menu_type();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// Check if the menu type needs to be updated
	if($_POST['menu_type'] == -1 )
	{
		$_POST['menu_type'] = $_POST['type'];
	}

	// Check if a new menu image is provided
	if (!empty($_FILES['menu_img']['name'])) {
		$_POST['menu_img'] = $_FILES['menu_img'];
	}

	// Validate the submitted data
	$errors = $menuClass->validate($_POST);

	// If there are no validation errors, proceed with inserting the new menu item
	if (empty($errors)) {

		// Specify the folder for menu images
		$folder = "assets/images/menu/";

		// Create the folder if it doesn't exist
		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}

		// Set the destination path for the new menu image
		$destination = $folder . strtolower(pathinfo($_POST['menu_img']['name'])['basename']);

		// Move the uploaded menu image to the destination folder
		move_uploaded_file($_POST['menu_img']['tmp_name'], $destination);
		$_POST['menu_img'] = $destination;

		// Insert the new menu item into the database
		$menuClass->insert($_POST);

		// Redirect to the admin menu page
		redirect('admin&tab=menu');
	}
}

// Check if the user has manager access
if(Auth::access('manager')){
	// Require the menu-new view for managers
	require views_path('menu/menu-new');
}else{
	// Set an access denied message for users without manager access
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
