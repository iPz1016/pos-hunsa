<?php 
// Initialize an array to store errors
$errors = [];

// Get the menu ID from the query parameters or set it to null if not present
$id = $_GET['id'] ?? null;
// Create an instance of the Menu_info class
$menuClass = new Menu_info();

// Get the menu row based on the menu ID
$row = $menuClass->first(['menu_id'=>$id]);
// Get the available menu types
$menu_type = $menuClass->get_menu_type();

// Check if the request method is POST and a menu row exists
if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	// Check if a new menu image is provided
	if(!empty($_FILES['menu_img']['name']))
	{
		$_POST['menu_img'] = $_FILES['menu_img'];
	}
	// Check if the menu type needs to be updated
	if($_POST['menu_type'] == -1 )
	{
		$_POST['menu_type'] = $_POST['type'];
	}
	// Validate the submitted data
	$errors = $menuClass->validate($_POST,$row['menu_id']);

	// If there are no validation errors, proceed with the update
	if(empty($errors)){

		// Create the folder if it doesn't exist
		$folder = "assets/images/menu/";
		if(!file_exists($folder))
		{
			mkdir($folder,0777,true);
		}

		// Check if a new menu image is provided and move it to the destination folder
		if(!empty($_POST['menu_img']))
		{
			$destination = $folder . strtolower(pathinfo($_POST['menu_img']['name'])['basename']);
			move_uploaded_file($_POST['menu_img']['tmp_name'], $destination);
			$_POST['menu_img'] = $destination;

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
		}

		// Update the menu item
		$menuClass->update($row['menu_id'],$_POST,"menu_id");
		// Redirect to the admin menu page
		redirect('admin&tab=menu');
	}


}

// Check if the user has manager access
if(Auth::access('manager')){
	// Require the menu-edit view for managers
	require views_path('menu/menu-edit');
}else{
	// Set an access denied message for users without manager access
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
