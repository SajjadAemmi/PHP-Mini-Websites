<?php include('admin_panel.php'); ?>
<?php 

if(isset($_POST['delete']))
{
    $user_id = $_POST['user_id'];
    $q = "DELETE FROM users WHERE id = $user_id";
    mysqli_query($con, $q);
}

if(isset($_POST['accept']))
{
    $user_id = $_POST['user_id'];
    $q = "UPDATE users SET valid = 1 WHERE id = $user_id";
    mysqli_query($con, $q);
}

$q = "SELECT * FROM users";
$persons  = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">اطلاعات کاربران</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>نام کاربری</th>
                            <th>شماره همراه </th>
                            <th>آدرس </th> 
                        </tr>

                        <?php foreach($persons as $p): ?>    
                        <tr>
                            <td><?php echo $p["name"]; ?></td>
                            <td><?php echo $p["family"]; ?></td>
                            <td><?php echo $p["username"]; ?></td>
                            <td><?php echo $p["mobile"]; ?> </td>
                            <td><?php echo $p["address"]; ?> </td>
                            <td>
                                <form method="post" action="admin_users.php">
                                    <input type="hidden" name="user_id" value="<?php echo $p["id"]; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-block">حذف</button> 

                                    <?php if($p["valid"] == 0): ?>

                                    <button type="submit" name="accept" class="btn btn-success btn-block">تایید ثبت نام</button> 

                                    <?php endif; ?>
                                </form>
                            </td>
                            <td>
                                <a href="admin_user_reserve_history.php?user_id=<?php echo $p["id"]; ?>" class="btn btn-success btn-block">سوابق رزرو</a> 
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</body>
</html>
