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
		<script src="../booklet/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="../booklet/jquery.booklet.1.1.0.min.js" type="text/javascript"></script>
		<link href="../booklet/jquery.booklet.1.1.0.css" type="text/css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="../css/booklet.css" type="text/css" media="screen"/>		
		<script src="../cufon/cufon-yui.js" type="text/javascript"></script>
		<script type="text/javascript" src="../javascript/mybooklet.js"></script> 
		<!--<script type="text/javascript" src="validate.js"></script>-->
	</header>
	<body>
			<?php include'header.php' ?>
			<div class="book_wrapper">
				<a id="next_page_button"></a>
				<a id="prev_page_button"></a>
				<div id="loading" class="loading">Loading pages...</div>
					<div id="mybook" style="display:none;">
						<div class="b-load">
							<div>
								<img src="../images/image_upload.png" alt=""/>
								<h1>Upload Images and Folders</h1>
								<p>Upload your pics and wait for the magic. Yes that is it. 
						   		   Just provide location where image is cicked and that is all we 
						   		   need to give make your travelling memories everlasting.</p>
						   		<br/><br/>
								<a href="http://tympanus.net/codrops/2010/10/07/slider-gallery/" target="_blank" class="article">Article</a>
								<a href="http://tympanus.net/Tutorials/SliderGallery/" target="_blank" class="demo">Demo</a>
							</div>
							<div>
								<img src="../images/map_pins.png" alt="" />
								<h1>View Your Travel Map</h1>
								<p>View whats the path your journey is taking. View the map to 
						   		   know the location you have travelled and what more you need to cover.</p>
								<br/><br/><br/>
								<a href="http://tympanus.net/codrops/2010/11/14/animated-portfolio-gallery/" target="_blank" class="article">Article</a>
								<a href="http://tympanus.net/Tutorials/AnimatedPortfolioGallery/" target="_blank" class="demo">Demo</a>
							</div>
							<div>
								<img src="../images/pin_pics.png" alt="" />
								<h1>Pin Images To Locations</h1>
								<p>We pin your images to your travel map. Just click on the location
						   		   pin and get your album for that location.</p>
								<br/><br/><br/>
								<a href="http://tympanus.net/codrops/2010/10/12/annotation-overlay-effect/" target="_blank" class="article">Article</a>
								<a href="http://tympanus.net/Tutorials/AnnotationOverlayEffect/" target="_blank" class="demo">Demo</a>
							</div>
						</div>
					</div>
				</div>
			<?php include 'footer.php' ?>
	</body>
</html>
<?php		
	} else {
		echo 'You are not authorized to access this page.';	
	}
?>
