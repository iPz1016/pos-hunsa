<?php require views_path('partials/header');?>

	<div class="container-fluid border col-lg-6 col-md-6 mt-5 p-4" >
		
		<?php if(is_array($row) && Auth::get('id')!= $id):?>
		<form method="post" class="overflow-auto">
			<div class="m-2">
				<h3 class="text-danger"><i class="fa fa-user"></i> Delete User</h3>
				<div class="alert alert-danger text-center">Are you sure you want to delete this user?!</div>

				<!-- Display user information -->
				<div class="input-group mb-3">
					<span class="input-group-text">Username:</span>
					<div class="form-control"><?=esc($row['username'])?></div>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text">First name:</span>
					<div class="form-control"><?=esc($row['firstname'])?></div>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text">Last name:</span>
					<div class="form-control"><?=esc($row['lastname'])?></div>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text">Role:</span>
					<div class="form-control"><?=esc(strtoupper($row['role']))?></div>
				</div>

				<!-- Delete and Cancel buttons -->
				<button class="btn btn-danger btn-lg float-start">Delete</button>
				<a href="index.php?pg=admin&tab=users">
					<button type="button" class="btn btn-success btn-lg float-end">Cancel</button>
				</a>
			</div>
		</form>
		<?php else:?>
			<!-- Error alert -->
			<?php if(is_array($row) && Auth::get('id')== $id):?>
				<div class="alert alert-danger text-center">Manager cannot delete yourself!<br>Use another manager account to delete!</div>
			<?php else:?>
				<div class="alert alert-danger text-center">User Not Found!</div>
			<?php endif;?>
			
			<!-- Cancel button -->
			<a href="index.php?pg=admin&tab=users">
				<button type="button" class="btn btn-success btn-lg float-end">Cancel</button>
			</a>
		<?php endif;?>
	</div>

<?php require views_path('partials/footer');?>
