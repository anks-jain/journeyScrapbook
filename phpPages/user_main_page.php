<?php
	include 'db_connect.php';
	include 'login_security_functions.php'; 
	sec_session_start();
	if(login_check($mysqli) == true) {
?>
<html>
	<header>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">	
		<link href="../bootstrap/css/tweaks.css" rel="stylesheet" type="text/css">
<!--    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBqOSpe5NX2eude-qj1A0LMgyKs6-xWwys&sensor=false"></script>-->
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
		<!--<script type="text/javascript" src="validate.js"></script>-->
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
<script>
function initialize() {
  var map = new google.maps.Map(document.getElementById('googleMap'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);

  var input = /** @type {HTMLInputElement} */(document.getElementById('target'));
  var searchBox = new google.maps.places.SearchBox(input);
  var markers = [];

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

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
     		<div class="span12" id="searchPlace" style="height:60px;margin-left: 0px;">
					<input id="target" type="text" placeholder="Search Box"/>
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
