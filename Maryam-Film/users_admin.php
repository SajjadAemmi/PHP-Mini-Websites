<?php 
    include 'database.php';
    include 'functions.php';

    if(isset($_POST['delete_user']))
    {
        $user_id = $_POST['user_id'];
        $query = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($connection, $query);
    }

    $query="SELECT * FROM users";
    $users=mysqli_query($connection, $query);

    include 'header.php';
?>    
<div class="row">
    <div class="col-md-12">
        <a href="panel_admin.php" class="btn btn-warning">
           <i class="fa fa-arrow-right"></i> بازگشت به پنل ادمین 
        </a>
    </div>
</div>
<br>      
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> لیست کاربران </h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php foreach ($users as $user): ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2">
                                     <img class="img-responsive img-circle" src="images/users/<?php echo $user['username']; ?>.jpg" />
                                          
                                </div>
                                <div class="col-md-8">
                                    <h3 style="display:inline;"><?php echo $user['name']; ?></h3>
                                    <hr>
                                    <ul class="user-info">
                                        <li>
                                            نام کاربری: <b><?php echo $user['username']; ?></b>
                                        </li>
                                        <li>
                                            ایمیل: <b><?php echo $user['email']; ?></b>
                                        </li>
                                        <li>
                                            سن: <b><?php echo $user['age']; ?></b>
                                        </li>
                                    </ul>
                                </div>

                                <!--modal-->
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-block btn3d" data-toggle="modal" data-target="#myModale<?php echo $user['id']; ?>">
                                     حذف  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
                                    </button>
                                <form method="post" action="users_admin.php">
                                       
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <br>
           
                                   <div class="modal fade" id="myModale<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                       <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <h4 class="modal-title" id="myModalLabel">حذف</h4>
                                               </div>
                                           
                                               <form method="post" action="users_admin.php">
                                               
                                                   <div class="modal-body"> 
                                                   آیا میخواهید این کاربر را حذف کنید؟
                                                     <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                 </div>
                                                 <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                                   <button type="submit" name="delete_user" class="btn btn-danger"> حذف کاربر </button>
                                                 </div>
           
                                               </form>
                                       </div>
                                     </div>
                                   </div>
                                   </form>
                                </div>
                            </div>    
                        </li>
                    <?php endforeach; ?>
                </ul>           
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 