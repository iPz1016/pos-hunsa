<?php require views_path('partials/header'); ?>

<div class="container-fluid p-0">
	<div class="card border">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle elevation-2" src="./assets/images/avatar_anonymous.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><a href="#" class="d-block"><?php echo esc(strtoupper(Auth::get(('firstname'))." ".Auth::get(('lastname'))));?></a></h3>
                <p class="text-muted text-center m-0">Manager</p>
            </div>
        </div>

	<div class="col bg-light m-2 p-0">
		<div class="row d-flex align-items-center">
			<?php

			switch ($tab) {
				case 'dashboard':
				case 'menu':
				case 'users':
				case 'sales':
				case 'tables':
					require views_path('admin/btn-main');
					break;
			}
			?>
		</div>

		<?php

		switch ($tab) {
			case 'dashboard':
				require views_path('admin/dashboard');
				break;

			case 'menu':
				require views_path('admin/menu');
				break;

			case 'users':
				require views_path('admin/users');
				break;

			case 'sales':
				require views_path('admin/sales');
				break;

			case 'tables':
				require views_path('admin/tables');
				break;

			default:
				require views_path('admin/main');
				break;
		}
		?>
	</div>

</div>
<?php require views_path('partials/footer'); ?>
