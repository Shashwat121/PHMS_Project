<?php
$DB_host = "Server_Name";
$DB_user = "Server_UserName";
$DB_pass = "Server_Password";
$DB_name = "Database_Name";
try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 $e->getMessage();
}
?>
