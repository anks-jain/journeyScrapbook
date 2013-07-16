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
			<!--
			<div class="bookshelf" style="background-image: url('../images/final.jpg');  height: 800px; ">
				
			</div>
			-->
			<div class="bookshelf" style="text-align: center">
				<div class="book1" style="float: left">
				<img src="../images/pad.png" />
				</div >
				<div class="book1" style="width:100px; height: 100px; float: left;">
				</div>
				<div class="book1" style="float: left">
				<img src="../images/pad.png" />
				</div>
				<div class="book1" style="width:100px; height: 100px; float: left;">
				</div>
				<div class="book1" style="float: left">
				<img src="../images/pad.png" />
				</div>
				
			</div>
		</div>
	</body>
</html>
<?php		
	} else {
		echo 'You are not authorized to access this page.';	
	}
?>