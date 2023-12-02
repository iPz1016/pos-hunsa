<div class="row justify-content-center">
	<div class="col-md-3 border rounded p-4 my-2">
		<i class="fa fa-user" style="font-size: 30px"></i>
		<h4>Total Users:</h4>
		<h2><?=$total_users?></h2>
	</div>
	<div class="col-md-3 border rounded p-4 my-2">
		<i class="fa fa-hamburger" style="font-size: 30px"></i>
		<h4>Total Menu:</h4>
		<h2><?=$total_products?></h2>
	</div>
	<div class="col-md-3 border rounded p-4 my-2">
		<i class="fa fa-money-bill-wave" style="font-size: 30px"></i>
		<h4>Total Sales:</h4>
		<h2><?=$total_sales?></h2>
	</div>
	
</div>

<?php 

		$graph = new Graph();
		
		$data = generate_daily_data($today_records);
		$graph->title = "Today's sales";
		$graph->xtitle = "Hours of the day";
		$graph->styles = "width:80%;margin:auto;display:block";
		$graph->display($data);

	?>
	<br>

	<?php 

		$data = generate_monthly_data($thismonth_records);
		$graph->title = "This month's sales";
		$graph->xtitle = "Days of the month";
		$graph->styles = "width:80%;margin:auto;display:block";
		$graph->display($data);

	?>
	<br>

	<?php 

		$data = generate_yearly_data($thisyear_records);
		$graph->title = "This year's sales";
		$graph->xtitle = "Months of the year";
		$graph->styles = "width:80%;margin:auto;display:block";
		$graph->display($data);

	?>
	<br>