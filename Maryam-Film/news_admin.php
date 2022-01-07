<?php 
    include 'database.php';
    include 'functions.php';

    if(isset($_POST['delete']))
    {
        $new_id = $_POST['id'];
        $query = "DELETE FROM news WHERE id = $new_id";
        mysqli_query($connection, $query);
        
        header("location: news_admin.php");
        exit;
    }

    if(isset($_POST['add']))
    {

        $title = $_POST['title'];
                $text = $_POST['text'];
            
            $image = time().".jpg";
            
                if(isset($_FILES['image']))
                {
                    move_uploaded_file($_FILES["image"]["tmp_name"] , "images/news/". $image );
                }
                $query =$query = "INSERT INTO news (title, text, avatar) VALUES ('$title', '$text', '$image')";
                
                mysqli_query($connection, $query);

        header("location: news_admin.php");
        exit;
    }

    $query = "SELECT * FROM news ";
    $news = mysqli_query($connection, $query);

    include 'header.php';
?>    

<div class="row">
    <div class="col-md-12">
        <a href="panel_admin.php" class="btn btn-info">
            بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"> لیست اخبار </h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    <?php if($news): ?>	
                        <?php foreach($news as $new): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9 col-sm-6 col-xs-6">
                                        <?php echo $new['text']; ?>
                                    </div>



                                    <!--modal-->
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <form method="post" action="news_admin.php">
                                       
                            <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                             <br>

                           <center>
                             <button type="button" class="btn btn-danger btn-block btn3d" data-toggle="modal" data-target="#myModale<?php echo $new['id']; ?>">
                          حذف  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
                        </button>
                        </center>
                        <div class="modal fade" id="myModale<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">حذف</h4>
                                    </div>
                                
                                    <form method="post" action="news_admin.php">
                                    
                                        <div class="modal-body"> 
                                        آیا میخواهید این خبر را حذف کنید؟
                                          <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                        <button type="submit" name="delete" class="btn btn-danger"> حذف خبر </button>
                                      </div>

                                    </form>
                            </div>
                          </div>
                        </div>
                        </form>
                      
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>هیچ خبری وجود ندارد</p>
                    <?php endif; ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-9 col-sm-6 col-xs-6">
                                درج خبر جدید
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-block btn3d" data-toggle="modal" data-target="#myModal_add">
                                 &nbsp; درج
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">  &nbsp; اضافه نمودن خبر جدید </h4>
                                      </div>

                                        <form method="post" action="news_admin.php" enctype="multipart/form-data">  

                                          <div class="modal-body">

                                                <div class="form-group">
                                                <lable>تیتر خبر </lable>
                                                <input type="text" name="title" class="form-control">
                                                <label> متن خبر </label>
                                                <input type="text" name="text" class="form-control">
                                               
                                              <label>بارگزاری تصویر</label>
                                              <input type="file" name="image" class="btn btn-info">
                     
                                                </div>

                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                            <button type="submit" name="add" class="btn btn-primary"> افزودن </button>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </li>
                </ul>	
            </div>
        </div>
    </div>
</div>
    
<?php include 'footer.php'; ?> 