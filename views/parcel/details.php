<?php  
	$utype = (isset($_SESSION['aid']))?"Admin":"Staff";
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $utype;?>--Courier View
	</title>

	<!-- Links -->
	<?php 
		require_once './views/shared/linkstop.php';
	?>

	<style type="text/css">
		@media screen and (max-width: 993px) {
			.wrapper {
        		height: calc(100vh + 300px);
    		}
		}
	</style>

</head>
<body>
	<!-- Reusable sidebar and Navbar -->
	<?php 
		// if admin is logged in use sidebar of admin
		// otherwise use siderbar of staff
		if($utype === "Admin") {
			// sidebar
			require_once './views/shared/adminsidebar.php';
		} else {
			// sidebar
			require_once './views/shared/staffsidebar.php';
		}
		// navbar
		require_once 'views/shared/navbar.php';

	?>


	<div class="container d-flex flex-column shadow p-3 bg-white rounded">
		
		<h2 class="text-center">Courier Details(Total Pickup)</h2>

		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">S.N.</th>
				      <th scope="col">Reference Number</th>
				      <th scope="col">Sender Name</th>
				      <th scope="col">Recipient Name</th>
				      <th scope="col">Courier Date</th>
				      <th scope="col">Action</th>	
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    <?php 
				     $sn = 1;
				     while( $row = $result->fetch_assoc()){ ?>
				      <th scope="row"><?php echo $sn; ?></th>
				      <td><?php echo $row['prefnum'] ?></td>
				      <td><?php echo $row['sender'] ?></td>
				      <td><?php echo $row['receiver'] ?></td>
				      <td><?php echo $row['c_date'] ?></td>
				      <td>
				      	<a href="<?= URLROOT;?>/Parcel/courierDetail?ref-num=<?=$row['prefnum']; ?>&&date=<?=$row['c_date']; ?>" class="btn btn-success ml-4">View Details</a>
				      </td>
				    </tr>
				    <?php 
				    	$sn++;
				    } ?>
				  </tbody>
			</table>
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