<?php require views_path('partials/header'); ?>

	
	<div class="container-fluid" style="height: 820px">
		<div class="container-fluid d-flex justify-content-center">
			<a href="index.php?pg=admin&tab=dashboard" class="dashboard m-3 d-flex align-center">
				<h3>
					<div class="row h2 mb-3">
						<i class="fa fa-th-large"></i>
					</div>
					<div class="row">
						Dashboard
					</div>
				</h3>
			</a>
			<a href="index.php?pg=admin&tab=users" class="dashboard m-3 d-flex align-center">
				<h3>
					<div class="row h2 mb-3">
						<i class="fa fa-users"></i>
					</div>
					<div class="row">
						Users
					</div>
				</h3>
			</a>
			<a href="index.php?pg=admin&tab=menu" class="dashboard m-3 d-flex align-center">
				<h3>
					<div class="row h2 mb-3">
						<i class="fa fa-hamburger"></i>
					</div>
					<div class="row">
						Menu
					</div>
				</h3>
			</a>
		</div>
		<div class="container-fluid  d-flex justify-content-center" >
			<a href="index.php?pg=admin&tab=sales" class="dashboard m-3 d-flex align-center">
				<h3>
					<div class="row h2 mb-3">
						<i class="fa fa-money-bill-wave"></i>
					</div>
					<div class="row">
						Sales
					</div>
				</h3>
			</a>
			<a href="index.php?pg=admin&tab=tables" class="dashboard m-3 d-flex align-center">
				<h3>
					<div class="row h2 mb-3">
						<i class="fa fa-chair"></i>
					</div>
					<div class="row">
						Tables
					</div>
				</h3>
			</a>
		</div>

		<div class="container w-75">
			<a href="index.php?pg=logout">
				<li class="list-group-item h5 m-3 border rounded-2 bg-danger text-white"><i class="fa fa-sign-out-alt"></i> Sign Out</li>
			</a>
		</div>
		
	</div>
<?php require views_path('partials/footer'); ?>