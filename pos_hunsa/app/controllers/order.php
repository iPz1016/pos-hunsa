<?php

defined("ABSPATH") ? "" : die();

if (Auth::access('cashier')) {
    $product_class = new Product;
    $menu = $product_class->getAll(100, 0, "asc", "id");

    foreach($menu as $key => $row) {

        $menu[$key]['description'] = strtoupper($row['description']);
        $menu[$key]['image'] = crop($row['image']);
    }




?>
    <script>
        
        try {
            isset(MENU);
            unset(MENU);
        } catch (e) {
            //
        }
        var MENU = <?php echo json_encode($menu); ?>;
        //console.log(MENU);
    </script>
    <?php

    if (isset($_GET['orders_id'])) {
        $orders_class = new Orders;
        $order_id = $_GET['orders_id'];
        $order = $orders_class->where(["orders_id" => $order_id], $limit = 100, $offset = 0, "asc", "orders_id");
    ?>

        <script>
            try {
                isset(ORDER);
                unset(ORDER);
            } catch (e) {
                //
            }

            var ORDER = <?php echo json_encode($order); ?>;
            //console.log(ORDER);
        </script>
<?php

    }
    require views_path('order');
} else {

    Auth::setMessage("You need to be logged in for this page");
    require views_path('auth/denied');
}
