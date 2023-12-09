<?php 
// Initialize variables
$errors = [];
$user = new User();
$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

// Store referring page if not coming from edit-user page
if(!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit-user"))
{
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

// Process POST request for user update
if($_SERVER['REQUEST_METHOD'] == "POST" && (Auth::access('manager') || Auth::get('id')==$id))
{
	// Make sure cannot change their own role
	if(isset($_POST['role']) && $id == Auth::get('id'))
	{
			$_POST['role'] = $row['role'];
	}

	// Validate user input
	$errors = $user->validate($_POST,$id);
	if(empty($errors)){
		// If password is empty, unset it; otherwise, hash the password
		if(empty($_POST['password'])){
			unset($_POST['password']);
		}else{
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		
		// Update user information
		$user->update($id,$_POST);
		redirect("admin&tab=users");
	}
}

// Display appropriate view based on user access
if(Auth::access('manager') || ($row && $row['id'] == Auth::get('id'))){
	// Display edit user form for managers or the user themselves
	require views_path('auth/edit-user');
}else{
	// Display access denied message for non-admins
	Auth::setMessage("Only admins can edit other users");
	require views_path('auth/denied');
}

