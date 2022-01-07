<?php include('admin_panel.php'); ?>
<?php 

if(isset($_POST['delete']))
{
    $group_id = $_POST['group_id'];
    $q = "DELETE FROM groups WHERE id = $group_id";
    mysqli_query($con, $q);
}

if(isset($_POST['add_group']))
{
    $title = $_POST['title'];
    $price = $_POST['price'];

    $q ="INSERT INTO groups(price,title) VALUES('$price','$title')";
    mysqli_query($con, $q);
}


$q = "SELECT * 
        FROM groups";

$groups = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading"> گروه بندی ها </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
                        افزودن گروه بندی جدید
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">افزودن گروه بندی جدید</h4>
                                </div>

                                <form method="post" action="admin_groups.php">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>عنوان گروه بندی</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>قیمت بر حسب ساعت</label>
                                            <input type="text" name="price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="add_group" class="btn btn-primary">افزودن</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th> شماره ردیف</th>
                    <th>گروه کاری </th>
                    <th>قیمت بر حسب ساعت </th>
                    <th> </th> 
                </tr>

                <?php foreach($groups as $group): ?>    
                <tr>
                    <td><?php echo $group["id"]; ?></td>
                    <td><?php echo $group["title"]; ?> </td>
                    <td><?php echo $group["price"]; ?> </td>
                    <td>
                        <form method="post" action="admin_groups.php">
                            <input type="hidden" name="group_id" value="<?php echo $group["id"]; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-block">حذف</button> 
                        </form>
                    </td>

                </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

</div>

</div>
</body>
</html>
