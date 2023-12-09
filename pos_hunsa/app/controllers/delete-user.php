<?php 
// Initialize variables
$errors = [];
$user = new User();
$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	// Check conditions for user deletion
	if(is_array($row) && Auth::access('manager') && Auth::get('id')!=$id)
	{
		// Delete user and redirect to admin users page
		$user->delete($id);
		redirect('admin&tab=users');
	}

}

// Display appropriate view based on user access
if(Auth::access('manager')){
	// Display delete user form for managers
	require views_path('auth/delete-user');
}else{
	// Display access denied message for non-managers
	Auth::setMessage("Only admins can delete users");
	require views_path('auth/denied');
}
