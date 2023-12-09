<?php require views_path('partials/header'); ?>

<div class="d-flex">
    <div class="col-3 bg-light p-2 pt-2" style="height:820px;">
         <!-- Account Section -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle elevation-2" src="./assets/images/user_male.jpg" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><a href="#" class="d-block"><?php echo esc(strtoupper(Auth::get(('firstname'))." ".Auth::get(('lastname'))));?></a></h3>
                <p class="text-muted text-center m-0">Cashier</p>
            </div>
        </div>
        <div class="mt-1 mb-3">
            <div class="card-side border-0 mx-auto w-100">
                <a href="index.php?pg=logout"><button class="btn btn-danger w-100" style="font-size: 24px; font-weight: 700"><i class="fa fa-sign-out-alt"></i> Sign Out</button></a>
            </div>
        </div>
        <hr>
         <!-- End Account Section -->

        <!--TakeHome Section -->
        <h3 class="fs-5"> ALL TAKE HOME ORDERS</h3>
        <div class="box js-products overflow-auto align-takehome flex-sm-column h-47 p-3">

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
                    <!-- Take Home Order Box -->
                    <div class="box_table text-center border border-3 border-secondary bg-dark rounded-3 m-2 shadow-xl pb-4">
                        <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                            <h6 class="p_table cl text-white"><?php echo $key + 1; ?></h6>
                            <div class="color-bar border rounded-pill bg-available mx-3"></div>
                        </a>
                    </div>
                    <!--End Box-->
            <?php endforeach;
            endif; ?>
        </div>
        
        <!-- New Take Home Order Button -->
        <a href="index.php?pg=order&new_takehome=1">
            <div class="align-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50 my-2" style="height:75px;">
                <h3><i class="fa fa-plus-circle"></i> TAKE HOME</h3>
            </div>
        </a>
        <!-- End Button -->
        <!--End TakeHome Section -->
	</div>


    <!-- All Table section: Including Available table, Disable table, Busy table -->
    <div class="container w-80 p-3 h-68">
        <h1 class="mb-3">ALL TABLE</h1>

        <div class="js-products d-flex flex-sm-wrap align-content-start overflow-auto h-95">
            <?php

            $order_class = new Orders;
            // Fetch available tables
            try {
                $table = $order_class->get_available_table();
            } catch (Exception $e) {
                echo "Data query error";
            }

            // Loop through each table
            foreach ($table as $key => $value) :
                // Check if the table is disabled
                if ($value['disable'] == 1) {
            ?>
                <!-- Disabled Table Section -->
                    <div class="p-1">
                        
                            <div class="box_table text-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50 m-2 shadow-xl">
                                <h6 class="p_table cl mb-2 text-white"><?php echo $value['table_id']; ?></h6>
                                <div class="color-bar border rounded-pill bg-warning mx-3"></div>
                            </div>
                        
                    </div>
                <!-- End Disabled Table Section -->
                <?php
                } elseif ($value['orders_id'] == NULL) {
                ?>

                <!-- Available Table Section -->
                    <div class="p-1">
                        <a href="index.php?pg=order&new_table_id=<?php echo $value['table_id']; ?>">
                            <div class="box_table text-center border border-3 border-secondary rounded-3 m-2 shadow-xl">
                                <h6 class="p_table cl mb-2 text-black"><?php echo $value['table_id']; ?> </h6>
                                <div class="color-bar border rounded-pill bg-available mx-3"></div>

                            </div>
                        </a>
                    </div>
                <!-- End Available Table Section -->
                    

                <?php
                } else {
                ?>
                    <!-- Busy Table Section -->
                        <div class="p-1">
                            <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                                <div class="box_table text-center border border-3 border-secondary rounded-3 m-2 shadow-xl">
                                    <h6 class="p_table cl mb-2 text-black"><?php echo $value['table_id']; ?></h6>
                                    <div class="color-bar border rounded-pill bg-danger mx-3"></div>
                                </div>
                                </a>
                            </div>
                     <!-- End Busy Table Section -->
                <?php

                }
                ?>

            <?php endforeach ?>

        </div>
    </div>
    <!-- End Table Display Section -->
</div>



<?php require views_path('partials/footer'); ?>