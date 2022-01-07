<?php
    include 'database.php';
    include 'functions.php'; 
    
         $query = "SELECT * FROM news 
                    ORDER BY create_date DESC";
         $news = mysqli_query($connection, $query);
    
    include 'header.php'; 
?>


<br>
  
<div class="row">
       
                    <?php foreach($news as $new): ?>

                            <div class="col-md-12">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <?php echo $new['title']; ?>
                                    </div>	
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                <div class="col-md-4">
                                                <img class="img-responsive " src="images/news/<?php echo $new["avatar"]; ?>" />
                                           

                                          
                                                </div>
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                <div class="col-md-12">
                                   <div class="well">
                                          
                                       <br>
                                       <?php echo $new['text']; ?> 
                                   </div> 
                                </div>
                                      
                                </div>
                            </div>
                        </div>				
                    <?php endforeach; ?>
            
    </div>  
     
<?php include 'footer.php'; ?>