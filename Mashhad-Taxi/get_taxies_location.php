<?php 
    include 'database.php'; 
    include 'functions.php'; 

    $query = "SELECT * FROM taxies";

    $taxies = mysqli_query($connection, $query);

    $data = [];

    foreach($taxies as $taxi) 
    {
         $data[] = $taxi;
    }

    echo json_encode($data);