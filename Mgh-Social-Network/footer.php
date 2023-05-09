				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="sidebar">
                <div class="panel panel-danger">
                  <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                  </div>
                  <div class="panel-body">
                    
					<?php if(isLoggedIn()): ?>
					<div class="userdata">
						Wellcome, <strong><?php echo $_SESSION['username']; ?></strong><div class="col-md-3 user-login pull-right"><img class="avatar" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $_SESSION['avatar']; ?>" /></div>
					</div>
					
					<br>
					<form role="form" method="post" action="logout.php">
						<button name="logout" type="submit" class="btn btn-danger">Logout</button>
					</form>
					<?php else: ?> 	
					<form role="form" method="post" action="login.php">
                        <div class="form-group">
							<label>Login As:</label>
							<select name="login_type" class="form-control">
								<option value="1">User</option>
								<option value="2">Admin</option>
							</select>
						</div>
					  <div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" placeholder="Enter username" required>
					  </div>
					  <div class="form-group">
						<label>Password</label>
						<input name="password" type="password" class="form-control" placeholder="Enter password" required>
					  </div>
					  <button name="login" type="submit" class="btn btn-danger">Login</button> <a href="register.php" class="btn btn-default">Create Account</a>
					</form>
					<?php endif; ?>
				</div>
            </div>
				 <div class="panel panel-danger">
                  <div class="panel-heading">
                    <h3 class="panel-title">Categories</h3>
                  </div>
                  <div class="panel-body">
				
					<div class="list-group">
						<a href="index.php" class="list-group-item <?php echo is_active(null); ?>">All Topics<span class="badge pull-right"><?php echo $totalTopics; ?></span></a>
						<?php foreach(getCategories() as $category): ?>
						
							<a href="index.php?category=<?php echo $category->id; ?>" class="list-group-item <?php echo is_active($category->id); ?>"><?php echo $category->name; ?><span class="badge pull-right"><?php echo getNumPostOfCategory($category->id); ?></span></a>
						
						<?php endforeach; ?>
					</div>
				</div>
                     </div>
			</div>
		</div>
	  </div>
    </div><!-- /.container -->
	
	<footer class="blog-footer">
		<div class="container">
		  <p>Yas Social Network &copy; 2016 </p>
	      <p>
	        Mahbube Moghimi
	      </p>
		  
		  <?php $links = getLinks(); ?>
		  <?php foreach($links as $link): ?>
		  <div class="pull-right">
			  <a href="<?php echo $link->link; ?>">
				  <img class="link" src="<?php echo BASE_URI; ?>images/links/<?php echo $link->icon; ?>" />
			  </a>
		  </div>  
		  <?php endforeach; ?>
		  	
		</div>  
    </footer>
	
  </body>
</html>
