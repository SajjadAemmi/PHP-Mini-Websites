<?php 
    include 'functions.php';
    include 'database.php'; 
    
    $taxi_id = $_GET['taxi_id'];
    
    $query = "SELECT *
                FROM taxies
                WHERE id = $taxi_id";
	
    $taxi = mysqli_query($connection, $query);
    $taxi = mysqli_fetch_assoc($taxi);
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <a href="taxies_admin.php" class="btn btn-warning btn-lg btn-block">
            بازگشت <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> مکان تاکسی روی نقشه  </h3>
            </div>
						
            <div class="panel-body">	
                <div class="col-md-12">
                   <div id="map" style="width: 100%; height: 400px;"></div>
                    <script>
function myMap() {
  var myCenter = new google.maps.LatLng(<?php echo $taxi['location_lat']; ?>,<?php echo $taxi['location_lng']; ?>);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Pwg4JUkUz6bYv4Tx4eq-dRGLzUr-_zM&sensor=true&callback=myMap" 
          type="text/javascript"></script>
                </div>
            </div>		
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>