<!DOCTYPE html>
<html>
<head>
	<title>Staff--Update Courier</title>
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
		require_once 'shared/sidebar.php';

		// navbar
		require_once 'views/shared/navbar.php';

	?>

	<div class="container bg-white shadow p-3 rounded mb-2">
		<form>
		  <!-- Customer's Info -->
		  <h2 class="text-center">Update Customer's Info</h2>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="senderBranch">Sender Branch</label>
		      <select id="senderBranch" class="form-control">
		        <option selected>Choose...</option>
		        <option>...</option>
		      </select>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="receiverBranch">Receiver Branch</label>
		      <select id="receiverBranch" class="form-control">
		        <option selected>Choose...</option>
		        <option>...</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderName">Sender Name</label>
			    <input type="text" class="form-control" id="senderName" placeholder="Sender Name">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverName">Receiver Name</label>
			    <input type="text" class="form-control" id="receiverName" placeholder="Receiver Name">
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderAddress">Sender Address</label>
			    <input type="text" class="form-control" id="senderAddress" placeholder="Sender Address">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverAddress">Receiver Address</label>
			    <input type="text" class="form-control" id="receiverAddress" placeholder="Receiver Address">
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderPhone">Phone</label>
			    <input type="text" class="form-control" id="senderPhone" placeholder="Phone">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverPhone">Phone</label>
			    <input type="text" class="form-control" id="receiverPhone" placeholder="Phone">
			  </div>
		  </div>
		  <div class="form-row">
			  <div class="form-group col-md-6">
			    <label for="senderEmail">Sender Email</label>
			    <input type="text" class="form-control" id="senderEmail" placeholder="Sender Email">
			  </div>
			  <div class="form-group col-md-6">
			    <label for="receiverEmail">Receiver Email</label>
			    <input type="text" class="form-control" id="receiverEmail" placeholder="Receiver Email">
			  </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="senderCountry">Sender Country</label>
		      <select id="senderCountry" class="form-control">
		        <option selected>Choose...</option>
		        <option>...</option>
		      </select>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="receiverCountry">Receiver Country</label>
		      <select id="receiverCountry" class="form-control">
		        <option selected>Choose...</option>
		        <option>...</option>
		      </select>
		    </div>
		  </div>

		  <!-- Courier Details -->
		  <h2 class="text-center">Courier Details</h2>
		  <div class="form-group w-75 m-auto">
		    <label for="parcelWeight">Parcel Weight(in KG)</label>
		    <input type="text" class="form-control" id="parcelWeight" placeholder="Weight">
		  </div>
		  <div class="form-row w-75 m-auto p-0">
			  <label for="dimension" class="mt-2">Parcel Dimension</label>
			  <div id="dimension" class="d-flex w-100 p-0">
				  <div class="form-group d-inline-block col-md-4 pl-0 m-0">
				    <input type="text" class="form-control" id="plength" placeholder="lenght">
				  </div>
				  <div class="form-group d-inline-block col-md-4 m-0">
				    <input type="text" class="form-control" id="breath" placeholder="breath">
				  </div>
				  <div class="form-group d-inline-block col-md-4 pr-0 m-0">
				    <input type="text" class="form-control" id="breath" placeholder="height">
				  </div>
			  </div>	
		  </div>
		  <div class="form-group w-75 m-auto">
		    <label for="courierDes" class="mt-2">Courier Description</label>
		    <textarea class="form-control" id="courierDes" rows="3"></textarea>
		  </div>
		  <div class="form-group w-75 m-auto">
		    <label for="parcelprice" class="mt-2">Parcel Price(in USD)</label>
		    <input type="text" class="form-control" id="parcelprice" placeholder="Price">
		  </div>
		  <br>
		  <button type="submit" class="btn btn-success d-block m-auto">Update</button>
		</form>
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