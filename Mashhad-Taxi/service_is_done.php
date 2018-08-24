<?php 
    include 'database.php';  
    include 'functions.php'; 

    $serivce_id = $_POST['service_id'];

    $query = "UPDATE services 
                SET is_done = 1 
                WHERE id = $serivce_id";

    mysqli_query($connection, $query);

?>