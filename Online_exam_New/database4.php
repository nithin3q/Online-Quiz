<?php
error_reporting(1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db_name = $_POST['db_name'];
   $db_host = 'localhost'; // Define the database host
  $db_user = 'root'; // Define the database username
  $db_pass = ''; // Define the database password
  
  // Create a new database connection
  $cn = mysql_connect($db_host, $db_user, $db_pass) or die("Could not Connect My Sql");
  mysql_select_db($db_name,$cn)  or die("Could connect to Database");

  // Store the database connection information in a file
  $data = "<?php\n";
  $data .= "\$db_host = '{$db_host}';\n";
  $data .= "\$db_user = '{$db_user}';\n";
  $data .= "\$db_pass = '{$db_pass}';\n";
  $data .= "\$db_name = '{$db_name}';\n";
  $data .= "\$cn = mysql_connect(\$db_host, \$db_user, \$db_pass) or die(\"Could not Connect My Sql\");\n";
  $data .= "mysql_select_db(\$db_name,\$cn)  or die(\"Could connect to Database\");\n";
  $data .= "?>";
  file_put_contents('database.php', $data);

  // Display a success message
  echo "<style>
          body {
            text-align: center;

          }
          a:hover{
            margin-bottom:250px;
            font-size: 40px;
            color:green;
          }
          div{
            margin-bottom:250px;
            font-size: 40px;

          }
          h2{
            margin-top:250px;
            font-size:50px

          }
          h1 {
            color: #9B1905;
            font-size:50px
          }
        </style>";
  echo "<p><h2>Database configuration saved successfully! to </h2><h1>$db_name</h1></p>";

  echo"<div><strong><a href=\"database2.php\">change database</a></strong></div>";
}
?>

