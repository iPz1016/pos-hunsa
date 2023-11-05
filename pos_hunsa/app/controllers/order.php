<?php 

defined("ABSPATH") ? "":die();

if(Auth::access('cashier')){
	require views_path('order');
}else{

	Auth::setMessage("You need to be logged in for this page");
	require views_path('auth/denied');
}

