<?php 
    include 'functions.php'; 
    include 'database.php'; 
?>
<script type="text/javascript">

if (navigator.geolocation) 
{
    navigator.geolocation.getCurrentPosition(function(position) 
    {	
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var locations = [['You', lat, lng, google.maps.Animation.BOUNCE,'']];

        $.ajax({
            url: "get_taxies_location.php",
            success: function(data){

            var mydata = JSON.parse(data);

            for (i = 0; i < mydata.length; i++) 
            {  
                locations.push([mydata[i]['name'], mydata[i]['location_lat'] , mydata[i]['location_lng'] , google.maps.Animation.NONE, "taxi.png"]);
            }

            var map = new google.maps.Map(document.getElementById('map'), 
            {
                zoom: 14,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var dataString = 'lat='+ lat + '&lng=' + lng;

            $.ajax({
                type:"POST",
                url:"update_user_location_in_database.php",
                data: dataString,
                cache: false,
                success: function(html){
                    $('#besco').prepend(html);
                }
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) 
            {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    animation: locations[i][3],
                    icon: locations[i][4]

                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }

    }
});

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

</script>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "user"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
		<div id="besco"> </div>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> مکان شما روی نقشه  </h3>
            </div>
						
            <div class="panel-body">
			<div class="row">	
                <div class="col-md-12">
                   <div id="map" style="width: 100%; height: 400px;"></div>
									
                </div>
                </div>
				<hr>
				<div class="row">	
                <div class="col-md-12">
                      <a href="service_request.php" class="btn btn-success btn-lg btn-block"><i class="fa fa-taxi"></i> درخواست سرویس </a>
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