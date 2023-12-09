<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-6 mx-auto">

	<?php if (!empty($row)) : ?>
		<form method="post" enctype="multipart/form-data" class="edit-menu-size">
			<div class="m-2">
				<h3><i class="fa fa-hamburger"></i> Edit Menu</h3>
				<div class="card-editing">
					<div class="me-1" style="width: 50%; float: left;">
						<div class="form-label">
							<p class="m-1">Menu Name</p>
							<input value="<?= set_value('menu_name', $row['menu_name']) ?>" name="menu_name" type="text" class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>" id="productControlInput1" placeholder="Menu Name">
							<?php if (!empty($errors['menu_name'])) : ?>
								<small class="text-danger col-12"><?= $errors['menu_name'] ?></small>
							<?php endif; ?>
						</div>
					</div>
					<div class="ms-1" style="width: 50%; float: right;">
						<div class="form-label">
							<p class="m-1">Price</p>
							<div class="input-group">
								<span class="input-group-text">฿</span>
								<input name="menu_price" value="<?= set_value('menu_price', $row['menu_price']) ?>" type="number" min="1" class="form-control <?= !empty($errors['menu_price']) ? 'border-danger' : '' ?>" placeholder="Price" aria-label="menu_price">
							</div>
							<?php if (!empty($errors['menu_price'])) : ?>
								<small class="text-danger col-12"><?= $errors['menu_price'] ?></small>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="form-label">
					<p class="m-1">Menu Type</p>
				</div>
				<?php
				foreach ($menu_type as $type) :
				?>
					<div class="input-group mb-1">
						<div class="input-group-text">
							<input class="form-check-input mt-0" type="radio" name="menu_type" value="<?php echo $type['menu_type']; ?>" aria-label="menu_type" <?php if($type['menu_type']== $row['menu_type']) echo 'checked';?>>
						</div>
						<input type="text" class="form-control" name="type" value="<?php echo $type['menu_type']; ?>" aria-label="menu_type" disabled>
					</div>
				<?php endforeach; ?>
				<div class="input-group mb-2">
					<div class="input-group-text">
						<input class="form-check-input mt-0" type="radio" name="menu_type" value="-1" aria-label="menu_type">
					</div>
					<input type="text" class="form-control <?= !empty($errors['menu_type']) ? 'border-danger' : '' ?>" name="type" value="" aria-label="menu_type" placeholder="etc">
					<?php if (!empty($errors['menu_type'])) : ?>
						<small class="text-danger col-12"><?= $errors['menu_type'] ?></small>
					<?php endif; ?>
				</div>
				<div class="mb-2"  style="width: 50%; float: left">
					<div class="form-label">
						<p class="m-1">Menu Status</p>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="disable" id="inlineRadio1" value="1" <?php if ($row['disable'] == 1) echo "checked"; ?>>
							<label class="form-check-label" for="inlineRadio1">Disable</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="disable" id="inlineRadio2" value="0" <?php if ($row['disable'] == 0) echo "checked"; ?>>
							<label class="form-check-label" for="inlineRadio2">Enable</label>
						</div>
					</div>
				</div>
				<div class="mb-2" style="width: 50%; float: left">
					<div class="form-label">
						<p class="m-1">Menu Image</p>
						<input name="menu_img" class="form-control <?= !empty($errors['menu_img']) ? 'border-danger' : '' ?>" type="file" id="formFile">
						<?php if (!empty($errors['menu_img'])) : ?>
							<small class="text-danger"><?= $errors['menu_img'] ?></small>
						<?php endif; ?>
						<img class="mx-auto m-3 d-block" src="<?= $row['menu_img'] ?>" style="height: 120px;">
					</div>
				</div>
				<?php else : ?>
					<h3>That menu was not found</h3>
				<br><br>
				<a href="index.php?pg=admin&tab=menu">
					<button type="button" class="btn btn-primary">Back to menu</button>
				</a>
				<?php endif; ?>
				<button class="btn btn-success btn-lg float-end">Save</button>
				<a href="index.php?pg=admin&tab=menu">
					<button type="button" class="btn btn-danger btn-lg float-start">Cancel</button>
				</a>
			</div>
		</form>
</div>

<?php require views_path('partials/footer'); ?>