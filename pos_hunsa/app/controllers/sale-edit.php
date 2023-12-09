<?php 
$errors = [];

// Get the sale ID
$id = $_GET['id'] ?? null;
$sale = new History();

// Fetch sale details based on the ID
$row = $sale->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	// Validate the posted data
	$errors = $sale->validate($_POST,$row['id']);
	if(empty($errors)){
		// Prepare data for updating the sale
		$data['menu_name'] = $_POST['menu_name'];
		$data['qty'] = $_POST['qty'];
		$data['menu_price'] = $_POST['menu_price'];

		// Update the sale entry
		$sale->update($row['id'],$_POST);

		// Redirect to the admin sales page
		redirect('admin&tab=sales');
	}


}

// Check if the logged-in user has manager access
if(Auth::access('manager')){
	require views_path('sales/sale-edit');
}else{
	// Display an error message for users who don't have permission to edit sales
	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
