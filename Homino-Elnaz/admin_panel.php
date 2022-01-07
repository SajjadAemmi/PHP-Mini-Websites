<?php include('header.php'); ?>

<?php if($_SESSION['admin_login'] == 1): ?>

<div class="row">
    <div class="col-md-3">
        <div class="well">

            <div class="list-group">
                <a class="list-group-item" href="admin_users.php">کاربران</a>
                <a class="list-group-item" href="admin_employee.php">سرویس دهنده ها</a>
                <a class="list-group-item" href="admin_groups.php">گروه بندی ها و قیمت ها</a>
                <a class="list-group-item" href="admin_messages.php">پیام های ارسالی</a>

                <a class="list-group-item" href="admin_report1.php">گزارش گیری بر حسب گروه بندی</a>
                <a class="list-group-item" href="admin_report2.php">گزارش گیری بر حسب کاربر</a>
                <a class="list-group-item" href="admin_report3.php">گزارش گیری بر حسب تاریخ</a>
                <a class="list-group-item" href="admin_report4.php">گزارش گیری بر حسب نام سرویس دهنده</a>

                <a class="list-group-item" href="admin_times.php"> لیست زمان های سرویس دهندگان</a>

                <a class="list-group-item" href="admin_edit_footer.php">ویرایش فوتر</a>
                <a class="list-group-item" href="logout.php">خروج</a>
            </div>
        </div>
    </div>

    <?php 
    else: 

    header("location:index.php");

    endif;
    ?>


