<?php include ('core/init.php'); ?>
<?php include "libraries/Database.php"; ?>
<?php
     $db = new Database;
     
     $query = "SELECT * FROM contacts ORDER BY first_name ASC";
     
     $contacts = $db->select($query);
     
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Contacts</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="info-list table table-hover table-bordered enFonts table-striped tableCenter">
						<thead>
							<tr class="info">
								<td width="10%">Avatar</td>
								<td>Name</td>
								<td>Phone</td>
								<td>Email</td>
								<td>Address</td>
								<td>Group</td>
								<td>Actions</td>
							</tr>
						</thead>
						<?php if($contacts): ?>
							<?php foreach($contacts as $contact): ?>
								<tr>
									<td><img class="img-responsive img-thumbnail" src="images/avatars/<?php echo $contact['avatar']; ?>"></td>
									<td><?php echo $contact['first_name'].' '.$contact['last_name']; ?></td>
									<td><?php echo $contact['phone_number']; ?></td>
									<td><?php echo $contact['email']; ?></td>
									<td>
										<ul>
											<li><?php echo $contact['address']; ?></li>
											<li><?php echo $contact['state']; ?></li>
										</ul>
									</td>
									<td><?php echo $contact['contact_group']; ?></td>
									<td>
										<button type="button" data-toggle="modal" data-target="#editModal<?php echo $contact['id']; ?>" class="btn btn-primary" id="editbutton"><span class="glyphicon glyphicon-pencil" ></span> Edit</button>
										
										<!-- Modal -->
										<div class="modal fade" id="editModal<?php echo $contact['id']; ?>" role="dialog">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Edit Contact</h4>
													</div>
													<div class="modal-body">
														<form id="addContact" action="edit_contact.php" method="post" enctype="multipart/form-data">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label>FirstName</label>
																		<input type="text" name="first_name" class="form-control" placeholder="Enter Your FirstName" value="<?php echo $contact['first_name']; ?>">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>LastName</label>
																		<input type="text" name="last_name" class="form-control" placeholder="Enter Your LastName" value="<?php echo $contact['last_name']; ?>">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label>Email</label>
																		<input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="<?php echo $contact['email']; ?>">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label>Phone Number</label>
																		<input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number" value="<?php echo $contact['phone_number']; ?>">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label>Contact Group</label>
																		<select name="contact_group" class="form-control">
																			<option value="Family" <?php if($contact['contact_group'] == 'Family'){echo 'selected';} ?> >Family</option>
																			<option value="Friends" <?php if($contact['contact_group'] == 'Friends'){echo 'selected';} ?> >Friends</option>
																			<option value="Business" <?php if($contact['contact_group'] == 'Business'){echo 'selected';} ?> >Business</option>
																		</select>  
																	</div>
																</div>
															</div>    
															<div class="row">
																<div class="col-md-8">
																	<div class="form-group">
																		<label>Address</label>
																		<input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="<?php echo $contact['address']; ?>">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label>State</label>
																		<select name="state" class="form-control">
																			<option value="Khorasan" <?php if($contact['state'] == 'Khorasan'){echo 'selected';} ?>>Khorasan</option>
																			<option value="Tehran" <?php if($contact['state'] == 'Tehran'){echo 'selected';} ?>>Tehran</option>
																		</select>  
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<label>Note</label>
																		<textarea id="about" rows="2" cols="80" name="note" class="form-control" placeholder="Write about yourself"><?php echo $contact['note']; ?></textarea>
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
																<input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
																<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
																<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<form method="post" action="delete_contact.php">
											<button type="submit" name="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
											<input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>	  
					</table>
				</div>
			</div>		
		</div>  
	</div>
</div>  