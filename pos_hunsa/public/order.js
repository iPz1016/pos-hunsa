/////////////////////////////////
// send data to ajax.php 
/////////////////////////////////
function send_data(data) {

    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function (e) {

        if (ajax.readyState == 4) {


            if (ajax.status == 200) {
                if (ajax.responseText.trim() != "") {
                    //console.log(ajax.responseText);
                    handle_result(ajax.responseText);
                } else {

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

/////////////////////////////////
// handle result for ajax.php 
/////////////////////////////////
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

/////////////////////////////////
// add 1 menu to on-hold menu by menu id
/////////////////////////////////
function add_menu_id(menu_id) {
    data = {
        data_type: 'add_one',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}
/////////////////////////////////
// reduce 1 menu from on-hold menu by menu id
/////////////////////////////////
function down_menu_id(menu_id) {
    data = {
        data_type: 'down_one',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}

/////////////////////////////////
// update number of menu from on-hold menu by menu id
/////////////////////////////////
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

/////////////////////////////////
// remove menu from on-hold menu by menu id
/////////////////////////////////
function clear_menu_onhold(menu_id) {
    data = {
        data_type: 'remove_onhold',
        orders_id: ORDER_INFO['orders_id'],
        table_id: ORDER_INFO['table_id'],
        menu_id: menu_id
    };
    send_data(data);
}

/////////////////////////////////
// remove menu from serve menu by menu id
/////////////////////////////////
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

/////////////////////////////////
// remove menu from all serve menu
/////////////////////////////////
function remove_serve_all() {
    if (!confirm("Are you sure you want to clear all items in the SERVED list??!!"))
        return;
    remove_serve();
}

/////////////////////////////////
// remove 1 served menu by menu id
/////////////////////////////////
function remove_serve_one(menu_id, qty) {
    remove_serve(menu_id, qty);
}

/////////////////////////////////
// reduce on-hold menu's number
// and add to served menu
/////////////////////////////////
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

/////////////////////////////////
// serve all on-hold menu
/////////////////////////////////
function serve_all() {
    if (!confirm("Are you sure you want to serve all items in the ON HOLD list??!!"))
        return;
    serve();
}

/////////////////////////////////
// add one menu to on-hold menu 
// from clicking an images
/////////////////////////////////
function add_menu(e) {

    if (e.target.tagName == "IMG") {
        var menu_id = e.target.getAttribute("menu_id");

        add_menu_id(menu_id);

    }
}

/////////////////////////////////
// remove all on-hold menu
/////////////////////////////////
function clear_onhold() {
    if (!confirm("Are you sure you want to clear all items in the ON HOLD list??!!"))
        return;

    for (var i = ORDER.length - 1; i >= 0; i--) {
        clear_menu_onhold(ORDER[i].menu_id, 'remove-all');
    }

}

/////////////////////////////////
// change on-hold quantity 
// by clicking arrow
/////////////////////////////////
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

/////////////////////////////////
// show modal popup
/////////////////////////////////
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
/////////////////////////////////
// hide modal popup
/////////////////////////////////
function hide_modal(e, modal) {

    if (e == true || e.target.getAttribute("role") == "close-button") {
        if (modal == "amount-paid") {
            var mydiv = document.querySelector(".js-amount-paid-modal");
            mydiv.classList.add("hide");
        } else
            if (modal == "change") {
                var mydiv = document.querySelector(".js-change-modal");
                mydiv.classList.add("hide");
                window.location.href = "index.php?pg=home";
            }

    }

}

/////////////////////////////////
// check the amount of paid and 
// send to receipt page
/////////////////////////////////
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

    //open receipt page
    print_receipt({
        amount: amount,
        change: CHANGE,
        gtotal: GTOTAL,
        orders_id: ORDER_INFO['orders_id']
    });


}
/////////////////////////////////
// open a receipt window and 
// passing order information
/////////////////////////////////
function print_receipt(obj) {
    var vars = JSON.stringify(obj);

    RECEIPT_WINDOW = window.open('index.php?pg=print&vars=' + vars, 'printpage', "width=500px;");

    setTimeout(close_receipt_window, 2000);

}
/////////////////////////////////
// close reciept window
/////////////////////////////////
function close_receipt_window() {
    RECEIPT_WINDOW.close();
}
