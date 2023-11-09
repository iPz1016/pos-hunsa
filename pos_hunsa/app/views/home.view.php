<?php require views_path('partials/header'); ?>


<div class="d-flex">
    <div style="height:680px;" class="shadow-sm col-4 p-4">
        <a href="index.php?pg=order&new_takehome=1">
            <div class="h5 text-md-center bg-black bg-opacity-10 p-3" style="width: 250px;">Take Home</div>
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

            foreach ($order as $key => $value) :
            ?>
                <!--card-->
                <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id'];?>">
                    <div class="p-0">
                        <div class="table-box bg-black text-center" style="width:250px;height: 100px;">
                            <p class="cl mb-0 text-white" style="font-size: 360%;"><?php echo $key+1; ?></p>
                        </div>
                    </div>
                </a>
                <!--end card-->
            <?php endforeach; ?>
        </div>
    </div>
    <div style="height:680px;" class="shadow-sm col-8 p-4">
        <div class="h1">Table</div>


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
                    <a href="#">
                        <div class=" p-1 float-left">
                            <div class="table-box bg-danger text-center" style="width: 100px;height: 100px;">
                                <p class="cl mb-0 text-white" style="font-size: 360%;"><?php echo $value['table_id'];?></p>
                            </div>
                        </div>
                    </a>
                <?php
                } elseif ($value['orders_id'] == NULL) {
                ?>
                    <!--available table-->
                    <a href="index.php?pg=order&new_table_id=<?php echo $value['table_id'];?>">
                        <div class=" p-1 float-left">
                            <div class="table-box bg-black text-center" style="width: 100px;height: 100px;">
                                <p class="cl mb-0 text-white" style="font-size: 360%;"><?php echo $value['table_id'];?></p>
                            </div>
                        </div>
                    </a>
                <?php
                } else {
                ?>
                    <!--busy table-->
                    <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id'];?>">
                        <div class=" p-1 float-left">
                            <div class="table-box bg-black bg-opacity-50 text-center" style="width: 100px;height: 100px;">
                                <p class="cl mb-0 text-white" style="font-size: 360%;"><?php echo $value['table_id'];?></p>
                            </div>
                        </div>
                    </a>
                <?php

                }
                ?>



            <?php endforeach ?>







        </div>
    </div>
</div>



<?php require views_path('partials/footer'); ?>