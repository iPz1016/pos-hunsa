<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-6 mx-auto mt-4 pb-5">

    <div class="justfy-content-center mb-4">
		<h3><i class="fa fa-chair"></i> Edit Table #<?= esc($id) ?></h3>
	</div>

    <form method="post" enctype="multipart/form-data">
        <div class="m-2">
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
            <button class="btn btn-success float-end btn-lg">Save</button>
            <a href="index.php?pg=admin&tab=tables">
                <button type="button" class="btn btn-danger float-start btn-lg">Cancel</button>
            </a>
            <br>
        </div>
    </form>
</div>

<?php require views_path('partials/footer'); ?>