<?php 
// User class
class User extends Model
{
	// Table name in the database
	protected $table = "users";
	// Allowed columns for insertion and update
	protected $allowed_columns = [
				'username',
				'password',
				'role',
				'firstname',
				'lastname'
			];
	
	// Validate user input data.
	// @param array $data User input data.
	// @param int|null $id User ID for update (optional).
	// @return array An array containing validation errors, if any.
 	public function validate($data, $id = null)
	{
		//Errors Array
		$errors = [];
			
			// Check name and validate input from users.
			// Display error massage if input text is not valid.
			if(empty($data['username']))
			{
				$errors['username'] = "Username is required";
			}else
			if(!preg_match('/^[a-zA-Z0-9]+$/', $data['username']))
			{
				$errors['username'] = "Only letters are allowed in Username";
			}

			// Check Firstname and validate input from users.
			// Display error massage if input text is not valid.
			if(empty($data['firstname']))
			{
				$errors['firstname'] = "First Name is required";
			}else
			if(!preg_match('/^[a-zA-Z]+$/', $data['firstname']))
			{
				$errors['firstname'] = "Only letters are allowed in First Name";
			}

			// Check Lastname and validate input from users.
			// Display error massage if input text is not valid.
			if(empty($data['lastname']))
			{
				$errors['lastname'] = "Last Name is required";
			}else
			if(!preg_match('/^[a-zA-Z]+$/', $data['lastname']))
			{
				$errors['lastname'] = "Only letters are allowed in Last Name";
			}

			// Check if Password match the data in database and validate input from users.
			// Display error massage if Password do not match.
			if(!$id){
				if(empty($data['password']))
				{
					$errors['password'] = "Password is required";
				}else
				if($data['password'] !== $data['password_retype'])
				{
					$errors['password_retype'] = "Password do not match";
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