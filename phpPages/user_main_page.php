<?php
	include 'db_connect.php';
	include 'login_security_functions.php'; 
	sec_session_start();
	if(login_check($mysqli) == true) {
		$user_id = $_SESSION['user_id'];
    $result = mysqli_query($mysqli, "SELECT * FROM image_location WHERE user_id= $user_id" );
    if(! $result) {
      die("SQL Error: " . mysqli_error($mysqli));
    }
    $pic_array = array();
    $pic_thumb_array = array();
    $latitude_array = array();
		$longitude_array = array();
    while ($row = mysqli_fetch_array($result)) {
      $pic = "../uploader/server/php/files/".$user_id."/".$row['image_name'];
      $pic_thumb = "../uploader/server/php/files/".$user_id."/thumbnail/".$row['image_name'];
      array_push($latitude_array,$row['latitude']);
			array_push($longitude_array,$row['longitude']);
      array_push($pic_array,$pic);
      array_push($pic_thumb_array,$pic_thumb);
    } 

    error_log($pic_array[0]);
    $array_size = sizeof($pic_array);
?>
<html>
	<header>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
			
				var markers = []; // This Array will retain markers over refresh 
																// will fetch markers from db
  			var input =(document.getElementById('target'));
  			var searchBox = new google.maps.places.SearchBox(input);
  			//var markers = [];

        var marker, i;
        var infowindowsarray = [];
        i = 0;
        <?php 
					for($i = 0; $i < $array_size;$i++) {
						?>
						marker =	createMarker(new google.maps.LatLng(<?php echo $latitude_array[$i]?>,<?php echo $longitude_array[$i] ?>),"<?php echo $i; ?>",map);
				<?php
          }
        ?>
			}//initiliaze function

			function createMarker(pos, t, map) {
    		var marker = new google.maps.Marker({       
      			position: pos, 
      			map: map,  // google.maps.Map 
      			index: t      
  			}); 
    		google.maps.event.addListener(marker, 'click', function() { 
					$('#imageModal').modal();
       		//alert("I am marker " + marker.index); 
    		}); 
    		return marker;  
			}

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
			<?php include'header.php' ?>
     	<div id="searchPlace" style="float:right">
				<input id="target" style= "height:30px;" type="text" placeholder="Search Your Place"/>
			</div>
      <div class="span12" id="googleMap" style="height:600px;margin-left: 0px;">
    	</div>
			<div class="modal fade" id="imageModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<input type="hidden" id="pic_id"/>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
					<div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
  					<div class="carousel-inner">
    					<div class="item active">
      					<img src="http://placehold.it/1200x480" alt="" />
      					<div class="carousel-caption">
        					<p>abc</p>
      					</div>
    					</div>
    					<div class="item">
      					<img src="http://placehold.it/1200x480" alt="" />
      					<div class="carousel-caption">
        					<p>c</p>
      					</div>
    					</div>
  					</div><!-- /.carousel-inner -->
  					<!--  Next and Previous controls below
        		href values must reference the id for this carousel -->
    				<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
    				<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
					</div> <!-- carousel -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
			<?php include 'footer.php' ?>
	</body>
</html>
<?php		
	} else {
		echo 'You are not authorized to access this page.';	
	}
?>
