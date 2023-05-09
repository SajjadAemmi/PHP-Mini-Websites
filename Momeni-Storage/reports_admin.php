<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    $category_id = 0;

    if(isset($_POST['search']))
	{
        $query = "SELECT factors.*, storage_keepers.name AS storage_keeper_name, kalas.name AS kala_name ,kalas.id AS kala_id, kalas.price, kalas.origin_company , units.title, categories.type
                    FROM factors
                    INNER JOIN storage_keepers
                    ON factors.storage_keeper_id = storage_keepers.id
                    INNER JOIN kalas
                    ON factors.kala_id = kalas.id
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    WHERE kalas.unit_id = kalas.unit_id";	
        
        if($_POST['category'] != 0)
        {
            $category_id = $_POST['category'];
    
            $query .= " AND kalas.category_id = $category_id";	
        }
        
        if($_POST['storage_keeper_name'] != "")
        {
            $storage_keeper_name = $_POST['storage_keeper_name'];
            
            $query .= " AND storage_keepers.name = '$storage_keeper_name'";	
        }
        
        if($_POST['origin_company'] != "")
        {
            $origin_company = $_POST['origin_company'];
            
            $query .= " AND kalas.origin_company = '$origin_company'";	
        }
        
        if($_POST['start_date'] != "")
        {
            $start_date = $_POST['start_date'];
            
            $query .= " AND factors.factor_time >= '$start_date'";	
        }
        if($_POST['end_date'] != "")
        {
            $end_date = $_POST['end_date'];
            
            $query .= " AND factors.factor_time <= '$end_date'";	
        }
        
        $query .= " ORDER BY factors.factor_time DESC";
    }
    else
    {
        $query = "SELECT factors.*, storage_keepers.name AS storage_keeper_name, kalas.name AS kala_name ,kalas.id AS kala_id, kalas.price, kalas.origin_company , units.title, categories.type
                    FROM factors
                    INNER JOIN storage_keepers
                    ON factors.storage_keeper_id = storage_keepers.id
                    INNER JOIN kalas
                    ON factors.kala_id = kalas.id
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    ORDER BY factors.factor_time DESC";

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
            <h3 class="panel-title text-center"> گزارش فاکتورهای رسید و حواله انبار </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                         <div class="panel-heading">
                            <h3 class="panel-title text-center"> نمایش بر اساس </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <form method="post" action="reports_admin.php">
                            
                                    <div class="form-group">
                                        
                                        <label> دسته بندی </label>
                                        <select class="form-control" name="category" required>
                                            <option value="0">همه</option>
                                            <?php foreach($categories as $category): ?>

                                                <option value="<?php echo $category['id']; ?>" <?php if($category_id == $category['id']) echo "selected"; ?>><?php echo $category['type']; ?></option>

                                             <?php endforeach; ?>
                                        </select>
                                    </div>
                                     <div class="form-group">
                                        <label>نام انبار دار</label>
                                        <input type="text" name="storage_keeper_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>نام شرکت مبدا</label>
                                        <input type="text" name="origin_company" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>از تاریخ</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> تا تاریخ </label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <button type="submit" name="search" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> جستجو</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
       <div class="col-md-9">
        <?php if($kalas): ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> بارکد </th>
                    <th> نام کالا </th>
                    <th> دسته بندی </th>
                    <th> قیمت </th>
                    <th> موجودی جدید </th>
                    <th> واحد </th>
                    <th> شرکت مبدا </th>
                    <th> نام انباردار </th>
                    <th> تاریخ </th>
                </tr>
            </thead>
        <tbody>
              
        <?php foreach($kalas as $kala): ?>
            <tr>
                <td>
                    <?php echo $kala['kala_id']; ?>
                </td>
                <td>
                    <?php echo $kala['kala_name']; ?>
                </td>
                <td>
                    <?php echo $kala['type']; ?>
                </td>
                <td>
                    <?php echo $kala['price']; ?>
                </td>
                <td>
                    <?php echo $kala['difference_number']; ?>
                </td>
                <td>
                    <?php echo $kala['title']; ?>
                </td>
                <td>
                      <?php echo $kala['origin_company']; ?>
                </td>
                <td>
                      <?php echo $kala['storage_keeper_name']; ?>
                </td>
                <td>
                      <?php echo $kala['factor_time']; ?>
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
</div>
</div><!-- /.container -->
  </body>
</html>
<?php else: ?>

<?php header("Location: index.php") ?>

<?php endif; ?>