<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

	<?php if (!empty($row)) : ?>

		<form method="post" enctype="multipart/form-data">

			<h5 class="text-danger"><i class="fa fa-hamburger"></i> Delete Menu</h5>

			<div class="alert alert-danger text-center">Are you sure you want to delete this menu??!!</div>

			<div class="mb-3">
				<label for="productControlInput1" class="form-label">Menu Name</label>
				<input disabled value="<?= set_value('menu_name', $row['menu_name']) ?>" name="menu_name" type="text" class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>" id="productControlInput1" placeholder="Menu Name">
				<?php if (!empty($errors['menu_name'])) : ?>
					<small class="text-danger"><?= $errors['menu_name'] ?></small>
				<?php endif; ?>
			</div>

			<div class="mb-3">
				<label for="productControlInput2" class="form-label">Menu Type</label>
				<input disabled value="<?= set_value('menu_type', $row['menu_type']) ?>" name="menu_type" type="text" class="form-control <?= !empty($errors['menu_type']) ? 'border-danger' : '' ?>" id="productControlInput1" placeholder="Menu Type">
				<?php if (!empty($errors['menu_type'])) : ?>
					<small class="text-danger"><?= $errors['menu_type'] ?></small>
				<?php endif; ?>
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text">Price:</span>
				<input disabled name="menu_price" value="<?= set_value('menu_price', $row['menu_price']) ?>" type="number" class="form-control <?= !empty($errors['menu_price']) ? 'border-danger' : '' ?>" placeholder="Price" aria-label="menu_price">
			</div>
			<?php if (!empty($errors['menu_price'])) : ?>
				<small class="text-danger"><?= $errors['menu_price'] ?></small>
			<?php endif; ?>

			<div class="form-check form-check-inline">
				<input disabled class="form-check-input" type="radio" name="disable" id="inlineRadio1" value="1" <?php if ($row['disable'] == 1) echo "checked"; ?>>
				<label disabled class="form-check-label" for="inlineRadio1">Disable</label>
			</div>

			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="disable" id="inlineRadio2" value="0" <?php if ($row['disable'] == 0) echo "checked"; ?>>
				<label class="form-check-label" for="inlineRadio2">Enable</label>
			</div>
			<br>
			<img class="mx-auto d-block" src="<?= $row['menu_img'] ?>" style="height:60%;">
			<br>

			<button class="btn btn-danger float-end">Delete</button>
			<a href="index.php?pg=admin&tab=menu">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>
		</form>
	<?php else : ?>
		That menu was not found
		<br><br>
		<a href="index.php?pg=admin&tab=menu">
			<button type="button" class="btn btn-primary">Back to menu</button>
		</a>

	<?php endif; ?>

</div>

<?php require views_path('partials/footer'); ?>