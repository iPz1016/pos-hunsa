<div class="container-fluid row">
    <!-- Left menu -->
    <div class="col-12 col-sm-4 col-md-3 col-lg-2">
        <ul class="list-group">
            <a href="index.php?pg=admin&tab=main">
                <li class="list-group-item <?= !$tab || $tab == 'main' ? 'active' : '' ?>"><i class="fa fa-th-large"></i> Main menu</li>
            </a>
            <a href="index.php?pg=admin&tab=dashboard">
                <li class="list-group-item <?= $tab == 'dashboard' ? 'active' : '' ?>"><i class="fa fa-th-large"></i> Dashboard</li>
            </a>
            <a href="index.php?pg=admin&tab=users">
                <li class="list-group-item <?= $tab == 'users' ? 'active' : '' ?>"><i class="fa fa-users"></i> Users</li>
            </a>
            <a href="index.php?pg=admin&tab=menu">
                <li class="list-group-item <?= $tab == 'menu' ? 'active' : '' ?>"><i class="fa fa-hamburger"></i> Menu</li>
            </a>
            <a href="index.php?pg=admin&tab=sales">
                <li class="list-group-item <?= $tab == 'sales' ? 'active' : '' ?>"><i class="fa fa-money-bill-wave"></i> Sales</li>
            </a>
            <a href="index.php?pg=admin&tab=tables">
                <li class="list-group-item <?= $tab == 'tables' ? 'active' : '' ?>"><i class="fa fa-chair"></i> Tables</li>
            </a>
            <a href="index.php?pg=logout">
                <li class="list-group-item"><i class="fa fa-sign-out-alt"></i> Logout</li>
            </a>
        </ul>
    </div>

    <!-- Right content -->
    <div class="col-12 col-sm-8 col-md-9 col-lg-10">
        <div class="table-responsive table-h-55">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="fs-5">
                        <th class="fw-black">Table ID</th>
                        <th class="fw-black">Status</th>
                        <th class="fw-black">Order</th>
                        <th>
                            <a href="index.php?pg=table-new">
                                <button class="btn btn-primary btn-sm p-2"><i class="fa fa-plus"></i> Add table</button>
                            </a>
                        </th>
                    </tr>
                </thead>

                <?php if (!empty($table_info)) : ?>
                    <?php foreach ($table_info as $table) : ?>
                        <tr>
                            <td>
                                <?= esc($table['table_id']) ?>
                            </td>

                            <td>
                                <?php
                                if ($table['disable'] == 0) {
                                    echo "<a class='text-success'><i class='fa fa-check'></i>  Enable</a>";
                                } else {
                                    echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
                                }

                                ?>
                            </td>
                            <td>
                                <?php
                                if ($table['disable'] == 1) {
                                    echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
                                } else if ($table['orders_id'] == 0) {
                                    echo "<a class='text-success'><i class='fa fa-check'></i>  Available</a>";
                                } else {
                                    echo "<a class='text-primary' href='index.php?pg=order&orders_id=" . $table['orders_id'] . "' ><i class='fa fa-stop-circle'></i>  Busy</a>";
                                }

                                ?>
                            </td>
                            <td>
                                <a href="index.php?pg=table-edit&id=<?= $table['table_id'] ?>">
                                    <button class="btn btn-success btn-sm">Edit</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="index.php?pg=table-delete">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Delete table</button>
                            </a></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
