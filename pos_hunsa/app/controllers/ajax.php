<?php

defined("ABSPATH") ? "" : die();

//capture ajax data
$raw_data = file_get_contents("php://input");
//echo $raw_data;
if (!empty($raw_data)) {

	$OBJ = json_decode($raw_data, true);
	if (is_array($OBJ)) {
		if ($OBJ['data_type'] == "search") {

			$productClass = new Product();
			$limit = 20;

			if (!empty($OBJ['text'])) {
				//search
				$barcode = $OBJ['text'];
				$text = "%" . $OBJ['text'] . "%";
				$query = "select * from products where description like :find || barcode = :barcode order by views desc limit $limit";
				$rows = $productClass->query($query, ['find' => $text, 'barcode' => $barcode]);
			} else {
				//get all
				//$limit = 10,$offset = 0,$order = "desc",$order_column = "id"
				$rows = $productClass->getAll($limit, 0, 'desc', 'views');
			}

			if ($rows) {

				foreach ($rows as $key => $row) {

					$rows[$key]['description'] = strtoupper($row['description']);
					$rows[$key]['image'] = crop($row['image']);
				}

				$info['data_type'] = "search";
				$info['data'] = $rows;

				echo json_encode($info);
			}
		} else
		if ($OBJ['data_type'] == "checkout") {

			$data 		= $OBJ['text'];
			$receipt_no 	= get_receipt_no();
			$user_id 	= auth("id");
			$date 		= date("Y-m-d H:i:s");

			$db = new Database();

			//read from database
			foreach ($data as $row) {

				$arr = [];
				$arr['id'] = $row['id'];
				$query = "select * from products where id = :id limit 1";
				$check = $db->query($query, $arr);

				if (is_array($check)) {
					$check = $check[0];

					//save to database
					$arr = [];
					$arr['barcode'] 	= $check['barcode'];
					$arr['description'] = $check['description'];
					$arr['amount'] 		= $check['amount'];
					$arr['qty'] 		= $row['qty'];
					$arr['total'] 		= $row['qty'] * $check['amount'];
					$arr['receipt_no'] 	= $receipt_no;
					$arr['date'] 		= $date;
					$arr['user_id'] 	= $user_id;

					$query = "insert into sales (barcode,receipt_no,description,qty,amount,total,date,user_id) values (:barcode,:receipt_no,:description,:qty,:amount,:total,:date,:user_id)";
					$db->query($query, $arr);

					//add view count for this product
					$query = "update products set views = views + 1 where id = :id limit 1";
					$db->query($query, ['id' => $check['id']]);
				}
			}

			//barcode 	recipt_no 	description 	qty 	amount 	total 	date 	user_id 

			$info['data_type'] = "checkout";
			$info['data'] = "items saved successfully!";

			echo json_encode($info);
		}

		if ($OBJ['data_type'] == "show_data") {
			$orders_class = new Orders;
			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "orders_id");

			$info['data_type'] = "show_data";
			$info['data'] = $order;

			echo json_encode($info);
		}

		if ($OBJ['data_type'] == "add_one") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['table_id'] = $OBJ['table_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'orders_id');





			if ($order_exist) {


				$order_data['orders_id'] = $order_exist[0]['orders_id'];
				$order_data['menu_id'] = $order_exist[0]['menu_id'];
				$order_data['table_id'] = $order_exist[0]['table_id'];
				$order_data['onhold_qty'] = $order_exist[0]['onhold_qty'] + 1;
				$order_data['served_qty'] = $order_exist[0]['served_qty'];
				
				$query = "UPDATE orders
				SET orders_id = :orders_id, menu_id =:menu_id, table_id =:table_id, onhold_qty =:onhold_qty, served_qty =:served_qty 
				WHERE orders_id =:orders_id AND menu_id =:menu_id AND table_id =:table_id";
				$orders_class->query($query, $order_data);

				$order_id = $OBJ['orders_id'];
				$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "orders_id");

				$info['data_type'] = "add_one";
				$info['data'] = $order;

				echo json_encode($info);
			}
		}
	}
}
