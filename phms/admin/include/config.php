<?php
define('DB_SERVER','Server_Name');
define('DB_USER','Server_UserName');
define('DB_PASS' ,'Server_Password');
define('DB_NAME', 'Database_Name');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
