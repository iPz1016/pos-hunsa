<?php 

defined("ABSPATH") ? "":die();

// Check if the user has cashier access
if(Auth::access('cashier')){
	// Display the home view for cashiers
	require views_path('home');
}else{
	// Display an access denied message for users without cashier access
	Auth::setMessage("You need to be cashier in for this page");
	require views_path('auth/denied');
}

