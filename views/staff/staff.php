<!DOCTYPE html>
<html>
<head>
<title>Admin --Staff</title>
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
        		height: calc(100vh + 250px);
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

	<!-- Box for wrong input reference number -->
	  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Do you really want to delete ?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	        <i class="far fa-trash-alt fa-5x text-danger mb-4"></i>
	        <p class="m-0">Deleted record can not be retrive again!</p>
	        <p>Make sure to choose correct record or <strong>EDIT</strong> it if you want to transfer staff into another branch.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
	        <a id="delete-btn" href="Staff/delete" class="btn btn-danger text-white">DELETE</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container d-flex flex-column shadow p-3 bg-white rounded">
		<div class="d-inline-flex justify-content-between">
			<h2 class="text-center">Staff Details</h2>
			<!-- Button to adding branches -->
			<a href="<?= URLROOT;?>/Staff/addStaff" class="btn btn-success text-white mb-3">
				<i class="fas fa-plus"></i> New Staff
			</a>
		</div>

		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">S.N.</th>
				      <th scope="col">Branch Name</th>
				      <th scope="col">Staff Name</th>
				      <th scope="col">Contact</th>
				      <th scope="col">Email</th>
				      <th scope="col">Action</th>	
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<?php 
				        $sn = 1;
				        while( $row = $result->fetch_assoc()){ ?>
					      <th scope="row"><?php echo $sn; ?></th>
					      <td><?php echo $row['bname']; ?></td>
					      <td><?php echo $row['sfname']." ".$row['smname']." ".$row['slname']; ?></td>
					      <td><?php echo $row['sphone']; ?></td>
					      <td><?php echo $row['email']; ?></td>
					      <td>
					      	<a href="<?= URLROOT;?>/Staff/staffUpdate?id=<?php echo $row['sid'] ?>&&name=<?php echo $row['bname'] ?>" class="btn btn-success ml-4">EDIT</a>
					      	<button value="<?php echo $row['uid']; ?>" class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModalCenter">DELETE</button>
					      </td>
				    </tr>
				    <?php $sn++; } ?>
				  </tbody>
			</table>
		</div>

	</div>


	<!-- closing div of wrapper of sidebar -->
		</div>
	</div>

	<!-- JS Linking -->
	<?php 
		require_once './views/shared/linksbottom.php';
	?>

	<script type="text/javascript">
		$("#exampleModalCenter").prependTo("body");

		let uid;
		$('.delete').click(function() {
			uid = $(this).val();
		});
		
		$('#delete-btn').on('click', (e) => {
			e.preventDefault();
			$.ajax('Staff/delete', {
				type: 'POST',
				data: {uid: uid},

				success: function(data) {
					if(data.trim() ===  "1") {
						$("#exampleModalLongTitle").text("Success");
						$(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully staff details deleted.</h2>");
						$("#exampleModalCenter").prependTo("body");
						$('.modal-footer').hide();
						$("#exampleModalCenter").modal('show');

						$("#exampleModalCenter").delay(1000).fadeOut(2000);

						setTimeout(() => {
							$("#exampleModalCenter").modal('hide');
							window.location.href = "Staff/staffDetails";
						},2900);


					}

					if(data.trim() === "sqlError") {
						alert("Unable to delete record. Please try again.");
					} 
					
					if(data.trim() === "0") 
						alert("Somthing went wrong. Please try again.");
				} 
			});
		});
	</script>

</body>
</html>