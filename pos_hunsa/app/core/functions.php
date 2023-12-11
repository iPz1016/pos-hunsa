<?php 

// Returns the path of a view file
// @param string $view The name of the view
// @return string The path of the view file
function views_path($view)
{
	if(file_exists("../app/views/$view.view.php")){
		return "../app/views/$view.view.php";
	}else{
		echo "view '$view' not found";
	}
}

// Escapes a string for safe HTML output
// @param string $str The string to be escaped
// @return string The escaped string

function esc($str)
{
	return htmlspecialchars($str);
}

// Redirects to a specified page
// @param string $page The page to redirect to
// @return void
function redirect($page)
{
	header("Location: index.php?pg=" .$page);
	die;
}


// Retrieves the value of a form field, providing a default value if not set
// @param string $key The name of the form field
// @param string $default The default value to return if the form field is not set
// @return mixed The value of the form field or the default value
function set_value($key,$default = "")
{
	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}
	return $default;
}

// Authenticates a user and stores user data in the session
// @param array $row The user data to be stored
// @return void
function authenticate($row)
{
	$_SESSION['USER'] = $row;
}

// Retrieves user authentication information
// @param string $column The column to retrieve from the authenticated user
// @return string The value of the specified column or "Unknown" if not set
function auth($column)
{
	if(!empty($_SESSION['USER'][$column])){
		return $_SESSION['USER'][$column];
	}
	return "Unknown";
}

// Crops an image to a specified size
// @param string $filename The name of the image file
// @param int $size The size to crop the image to
// @return string The path of the cropped image
function crop($filename,$size = 400)
{
	$ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	$cropped_file = preg_replace("/\.$ext$/", "_cropped.".$ext, $filename);

	//If Cropped file already exists
	if(file_exists($cropped_file))
	{
		return $cropped_file;
	}
	
	//Create image resource
	switch ($ext) {
		case 'jpg':
		case 'jpeg':
			$src_image = imagecreatefromjpeg($filename);
			break;
		
		case 'gif':
			$src_image = imagecreatefromgif($filename);
			break;
		
		case 'png':
			$src_image = imagecreatefrompng($filename);
			break;
		
		default:
			return $filename;
			break;
	}

	//Set cropping params
	//Assign values
	$dst_x = 0;
	$dst_y = 0;
	$dst_w = (int)$size;
	$dst_h = (int)$size;

	$original_width = imagesx($src_image);
	$original_height = imagesy($src_image);

	if($original_width < $original_height)
	{
		$src_x = 0;
		$src_y = ($original_height - $original_width) / 2;
		$src_w = $original_width;
		$src_h = $original_width;

	}else{

		$src_y = 0;
		$src_x = ($original_width - $original_height) / 2;
		$src_w = $original_height;
		$src_h = $original_height;
	}
 
	$dst_image = imagecreatetruecolor((int)$size, (int)$size);
	imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

	// Save Result Image
	switch ($ext) {
		case 'jpg':
		case 'jpeg':
			imagejpeg($dst_image,$cropped_file,90);
			break;
		
		case 'gif':
			imagegif($dst_image,$cropped_file);
			break;
		
		case 'png':
			imagepng($dst_image,$cropped_file);
			break;
		
		default:
			return $filename;
			break;
	}

	imagedestroy($dst_image);
	imagedestroy($src_image);
	return $cropped_file;
}

// Formats a date in a readable format
// @param string $date The date to be formatted
// @return string The formatted date
function get_date($date)
{
	return date("jS M, Y",strtotime($date));
}

// Retrieves user data by ID
// @param int $id The user ID
// @return User The User object representing the user with the specified ID
function get_user_by_id($id)
{
	$user = new User();
	return $user->first(['id'=>$id]);
}

// Generates daily data from records
// @param array $records The array of records
// @return array The generated daily data
function generate_daily_data($records)
{
	$arr = [];
	
	if(!$records) return $arr;

	for ($i=0; $i < 24; $i++) { 
		if(!isset($arr[$i])){
		
			$arr[$i] = 0;
		}
		foreach ($records as $row) {
			
			$hour = date('H',strtotime($row['time']));
			if($hour == $i){

				$arr[$i] += $row['total'];
			}
		}
	}
	return $arr;
}

// Generates monthly data from records
// @param array $records The array of records
// @return array The generated monthly data
function generate_monthly_data($records)
{
	$arr = [];
	
	if(!$records) return $arr;
	$total_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
	for ($i=1; $i <= $total_days; $i++) { 
		
		if(!isset($arr[$i])){
		
			$arr[$i] = 0;
		}

		foreach ($records as $row) {
			
			$day = date('d',strtotime($row['time']));
			if($day == $i){

				$arr[$i] += $row['total'];
			}
		}
	}
	return $arr;
}


// Generates yearly data from records
// @param array $records The array of records
// @return array The generated yearly data
function generate_yearly_data($records)
{
	$arr = [];
	$months = ['0','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	
	if(!$records) return $arr;

	for ($i=1; $i <= 12; $i++) { 
		
		if(!isset($arr[$months[$i]])){
		
			$arr[$months[$i]] = 0;
		}

		foreach ($records as $row) {
			
			$month = date('m',strtotime($row['time']));
			if($month == $i){

				$arr[$months[$i]] += $row['total'];
			}
		}
	}
	return $arr;
}