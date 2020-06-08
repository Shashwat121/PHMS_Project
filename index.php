<?php
session_start();
error_reporting(0);
$cssVersion = rand();

include("phms/include/config.php");
$vari = 0;
$log=mysqli_query($con,"update userlog set log_state='$vari' where uid='$vari'");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient Health Monitoring System</title>
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
    <link href="css/style.css?v=<?php echo $cssVersion; ?>" rel="stylesheet" type="text/css"  media="all" />
		  <script>

			    $(function () {

			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 1600,
			        speed: 600
			      });
			});
		  </script>
	</head>
	<body>
		<!--start-wrap-->

			<!--start-header-->
			<div class="header">
				<div class="wrap">
				<!--start-logo-->
				<div class="logo">
					<a href="index.php" style="font-size: 28px;">Patient Health Monitoring System</a>
				</div>
				<!--end-logo-->
				<!--start-top-nav-->
				<div class="top-nav">
					<ul>
						<li class="active"><a href="index.php">Home</a></li>

						<li><a href="contact.php">Contact us</a></li>


					</ul>
				</div>
				<div class="clear"> </div>
				<!--end-top-nav-->
			</div>
			<!--end-header-->
		</div>
		<div class="clear"> </div>
			<!--start-image-slider---->
					<div class="image-slider">
						<!-- Slideshow 1 -->
					    <ul class="rslides" id="slider1">
					      <li><img src="images/slider-image1.jpg" alt=""></li>
					      <li><img src="images/slider-image2.jpg" alt=""></li>

					    </ul>
						 <!-- Slideshow 2 -->
					</div>
					<!--End-image-slider---->
		    <div class="clear"> </div>
		    <div class="content-grids">
		    	<div class="wrap">
		    	<div class="section group">


				<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="images/grid-img3.png">
					</div>
					<div class="text list_1_of_2">
						  <h3>Patients login</h3>

						  <div class="button"><span><a href="phms/user-login.php">Click Here</a></span></div>
				    </div>
				</div>

				<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="images/grid-img1.png">
					</div>
					<div class="text list_1_of_2">
						  <h3>Doctors login</h3>

						  <div class="button"><span><a href="phms/doctor/doctor-login.php">Click Here</a></span></div>
					</div>
				</div>


					<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="images/grid-img2.png">
					</div>
					<div class="text list_1_of_2">
						  <h3>Admin Login</h3>

						  <div class="button"><span><a href="phms/admin">Click Here</a></span></div>
				     </div>
				</div>
			</div>
		    </div>
		   </div>
		   <div class="wrap">
		   <div class="content-box">
		   <div class="section group">
				<div class="col_1_of_3 span_1_of_3 frist">

				</div>
				<div class="col_1_of_3 span_1_of_3 second">

				</div>

        <div class="col_1_of_3 span_1_of_3 second">

        </div>

			</div>
		   </div>
		   </div>
		   <div class="clear"> </div>

		   <div class="footer">
		   	 <div class="wrap">

		   <p style="padding-left:320px;">
	       &copy; <span>2020</span><span class="text-bold text-uppercase"> Patient Health Monitoring System (PHMS)</span>. <span>All rights reserved.</span>

		   </p>

		   	<div class="clear"> </div>
		   </div>
		   </div>
		<!--end-wrap-->
	</body>
</html>
