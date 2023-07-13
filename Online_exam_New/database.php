<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'quiz_new';
$cn = mysql_connect($db_host, $db_user, $db_pass) or die("Could not Connect My Sql");
mysql_select_db($db_name,$cn)  or die("Could connect to Database");
?>