<?php include('admin_panel.php'); ?>
<?php 

if(isset($_POST["footer_edit"]))
{
    $title               = $_POST["title"];
    $text           = $_POST["text"];
    $subtitle           = $_POST["subtitle"];

    $q = "UPDATE footer
                    SET title = '$title', 
                    text = '$text', 
                    subtitle = '$subtitle'";

    mysqli_query($con,$q);
    
    $_SESSION["message"] = 1;
    $_SESSION["message_text"]=" فوتر ویرایش شد";
}

$q = "SELECT * FROM footer";
$footer = mysqli_fetch_assoc(mysqli_query($con, $q));

?>    

<div class="col-md-9">
    <div class="well">
        <form method="post" action="admin_edit_footer.php">
            <div class="form-group">
                <label>تیتر</label>
                <input type="text" name="title" value="<?php echo $footer['title']; ?>" class="form-control" placeholder="نام خود را وارد نمایید">
            </div>
            <div class="form-group">
                <label>متن</label>
                <textarea rows="10" class="form-control" name="text"><?php echo $footer['text']; ?></textarea>
            </div>
            <div class="form-group">
                <label>زیر نویس</label>
                <input type="text" name="subtitle" value="<?php echo $footer["subtitle"]; ?>" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
            </div>

            <button type="submit" name="footer_edit" class="btn btn-success">ثبت تغییرات</button>
        </form>
    </div>
</div>
</div>

</div>
</body>
</html>
