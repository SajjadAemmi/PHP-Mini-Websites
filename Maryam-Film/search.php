<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    $category_id = 0;

    if(isset($_POST['search']))
	{
        $query = "SELECT films.*, categories.title
                    FROM films INNER JOIN categories
                    ON films.category_id = categories.id";	
        
        if($_POST['category'] != 0)
        {
            $category_id = $_POST['category'];
    
            $query .= " AND films.category_id = $category_id";	
        }
        
        if($_POST['director'] != "")
        {
            $director_name = $_POST['director'];
            
            $query .= " AND films.director = '$director_name'";	
        }
        
        if($_POST['name'] != "")
        {
            $name = $_POST['name'];
            
            $query .= " AND films.name = '$name'";	
        }
        
        if($_POST['start_year'] != "")
        {
            $start_year = $_POST['start_year'];
            
            $query .= " AND films.year >= '$start_year'";	
        }
        if($_POST['end_year'] != "")
        {
            $end_year = $_POST['end_year'];
            
            $query .= " AND films.year <= '$end_year'";	
        }
        

        if($_POST['country'] != "")
        {
            $country = $_POST['country'];
            
            $query .= " AND films.country = '$country'";	
        }
        $query .= " ORDER BY films.id DESC";
    }
    else
    {
        $query = "SELECT films.*, categories.title
                    FROM films INNER JOIN categories
                    ON films.category_id = categories.id
                    ORDER BY films.id DESC";

    }

    $films = mysqli_query($connection, $query);

    $query = "SELECT *
                FROM categories";
	
    $categories = mysqli_query($connection, $query);

?>	

<?php include 'header.php'; ?>


    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title text-center"> جستجوی پیشرفته</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-success">
                         <div class="panel-heading">
                            <h3 class="panel-title text-center"> نمایش بر اساس </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <form method="post" action="search.php">
                                    
                                     <div class="form-group">
                                        <label>نام فیلم</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        
                                        <label> دسته بندی </label>
                                        <select class="form-control" name="category" required>
                                            <option value="0">همه</option>
                                            <?php foreach($categories as $category): ?>

                                                <option value="<?php echo $category['id']; ?>" <?php if($category_id == $category['id']) echo "selected"; ?>><?php echo $category['title']; ?></option>

                                             <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>نام کارگردان</label>
                                        <input type="text" name="director" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label> کشور </label>
                                        <input type="text" name="country" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>از سال</label>
                                        <input type="number" name="start_year" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> تا سال </label>
                                        <input type="number" name="end_year" class="form-control">
                                    </div>
                                    <button type="submit" name="search" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> جستجو</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
       <div class="col-md-9">
        <?php if($films): ?>

           <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> شماره </th>
                    <th> نام </th>
                    <th width="20%"> تصویر </th>
                    <th> کارگردان </th>
                    <th> گروه بندی </th>
                    <th> سال ساخت </th>
                    <th> ستارگان </th>
                    <th>  کشور </th>
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
                    <td class="text-center"> <?php echo $film['actors']; ?></td>
                    <td class="text-center"> <?php echo $film['country']; ?></td>
                    <td>
                      <center>
                          <a href="film.php?film_id=<?php echo $film['id']; ?>" class="btn btn-warning btn-block" role="button"> جزییات...</a>
                        </center>
                      </td>
                  </tr>
                <?php endforeach; ?>
                    
                </tbody>
              </table>
              	
    <?php else: ?>
    <p>چیزی برای نمایش موجود نیست</p>
    <?php endif; ?>	
        
</div>
</div>
    </div>
    </div>
<?php include 'footer.php'; ?> 