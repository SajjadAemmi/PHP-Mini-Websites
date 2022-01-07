<?php 

    $query="SELECT * FROM users";
    $users=mysqli_query($connection,$query);
    
    $number_of_users = mysqli_num_rows($users);

    $query = "SELECT * FROM films";
    $films = mysqli_query($connection,$query);
    
    $number_of_films = mysqli_num_rows($films);

    $query="SELECT * FROM visitors";
    $visitors_table = mysqli_query($connection,$query);
     
    $visitor = mysqli_fetch_assoc($visitors_table);

    $number_of_visitors = $visitor['number'];
?>    

<!-- footer -->

<div class="row"> 
    <div class="col-md-12">
        <div class="jumbotron" style="margin:0;">
            <div class="row">
               <div class="col-md-3">
           
                    <img src="images/logo/maryam.png" style="margin-top: 15px;" width="100%">

                </div>
                <div class="col-md-3">
           
                    <ul class="list-group">
                        <li class="list-group-item">َ<span class="glyphicon glyphicon-globe" aria-hidden="true"></span><strong> سایت دانلود فیلم  </strong></li>
                         <li class="list-group-item"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> ایمیل: </li>
                        <li class="list-group-item">
                            <center>
                                
                                <a href="https://telegram.com"><img src="images/logo/telegram.png" width="58px"></a> 
                                <a href="https://instagram.com"><img src="images/logo/instagram.png" width="58px"></a>  
                                <a href="https://twitter.com"><img src="images/logo/twitter.png" width="58px"></a> 
                            </center>
                        </li>
                    </ul>
                  
                </div>
                <div class="col-md-3">
           
                    <ul class="list-group">
                      <li class="list-group-item"><strong> لینک وبسایت های مرتبط </strong></li>
                      <li class="list-group-item"><a href="http://www.iranfilm.info"> ایران فیلم </a></li>
                      <li class="list-group-item"><a href="http://www.imdb.com/list/ls058542480/"> IMDB </a></li>
                      <li class="list-group-item"><a href="http://www.sadjad.ac.ir/"> دانشگاه صنعتی سجاد </a></li>
            
                    </ul>
                  
                </div>
                <div class="col-md-3">
           
                    <ul class="list-group">
                        <li class="list-group-item"><strong> آمار وبسایت </strong></li>
                      <li class="list-group-item"> تعداد بازدیدها: <?php echo $number_of_visitors; ?> </li>
                      <li class="list-group-item"> تعداد کاربران: <?php echo $number_of_users; ?> </li>
                      <li class="list-group-item"> تعداد فیلم ها: <?php echo $number_of_films; ?> </li>
                    </ul>
                </div>
            </div>
            <h4 class="text-center">  | Copyright&#169; 2017 </h4>
        </div>
    </div>
</div>
<br>
</div>
</body>
</html>