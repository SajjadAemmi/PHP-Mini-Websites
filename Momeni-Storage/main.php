<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    $category_id = 0;

    if(isset($_POST['search']))
	{
        if($_POST['category'] == 0)
        {
            $query = "SELECT kalas.*, categories.type, units.title
                    FROM kalas
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    kalas.number > 0
                    ORDER BY insert_date DESC";	
        }
        else
        {
            $category_id = $_POST['category'];
    
            $query = "SELECT kalas.*, categories.type, units.title
                    FROM kalas
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    WHERE kalas.category_id = $category_id AND kalas.number > 0
                    ORDER BY insert_date DESC";	
        }
    }
    else
    {
        $query = "SELECT kalas.*, categories.type, units.title
                    FROM kalas
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    WHERE kalas.number > 0
                    ORDER BY insert_date DESC";

    }

    $kalas = mysqli_query($connection, $query);

    $query = "SELECT *
                FROM categories";
	
    $categories = mysqli_query($connection, $query);

?>	

<?php include 'header.php'; ?>

<?php if(isset($_SESSION['is_logged_in'])): ?>
        
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center"> لیست کالا های انبار </h3>
        </div>
        <div class="panel-body">
        <div class="form-group">
            <input id="search" type="text" class="form-control" placeholder="جستجو...">
        </div>
            
        <form class="form-inline" method="post" action="main.php">
            <div class="form-group">
                <label>دسته بندی</label>
                <select class="form-control" name="category" required>
                    <option value="0">همه</option>
                    <?php foreach($categories as $category): ?>

                        <option value="<?php echo $category['id']; ?>" <?php if($category_id == $category['id']) echo "selected"; ?>><?php echo $category['type']; ?></option>

                     <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" name="search" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> جستجو</button>
        </form>
                
        <br>
            
        <?php if($kalas): ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> بارکد </th>
                    <th> نام </th>
                    <th> دسته بندی </th>
                    <th> قیمت </th>
                    <th> موجودی </th>
                    <th> واحد </th>
                    <th width="20%"> تصویر </th>
                    <th> توضیحات </th>
                    <th> شرکت مبدا </th>
                </tr>
            </thead>
        <tbody id="old_kalas">
              
        <?php foreach($kalas as $kala): ?>
            <tr>
                <td>
                    <?php echo $kala['id']; ?>
                </td>
                <td>
                    <?php echo $kala['name']; ?>
                </td>
                <td>
                    <?php echo $kala['type']; ?>
                </td>
                <td>
                    <?php echo $kala['price']; ?>
                </td>
                <td>
                    <?php echo $kala['number']; ?>
                </td>
                <td>
                    <?php echo $kala['title']; ?>
                </td>
                <td>
                   <img class="img-thumbnail img-responsive" src="images/kalas/<?php echo $kala['id']; ?>.jpg" />
                </td>
                  <td>
                      <?php echo $kala['about']; ?>
                </td>
                <td>
                      <?php echo $kala['origin_company']; ?>
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

<script>

    
    var $rows = $('#old_kalas tr');
    $('#search').keyup(function() {
      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

      $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
      }).hide();
    });
</script>

</div>
</div><!-- /.container -->
  </body>
</html>
<?php else: ?>

<?php header("Location: index.php") ?>

<?php endif; ?>