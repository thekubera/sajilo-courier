<!DOCTYPE html>
<html>
<head>
<title>Admin--Branch Update</title>
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
        		height: calc(100vh + 300px);
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

	<!-- Dialog box to throw error -->
	    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Opps!</h5>
	        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button> -->
	      </div>
	      <div class="modal-body text-center">
	        <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
	        <p>Somthing went wrong. Please try again.</p>
	        <p>Make sure entered valid data and which are not associated with other branch.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container d-flex flex-column justify-content-center w-50 p-2 bg-white shadow rounded p-0">
		<h2 class="text-center">Update Branch Details</h2>
		<form id="updateBranch" action="Branch/update" method="POST" class="d-flex flex-column justify-content-center align-item-center">
			<?php
		   		//code to access data from result
		   		$row = $result->fetch_assoc();
	
			?>
			<input type="text" name="bid" value="<?php echo $row['bid'] ?>" hidden/>
		  <div class="form-group">
		    <label for="branchName">Branch Name</label>
		    <input type="text" class="form-control" id="branchName" name="bname" value="<?php echo $row['bname'];?>">
		    <small id="bnameError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="branchAddress">Branch Address</label>
		    <input type="text" class="form-control" id="branchAddress" name="badd"	value="<?php echo $row['baddress'];?>">
		    <small id="baddressError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="branchEmail">Branch Email</label>
		    <input type="text" class="form-control" id="branchEmail" name="bemail"	value="<?php echo $row['bemail'];?>">
		    <small id="bemailError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="branchContact">Branch Contact</label>
		    <input type="text" class="form-control" id="branchContact" name="bcontact"	value="<?php echo $row['bphone'];?>">
		    <small id="bcontactError" class=""></small>
		  </div>
		  <div class="form-group">
		      <label for="branchCountry">Branch Country</label>
		      <select id="country" class="form-control" name="bcountry">
		        <option >Choose...</option> 
		      </select>
		      <small id="bcountryError" class=""></small>
		   </div>
		  <div class="d-flex justify-content-center">
		  	<button type="submit" class="btn btn-success mr-2">Update</button>
		  	<a href="Branch/BranchDetails" class="btn btn-secondary">Cancel</a>
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
	<script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/admin.js"></script>
</body>
</html>