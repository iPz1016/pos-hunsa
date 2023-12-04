<div class="container-fluid row">
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

    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr class="fs-5">
                    <th class="fw-black">ID</th>
                    <th class="fw-black">Username</th>
                    <th class="fw-black">First name</th>
                    <th class="fw-black">Last name</th>
                    <th class="fw-black">Role</th>
                    <th>
                        <a href="index.php?pg=signup">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add new</button>
                        </a>
                    </th>
                </tr>

                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <a href="index.php?pg=profile&id=<?= $user['id'] ?>">
                                    <?= esc($user['id']) ?>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?pg=profile&id=<?= $user['id'] ?>">
                                    <?= esc($user['username']) ?>
                                </a>
                            </td>
                            <td><?= esc($user['firstname']) ?></td>
                            <td><?= esc($user['lastname']) ?></td>
                            <td><?= esc($user['role']) ?></td>
                            <td>
                                <a href="index.php?pg=edit-user&id=<?= $user['id'] ?>">
                                    <button class="btn btn-success btn-sm">Edit</button>
                                </a>
                                <a href="index.php?pg=delete-user&id=<?= $user['id'] ?>">
                                    <button class="btn btn-danger btn-sm" <?php if (Auth::get('id') == $user['id']) echo "disabled"; ?>>Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <?php $pager->display(count($users)) ?>
        </div>
    </div>
</div>
