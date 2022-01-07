<?php include('admin_panel.php'); ?>
<?php 

$q = "SELECT * 
        FROM messages INNER JOIN users
        ON messages.user_id = users.id";

$times = mysqli_query($con, $q);

?>    

<div class="col-md-9">
    <div class="panel panel-primary">
        <div class="panel-heading">پیام های ارسالی</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>نام کاربری</th>
                            <th>پیام</th>
                            <th>تاریخ</th>
                            <th> </th> 
                        </tr>

                        <?php foreach($times as $time): ?>    
                        <tr>
                            <td><?php echo $time["username"]; ?></td>
                            <td><?php echo $time["text"]; ?></td>
                            <td><?php echo $time["send_date"]; ?> </td>
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
