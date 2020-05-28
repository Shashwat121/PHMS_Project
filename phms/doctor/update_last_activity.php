<?php

//update_last_activity.php

include('database_connection.php');

session_start();
$date = date('Y-m-d H:i:s');
$query = "
UPDATE login_details 
SET last_activity ='$date' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>

