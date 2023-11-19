<?php 

$errors = [];

$id = $_GET['id'] ?? null;
$sale = new History();

$row = $sale->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	
	$sale->delete($row['id']);
  
	redirect('admin&tab=sales');
 

}

if(Auth::access('admin')){
	require views_path('sales/sale-delete');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}