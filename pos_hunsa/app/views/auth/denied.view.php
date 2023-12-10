<?php require views_path('partials/header');?>

		<div class="mt-7">
			<img src='<?= WARNING_ICON ?>'width='150' draggable="false">
			<h1>Access Denied!</h1>
			<div><?=Auth::getMessage()?></div>

			<?php if(Auth::logged_in()): ?>
				<a href="index.php?pg=home"><button class="btn btn-info my-2 w-25 py-4" style="font-size: 36px; font-weight: 700"> HOME</button></a>
			<?php else: ?>
				<a href="index.php?pg=login"><button class="btn btn-info my-2 w-25 py-4" style="font-size: 36px; font-weight: 700"> LOGIN</button></a>
			<?php endif ?>

		</div>
	
<?php require views_path('partials/footer');?>