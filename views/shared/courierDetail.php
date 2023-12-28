<?php  
	$senderData = $senderDetail->fetch_assoc();
	$receiverData = $receiverDetail->fetch_assoc();
	$parcelData = $parcelDetail->fetch_assoc();
?>

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