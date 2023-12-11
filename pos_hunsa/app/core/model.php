<?php

// Model class extending Database 
class Model extends Database
{
	// Get the allowed columns based on the defined columns in the child class
     	// @param array $data Data to filter
     	// @return array Cleaned data with only allowed columns
	protected function get_allowed_columns($data)
	{	
		// Check if allowed columns are defined in the child class
 		if(!empty($this->allowed_columns)){
			foreach ($data as $key => $value) {
				// Remove any keys that are not in the allowed columns list
				if(!in_array($key, $this->allowed_columns))
				{
					unset($data[$key]);
				}
			}
		}
		return $data;
 	}

	// Insert a new record into the database
     	// @param array $data Data to insert
     	// @return void
	public function insert($data)
	{

		$clean_array = $this->get_allowed_columns($data,$this->table);
		$keys = array_keys($clean_array);
		
		$query = "insert into $this->table ";
		$query .= "(".implode(",", $keys) .") values ";
		$query .= "(:".implode(",:", $keys) .")";

		$db = new Database;
		$db->query($query,$clean_array);	

	}

	// Update an existing record in the database
	// @param $id Record identifier
	// @param array $data Data to update
	// @param string $key Name of the primary key column
	// @return void
	public function update($id,$data,$key="id")
	{

		$clean_array = $this->get_allowed_columns($data,$this->table);
		$keys = array_keys($clean_array);
		$query = "update $this->table set ";

		foreach ($keys as $column) {
			// code...
			$query .= $column . "=:".$column .",";
		}

		$query = trim($query,",");
		$query .= " where $key = :$key";
		$clean_array[$key] = $id;

		$db = new Database;
		$db->query($query,$clean_array);	

	}

	
	// Delete a record from the database based on the given identifier
	// @param $id Record identifier
	// @param string $id_name Name of the primary key column
	// @return void
	public function delete($id,$id_name="id")
	{

		$query = "delete from $this->table where $id_name = :$id_name limit 1";
		$clean_array[$id_name] = $id;

		$db = new Database;
		$db->query($query,$clean_array);	

	}

	// Retrieve records from the database based on specified conditions
	// @param array $data Conditions for the WHERE clause
	// @param int $limit Maximum number of records to retrieve
	// @param int $offset Offset for paginating through records
	// @param string $order Sorting order (asc or desc)
	// @param string $order_column Column for sorting
	// @return array Retrieved records
	public function where($data,$limit = 10,$offset = 0,$order = "desc",$order_column = "id")
	{

		$keys = array_keys($data);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= "$key = :$key && ";
		}

		$query = trim($query,"&& ");
		$query .= " order by $order_column $order limit $limit offset $offset";

		$db = new Database;
		return $db->query($query,$data);	
	}

	// Retrieve all records from the database
	// @param int $limit Maximum number of records to retrieve
	// @param int $offset Offset for paginating through records
	// @param string $order Sorting order (asc or desc)
	// @param string $order_column Column for sorting
	// @return array Retrieved records
	public function getAll($limit = 10,$offset = 0,$order = "desc",$order_column = "id")
	{
		$query = "select * from $this->table order by $order_column $order limit $limit offset $offset";
  		
		$db = new Database;
		return $db->query($query);	
	}

	// Retrieve the first record from the database based on specified conditions
	// @param array $data Conditions for the WHERE clause
	// @return mixed|null First retrieved record or null if not found
	public function first($data)
	{
		$keys = array_keys($data);
		
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			// code...
			$query .= "$key = :$key && ";
		}

		$query = trim($query,"&& ");

		$db = new Database;
		if($res = $db->query($query,$data))
		{
			return $res[0];
		}
		return false;	
	}
}