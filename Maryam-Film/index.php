<?php
    include 'database.php';
    include 'functions.php';
    include 'AII.php';
    

    $query = "UPDATE visitors SET number = number + 1 WHERE id = 1";
    mysqli_query($connection ,$query);

    $query = "SELECT *
                FROM films
                ORDER BY create_date DESC
                LIMIT 6";
  
    $films = mysqli_query($connection, $query);
    
    //AI
    if(isset($_SESSION['login']) && $_SESSION['login'] == 1 && $_SESSION['login_type'] == "user")
    {
        $user_id = $_SESSION['user_id'];
        
        $NearestUser_id = near($user_id);
        
        
        $query = "SELECT *
                    FROM films
                    WHERE id IN 
                    (SELECT film_id 
                    FROM rating 
                    WHERE user_id = '$NearestUser_id' 
                    AND score > 3 
                    AND film_id NOT IN
                    (SELECT film_id 
                    FROM rating 
                    WHERE user_id = '$user_id'))
                    ORDER BY create_date DESC
                    LIMIT 6";

        $recomended_films = mysqli_query($connection, $query);
    }


  

    include 'header.php'; 
?>

<div class="row">
    <div class="col-md-12"> 
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="images/slider/slider1.jpg" alt="با عرض پوزش عکس بارگزاری نشد">
              <div class="carousel-caption">

              </div>
            </div>
            <div class="item">
              <img src="images/slider/slider2.jpg" alt="...">
              <div class="carousel-caption">

              </div>
            </div>
            <div class="item">
              <img src="images/slider/slider3.jpg" alt="...">
              <div class="carousel-caption">

              </div>
            </div>
              <div class="item">
              <img src="images/slider/slider4.jpg" alt="...">
              <div class="carousel-caption">

              </div>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
</div>

<h4 class="bg-warning text-center" style="padding: 10px;">جدید ترین فیلم ها</h4>
<div class="row">
    <?php foreach($films as $film): ?>

            <div class="col-md-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h6 class="text-center"><?php echo $film['name']; ?></h6>
                    </div>	
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 film-img">
                                <img src="images/films/<?php echo $film['name']; ?>.jpg" class="img-rounded img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" >

                            <a href="film.php?film_id=<?php echo $film['id']; ?>" class="btn btn-warning btn-block btn3d" role="button"> جزییات...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>				
    <?php endforeach; ?>
</div>

<?php if(isset($_SESSION['login']) && $_SESSION['login'] == 1 && $_SESSION['login_type'] == "user"): ?>
<h4 class="bg-danger text-center" style="padding: 10px;">فیلم های پیشنهادی</h4>
<div class="row">
    <?php foreach($recomended_films as $recomended_film): ?>

            <div class="col-md-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h6 class="text-center"><?php echo $recomended_film['name']; ?></h6>
                    </div>	
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 film-img">
                                <img src="images/films/<?php echo $recomended_film['name']; ?>.jpg" class="img-rounded img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">

                            <a href="film.php?film_id=<?php echo $recomended_film['id']; ?>" class="btn btn-danger btn-block btn3d" role="button"> جزییات...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>				
    <?php endforeach; ?>
</div>
<?php endif; ?>



<?php include 'footer.php'; ?>