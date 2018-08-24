<?php 
	include 'functions.php'; 
	include 'database.php';
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "taxi"): ?>

<?php include 'header.php'; ?>

<script type="text/javascript">
		
    function notify() 
    {	
        var option = {
            body: 'شما یک درخواست سرویس دارید!',
            icon: 'images/taxi.jpg',
        }

        var notify = new Notification('پیام جدید!', option);
        //alert(notify.title);

        setTimeout(function(){notify.close()}, 5000);

        notify.onshow = function(){
            console.log('Notification showing...');
        };

        notify.onclose = function(){
            console.log('Notification closed!');
        };

        notify.onerror = function(){
            console.log('Notification error!');
        };

        notify.onclick = function(){
            console.log('Notification Click!');
        };	
    }
		
    function showNotification()
    {
        if ( !("Notification" in window) ) 
        {
            console.error('Your browser does not support Notification');
            //alert('Your browser does not support Notification');
        } 
        else if ( Notification.permission === "granted" ) 
        {
            notify();
        } 
        else if ( Notification.permission !== "denied" ) 
        {
            Notification.requestPermission(function(permission){

                if ( permission === "granted" ) 
                {
                    notify();
                }
            });
        }
    }
    
    var map;
    var marker;
    
    function update_taxi_location()
    {
        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(function(position) 
            {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                var location = ['You', lat, lng, google.maps.Animation.BOUNCE];

                var dataString = 'lat='+ lat + '&lng=' + lng;

                $.ajax({
                    type:"POST",
                    url:"update_taxi_location_in_database.php",
                    data: dataString,
                    cache: false,
                    success: function(html){
                    }
                });

                var infowindow = new google.maps.InfoWindow();
                
                if (marker !== undefined)
                {
                    marker.setMap(null);
                }
                
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(location[1], location[2]),
                map: map,
                animation: location[3],
                icon: "taxi.png"

                });
                
                google.maps.event.addListener(marker, 'click', (function(marker) {
                
                return function() 
                {
                    infowindow.setContent(location[0]);
                    infowindow.open(map, marker);
                }
        })(marker));

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
    }
    
    setInterval(check_for_find_new_service, 5000);
    setInterval(update_taxi_location, 5000);
       
	navigator.geolocation.getCurrentPosition(function(position) 
	{
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;

		var location = ['You', lat, lng, google.maps.Animation.BOUNCE];

		map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: new google.maps.LatLng(lat, lng),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
		
	}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
    
    //بررسی درخواست سرویس جدید و نمایش مکان مسافر بر روی نقشه
    
    function check_for_find_new_service()
    {
        $.ajax({
                url: "get_new_service.php",
                success: function(data){

                    if(data != "NULL")
                    {
                        
                        var new_service = JSON.parse(data); 
                        document.getElementById('user_id').value = new_service['user_id'];
                        document.getElementById('phone_number').value = new_service['phone_number'];
                        document.getElementById('call').href = "tel:" + new_service['phone_number'];

                            var user_lat = new_service['begin_lat'];
                            var user_lng = new_service['begin_lng'];

                            var user_location = ['user', user_lat, user_lng, google.maps.Animation.BOUNCE];

                             var myCenter = new google.maps.LatLng(user_lat,user_lng);
							  var mapCanvas = document.getElementById("modalmap");
							  var mapOptions = {center: myCenter, zoom: 15};
							  var user_map = new google.maps.Map(mapCanvas, mapOptions);
							  var user_marker = new google.maps.Marker({position:myCenter});
							  user_marker.setMap(user_map);
                        
						
                        showNotification();
                        
						
						$('#myModal').on('shown.bs.modal', function () {
						  google.maps.event.trigger(user_map, 'resize');
						  user_map.setCenter(new google.maps.LatLng(user_lat,user_lng));
						});
						
						
						$('#myModal').modal('show');
						
						
                        var dataString = 'service_id=' + new_service['id'];
                        
                        $.ajax({
                                type:"POST",
                                url:"service_is_done.php",
                                data: dataString,
                                cache: false,
                                success: function(html){
                                   
                                }
                            });
                    }
            }
        });
    }
</script>

<div class="row">
    <div class="col-md-12">
       
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> درخواست سرویس </h4>
                    </div>
                    <div class="modal-body">
                
                        <div class="form-group">
                            <label>شماره اشتراک مسافر</label>
                            <input type="text" id="user_id" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>شماره تماس مسافر</label>
                            <input type="text" id="phone_number" class="form-control" readonly>
                        </div>
                        <p>مکان مسافر بر روی نقشه</p>
                        <div id="modalmap" style="width: 100%; height: 300px;"></div>
                        
                    </div>
                    <div class="modal-footer">
                        <a id="call" class="btn btn-success">با مسافر تماس بگیرید</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> مکان شما روی نقشه  </h3>
            </div>
						
            <div class="panel-body">	
                <div class="col-md-12">
                   <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>		
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>