<?php require views_path('partials/header'); ?>

<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4">

	<form method="post">
		<center>
			<h3><i class="fa fa-user"></i> Create User</h3>
			<div><?= esc(APP_NAME) ?></div>
		</center>
		<br>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Username:</span>
			<input value="<?= set_value('username') ?>" name="username" type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>" id="exampleFormControlInput1" placeholder="Username">
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
			<span class="input-group-text">First name:</span>
			<input name="firstname" value="<?= set_value('firstname') ?>" type="text" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : '' ?>" placeholder="First name" aria-label="Firstname">


			<span class="input-group-text">Last name:</span>
			<input name="lastname" value="<?= set_value('lastname') ?>" type="text" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : '' ?>" placeholder="Last name" aria-label="Lastname">
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Role:</span>
			<select name="role" class="form-control  <?= !empty($errors['role']) ? 'border-danger' : '' ?>">
				<option>cashier</option>
				<option>manager</option>
			</select>
			<?php if (!empty($errors['role'])) : ?>
				<small class="text-danger"><?= $errors['role'] ?></small>
			<?php endif; ?>
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Password:</span>
			<input value="<?= set_value('password') ?>" name="password" type="password" class="form-control  <?= !empty($errors['password']) ? 'border-danger' : '' ?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
			<br>
			<?php if (!empty($errors['password'])) : ?>
				<small class="text-danger col-12"><?= $errors['password'] ?></small>
			<?php endif; ?>
		</div>

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">Retype Password:</span>
			<input value="<?= set_value('password_retype') ?>" name="password_retype" type="password" class="form-control  <?= !empty($errors['password_retype']) ? 'border-danger' : '' ?>" placeholder="Retype Password" aria-label="Username" aria-describedby="basic-addon1">
			<?php if (!empty($errors['password_retype'])) : ?>
				<small class="text-danger col-12"><?= $errors['password_retype'] ?></small>
			<?php endif; ?>
		</div>

		<br>
		<button class="btn btn-primary float-end">Create</button>

		<a href="index.php?pg=admin&tab=users">
			<button type="button" class="btn btn-danger">Cancel</button>
		</a>
	</form>
</div>

<?php require views_path('partials/footer'); ?>