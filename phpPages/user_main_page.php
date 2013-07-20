<?php
	include 'db_connect.php';
	include 'login_security_functions.php'; 
	sec_session_start();
	if(login_check($mysqli) == true) {
		$user_id = $_SESSION['user_id'];
?>
<html>
	<header>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">	
		<link href="../bootstrap/css/tweaks.css" rel="stylesheet" type="text/css">
		<!--<script type="text/javascript" src="validate.js"></script>-->
		<script>
			//Enabling the visual refresh which is just a visual enhancement from google

			function initialize() {
  			var map = new google.maps.Map(document.getElementById('googleMap'), {
    			mapTypeId: google.maps.MapTypeId.ROADMAP,
   				center: new google.maps.LatLng(40.6986, 3.2949),   //latitude and longitude cordinates for spain
       	 	zoomControl: true,
					zoomControlOptions: {
      			style: google.maps.ZoomControlStyle.SMALL
    			},
					streetViewControl: false,
 					zoom: 2  // by this zoom level and lat and long cordinated world map fits my Div
  			});
			
				// var globalMarkers = fetchMarkersFromDb(<?php echo '$userid'; ?>);
				var globalMarkers = []; // This Array will retain markers over refresh 
																// will fetch markers from db
  			var input =(document.getElementById('target'));
  			var searchBox = new google.maps.places.SearchBox(input);
  			var markers = [];

				//This Event listner will mark all the places related to search on map
  			google.maps.event.addListener(searchBox, 'places_changed', function() {
    			var places = searchBox.getPlaces();

    			for (var i = 0, marker; marker = markers[i]; i++) {
      			marker.setMap(null);
    			}

    			markers = [];
    			var bounds = new google.maps.LatLngBounds();
    			for (var i = 0, place; place = places[i]; i++) {
      			var image = {
        			url: place.icon,
        			size: new google.maps.Size(71, 71),
        			origin: new google.maps.Point(0, 0),
        			anchor: new google.maps.Point(17, 34),
        			scaledSize: new google.maps.Size(25, 25)
      			};

      			var marker = new google.maps.Marker({
        			map: map,
        			icon: image,
        			title: place.name,
        			position: place.geometry.location
      			});

						google.maps.event.addListener(marker, "rightclick", function(event) {
							//use this event listner to right click on markers to upload pics and blogs
							alert("hello");
						});

      			markers.push(marker);
    			}//for loop
  			});//places_changes event listner


			}//initiliaze function

			//asyncronously loading google map
			function loadScript() {
  			var script = document.createElement('script');
  			script.type = 'text/javascript';
  			script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBqOSpe5NX2eude-qj1A0LMgyKs6-xWwys&' +
								 	   'v=3.exp&sensor=false&libraries=places&' +
      					     'callback=initialize';
  			document.body.appendChild(script);
			}	
			window.onload = loadScript;
    </script>
	</header>
	<body>
		<div class="container">
			<div class="navigation-bar">
				<h3 class="muted title-css">JourneyScrapbook</h3>
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<ul class="nav pull-left">
							<li><a href="#">Home</a></li>
							<li class="divider-vertical"> </li>
							<li><a href="#">Upload Images</a></li>
							<li class="divider-vertical"> </li>
							<li><a href="#">Travel Map</a></li>
							</ul>
							<form class="navbar-form pull-right" action="logout.php" method="post" name="login_form">
              					<input type="submit" class="btn" value="SignOut" />
            	</form>
						</div>
					</div>
				</div>
			</div>
     	<div id="searchPlace" style="float:right">
				<input id="target" style= "height:30px;" type="text" placeholder="Search Your Place"/>
			</div>
      <div class="span12" id="googleMap" style="height:600px;margin-left: 0px;">
    	</div>
		</div>
	</body>
</html>
<?php		
	} else {
		echo 'You are not authorized to access this page.';	
	}
?>
