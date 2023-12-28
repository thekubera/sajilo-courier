<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Staff Profile Update</title>

	<!-- Links -->
	<?php 
		require_once './views/shared/linkstop.php';
	?>

	<style type="text/css">
		@media screen and (max-width: 993px) {
			.wrapper {
        		height: calc(100vh + 485px);
    		}
		}
	</style>
</head>
<body>
	<!-- Reusable sidebar and Navbar -->
	<?php 
		// sidebar
		require_once './views/shared/adminsidebar.php';

		// navbar
		require_once 'views/shared/navbar.php';
	?>

	<div class="container d-flex flex-column justify-content-center align-items-center w-50 h-50 mt-5 shadow p-3 rounded">
		<h2 class="text-center">Courier Count Report</h2>
		<form  id="reportForm" action="Admin/searchReport" method="POST" class="w-50">
			<div class="form-group">
				<label for="fromdate">From date</label>
				<input type="date" id="fromdate" class="form-control" name="fromdate">
				<small id="fromdateErr"></small>
			</div>
			<div class="form-group">
				<label for="todate">To date</label>
				<input type="date" id="todate" class="form-control" name="todate">
				<small id="todateErr"></small>
			</div>
			<div class="text-center mb-0">
				<button type="submit" class="btn btn-primary">View</button>
			</div>
		</form>
	</div>

<!-- closing div of wrapper of sidebar -->
		</div>
	</div>


	<!-- JS Linking -->
	<?php 
		require_once './views/shared/linksbottom.php';
	?>

	<!-- Custom javascript file -->
	<script type="text/javascript" src="<?= URLROOT;?>/libraries/js/admin.js"></script>
</body>
</html>