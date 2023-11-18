<?php 

$errors = [];

$id = $_GET['id'] ?? null;
$product = new Product();

$row = $product->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
{
	
	$product->delete($row['id']);
  	
	//delete old image
	if(file_exists($row['image']))
	{
		unlink($row['image']);
	}

	redirect('admin&tab=menu');
 

}


require views_path('menu/menu-delete');

