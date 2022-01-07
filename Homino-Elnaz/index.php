<?php include('header.php'); 

$q = "SELECT * FROM footer";
$footer = mysqli_fetch_assoc(mysqli_query($con, $q));

?>

<div class="row">
    <div class="col-md-12">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/slider/slider3.jpg" alt="...">
                    <div class="carousel-caption font">
                        توضیح
                    </div>
                </div>
                <div class="item">
                    <img src="images/slider/slider2.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="images/slider/slider1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
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
    <div class="col-md-12">

        <h2 class="text-center font">خدمات ما</h2>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="well service">
                    <div class="row">
                        <div class="col-md-12">

                            <center>
                                <h4>نظافت منزل</h4>
                                <img class="img-responsive" src="images/2.png">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="well service">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>پرستاری</h4>
                                <img class="img-responsive" src="images/1.png">

                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="well service">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>سرویس در محل</h4>
                                <img class="img-responsive" src="images/3.png">

                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="well service">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>آرایشی بهداشتی</h4>
                                <img class="img-responsive" src="images/4.png">

                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="well footer">
            <div class="row">
                <div class="col-md-6">
                    <center>

                        <h3> <?php echo $footer['title']; ?> </h3> 
                        <p class="text-justify">
                            <?php echo $footer['text']; ?>
                        </p>        
                        <p>
                            <?php echo $footer['subtitle'];?>
                        </p>
                    </center>
                </div>
                <div class="col-md-6">
                    <center>

                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
