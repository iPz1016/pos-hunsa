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
<div class="d-flex h-100">

	<!-- ON-HOLD Section -->
	<div class="col-4 bg-light p-2 pt-2">
		<div class="side">
			<h1 style="font-size: 36px">On-hold</h1> <button type="button" class="js-onhold_qty btn btn-primary btn-circle btn-xl">99</button>
		</div>
		<hr class="side">
		<!-- .h-onhold is in bootstrap.min.css : Used to manage all on-hold scrolling sizes -->
		<div class="table-responsive h-onhold overflow-auto">
			<table class="table table-striped table-hover">

				<tbody class="js-onhold">

				</tbody>
			</table>
		</div>

		<div class="my-2">
			<table style="width: 100%;">
				<tr>
					<th style="width: 30%" colspan="2">
						<a href="index.php?pg=home">
							<div class="card-side m-auto border-0 mx-auto" style="width: 100%; height: 100%; padding-right:5px">
								<button onclick="" class="btn btn-info my-2 w-100 py-4-5" style="font-size: 28px; font-weight: 700"><i class="fa fa-arrow-alt-circle-left"></i> Back</button>
							</div>
						</a>
					</th>
					<th menu_id=${menu.menu_id}>
						<div class="card-side m-auto border-0 mx-auto" style="padding-top: 5px; width: 100%; height: 100%">
							<button onclick="serve_all()" class="btn btn-success w-100 py-2" style="font-size: 36px; font-weight: 700">Serve All</button>
						</div>
						<div class="card-side m-auto border-0 mx-auto" style="width: 100%; height: 100%">
							<button onclick="clear_onhold()" class="btn btn-danger my-2 w-100 py-2" style="font-size: 36px; font-weight: 700">Clear All</button>
						</div>
					</th>
				</tr>
			</table>

		</div>
	</div>
	<!-- ON-HOLD Section -->


	<!-- MENU Section -->
	<div class="shadow-sm overflow-auto col-5 p-2">

		<!-- Table number -->
		<div class="js-table"> </div>

		<!-- Filter button -->
		<!-- if filter button more than 8 qty, added "d-flex" to the class for good usability -->
		<div class="js-select filter-tab overflow-auto pb-2"> </div>

		<!-- All menu that we have -->
		<!-- .h-menu is in bootstrap.min.css : used to manage all menu scrolling sizes -->
		<div onclick="add_menu(event)" class="js-menu h-menu d-flex overflow-auto flex-wrap px-2-1"> </div>
	</div>
	<!--End MENU Section -->

	<!-- SERVED Section -->
	<div class="col-3 bg-gray p-2 pt-1" style="height: 100%;">

		<div class="side">
			<h1 style="color:white; font-size: 36px">Served</h1> <button type="button" class="js-served_qty btn btn-primary btn-circle btn-xl">99</button>
		</div>
		<hr class="side">
		<div class="table-responsive" style="height:377px;overflow-y: scroll;">
			<table class="tableServed tableServed-striped table-hover">
				<tbody class="js-served">
				</tbody>
			</table>
		</div>
		<div class="js-gtotal total total-purchase my-2" style="font-size:24px; font-weight:bold; color:#CC3300">Total: ฿ 0.00</div>
		<div class="js-checkout">
			<button onclick="show_modal('amount-paid')" class="btn btn-primary my-2 w-100"><i class="fa fa-user"></i>Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100">Clear All</button>
		</div>
	</div>
	<!-- End SERVED Section -->
</div>

<!--Modals-->

<!-- Enter Amount Modal-->
<div role="close-button" onclick="hide_modal(event,'amount-paid')" class="js-amount-paid-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div class="amount-paid">
		<h3>Amount paid</h3>
		<br>
		<input onkeyup="if(event.keyCode == 13)validate_amount_paid(event)" type="number" class="js-amount-paid-input form-control" placeholder="Enter amount paid">
		<br>
		<button onclick="validate_amount_paid(event)" class="btn btn-primary btn-lg float-end">Submit</button>
		<button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-danger btn-lg float-start">Cancel</button>
	</div>
</div>
<!--End Enter Amount Modal-->

<!--Change Modal-->
<div role="close-button" onclick="hide_modal(event,'change')" class="js-change-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div class="change">
		<h3>Change</h3>
		<br>
		<div class="js-change-input form-control text-center" style="font-size: 60px; font-weight: 700;">0.00</div>
		<br>
		<button role="close-button" onclick="hide_modal(event,'change')" class="js-btn-close-change btn btn-lg btn-success float-end">Continue</button>
	</div>
