<?php 
	include 'database.php'; 
	include 'functions.php'; 

    $taxi_id = $_SESSION['taxi_id'];

    $query = "SELECT services.* , users.phone_number 
                FROM services INNER JOIN users
                ON services.user_id = users.id
                WHERE taxi_id = $taxi_id AND is_done = 0";

    $new_service_table = mysqli_query($connection, $query);

    if(mysqli_num_rows($new_service_table) > 0)
    {
        $new_service = mysqli_fetch_assoc($new_service_table);

        echo json_encode($new_service);
    }
    else
    {
        echo "NULL";
    }
?>