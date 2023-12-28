<?php  
	$actionPath = (isset($_SESSION['aid']))?"Admin/changePassword":"Staff/changePassword";
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
        <p><b>Make sure you entered valid data and check your connection.</b></p>
      </div>
      <div class="modal-footer">
        <button id="close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div id="staffUpdateContainer" class="container d-flex flex-column justify-content-center w-50 p-2 bg-white shadow rounded p-0">
	<h2 class="text-center">Change Password</h2>
	<form id="staffChangePassword" method="POST" action="<?=$actionPath;?>" class="d-flex flex-column justify-content-center align-item-center">
		<input type="text" name="uid" value="<?=$_SESSION['uid'];?>" hidden/>
	  <div class="form-group">
	    <label for="oldpass">Current Password</label>
	    <input type="password" class="form-control" id="oldpass" name="oldpass">
	    <small id="oldpassError" class=""></small>
	  </div>
	  <div class="form-group">
	    <label for="newpass">New Password</label>
	    <input type="password" value="" class="form-control" id="newpass" name="newpass">
	      <small id="newpassError" class=""></small>
	  </div>
	  <div class="form-group">
	    <label for="newpass1">Confirm Password</label>
	    <input type="password" value="" class="form-control" id="newpass1" name="newpass1">
	      <small id="newpass1Error" class=""></small>
	  </div>
	  <div class="d-flex justify-content-center">
	  	<button type="submit" class="btn btn-success mr-2">Change</button>
	  	<a href="<?=(isset($_SESSION['aid']))?"Admin/dashboard":"Staff/dashboard";?>" class="btn btn-secondary">Cancel</a>
	  </div>
	</form>	
</div>