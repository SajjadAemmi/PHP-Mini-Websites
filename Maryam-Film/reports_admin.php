<?php 
    include 'database.php';
    include 'functions.php';

    $query = "SELECT COUNT(rating.score) AS score_count, users.name
                FROM rating INNER JOIN users
                ON rating.user_id = users.id
                GROUP BY user_id";
              
    $reports = mysqli_query($connection, $query);

    include 'header.php';
?>    

<div class="row">
    <div class="col-md-12">
        <a href="panel_admin.php" class="btn btn-danger">
            بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"> گزارش گیری - تعداد فیلم های تماشا شده توسط هر کاربر </h3>
            </div>
            <div class="panel-body">
                <script type="text/javascript" src="js/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {packages: ['corechart', 'bar']});
                    google.charts.setOnLoadCallback(drawBasic);
                
                    function drawBasic() {

                      var data = google.visualization.arrayToDataTable([
                         ['user', 'number of films', { role: 'style' }],
                         
                        <?php foreach($reports as $report): ?>   
                           ['<?php echo $report['name']; ?>', <?php echo $report['score_count']; ?>, '#882200'], 
                         <?php endforeach; ?>
                      ]);

                      var options = {
                        
                        hAxis: {title: 'کاربران'},
                        vAxis: {title: 'تعداد فیلم ها'}
                      };

                      var chart1 = new google.visualization.ColumnChart(
                        document.getElementById('chart'));

                      chart1.draw(data, options);
                    
                    }
            </script>          
                <div class="row">
                    <div class="col-md-12">
                        <div id="chart"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
<?php include 'footer.php'; ?> 