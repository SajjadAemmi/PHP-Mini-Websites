<?php include('header.php');

if(isset($_POST["admin_login"]))
{
    $username           = $_POST["username"];
    $password           = $_POST["password"];

    if($username == 'admin' && $password == '1234') 
    {
        //success login
        
        $_SESSION['admin_login'] = 1;
        
        header("location:admin_panel.php");
    }
    else 
    {
        header("location:admin_login.php");
    }
}
?>


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="well">
            <form method="post" action="admin_login.php">
                <div class="form-group">
                    <label>نام کاربری</label>
                    <input type="text" name="username" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">کلمه عبور</label>
                    <input type="password" name="password" class="form-control" placeholder="کلمه عبور">
                </div>

                <button type="submit" name="admin_login" class="btn btn-success">ورود</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>