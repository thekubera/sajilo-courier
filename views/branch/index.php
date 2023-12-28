<!DOCTYPE html>
<html>
	<!-- Header file for navigation -->
	<?php
		require_once('./views/shared/header.php');
	 ?>

	<div class="container-fluid px-lg-5 px-md-3 px-sm-2">
    <h3 class="display-4 text-center mb-4">Our Branches</h3>
    <div class="row text-left">

      <?php while($row = $result->fetch_assoc()) { ?>
      <div class="col-lg-6 col-sm-12 mb-4" style="height: 20rem;">
      <div class="card-body rounded shadow">
          <table class="table table-hover">
            <thead class="card-header text-center bg-dark text-light">
              <th colspan="2"><?=$row['bname']?></th>
            </thead>
            <tr>
              <td>Branch Name</td>
              <td><?=$row['bname']?></td>
            </tr>
            <tr>
              <td>Branch Address</td>
              <td><?=$row['baddress']?></td>
            </tr>
            <tr>
              <td>Contact</td>
              <td><?=$row['bphone']?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><?=$row['bemail']?></td>
            </tr>
          </table>
        </div>
    </div>
  <?php  }?>

  </div>
  </div>


	 <!-- Footer Section -->
	 <?php
	 	require_once('./views/shared/footer.php');
	 ?>

   