<?php require views_path('partials/header');
?>




<style>
	.hide {
		display: none;
	}

	@keyframes appear {

		0% {
			opacity: 0;
			transform: translateY(-100px);
		}

		100% {
			opacity: 1;
			transform: translateY(0px);
		}
	}
</style>
<div class="d-flex">

	<div class="col-3 bg-light p-2 pt-2">

		<div>
			<center>
				<h3>On-hold</h3>
			</center>
		</div>

		<div class="table-responsive" style="height:450px;overflow-y: scroll;">
			<table class="table table-striped table-hover">

				<tbody class="js-onhold">

				</tbody>
			</table>
		</div>

		<div class="">
			<button onclick="clear_onhold()" class="btn btn-danger my-2 w-100 py-4">Clear All</button>
			<button onclick="clear_onhold()" class="btn btn-success my-2 w-100 py-4">Serve All</button>
		</div>
	</div>


	<div style="min-height:600px;" class="shadow-sm col-6 p-4">

		<div class="js-select">

		</div>

		<div onclick="add_menu(event)" class="js-menu d-flex" style="flex-wrap: wrap;height: 90%;overflow-y: scroll;">


		</div>
	</div>

	<div class="col-3 bg-light p-4 pt-2">

		<div>
			<center>
				<h3>Cart</h3>
			</center>
		</div>

		<div class="table-responsive" style="height:400px;overflow-y: scroll;">
			<table class="table table-striped table-hover">
				<tr>
					<th>Image</th>
					<th>Description</th>
					<th>Amount</th>
				</tr>

				<tbody class="js-item">


				</tbody>
			</table>
		</div>

		<div class="js-gtotal alert alert-danger" style="font-size:30px">Total: $0.00</div>
		<div class="">
			<button onclick="show_modal('amount-paid')" class="btn btn-success my-2 w-100 py-4">Checkout</button>
			<button onclick="clear_all()" class="btn btn-primary my-2 w-100">Clear All</button>
		</div>
	</div>
</div>

<!--modals-->

<!--enter amount modal-->
<div role="close-button" onclick="hide_modal(event,'amount-paid')" class="js-amount-paid-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div style="width:500px;min-height:200px;background-color:white;padding:10px;margin:auto;margin-top:100px">
		<h4>Checkout <button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-danger float-end p-0 px-2">X</button></h4>
		<br>
		<input onkeyup="if(event.keyCode == 13)validate_amount_paid(event)" type="text" class="js-amount-paid-input form-control" placeholder="Enter amount paid">
		<br>
		<button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-secondary">Cancel</button>
		<button onclick="validate_amount_paid(event)" class="btn btn-primary float-end">Next</button>
	</div>
</div>
<!--end enter amount modal-->

<!--change modal-->
<div role="close-button" onclick="hide_modal(event,'change')" class="js-change-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div style="width:500px;min-height:200px;background-color:white;padding:10px;margin:auto;margin-top:100px">
		<h4>Change: <button role="close-button" onclick="hide_modal(event,'change')" class="btn btn-danger float-end p-0 px-2">X</button></h4>
		<br>
		<div class="js-change-input form-control text-center" style="font-size:60px">0.00</div>
		<br>
		<center><button role="close-button" onclick="hide_modal(event,'change')" class="js-btn-close-change btn btn-lg btn-secondary">Continue</button></center>
	</div>
</div>
<!--end change modal-->


<!--end modals-->

