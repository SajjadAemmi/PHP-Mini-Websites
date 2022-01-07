<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php include 'header.php';?>
<?php
    
    $storage_keeper_id = $_SESSION['user_id'];

	if(isset($_POST['remove']))
    {
        $removed_kalas = array();
       
        // کاهش از تعداد کالا های موجود
        
        $query = "SELECT * FROM kalas";
        $kalas = mysqli_query($connection, $query);
        
        foreach($kalas as $kala)
        {
            $kala_id = $kala['id'];
            $remove_number = $_POST[$kala['id']];
            
            $query = "UPDATE kalas SET number = number - $remove_number WHERE id = $kala_id";
            mysqli_query($connection, $query);
            
            if($remove_number > 0)
            {
                $difference_number = -1 * $remove_number;
                
                $query = "INSERT INTO factors (storage_keeper_id, kala_id, difference_number) VALUES ('$storage_keeper_id', '$kala_id', '$difference_number')";
            
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
                
                $kala['number'] = $remove_number;
                
                $removed_kalas[] = $kala;
            }
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
                <h3 class="panel-title text-center"> فاکتور حواله انبار </h3>
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
                    
                <hr>
                <div class="alert alert-info text-center" role="alert">مقدار حذف شده از کالاهای موجود</div>
                
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

                    <?php foreach($removed_kalas as $removed_kala): ?>
                        <tr>
                            <td>
                                <?php echo $removed_kala['id']; ?>
                            </td>
                            <td>
                                <?php echo $removed_kala['name']; ?>
                            </td>
                            <td>
                                <?php echo $removed_kala['type']; ?>
                            </td>
                            <td>
                                <?php echo $removed_kala['price']; ?>
                            </td>
                            <td>
                                <?php echo $removed_kala['number']; ?>
                            </td>
                            <td>
                                <?php echo $removed_kala['title']; ?>
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