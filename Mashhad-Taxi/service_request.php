<?php 
    include 'functions.php'; 
    include 'database.php'; 
	
    $query = "SELECT * FROM cars";
	$cars = mysqli_query($connection, $query);
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "user"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
		<div id="besco"> </div>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> درخواست سرویس  </h3>
            </div>
						
            <div class="panel-body">
			<div class="row">	
                <div class="col-md-12">
                   <div id="map" style="width: 100%; height: 400px;"></div>
									
				  	<script type="text/javascript">

                    var map;

					if (navigator.geolocation) 
					{
						navigator.geolocation.getCurrentPosition(function(position) 
						{	
							var lat = position.coords.latitude;
							var lng = position.coords.longitude;
                            
                            document.getElementById('begin_lat').value = lat;
                            document.getElementById('begin_lng').value = lng;
                            
            				var location = ['You', lat, lng, google.maps.Animation.BOUNCE];
		
                            map = new google.maps.Map(document.getElementById('map'), 
                            {
                                zoom: 14,
                                center: new google.maps.LatLng(lat, lng),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });

                            var infowindow = new google.maps.InfoWindow();

                            var marker = new google.maps.Marker(
                            {
                                position: new google.maps.LatLng(location[1], location[2]),
                                map: map,
                                animation: location[3]
                            });
                            
                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                    infowindow.setContent(location[0]);
                                    infowindow.open(map, marker);
                                }
                            })(marker));
                            
                            marker2 = new google.maps.Marker(
                            {
                                map:map,
                                draggable:true,
                                animation: google.maps.Animation.DROP,
                                position: new google.maps.LatLng(location[1], location[2])
                            });

                            google.maps.event.addListener(marker2, 'click', (function(marker, i) {
                                return function() {
                                    infowindow.setContent(location[0]);
                                    infowindow.open(map, marker2);
                                }
                            })(marker2));

					}, function() 
						{
							handleLocationError(true, infoWindow, map.getCenter());
						});
					}
					else 
					{
						// Browser doesn't support Geolocation
						handleLocationError(false, infoWindow, map.getCenter());
					}
                    
                    function getDestination() {
                        var destination_location = marker2.getPosition();
                        
                        var latitude = destination_location.lat();
                        var longitude = destination_location.lng();

                        document.getElementById('destination_lat').value = latitude;
                        document.getElementById('destination_lng').value = longitude;
                    }
				  </script>
                </div>
                </div>
				<hr>
				<div class="row">	
                <div class="col-md-12">
                <button onclick="getDestination()"  class="btn btn-warning btn-lg btn-block"><i class="fa fa-map-marker"></i> ثبت مقصد</button>
				</div>
				</div>
                <hr>
                <div class="row">	
                <div class="col-md-12">
                <form role="form" method="post" action="service_submit.php">
                     <div class="form-group">
                        <label>نوع اتومبیل</label>
                         <select class="form-control" name="car" required>
                             
                             <option value="0"> همه </option>
                             
                             <?php foreach($cars as $car): ?>
                                <option value="<?php echo $car['id']; ?>"><?php echo $car['title']; ?></option>
                             <?php endforeach; ?>
                        </select>
                      </div>
                      <input type="hidden" id="begin_lat" name="begin_lat">
                      <input type="hidden" id="begin_lng" name="begin_lng">
                    
                      <input type="hidden" id="destination_lat" name="destination_lat">
                      <input type="hidden" id="destination_lng" name="destination_lng">
                     	  
                      <button type="submit" name="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check-circle"></i> ثبت سرویس </button>
                    </form>		
       			 </div>
       			 </div>
            </div>		
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>