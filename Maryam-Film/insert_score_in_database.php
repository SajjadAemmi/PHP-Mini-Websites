<?php 
    include 'database.php'; 

	$user_id = $_POST['user_id'];
	$film_id = $_POST['film_id'];
	$score = $_POST['score'];

    $query = "SELECT * FROM rating
                WHERE user_id = '$user_id' and film_id = '$film_id'";

    $rate = mysqli_query($connection, $query);

    if(mysqli_num_rows($rate) == 0)
    {
        $query = "INSERT INTO rating (user_id, film_id, score) 
                    VALUES ('$user_id', '$film_id', '$score')";
    }
    else
    {
        $query = "UPDATE rating 
                    SET score = '$score' 
                    WHERE user_id = '$user_id' and film_id = '$film_id'";
    }
    
	mysqli_query($connection, $query);
?>