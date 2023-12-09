<?php 

$errors = [];

// Check if the form is submitted via POST
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$user = new User();
	// Find a user with the provided username
 	if($row = $user->where(['username'=>$_POST['username']]))
 	{
		// Verify the password
 		if(password_verify($_POST['password'], $row[0]['password']))
 		{
			// Authenticate the user and redirect to the home page
 			authenticate($row[0]);
			redirect('home');
 		}else
	 	{	
			// Display an error if the password is incorrect
	 		$errors['password'] = "Wrong password";
	 	}
 	}else
 	{
		// Display an error if the username is not found
 		$errors['username'] = "Invalid username";
 	}


}
// Load the login view
require views_path('auth/login');

