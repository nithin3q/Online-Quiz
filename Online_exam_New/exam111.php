<?php
// Connect to the database

$cn=mysql_connect("localhost","root","") or die("Could not Connect My Sql");
mysql_select_db("quiz_new",$cn)  or die("Could connect to Database");


// Retrieve 20 random questions from the database
$rs=mysql_query("select * from mst_question ",$cn) or die(mysql_error());

// Initialize variables
$question_number = 1;
$score = 0;

// Display each question and its choices
while ($row = mysql_fetch_assoc($rs)) {
    $question = $row['que_desc'];
    $choice1 = $row['ans1'];
    $choice2 = $row['ans2'];
    $choice3 = $row['ans3'];
    $choice4 = $row['ans4'];
    $answer = $row['true_ans'];

    echo "<p><strong>Question " . $question_number . ":</strong> " . $question . "</p>";
    echo "<input type='radio' name='answer" . $question_number . "' value='1'>" . $choice1 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='2'>" . $choice2 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='3'>" . $choice3 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='4'>" . $choice4 . "<br>";

    // Check the answer
    
$question_number++;
    
}

// Display the score
echo "<br><p>Your score: " . $score . " out of 20</p>";

// Close the database connection
mysql_close($cn);
?>
