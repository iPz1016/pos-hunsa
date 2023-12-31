<div class="container-fluid row">
	<!-- Sales Section -->
    	<div class="col">
		<!-- Total Sales for Today -->
		<h3 class="text m-3">Today's Total: ฿<?=number_format($sales_total,2)?></h3>
		<!-- Sales Search Form -->
		<form class="row d-flex justify-content-center m-2">
			<div class="col-sm-3 fw-bold">
				<label for="start">Start Date:</label>
				<input class="form-control" id="start" type="date" name="start" value="<?=!empty($_GET['start']) ? $_GET['start']:''?>">
			</div>
			<div class="col-sm-3 fw-bold">
				<label for="end">End Date:</label>
				<input class="form-control" id="end" type="date" name="end" value="<?=!empty($_GET['end']) ? $_GET['end']:''?>">
			</div>
			<div class="col-sm-2 fw-bold">
				<label for="limit">Rows:</label>
				<input class="form-control" id="limit" type="number" min="1" name="limit" value="<?=!empty($_GET['limit']) ? $_GET['limit']:'20'?>">
			</div>
			<div class="col-sm-2 d-flex fw-bold">
				<button class="btn col btn-dark btn-sm fs-5">Go <i class="fa fa-chevron-right"></i></button>
			</div>
			<input type="hidden" name="pg" value="admin">
			<input type="hidden" name="tab" value="sales">
		</form>
		<div class="clearfix" ></div>

		<!-- Sales Table -->
		<div class="table-responsive table-h-36">
			<table class="table table-striped table-hover">
				<thead>
					<tr class="fs-5">
						<th class="fw-black">Orders ID</th>
						<th class="fw-black">Menu name</th>
						<th class="fw-black">Qty</th>
						<th class="fw-black">Amount</th>
						<th class="fw-black">Total</th>
						<th class="fw-black">Cashier</th>
						<th class="fw-black">Date</th>
						<th></th>
					</tr>
				</thead>

				<!-- Sales Table Data -->
				<?php if (!empty($sales)):?>
					<?php foreach ($sales as $sale):?>
					<tr>
						<td><?=esc($sale['orders_id'])?></td>
						
						<td>
							<?=esc($sale['menu_name'])?>
						</td>
						<td><?=esc($sale['qty'])?></td>
						<td><?=esc($sale['menu_price'])?></td>
						<td><?=esc($sale['menu_price']*$sale['qty'])?></td>
						<?php 
							$cashier = get_user_by_id($sale['staff_id']);
							if(empty($cashier)){
								$name = "Unknown";
								$namelink = "#";
							}else{
								$name = strtoupper($cashier['firstname']);
								$namelink = "index.php?pg=profile&id=".$cashier['id'];
							}
						?>
						<td>
							<!-- Cashier Name -->
							<a href="<?=$namelink?>">
								<?=esc($name)?>
							</a>
						</td>
				
						<td><?=date("jS M, Y",strtotime($sale['time']))?></td>
					</tr>
					<?php endforeach;?>
				<?php endif;?>
				
			</table>

			<?php

				$pager->display();
			?>
		</div>
	</div>
</div>









