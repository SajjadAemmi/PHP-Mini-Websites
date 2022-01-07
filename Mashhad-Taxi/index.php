<?php 
    include 'functions.php'; 
    include 'database.php'; 
?>	

<?php if(!isset($_SESSION['is_logged_in'])): ?>

<?php include 'header.php'; ?>

<script>
    
    $(function()
    { 
        $("#slogan").typed({ 
            strings: ["بهترین، سریع ترین و ارزان ترین تاکسی در شهر مشهد مقدس"],
            contentType: 'html', 
            typeSpeed: 80,
        });
    });

    $(document).ready(function()
    {
        $("#taxi").mouseenter(function()
        {
            setTimeout(function(){ 
              $("#taxi").attr('src','images/taxi2.png'); 
              setTimeout(function(){ 
                $("#taxi").attr('src','images/taxi1.png'); 
                setTimeout(function(){ 
                  $("#taxi").attr('src','images/taxi2.png'); 
                  setTimeout(function(){ 
                    $("#taxi").attr('src','images/taxi1.png'); 
                  }, 250); 
                }, 250); 
              }, 250); 
            }, 250);
        });
    });
    
</script>

<div class="row">
     <div class="col-md-12">
         <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <img id="taxi" class="img-responsive" src="images/taxi1.png">
            </div>
        </div>
        <div class="alert alert-warning" role="alert">
            <p class="text-center">
                <strong id="slogan">
                    
                </strong>
            </p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
			
				<div>

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#A" aria-controls="A" role="tab" data-toggle="tab">ورود مشتری</a></li>
					<li role="presentation"><a href="#B" aria-controls="B" role="tab" data-toggle="tab">ورود راننده</a></li>
					<li role="presentation"><a href="#C" aria-controls="C" role="tab" data-toggle="tab">ورود مدیر</a></li>
				  </ul>
				<br>
				  <!-- Tab panes -->
				  <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="A">
						<form role="form" method="post" action="login.php">
						  <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">نام کاربری</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> @ </span>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                              </div>
                            </div>
                             <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">کلمه عبور</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                              </div>
                            </div>
						  <button name="login_user" type="submit" class="btn btn-warning btn-block btn-lg"><i class="fa fa-sign-in"></i> ورود</button>
							<a href="register.php" class="btn btn-default btn-block btn-lg"><i class="fa fa-user-plus"></i> ثبت نام</a>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="B">
						<form role="form" method="post" action="login.php">
						  <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">نام کاربری</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> @ </span>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                              </div>
                            </div>
                             <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">کلمه عبور</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                              </div>
                            </div>
						  <button name="login_taxi" type="submit" class="btn btn-warning btn-block btn-lg"><i class="fa fa-sign-in"></i> ورود</button> 
                            <a href="register.php" class="btn btn-default btn-block btn-lg"><i class="fa fa-user-plus"></i> ثبت نام</a>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="C">
						<form role="form" method="post" action="login.php">
						  <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">نام کاربری</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> @ </span>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                              </div>
                            </div>
                             <div class="form-group has-success has-feedback">
                              <label class="control-label" for="inputGroupSuccess1">کلمه عبور</label>
                              <div class="input-group"  dir="ltr">
                                <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                              </div>
                            </div>
						  <button name="login_admin" type="submit" class="btn btn-warning btn-block btn-lg"><i class="fa fa-sign-in"></i> ورود</button>
						</form>
					</div>
				  </div>

				</div>
			</div>
		</div>
    </div>
</div>

<?php 
    else:
    
        if($_SESSION['login_type'] == "user")
        {
            header("Location: user_panel.php"); exit(); 
        }
        elseif($_SESSION['login_type'] == "taxi")
        {
            header("Location: taxi_panel.php"); exit(); 
        }
        elseif($_SESSION['login_type'] == "admin")
        {
            header("Location: admin_panel.php"); exit(); 
        }
?>

<?php endif; ?>

<?php include 'footer.php'; ?>