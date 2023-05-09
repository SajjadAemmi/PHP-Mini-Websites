<?php include('user_panel.php'); ?>

<?php
if(isset($_POST["send"]))
{
    $text = $_POST["text"];
    $user_id = $_SESSION["user_id"];

    $q = "INSERT INTO messages(user_id, text) VALUES('$user_id','$text')";

    if(!mysqli_query($con, $q))
    {
        die(mysqli_error($con));
    }

    $_SESSION['message'] = "پیام شما ارسال شد";
}
?>

<div class="col-md-9">
    <div class="well">
        <form method="post" action="user_send_message.php">
            <div class="form-group">
                <label for="comment">پیام:</label>
                <textarea class="form-control a" rows="5" id="comment" name="text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="send">ارسال</button>
        </form>
    </div>
</div>

</body>
</html>

