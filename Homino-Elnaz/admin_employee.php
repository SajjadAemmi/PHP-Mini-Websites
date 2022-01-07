<?php include('admin_panel.php'); ?>
<?php 

if(isset($_POST['delete']))
{
    $employee_id = $_POST['employee_id'];
    $q = "DELETE FROM employees WHERE id = $employee_id";

    if(!mysqli_query($con, $q))
    {
        echo mysqli_error($con);
    }
}

if(isset($_POST['accept']))
{
    $employee_id = $_POST['employee_id'];
    $q = "UPDATE employees SET valid = 1 WHERE id = $employee_id";
    mysqli_query($con, $q);
}


$q = "SELECT * FROM employees";
$persons  = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">اطلاعات سرویس دهندگان</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">

                        <tr>
                            <th>نام</th>
                            <th>نام کاربری</th>
                            <th>شماره همراه </th>
                            <th> جنسیت </th> 
                            <th> رزومه </th> 
                        </tr>

                        <?php foreach($persons as $p): ?>    
                        <tr>
                            <td><?php echo $p["name"]; ?></td>
                            <td><?php echo $p["username"]; ?></td>
                            <td><?php echo $p["mobile"]; ?> </td>
                            <td><?php echo $p["jensiat"]; ?> </td>
                            <td><?php echo $p["rezume"]; ?> </td>
                            <td>
                                <form method="post" action="admin_employee.php">
                                    <input type="hidden" name="employee_id" value="<?php echo $p["id"]; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-block">حذف</button> 

                                    <?php if($p["valid"] == 0): ?>

                                    <button type="submit" name="accept" class="btn btn-success btn-block">تایید ثبت نام</button> 

                                    <?php endif; ?>

                                </form>
                            </td>
                            <td>
                                <a href="admin_employee_reserved_times.php?employee_id=<?php echo $p["id"]; ?>" class="btn btn-success btn-block">سوابق رزرو</a> 
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
