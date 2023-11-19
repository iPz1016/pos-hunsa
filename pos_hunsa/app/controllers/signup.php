<?php 

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$user = new User();
	
	$errors = $user->validate($_POST);
	if(empty($errors)){
		
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->insert($_POST);

		redirect('admin&tab=users');
	}


}
	
if(Auth::access('admin')){
	require views_path('auth/signup');
}else{

	Auth::setMessage("Only admins can create users");
	require views_path('auth/denied');
}

