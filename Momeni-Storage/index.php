<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php include 'header.php'; ?>

<?php if(!isset($_SESSION['is_logged_in'])): ?>


<div class="col-md-4 col-md-offset-4">				
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center"> فرم ورود </h3>
        </div>
        <div class="panel-body">

            <form role="form" method="post" action="login.php">
                <div class="form-group">
                    <label>ورود به عنوان:</label>
                    <select name="login_type" class="form-control">
                        <option value="1">مسئول انبار</option>
                        <option value="2">مدیر</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>نام کاربری</label>
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>کلمه عبور</label>
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                </div>
                <button name="login" type="submit" class="btn btn-primary btn3d"><span class="glyphicon glyphicon-log-in"></span> ورود</button> 
                
                <a href="register.php" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> ثبت نام</a>
            </form>
        </div>
    </div>
    <hr>
    <p class="text-center" style="color:white;">سجاد مومنی - بابک مافی | Copyright 2017</p>
</div>
			
		      </div>
        </div><!-- /.container -->
    </body>
</html>

<?php else: ?> 	

<?php header("Location: main.php"); ?>

<?php endif; ?>