<?php require views_path('partials/header'); ?>

<div style="color:#444">
	<div class="p-2">
		<h2><i class="fa fa-user-shield"></i> Admin</h2>
		<h5 class="text-center fw-normal">
			<?php echo 'Hi, '.esc(strtoupper(Auth::get(('firstname'))." ".Auth::get(('lastname'))));?>
		</h5>
	</div>

	<div class="border col m-2 p-0">

		<h2 class="my-3"><?= strtoupper($tab) ?></h2>

		<?php

		switch ($tab) {
			case 'dashboard':
				// code...
				require views_path('admin/dashboard');
				break;

			case 'menu':
				// code...
				require views_path('admin/menu');
				break;

			case 'users':
				// code...
				require views_path('admin/users');
				break;

			case 'sales':
				// code...
				require views_path('admin/sales');
				break;

			case 'tables':
				// code...
				require views_path('admin/tables');
				break;

			default:
				// code...
				require views_path('admin/main');
				break;
		}
		?>
	</div>

</div>
<?php require views_path('partials/footer'); ?>
