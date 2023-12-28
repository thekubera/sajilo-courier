<!DOCTYPE html>
<html>
    <!-- Header file for navigation -->
    <?php 
      require_once('./views/shared/header.php'); 
    ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/css/admin.css"> -->
        
    

    <!-- Login Page -->
    <form id="loginForm" action="User/loginCheck" method="POST" class="login-container d-flex justify-content-center align-items-center mt-2">
        <div class="login-card d-flex flex-column justify-content-center align-items-center shadow p-3 bg-white rounded">
            <i class="fas fa-user-circle fa-5x text-primary"></i>
            <h3 class="h3 text-uppercase mt-1 mb-4 text-primary">User Login</h3>
            <input id="email" type="text" name="email" class="" placeholder="Email">
            <small id="emailError"class="mb-2">Error Message</small>
            <input id="password" type="password" name="password" class="" placeholder="Password">
            <small id="passwordError" class="mb-2">Error Message</small>
            <button id="login-btn" class="btn btn-primary m-3" disabled>LOGIN</button>
            <a href="<?=URLROOT?>/User/forgotPassword"><i class="fas fa-lock">&nbsp;</i>Forgot Password ?</a>
        </div>
    </form>

    <!-- Footer section -->
    <!-- JQuery (JavaScript base library)-->
  <script src="<?= URLROOT;?>/libraries/js/jquery.min.js"></script>

  <!-- JS file of bootstrap -->
  <script src="<?= URLROOT;?>/libraries/bootstrap/js/bootstrap.min.js"></script>
  

<!-- Custom JavaScript file -->
  <!-- <script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/main.js"></script> -->

  <script type="text/javascript" src="<?= URLROOT; ?>/libraries/js/admin.js"></script>

</body>
</html>