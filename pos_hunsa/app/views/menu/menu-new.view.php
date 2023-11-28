<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

	<form method="post" enctype="multipart/form-data">

		<h5 class="text-primary"><i class="fa fa-hamburger"></i> Add Menu</h5>

		<div class="mb-3">
			<label for="productControlInput1" class="form-label">Menu Name</label>
			<input name="menu_name" type="text" class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>" id="productControlInput1" placeholder="Menu Name">
			<?php if (!empty($errors['menu_name'])) : ?>
				<small class="text-danger"><?= $errors['menu_name'] ?></small>
			<?php endif; ?>
		</div>



		<label for="productControlInput2" class="form-label">Menu Type</label>

		<?php
		foreach ($menu_type as $type) :
		?>
			<div class="input-group mb-1">
				<div class="input-group-text">
					<input class="form-check-input mt-0" type="radio" name="menu_type" value="<?php echo $type['menu_type']; ?>" aria-label="menu_type">
				</div>
				<input type="text" class="form-control" name="type" value="<?php echo $type['menu_type']; ?>" aria-label="menu_type" disabled>
			</div>
		<?php endforeach; ?>

		<div class="input-group mb-3">
			<div class="input-group-text">
				<input class="form-check-input mt-0" type="radio" name="menu_type" value="-1" aria-label="menu_type" checked>
			</div>
			<input type="text" class="form-control <?= !empty($errors['menu_type']) ? 'border-danger' : '' ?>" name="type" value="" aria-label="menu_type" placeholder="etc">
			<?php if (!empty($errors['menu_type'])) : ?>
				<small class="text-danger"><?= $errors['menu_type'] ?></small>
			<?php endif; ?>
		</div>


		<div class="input-group mb-3">
			<span class="input-group-text">Price:</span>
			<input name="menu_price" type="number" min="1" class="form-control <?= !empty($errors['menu_price']) ? 'border-danger' : '' ?>" placeholder="Price" aria-label="menu_price">
		</div>
		<?php if (!empty($errors['menu_price'])) : ?>
			<small class="text-danger"><?= $errors['menu_price'] ?></small>
		<?php endif; ?>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="disable" id="inlineRadio1" value="1">
			<label class="form-check-label" for="inlineRadio1">Disable</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="disable" id="inlineRadio2" value="0" checked>
			<label class="form-check-label" for="inlineRadio2">Enable</label>
		</div>
		<br>

		<div class="mb-3">
			<label for="formFile" class="form-label">Menu Image</label>
			<input name="menu_img" class="form-control <?= !empty($errors['menu_img']) ? 'border-danger' : '' ?>" type="file" id="formFile">
			<?php if (!empty($errors['menu_img'])) : ?>
				<small class="text-danger"><?= $errors['menu_img'] ?></small>
			<?php endif; ?>
		</div>

		<br>
		<button class="btn btn-danger float-end">Save</button>
		<a href="index.php?pg=admin&tab=menu">
			<button type="button" class="btn btn-primary">Cancel</button>
		</a>
	</form>
</div>

<?php require views_path('partials/footer'); ?>