<?php 

// Check if the USER session variable is set and unset it
if(isset($_SESSION['USER'])){
	unset($_SESSION['USER']);
}
// Redirect to the login page
redirect('login');