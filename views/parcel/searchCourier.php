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
	<!-- Style Sheet for search box -->
	<link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/css/searchbox.css">

	<style type="text/css">
		#search-area {
			background: #fff !important;
			height: 75vh;
		}
		@media screen and (max-width: 993px) {
			.wrapper {
        		height: 100vh;
    		}
		}
		@media screen and (max-width: 775px) {
			.wrapper {
        		height: 100vh;
    		}	
		}

		@media screen and (max-width: 993px) {
			.wrapper {
        		height: calc(100vh + 1030px);
    		}
		}
		@media screen and (max-width: 775px) {
			.wrapper {
        		height: calc(100vh + 1200px);
    		}	
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


		// search box 
		require_once './views/shared/searchbox.php';
	?>

	<!-- Custom Script -->
	<script type="text/javascript">
		let searchDiv = document.getElementById('search-area');
		// remove the container fluid class 
		// add container class
		// because for staff panel for every page we used container insted of container-fluid

		searchDiv.classList.remove('container-fluid');
		searchDiv.classList.remove('image-fluid');
		searchDiv.classList.add('container');
		searchDiv.classList.add('bg-white');
		searchDiv.classList.add('shadow');
		searchDiv.classList.add('rounded');
		searchDiv.classList.add('p-3');
	</script>
  
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