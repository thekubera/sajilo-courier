<!DOCTYPE html>
<html>
<head>
	<title>Staff--Add Courier</title>
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
        		height: calc(100vh + 550px);
    		}
		}
		@media screen and (max-width: 775px) {
			.wrapper {
        		height: calc(100vh + 1180px);
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
	        <p><b>Make sure to enter valid info which are not associated with another customer.</b></p>
	      </div>
	      <div class="modal-footer">
	        <button id="close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container bg-white shadow p-3 rounded mb-2">
		<form id="addCourier" action="Parcel/add" method="POST">
		  <!-- Customer's Info -->
		  <h2 class="text-center">Customer's Info</h2>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="senderBranch">Sender Branch</label>
		      <select id="senderBranch" class="form-control" name="sbranch">
		        <?php  
		        	foreach($current as $row) {
		        		echo "<option value = ".$row['bid'].">".$row['bname']. "</option>";
		        	}
		        ?>
		      </select>
		      <small id="sberror" class=""></small>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="receiverBranch">Receiver Branch</label>
		      <select id="receiverBranch" class="form-control" name="rbranch">
		        <option selected disabled>Choose...</option>
		        <?php  
		        	foreach($result as $row) {
		        		echo "<option value = ".$row['bid'].">".$row['bname']. "</option>";
		        	}
		        ?>
		      </select>
		      <small id="rberror" class=""></small>
		    </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderName">Sender Name</label>
			    <input type="text" class="form-control" id="senderName" placeholder="Sender Name" name="sname">
			    <small id="serror"></small>
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverName">Receiver Name</label>
			    <input type="text" class="form-control" id="receiverName" placeholder="Receiver Name" name="rname">
			    <small id="rerror"></small>
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderAddress">Sender Address</label>
			    <input type="text" class="form-control" id="senderAddress" placeholder="Sender Address" name="sadd">
			    <small id="sadderror"></small>
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverAddress">Receiver Address</label>
			    <input type="text" class="form-control" id="receiverAddress" placeholder="Receiver Address" name="radd">
			    <small id="radderror"></small>
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderPhone">Sender Contact</label>
			    <input type="text" class="form-control" id="senderPhone" placeholder="Phone" name="sphone">
			    <small id="sphoneerror"></small>
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverPhone">Receiver Contact</label>
			    <input type="text" class="form-control" id="receiverPhone" placeholder="Phone" name="rphone">
			    <small id="rphoneerror"></small>
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderEmail">Sender Email</label>
			    <input type="text" class="form-control" id="senderEmail" placeholder="Sender Email" name="semail">
			    <small id="semailerror"></small>
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverEmail">Receiver Email</label>
			    <input type="text" class="form-control" id="receiverEmail" placeholder="Receiver Email" name="remail">
			    <small id="remailerror"></small>
			  </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="senderCountry">Sender Country</label>
		      <select id="senderCountry" class="form-control country" name="scountry">
		        <option selected disabled>Choose...</option>
		      </select>
		      <small id="scountryerror"></small>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="receiverCountry">Receiver Country</label>
		      <select id="receiverCountry" class="form-control country" name="rcountry">
		        <option selected disabled>Choose...</option>
		      </select>
		      <small id="rcontryerror"></small>
		    </div>
		  </div>

		  <!-- Courier Details -->
		  <h2 class="text-center">Courier Details</h2>
		  <div class="form-group w-75 m-auto">
		    <label for="parcelWeight">Parcel Weight(in KG)</label>
		    <input type="text" class="form-control" id="parcelWeight" placeholder="Weight" name="pweight">
		    <small id="pwerror"></small>
		  </div>
		  <div class="form-row w-75 m-auto p-0">
			  <label for="dimension" class="mt-2">Parcel Dimension</label>
			  <div id="dimension" class="d-flex w-100 p-0">
				  <div class="form-group d-inline-block col-md-4 pl-0 m-0">
				    <input type="text" class="form-control" id="plength" placeholder="Length" name="len">
				    <small id="plerror"></small>
				  </div>
				  <div class="form-group d-inline-block col-md-4 m-0">
				    <input type="text" class="form-control" id="breath" placeholder="Breadth" name="bre">
				    <small id="pberror"></small>
				  </div>
				  <div class="form-group d-inline-block col-md-4 pr-0 m-0">
				    <input type="text" class="form-control" id="breath" placeholder="Height" name="hei">
				    <small id="pherror"></small>
				  </div>
			  </div>
			  <small id="pderror" class="d-block"></small>	
		  </div>
		  <div class="form-group w-75 m-auto">
		    <label for="courierDes" class="mt-2">Courier Remarks</label>
		    <textarea class="form-control" id="courierDes" rows="3" name="des"></textarea>
		    <small id="pdeserror"></small>
		  </div>
		  <div class="form-group w-75 m-auto">
		    <label for="parcelprice" class="mt-2">Parcel Price(in USD)</label>
		    <input type="text" class="form-control" id="parcelprice" placeholder="Price" name="price">
		    <small id="ppriceerror"></small>
		  </div>
		  <br>
		  <button type="submit" class="btn btn-success d-block m-auto">Add Courier</button>
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
	<script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/staff.js"></script>
</body>
</html>

