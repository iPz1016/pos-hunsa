<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<div class="justfy-content-center mb-4">
		<h3><i class="fa fa-user"></i> Create User</h3>
		<div><?= esc(APP_NAME) ?></div>
	</div>

	<form method="post">
		
		<div>
			<?php if (!empty($errors['username'])) : ?>
				<small class="text-danger"><?= $errors['username'] ?></small>
			<?php endif; ?>
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Username:</span>
			<input value="<?= set_value('username') ?>" name="username" type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Username">
		</div>

		<div>
			<?php if (!empty($errors['firstname'])) : ?>
				<small class="text-danger"><?= $errors['firstname'] ?></small>
			<?php endif; ?>
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text">First Name:</span>
			<input name="firstname" value="<?= set_value('firstname') ?>" type="text" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : '' ?>" placeholder="First Name" aria-label="Firstname">
		</div>

		<div>
			<?php if (!empty($errors['lastname'])) : ?>
				<small class="text-danger"><?= $errors['lastname'] ?></small>
			<?php endif; ?>
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text">Last Name:</span>
			<input name="lastname" value="<?= set_value('lastname') ?>" type="text" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : '' ?>" placeholder="Last Name" aria-label="Lastname">
		</div>
		
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Role:</span>
			<select name="role" class="form-control  <?= !empty($errors['role']) ? 'border-danger' : '' ?>" required>
				<option value="" selected disabled>Click to select role</option>
				<option value="cashier">Cashier</option>
				<option value="manager">Manager</option>
			</select>
		</div>


		<div>
			<?php if (!empty($errors['password'])) : ?>
				<small class="text-danger col-12"><?= $errors['password'] ?></small>
			<?php endif; ?>
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Password:</span>
			<input value="<?= set_value('password') ?>" name="password" type="password" class="form-control  <?= !empty($errors['password']) ? 'border-danger' : '' ?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Retype Password:</span>
			<input value="<?= set_value('password_retype') ?>" name="password_retype" type="password" class="form-control  <?= !empty($errors['password_retype']) ? 'border-danger' : '' ?>" placeholder="Retype Password" aria-label="Username" aria-describedby="basic-addon1">
			<?php if (!empty($errors['password_retype'])) : ?>
				<small class="text-danger col-12"><?= $errors['password_retype'] ?></small>
			<?php endif; ?>
		</div>
		
	
		<button class="btn btn-success float-end px-4 py-2">Create</button>
		<a href="index.php?pg=admin&tab=users">
			<button type="button" class="btn btn-danger float-start px-4 py-2">Cancel</button>
		</a>
		
	</form>
</div>

<?php require views_path('partials/footer'); ?>