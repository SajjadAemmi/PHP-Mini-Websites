<?php 
include 'database.php';
include 'functions.php';

$query = "SELECT COUNT(rating.score) AS score_count, users.name
                FROM rating INNER JOIN users
                ON rating.user_id = users.id
                GROUP BY user_id";

$datas = mysqli_query($connection, $query);

$array = [];

foreach($datas as $data)
{
    $array[] = $data;
}

echo json_encode($array);

?>