<?php 

    function near($user_id)
    {
        include "database.php";
        $matrix = array();
        array_push($matrix,array("id" => $user_id,"scores" => array()));
        $query = "SELECT id FROM users
                    WHERE id <> $user_id ";      
        $users = mysqli_query($connection, $query);
        foreach($users as $user)
        {
            array_push($matrix,array("id" => $user["id"],"scores" => array()));
        }

         
        $query = "SELECT id FROM categories";
        $categories = mysqli_query($connection, $query);

        foreach($categories as $category)
        {
            foreach($matrix as &$row)
            {
                $userid = $row['id'];
                $categoryid = $category['id'];

                $query = "SELECT SUM(rating.score) AS sum
                            FROM rating INNER JOIN films
                            ON rating.film_id = films.id
                            WHERE user_id = $userid AND category_id=$categoryid
                            GROUP BY category_id";
                $rate = mysqli_query($connection,$query);

                if(mysqli_num_rows($rate) == 1)
                {
                    $rate = mysqli_fetch_assoc($rate);
                   
                    array_push($row['scores'],$rate['sum']);
                }
                else
                {
                    array_push($row['scores'], 0);
                }
            }
        }

        $min = PHP_INT_MAX;
                
        for($i = 1 ; $i < count($matrix); $i++) // loop for users
        {
            $sum = 0;
            
            for($j = 0 ; $j < count($matrix[$i]['scores']); $j++) // loop for scores
            {
                $sum += pow($matrix[$i]['scores'][$j] - $matrix[0]['scores'][$j], 2);
            }
            $distance = sqrt($sum);
           
            if($distance < $min)
            {
                $min = $distance;
            
                $NearestUser_id = $matrix[$i]['id'];
                
            }
        }
       
  
    
        return $NearestUser_id;
    }
?>