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
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr class="fs-5">
                    <th class="fw-black">Menu id</th>
                    <th class="fw-black">Name</th>
                    <th class="fw-black">Type</th>
                    <th class="fw-black">Price</th>
                    <th class="fw-black">Image</th>
                    <th class="fw-black">Disable</th>
                    <th>
                        <a href="index.php?pg=menu-new">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add new</button>
                        </a>
                    </th>
                </tr>

                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= esc($product['menu_id']) ?></td>
                            <td>
                                <a href="index.php?pg=menu-edit&id=<?= $product['menu_id'] ?>">
                                    <?= esc(strtoupper($product['menu_name'])) ?>
                                </a>
                            </td>
                            <td><?= esc($product['menu_type']) ?></td>
                            <td><?= esc($product['menu_price']) ?></td>
                            <td>
                                <img src="<?= crop($product['menu_img']) ?>" style="width: 100%;max-width:100px;">
                            </td>
                            <td>
                                <?php
                                    if ($product['disable'] == 0) {
                                        echo "<a class='text-success'><i class='fa fa-check'></i> Enable</a>";
                                    } else {
                                        echo "<a class='text-danger'><i class='fa fa-times'></i> Disable</a>";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="index.php?pg=menu-edit&id=<?= $product['menu_id'] ?>">
                                    <button class="btn btn-success btn-sm">Edit</button>
                                </a>
                                <a href="index.php?pg=menu-delete&id=<?= $product['menu_id'] ?>">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <!-- Statistical information and graphs -->
    <div class="col">
        <div class="row justify-content-center">
            <!-- Statistical information -->
            <div class="col-md-3 border rounded p-4 my-2">
                <i class="fa fa-user" style="font-size: 30px"></i>
                <h4>Total Users:</h4>
                <h2><!-- Replace with actual data --><?=$total_users?></h2>
            </div>
            <div class="col-md-3 border rounded p-4 my-2">
                <i class="fa fa-ham
