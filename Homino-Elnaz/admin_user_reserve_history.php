<?php include('admin_panel.php'); ?>
<?php 

$user_id = $_GET['user_id'];

if(isset($_POST['reserve_cancel']))
{
    $reserve_id = $_POST['reserve_id'];
    $q = "DELETE FROM reserves WHERE id = $reserve_id";
    mysqli_query($con, $q);
}
elseif(isset($_POST['set_score']))
{
    $reserve_id = $_POST['reserve_id'];
    $score = $_POST['score'];
    
    $q = "UPDATE reserves SET score = $score WHERE id = $reserve_id";
    mysqli_query($con, $q);
}

$q = "SELECT reserves.id AS reserve_id , reserves.* ,  times.* , groups.*, employees.*
        FROM reserves INNER JOIN times
        ON reserves.time_id = times.id
        INNER JOIN groups 
        ON times.group_id = groups.id
        INNER JOIN employees 
        ON times.employee_id = employees.id
        WHERE user_id = $user_id";

$reserves = mysqli_query($con, $q);

?>


<script>

    $(document).ready(function(){

        $("#score_range").on('input', function() {

            $("#score_number").val($(this).val());
        })
    })

</script>

<div class="col-md-9">
    <div class="well">

        <table class="table table-striped table-bordered table-hover">

            <tr>
                <th>ساعت شروع کار</th>
                <th>ساعت پایان کار</th>
                <th>تاریخ کار </th>
                <th>تاریخ رزرو </th>
                <th>نام سرویس دهنده </th>
                <th>گروه کاری </th>
                <th>وضعیت رزرو </th>
                <th> </th> 
            </tr>

            <?php foreach($reserves as $reserve): ?>    
            <tr>
                <td><?php echo $reserve["start_time"]; ?></td>
                <td><?php echo $reserve["end_time"]; ?></td>
                <td><?php echo $reserve["date"]; ?> </td>
                <td><?php echo $reserve["reserve_date"]; ?> </td>
                <td><?php echo $reserve["name"]; ?> </td>
                <td><?php echo $reserve["title"]; ?> </td>
                <td><?php if($reserve["done"] == 0) echo 'انجام نشده'; else echo 'انجام شده'; ?> </td>
                <td>

                    <form method="post" action="user_reserve_history.php">
                        <input type="hidden" name="reserve_id" value="<?php echo $reserve["reserve_id"]; ?>">

                        <?php if($reserve["done"] == 0): ?>
                        <button type="submit" name="reserve_cancel" class="btn btn-warning btn-block">لغو رزرو</button> 

                        <?php else: ?>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#Modal<?php echo $reserve["reserve_id"]; ?>">
                            امتیاز دهی
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="Modal<?php echo $reserve["reserve_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">امتیاز دهی</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">نام سرویس دهنده</label>
                                            <input type="email" class="form-control" value="<?php echo $reserve["name"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">امتیاز</label>
                                            <input type="range" name="score" class="form-control" id="score_range" min="0" max="20" value="10">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">امتیاز</label>
                                            <input type="text" class="form-control" id="score_number" value="10" readonly style="text-align: center;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="set_score" class="btn btn-primary">ثبت امتیاز</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>
                    </form>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

</div>

</div>
</body>
</html>
