<?php require views_path('partials/header');?>

	<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >
		
		<?php if(is_array($row)):?>

			<div class="justfy-content-center mb-4">
				<h3><i class="fa fa-user"></i> User Profile</h3>
				<div><?=esc(APP_NAME)?></div>
			</div>

			<table class="table table-hover table-striped">
				

				<tr>
					<th>Username</th><td><?=$row['username']?></td>
				</tr>
				<tr>
					<th>First name</th><td><?=$row['firstname']?></td>
				</tr>
				<tr>
					<th>Last name</th><td><?=$row['lastname']?></td>
				</tr>
				<tr>
					<th>Role</th><td><?=$row['role']?></td>
				</tr>
				
			</table>
			<br>
			<a href="index.php?pg=admin&tab=users">
				<button type="button" class="btn btn-primary btn-lg float-start">Back</button>
			</a>

			<a href="index.php?pg=edit-user&id=<?=$row['id']?>">
				<button type="button" class="btn btn-secondary btn-lg">Edit</button>
			</a>

			<a href="index.php?pg=delete-user&id=<?=$row['id']?>" class="float-end">
				<button type="button" class="btn btn-danger btn-lg float-end">Delete</button>
			</a>

			


		<?php else:?>
			<div class="alert alert-danger text-center">That user was not found!</div>

		<?php endif;?>
	</div>

<?php require views_path('partials/footer');?>
