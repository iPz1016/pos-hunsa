// Send data to ajax.php 
function send_data(data) {
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function (e) {

        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                if (ajax.responseText.trim() != "") {
                    //console.log(ajax.responseText);
                    handle_result(ajax.responseText);
                }
            } else {
                console.log("An error occured. Err Code:" + ajax.status + " Err message:" + ajax.statusText);
                //console.log(ajax);
            }
        }
    });
    ajax.open('post', 'index.php?pg=ajax', true);
    ajax.send(JSON.stringify(data));
}


// Handle result for ajax.php 
function handle_result(result) {
    //console.log(result);
    var obj = JSON.parse(result);
    if (typeof obj != "undefined") {
        if (obj.data_type == "add_one" || obj.data_type == "down_one" ||
            obj.data_type == "remove_onhold" || obj.data_type == "update_onhold" ||
            obj.data_type == "serve" || obj.data_type == "remove_serve") {
            //console.log(ORDER);
            ORDER = obj.data;
            refresh_order_display();
            refresh_served_display();
            refresh_checkout_button();
            refresh_qty_count();
        }
    }
}

// Add 1-menu order to On-hold menu using menu_id
function add_menu_id(menu_id) {
    data = {
        data_type: 'add_one',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}

// Reduce 1-menu order from On-hold menu using menu_id
function down_menu_id(menu_id) {
    data = {
        data_type: 'down_one',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}

// Update Number of Menu from On-hold menu using menu_id
function update_menu_id(menu_id, qty) {
    data = {
        data_type: 'update_onhold',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id,
        onhold_qty: qty
    };
    send_data(data);
}


// Remove menu from On-hold menu using menu_id
function clear_menu_onhold(menu_id) {
    data = {
        data_type: 'remove_onhold',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}

// Remove menu from Serve menu using menu_id
function remove_serve(menu_id = 0, qty = 'all') {

    if (qty == 'all') {
        for (var i = 0; i < ORDER.length; i++) {
            remove_serve(ORDER[i]['menu_id'], ORDER[i]['served_qty']);
        }
        return;
    }
    data = {
        data_type: 'remove_serve',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id,
        qty: qty,
    };

    send_data(data);
}

// Remove menu from all Serve menu
function remove_serve_all() {
    if (!confirm("Are you sure you want to clear all items in the SERVED list?"))
        return;
    remove_serve();
}

// Remove 1 Served menu using menu_id
function remove_serve_one(menu_id, qty) {
    remove_serve(menu_id, qty);
}

// Reduce On-hold Menu's number and add to Served menu
function serve(menu_id = 0, qty = 'all') {

    if (qty == 'all') {
        for (var i = 0; i < ORDER.length; i++) {
            serve(ORDER[i]['menu_id'], ORDER[i]['onhold_qty']);
        }
        return;
    }

    data = {
        data_type: 'serve',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id,
        qty: qty,
    };

    send_data(data);
}

// Serve all On-hold menu
function serve_all() {
    if (!confirm("Are you sure you want to serve all items in the ON HOLD list??!!"))
        return;
    serve();
}


// Add one menu to on-hold menu from clicking an images
function add_menu(e) {

    if (e.target.tagName == "IMG") {
        var menu_id = e.target.getAttribute("menu_id");
        add_menu_id(menu_id);
    }
}

// Remove all On-hold menu
function clear_onhold() {
    if (!confirm("Are you sure you want to clear all items in the ON HOLD list??!!"))
        return;
    for (var i = ORDER.length - 1; i >= 0; i--) {
        clear_menu_onhold(ORDER[i].menu_id, 'remove-all');
    }
}

// Change On-hold quantity by clicking arrow
function change_qty(direction, e) {
    var id = e.currentTarget.getAttribute("menu_id");
    //console.log("Delete",id);
    if (direction == "up") {
        add_menu_id(id);
    } else if (direction == "down") {
        down_menu_id(id);
    } else {
        var qty = parseInt(e.currentTarget.value);
        if (!(qty > 0)) {
            qty = 1;
        }
        update_menu_id(id, qty);
    }
}

// Show Modal popup
function show_modal(modal) {

    if (modal == "amount-paid") {
        if (ORDER.length == 0) {

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

// Hide Modal popup
function hide_modal(e, modal) {

    if (e == true || e.target.getAttribute("role") == "close-button") {
        if (modal == "amount-paid") {
            var mydiv = document.querySelector(".js-amount-paid-modal");
            mydiv.classList.add("hide");
        } else {
            if (modal == "change") {
                var mydiv = document.querySelector(".js-change-modal");
                mydiv.classList.add("hide");
                window.location.href = "index.php?pg=home";
            }
        }
    }
}


// Check the amount of paid and refer to receipt page
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

    //Open receipt page
    print_receipt({
        amount: amount,
        change: CHANGE,
        gtotal: GTOTAL,
        orders_id: ORDER_INFO['orders_id']
    });
}

// Open a receipt window and passing order information
function print_receipt(obj) {
    var vars = JSON.stringify(obj);
    RECEIPT_WINDOW = window.open('index.php?pg=print&vars=' + vars, 'printpage', "width=500px;");
    setTimeout(close_receipt_window, 2000);

}

// close reciept window
function close_receipt_window() {
    RECEIPT_WINDOW.close();
}
