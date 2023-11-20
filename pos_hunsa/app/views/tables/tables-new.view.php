<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<form method="post" enctype="multipart/form-data">

			<h5 class="text-primary"><i class="fa fa-chair"></i> Add Table</h5>

			<div class="input-group mb-3">
				<span class="input-group-text">Amount:</span>
				<input name="number" type="number" min="1" value="1" step="1" class="form-control">
			</div>

			<br>
			<button class="btn btn-danger float-end">Save</button>
			<a href="index.php?pg=admin&tab=tables">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>
		</form>
	</div>

<?php require views_path('partials/footer');?>