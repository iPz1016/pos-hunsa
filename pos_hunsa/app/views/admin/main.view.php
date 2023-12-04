<?php require views_path('partials/header'); ?>

	<div class="container-fluid">
		<div class="container-fluid  d-flex justify-content-center">
			<a href="index.php?pg=admin&tab=dashboard">
				<li class="list-group-item <?= !$tab || $tab == 'dashboard' ? 'active' : '' ?> h4 m-3 border rounded-3 dashboard d-flex align-center bg-black text-white"><i class="fa fa-th-large"></i> Dashboard</li>
			</a>
			<a href="index.php?pg=admin&tab=users">
				<li class="list-group-item <?= $tab == 'users' ? 'active' : '' ?> h4 m-3 border rounded-3 dashboard d-flex align-center bg-black text-white"><i class="fa fa-users"></i> Users</li>
			</a>
			<a href="index.php?pg=admin&tab=menu">
				<li class="list-group-item <?= $tab == 'menu' ? 'active' : '' ?> h4 m-3 border rounded-3 dashboard d-flex align-center bg-black text-white"><i class="fa fa-hamburger"></i> Menu</li>
			</a>
			<a href="index.php?pg=admin&tab=sales">
				<li class="list-group-item <?= $tab == 'sales' ? 'active' : '' ?> h4 m-3 border rounded-3 dashboard d-flex align-center bg-black text-white"><i class="fa fa-money-bill-wave"></i> Sales</li>
			</a>
			<a href="index.php?pg=admin&tab=tables">
				<li class="list-group-item <?= $tab == 'tables' ? 'active' : '' ?> h4 m-3 border rounded-3 dashboard d-flex align-center bg-black text-white"><i class="fa fa-chair"></i> Tables</li>
			</a>
		</div>
		<div class="container w-75">
			<a href="index.php?pg=logout">
				<li class="list-group-item m-3 border border-3"><i class="fa fa-sign-out-alt"></i> Logout</li>
			</a>
		</div>
	</div>
<?php require views_path('partials/footer'); ?>