<script>
	var PRODUCTS = [];
	var ITEMS = [];
	var BARCODE = false;
	var GTOTAL = 0;
	var CHANGE = 0;
	var RECEIPT_WINDOW = null;

	//fetch menu for first run
	show_menu("all");
	refresh_order_display();

	function show_menu(menu_type) {
		//console.log(menu_type);
		var button_div = document.querySelector(".js-select");
		button_div.innerHTML = button_html(menu_type);

		var mydiv = document.querySelector(".js-menu");

		mydiv.innerHTML = "";

		var mydiv = document.querySelector(".js-menu");
		for (var i = 0; i < MENU.length; i++) {
			if (menu_type != "all") {

				if (menu_type != MENU[i]['menu_type']) {

					continue;
				}
			}

			mydiv.innerHTML += menu_html(MENU[i]);
		}



	}

	


	function send_data(data) {

		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(e) {

			if (ajax.readyState == 4) {


				if (ajax.status == 200) {
					if (ajax.responseText.trim() != "") {
						console.log(ajax.responseText);
						handle_result(ajax.responseText);
					} else {

					}
				} else {

					console.log("An error occured. Err Code:" + ajax.status + " Err message:" + ajax.statusText);
					console.log(ajax);
				}

			}

		});

		ajax.open('post', 'index.php?pg=ajax', true);
		ajax.send(JSON.stringify(data));
	}
	

	function handle_result(result) {

		//console.log(result);
		var obj = JSON.parse(result);
		if (typeof obj != "undefined") {

			if (obj.data_type == "show_data") {
				console.log(obj.data);
			}
			if (obj.data_type == "add_one" || obj.data_type == "down_one" ||
				obj.data_type == "remove_onhold" || obj.data_type == "update_onhold") {
				//console.log(ORDER);
				ORDER = obj.data;
				//console.log(ORDER);
				refresh_order_display();
			}

		}

	}

	function show_data(number, orders_id) {
		send_data({
			data_type: "show_data",
			orders_id: orders_id,
			number: number
		});

	}

	function button_html(menu_type) {

		var all_button = `<button type="button" class="btn btn-secondary btn-lg" onclick="show_menu('all')">ALL</button> `;
		var food_button = `<button type="button" class="btn btn-secondary btn-lg" onclick="show_menu('food')">FOOD</button> `;
		var drink_button = `<button type="button" class="btn btn-secondary btn-lg" onclick="show_menu('drink')">DRINK</button> `;

		if (menu_type == "all") {
			var all_button = `<button type="button" class="btn btn-primary btn-lg" onclick="show_menu('all')">ALL</button> `;
		} else if (menu_type == "food") {
			var food_button = `<button type="button" class="btn btn-primary btn-lg" onclick="show_menu('food')">FOOD</button> `;
		} else if (menu_type == "drink") {
			var drink_button = `<button type="button" class="btn btn-primary btn-lg" onclick="show_menu('drink')">DRINK</button> `;
		}
		return all_button + food_button + drink_button;

	}

	function menu_html(data) {

		return `
			<!--card-->
			<div class="card m-2 border-0 mx-auto" style="min-width: 128;max-width: 128;">
				<a href="#">
					<img id="${data.id}" src="${data.image}" class="w-100 rounded border">
				</a>
				<div class="p-2">
					<div class="text-muted">${data.description}</div>
					<div class="" style="font-size:20px"><b>$${data.amount}</b></div>
				</div>
			</div>
			<!--end card-->
			`;


	}

	function onhold_html(menu, order) {

		return `
			<!--item-->
			<tr>
				
				<td class="text-primary">
					${menu.description}

					<div class="input-group input-group-sm my-3" style="max-width:150px">
					  <span id="${menu.id}" onclick="change_qty('down',event)" class="input-group-text" style="cursor: pointer;"><i class="fa fa-minus text-primary"></i></span>
					  <input id="${menu.id}" onblur="change_qty('input',event)" type="number" class="form-control text-primary" placeholder="1" value="${order.onhold_qty}" >
					  <span id="${menu.id}" onclick="change_qty('up',event)" class="input-group-text" style="cursor: pointer;"><i class="fa fa-plus text-primary"></i></span>
					</div>

				</td>
				<td >
					<button onclick="clear_menu_onhold(${order.menu_id})" class="float-end btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
				</td>
			</tr>
			<!--end item-->
			`;



	}



	function add_menu_id(menu_id) {
		data = {
			data_type: 'add_one',
			orders_id: ORDER_INFO['orders_id'],
			table_id: ORDER_INFO['table_id'],
			menu_id: menu_id
		};
		send_data(data);
	}

	function down_menu_id(menu_id) {
		data = {
			data_type: 'down_one',
			orders_id: ORDER_INFO['orders_id'],
			table_id: ORDER_INFO['table_id'],
			menu_id: menu_id
		};
		send_data(data);
	}

	function update_menu_id(menu_id,qty) {
		data = {
			data_type: 'update_onhold',
			orders_id: ORDER_INFO['orders_id'],
			table_id: ORDER_INFO['table_id'],
			menu_id: menu_id,
			onhold_qty: qty
		};
		send_data(data);
	}

	function clear_menu_onhold(menu_id,type = 'one') {
		if (type == 'one' && !confirm("Remove item??!!"))
			return;

		data = {
			data_type: 'remove_onhold',
			orders_id: ORDER_INFO['orders_id'],
			table_id: ORDER_INFO['table_id'],
			menu_id: menu_id
		};

		send_data(data);

	}

	function add_menu(e) {

		if (e.target.tagName == "IMG") {
			var menu_id = e.target.getAttribute("id");

			add_menu_id(menu_id);

		}
	}

	function refresh_order_display() {


		var items_div = document.querySelector(".js-onhold");
		items_div.innerHTML = "";

		for (var i = 0; i < ORDER.length ; i++) {

			if (ORDER[i]['onhold_qty'] > 0) {
				for (var j = MENU.length - 1; j >= 0; j--) {
					//console.log(ORDER[i]['menu_id'], MENU[j]['id'], i, j);

					if (ORDER[i]['menu_id'] == MENU[j]['id']) {
						items_div.innerHTML += onhold_html(MENU[j], ORDER[i]);
					}

				}
			}
		}

	}

	function clear_onhold() {

		if (!confirm("Are you sure you want to clear all items in the ON HOLD list??!!"))
			return;

		for(var i = ORDER.length - 1 ; i>=0 ; i--)
		{
			clear_menu_onhold(ORDER[i].menu_id,'remove-all');
		}

	}


	function change_qty(direction, e) {


		var id = e.currentTarget.getAttribute("id");
		//console.log("Delete",id);
		if (direction == "up") {
			add_menu_id(id);
		} else if (direction == "down") {
			down_menu_id(id);
		} else {
			var qty = parseInt(e.currentTarget.value);
			if(!(qty>0))
			{
				qty = 1;
			}
			update_menu_id(id,qty);
		}
	}


	function show_modal(modal) {

		if (modal == "amount-paid") {

			if (ITEMS.length == 0) {

				alert("Please add at least one item to the cart");
				return;
			}
			var mydiv = document.querySelector(".js-amount-paid-modal");
			mydiv.classList.remove("hide");

			mydiv.querySelector(".js-amount-paid-input").value = "";
			mydiv.querySelector(".js-amount-paid-input").focus();
		} else
		if (modal == "change") {

			var mydiv = document.querySelector(".js-change-modal");
			mydiv.classList.remove("hide");

			mydiv.querySelector(".js-change-input").innerHTML = CHANGE;
			mydiv.querySelector(".js-btn-close-change").focus();
		}


	}

	function hide_modal(e, modal) {

		if (e == true || e.target.getAttribute("role") == "close-button") {
			if (modal == "amount-paid") {
				var mydiv = document.querySelector(".js-amount-paid-modal");
				mydiv.classList.add("hide");
			} else
			if (modal == "change") {
				var mydiv = document.querySelector(".js-change-modal");
				mydiv.classList.add("hide");
			}

		}

	}

	function validate_amount_paid(e) {

		var amount = e.currentTarget.parentNode.querySelector(".js-amount-paid-input").value.trim();

		if (amount == "") {
			alert("Please enter a valid amount");
			document.querySelector(".js-amount-paid-input").focus();
			return;
		}

		amount = parseFloat(amount);
		if (amount < GTOTAL) {

			alert("Amount must be higher or equal to the total");
			return;
		}

		CHANGE = amount - GTOTAL;
		CHANGE = CHANGE.toFixed(2);

		hide_modal(true, 'amount-paid');
		show_modal('change');

		//remove unwanted information
		var ITEMS_NEW = [];
		for (var i = 0; i < ITEMS.length; i++) {

			var tmp = {};
			tmp.id = ITEMS[i]['id'];
			tmp.qty = ITEMS[i]['qty'];

			ITEMS_NEW.push(tmp);
		}

		//send cart data through ajax
		send_data({

			data_type: "checkout",
			text: ITEMS_NEW
		});

		//open receipt page
		print_receipt({
			company: 'My POS',
			amount: amount,
			change: CHANGE,
			gtotal: GTOTAL,
			data: ITEMS
		});

		//clear items
		ITEMS = [];
		refresh_items_display();

		//reload products
		/*
		send_data({

			data_type: "search",
			text: ""
		});*/
	}

	function print_receipt(obj) {
		var vars = JSON.stringify(obj);

		RECEIPT_WINDOW = window.open('index.php?pg=print&vars=' + vars, 'printpage', "width=500px;");

		setTimeout(close_receipt_window, 2000);

	}

	function close_receipt_window() {
		RECEIPT_WINDOW.close();
	}
	/*
		send_data({

			data_type: "search",
			text: ""
		});*/
</script>

<?php require views_path('partials/footer'); ?>