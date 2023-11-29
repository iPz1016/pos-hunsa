<?php

session_start();

define("ABSPATH", __DIR__);

require "../app/core/init.php";

$controller = $_GET['pg'] ?? "home";
$controller = strtolower($controller);

if(Auth::access('manager') && $controller=='home')
{
	$controller='admin';
}


if(file_exists("../app/controllers/".$controller . ".php"))
{
	require "../app/controllers/".$controller . ".php";
}else{
	?> 
	<html> 
		<div class="container"> 
			<h1 style="text-align: center;"> Sorry, This page doesn't exist. </h1>
		</div>
	</html>
	
<?php } ?>
