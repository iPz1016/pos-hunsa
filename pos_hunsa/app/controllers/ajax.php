<?php

defined("ABSPATH") ? "" : die();

//capture ajax data
$raw_data = file_get_contents("php://input");
//echo $raw_data;
if (!empty($raw_data)) {

	$OBJ = json_decode($raw_data, true);
	if (is_array($OBJ)) {

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

		if ($OBJ['data_type'] == "add_one") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'menu_id');

			if ($order_exist) {

				$order_exist[0]['onhold_qty'] = $order_exist[0]['onhold_qty'] + 1;
				$orders_class->update_order($order_exist[0]);

			} else {
				//INSERT NEW DATA
				$order_data['orders_id'] =  $OBJ['orders_id'];
				$order_data['menu_id'] = $OBJ['menu_id'];
				$order_data['table_id'] = $OBJ['table_id'];
				$order_data['onhold_qty'] = 1;
				$order_data['served_qty'] = 0;
				$orders_class->insert($order_data);
			}

			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "add_one";
			$info['data'] = $order;
			echo json_encode($info);
		}


		if ($OBJ['data_type'] == "down_one") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'orders_id');

			if ($order_exist) {

				$order_exist[0]['onhold_qty'] = $order_exist[0]['onhold_qty'] - 1;

				//DELETE ORDER IF MENU QTY < 0 
				if ($order_exist[0]['onhold_qty'] <= 0 && $order_exist[0]['served_qty'] <= 0) {

					
					$delete_data['orders_id'] = $order_exist[0]['orders_id'];
					$delete_data['menu_id'] = $order_exist[0]['menu_id'];

					$orders_class->delete_order($delete_data);
				} else {
					$orders_class->update_order($order_exist[0]);
				}
			}

			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "down_one";
			$info['data'] = $order;
			echo json_encode($info);
		}

		if ($OBJ['data_type'] == "update_onhold") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'menu_id');

			if ($order_exist) {

				$order_exist[0]['onhold_qty'] = $OBJ['onhold_qty'];
				$orders_class->update_order($order_exist[0]);
			}
			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "add_one";
			$info['data'] = $order;
			echo json_encode($info);
		}


		if ($OBJ['data_type'] == "remove_onhold") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'menu_id');

			if ($order_exist) {
				
				$order_exist[0]['onhold_qty'] = 0;
				
				//DELETE ORDER IF MENU QTY <= 0 
				if ($order_exist[0]['onhold_qty'] <= 0 && $order_exist[0]['served_qty'] <= 0) {

					$delete_data['orders_id'] = $order_exist[0]['orders_id'];
					$delete_data['menu_id'] = $order_exist[0]['menu_id'];
					$orders_class->delete_order($delete_data);

				} else {
					$orders_class->update_order($order_exist[0]);
				}
			}

			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "down_one";
			$info['data'] = $order;
			echo json_encode($info);
		}

		if ($OBJ['data_type'] == "serve") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'menu_id');

			if ($order_exist) {
				$qty = $OBJ['qty'];

				$order_exist[0]['onhold_qty'] = $order_exist[0]['onhold_qty'] - $qty;
				$order_exist[0]['served_qty'] = $order_exist[0]['served_qty'] + $qty;

				if ($order_exist[0]['onhold_qty'] < 0) {
					$order_exist[0]['served_qty'] = $order_exist[0]['served_qty'] + $order_exist[0]['onhold_qty'];
					$order_exist[0]['onhold_qty'] = 0;
				}

				// Update to database
				$orders_class->update_order($order_exist[0]);
			}

			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "serve";
			$info['data'] = $order;
			echo json_encode($info);
		}

		if ($OBJ['data_type'] == "remove_serve") {
			$orders_class = new Orders;

			$data['orders_id'] = $OBJ['orders_id'];
			$data['menu_id'] = $OBJ['menu_id'];

			$order_exist = $orders_class->where($data, 1, 0, 'asc', 'menu_id');

			if ($order_exist) {
				$qty = $OBJ['qty'];

				$order_exist[0]['served_qty'] = $order_exist[0]['served_qty'] - $qty;

				if ($order_exist[0]['served_qty'] < 0) {
					$order_exist[0]['served_qty'] = 0;
				}

				// Update to database

				if ($order_exist[0]['onhold_qty'] <= 0 && $order_exist[0]['served_qty'] <= 0) {

					$delete_data['orders_id'] = $order_exist[0]['orders_id'];
					$delete_data['menu_id'] = $order_exist[0]['menu_id'];

					$orders_class->delete_order($delete_data);
				} else {
					$orders_class->update_order($order_exist[0]);
				}
			}

			// REFRESH ORDER 

			$order_id = $OBJ['orders_id'];
			$order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
			$info['data_type'] = "remove_serve";
			$info['data'] = $order;
			echo json_encode($info);
		}
	}
}
