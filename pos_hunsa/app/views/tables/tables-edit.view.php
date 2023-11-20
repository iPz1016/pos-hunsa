<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

    <form method="post" enctype="multipart/form-data">

        <h5 class="text-primary"><i class="fa fa-chair"></i> Edit Table #<?= esc($id) ?></h5>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="disable" id="inlineRadio2" value="0" <?php if ($row['disable'] == 0) echo "checked"; ?>>
            <label class="form-check-label" for="inlineRadio2">Enable</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="disable" id="inlineRadio1" value="1" <?php if ($row['disable'] == 1) echo "checked"; ?>>
            <label class="form-check-label" for="inlineRadio1">Disable</label>
        </div>
        <br>

        <?php if (!empty($errors['disable'])) : ?>
            <small class="text-danger"><?= $errors['disable'] ?></small><br>
        <?php endif; ?>

        <br>
        <button class="btn btn-danger float-end">Save</button>
        <a href="index.php?pg=admin&tab=tables">
            <button type="button" class="btn btn-primary">Cancel</button>
        </a>
    </form>
</div>

<?php require views_path('partials/footer'); ?>