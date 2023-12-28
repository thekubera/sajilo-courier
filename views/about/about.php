<!DOCTYPE html>
<html>
    <!-- Header file for navigation -->
    <?php 
      require_once('./views/shared/header.php'); 
    ?>

	<div class="bg-light">
		<div class="container py-5">
    		<div class="row h-100 align-items-center py-5">
      			<div class="col-lg-6">
       				<h1 class="display-4">About Us</h1>
        			<p class="lead text-muted mb-0">We always belive in customer satisfaction and instant delivery.</p><br>
        			<p class="lead text-muted mb-0">We are providing service from last 5 years world wide, trusted by millions.</p>
     		 	</div>
      			<div class="col-lg-6 d-none d-lg-block bg-light"><img src="<?= URLROOT; ?>/img/about1.svg" alt="" class="img-fluid c-image ml-5">
      			</div>
    		</div>
  		</div>
	</div>

<div class="bg-light py-5">
  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-lg-5">
        <h2 class="display-4 font-weight-light">Our team</h2>
        <p class="font-italic text-muted">Short description</p>
      </div>
    </div>

    <div class="row text-center">
      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4">
        	<img class="img-fluid rounded-circle dev-profile mb-3 img-thumbnail" src="<?= URLROOT; ?>/img/dev.png" alt="" width="100">
          <h5 class="mb-0">Kuber Acharya</h5>
          <span class="small text-uppercase text-muted">CEO - Founder</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-facebook-f"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-twitter"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-instagram"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-linkedin"></i>
           	 	</a>
           	</li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4">
        	<img src="img/users/fox.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">John Doe</h5>
          <span class="small text-uppercase text-muted">CEO - Founder</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-facebook-f"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-twitter"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-instagram"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-linkedin"></i>
            	</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src = "img/users/fox.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">John Doe</h5>
          <span class="small text-uppercase text-muted">CEO - Founder</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-facebook-f"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-twitter"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-instagram"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-linkedin"></i>
            	</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- End-->

      <!-- Team item-->
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/users/fox.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
          <h5 class="mb-0">John Doe</h5>
          <span class="small text-uppercase text-muted">CEO - Founder</span>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-facebook-f"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-twitter"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-instagram"></i>
            	</a>
            </li>
            <li class="list-inline-item">
            	<a href="#" class="social-link">
            		<i class="fab fa-linkedin"></i>
            	</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- End-->

    </div>
  </div>
</div>

<?php
	require_once('./views/shared/footer.php');
?>