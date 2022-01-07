<?php
    include 'database.php';
    include 'functions.php';

    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        
        $query = "SELECT *
                    FROM films 
                    WHERE films.category_id = $category_id ORDER BY create_date DESC";
    }
    else
    {
         $query = "SELECT *
                    FROM films ORDER BY create_date DESC";
    }

    $films = mysqli_query($connection, $query);
    
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

<br>
  
<div class="row">
       
                    <?php foreach($films as $film): ?>

                            <div class="col-md-3">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <?php echo $film['name']; ?>
                                    </div>	
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 film-img">
                                                <center>
                                                <img src="images/films/<?php echo $film['name']; ?>.jpg" class="img-rounded img-responsive">
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="alert alert-warning"><p class="text-center"> سال ساخت: <b><?php echo $film['year']; ?></b></p></div>
                                               
                                            <a href="film.php?film_id=<?php echo $film['id']; ?>" class="btn btn-warning btn-block btn3d" role="button"> مشاهده جزییات</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>				
                    <?php endforeach; ?>
            
    </div>  
     
<?php include 'footer.php'; ?>