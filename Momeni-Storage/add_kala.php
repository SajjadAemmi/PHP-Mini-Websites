<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    $query = "SELECT *
                FROM categories";
    $categories = mysqli_query($connection, $query);

    $query = "SELECT *
                FROM units";
    $units = mysqli_query($connection, $query);

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

<script type="text/javascript">
    var cntr = 0;
    
    function AddNewRow() 
    {
        var tbody = document.getElementById("list");
        var tr = document.createElement("tr");
        
        //نام کالا
        var td_name = document.createElement("td");
        
        var input_name = document.createElement("input");
        input_name.setAttribute("type", "text");
        input_name.setAttribute("name", "name" + cntr);
        input_name.setAttribute("class", "form-control");
        
        td_name.appendChild(input_name);
        tr.appendChild(td_name);
        
        //دسته بندی کالا
        var td_category = document.createElement("td");
        
        var select = document.createElement("select");
        
        <?php foreach($categories as $category): ?>
        
        var option_<?php echo $category['id']; ?> = document.createElement("option");
        option_<?php echo $category['id']; ?>.setAttribute("value", "<?php echo $category['id']; ?>");
        option_<?php echo $category['id']; ?>.appendChild(document.createTextNode("<?php echo $category['type']; ?>"));
        select.appendChild(option_<?php echo $category['id']; ?>);
        
        <?php endforeach; ?>
        
        select.setAttribute("name", "category" + cntr);
        select.setAttribute("class", "form-control");
        
        td_category.appendChild(select);
        tr.appendChild(td_category);
        
        //قیمت کالا
        var td_price = document.createElement("td");
        
        var input_price = document.createElement("input");
        input_price.setAttribute("type", "text");
        input_price.setAttribute("name", "price" + cntr);
        input_price.setAttribute("class", "form-control");
        
        td_price.appendChild(input_price);
        tr.appendChild(td_price);
        
        //تعداد کالا
        var td_number = document.createElement("td");
        
        var input_number = document.createElement("input");
        input_number.setAttribute("type", "number");
        input_number.setAttribute("min", "0");
        input_number.setAttribute("value", "0");
        input_number.setAttribute("name", "number" + cntr);
        input_number.setAttribute("class", "form-control");
        
        td_number.appendChild(input_number);
        tr.appendChild(td_number);
        
         //واحد اندازه گیری کالا
        var td_unit = document.createElement("td");
        
        var select = document.createElement("select");
        
        <?php foreach($units as $unit): ?>
        
        var option_<?php echo $unit['id']; ?> = document.createElement("option");
        option_<?php echo $unit['id']; ?>.setAttribute("value", "<?php echo $unit['id']; ?>");
        option_<?php echo $unit['id']; ?>.appendChild(document.createTextNode("<?php echo $unit['title']; ?>"));
        select.appendChild(option_<?php echo $unit['id']; ?>);
        
        <?php endforeach; ?>
        
        select.setAttribute("name", "unit" + cntr);
        select.setAttribute("class", "form-control");
        
        td_unit.appendChild(select);
        tr.appendChild(td_unit);
        
        
        //تصویر کالا
        var td_image = document.createElement("td");
        
        var input_image = document.createElement("input");
        input_image.setAttribute("type", "file");
        input_image.setAttribute("name", "image" + cntr);
        input_image.setAttribute("class", "form-control");
        
        td_image.appendChild(input_image);
        tr.appendChild(td_image);
        
        //توضیحات کالا
        var td_about = document.createElement("td");
        
        var textarea_about = document.createElement("textarea");
        textarea_about.setAttribute("name", "about" + cntr);
        textarea_about.setAttribute("class", "form-control");
        
        td_about.appendChild(textarea_about);
        tr.appendChild(td_about);
        
        //نام شرکت مبدا کالا
        var td_origin_company = document.createElement("td");
        
        var input_origin_company = document.createElement("input");
        input_origin_company.setAttribute("type", "text");
        input_origin_company.setAttribute("name", "origin_company" + cntr);
        input_origin_company.setAttribute("class", "form-control");
        
        td_origin_company.appendChild(input_origin_company);
        tr.appendChild(td_origin_company);
        
        //
        tbody.appendChild(tr);
        
        cntr++;
        document.getElementById("cntr").value = cntr;
    }
    
    function RemoveLastRow() 
    {
        var select = document.getElementById('list');
        select.removeChild(select.lastChild);
        
        if(cntr > 0)
        {
            cntr--;
            document.getElementById("cntr").value = cntr;
        }  
    }


    
</script>

<?php if(isset($_SESSION['is_logged_in'])): ?>

<form method="post" action="factor_add.php" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="add" class="btn btn-success btn-lg btn-block"> <span class="glyphicon glyphicon-copy"></span> ثبت تغییرات و صدور فاکتور رسید انبار </button>
            </div>
        </div>  
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> افزودن کالای جدید </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="AddNewRow()" type="button" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span> افزودن سطر</button>
                    </div>
                </div>  
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> نام </th>
                            <th> دسته بندی </th>
                            <th> قیمت </th>
                            <th> تعداد / مقدار </th>
                            <th> واحد </th>
                            <th> تصویر </th>
                            <th> توضیحات </th>
                            <th> شرکت مبدا </th>
                        </tr>
                    </thead>
                    <tbody id="list">

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="RemoveLastRow()" type="button" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-minus"></span> حذف سطر</button>
                    </div>
                </div>  
                
                <input type="hidden" name="number_of_new_kalas" id="cntr">
            </div>
        </div>
    </div>

    <div class="col-md-12">
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
                        <th> افزودن تعداد جدید </th>
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
                            <div class="form-group has-success">
                                <input type="number" value="0" min="0" name="<?php echo $kala['id']; ?>" class="form-control">
                            </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php else: ?>
                <p> چیزی برای نمایش موجود نیست </p>
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