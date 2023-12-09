<?php require views_path('partials/header'); ?>

<div class="container-fluid border rounded p-4 m-2 col-lg-6 mx-auto mt-4 pb-5">

	<!-- Header -->
	<div class="justify-content-center mb-4">
		<h3><i class="fa fa-chair"></i> Add Table</h3>
	</div>

	<!-- Enter an amount form -->
	<form method="post" enctype="multipart/form-data">
		<div class="m-2">
			<div class="input-group mb-3">
				<span class="input-group-text">Amount:</span>
				<input name="number" type="number" min="1" value="1" step="1" class="form-control <?= !empty($errors['new_table']) ? 'border-danger' : '' ?>">
				<?php if (!empty($errors['new_table'])) : ?>
					<small class="text-danger"><?= $errors['new_table'] ?></small>
				<?php endif; ?>
			</div>

			<!-- Add and cancel button -->
			<a href="index.php?pg=admin&tab=tables" class="btn btn-danger float-start btn-lg">Cancel</a>
			<button class="btn btn-success float-end btn-lg">Add</button>
		</div>
	</form>
	<br>
</div>

<?php require views_path('partials/footer'); ?>