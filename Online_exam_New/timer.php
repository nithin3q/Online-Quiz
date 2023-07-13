<?php

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_new";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get questions from database
$sql = "SELECT * FROM mst_question";
$result = $conn->query($sql);

// Set time limit for exam (in seconds)
$time_limit = 1800;

// Display questions to user
echo '<form id="exam-form">';
while($row = $result->fetch_assoc()) {
    echo '<p>' . $row['que_desc'] . '</p>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="a">' . $row['ans1'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="b">' . $row['ans2'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="c">' . $row['ans3'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="d">' . $row['ans4'] . '<br>';
}
echo '</form>';

// Display remaining time to user
echo '<div id="timer"></div>';
echo '<script>
var time_left = ' . $time_limit . ';

function countdown() {
    if (time_left == 0) {
        document.getElementById("exam-form").submit();
    } else {
        document.getElementById("timer").innerHTML = "Time remaining: " + time_left + " seconds";
        time_left--;
        setTimeout(countdown, 1000);
    }
}

countdown();
</script>';

// Close database connection
$conn->close();

?>
