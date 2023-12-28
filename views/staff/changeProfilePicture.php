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
		.container {
			max-width: 550px;
		}
	</style>
</head>
<body>
	<!-- Reusable sidebar and Navbar -->
	<?php 
		// sidebar
		require_once './views/shared/staffsidebar.php';

		// navbar
		require_once 'views/shared/navbar.php';

		// change profile picture section
		require_once 'views/shared/changeProfilePicture.php';
	?>

	

	<!-- closing div of wrapper of sidebar -->
		</div>
	</div>


	<!-- JS Linking -->
	<?php 
		require_once './views/shared/linksbottom.php';
	?>

	<!-- Custom javascript file -->
	<script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/staff.js"></script>
</body>
</html>