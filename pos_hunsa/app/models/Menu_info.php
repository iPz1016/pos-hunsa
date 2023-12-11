<?php


// Products class
class Menu_info extends Model
{   
    //Database Munu_info table
    protected $table = "menu_info";

    // Allowed columns that can be accessed or modified
    protected $allowed_columns = [

        'menu_id',
        'menu_name',
        'menu_price',
        'disable',
        'menu_type',
        'menu_img',
    ];

    // Validate input data for menu information.
    // @param array $data The data to be validated.
    // @param int|null $id Optional parameter for update operation.
    // @return array An array containing validation errors, if any.
    public function validate($data, $id = null)
    {
        $errors = [];

        // Check Menu name and validate input from users.
        // Display error massage if input text is not valid.
        if (empty($data['menu_name'])) {
            $errors['menu_name'] = "Menu Name is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_name'])) {
            $errors['menu_name'] = "Only letters are allowed in the Menu Name.";
        }

        // Check Menu Price and validate input from users.
        // Display an error message if users do not input a number.
        if (empty($data['menu_price'])) {
            $errors['menu_price'] = "Menu Price is required";
        } else
			if (!preg_match('/^[0-9.]+$/', $data['menu_price'])) {
            $errors['menu_price'] = "Menu Price must be a number";
        }

        // Check Menu type and validate input from users.
        // Display error massage if input text is not valid.
        if (empty($data['menu_type'])) {
            $errors['menu_type'] = "Menu Type is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_type'])) {
            $errors['menu_type'] = "Only letters are allowed in the Menu Type.";
        }

        // Check Menu Image and validate size of image.
        // Display error massage if file type is not valid, failed to upload, file size is not valid.
        $max_size = 4; //mbs
        $size = $max_size * (1024 * 1024);

        if (!$id || ($id && !empty($data['menu_img']))) {

            if (empty($data['menu_img'])) {
                $errors['menu_img'] = "Menu image is required";
            } else
				if (!($data['menu_img']['type'] == "image/jpeg" || $data['menu_img']['type'] == "image/png")) {
                $errors['menu_img'] = "Image must be a valid JPEG or PNG";
            } else
				if ($data['menu_img']['error'] > 0) {
                $errors['menu_img'] = "Image failed to upload. Error No." . $data['image']['error'];
            } else
				if ($data['menu_img']['size'] > $size) {
                $errors['menu_img'] = "Image size must be lower than " . $max_size . "Mb";
            }
        }
        return $errors;
    }

    // Retrieve menu types from the database.
    // @return array An array containing distinct menu types.
    public function get_menu_type()
    {
        $query = "select DISTINCT menu_type from $this->table";

        $db = new Database;
        return $db->query($query);
    }

     
    // Generate a unique filename for menu images.
    // @param string $ext The file extension.
    // @return string A unique filename.
    public function generate_filename($ext = "jpg")
    {

        return hash("sha1", rand(1000, 999999999)) . "_" . rand(1000, 9999) . "." . $ext;
    }
}
