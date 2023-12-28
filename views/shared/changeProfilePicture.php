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
        <p><b>Make sure to choose valid image and check your connection.</b></p>
      </div>
      <div class="modal-footer">
        <button id="close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="container d-flex flex-column align-items-center w-50 h-75 bg-white shadow rounded p-0 mt-0" id="uploadProfilePicture">
	<img src="<?=URLROOT;?>/img/users/<?=$profilePath;?>" class="w-50 h-50 img-fluid rounded-circle dev-profile mb-3 img-thumbnail" alt="user profile" width="50" height="50">
	<h2 class="mt-2 pt-0"><?=$_SESSION['name'];?></h2>
	<h3 class="m-0">Staff</h3>
	<form action="<?=$actionPath;?>" method="POST" enctype="multipart/form-data" id="profilePictureForm">
		<label class="btn btn-secondary mt-2 mr-2">
			Browse Picture <input type="file" name="sphoto" hidden>
		</label>
		<button type="submit" class="btn btn-primary">Change</button>
	</form>
	<small class="m-0 p-0" id="pError"></small>
</div>