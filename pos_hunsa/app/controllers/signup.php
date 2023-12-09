<?php 

$errors = [];
// Check if the request method is POST and the user has manager access
if($_SERVER['REQUEST_METHOD'] == "POST" && Auth::access('manager'))
{

	$user = new User();

	// Validate the posted data
	$errors = $user->validate($_POST);
	if(empty($errors)){

		// Hash the password before insertion
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		// Insert the user data into the database
		$user->insert($_POST);
		// Redirect to the admin users page
		redirect('admin&tab=users');
	}
}

// Check if the logged-in user has manager access
if(Auth::access('manager')){
	require views_path('auth/signup');
}else{
	// Display an error message for users who don't have permission to create users
	Auth::setMessage("Only admins can create users");
	require views_path('auth/denied');
}

