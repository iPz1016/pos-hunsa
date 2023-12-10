<div class="container-fluid d-flex justify-content-center">
    <!-- Table Section -->
    <div class="col-12 col-sm-8 col-md-9 col-lg-10">
        <!-- Table Information -->
        <div class="table-responsive table-h-49">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="fs-5">
                        <th class="fw-black">Table ID</th>
                        <th class="fw-black">Status</th>
                        <th class="fw-black">Order</th>
                        <th class="float-end p-1">
                            <!-- Add New Table Button -->
                            <a href="index.php?pg=table-new">
                                <button class="btn btn-primary btn-lg btn-headadmin-size"><i class="fa fa-plus"></i> New Table</button>
                            </a>
                        </th>
                        <th class="float-end p-1" colspan="2">
                            <!-- Delete Table Button -->
                            <a href="index.php?pg=table-delete">
                                <button class="btn btn-danger btn-lg btn-headadmin-size"><i class="fa fa-minus"></i> Delete Table</button>
                            </a>
                        </th>
                        
                    </tr>
                </thead>

                <!-- Table Data -->
                <?php if (!empty($table_info)) : ?>
                    <?php foreach ($table_info as $table) : ?>
                        <tr>
                            <td>
                                <?= esc($table['table_id']) ?>
                            </td>

                            <td>
                                <?php
                                // Table Status - Enable/Disable
                                if ($table['disable'] == 0) {
                                    echo "<a class='text-success'><i class='fa fa-check'></i>  Enable</a>";
                                } else {
                                    echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
                                }

                                ?>
                            </td>
                            <td>
                                <?php
                                // Table Order Status - Disable/Available/Busy
                                if ($table['disable'] == 1) {
                                    echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
                                } else if ($table['orders_id'] == 0) {
                                    echo "<a class='text-success'><i class='fa fa-check'></i>  Available</a>";
                                } else {
                                    echo "<a class='text-primary'><i class='fa fa-stop-circle'></i>  Busy</a>";
                                }

                                ?>
                            </td>
                            <td>
                                <!-- Edit Table Button -->
                                <a href="index.php?pg=table-edit&id=<?= $table['table_id'] ?>">
                                    <button class="btn btn-success btn-lg btn-bodyadmin-size float-end">Edit</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
