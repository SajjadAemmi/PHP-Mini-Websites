<?php

    $connection = mysqli_connect("localhost","root","1234","maryam");

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