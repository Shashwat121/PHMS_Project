<!-- freah copy as of 23rd april has to be uploaded on godaddy -->
<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Users | Patient Previous Report</title>

		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

		<style>
	         td
	           {
	           border: 1px solid;
	           text-align: center;
	           }

	    </style>
	</head>
	<body>
		<div id="app">
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">User | Previous Health Record</h1>
</div>
<ol class="breadcrumb">
<li>
<span>User</span>
</li>
<li class="active">
<span>Previous Health Record</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">


<p align="center" style="color: blue;"><b>Download your Report as PDF </b> </p>

<div id="exampl">
<p align="center"> <i class="fa fa-print fa-2x" style="cursor: pointer;color:rgb(232, 39, 39)"  OnClick="CallPrint(this.value)" ></i></p>




<!-- the user's details will be directly fetched from the database without initiating any session howsoever -->
<!-- Run a query to get data from the database for the user's details -->
<?php
$email_id = $_GET['viewid'];
$sql = mysqli_query($con,"select * from users where email='$email_id'");

while($row=mysqli_fetch_array($sql))
{
?>

<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Patient Details</td></tr>

    <tr>
    <th scope>Patient Name</th>
    <td><?php  echo $row['fullName'];?></td>

    <th scope>Patient Email</th>
    <td><?php  echo $row['email'];?></td>
  </tr>

  <tr>
    <th scope>Patient Mobile Number</th>
    <td><?php  echo $row['contactno'];?></td>
    <th>Patient Address</th>
    <td><?php  echo $row['address'];?></td>
  </tr>

    <tr>
    <th>Patient Gender</th>
    <td><?php  echo $row['gender'];?></td>
    <th>Patient Age</th>
    <td><?php  echo $row['age'];?></td>
  </tr>

     <tr>

       <th>Patient Medical History(if any)</th>
       <td><?php  echo $row['medhist']?></td>
       <th>Patient Reg Date and time</th>
       <td><?php  echo $row['regDate'];?></td>

    </tr>
  <?php } ?>


</table>


<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-spacing: 0; border: 1px solid;width: 100%;">
  <tr align="center">
   <th style="border: 1px solid;font-size:17px; text-align:center;" colspan="8" >Patient Health Monitoring Report</th>
  </tr>
  <tr>

<th style='border: 1px solid; text-align: center;' id='date'>Date</th>
<th style='border: 1px solid; text-align: center;' id='time'>Time</th>
<th style='border: 1px solid; text-align: center;' id='temperature'>Temperature (&degF)</th>
<th style='border: 1px solid; text-align: center;' id='bp'>Blood Pressure (mmHg)</th>
<th style='border: 1px solid; text-align: center;' id='pulse'>Pulse rate (bpm)</th>
<!--<th style='border: 1px solid; text-align: center;' id='boxy'>Blood Oxygen Level (%)</th>-->
<!--<th style='border: 1px solid; text-align: center;' id='ecg'>ECG</th>-->
</tr>


<?php

$email_id = $_GET['viewid'];
$result = mysqli_query($con,"select * from hr_doctor where mailid='$email_id'");
//echo "<p>view id is=".$email_id."</p>";

?>




<?php

      $count = 0;
      while($row = mysqli_fetch_array($result))
      {
            echo"<tr> ";
            echo"<td style='border: 1px solid; text-align: center;' headers='time'> " . $row['date']."</td>";
            echo"<td style='border: 1px solid; text-align: center;' headers='time'> " . $row['time']."</td>";
            echo"<td style='border: 1px solid; text-align: center;' headers='temperature'> " . $row['temp'] . "</td>";
            echo"<td style='border: 1px solid; text-align: center;' headers='bp'> " . $row['sys'] . "/" . $row['disys'] . "</td>";
            // echo"<td headers='disys'> " .  . "</td>";
            echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['pulse'] . "</td>";
            // echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['boxyg'] . "</td>";
            // echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['ecg'] . "</td>";
            echo"</tr>";
            $count = $count + 1;
      }

?>
</table>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>

			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->



	<script>
	function CallPrint(strid)
	{
	var prtContent = document.getElementById("exampl");
	var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	//WinPrint.close();
	}
	</script>
	</body>
</html>
