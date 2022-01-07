<?php include "header.php"; ?>

		<div class="container">
			<div class="row">
				
				<!-- Modal -->
				<div class="modal fade" id="addModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add Contact</h4>
							</div>
							<div class="modal-body">
								<form id="addContact" action="add_contact.php" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>FirstName</label>
												<input type="text" name="first_name" class="form-control" placeholder="Enter Your FirstName">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>LastName</label>
												<input type="text" name="last_name" class="form-control" placeholder="Enter Your LastName">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" class="form-control" placeholder="Enter Your Email">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Contact Group</label>
												<select name="contact_group" class="form-control">
													<option value="Family">Family</option>
													<option value="Friends">Friends</option>
													<option value="Business">Business</option>
												</select>  
											</div>
										</div>
									</div>    
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" class="form-control" placeholder="Enter Your Address">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>State</label>
												<select name="state" class="form-control">
													<option value="Khorasan">Khorasan</option>
													<option value="Tehran">Tehran</option>
												</select>  
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Note</label>
												<textarea id="about" rows="2" cols="80" name="note" class="form-control" placeholder="Write about yourself"></textarea>
											</div>	
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="file" name="avatar" class="btn btn-default" value="Select Avatar">
											</div>
										</div>	
									</div>
									
									<div class="modal-footer">
										<button type="submit" name="submit" class="btn btn-primary">Save</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Image Loader -->
			<div id="loader">
				<img src="images/loader.gif">
			</div>	
			
			<!-- Main Content -->
			<div id="content">
			</div>	
			
			    
		</div>

<?php include "footer.php"; ?>
