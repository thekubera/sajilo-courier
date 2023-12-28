<!DOCTYPE html>
<html>
    <!-- Header file for navigation -->
    <?php 
      require_once('shared/header.php');

      // Reusable search box
      require_once 'shared/searchbox.php'; 

    ?>    

    <!-- Box for wrong input reference number -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Invalid Reference Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
        <p>Check the reference number provided by our staff and try again.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

    <!-- Information Cards -->
  <div class="container-fluid mt-3 bg-light">
      <div class="w-100 d-flex justify-content-center align-items-center">
        <h1 class="h1">Why Sajilo Courier ?</h1>
      </div>
      <div id="info-card" class="container-fluid d-flex justify-content-center align-items-center mt-3 mb-3">
        <div class="card d-flex flex-column justify-content-center align-items-center shadow p-3 bg-white rounded text-center">
          <i class="fas fa-universal-access fa-4x text-primary"></i>
          <h3 class="h3">International Services</h3>
          <p class="mt-2">We provide international delivery within 3-4 days.</p>
        </div>
        <div class="card d-flex flex-column justify-content-center align-items-center shadow p-3 bg-white rounded text-center">
          <i class="fas fa-rocket fa-4x text-primary"></i>
          <h3 class="h3">Speed</h3>
          <p class="mt-2">Our efficient fleet management, route planning and trained staff will help you on-time delivery.</p>
        </div>
        <div class="card d-flex flex-column justify-content-center align-items-center shadow p-3 bg-white rounded text-center">
          <i class="fa fa-shield-alt fa-4x text-primary"></i>
          <h3 class="h3">Safety</h3>
          <p>Our main goal is to provide service with safety and security.</p>
        </div>
    </div>
  </div>
    
    <!-- Footer Section -->
    <?php require_once('shared/footer.php');  ?>