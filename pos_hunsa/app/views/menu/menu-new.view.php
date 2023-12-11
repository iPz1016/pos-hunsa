<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-6 mx-auto pb-5">

	<!-- Form for adding a new menu -->
	<form method="post" enctype="multipart/form-data" class="overflow-auto">
		<div class="m-2">
			<h3 class="mb-3"><i class="fa fa-hamburger"></i> Add Menu</h3>
			<div class="card-editing">
				<div class="me-1 w-50 float-start">
					<div class="form-label">
						<p class="m-1">Menu Name</p>
						<input name="menu_name" type="text"
							class="form-control <?= !empty($errors['menu_name']) ? 'border-danger' : '' ?>"
							id="productControlInput1" placeholder="Menu Name">
						<?php if (!empty($errors['menu_name'])): ?>
							<small class="text-danger col-12">
								<?= $errors['menu_name'] ?>
							</small>
						<?php endif; ?>
					</div>
				</div>
				<div class="ms-1 w-50 float-end">
					<div class="form-label">
						<p class="m-1">Price</p>
						<div class="input-group">
							<span class="input-group-text">฿</span>
							<input name="menu_price" type="number" min="1"
								class="form-control <?= !empty($errors['menu_price']) ? 'border-danger' : '' ?>"
								placeholder="Price" aria-label="menu_price">
						</div>
						<?php if (!empty($errors['menu_price'])): ?>
							<small class="text-danger col-12">
								<?= $errors['menu_price'] ?>
							</small>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Menu Type and Menu Image  -->
			<div class="form-label">
				<p class="m-1">Menu Type</p>
			</div>
			<?php
			foreach ($menu_type as $type):
				?>
				<div class="input-group mb-1">
					<div class="input-group-text">
						<input class="form-check-input mt-0" type="radio" name="menu_type"
							value="<?php echo $type['menu_type']; ?>" aria-label="menu_type">
					</div>
					<input type="text" class="form-control" name="type" value="<?php echo $type['menu_type']; ?>"
						aria-label="menu_type" disabled>
				</div>
			<?php endforeach; ?>
			<div class="input-group mb-3">
				<div class="input-group-text">
					<input class="form-check-input mt-0" type="radio" name="menu_type" value="-1"
						aria-label="menu_type" checked>
				</div>
				<input type="text"
					class="form-control <?= !empty($errors['menu_type']) ? 'border-danger' : '' ?>"
					name="type" value="" aria-label="menu_type" placeholder="etc">
				<?php if (!empty($errors['menu_type'])): ?>
					<small class="text-danger col-12">
						<?= $errors['menu_type'] ?>
					</small>
				<?php endif; ?>
			</div>
			<div class="mb-3">
				<div class="form-label">
					<p class="m-1">Menu Image</p>
					<input name="menu_img"
						class="form-control <?= !empty($errors['menu_img']) ? 'border-danger' : '' ?>"
						type="file" id="formFile">
					<?php if (!empty($errors['menu_img'])): ?>
						<small class="text-danger col-12">
							<?= $errors['menu_img'] ?>
						</small>
					<?php endif; ?>
				</div>
			</div>

			<!-- Submit and Cancel Buttons -->
			<button class="btn btn-success btn-lg float-end">Submit</button>
			<a href="index.php?pg=admin&tab=menu">
				<button type="button" class="btn btn-danger btn-lg float-start">Cancel</button>
			</a>
		</div>
	</form>
</div>

<?php require views_path('partials/footer'); ?>