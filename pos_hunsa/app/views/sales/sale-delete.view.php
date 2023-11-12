<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<?php if(!empty($row)):?>

		<form method="post" enctype="multipart/form-data">

			<h5 class="text-primary"><i class="fa fa-hamburger"></i> Delete Sale</h5>

			<div class="alert alert-danger text-center">Are you sure you want to delete this sale??!!</div>

			<div class="mb-3">
			  <label for="saleControlInput1" class="form-label">Sale description</label>
			  <input disabled value="<?=set_value('menu_name',$row['menu_name'])?>" name="menu_name" type="text" class="form-control" id="saleControlInput1" placeholder="Sale description">
			</div>
			 
			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Qty</small></label>
			  <input disabled value="<?=set_value('qty',$row['qty'])?>" name="qty" type="text" class="form-control " id="barcodeControlInput1" placeholder="Qty">
			</div>

			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Menu price</small></label>
			  <input disabled value="<?=set_value('menu_price',$row['menu_price'])?>" name="menu_price" type="text" class="form-control " id="barcodeControlInput1" placeholder="Menu price">
			</div>

			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Total</small></label>
			  <input disabled value="<?=set_value('menu_price',$row['menu_price'])*set_value('qty',$row['qty'])?>" name="total" type="text" class="form-control " id="barcodeControlInput1" placeholder="Total">
			</div>

			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Date</small></label>
			  <input disabled value="<?=set_value('time',$row['time'])?>" name="time" type="text" class="form-control " id="barcodeControlInput1" placeholder="Time">
			</div>
			
			<br>
			<button class="btn btn-danger float-end">Delete</button>
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