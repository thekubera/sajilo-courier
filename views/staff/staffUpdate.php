<!DOCTYPE html>
<html>
<head>
<title>Admin--Staff Update</title>
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
	        <p><b>Make sure you entered valid data or check your connection.</b></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div id="staffUpdateContainer" class="container d-flex flex-column justify-content-center w-50 p-2 bg-white shadow rounded p-0">
		<h2 class="text-center">Staff Details</h2>
		<form id="staffUpdate" action="Staff/update" class="d-flex flex-column justify-content-center align-item-center">
		  <div class="form-group">
		      <label for="branchName">Branch Name</label>
		      <select id="branchName" class="form-control" name="bid">
		        <option value="fdfd">Choose...</option>
		        <?php  
		        	while ($row = $result->fetch_assoc()) {
		        		$current = ($row['bname'] == $_GET['name'])?"selected":"";
		        		echo "<option value = ";
		        		echo $row['bid']." ".$current;
		        		echo ">".$row['bname']. "</option>";
		        	}
		        	$staff = $staffInfo->fetch_assoc();
		        ?>
		        
		      </select>
		      <small id="bnameError" class=""></small>
		   </div>
		   <input type="text" name="uid" value="<?php echo $staff['uid'] ?>" hidden/>
		   <input type="text" name="sid" value="<?php echo $_GET['id'] ?>" hidden/>
		  <div class="form-group">
		    <label for="firstName">First Name</label>
		    <input type="text" value="<?php echo $staff['sfname']; ?>" class="form-control" id="firstName" name="fname">
		    <small id="fnameError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="middleName">Middle Name</label>
		    <input type="text" value="<?php echo $staff['smname']; ?>" class="form-control" id="middleName" name="mname">
		    <small id="mnameError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="lastName">Last Name</label>
		    <input type="text" value="<?php echo $staff['slname']; ?>" class="form-control" id="lastName" name="lname">
		    <small id="lnameError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="staffAdd">Address</label>
		    <input type="text" value="<?php echo $staff['saddress']; ?>" class="form-control" id="staffAdd" name="sadd">
		    <small id="saddError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="staffEmail">Staff Email</label>
		    <input type="email" value="<?php echo $staff['email']; ?>" class="form-control" id="staffEmail" name="semail">
		      <small id="semailError" class=""></small>
		  </div>
		  <div class="form-group">
		    <label for="staffContact">Staff Contact</label>
		    <input type="text" value="<?php echo $staff['sphone']; ?>" class="form-control" id="staffContact" name="scontact">
		    <small id="scontactError" class=""></small>
		  </div>
		  <div class="d-flex justify-content-center">
		  	<button type="submit" class="btn btn-success mr-2">Update</button>
		  	<a href="Staff/StaffDetails" class="btn btn-secondary">Cancel</a>
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