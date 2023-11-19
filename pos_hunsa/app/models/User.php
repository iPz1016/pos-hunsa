<?php 


/**
 * users class
 */
class User extends Model
{
	
	protected $table = "users";
	protected $allowed_columns = [
				'username',
				'password',
				'role',
				'firstname',
				'lastname'
			];


 	public function validate($data, $id = null)
	{
		$errors = [];

			//check username
			if(empty($data['username']))
			{
				$errors['username'] = "Username is required";
			}else
			if(!preg_match('/^[a-zA-Z0-9]+$/', $data['username']))
			{
				$errors['username'] = "Only letters allowed in username";
			}
			//check firstname
			if(empty($data['firstname']))
			{
				$errors['firstname'] = "First name is required";
			}else
			if(!preg_match('/^[a-zA-Z]+$/', $data['firstname']))
			{
				$errors['firstname'] = "Only letters allowed in first name";
			}
			//check lastname
			if(empty($data['lastname']))
			{
				$errors['lastname'] = "Last name is required";
			}else
			if(!preg_match('/^[a-zA-Z]+$/', $data['lastname']))
			{
				$errors['lastname'] = "Only letters allowed in last name";
			}

			//check password
			if(!$id){
				if(empty($data['password']))
				{
					$errors['password'] = "password is required";
				}else
				if($data['password'] !== $data['password_retype'])
				{
					$errors['password_retype'] = "Passwords do not match";
				}else
				if(strlen($data['password']) < 8)
				{
					$errors['password'] = "Password must be at least 8 characters long";
				}
			}else{

				if(!empty($data['password']))
				{
	 				if($data['password'] !== $data['password_retype'])
					{
						$errors['password_retype'] = "Passwords do not match";
					}else
					if(strlen($data['password']) < 8)
					{
						$errors['password'] = "Password must be at least 8 characters long";
					}
				}
			}

		return $errors;
	}



}