<?php 

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$user = new User();
 	if($row = $user->where(['username'=>$_POST['username']]))
 	{
  	 
 		if(password_verify($_POST['password'], $row[0]['password']))
 		{
 			authenticate($row[0]);
			redirect('home');
 		}else
	 	{
	 		$errors['password'] = "Wrong password";
	 	}
 	}else
 	{
 		$errors['username'] = "Invalid username";
 	}


}

require views_path('auth/login');

