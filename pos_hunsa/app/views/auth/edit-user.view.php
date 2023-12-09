<?php

if (!empty($_SESSION['referer'])) {
	$back_link = $_SESSION['referer'];
} else {
	$back_link = "index.php?pg=admin&tab=users";
}

?>

<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<?php if (is_array($row)) : ?>
		<form method="post" enctype="multipart/form-data">
			<div class="justfy-content-center mb-4">
				<h3><i class="fa fa-user"></i> Edit User</h3>
				<div><?= esc(APP_NAME) ?></div>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Username:</span>
				<input value="<?= set_value('username', $row['username']) ?>" name="username" type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Username">
				<?php if (!empty($errors['username'])) : ?>
					<small class="text-danger"><?= $errors['username'] ?></small>
				<?php endif; ?>
			</div>

			<div>
				<?php if (!empty($errors['firstname'])) : ?>
					<small class="text-danger float-start"><?= $errors['firstname'] ?></small>
				<?php endif; ?>
				<?php if (!empty($errors['lastname'])) : ?>
					<small class="text-danger float-end"><?= $errors['lastname'] ?></small>
				<?php endif; ?>
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text">First Name:</span>
				<input name="firstname" value="<?= set_value('firstname', $row['firstname']) ?>" type="text" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : '' ?>" placeholder="First Name" aria-label="Firstname">
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text">Last Name:</span>
				<input name="lastname" value="<?= set_value('lastname', $row['lastname']) ?>" type="text" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : '' ?>" placeholder="Last Name" aria-label="Lastname">
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Role:</span>
				<select name="role" class="form-control  <?= !empty($errors['role']) ? 'border-danger' : '' ?>">
					<?php
					if (Auth::get('id') == $row['id']) {
						echo "<option>" . $row['role'] . "</option>";
					} else {
						echo "<option>".$row['role']."</option> <option>cashier</option>  <option>manager</option>";
					}
					?>
				</select>
				<?php if (!empty($errors['role'])) : ?>
					<small class="text-danger"><?= $errors['role'] ?></small>
				<?php endif; ?>
			</div>


			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Password</span>
				<input value="<?= set_value('password', '') ?>" name="password" type="password" class="form-control  <?= !empty($errors['password']) ? 'border-danger' : '' ?>" placeholder="Password(leave empty to not change)" aria-label="Password" aria-describedby="basic-addon1">
				<br>
				<?php if (!empty($errors['password'])) : ?>
					<small class="text-danger col-12"><?= $errors['password'] ?></small>
				<?php endif; ?>
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Retype Password</span>
				<input value="<?= set_value('password_retype', '') ?>" name="password_retype" type="password" class="form-control  <?= !empty($errors['password_retype']) ? 'border-danger' : '' ?>" placeholder="Retype Password(leave empty to not change)" aria-label="Username" aria-describedby="basic-addon1">
				<?php if (!empty($errors['password_retype'])) : ?>
					<small class="text-danger col-12"><?= $errors['password_retype'] ?></small>
				<?php endif; ?>
			</div>

			<div class="row justify-content-center">
				<div class="col-1">
					<button class="btn btn-primary float-end px-4">Save</button>
				</div>
				<div class="col-1">
					<a href="<?= $back_link ?>">
						<button type="button" class="btn btn-danger px-4">Cancel</button>
					</a>
				</div>
			</div>

			<div class="clearfix"></div>
		</form>
	
	<?php else : ?>
		<div class="alert alert-danger text-center">User Not Found!</div>

		<a href="<?= $back_link ?>">
			<button type="button" class="btn btn-danger">Cancel</button>
		</a>

	<?php endif; ?>
</div>

<?php require views_path('partials/footer'); ?>