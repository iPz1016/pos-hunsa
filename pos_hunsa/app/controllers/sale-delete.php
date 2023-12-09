<?php 

$errors = [];
// Get the sale ID 
$id = $_GET['id'] ?? null;
$sale = new History();

// Fetch sale details based on the ID
$row = $sale->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	// Delete the sale entry
	$sale->delete($row['id']);

      // Redirect to the admin sales page
	redirect('admin&tab=sales');
}

 // Redirect to the admin sales page
if(Auth::access('manager')){
	require views_path('sales/sale-delete');
}else{
	// Display an error message for users who don't have permission to delete sales
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}