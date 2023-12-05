<div class="container-fluid row">

    <div class="col">
        <div class="table-responsive table-h-49">
            <table class="table table-striped table-hover">
                <thead>
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
                </thead>

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
</div>
