<?php
session_start();
include('include/config.php');
include('include/checklogin.php');

if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$dscrption=$_POST['description'];
$query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
echo "<script>alert('Your complaint is succesfully submitted');</script>";
echo "<script>window.location.href ='complaints.php'</script>";

}


?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>PHMS | Contact us</title>
		<link href="assets/css/style1.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<!--start-wrap-->
		
			<!--start-header-->
			<div class="header">
				<div class="wrap">
				<!--start-logo-->
				<div class="logo">
		 <p style="font-size: 30px;">PHMS Complaints Center</a> 
				</div>
				<!--end-logo-->
				<!--start-top-nav-->
				<div class="top-nav">
					<ul>
						<li><a href="dashboard.php">Back To Home</a></li>
					
						<!--<li class="active"><a href="contact.php">contact</a></li>-->
					</ul>					
				</div>
				<div class="clear"> </div>
				<!--end-top-nav-->
			</div>
			<!--end-header-->
		</div>
		    <div class="clear"> </div>
		   <div class="wrap">
		   	<div class="contact">
		   	<div class="section group">				
				<div class="col span_1_of_3">
					
      			<div class="company_address">
				     	<h2>Contact Details  :</h2>
						    	<p>PHMS services,</p>
						   		<p>Sector 29 Akurdi, Pune,</p>
						   		<p>Maharashtra, India</p>
				   		<p>Phone:02022987892, 02022953635</p>
				 	 	<br><p>Email us at: <br> <span>contactus@healthmonitoring101.in</span><br><span>patient-query@healthmonitoring101.in</span></p>
				   	    <br><br>
				   	    <p>Emergency Contacts: <br> <span>Ambulance: 102</span><br><span>patient-emergency@healthmonitoring101.in</span></p>
				   </div>
				</div>				

				<div class="col span_2_of_3">

				  <div class="contact-form">
				  	<center><h2>Complaints</h2></center>
					  
					    <br>
					    <form name="contactus" method="post">
					    		 <?php
                                 $sql=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                 $data=mysqli_fetch_array($sql);
                                //  echo "the session id is: ".$data['id'];
                                 ?>
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" name="fullname" required="true" value="<?php echo htmlentities($data['fullName']); ?>"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="email" name="emailid" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>"></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" name="mobileno" readonly="readonly" value="<?php echo htmlentities($data['contactno']);?>"></span>
						    </div>
						    <div>
						    	<span><label>Description</label></span>
						    	<span><textarea name="description" required="true"> </textarea></span>
						    </div>
						  
						   <div>
						   		<span><input type="submit" name="submit" value="Submit"></span>
						  </div>
					    </form>
				    </div>
				    
  				</div>	
  			
			  </div>
			  	 <div class="clear"> </div>
	</div>
	<div class="clear"> </div>
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

