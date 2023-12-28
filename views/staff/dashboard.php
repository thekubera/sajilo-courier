<!DOCTYPE html>
<html>
<head>
	<title>Staff--Dashboard</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="" />
    <meta name="author" content="" />

	<!-- Links -->
	<?php 
		require_once './views/shared/linkstop.php';
	?>
</head>
<body>
	<!-- Reusable sidebar and Navbar -->
	<?php 
		// sidebar
		require_once './views/shared/staffsidebar.php';

		// navbar
		require_once 'views/shared/navbar.php';

	?>

	<!-- Status box for dashboard -->
	<div id="status-box-container"class="container shadow p-3 rounded">
		<div id="card-container" class="row">
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$total_courier;?></h1>
					<h5 class="font-weight-bold text-uppercase">Total Courier</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$statusCount['pickup'];?></h1>
					<h5 class="font-weight-bold text-uppercase">Total Pickup</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$statusCount['in-transit'];?></h1>
					<h5 class="font-weight-bold text-uppercase">Total In-transit</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$statusCount['arrived'];?></h1>
					<h5 class="font-weight-bold text-uppercase">Total Arrived</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$statusCount['outfordelivery'];?></h1>
					<h5 class="font-weight-bold text-uppercase">Total Out For Delivery</h5>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="w-75 h-100 bg-success shadow text-center box">
					<h1><?=$statusCount['delivered'];?></h1>
					<h5 class="font-weight-bolder text-uppercase">Total Delivered</h5>
				</div>
			</div>
		</div>
	</div>

	<!-- closing div of wrapper of sidebar -->
		</div>
	</div>

	<!-- JS Linking -->
	<?php 
		require_once './views/shared/linksbottom.php';
	?>
</body>
</html>