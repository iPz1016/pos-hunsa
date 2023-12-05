<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$WshShell = new COM("WScript.Shell");
	///$obj = $WshShell->Run("cmd /c wscript.exe www/public/file.vbs",0, true); 
	$obj = $WshShell->Run("cmd /c wscript.exe " . ABSPATH . "/file.vbs", 0, true);

	$WshShell = new COM("WScript.Shell");
	///$obj = $WshShell->Run("cmd /c wscript.exe www/public/file.vbs",0, true); 
	$obj = $WshShell->Run("cmd /c wscript.exe " . ABSPATH . "/file.vbs", 0, true);
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= esc(APP_NAME) ?></title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>

<body>
	<?php

	// Get the 'vars' parameter from the GET request or set it to an empty string
	$vars = $_GET['vars'] ?? "";
	$obj = json_decode($vars, true);
	
	// Query to fetch order information based on orders_id
	$db_class = new Database;
	$query = "SELECT o.orders_id,o.table_id,m.menu_id,m.menu_name,o.served_qty,m.menu_price 
		FROM orders o,menu_info m 
		WHERE o.menu_id=m.menu_id and orders_id = :orders_id";
	$data['orders_id'] = $obj['orders_id'];
	
	// Execute the query and fetch the results into the $order variable
	$order = $db_class->query($query, $data);
	?>

	<?php if (is_array($order)) : ?>

		<div class="text-center justify-content-center">
			<?php echo "<img  src='" . APP_LOGO_WITH_TEXT . "' width='100' height='100'>"; ?>
			<h1><?php echo APP_NAME; ?></h1>
			<h4>Receipt</h4>
			<div>
				<i>
					<?php
					$datetime = new DateTime();
					$timezone = new DateTimeZone(TIME_ZONE);
					$datetime->setTimezone($timezone);
					$current_datetime = $datetime->format("jS F, Y H:i a");
					$sql_datetime = $datetime->format('Y-m-d H:i:s');
					echo $current_datetime;
					
					?>
				</i>
			</div>
		</div>

		
		<!-- Table header -->
		<table class="table table-striped">
			<tr class="fs-5">
				<th class="fw-black">Qty</th>
				<th class="fw-black">Menu name</th>
				<th class="fw-black">Price per item</th>
				<th class="fw-black">Total amount</th>
			</tr>

			<!-- Loop through each orders item -->
			<?php foreach ($order as $row) : ?>
				<tr>
					<!-- Display quantity -->
					<td><?= $row['served_qty'] ?></td>
					<!-- Display menu name -->
					<td><?= $row['menu_name'] ?></td>
					<!-- Display price per item  -->
					<td>฿<?= number_format($row['menu_price'], 2) ?></td>
					<!-- Display total amount for the item ->
					<td>฿<?= number_format($row['served_qty'] * $row['menu_price'], 2) ?></td>
				</tr>
			<?php endforeach; ?>

			<!-- Display total line -->
			<tr>
				<td colspan="2"></td>
				<td><b>Total:</b></td>
				<!-- Display total amount with two decimal points -->
				<td><b>฿<?= number_format($obj['gtotal'], 2) ?></b></td>
			</tr>
			<!-- Display amount paid line with two decimal points -->
			<tr>
				<td colspan="2"></td>
				<td>Amount paid:</td>
				<td>฿<?= number_format($obj['amount'], 2) ?></td>
			</tr>
			<!-- Display change for customer with two decimal points -->
			<tr>
				<td colspan="2"></td>
				<td>Change:</td>
				<td>฿<?= number_format($obj['change'], 2) ?></td>
			</tr>
		</table>

		<div class="text-center">
			<p><i>Thank you for dining with us!</i></p>
		</div>
		<?php

		//insert to history
		$insert_data['orders_id'] = $row['orders_id'];
		$insert_data['table_id'] = $row['table_id'];
		$insert_data['staff_id'] = Auth::get('id');
		$insert_data['time'] = $sql_datetime;

		foreach ($order as $row) {
			$insert_data['menu_id'] = $row['menu_id'];
			$insert_data['menu_name'] = $row['menu_name'];
			$insert_data['qty'] = $row['served_qty'];
			$insert_data['menu_price'] = $row['menu_price'];
			$history_class = new History;
			$history_class->insert($insert_data);
		}

		//delete orders 
		$orders_class = new Orders;
		$orders_class->delete_all_order($data);


		?>
	<?php endif; ?>

	<script>
		window.print();

		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function() {

			if (ajax.readyState == 4) {
				//console.log(ajax.responseText);
			}
		});

		ajax.open('POST', '', true);
		//ajax.send();
	</script>
</body>

</html>