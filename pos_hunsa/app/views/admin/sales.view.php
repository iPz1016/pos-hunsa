<div class="container-fluid row">
     <div class="col-12 col-sm-4 col-md-3 col-lg-2">
        	<ul class="list-group">
			<a href="index.php?pg=admin&tab=main">
			<li class="list-group-item <?= !$tab || $tab == 'main' ? 'active' : '' ?>"><i class="fa fa-th-large"></i> Main menu</li>
			</a>
			<a href="index.php?pg=admin&tab=dashboard">
			<li class="list-group-item <?= $tab == 'dashboard' ? 'active' : '' ?>"><i class="fa fa-th-large"></i> Dashboard</li>
			</a>
			<a href="index.php?pg=admin&tab=users">
			<li class="list-group-item <?= $tab == 'users' ? 'active' : '' ?>"><i class="fa fa-users"></i> Users</li>
			</a>
			<a href="index.php?pg=admin&tab=menu">
			<li class="list-group-item <?= $tab == 'menu' ? 'active' : '' ?>"><i class="fa fa-hamburger"></i> Menu</li>
			</a>
			<a href="index.php?pg=admin&tab=sales">
			<li class="list-group-item <?= $tab == 'sales' ? 'active' : '' ?>"><i class="fa fa-money-bill-wave"></i> Sales</li>
			</a>
			<a href="index.php?pg=admin&tab=tables">
			<li class="list-group-item <?= $tab == 'tables' ? 'active' : '' ?>"><i class="fa fa-chair"></i> Tables</li>
			</a>
			<a href="index.php?pg=logout">
			<li class="list-group-item"><i class="fa fa-sign-out-alt"></i> Logout</li>
			</a>
        	</ul>
     </div>

    	<div class="col">
		<h3 class="text m-3">Today's Total: $<?=number_format($sales_total,2)?></h3>
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

		<div class="table-responsive table-h-45">
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
						<th>
							<a href="index.php?pg=home">
								<button class="btn btn-primary btn-sm p-2"><i class="fa fa-plus"></i> Add new</button>
							</a>
						</th>
					</tr>
				</thead>

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
							<a href="<?=$namelink?>">
								<?=esc($name)?>
							</a>
						</td>
				
						<td><?=date("jS M, Y",strtotime($sale['time']))?></td>
						<td>
							<a href="index.php?pg=sale-edit&id=<?=$sale['id']?>">
								<button class="btn btn-success btn-sm">Edit</button>
							</a>
							<a href="index.php?pg=sale-delete&id=<?=$sale['id']?>">
								<button class="btn btn-danger btn-sm">Delete</button>
							</a>
						</td>
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









