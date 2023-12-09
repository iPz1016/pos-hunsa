<?php 

$errors = [];
$user = new User();

// Get user ID from the URL or use the logged-in user's ID
$id = $_GET['id'] ?? Auth::get('id');
// Fetch user details based on the ID
$row = $user->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	//Make sure only admins can set other users as admins
	if($_POST['role'] == "admin")
	{
		if(!Auth::get('role') == "admin")
		{
			$_POST['role'] = "user";
		}
	}
	// Validate user input
	$errors = $user->validate($_POST, $id);

	if(empty($errors)){
		// If no new password provided, remove the password field from the update
		if(empty($_POST['password'])){
			unset($_POST['password']);
		}else{
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}

		// Update user information
		$user->update($id,$_POST);

		// Redirect to the admin users page
		redirect('admin&tab=users');
	}
}

// Check if the logged-in user has manager access or if the user is viewing their own profile
if(Auth::access('manager') || ($row && $row['id'] == Auth::get('id'))){
	require views_path('auth/profile');
}else{
	// Display an error message for users who don't have permission to edit other users
	Auth::setMessage("Only admins can edit other users");
	require views_path('auth/denied');
}

