<!DOCTYPE html>
<html>
<head>
	<title>Staff--View Courier Detail</title>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="" />
    <meta name="author" content="" />

	<!-- Links -->
	<?php 
		require_once './views/shared/linkstop.php';
	?>

	<!-- Style different than other pages of admin -->
	<style type="text/css">
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
		
		if(isset($_SESSION['aid'])) {
			require_once './views/shared/adminsidebar.php';
		} else {
			// sidebar
			require_once './views/shared/staffsidebar.php';
		}

		// navbar
		require_once 'views/shared/navbar.php';

		$senderData = $senderDetail->fetch_assoc();
		$receiverData = $receiverDetail->fetch_assoc();
		$parcelData = $parcelDetail->fetch_assoc();
	?>

	<!-- Dialog box to throw error -->
	  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Opps!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	        <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
	        <p>Somthing went wrong. Please try again.</p>
	        <p><b>Make sure to enter valid status and remarks</b></p>
	      </div>
	      <div class="modal-footer">
	        <button id="close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
	      </div>
	    </div>
	  </div>
	</div>


	<div id="courier-detail" class="container bg-white shadow p-3 rounded mb-2">
		<h3 class="display-4 text-center">Courier Detail</h3>
		<p class="text-center">Reference Number: <?=$ref;?></p>
		<p class="text-center">Courier Date: <?=$date;?></p>
		<div class="row mb-3">
			<div class="col-lg-6 col-sm-12">
				<div class="card-body rounded shadow">
   	 			<table class="table table-hover">
   	 				<thead class="card-header text-center bg-dark text-light">
   	 					<th colspan="2">Sender Details</th>
   	 				</thead>
    				<tbody>
    					<tr>
	    					<td>Branch Name</td>
	    		 			<td><?=$senderData['sbname']; ?></td>
	    				</tr>
	    				<tr>
	    					<td>Sender Name</td>
	    					<td><?=$senderData['cname']; ?></td>
	    				</tr>
	    				<tr>
	    					<td>Address</td>
	    					<td><?=$senderData['cadd']; ?></td>
	    				</tr>
	    				<tr>
	    					<td>Contact</td>
	    					<td><?=$senderData['cphone']; ?></td>
	    				</tr>
	    				<tr>
	    					<td>Country</td>
	    					<td><?=$senderData['scountry']; ?></td>
	    				</tr>
    				</tbody>
    			</table>
  			</div>
		</div>

		<div class="col-lg-6 col-sm-12">
				<div class="card-body rounded shadow">
   	 			<table class="table table-hover">
   	 				<thead class="card-header text-center bg-dark text-light">
   	 					<th colspan="2">Recipients Details</th>
   	 				</thead>
    				<tbody>
    					<tr>
	    					<td>Branch Name</td>
	    		 			<td><?=$receiverData['rbname'];?></td>
	    				</tr>
	    				<tr>
	    					<td>Recipient Name</td>
	    					<td><?=$receiverData['cname'];?></td>
	    				</tr>
	    				<tr>
	    					<td>Address</td>
	    					<td><?=$receiverData['cadd'];?></td>
	    				</tr>
	    				<tr>
	    					<td>Contact</td>
	    					<td><?=$receiverData['cphone'];?></td>
	    				</tr>
	    				<tr>
	    					<td>Country</td>
	    					<td><?=$receiverData['rcountry'];?></td>
	    				</tr>
    				</tbody>
    			</table>
  			</div>
		</div>

			</div>

			<div class="row px-lg-5 mb-3">
				<div class="col-lg-12">
				<div class="card-body rounded shadow ml-lg-3 mr-lg-3">
	   	 			<table class="table table-hover">
	   	 				<thead class="card-header text-center bg-dark text-light">
	   	 					<th colspan="2" class="">Parcel Description</th>
	   	 				</thead>
	    				<tbody>
	    					<tr>
		    					<td>Parcel Weight</td>
		    		 			<td><?=$parcelData['pweight'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Parcel Dimension Length</td>
		    					<td><?=$parcelData['pdlength'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Parcel Dimension Breadth: </td>
		    					<td><?=$parcelData['pdbreadth'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Parcel Dimension Height</td>
		    					<td><?=$parcelData['pdheight'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Parcel Price</td>
		    					<td><?="$".$parcelData['pprice'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Status</td>
		    					<td><?=$parcelData['pstatus'];?></td>
		    				</tr>
	    				</tbody>
	    			</table>
  				</div>
				</div>
			</div>

			<div class="row px-lg-5 mb-3 text-center">
				<div class="col-lg-12">
					<div class="card-body rounded shadow ml-lg-3 mr-lg-3">
   	 					<table class="table table-hover">
   	 						<thead class="card-header text-center bg-dark text-light">
   	 							<th>Date</th>
   	 							<th>Remarks</th>
   	 							<th>Status</th>
   	 						</thead>
    						<tbody>
    							<tr>
    							<?php 
								while( $row = $parcelHistory->fetch_assoc()){ ?>
	    		 					<td><?=$row['phdate'];?></td>
	    		 					<td><?=$row['phremarks'];?></td>
	    		 					<td><?=$row['phstatus'];?></td>
	    						</tr>
	    						<?php 
				    			} ?>
    						</tbody>
    					</table>
  					</div>
				</div>
		</div>
		<?php  
			$stat = $parcelData['pstatus'];
			if(isset($_SESSION['sid']) && $stat !== "delivered") {
				require_once './views/staff/shared/statusChangeModal.php';
			}
		?>
		
	</div>


	<!-- closing div of wrapper of sidebar -->
		</div>
	</div>

	<!-- JS Linking -->
	<?php 
		require_once './views/shared/linksbottom.php';
	?>

	<!-- Custom javascript file -->
	<script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/staff.js"></script>

	<script type="text/javascript">
		$("#actionButtonModal").prependTo("body");
	</script>

</body>
</html>