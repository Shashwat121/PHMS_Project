<?php
session_start();
include('include/config.php');
$_SESSION['dlogin']=="";
date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE doctorslog  SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
session_unset();
//session_destroy();
//$_SESSION['errmsg']="You have successfully logout";
sleep(4);
?>
<script language="javascript">
document.location="/index.php";
</script>
