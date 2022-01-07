<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
	$kala_id = $_GET['id'];

	$query = "SELECT kalas.*, categories.type
                    FROM kalas
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    WHERE kalas.id = $kala_id";

    $kala_table = mysqli_query($connection, $query);
    $kala = mysqli_fetch_assoc($kala_table);
?>	

<?php include ('header.php'); ?>

<ul id="topics">
	<div class="row">
		<?php if($cooky->image != "0"): ?>
		<div class="col-md-6">
			<div class="thumbnail">
				<img src="<?php echo BASE_URI; ?>images/cookies/<?php echo $cooky->image; ?>" />
			</div>
		</div>
		<?php endif; ?>
		
		<div class="col-md-6">
			<div class="alert alert-success" role="alert">
				<?php echo $cooky->title; ?>
			</div>	
			<div class="alert alert-warning" role="alert">
				تاریخ: <?php echo $cooky->create_date; ?>
			</div>
			<div class="alert alert-danger" role="alert">
				دسته بندی: <?php echo $cooky->name; ?>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="topic-content pull-right">
						<?php echo $cooky->body; ?>
					</div>
				</div>
			</div>
			<div class="alert alert-info" role="alert">قیمت: <?php echo $cooky->price; ?> تومان</div>
			
			<div class="row">
				<div class="col-md-12">
					
					<?php if(isLoggedIn()) : ?>
					<button type="button" data-toggle="modal" data-target="#editModal<?php echo $cooky->id; ?>" class="btn btn-success btn-lg btn-block" id="editbutton"><span class="glyphicon glyphicon-plus" ></span> افزودن به سبد خرید</button>
											
					<!-- Modal -->
					<div class="modal fade" id="editModal<?php echo $cooky->id; ?>" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">افزودن به سبد خرید</h4>
								</div>
								<div class="modal-body">
									<form id="adduser" action="add_basket.php" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>تعداد</label>
													<input type="number" name="number" class="form-control">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<input type="hidden" name="cooky_id" value="<?php echo $cooky->id; ?>">
											<button type="submit" name="add_basket" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> تایید</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> انصراف</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>	
				</div>
			</div>
		</div>
	</div>
</ul>
	
<?php include ('footer.php'); ?>