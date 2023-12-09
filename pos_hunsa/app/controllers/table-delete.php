<?php

$errors = [];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$tableClass = new Table_info;
    // Check if the 'number' field is set in the POST data
    if($_POST['number'])
    {
        // Check if it's possible to delete the specified number of tables
        $check = $tableClass->deletable_table($_POST['number']);
        if($check==1)
        {
            // If the tables can be deleted, proceed with the deletion
            $tableClass->delete_table($_POST['number']);
            // Redirect to the admin tables page
            redirect('admin&tab=tables');
        }
            // Display appropriate error messages based on the check result
        else if($check == -1)
        {
            $errors['number'] = 'There are some busy tables, cannot delete.';
        }
        else if($check == -2)
        {
            $errors['number'] = 'The deleted amount should less or equal to total tables.';
        }
        else if($check == -3)
        {
            $errors['number'] = 'There is no existing table.';
        }
        
    }

}
// Check if the logged-in user has manager access
if(Auth::access('manager')){
	require views_path('tables/tables-delete');
}else{
    // Display an error message for users who don't have permission to delete tables
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
