<!-- Reusable Modal for changing courier status -->
<div class="container d-flex justify-content-center">
	<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#actionButtonModal">Take a Action</button>
	<button class="btn btn-success m-3">Edit Details</button>

	<div class="modal fade" id="actionButtonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			    </div>
			    <div class="modal-body">
	        		<form action="Parcel/changeStatus" method="POST" id="changeStatus">
	        	 		<input type="hidden" value="<?=$ref;?>" name="refnum" id="refnum">
			        	 <div class="form-group">
				            <label for="remarks" class="col-form-label">Remarks:</label>
				            <textarea class="form-control" id="remarks" name="remarks"></textarea>
				            <small id="remarksError"></small>
				         </div>
				         <div class="form-group">
					      <label for="status">Status:</label>
					      <select id="status" class="form-control form-control-sm" name="status">
					        <option selected disabled="disabled">Choose...</option>
					        <option value="pickup">Pickup</option>
					        <option value="shipped">Shipped</option>
					        <option value="in-transit">In-transit</option>
					        <option value="arrived">Arrived</option>
					        <option value="outfordelivery">Out For Delivery</option>
					        <option value="delivered">Delivered</option>
					      </select>
					      <small id="statusError"></small>
				     	</div>
				     	<div class="modal-footer">
					        <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
					        <button type="submit" id="statbtn" class="btn btn-primary">Change</button>
					    </div>
	    			</form>
	  			</div>
			</div>
		</div>  
	</div>
</div>
