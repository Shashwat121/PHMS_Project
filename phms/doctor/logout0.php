<?php

//logout.php

session_start();
$online_status = 0;
$chat_query = " UPDATE login_details SET online_staus='$online_status' WHERE user_id='".$_SESSION['user_id']."'";

header('location:dashboard.php');

?>
