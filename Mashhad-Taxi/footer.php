<?php
    $query = "SELECT * FROM taxies";
	$taxies = mysqli_query($connection, $query);
    $numberOfTaxies = mysqli_num_rows($taxies);

    $query = "SELECT * FROM users";
	$users = mysqli_query($connection, $query);
    $numberOfUsers = mysqli_num_rows($users);

    $query = "SELECT * FROM services";
	$services = mysqli_query($connection, $query);
    $numberOfServices = mysqli_num_rows($services);
?>                   
<div class="row">
                       
    <div class="col-md-12">       
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">آمار مشهد تاکسی</h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                  <li class="list-group-item">
                    <h4 class="list-group-item-heading"><i class="fa fa-road"></i> تعداد سرویس ها: <?php echo $numberOfServices; ?></h4>
                  </li>
                <li class="list-group-item">
                    <h4 class="list-group-item-heading"><i class="fa fa-taxi"></i> تعداد تاکسی ها: <?php echo $numberOfTaxies; ?></h4>
                  </li>
                  <li class="list-group-item">
                    <h4 class="list-group-item-heading"><i class="fa fa-user-circle"></i> تعداد کاربران: <?php echo $numberOfUsers;  ?></h4>
                  </li>
                </ul>
            </div>
        </div>
    </div>
</div>

                    <footer class="blog-footer">
                        <div class="row">
                            <div class="col-md-12">
                              <p>مشهد تاکسی | Mashhad Taxi</p>
                              <p>
                                سیده عاطفه وزیری - سیده سمانه سجادی
                              </p>
                            <hr>
                              <p>
                                copyright 2017
                              </p>
                            </div>  
                        </div>  
                    </footer>

                </div><!-- /.container -->
            </div>
        </div>
    </body>
</html>
