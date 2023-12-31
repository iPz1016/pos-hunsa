
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=esc(APP_NAME)?></title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<!-- Kioskboard CSS -->
	<link rel="stylesheet" href="assets/css/kioskboard-2.3.0.min.css" />
	<!-- Kioskboard JS -->
	<script src="assets/js/kioskboard-2.3.0.min.js"></script>
</head>
<body class="login">

	<div class="container-fluid p-0" style="min-width: 350px;">
		<div class="container-fluid border col-lg-4 col-md-5 mt-5 p-4 shadow-sm" >
			<form method="post">
				<h1><img src='<?= APP_LOGO_WITH_TEXT ?>'width='250' draggable="false"></h1>
				<h3 class="mb-3">Login</h3>

				<!-- Input field for username -->
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input  value="<?=set_value('username')?>" autocomplete="off" 
						name="username" type="text" class="form-control  <?=!empty($errors['username']) ? 'border-danger':''?>" 
						id="exampleFormControlInput1" placeholder="Username" autofocus>
					<!-- Display validation error if any -->
					<?php if(!empty($errors['username'])):?>
						<small class="text-danger col-12"><?=$errors['username']?></small>
					<?php endif;?>
				</div> 

				<!-- Input field for password -->
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
					<input value="<?=set_value('password')?>" name="password" type="password" class="form-control <?=!empty($errors['password']) ? 'border-danger':''?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
					<!-- Display validation error if any -->
					<?php if(!empty($errors['password'])):?>
						<small class="text-danger col-12"><?=$errors['password']?></small>
					<?php endif;?>
				</div>

				<!-- Button to submit the form -->
				<div class="row">
					<button class="btn btn-primary" style="font-size: 20px;">Login</button>
				</div>
			</form>
		</div>
	</div>

<?php require views_path('partials/footer');?>
