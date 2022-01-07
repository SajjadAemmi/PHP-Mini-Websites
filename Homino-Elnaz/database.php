<?php
session_start();

$server = 'localhost';
$username = 'root';
$password = '1234';
$database_name = 'homino';

$con = mysqli_connect($server, $username, $password, $database_name);

if(mysqli_connect_error())
{
    echo 'Failed to connect: '.mysqli_connect_error();
}
else
{
    $query = "SET CHARACTER SET utf8";
    mysqli_query($con, $query);
}

?>