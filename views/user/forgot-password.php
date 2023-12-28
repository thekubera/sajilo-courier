<!DOCTYPE html>
<html>
    <!-- Header file for navigation -->
    <?php 
      require_once('./views/shared/header.php'); 
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
            <h3>We are sorry!</h3>
            <p><b>Somthing went wrong. Please try again.</b></p>
          </div>
          <div class="modal-footer">
            <button id="close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    
        
    <div id="forgot-password-container" class="container d-flex flex-column justify-content-center align-items-center shadow p-3 bg-white rounded mt-2">
        <h2 class="m-5">Forgot Password ?</h2>
        <form class="w-75" action="User/resetPassword" method="POST" id="resetPasswordForm">
            <div class="w-100 form-group">
                <label for="userEmail">Enter registered email with system:</label>
                <input type="text" class="form-control" id="userEmail" name="uemail">
                <small id="emailError" class=""></small>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="d-block btn btn-primary">Reset</button>
            </div>
        </form>
    </div>

    


    
    <!-- Footer section -->
    <!-- JQuery (JavaScript base library)-->
  <script src="<?= URLROOT;?>/libraries/js/jquery.min.js"></script>

  <!-- JS file of bootstrap -->
  <script src="<?= URLROOT;?>/libraries/bootstrap/js/bootstrap.min.js"></script>
  

<!-- Custom JavaScript file -->
  <script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/main.js"></script> 

</body>
</html>