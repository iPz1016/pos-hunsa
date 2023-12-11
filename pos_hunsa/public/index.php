<?php
// Start a session
session_start();

// Define the absolute path
define("ABSPATH", __DIR__);

// Require the initialization file
require "../app/core/init.php";

// Get the controller from the query parameter 'pg', default to "home"
$controller = $_GET['pg'] ?? "home";
$controller = strtolower($controller);

// Check if the user is trying to access the 'home' page and has 'manager' access
if( $controller=='home' && Auth::access('manager'))
{
	$controller='admin';
}

// Check if the controller file exists
if(file_exists("../app/controllers/".$controller . ".php"))
{	
	// Require the controller file from controller folder
	require "../app/controllers/".$controller . ".php";
}else{
	?> 
	<!-- Display an error message for non-existing pages -->
	<html> 
		<div class="container"> 
			<h1 style="text-align: center;"> Sorry, This page doesn't exist. </h1>
		</div>
	</html>
	
<?php } ?>
