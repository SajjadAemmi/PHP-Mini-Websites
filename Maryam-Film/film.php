<?php 
    include 'database.php';
    include 'functions.php';

    $film_id = $_GET['film_id'];
    
    $query="SELECT films.*, categories.title
            FROM films INNER JOIN categories
            ON films.category_id = categories.id
            WHERE films.id = $film_id";

    $film_table = mysqli_query($connection, $query);
    
    $film = mysqli_fetch_assoc($film_table);
    
    $query=" SELECT * FROM questions";
    $questions = mysqli_query($connection, $query);
//کامنت
    if(isset($_POST['send_comment']))
    {
        $user_id = $_SESSION['user_id'];
        $text = $_POST['message'];
        
        $query = "INSERT INTO comments (user_id , film_id , text) VALUES ('$user_id' , '$film_id' , '$text')";

        mysqli_query($connection, $query);
       
        header("location: film.php?film_id=" . $film_id);
        exit;
    }

    if($_SESSION['login'] == 1 && $_SESSION['login_type'] == "user")
    {
        $user_id = $_SESSION['user_id'];
        $query="SELECT *
                FROM rating
                WHERE film_id = $film_id AND user_id = $user_id";

        $rate = mysqli_query($connection, $query);

        if(mysqli_num_rows($rate) > 0)
        {
            $rate = mysqli_fetch_assoc($rate);
            $score = $rate["score"];
        }
        else
        {
            $score = 0;
        }
    }
    
    $scores = array();

    $index = 0;
//کامنت
    $query="SELECT comments.*, users.name, users.avatar
            FROM comments INNER JOIN users
            ON comments.user_id = users.id
            WHERE film_id = $film_id
            ORDER BY send_time DESC";

    $comments = mysqli_query($connection, $query);
?>
<?php include 'header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h2 class="panel-title"> فیلم <?php echo $film['name']; ?></h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">  
                        <center>
                            <img src="images/films/<?php echo $film['name']; ?>.jpg" alt="..." class="img-rounded img-responsive">  
                        
                              <?php if($_SESSION['login'] == 1  && $_SESSION['login_type'] == "user"): ?>  
                        
                            <style>
                                .checked {
                                    color: firebrick;
                                }
                                .hovered {
                                    color: darkorange;
                                }
                            </style>
                            <br>
                            <h3 class="panel-title"> به این فیلم امتیاز بدهید </h3>
                            <h1 id="score">
                                <span id="1" class="fa fa-heart"></span>
                                <span id="2" class="fa fa-heart"></span>
                                <span id="3" class="fa fa-heart"></span>
                                <span id="4" class="fa fa-heart"></span>
                                <span id="5" class="fa fa-heart"></span>
                            </h1>
                        </center>
                        
                        <script>
                        
                        $(document).ready(function()
                        {
                            var scores = [$('#1'), $('#2'), $('#3'),$('#4'),$('#5')];
                            
                            var index = <?php echo $score; ?>;
                            
                           for( var i = 0; i < index; i++)
                            {
                                scores[i].addClass('checked');
                            }
                            
                            $('#score span').mouseenter(function()
                            {
                                var index = Number($(this).attr('id'));

                                for( var i = 0; i < index; i++)
                                {
                                    scores[i].addClass('hovered');
                                }
                                for( var i = index; i < 5; i++)
                                {
                                    scores[i].removeClass('hovered');
                                }
                            });
                            
                            $('#score').mouseleave(function()
                            {
                                for( var i = 0; i < 5; i++)
                                {
                                    scores[i].removeClass('hovered');
                                }
                            });
                    
                            $('#score span').on('click', function()
                            {

                                var index = Number($(this).attr('id'));

                                for( var i = 0; i < index; i++)
                                {
                                    scores[i].addClass('checked');
                                }
                                for( var i = index; i < 5; i++)
                                {
                                    scores[i].removeClass('checked');
                                }
                                
                                var dataString = 'user_id=<?php echo $user_id; ?>&film_id=<?php echo $film_id; ?>&score=' + index;

                                $.ajax({
                                    type:"POST",
                                    url:"insert_score_in_database.php",
                                    data: dataString,
                                    cache: false,
                                    success: function(html){
                                        alert("امتیاز شما برای این فیلم ثبت شد!");
                                    }
                                });

                            });
                        });
                        
                        </script>
         
                        
                        <?php endif; ?>
                        
                        <br>
                    </div>
                    
                    <div class="col-md-8">        
                        <div class="col-md-6">
                            <div class="alert alert-info">سال ساخت: <b> <?php echo $film['year']; ?> </b></div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-warning"> دسته بندی: <?php echo $film['title']; ?> </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-success"> کارگردان: <?php echo $film['director']; ?> </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger"> امتیاز: <?php //echo $film['director']; ?> </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-danger"> ستارگان: <?php echo $film['actors']; ?> </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-info"> کشور ساخت: <?php echo $film['country']; ?> </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="well">
                                داستان فیلم:
                                <br>
                                <?php echo $film['story']; ?> 
                            </div> 
                        </div>
                        <div class="col-md-12">
                        <a href="films/<?php echo $film['name']; ?>.mp4" class="btn btn-success btn-lg btn-block btn3d" role="button"> دانلود با لینک مستقیم</a>
                        <br>
                            </div>
                    </div> 
                  
                    </div>
                </div>
                </div>





                <div class="row">
          
          <div class="col-md-12">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                      <h3 class="panel-title"> نمایش آنلاین </h3>
                  </div>
                  <div class="panel-body">
                  <?php if($_SESSION['login'] == 1 && $_SESSION['login_type'] == "user"): ?>
                  <center>
                  <video width="70%" controls>
                  <source src="images/films/<?php echo $film['name']; ?>.mkv">	
                  </video>
                   </center>
                   <?php endif; ?>
             
                
                  </div>
              </div>           
      </div>
  </div>







         <!--کامنت-->
                 <div class="row">
          
                <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"> نظرات کاربران </h3>
                        </div>
                        <div class="panel-body">	
                            <ul class="list-group">   
                                <?php foreach($comments as $comment): ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                            <img class="img-responsive img-circle" src="images/users/<?php echo $comment['avatar']; ?>" />
                                        </div>
                                        <div class="col-md-10 col-sm-9 col-xs-8">
                                            <h4 class="list-group-item-heading">
                                                <p> <?php echo $comment['name']; ?> </p>
                                            </h4>
                                            <p> <?php echo $comment['text']; ?> </p>
                                            <hr>
                                            <p class="list-group-item-text">
                                                <span class="badge pull-right">
                                                    <b><?php echo $comment['send_time']; ?></b>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>

                                <?php if($_SESSION['login'] == 1 && $_SESSION['login_type'] == "user"): ?>
                                <li class="list-group-item" style="background-color: #5bc0de;">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-2 col-xs-3">
                                            <p>ارسال نظر</p>
                                            <form method="post" action="film.php?film_id=<?php echo $film['id']; ?>">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="message"></textarea>
                                                </div>
                                                <button type="submit" name="send_comment" class="btn btn-default">ارسال</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>           
            </div>
        </div>


    </div> 
</div>        

<?php include 'footer.php'; ?>