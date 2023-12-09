<?php require views_path('partials/header');?>

	<br>
		<div class="align-center my-3">
			<img src='<?= WARNING_ICON ?>'width='150' draggable="false">
			<h1>Access Denied!</h1>
			<div><?=Auth::getMessage()?></div>
			<a href="index.php?pg=login"><button class="btn btn-info my-2 w-25 py-4" style="font-size: 36px; font-weight: 700"> LOGIN</button></a>
		</div>
	<br>
	
<?php require views_path('partials/footer');?>