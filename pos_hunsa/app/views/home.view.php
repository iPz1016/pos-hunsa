<?php require views_path('partials/header'); ?>

<div class="d-flex">
    <div class="shadow-sm col-3 p-2" style="height:680px;">
        <a href="index.php?pg=order&new_takehome=1">
            <div class="align-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50 mb-3" style="height:75px;">
                <h3>TAKE HOME</h3>
            </div>
        </a>



        <div class="js-products d-flex" style="flex-wrap: wrap;height: 90%;">
            <?php
            $order_class = new Orders;
            try {
                $order = $order_class->get_take_home_order();
            } catch (Exception $e) {
                echo "Data query error";
            }
            //var_dump($order);
            if ($order) :
                foreach ($order as $key => $value) :
            ?>
                    <!--card-->


                    <div class="box_table text-center border border-3 border-secondary rounded-3 m-15">
                        <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                            <h6 class="p_table cl mb-0 text-black"><?php echo $key + 1; ?></h6>
                            <div class="color-bar border rounded-pill bg-available mx-3"></div>
                        </a>
                    </div>

                    <!--end card-->
            <?php endforeach;
            endif; ?>
        </div>
    </div>

    <div style="height:680px;" class="shadow-sm col-8 p-3">
        <h1>ALL TABLE</h1>


        <div class="js-products d-flex" style="flex-wrap: wrap;height: 90%;overflow-y: scroll;">
            <?php

            $order_class = new Orders;
            try {
                $table = $order_class->get_available_table();
            } catch (Exception $e) {
                echo "Data query error";
            }
            foreach ($table as $key => $value) :
                if ($value['disable'] == 1) {
            ?>
                    <!--disable table-->

                    <div class=" p-1 float-left">
                        <a href="#">
                            <div class="box_table text-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50">
                                <h6 class="p_table cl mb-0 text-white"><?php echo $value['table_id']; ?></h6>
                                <div class="color-bar border rounded-pill bg-warning mx-3"></div>
                            </div>
                        </a>
                    </div>

                <?php
                } elseif ($value['orders_id'] == NULL) {
                ?>

                    <!--available table-->

                    <div class="p-1">
                        <a href="index.php?pg=order&new_table_id=<?php echo $value['table_id']; ?>">
                            <div class="box_table text-center border border-3 border-secondary rounded-3">
                                <h6 class="p_table cl mb-0 text-black"><?php echo $value['table_id']; ?> </h6>
                                <div class="color-bar border rounded-pill bg-available mx-3"></div>

                            </div>
                        </a>
                    </div>

                <?php
                } else {
                ?>
                    <!--busy table-->
                    
                        <div class=" p-1 float-left">
                        <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                            <div class="box_table text-center border border-3 border-secondary rounded-3 ">
                                <h6 class="p_table cl mb-0 text-black"><?php echo $value['table_id']; ?></h6>
                                <div class="color-bar border rounded-pill bg-danger mx-3"></div>
                            </div>
                            </a>
                        </div>
                <?php

                }
                ?>

            <?php endforeach ?>

        </div>
    </div>
</div>



<?php require views_path('partials/footer'); ?>