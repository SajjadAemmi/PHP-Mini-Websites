<?php 
include 'database.php'; 
 include 'functions.php'; 

	if(isset($_POST['submit']))
	{
		$car_id = $_POST['car'];		
        $begin_lat = $_POST['begin_lat'];
        $begin_lng = $_POST['begin_lng'];
        $destination_lat = $_POST['destination_lat'];
        $destination_lng = $_POST['destination_lng'];
        
        date_default_timezone_set("Asia/Tehran");
        
        $time_now = date("H:i:s", time());
        
        if($car_id == 0)
        {
            $query = "SELECT * FROM taxies WHERE start_time < '$time_now' AND end_time > '$time_now'";    
        }
        else
        {
            $query = "SELECT * FROM taxies WHERE start_time < '$time_now' AND end_time > '$time_now' AND car_id = '$car_id'";
        }
        
		$taxies = mysqli_query($connection, $query);
		
        if(mysqli_num_rows($taxies) > 0)
        {
            $min_distance = 1000;

            foreach($taxies as $taxi)
            {
                if(sqrt(pow(abs($taxi['location_lat'] - $begin_lat),2) + pow(abs($taxi['location_lng'] - $begin_lng),2)) < $min_distance)
                {
                    $min_distance = sqrt(pow(abs($taxi['location_lat'] - $begin_lat),2) + pow(abs($taxi['location_lng'] - $begin_lng),2));

                    $nearest_taxi = $taxi;
                }
            }
            
            //تبدیل طول و عرض جغرافیایی به کیلومتر
            // قیمت هر کیلومتر 3000 تومان
            $price = round(($min_distance * 100) * 3000);
            
            $user_id = $_SESSION['user_id'];
            $taxi_id = $nearest_taxi['id'];
            
            $query = "INSERT INTO services (user_id, taxi_id, price , begin_lat, begin_lng, destination_lat, destination_lng) VALUES ('$user_id', '$taxi_id', '$price' , '$begin_lat', '$begin_lng', '$destination_lat', '$destination_lng')";
            
            mysqli_query($connection, $query);
            
            // قسمت کردن شماره پلاک برای نشان دادن در جدول
            list($part1, $part2, $part3, $part4) = explode(' ', $nearest_taxi['pelak']);
            
            $message = "درخواست سرویس با موفقیت انجام شد! <br>" . "هزینه سفر شما " . '<span class="badge"> ' . $price . '  </span>' . " تومان می باشد. <br>";
            $message = $message . "لطفا صبور باشید تا راننده تاکسی با شما تماس بگیرد. <br><br>";
            $message = $message . "نام راننده تاکسی: " . $nearest_taxi['name'] . "<br>";
            $message = $message . "شماره پلاک تاکسی: " .
            
            '<table dir="ltr" class="table" style="display:inline;">
              <tr>
                <td>' . $part1 . '</td>
                <td>' . $part2 . '</td>
                <td>' . $part3 . '</td>
                <td> | </td>
                <td>' . $part4 . '</td>

                </tr>
            </table>' . "<br>";
            
            $message = $message . "شماره تماس با تاکسی: " . $nearest_taxi['phone_number'] . "<br><br>";
            $message = $message . '<a href="tel:' . $nearest_taxi['phone_number'] . '" class="btn btn-success">با راننده تماس بگیرید</a>';
                
            redirect('user_panel.php', $message, 'success');
		
		}
		else
		{
            $message = "متاسفانه در حال حاضر تاکسی فعالی موجود نمی باشد! بعدا دوباره تلاش نمایید! <br><br>";
            $message = $message . '<a href="tel:133" class="btn btn-danger">با 133 تماس بگیرید</a>';
            
			redirect('user_panel.php', $message , 'error');
		}	
	}