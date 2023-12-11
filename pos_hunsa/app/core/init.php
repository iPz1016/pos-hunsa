<?php 
// Include the configuration, functions, database, and model files
require "../app/core/config.php";
require "../app/core/functions.php";
require "../app/core/database.php";
require "../app/core/model.php";

spl_autoload_register('my_function');


// Autoloader function to dynamically load class files
function my_function($classname)
{
	// Define the file path based on the class name
	$filename = "../app/models/".ucfirst($classname) . ".php";
	// Check if the file exists before requiring it
	if(file_exists($filename)){
		require $filename;
	}
}