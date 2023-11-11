<?php

defined("ABSPATH") ? "" : die();

if (Auth::access('cashier')) {
    $menu_class = new Menu_info;
    $menu = $menu_class->getAll(100, 0, "asc", "menu_id");

    foreach ($menu as $key => $row) {

        $menu[$key]['menu_name'] = strtoupper($row['menu_name']);
        $menu[$key]['menu_img'] = crop($row['menu_img']);
    }
    $menu_type = $menu_class->get_menu_type();

?>
    <script>
        var MENU_TYPE = <?php echo json_encode($menu_type); ?>;
        var ORDER = [];
        var MENU = <?php echo json_encode($menu); ?>;
        console.log(MENU_TYPE);
    </script>
    <?php


    if (isset($_GET['orders_id'])) {
        $orders_class = new Orders;
        $order_id = $_GET['orders_id'];
        $order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "menu_id");
        if (!$order) {
            redirect('home');
        }
    ?>

        <script>
            try {
                isset(ORDER);
                unset(ORDER);
            } catch (e) {
                //
            }

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
    if (isset($_GET['new_takehome'])) {
        if ($_GET['new_takehome'] == 1) {
        ?>
            <script>
                try {
                    isset(ORDER_INFO);
                    unset(ORDER_INFO);
                } catch (e) {
                    //
                }

                var ORDER_INFO = {
                    table_id: null,
                    orders_id: <?php echo time(); ?>
                }
                //console.log(ORDER_INFO);
            </script>
        <?php
        } else {
            redirect('home');
        }
    }
    if (isset($_GET['new_table_id'])) {

        $table_info_class = new Table_info;
        $data['table_id'] = $_GET['new_table_id'];
        $data['disable'] = 0;
        $table_id = $table_info_class->where($data, 1, 0, 'desc', 'table_id');

        $order_class = new Orders;
        $order_table_exist = $order_class->where(['table_id'=>$data['table_id']],1,0,'desc','orders_id');
        
        if ($table_id && !$order_table_exist) {

        ?>
            <script>
                var ORDER_INFO = {
                    table_id: <?php echo $table_id[0]['table_id']; ?>,
                    orders_id: <?php echo time(); ?>
                }
                //console.log(ORDER_INFO);
            </script>
<?php

        } else {
            redirect('home');
        }
    }

    require views_path('order');
} else {

    Auth::setMessage("You need to be logged in for this page");
    require views_path('auth/denied');
}
