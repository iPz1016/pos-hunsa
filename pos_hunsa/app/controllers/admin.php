<?php 

$tab = $_GET['tab'] ?? 'dashboard';


if($tab == "menu")
{

	$menuClass = new Menu_info();
	$products = $menuClass->getAll(300,0,'asc','menu_id');
}else
if($tab == "sales")
{
	
	$section = $_GET['s'] ?? 'table';
	$startdate = $_GET['start'] ?? null;
	$enddate = $_GET['end'] ?? null;


	$history_class = new History();
	
	$limit = $_GET['limit'] ?? 20;
	$limit = (int)$limit;
	$limit = $limit < 1 ? 10 : $limit;

	$pager = new Pager($limit);
	$offset = $pager->offset;

	$query = "select * from history order by orders_id desc limit $limit offset $offset";

	//get today's sales total
	$year = date("Y");
	$month = date("m");
	$day = date("d");

	$query_total = "SELECT sum(qty*menu_price) as total FROM history WHERE day(time) = $day && month(time) = $month && year(time) = $year";


	//if both start and end are set
 	if($startdate && $enddate)
 	{
 		
 		$query = "select * from history where time BETWEEN '$startdate' AND '$enddate' order by orders_id desc limit $limit offset $offset";
 		$query_total = "select sum(qty*menu_price) as total from history where time BETWEEN '$startdate' AND '$enddate'";
 	
 	}else

	//if only start date is set
 	if($startdate && !$enddate)
 	{
 		$styear = date("Y",strtotime($startdate));
 		$stmonth = date("m",strtotime($startdate));
 		$stday = date("d",strtotime($startdate));
 		
 		$query = "select * from history where time = '$startdate' order by orders_id desc limit $limit offset $offset";
 		$query_total = "select sum(qty*menu_price) as total from history where time = '$startdate' ";
 	}
	

	$sales = $history_class->query($query);

	$st = $history_class->query($query_total);
	
	$sales_total = 0;
	if($st){
		$sales_total = $st[0]['total'] ?? 0;
	}

	if($section == 'graph')
	{
		//read graph data
		$db = new Database();

		//query todays records
		$today = date('Y-m-d');
		$query = "SELECT qty*menu_price total,time FROM history WHERE DATE(time) = '$today';";
		$today_records = $db->query($query);

		//query this months records
		$thismonth = date('m');
		$thisyear = date('Y');

		$query = "SELECT qty*menu_price total,time FROM history WHERE month(time) = '$thismonth' && year(time) = '$thisyear'";
		$thismonth_records = $db->query($query);

		//query this years records
		$query = "SELECT qty*menu_price total,time FROM history WHERE year(time) = '$thisyear'";
		$thisyear_records = $db->query($query);

	}

}else
if($tab == "users")
{

	$limit = 10;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$userClass = new User();
	$users = $userClass->query("select * from users order by id asc limit $limit offset $offset");
}else
if($tab == "dashboard")
{

	$db = new Database();
	$query = "select count(id) as total from users";

	$myusers = $db->query($query);
	$total_users = $myusers[0]['total'];

	$query = "select count(menu_id) as total from menu_info";

	$myproducts = $db->query($query);
	$total_products = $myproducts[0]['total'];

	$query = "select sum(qty*menu_price) as total from history";

	$mysales = $db->query($query);
	$total_sales = $mysales[0]['total'];

}else
if($tab == "tables")
{
	$tableClass = new Table_info();
	$table_info = $tableClass->getAll(300,0,'asc','table_id');
}



if(Auth::access('admin')){
	require views_path('admin/admin');
}else{

	Auth::setMessage("You dont have access to the admin page");
	require views_path('auth/denied');
}

