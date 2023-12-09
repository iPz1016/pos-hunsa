<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto mt-4 pb-5">
		
		<!-- Header -->
		<div class="justify-content-center mb-4">
			<h3><i class="fa fa-chair"></i> Add Table</h3>
			<div><?= esc(APP_NAME) ?></div>
		</div>

		<!-- Enter an amount form -->
		<form method="post" enctype="multipart/form-data">
			<div class="input-group mb-3">
				<span class="input-group-text">Amount:</span>
				<input name="number" type="number" min="1" value="1" step="1" class="form-control">
			</div>
			
			<!-- Add and cancel button -->
			<a href="index.php?pg=admin&tab=tables" class="btn btn-danger float-start btn-lg">Cancel</a>
			<button class="btn btn-success float-end btn-lg">Add</button>
		</form>
		<br>
	</div>

<?php require views_path('partials/footer');?>