</div>
<!--End Change Modal-->


<!--End Modals-->

<script>
	
	var GTOTAL = 0;
	var CHANGE = 0;
	var RECEIPT_WINDOW = null;
	


	// Fetch menu for first run
	show_menu("all");
	refresh_order_display();
	refresh_served_display();
	refresh_qty_count()
	refresh_checkout_button();
	show_table_id();

	
	// Filter menu with food type
	function button_html(menu_type) {

		if (menu_type == "all") {
			var html = `<button type="button" class="btn btn-primary btn-lg mb-1" onclick="show_menu('all')">ALL</button> `;
		}
		else
		{
			var html = `<button type="button" class="btn btn-secondary btn-lg mb-1" onclick="show_menu('all')">ALL</button> `;
		}

		for(var i = 0; i < MENU_TYPE.length; i++)
		{
			if(menu_type == MENU_TYPE[i]['menu_type'])
			{
				html += `<button type="button" class="btn btn-primary btn-lg mb-1" onclick="show_menu('${MENU_TYPE[i]['menu_type']}')">${MENU_TYPE[i]['menu_type'].toUpperCase()}</button> `;	
			}
			else
			{
				html += `<button type="button" class="btn btn-secondary btn-lg mb-1" onclick="show_menu('${MENU_TYPE[i]['menu_type']}')">${MENU_TYPE[i]['menu_type'].toUpperCase()}</button> `;	
			}
		}
		
		return html;
	}

	// Card Of Menu
	function menu_html(data) {

		return `
	<!--card-->
	<div class="card-menu border-0 mx-2 my-1 h-40 menu_size">
		<a href="#">
			<img menu_id="${data.menu_id}" src="${data.menu_img}" class="w-100 rounded border">
		</a>
		<div class="card-menu-text p-2">
			<div class="" style="font-size:16px"><b>฿${data.menu_price.toFixed(2)}</b></div>
			<div class="text-muted">${data.menu_name}</div>
		</div>
	</div>
	<!--end card-->
	`;
	}

	// Card Of On-hold Menu
	function onhold_html(menu, order) {

		return `
	<!--item-->
	<table style="width: 100%;">
		<tr>
			<th class="text-primary w-100" menu_id=${menu.menu_id}>
				<div style="text-align: left" menu_id=${menu.menu_id}>
					${menu.menu_name}
				</div>
				<div class="qty mt-2 mw-100">
					<span menu_id="${menu.menu_id}" onclick="change_qty('down',event)" class="minus bg-danger" style="cursor: pointer;">-</span>
					<input menu_id="${menu.menu_id}" onblur="change_qty('input',event)" type="number" class="form-minus-plus count" placeholder="1" value="${order.onhold_qty}" >
					<span menu_id="${menu.menu_id}" onclick="change_qty('up',event)" class="plus bg-success" style="cursor: pointer;">+</i></span>

				</div>
			</th>
			<th menu_id=${menu.menu_id} style="width: 100%">
				<div class="card-side m-auto border-0 mx-auto h-100" style="width: 100px;">
					<button onclick="clear_menu_onhold(${order.menu_id})" class="float-end btn btn-danger btn-lg py-3-1"><i class="fa fa-trash"></i></button>
				</div>
				<div class="card-side m-auto border-0 mx-auto h-100" style="width: 100px;">
					<button onclick="serve(${order.menu_id},1)" class="btn btn-secondary my-1 py-3-1" style="font-weight: 700">Serve</button>
				</div>
			</th>
			<th menu_id=${menu.menu_id} style="padding-right: 0; padding-left: 0; padding-bottom: 0; padding-top: 5px; width: 100%" colspan="2">
				<div class="card-side m-auto border-0 mx-auto w-100" style="padding-right:3px">
					<button onclick="serve(${order.menu_id},${order.onhold_qty})" class="btn btn-success my-1 py-3-9" style="font-weight: 700">Serve All</button>
				</div>
			</th>
		</tr>
	</table>
	<!--end item-->
	`;
	}

	// Card Of Served Menu
	function served_html(menu, order) {

		return `
	<!--item-->
	<tr>
		<td class="text-served" menu_id=${order.menu_id}>
			<div class="text-start">
					${menu.menu_name}
			</div>
			<div class="qty mt-2" style="max-width:150px; margin-right: 10px">
				<span menu_id="${order.menu_id}" onclick="remove_serve(${order.menu_id},1)" class="minus bg-danger" style="cursor: pointer;">-</span>
				<input menu_id="${order.menu_id}" disabled type="number" class="form-minus-plus count" placeholder="1" value="${order.served_qty}" >
			</div>
		</td>
		<td menu_id=${order.menu_id} class="text-end">
			<div class="card-side m-auto border-0 mx-auto" style="min-width: 70px">
				<button onclick="remove_serve_one(${order.menu_id},${order.served_qty})" class="float-end btn btn-danger btn-sm py-3-1"><i class="fa fa-trash"></i></button>
				<div class = "float-end py-2" style="font-size:16px;font-weight: bold">฿ ${menu.menu_price.toFixed(2)}</div>
			</div>
		</td>
	</tr>
	<!--end item-->
	`;
	}
	

	// Refresh Cards Of Served Menu
	function refresh_served_display() {
		var items_div = document.querySelector(".js-served");
		items_div.innerHTML = "";

		var grand_total = 0;

		for (var i = 0; i < ORDER.length; i++) {
			if (ORDER[i]['served_qty'] > 0) {
				for (var j = MENU.length - 1; j >= 0; j--) {
					//console.log(ORDER[i]['menu_id'], MENU[j]['id'], i, j);
					if (ORDER[i]['menu_id'] == MENU[j]['menu_id']) {
						items_div.innerHTML += served_html(MENU[j], ORDER[i]);

						grand_total = grand_total + MENU[j]['menu_price'] * ORDER[i]['served_qty'];
					}
				}
			}
		}

		GTOTAL = grand_total;
		var gtotal_div = document.querySelector(".js-gtotal");
		gtotal_div.innerHTML = "Total: ฿ " + grand_total.toFixed(2);
	}

	// Refresh Cards Of On-hold Menu
	function refresh_order_display() {
		var items_div = document.querySelector(".js-onhold");
		items_div.innerHTML = "";
		for (var i = 0; i < ORDER.length; i++) {
			if (ORDER[i]['onhold_qty'] > 0) {
				for (var j = MENU.length - 1; j >= 0; j--) {
					//console.log(ORDER[i]['menu_id'], MENU[j]['id'], i, j);
					if (ORDER[i]['menu_id'] == MENU[j]['menu_id']) {
						items_div.innerHTML += onhold_html(MENU[j], ORDER[i]);
					}
				}
			}
		}
	}

	// Refresh Checkout Button
	function refresh_checkout_button() {
		var items_div = document.querySelector(".js-checkout");
		items_div.innerHTML = `
			<button onclick="show_modal('amount-paid')" class="btn btn-primary w-100 py-4" style="font-size: 36px; font-weight: 700" disabled><i class="fa fa-cart-arrow-down"></i> Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100" style="font-size: 36px; font-weight: 700" >Clear All</button>
			`;
		if (ORDER == false) {
			return;
		}

		for (var i = 0; i < ORDER.length; i++) {
			if (ORDER[i]['onhold_qty'] > 0) {
				return;
			}
		}

		items_div.innerHTML = `
			<button onclick="show_modal('amount-paid')" class="btn btn-primary w-100 py-4" style="font-size: 36px; font-weight: 700"><i class="fa fa-cart-arrow-down"></i> Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100" style="font-size: 36px; font-weight: 700">Clear All</button>
			`;

		return;

	}

	// Refresh Quantity Count of On-hold and Served Menu
	function refresh_qty_count()
	{
		var onhold_div = document.querySelector(".js-onhold_qty");
		var served_div = document.querySelector(".js-served_qty");
		var onhold_count = 0;
		var served_count = 0;
		for(var i = 0 ; i < ORDER.length ; i++)
		{
			if(ORDER[i]['onhold_qty']>0)
			{
				onhold_count++;
			}
			if(ORDER[i]['served_qty']>0)
			{
				served_count++;
			}
		}
		onhold_div.innerHTML = onhold_count.toString();
		served_div.innerHTML = served_count.toString();
	}


	// TABLE & MENU Section
	function show_table_id() {
		var button_div = document.querySelector(".js-table");
		if (ORDER_INFO['table_id'] != null)
			button_div.innerHTML = "<h1 class='text-center'>TABLE <p1 style='color:#CC3300'>"+ ORDER_INFO['table_id'] + "</p1></h1>";
	}

	// Refresh Menu Section For Selected Menu Type
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
</script>
<script src = "order.js"></script>

<?php require views_path('partials/footer'); ?>