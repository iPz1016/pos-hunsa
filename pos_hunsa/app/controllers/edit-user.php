<?php 

$errors = [];
$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if(!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit-user"))
{
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

if($_SERVER['REQUEST_METHOD'] == "POST" && (Auth::access('manager') || Auth::get('id')==$id))
{

	//make sure cannot change thier own role
	if(isset($_POST['role']) && $id == Auth::get('id'))
	{
			$_POST['role'] = $row['role'];
	}

	$errors = $user->validate($_POST,$id);
	if(empty($errors)){

		if(empty($_POST['password'])){
			unset($_POST['password']);
		}else{
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		
		$user->update($id,$_POST);

		redirect("admin&tab=users");
	}


}
	
if(Auth::access('manager') || ($row && $row['id'] == Auth::get('id'))){
	require views_path('auth/edit-user');
}else{

	Auth::setMessage("Only admins can edit other users");
	require views_path('auth/denied');
}

