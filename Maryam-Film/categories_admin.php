<?php 
    include 'database.php';
    include 'functions.php';

    if(isset($_POST['delete']))
    {
        $category_id = $_POST['id'];
        $query = "DELETE FROM categories WHERE id = $category_id";
        mysqli_query($connection, $query);
        
        header("location: categories_admin.php");
        exit;
    }

    if(isset($_POST['add']))
    {
        $title = $_POST['title'];
        $query = "INSERT INTO categories (title) VALUES ('$title')";
        mysqli_query($connection, $query);
        
        header("location: categories_admin.php");
        exit;
    }

    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);

    include 'header.php';
?>    

<div class="row">
    <div class="col-md-12">
        <a href="panel_admin.php" class="btn btn-warning">
           <i class="fa fa-arrow-right"></i> بازگشت به پنل ادمین 
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"> لیست گروه بندی ها </h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    <?php if($categories): ?>	
                        <?php foreach($categories as $category): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9 col-sm-6 col-xs-6">
                                        <?php echo $category['title']; ?>
                                    </div>




                                    
                                                                         <!--modal-->
                                                                         <div class="col-md-3 col-sm-6 col-xs-6">
                                        <form method="post" action="categories_admin.php">
                                       
                            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                             <br>

                           <center>
                             <button type="button" class="btn btn-danger btn-block btn3d" data-toggle="modal" data-target="#myModal<?php echo $category['id']; ?>">
                          حذف  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
                        </button>
                        </center>
                        <div class="modal fade" id="myModal<?php echo $category['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">حذف</h4>
                                    </div>
                                
                                    <form method="post" action="categories_admin.php">
                                    
                                        <div class="modal-body"> 
                                        آیا میخواهید این دسته بندی را حذف کنید؟
                                          <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                        <button type="submit" name="delete" class="btn btn-danger"> حذف دسته بندی </button>
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
                        <p>هیچ گروه بندی ای وجود ندارد</p>
                    <?php endif; ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-9 col-sm-6 col-xs-6">
                                درج گروه بندی جدید
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-block btn3d" data-toggle="modal" data-target="#myModal_add">
                                 درج
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"> اضافه نمودن گروه بندی جدید </h4>
                                      </div>

                                        <form method="post" action="categories_admin.php">  

                                          <div class="modal-body">

                                                <div class="form-group">
                                                <label> عنوان گروه بندی </label>
                                                <input type="text" name="title" class="form-control">

                                                </div>

                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                            <button type="submit" name="add" class="btn btn-success"> درج </button>
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