<?php 
include 'database.php';
include 'functions.php';

$query = "SELECT SUM(rating.score) AS score_sum, films.name
            FROM rating INNER JOIN films
            ON rating.film_id = films.id
            GROUP BY film_id                 
            ORDER BY score_sum DESC
            LIMIT 10";

$datas = mysqli_query($connection, $query);

$array = [];

foreach($datas as $data)
{
    $array[] = $data;
}

echo json_encode($array);

?>