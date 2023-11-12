<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<?php if(!empty($row)):?>

		<form method="post" enctype="multipart/form-data">

			<h5 class="text-primary"><i class="fa fa-hamburger"></i> Edit Sale</h5>
			
			<div class="mb-3">
			  <label for="saleControlInput1" class="form-label">Menu name</label>
			  <input value="<?=set_value('description',$row['menu_name'])?>" name="menu_name" type="text" class="form-control <?=!empty($errors['description']) ? 'border-danger':''?>" id="saleControlInput1" placeholder="Sale description">
			  <?php if(!empty($errors['menu_name'])):?>
					<small class="text-danger"><?=$errors['menu_name']?></small>
				<?php endif;?>
			</div>
	 
			<div class="input-group mb-3">
			  <span class="input-group-text">Qty:</span>
			  <input name="qty" value="<?=set_value('qty',$row['qty'])?>" type="number" class="form-control <?=!empty($errors['qty']) ? 'border-danger':''?>" placeholder="Quantity" aria-label="Quantity">
			  <span class="input-group-text">Amount:</span>
			  <input name="menu_price" value="<?=set_value('menu_price',$row['menu_price'])?>" step="0.05" type="number" class="form-control <?=!empty($errors['amount']) ? 'border-danger':''?>" placeholder="Amount" aria-label="Amount">
			</div>
				<?php if(!empty($errors['qty'])):?>
					<small class="text-danger"><?=$errors['qty']?></small>
				<?php endif;?>
				<?php if(!empty($errors['menu_price'])):?>
					<small class="text-danger"><?=$errors['menu_price']?></small>
				<?php endif;?>
				<br>
			
			<button class="btn btn-danger float-end">Save</button>
			<a href="index.php?pg=admin&tab=sales">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>
		</form>
		<?php else:?>
			That record was not found
			<br><br>
			<a href="index.php?pg=admin&tab=sales">
				<button type="button" class="btn btn-primary">Back to sales</button>
			</a>

		<?php endif;?>

	</div>

<?php require views_path('partials/footer');?>