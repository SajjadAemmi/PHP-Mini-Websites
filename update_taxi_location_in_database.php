<?php 
    include 'database.php'; 
	session_start();

	$location_lat = mysqli_real_escape_string($connection, $_POST['lat']);
	$location_lng = mysqli_real_escape_string($connection, $_POST['lng']);
	$taxi_id = $_SESSION['taxi_id'];

	$query = "UPDATE taxies SET location_lat = '$location_lat', location_lng = '$location_lng' WHERE id = '$taxi_id'";
	
	if(!mysqli_query($connection, $query))
	{
		echo 'Error: '.mysqli_error($connection);
	} 
	else 
	{
		echo "";
	}