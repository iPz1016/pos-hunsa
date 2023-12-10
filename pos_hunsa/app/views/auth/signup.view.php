<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-6 col-md-6 mt-5 p-4">
	<h3 class="mb-3"><i class="fa fa-user"></i> Create User</h3>
	<form method="post" class="overflow-auto">

		<div>
			<!-- Username validation error message -->
			<?php if (!empty($errors['username'])) : ?>
				<small class="text-danger col-12"><?= $errors['username'] ?></small>
			<?php endif; ?>
		</div>

		<!-- Username input field -->
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Username:</span>
			<input value="<?= set_value('username') ?>" name="username" type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Username">
		</div>
		
		<div>
			<!-- Firstname validation error message -->
			<?php if (!empty($errors['firstname'])) : ?>
				<small class="text-danger col-12"><?= $errors['firstname'] ?></small>
			<?php endif; ?>
		</div>

		<!-- Firstname input field -->
		<div class="input-group mb-3">
			<span class="input-group-text">First Name:</span>
			<input name="firstname" value="<?= set_value('firstname') ?>" type="text" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : '' ?>" placeholder="First Name" aria-label="Firstname">
		</div>

		<div>
			<!-- Lastname validation error message -->
			<?php if (!empty($errors['lastname'])) : ?>
				<small class="text-danger col-12"><?= $errors['lastname'] ?></small>
			<?php endif; ?>
		</div>

		<!-- Lastname input field -->
		<div class="input-group mb-3">
			<span class="input-group-text">Last Name:</span>
			<input name="lastname" value="<?= set_value('lastname') ?>" type="text" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : '' ?>" placeholder="Last Name" aria-label="Lastname">
		</div>

		<div class="input-group mb-3">
			<!-- Role validation error message -->
			<span class="input-group-text" id="basic-addon1">Role:</span>
			<select name="role" class="form-control  <?= !empty($errors['role']) ? 'border-danger' : '' ?>" required>
				<option value="" selected disabled>Click to select role</option>
				<option value="cashier">Cashier</option>
				<option value="manager">Manager</option>
			</select>
		</div>

		<!-- Password validation error message -->
		<div>
			<?php if (!empty($errors['password'])) : ?>
				<small class="text-danger col-12"><?= $errors['password'] ?></small>
			<?php endif; ?>
		</div>

		<!-- Password input field -->
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Password:</span>
			<input value="<?= set_value('password') ?>" name="password" type="password" class="form-control  <?= !empty($errors['password']) ? 'border-danger' : '' ?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
		</div>

		<!-- Retype Password validation error message -->
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Retype Password:</span>
			<input value="<?= set_value('password_retype') ?>" name="password_retype" type="password" class="form-control  <?= !empty($errors['password_retype']) ? 'border-danger' : '' ?>" placeholder="Retype Password" aria-label="Username" aria-describedby="basic-addon1">
			<?php if (!empty($errors['password_retype'])) : ?>
				<small class="text-danger col-12"><?= $errors['password_retype'] ?></small>
			<?php endif; ?>
		</div>

		<!-- Create and Cancel buttons -->
		<button class="btn btn-success float-end btn-lg">Create</button>
		<a href="index.php?pg=admin&tab=users">
			<button type="button" class="btn btn-danger float-start btn-lg">Cancel</button>
		</a>	
	</form>
</div>

<?php require views_path('partials/footer'); ?>