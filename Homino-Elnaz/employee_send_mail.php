<?php include "database.php"; ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if($_SESSION['reset_password'])
{
    $username = $_SESSION["username"];

    $q = "SELECT * FROM employees WHERE username = '$username' AND valid = 1";
    $employee_table = mysqli_query($con,$q);

    if(mysqli_num_rows($employee_table) == 1)
    {
        $employee = mysqli_fetch_assoc($employee_table);

        $email = $employee['email'];

        $new_password = rand();

        $hashed_new_password = md5($new_password);

        $q = "UPDATE employees
                SET password = '$hashed_new_password'
                WHERE username = '$username'";

        mysqli_query($con,$q);

        $message = "Hi! \nYour new password: \n" . $new_password;

        $mail = new PHPMailer(true);
        $mail->IsSMTP();

        try
        {
            $mail->SMTPDebug = 2;  
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'sajjadaemmi@gmail.com';
            $mail->Password = '';
            $mail->SetFrom('sajjadaemmi@gmail.com', 'سجاد ائمی');

            $mail->AddAddress($email);
            $mail->Subject = 'New Password';
            $mail->CharSet = 'UTF-8';
            $mail->ContentType = 'text/htm';
            $mail->MsgHTML($message);
            $mail->Send();
        }
        catch(phpmailerException $e)
        {
            echo $e->errorMessage();
        }
        catch(Exception $e)
        {
            echo "----------------------------\n";
            echo $e->getMessage();
        }

        $_SESSION['message'] = 1;
        $_SESSION['message_text'] = "کلمه عبور جدید به ایمیل شما فرستاده شد";

        header("location: login.php");
    }	
}

?>