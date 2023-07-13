<?php
error_reporting(1);

?>
<head>
  <style>
     body {
            text-align: center;

          }
  .btn ,label{
    font-size: 36px; /* adjust the font size as needed */
     /* align text to the middle */
    margin-top: 50px;
    color: #0066cc;
  }
  select{
    font-size: 36px; /* adjust the font size as needed */
     /* align text to the middle */
    margin-top: 250px;
    color: #190737;
  }
  input[type="submit"].btn:hover {
  color:red;
}
</style>
</head>

<form action="database4.php" method="post">
  
  <label for="db_name">Database Name:</label>
  <select name="db_name" id="db_name">
    <?php
      // Connect to the MySQL server
      $cn = mysql_connect("localhost", "root", "") or die("Could not connect to MySQL");

      // Get the list of databases from PHPMyAdmin
      $res = mysql_query("SHOW DATABASES", $cn);

      // Loop through the list of databases and display them in the select tag
      while ($row = mysql_fetch_assoc($res)) {
        $database_name = $row['Database'];
        echo "<option value='$database_name'>$database_name</option>";
      }

      // Close the MySQL connection
      mysql_close($cn);
    ?>
  </select><br>

  <input type="submit" class="btn" value="Save Changes">
</form>


