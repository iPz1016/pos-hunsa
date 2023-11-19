<?php 

$errors = [];

$id = $_GET['id'] ?? null;
$sale = new History();

$row = $sale->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{

	$errors = $sale->validate($_POST,$row['id']);
	if(empty($errors)){
		
	
		$data['menu_name'] = $_POST['menu_name'];
		$data['qty'] = $_POST['qty'];
		$data['menu_price'] = $_POST['menu_price'];
		
		$sale->update($row['id'],$_POST);

		redirect('admin&tab=sales');
	}


}



if(Auth::access('admin')){
	require views_path('sales/sale-edit');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}
