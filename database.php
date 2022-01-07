<?php
// Connect to MySQL
$connection = mysqli_connect("localhost","root","","mashhad_taxi");

if(mysqli_connect_errno())
{
	echo 'Failed to connect: '.mysqli_connect_error();
}
else
{
	$query = "SET CHARACTER SET utf8";
	mysqli_query($connection, $query);
}
?>