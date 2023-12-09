<div class="container-fluid row">
    <!-- User Table Section -->
    <div class="col">
        <div class="table-responsive table-h-49">
            <!-- Table Header -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="fs-5">
                        <th class="fw-black">ID</th>
                        <th class="fw-black">Username</th>
                        <th class="fw-black">First name</th>
                        <th class="fw-black">Last name</th>
                        <th class="fw-black">Role</th>
                        <th>
                            <!-- Add New User Button -->
                            <a href="index.php?pg=signup">
                                <button class="btn btn-primary btn-lg w-100"><i class="fa fa-plus"></i> Add new</button>
                            </a>
                        </th>
                    </tr>
                </thead>

                <!-- Add New User Button -->
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <!-- User ID -->
                                <a href="index.php?pg=profile&id=<?= $user['id'] ?>">
                                    <?= esc($user['id']) ?>
                                </a>
                            </td>
                            <td>
                                <!-- Username  -->
                                <a href="index.php?pg=profile&id=<?= $user['id'] ?>">
                                    <?= esc($user['username']) ?>
                                </a>
                            </td>
                            <td><?= esc($user['firstname']) ?></td>
                            <td><?= esc($user['lastname']) ?></td>
                            <td><?= esc($user['role']) ?></td>
                            <td>
                                <!-- Edit User and Delete User Buttons -->
                                <a href="index.php?pg=edit-user&id=<?= $user['id'] ?>">
                                    <button class="btn btn-success btn-lg">Edit</button>
                                </a>
                                <a href="index.php?pg=delete-user&id=<?= $user['id'] ?>">
                                    <button class="btn btn-danger btn-lg" <?php if (Auth::get('id') == $user['id']) echo "disabled"; ?>>Delete</button>
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
