<?php

// Authentication Class
class Auth
{	
     // Get the value of a specific column for the authenticated user
     // @param string $column Column name
     // @return Value of the specified column or "Unknown" if not found
	public static function get($column)
	{
		if(!empty($_SESSION['USER'][$column])){
			return $_SESSION['USER'][$column];
		}

		return "Unknown";
	}


     // Check if a user is logged in     
     // @return bool True if logged in, false otherwise
	public static function logged_in()
	{
		if(!empty($_SESSION['USER'])){

			$db = new Database();
			if($db->query("select * from users where username = :username limit 1",['username'=>$_SESSION['USER']['username']]))
			{
				return true;
			}
		}
		return false;
	}

	// Check if the authenticated user has the specified role access
     	// @param string $role Role to check access for
     	// @return bool True if user has access, false otherwise
	public static function access($role)
	{
		$access['manager'] = ['manager'];
		$access['cashier'] = ['cashier'];

		$myrole = self::get('role');
		if(in_array($myrole, $access[$role]))
		{
			return true;
		}
		return false;
	}

	// Set a message in the session to be retrieved later
      // @param string $message Message to set
     	// @return void
	public static function setMessage($message)
	{
		$_SESSION['MESSAGE'] = $message;
	}

	// Get and unset a previously set message from the session
     	// @return string|null Retrieved message or null if not set
	public static function getMessage()
	{
		if(!empty($_SESSION['MESSAGE'])){

			$message = $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
			return $message;
		}
	}
}
