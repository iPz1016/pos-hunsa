<div class="container-fluid row">
    <!-- Left menu -->
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

    <!-- Right content -->
    <div class="col">
        <div class="row justify-content-center">
            <!-- Statistical information -->
            <div class="col-md-3 border rounded p-4 my-2">
                <i class="fa fa-user" style="font-size: 30px"></i>
                <h4>Total Users:</h4>
                <h2><!-- Replace with actual data --><?=$total_users?></h2>
            </div>
            <div class="col-md-3 border rounded p-4 my-2">
                <i class="fa fa-hamburger" style="font-size: 30px"></i>
                <h4>Total Menu:</h4>
                <h2><!-- Replace with actual data --><?=$total_products?></h2>
            </div>
            <div class="col-md-3 border rounded p-4 my-2">
                <i class="fa fa-money-bill-wave" style="font-size: 30px"></i>
                <h4>Total Sales:</h4>
                <h2><!-- Replace with actual data --><?=$total_sales?></h2>
            </div>

            <!-- Graphs -->
            <div class="col-md-12">
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
            </div>
        </div>
    </div>
</div>
