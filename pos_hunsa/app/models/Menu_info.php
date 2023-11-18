<?php


/**
 * products class
 */
class Menu_info extends Model
{

    protected $table = "menu_info";

    protected $allowed_columns = [

        'menu_id',
        'menu_name',
        'menu_price',
        'disable',
        'menu_type',
        'menu_img',
    ];


    public function validate($data, $id = null)
    {
        $errors = [];

        //check menu_name
        if (empty($data['menu_name'])) {
            $errors['menu_name'] = "Menu name is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_name'])) {
            $errors['menu_name'] = "Only letters allowed in menu name";
        }

        //check menu_price
        if (empty($data['menu_price'])) {
            $errors['menu_price'] = "Menu price is required";
        } else
			if (!preg_match('/^[0-9.]+$/', $data['menu_price'])) {
            $errors['menu_price'] = "Menu price must be a number";
        }

        //check menu_type
        if (empty($data['menu_type'])) {
            $errors['menu_type'] = "Menu name is required";
        } else
			if (!preg_match('/[a-zA-Z0-9 _\-\&\(\)]+/', $data['menu_type'])) {
            $errors['menu_type'] = "Only letters allowed in menu type";
        }

        //check image
        $max_size = 4; //mbs
        $size = $max_size * (1024 * 1024);

        if (!$id || ($id && !empty($data['menu_img']))) {

            if (empty($data['menu_img'])) {
                $errors['menu_img'] = "Product image is required";
            } else
				if (!($data['menu_img']['type'] == "image/jpeg" || $data['menu_img']['type'] == "image/png")) {
                $errors['menu_img'] = "Image must be a valid JPEG or PNG";
            } else
				if ($data['menu_img']['error'] > 0) {
                $errors['menu_img'] = "The image failed to upload. Error No." . $data['image']['error'];
            } else
				if ($data['menu_img']['size'] > $size) {
                $errors['menu_img'] = "The image size must be lower than " . $max_size . "Mb";
            }
        }


        return $errors;
    }

    public function get_menu_type()
    {
        $query = "select DISTINCT menu_type from $this->table";

        $db = new Database;
        return $db->query($query);
    }

    public function generate_filename($ext = "jpg")
    {

        return hash("sha1", rand(1000, 999999999)) . "_" . rand(1000, 9999) . "." . $ext;
    }
}
