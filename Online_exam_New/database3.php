<?php
$db_host = $_POST['db_host'];
$db_name = $_POST['db_name'];
$db_user = $_POST['db_user'];
$db_pass = $_POST['db_pass'];

// Create a new database connection
$cn = mysql_connect($db_host, $db_user, $db_pass) or die("Could not Connect My Sql");
mysql_select_db($db_name,$cn)  or die("Could connect to Database");

// Store the database connection information in a session variable
session_start();
$_SESSION['db_host'] = $db_host;
$_SESSION['db_name'] = $db_name;
$_SESSION['db_user'] = $db_user;
$_SESSION['db_pass'] = $db_pass;

// Redirect to a page that will use the new database connection
header("Location: index.php");
exit;
?>