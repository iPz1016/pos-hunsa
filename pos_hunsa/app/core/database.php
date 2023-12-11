<?php 


// Database Class
class Database
{
     // Establishes a database connection
     // return PDO or null if The PDO object on success, or null on failure
	private function db_connect(){

		$DBHOST = "localhost";
		$DBNAME = "pos_hunsa";
		$DBUSER = "root";
		$DBPASS = "";
		$DBDRIVER = "mysql";

		try{

			$con = new PDO("$DBDRIVER:host=$DBHOST;dbname=$DBNAME",$DBUSER,$DBPASS);
		}catch(PDOException $e){
			
			// In case of an error, display the error message
			echo $e->getMessage();
		}
		return $con;
	}

     	// Executes a query with optional data bindings
	// The SQL query to be executed
     	// An array of results on success, or false on failure
	public function query($query,$data = array())
	{
		$con = $this->db_connect();
		$smt = $con->prepare($query);
		$check = $smt->execute($data);

		if($check)
		{
			$result = $smt->fetchAll(PDO::FETCH_ASSOC);
			if(is_array($result) && count($result) > 0){

				return $result;
			}
		}
		return false;
	}
}
