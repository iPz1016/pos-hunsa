<?php


/**
 * authentication class
 */
class Auth
{
	
	public static function get($column)
	{
		if(!empty($_SESSION['USER'][$column])){
			return $_SESSION['USER'][$column];
		}

		return "Unknown";
	}

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

	public static function access($role)
	{

		$access['admin'] = ['manager'];
		$access['cashier'] = ['cashier'];

		$myrole = self::get('role');
		if(in_array($myrole, $access[$role]))
		{
			return true;
		}

		return false;
	}

	public static function setMessage($message)
	{
		$_SESSION['MESSAGE'] = $message;
	}

	public static function getMessage()
	{
		if(!empty($_SESSION['MESSAGE'])){

			$message = $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
			return $message;
		}
	}

	

}
