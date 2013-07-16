<html>
	<header>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">	
		<link href="bootstrap/css/tweaks.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="javascript/form.js" ></script>
		<script type="text/javascript" src="javascript/sha512.js"></script>
		<script src="booklet/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="booklet/jquery.booklet.1.1.0.min.js" type="text/javascript"></script>
		<link href="booklet/jquery.booklet.1.1.0.css" type="text/css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="css/booklet.css" type="text/css" media="screen"/>		
		<script type="text/javascript" src="javascript/mybooklet.js"></script> 
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
							<li><a href="#">Contact</a></li>
							</ul>
							<form class="navbar-form pull-right" action="phpPages/login.php" method="post" name="login_form">
              				<input class="span2" name="email" type="text" style="height: 30px;" placeholder="Email">
              				<input class="span2" name="password" type="password" style="height: 30px;" placeholder="Password">
              				<input type="button" class="btn" value="SignIn" onclick="formhash(this.form, this.form.password)";/>
            				</form>
						</div>
					</div>
				</div>
			</div>
		<?php if(isset($_GET["logout"]) && $_GET["logout"] == true) { ?>
			<div class="alert alert-success alert-logout" style="display: block;">
				<strong>Success!</strong> Logged Out! Login again to continue your journey.
			</div>
			<script>
				window.setTimeout(function() {
    				$(".alert-logout").fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    				});	
				}, 3000);
			</script>
		<?php } ?>
		<?php if(isset($_GET["error"]) && $_GET["error"] == true) { ?>
			<div class="alert alert-error alert-login" style="display: block;">
				<strong>Error!</strong> Invalid login. Please try again!
			</div>
			<script>
				window.setTimeout(function() {
    				$(".alert-login").fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    				});	
				}, 3000);
			</script>
		<?php } ?>
		<?php if(isset($_GET["success"]) && $_GET["success"] == true) { ?>
			<div class="alert alert-success alert-message" id="alert_template" style="display: block;">
				<strong>Success!</strong> Your account has been registered. Please login!
			</div>
			<script>
				window.setTimeout(function() {
    				$(".alert-message").fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    				});	
				}, 3000);
			</script>
		<?php } ?>
		
			<div class="content-big">
				<h1>Journey Never Ends..</h1>
				<img src="images/logo.png" class="img-rounded"/>
				<p>Travelling makes a man complete. It lets you meet new people and build your personality. We cherish your memories as much as you do. So let's walk down the memory lane together.</p>
				<a href="#registration_modal"  class="btn btn-large btn-success" data-toggle="modal">Sign Up</a>
			</div>
			
			<div style="display:none" class="modal fade" id="registration_modal">
  				<div class="modal-header content-heading">
    				<h3>Sign Up </h3>
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" name="loginHere" id="loginHere" method="post" action="phpPages/registration.php">
  							<span class="label" style="width: 100px;">Name:</span>
							<input class="span5" type="text" id="username" name="username" />
							<br/><br/>
							<span class="label" style="width: 100px;">Email:</span>
							<input class="span5" type="text" id="email" name="email" />
							<br/><br/>
							<span class="label" style="width: 100px;">Password:</span>
							<input class="span5" type="password" id="password" name="password" />
							<br/><br/>
							<div class="modal-footer">
    							<a href="#" class="btn" data-dismiss="modal">Close</a>
    							<input type="button" class="btn btn-success" value="Continue" onclick="formhash(this.form, this.form.password)";/>
  							</div>
  					</form>
  				</div>
			</div>
			
			<div class="book_wrapper">
				<a id="next_page_button"></a>
				<a id="prev_page_button"></a>
				<div id="loading" class="loading">Loading pages...</div>
					<div id="mybook" style="display:none;">
						<div class="b-load">
							<div>
								<img src="images/image_upload.png" alt=""/>
								<h1>Upload Images and Folders</h1>
								<p>Upload your pics and wait for the magic. Yes that is it. 
						   		   Just provide location where image is cicked and that is all we 
						   		   need to give make your travelling memories everlasting.</p>
						   		<br/><br/>
								<a href="http://tympanus.net/codrops/2010/10/07/slider-gallery/" target="_blank" class="article">Article</a>
								<a href="http://tympanus.net/Tutorials/SliderGallery/" target="_blank" class="demo">Demo</a>
							</div>
							<div>
								<img src="images/map_pins.png" alt="" />
								<h1>View Your Travel Map</h1>
								<p>View whats the path your journey is taking. View the map to 
						   		   know the location you have travelled and what more you need to cover.</p>
								<br/><br/><br/>
								<a href="http://tympanus.net/codrops/2010/11/14/animated-portfolio-gallery/" target="_blank" class="article">Article</a>
								<a href="http://tympanus.net/Tutorials/AnimatedPortfolioGallery/" target="_blank" class="demo">Demo</a>
							</div>
							<div>
								<img src="images/pin_pics.png" alt="" />
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
		</div>		
	</body>
</html>
