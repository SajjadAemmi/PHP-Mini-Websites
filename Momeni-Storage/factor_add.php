<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php include 'header.php';?>
<?php
	
    $storage_keeper_id = $_SESSION['user_id'];

	if(isset($_POST['add']))
    {
        $old_kalas = array();
        $new_kalas = array();
        
        // افزودن به تعداد کالا های موجود
        
        $query = "SELECT * FROM kalas";
        $kalas = mysqli_query($connection, $query);
        
        foreach($kalas as $kala)
        {
            $kala_id = $kala['id'];
            $new_number = $_POST[$kala['id']];
            
            $query = "UPDATE kalas SET number = number + $new_number WHERE id = $kala_id";
            mysqli_query($connection, $query);
            
            if($new_number > 0)
            {
                $query = "INSERT INTO factors (storage_keeper_id, kala_id, difference_number) VALUES ('$storage_keeper_id', '$kala_id', '$new_number')";
            
                mysqli_query($connection, $query);
            
                $query = "SELECT kalas.*, categories.type, units.title
                    FROM kalas
                    INNER JOIN categories
                    ON kalas.category_id = categories.id
                    INNER JOIN units
                    ON kalas.unit_id = units.id
                    WHERE kalas.id = $kala_id";

                $kala_table = mysqli_query($connection, $query);
                $kala = mysqli_fetch_assoc($kala_table);
                
                $kala['number'] = $new_number;
                
                $old_kalas[] = $kala;
            }
        }
        
        // افزودن کالا های جدید
        
        $number_of_new_kalas = $_POST['number_of_new_kalas'];
        
        for($i = 0; $i < $number_of_new_kalas; $i++)
        {
            $name = $_POST["name" . $i];
            $category_id = $_POST["category" . $i];
            $price = $_POST["price" . $i];
            $number = $_POST["number" . $i];
            $about = $_POST["about" . $i];
            $unit_id = $_POST["unit" . $i];
            $origin_company = $_POST["origin_company" . $i];
            
            $query = "INSERT INTO kalas (name, about, category_id, price, number, unit_id, origin_company) VALUES ('$name', '$about', '$category_id', '$price', '$number', '$unit_id', '$origin_company')";
            
            mysqli_query($connection, $query);
            
            $kala_id = mysqli_insert_id($connection);
            
            $query = "INSERT INTO factors (storage_keeper_id, kala_id, difference_number) VALUES ('$storage_keeper_id', '$kala_id', '$number')";
            
            mysqli_query($connection, $query);
            
            if(isset($_FILES["image" . $i]))
            {
                move_uploaded_file($_FILES["image" . $i]["tmp_name"],"images/kalas/". $kala_id .".jpg");
            }
            
            $query = "SELECT kalas.*, categories.type, units.title
                        FROM kalas
                        INNER JOIN categories
                        ON kalas.category_id = categories.id
                        INNER JOIN units
                        ON kalas.unit_id = units.id
                        WHERE kalas.id = $kala_id";

            $kala_table = mysqli_query($connection, $query);
            $kala = mysqli_fetch_assoc($kala_table);
            
            $new_kalas[] = $kala;
        }
        unset($_POST['add']);
    }
?>



<?php if(isset($_SESSION['is_logged_in'])): ?>

<div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:window.print()" class="btn btn-success btn-lg btn-block">
                   <span class="glyphicon glyphicon-print" aria-hidden="true"></span> چاپ فاکتور
                </a>
            </div>
        </div>  
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> فاکتور رسید انبار </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-center">نام انباردار: <?php echo $_SESSION['name']; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center">تاریخ: <?php echo date("Y-m-d",time()); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center">ساعت: <?php echo date("h:i:s a",time()); ?></p>
                    </div>
                </div>
                    
                
                
                <br>
                <div class="alert alert-info text-center" role="alert">کالا های جدید</div>  
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> بارکد </th>
                            <th> نام </th>
                            <th> دسته بندی </th>
                            <th> قیمت </th>
                            <th> تعداد / مقدار </th>
                            <th> واحد </th>
                        </tr>
                    </thead>
                    <tbody id="list">
                        
                    <?php foreach($new_kalas as $new_kala): ?>
                        <tr>
                            <td>
                                <?php echo $new_kala['id']; ?>
                            </td>
                            <td>
                                <?php echo $new_kala['name']; ?>
                            </td>
                            <td>
                                <?php echo $new_kala['type']; ?>
                            </td>
                            <td>
                                <?php echo $new_kala['price']; ?>
                            </td>
                            <td>
                                <?php echo $new_kala['number']; ?>
                            </td>
                             <td>
                                <?php echo $new_kala['title']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                </table>
                
                <hr>
                <div class="alert alert-info text-center" role="alert">مقدار جدید کالا های موجود</div>
                
                <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th> بارکد </th>
                        <th> نام </th>
                        <th> دسته بندی </th>
                        <th> قیمت </th>
                        <th> تعداد / مقدار </th>
                        <th> واحد </th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach($old_kalas as $old_kala): ?>
                        <tr>
                            <td>
                                <?php echo $old_kala['id']; ?>
                            </td>
                            <td>
                                <?php echo $old_kala['name']; ?>
                            </td>
                            <td>
                                <?php echo $old_kala['type']; ?>
                            </td>
                            <td>
                                <?php echo $old_kala['price']; ?>
                            </td>
                            <td>
                                <?php echo $old_kala['number']; ?>
                            </td>
                            <td>
                                <?php echo $old_kala['title']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                   
                    </tbody>
                </table>
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