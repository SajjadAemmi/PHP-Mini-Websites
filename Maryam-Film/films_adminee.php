<?php 
    include 'database.php';
    include 'functions.php';

    if(isset($_POST['delete']))
    {
        $film_id = $_POST['id'];
        $query = "DELETE FROM films WHERE id = $film_id";
        mysqli_query($connection, $query);
    }

    if(isset($_POST['save']))
    {
        $film_id = $_POST['id'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $director = $_POST['director'];
        $year = $_POST['year'];
        $actors = $_POST['actors'];
        $story = $_POST['story'];
        $country = $_POST['country'];
        
        $query = "UPDATE films SET name = '$name', category_id = '$category_id', year = '$year',director = '$director', story = '$story', actors = '$actors', country = '$country' WHERE id = '$film_id'";
        mysqli_query($connection, $query);
    }
  
    $query = "SELECT films.*, categories.title
                FROM films INNER JOIN categories
                ON films.category_id = categories.id";

    $films = mysqli_query($connection, $query);
    
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
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> فیلم ها </h3>
            </div>
            <div class="panel-body">
                <a href="add_film_admin.php" class="btn btn-success btn-block btn-lg"> افزودن فیلم </a>
                <br>  
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> شماره </th>
                    <th> نام </th>
                    <th width="20%"> تصویر </th>
                    <th> کارگردان </th>
                    <th> گروه بندی </th>
                    <th> سال ساخت </th>
                    <th> داستان </th>
                    <th> ستارگان </th>
                    <th> کشور </th>
                  </tr>
                </thead>
                <tbody>
                
                <?php foreach ($films as $film): ?>
                  <tr>
                    <td class="text-center"> <?php echo $film['id']; ?> </td>
                    <td class="text-center"> <?php echo $film['name']; ?> </td>
                    <td> 
                        <img src="images/films/<?php echo $film['name']; ?>.jpg" class="img-rounded img-responsive">
                    </td>  
                    <td class="text-center"> <?php echo $film['director']; ?> </td>
                    <td class="text-center"> <?php echo $film['title']; ?> </td>
                    <td class="text-center"> <?php echo $film['year']; ?> </td>
                    <td class="text-center"> <?php echo $film['story']; ?></td>
                    <td class="text-center"> <?php echo $film['actors']; ?></td>
                    <td class="text-center"> <?php echo $film['country']; ?></td>
                    <td>
                      <center>
                          
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block btn3d" data-toggle="modal" data-target="#myModal<?php echo $film['id']; ?>">
                          ویرایش  
                        </button>
                          
                        </center>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $film['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">ویرایش</h4>
                                    </div>
                                
                                    <form method="post" action="films_admin.php">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label> نام </label>
                                                <input name="name" type="text" class="form-control" placeholder="" value="<?php echo $film['name']; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label> گروه بندی </label>
                                                    <select class="form-control" name="category_id">
                                                        <?php foreach($categories as $category): ?>            
                                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label> کارگردان </label>
                                                <input name="director" type="text" class="form-control" placeholder="" value="<?php echo $film['director']; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label> سال ساخت </label>
                                                <input name="year" type="text" class="form-control" placeholder="" value="<?php echo $film['year']; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label> توضیحات </label>
                                                <input name="story" type="text" class="form-control" placeholder="" value="<?php echo $film['story']; ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label> ستارگان </label>
                                                <input name="actors" type="text" class="form-control" placeholder="" value="<?php echo $film['actors']; ?>"/>
                                            </div>

                                            <div class="form-group">
                                                <label> کشور </label>
                                                <input name="country" type="text" class="form-control" placeholder="" value="<?php echo $film['country']; ?>"/>
                                            </div>
                                     
                                          <input type="hidden" name="id" value="<?php echo $film['id']; ?>">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                        <button type="submit" name="save" class="btn btn-success">ذخیره تغییرات</button>
                                      </div>

                                    </form>
                            </div>
                          </div>
                        </div>
                          
                        <form method="post" action="films_admin.php">
                            <input type="hidden" name="id" value="<?php echo $film['id']; ?>">
                             <br>

                           <center>
                             <button type="button" class="btn btn-danger btn-block btn3d" data-toggle="modal" data-target="#myModale<?php echo $film['id']; ?>">
                          حذف  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
                        </button>
                        </center>
                        <div class="modal fade" id="myModale<?php echo $film['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">حذف</h4>
                                    </div>
                                
                                    <form method="post" action="films_admin.php">
                                    
                                        <div class="modal-body"> 
                                        آیا میخواهید این فیلم را حذف کنید؟
                                          <input type="hidden" name="id" value="<?php echo $film['id']; ?>">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                                        <button type="submit" name="delete" class="btn btn-danger"> حذف فیلم </button>
                                      </div>

                                    </form>
                            </div>
                          </div>
                        </div>
                          

                        </form>
                      
                      </td>
                  </tr>
                <?php endforeach; ?>
                    
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>   
 
<?php include 'footer.php'; ?>