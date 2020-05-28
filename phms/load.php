
<?php
 session_start();
 error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$pid = $_SESSION['pid']; 


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

    </tr>
<?php

       
       	 $query = mysqli_query($con,"select * from users where id='$pid'");
         $res = mysqli_fetch_array($query);
         $email = $res['email']; 
         $contactno = $res['contactno'];


?>
    <?php

          $result = mysqli_query($con,"SELECT * FROM temperature WHERE hid='$pid' ORDER BY id DESC");
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
                        $to_email = $email;
                        $subject = "Patient Health Monitoring alerts related to Temperature";
                        $body = "Temperature is greater than expected and it's value is $x degrees F. Please look into the Patient Health Monitoring System.Thank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                        
	                    //Account details
	                    $apiKey = urlencode('3QCwjRXkjkHo-ug7zl&ZAHZKQuKZZIIOJABSGA');

	                    //Message details
	                    $numbers = array($contactno);
	                    $sender = urlencode('TXTLCL');
	                    $message = rawurlencode("Temperature is greater than expected and it's value is $x degrees F. Please look into the Patient Health Monitoring System.Thank you");

	                    $numbers = implode(',', $numbers);

	                    //Prepare data for POST request
	                    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    //Send the POST request with cURL
                    	$ch = curl_init('https://api.textlocal.in/send/');
                    	curl_setopt($ch, CURLOPT_POST, true);
                    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    	$response = curl_exec($ch);
                    	curl_close($ch);
                

                 }
           		echo"<td style='border: 1px solid; text-align: center;' headers='bp'> " . $row['sys'] . "/" . $row['disys'] . "</td>";
           		$y = $row['sys'];
           		$z = $row['disys'];
           		if($y>120 and $z>90)
                {
                        ini_set('display_errors',1);
                        error_reporting( E_ALL );
                        $from = "patient-healthdata@healthmonitoring101.in";
                        $to_email = $email;
                        $subject = "Patient Health Monitoring alerts related to Blood Pressure";
                        $body = "Blood Pressure is greater than expected and it's value is $y/$z mmHg. Please look into the Patient Health Monitoring System.Thank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                        
                        //Account details
	                    $apiKey = urlencode('3QCwjRXkjkHo-ug7zl&ZAHZKQuKZZIIOJABSGA');

	                    //Message details
	                    $numbers = array($contactno);
	                    $sender = urlencode('TXTLCL');
	                    $message = rawurlencode("Blood Pressure is greater than expected and it's value is $y/$z mmHg. Please look into the Patient Health Monitoring System.Thank you");

	                    $numbers = implode(',', $numbers);

	                    //Prepare data for POST request
	                    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    //Send the POST request with cURL
                    	$ch = curl_init('https://api.textlocal.in/send/');
                    	curl_setopt($ch, CURLOPT_POST, true);
                    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    	$response = curl_exec($ch);
                    	curl_close($ch);
                    	echo $response;
                }
           	
           		echo"<td style='border: 1px solid; text-align: center;' headers='pulse'> " . $row['pulse'] . "</td>";
           		$p = $row['pulse'];
           		if($p>90)
                {
                        ini_set('display_errors',1);
                        error_reporting( E_ALL );
                        $from = "patient-healthdata@healthmonitoring101.in";
                        $to_email = $email;
                        $subject = "Patient Health Monitoring alerts related to Pulse";
                        $body = "Pulse rate is greater than expected and it's value is $p BPM. Please look into the Patient Health Monitoring System.Thank you";
                        $headers = "FROM: Patient Health Monitoring <patient-healthdata@healthmonitoring101.in>\r\n";
                        mail($to_email, $subject, $body,$headers,'-fpatient-healthdata@healthmonitoring101.in');
                       
                        //Account details
	                    $apiKey = urlencode('3QCwjRXkjkHo-ug7zl&ZAHZKQuKZZIIOJABSGA');

	                    //Message details
	                    $numbers = array($contactno);
	                    $sender = urlencode('TXTLCL');
	                    $message = rawurlencode("Pulse rate is greater than expected and it's value is $p BPM. Please look into the Patient Health Monitoring System.Thank you");

	                    $numbers = implode(',', $numbers);

	                    //Prepare data for POST request
	                    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

	                    //Send the POST request with cURL
                    	$ch = curl_init('https://api.textlocal.in/send/');
                    	curl_setopt($ch, CURLOPT_POST, true);
                    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    	$response = curl_exec($ch);
                    	curl_close($ch);
                    	echo $response;
                }

           		echo"</tr>";
    			
    

    			
    	  }


    	?>

    </table>
	</body>
</html>
