<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-6 mx-auto mt-4 pb-4">
 
    <form method="post" enctype="multipart/form-data" class="overflow-auto">
        <div class="m-2">
            <div class="justify-content-center mb-4">
                <h3 class="text-danger"><i class="fa fa-chair"></i>Delete Table</h3>
                <div><?= esc(APP_NAME) ?></div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Amount:</span>
                <input name="number" type="number" min="1" value="1" step="1" class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>">
            </div>
            <?php if (!empty($errors['number'])) : ?>
                <small class="text-danger"><?= $errors['number'] ?></small><br>
            <?php endif; ?>

            <button class="btn btn-success btn-lg float-end">Save</button>
            <a href="index.php?pg=admin&tab=tables">
                <button type="button" class="btn btn-danger btn-lg float-start">Cancel</button>
            </a>
        </div>
    </form>
</div>

<?php require views_path('partials/footer'); ?>