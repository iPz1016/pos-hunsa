<?php require views_path('partials/header'); ?>

<!-- Take Home section -->
<div class="d-flex">
    <div class="col-3 bg-light p-2 pt-2" style="height:820px;">
        <a href="index.php?pg=order&new_takehome=1">
            <div class="align-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50 mb-3" style="height:75px;">
                <h3>TAKE HOME</h3>
            </div>
        </a>

        
        <div class="box js-products overflow-auto align-takehome flex-sm-column h-75 p-3">
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
                    <!--table number box-->
                    <div class="box_table text-center border border-3 border-secondary bg-dark rounded-3 m-2 shadow-xl">
                        <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                            <h6 class="p_table cl mb-2 text-white"><?php echo $key + 1; ?></h6>
                            <div class="color-bar border rounded-pill bg-available mx-3"></div>
                        </a>
                    </div>
                    <!--end box-->
            <?php endforeach;
            endif; ?>
        </div>
        <div class="my-0">
            <table style="width: 100%;">
					<th style="width: 30%" colspan="1">
					<a href="index.php?pg=home">
						<div class="card-side m-auto border-0 mx-auto" style="width: 100%; height: 50%">
							<a href="index.php?pg=logout"><button class="btn btn-danger w-100 my-2 py-3" style="font-size: 24px; font-weight: 700"><i class="fa fa-sign-out-alt"></i> Sign Out</button></a>
						</div>
					</a>
                    </th>
			</table>
        </div>
	</div>


<!-- All Table section: Including Available table, Disable table, Busy table -->
    <div class="container w-80 p-3 h-68">
        <h1 class="mb-3">ALL TABLE</h1>

        <div class="js-products d-flex px-3 flex-sm-wrap align-content-start overflow-auto h-90">
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
                <!--disable table grey color bar-->
                    <div class="p-1">
                        
                            <div class="box_table text-center border border-3 border-secondary rounded-3 bg-secondary bg-opacity-50 m-2 shadow-xl">
                                <h6 class="p_table cl mb-2 text-white"><?php echo $value['table_id']; ?></h6>
                                <div class="color-bar border rounded-pill bg-warning mx-3"></div>
                            </div>
                        
                    </div>
                <!--end box-->
                <?php
                } elseif ($value['orders_id'] == NULL) {
                ?>

                <!--available table green color bar-->
                    <div class="p-1">
                        <a href="index.php?pg=order&new_table_id=<?php echo $value['table_id']; ?>">
                            <div class="box_table text-center border border-3 border-secondary rounded-3 m-2 shadow-xl">
                                <h6 class="p_table cl mb-2 text-black"><?php echo $value['table_id']; ?> </h6>
                                <div class="color-bar border rounded-pill bg-available mx-3"></div>

                            </div>
                        </a>
                    </div>
                <!--end box-->
                    

                <?php
                } else {
                ?>
                    <!--busy table red color bar-->
                        <div class="p-1">
                            <a href="index.php?pg=order&orders_id=<?php echo $value['orders_id']; ?>">
                                <div class="box_table text-center border border-3 border-secondary rounded-3 m-2 shadow-xl">
                                    <h6 class="p_table cl mb-2 text-black"><?php echo $value['table_id']; ?></h6>
                                    <div class="color-bar border rounded-pill bg-danger mx-3"></div>
                                </div>
                                </a>
                            </div>
                    <!--end box-->
                <?php

                }
                ?>

            <?php endforeach ?>

        </div>
    </div>
</div>



<?php require views_path('partials/footer'); ?>