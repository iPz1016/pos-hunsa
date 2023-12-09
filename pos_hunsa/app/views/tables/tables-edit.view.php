<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto mt-4 pb-5">

    <div class="justfy-content-center mb-4">
		<h3><i class="fa fa-chair"></i> Edit Table #<?= esc($id) ?></h3>
		<div><?= esc(APP_NAME) ?></div>
	</div>

    <form method="post" enctype="multipart/form-data">

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
        <button class="btn btn-success float-end px-4 py-2">Save</button>
        <a href="index.php?pg=admin&tab=tables">
            <button type="button" class="btn btn-danger float-start px-4 py-2">Cancel</button>
        </a>
    </form>
</div>

<?php require views_path('partials/footer'); ?>