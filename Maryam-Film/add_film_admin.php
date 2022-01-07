<?php 
    include 'database.php';
    include 'functions.php';

    if(isset($_POST['add']))
    {

        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $director = $_POST['director'];
        $story = $_POST['story'];
        $actors = $_POST['actors'];
        $year = $_POST['year'];
        $country = $_POST['country'];
               
        if(isset($_FILES['film']))
        {
            move_uploaded_file($_FILES["film"]["tmp_name"] , "films/". utf8_encode($name) .".mp4");
        }
        if(isset($_FILES['image']))
        {
            move_uploaded_file($_FILES["image"]["tmp_name"] , "images/films/". utf8_encode($name) .".jpg");
        }

        $query="INSERT INTO films (name, category_id, director, story, actors , year, country) VALUES ('$name', '$category_id', '$director', '$story', '$actors' , '$year', '$country')";
        mysqli_query($connection, $query);

        header('Location: films_admin.php');
    }

    $query = "SELECT * FROM categories ORDER BY DESC";
    $categories = mysqli_query($connection, $query);

    include 'header.php';
?>    
  <div class="row">
      <div class="col-md-12">
        <a href="films_admin.php" class="btn btn-warning">
           <i class="fa fa-arrow-right"></i> بازگشت 
        </a>
    </div>
</div>
<br>   
    
<div class="row">
    
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">افزودن فیلم جدید</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="add_film_admin.php" enctype="multipart/form-data" charset="utf-8">
         
                       <div class="form-group">
                            <label> نام فیلم </label>
                            <input name="name" type="text" class="form-control" placeholder=""/>
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
                            <label> سال تولید </label>
                            <input name="year" type="text" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group">
                            <label> داستان فیلم </label>
                            <textarea name="story" type="text" rows="8" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="form-group">
                            <label> ستارگان </label>
                            <input name="actors" type="text" class="form-control" placeholder=""/>
                        </div>

                        <div class="form-group">
                            <label> کشور </label>
                            <input name="country" type="text" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group">
                            <label> کارگردان </label>
                            <input name="director" type="text" class="form-control" placeholder=""/>
                        </div>

                      <div class="form-group">
                        <label>بارگزاری تصویر</label>
                        <input type="file" name="image" class="btn btn-warning">
                        <p class="help-block"></p>
                      </div>  

                      <div class="form-group">
                        <label>بارگزاری فیلم</label>
                        <input type="file" name="film" class="btn btn-warning">
                        <p class="help-block"></p>
                      </div> 
                    <input type="submit" name="add" class="btn btn-success" value="افزودن">
                 
                </form>
        </div>
        </div>
</div>
        
</div>

<?php include 'footer.php'; ?>