<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    $query = "SELECT *
                FROM categories";
	
    $categories = mysqli_query($connection, $query);

    $query = "SELECT kalas.*, categories.type, units.title
                FROM kalas
                INNER JOIN categories
                ON kalas.category_id = categories.id
                INNER JOIN units
                ON kalas.unit_id = units.id
                ORDER BY insert_date DESC";

    $kalas = mysqli_query($connection, $query);
	
?>	

<?php include 'header.php'; ?>

<?php if(isset($_SESSION['is_logged_in'])): ?>

<form method="post" action="factor_remove.php">
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="remove" class="btn btn-success btn-lg btn-block"> <span class="glyphicon glyphicon-copy"></span> ثبت تغییرات و صدور فاکتور </button>
            </div>
        </div>  
    <br>
   
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> لیست کالا های انبار </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input id="search" type="text" class="form-control" placeholder="جستجو...">
                </div>
                <?php if($kalas): ?>

                <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th> بارکد </th>
                        <th> نام </th>
                        <th> دسته بندی </th>
                        <th> تعداد / مقدار </th>
                        <th> واحد </th>
                        <th> کاهش تعداد کالا </th>
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
                            <?php echo $kala['number']; ?>
                        </td>
                        <td>
                            <?php echo $kala['title']; ?>
                        </td>
                        <td>
                            <div class="form-group has-error">
                                <input type="number" value="0" min="0" max="<?php echo $kala['number']; ?>" name="<?php echo $kala['id']; ?>" class="form-control">
                            </div>
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
</form>    
    
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