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
	<!-- ON-HOLD Section -->
	<div class="col-4 bg-light p-2 pt-2 h-100">
		<div class="side">
			<h1 style="font-size: 36px">On-hold</h1> <button type="button" class="js-onhold_qty btn btn-primary btn-circle btn-xl">99</button>
		</div>
		<hr class="side">
		<div class="table-responsive overflow-auto" style="height:450px;">
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
							<button onclick="" class="btn btn-info my-2 w-100 py-5" style="font-size: 36px; font-weight: 700">Back</button>
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
	<!--./ On-hold Section ./-->


	<!-- MENU Section -->
	<div style="height: 760px" class="shadow-sm col-5 p-2">

		<div class="js-table"> </div> 

		<div class="js-select" style="padding: 10px"> </div>

		<div onclick="add_menu(event)" class="js-menu d-flex overflow-auto flex-wrap" style="height: 600px;">


		</div>
	</div>
	<!--./ MENU Section ./-->

	<!-- Served Section -->
	<div class="col-3 bg-gray p-2 pt-1" style="height: 100%;">

		<div class="side">
			<h1 style="color:white; font-size: 36px">Served</h1> <button type="button" class="js-served_qty btn btn-primary btn-circle btn-xl">99</button>
		</div>
		<hr class="side">
		<div class="table-responsive" style="height:386px;overflow-y: scroll;">
			<table class="tableServed tableServed-striped table-hover">
				<tbody class="js-served">
				</tbody>
			</table>
		</div>
		<div class="js-gtotal total total-purchase my-2" style="font-size:24px; font-weight:bold; color:#CC3300">Total: ฿ 0.00</div>
		<div class="js-checkout">
			<button onclick="show_modal('amount-paid')" class="btn btn-primary my-2 w-100">Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100">Clear All</button>
		</div>
	</div>
	<!--./ Served Section ./-->
</div>

<!--modals-->

<!--enter amount modal-->
<div role="close-button" onclick="hide_modal(event,'amount-paid')" class="js-amount-paid-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div style="width:500px;min-height:200px;background-color:white;padding:10px;margin:auto;margin-top:100px">
		<h4>Checkout <button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-danger float-end p-0 px-2">X</button></h4>
		<br>
		<input onkeyup="if(event.keyCode == 13)validate_amount_paid(event)" type="number" class="js-amount-paid-input form-control" placeholder="Enter amount paid">
		<br>
		<button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-secondary">Cancel</button>
		<button onclick="validate_amount_paid(event)" class="btn btn-primary float-end">Next</button>
	</div>
</div>
<!--end enter amount modal-->

<!--change modal-->
<div role="close-button" onclick="hide_modal(event,'change')" class="js-change-modal hide" style="animation: appear .5s ease;background-color: #000000bb; width: 100%;height: 100%;position: fixed;left:0px;top:0px;z-index: 4;">

	<div class="container m-auto bg-white" style="width:500px;min-height:200px;padding:10px;margin-top:100px">
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
	
	var GTOTAL = 0;
	var CHANGE = 0;
	var RECEIPT_WINDOW = null;
	

	/////////////////////////////////
	// Fetch menu for first run
	/////////////////////////////////
	show_menu("all");
	refresh_order_display();
	refresh_served_display();
	refresh_qty_count()
	refresh_checkout_button();
	show_table_id();

	/////////////////////////////////
	// Filter menu with food type
	/////////////////////////////////
	function button_html(menu_type) {

		if (menu_type == "all") {
			var html = `<button type="button" class="btn btn-primary btn-lg" onclick="show_menu('all')">ALL</button> `;
		}
		else
		{
			var html = `<button type="button" class="btn btn-secondary btn-lg" onclick="show_menu('all')">ALL</button> `;
		}

		for(var i = 0; i < MENU_TYPE.length; i++)
		{
			if(menu_type == MENU_TYPE[i]['menu_type'])
			{
				html += `<button type="button" class="btn btn-primary btn-lg" onclick="show_menu('${MENU_TYPE[i]['menu_type']}')">${MENU_TYPE[i]['menu_type'].toUpperCase()}</button> `;	
			}
			else
			{
				html += `<button type="button" class="btn btn-secondary btn-lg" onclick="show_menu('${MENU_TYPE[i]['menu_type']}')">${MENU_TYPE[i]['menu_type'].toUpperCase()}</button> `;	
			}
		}
		
		return html;
	}

	function menu_html(data) {

		return `
	<!--card-->
	<div class="card m-1 border-0 mx-auto my-1 menu_size">
		<a href="#">
			<img menu_id="${data.menu_id}" src="${data.menu_img}" class="w-100 rounded border">
		</a>
		<div class="p-2">
			<div class="text-muted">${data.menu_name}</div>
			<div class="" style="font-size:16px"><b>฿${data.menu_price.toFixed(2)}</b></div>
		</div>
	</div>
	<!--end card-->
	`;
	}

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
			<th menu_id=${menu.menu_id} style="padding-bottom: 5px; width: 100%">
				<div class="card-side m-auto border-0 mx-auto h-100" style="width: 100px;">
					<button onclick="clear_menu_onhold(${order.menu_id})" class="float-end btn btn-danger btn-lg py-3-1"><i class="fa fa-times"></i></button>
				</div>
				<div class="card-side m-auto border-0 mx-auto h-100" style="width: 100px;">
					<button onclick="serve(${order.menu_id},1)" class="btn btn-secondary my-1 py-3-1">Serve</button>
				</div>
			</th>
			<th menu_id=${menu.menu_id} style="padding-right: 0; padding-left: 0; padding-bottom: 0; padding-top: 5px; width: 100%" colspan="2">
				<div class="card-side m-auto border-0 mx-auto w-100" style="padding-right:3px">
					<button onclick="serve(${order.menu_id},${order.onhold_qty})" class="btn btn-success my-1 py-3-9">Serve All</button>
				</div>
			</th>
		</tr>
	</table>
	<!--end item-->
	`;
	}


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
				<button onclick="remove_serve_one(${order.menu_id},${order.served_qty})" class="float-end btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
				<div class = "float-end py-2" style="font-size:16px;font-weight: bold">฿ ${menu.menu_price.toFixed(2)}</div>
			</div>
		</td>
	</tr>
	<!--end item-->
	`;
	}

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

	function refresh_checkout_button() {
		var items_div = document.querySelector(".js-checkout");
		items_div.innerHTML = `
			<button onclick="show_modal('amount-paid')" class="btn btn-primary w-100 py-4" style="font-size: 36px; font-weight: 700" disabled>Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100" style="font-size: 36px; font-weight: 700">Clear All</button>
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
			<button onclick="show_modal('amount-paid')" class="btn btn-primary w-100 py-4" style="font-size: 36px; font-weight: 700">Checkout</button>
			<button onclick="remove_serve_all()" class="btn btn-danger my-2 w-100" style="font-size: 36px; font-weight: 700">Clear All</button>
			`;

		return;

	}

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

	/////////////////////////////////
	// TABLE & MENU Section
	/////////////////////////////////
	function show_table_id() {
		var button_div = document.querySelector(".js-table");
		if (ORDER_INFO['table_id'] != null)
			button_div.innerHTML = "<h1 class='text-center'>TABLE <p1 style='color:#CC3300'>"+ ORDER_INFO['table_id'] + "</p1></h1>";
	}

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