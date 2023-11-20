<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

    <form method="post" enctype="multipart/form-data">

        <h5 class="text-danger"><i class="fa fa-chair"></i> Delete Table</h5>

        <div class="input-group mb-3">
            <span class="input-group-text">Amount:</span>
            <input name="number" type="number" min="1" value="1" step="1" class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>">
        </div>
        <?php if (!empty($errors['number'])) : ?>
            <small class="text-danger"><?= $errors['number'] ?></small><br>
        <?php endif; ?>

        <br>
        <button class="btn btn-danger float-end">Save</button>
        <a href="index.php?pg=admin&tab=tables">
            <button type="button" class="btn btn-primary">Cancel</button>
        </a>
    </form>
</div>

<?php require views_path('partials/footer'); ?>