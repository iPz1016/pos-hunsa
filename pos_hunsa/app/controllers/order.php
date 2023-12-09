<?php

defined("ABSPATH") ? "" : die();

// Check if the user has cashier access
if (Auth::access('cashier')) {

    // Create an instance of the Menu_info class
    $menu_class = new Menu_info;

    // Retrieve menu items with disable set to 0
    $menu = $menu_class->where(['disable'=> 0],300,0,'asc','menu_id');

    // Modify menu data for better presentation
    foreach ($menu as $key => $row) {

        $menu[$key]['menu_name'] = strtoupper($row['menu_name']);
        $menu[$key]['menu_img'] = crop($row['menu_img']);
    }
    // Retrieve menu types
    $menu_type = $menu_class->get_menu_type();

?>
    <script>
        // Define JavaScript variables using PHP data
        var MENU_TYPE = <?php echo json_encode($menu_type); ?>;
        var ORDER = [];
        var MENU = <?php echo json_encode($menu); ?>;
        console.log(MENU_TYPE);
    </script>
    <?php

    // Check if orders_id is set in the URL
    if (isset($_GET['orders_id'])) {
        $orders_class = new Orders;
        $order_id = $_GET['orders_id'];
        // Retrieve order information based on orders_id
        $order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
        // Redirect to home if order is not found
        if (!$order) {
            redirect('home');
        }
    ?>

        <script>
            // Try to unset ORDER if it exists
            try {
                isset(ORDER);
                unset(ORDER);
            } catch (e) {
                //
            }

            // Define JavaScript variable for order data
            var ORDER = <?php echo json_encode($order); ?>;
            // console.log(ORDER);

            try {
                isset(ORDER_INFO);
                unset(ORDER_INFO);
            } catch (e) {
                //
            }

            var ORDER_INFO = {
                table_id: ORDER[0]['table_id'],
                orders_id: ORDER[0]['orders_id']
            }
            // console.log(ORDER_INFO);
        </script>
    <?php
    }

    // Check if new_takehome is set in the URL
    if (isset($_GET['new_takehome'])) {
        // Check if new_takehome is equal to 1
        if ($_GET['new_takehome'] == 1) {
        ?>
            <script>
                // Try to unset ORDER_INFO if it exists
                try {
                    isset(ORDER_INFO);
                    unset(ORDER_INFO);
                } catch (e) {
                    //
                }

                // Define JavaScript variable for order information
                var ORDER_INFO = {
                    table_id: null,
                    orders_id: <?php echo time(); ?>
                }
                //console.log(ORDER_INFO);
            </script>
        <?php
        } else {
            // Redirect to home if new_takehome is not equal to 1
            redirect('home');
        }
    }

    // Check if new_table_id is set in the URL
    if (isset($_GET['new_table_id'])) {

        // Create instances of Table_info and Orders classes
        $table_info_class = new Table_info;
        $order_class = new Orders;

        // Set data for table information retrieval
        $data['table_id'] = $_GET['new_table_id'];
        $data['disable'] = 0;

        // Retrieve table information based on new_table_id
        $table_id = $table_info_class->where($data, 1, 0, 'desc', 'table_id');

        // Check if table_id exists and there are no orders for the table
        $order_table_exist = $order_class->where(['table_id'=>$data['table_id']],1,0,'desc','orders_id');
        
        if ($table_id && !$order_table_exist) {
        ?>
            <script>
                // Define JavaScript variable for order information
                var ORDER_INFO = {
                    table_id: <?php echo $table_id[0]['table_id']; ?>,
                    orders_id: <?php echo time(); ?>
                }
                //console.log(ORDER_INFO);
            </script>
<?php

        } else {
            // Redirect to home if table_id does not exist or there are existing orders
            redirect('home');
        }
    }

    // Require the order view
    require views_path('order');
} else {
    // Set an access denied message for users without cashier access
    Auth::setMessage("You need to be cashier in for this page");
    require views_path('auth/denied');
}
