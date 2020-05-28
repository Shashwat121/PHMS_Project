
<?php
 session_start();
 error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$docid = $_SESSION['did'];
$vid=$_SESSION['viewid'];

//$pid = $_SESSION['pid']; //user's id which gets registred during registration and the same is fetched from the users table where this session varibale points to the id of the users
//$record = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Users | Patient Health Monitoring</title>

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

	</head>

  <body>

    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-spacing: 0; border: 1px solid;width: 100%;">
      <tr align="center">
       <th style="border: 1px solid;font-size:17px; text-align:center;" colspan="8" >Patient Health Monitoring Report</th>
      </tr>
      <tr>

    <th style='border: 1px solid; text-align: center;' id='time'>Time</th>
    <th style='border: 1px solid; text-align: center;' id='temperature'>Temperature (&degF)</th>
    <th style='border: 1px solid; text-align: center;' id='bp'>Blood Pressure (mmHg)</th>
    <th style='border: 1px solid; text-align: center;' id='pulse'>Pulse rate (bpm)</th>
    <!--<th style='border: 1px solid; text-align: center;' id='boxy'>Blood Oxygen Level (%)</th>-->
    <!--<th id="hello" style='border: 1px solid; text-align: center;' id='ecg'>ECG</th>-->
    </tr>


    <?php

           
            
     
            $sql = mysqli_query($con,"select * from users where id='$vid'");
            $resu = mysqli_fetch_array($sql);
            $name = $resu['fullName'];
            $patiname = $name;
           
            
            //doctor email and contactno query
            $query = mysqli_query($con,"select * from doctors where id='$docid'");
            $res = mysqli_fetch_array($query);
            $docemail = $res['docEmail']; //sending mail
            $contactno = $res['contactno'];



     ?>


    <?php

                    
               $result = mysqli_query($con,"SELECT * FROM temperature WHERE hid='$vid' ORDER BY id DESC");
               while($row = mysqli_fetch_array($result))
    		  {
    		   echo"<tr> ";
           	   echo"<td style='border: 1px solid; text-align: center;' headers='time'> " . $row['time']."</td>";
         
           		echo"<td style='border: 1px solid; text-align: center;' headers='temperature'> " . $row['temp'] . "</td>";
           		$x = $row['temp'];
           		if ($x>98)
                 {
                        ini_set('display_errors',1);
                        error_reporting( E_ALL );
                        $from = "patient-healthdata@healthmonitoring101.in";
                        $to_email = $docemail;
                        $subject = "Patient Health Monitoring alerts related to Temperature";
                        $body = "$patiname's temperature is greater than expected and it's value is $x degrees F. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.\nThank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                        
	                    // Account details
	                   // $apiKey = urlencode('2CwjRXkjkHo-ug7zlRtZKQuKZZy0AUHb8Agc129TIw');

	                    // Message details
	                   // $numbers = array($contactno);
	                   // $sender = urlencode('TXTLCL');
	                   // $message = rawurlencode("$patiname's temperature is greater than expected and it's value is $x degrees F. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.Thank you");

	                   // $numbers = implode(',', $numbers);

	                    // Prepare data for POST request
	                   // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    // Send the POST request with cURL
                    // 	$ch = curl_init('https://api.textlocal.in/send/');
                    // 	curl_setopt($ch, CURLOPT_POST, true);
                    // 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    // 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // 	$response = curl_exec($ch);
                    // 	curl_close($ch);
                    	//echo $response;
                
                 }
           	
           		echo"<td style='border: 1px solid; text-align: center;' headers='bp'> " . $row['sys'] . "/" . $row['disys'] . "</td>";
           		$y = $row['sys'];
           		$z = $row['disys'];
           		if($y>120 and $z>90)
                {
                        ini_set('display_errors',1);
                        error_reporting( E_ALL );
                        $from = "patient-healthdata@healthmonitoring101.in";
                        $to_email = $docemail;
                        $subject = "Patient Health Monitoring alerts related to Blood Pressure";
                        $body = "$patiname's Blood Pressure is greater than expected and it's value is $y/$z mmHg. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.Thank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                        
                        // Account details
	                   // $apiKey = urlencode('2CwjRXkjkHo-ug7zlRtZKQuKZZy0AUHb8Agc129TIw');

	                    // Message details
	                   // $numbers = array($contactno);
	                   // $sender = urlencode('TXTLCL');
	                   // $message = rawurlencode("$patiname's Blood Pressure is greater than expected and it's value is $y/$z mmHg. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.Thank you");

	                   // $numbers = implode(',', $numbers);

	                    // Prepare data for POST request
	                   // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    // Send the POST request with cURL
                    // 	$ch = curl_init('https://api.textlocal.in/send/');
                    // 	curl_setopt($ch, CURLOPT_POST, true);
                    // 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    // 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // 	$response = curl_exec($ch);
                    // 	curl_close($ch);
                    	//echo $response;
                }
           		
           		
           		echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['pulse'] . "</td>";
           		$p = $row['pulse'];
           		if($p>90)
                {
                        ini_set('display_errors',1);
                        error_reporting( E_ALL );
                        $from = "patient-healthdata@healthmonitoring101.in";
                        $to_email = $docemail;
                        $subject = "Patient Health Monitoring alerts related to Pulse";
                        $body = "$patiname's Pulse rate is greater than expected and it's value is $p BPM. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.Thank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                        // Account details
	                   // $apiKey = urlencode('2CwjRXkjkHo-ug7zlRtZKQuKZZy0AUHb8Agc129TIw');

	                    // Message details
	                   // $numbers = array($contactno);
	                   // $sender = urlencode('TXTLCL');
	                   // $message = rawurlencode("$patiname's Pulse rate is greater than expected and it's value is $p BPM. Please look into the Patient Health Monitoring System and monitor the patient at the earliest.Thank you");

	                   // $numbers = implode(',', $numbers);

	                    // Prepare data for POST request
	                   // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    // Send the POST request with cURL
                    // 	$ch = curl_init('https://api.textlocal.in/send/');
                    // 	curl_setopt($ch, CURLOPT_POST, true);
                    // 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    // 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // 	$response = curl_exec($ch);
                    // 	curl_close($ch);
                    	//echo $response;
                }

           	// 	echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['boxyg'] . "</td>";
           	// 	echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['ecg'] . "</td>";
           		echo"</tr>";
    			

           		
              $sql = mysqli_query($con,"select * from users where id='$vid'");
              $res = mysqli_fetch_array($sql);

              $mailid = $res['email'];
              $id = $row['id'];
              $hid = $row['hid'];
              $date = $row['date'];
              $time = $row['time'];
              $temp  = $row['temp'];
              $sys = $row['sys'];
              $disys  = $row['disys'];
              $pulse = $row['pulse'];
              $boxy = $row['boxyg'];
              $ecg = $row['ecg'];

              mysqli_query($con,"insert into hr_doctor(id,hid,date,time,temp,sys,disys,pulse,boxyg,ecg,mailid) values('$id','$hid','$date','$time','$temp','$sys','$disys','$pulse','$boxy','$ecg','$mailid')");
    	
    		      
    	  }

    	?>

    </table>
	</body>
</html>
