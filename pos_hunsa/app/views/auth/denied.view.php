<?php require views_path('partials/header');?>

<!-- Display access denied message and actions -->
		<div class="mt-7">
			<img src='<?= WARNING_ICON ?>'width='150' draggable="false">
			<h1>Access Denied!</h1>
			<div><?=Auth::getMessage()?></div>

			<!-- Provide a button to either navigate to the home page or the login page based on user authentication -->
			<?php if(Auth::logged_in()): ?>
				<a href="index.php?pg=home"><button class="btn btn-info my-2 w-25 py-4 fw-bold" style="font-size: 36px"> HOME</button></a>
			<?php else: ?>
				<a href="index.php?pg=login"><button class="btn btn-info my-2 w-25 py-4 fw-bold" style="font-size: 36px"> LOGIN</button></a>
			<?php endif ?>

		</div>
	
<?php require views_path('partials/footer');?>