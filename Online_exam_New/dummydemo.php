<?php

include("database.php");
include("header.php");

extract($_POST);

// Randomly select 10 questions from database
$rs=mysql_query("select * from mst_question where test_id=$tid ORDER BY RAND() LIMIT 5",$cn) or die(mysql_error());

// Display questions
$score = 0;
echo "<form method='post'>";
while ($row = mysql_fetch_assoc($rs)) {
  echo "<p>" . $row['question'] . "</p>";
  echo "<label><input type='radio' name='" . $row['id'] . "' value='1'>" . $row['option1'] . "</label><br>";
  echo "<label><input type='radio' name='" . $row['id'] . "' value='2'>" . $row['option2'] . "</label><br>";
  echo "<label><input type='radio' name='" . $row['id'] . "' value='3'>" . $row['option3'] . "</label><br>";
  echo "<label><input type='radio' name='" . $row['id'] . "' value='4'>" . $row['option4'] . "</label><br>";
  
  // Check answer
  if (isset($_POST[$row['id']])) {
    if ($_POST[$row['id']] == $row['answer']) {
      $score++;
    }
  }
}
echo "<input type='submit' value='Submit'>";
echo "</form>";

// Display score
echo "<p>Your score is " . $score . " out of 10.</p>";

// Close connection
mysqli_close($conn);
?>