<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_new";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set time limit for exam (in seconds)
$time_limit = 1200; // 20 minutes * 60 seconds

// Retrieve questions from the database
$sql = "SELECT * FROM mst_question ORDER BY RAND() LIMIT 10"; // Change 10 to the number of questions you want to display
$result = $conn->query($sql);

// Display the questions to the user
echo '<form id="exam-form">';
while ($row = $result->fetch_assoc()) {
    echo '<p>' . $row['question'] . '</p>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="a">' . $row['ans1'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="b">' . $row['ans2'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="c">' . $row['ans3'] . '<br>';
    echo '<input type="radio" name="answer[' . $row['id'] . ']" value="d">' . $row['ans4'] . '<br>';
}
echo '</form>';

// Display the remaining time to the user
echo '<div id="timer"></div>';
echo '<script>
var time_left = ' . $time_limit . ';

function countdown() {
    if (time_left == 0) {
        document.getElementById("exam-form").submit();
    } else {
        var minutes = Math.floor(time_left / 60);
        var seconds = time_left % 60;
        var time_str = "Time remaining: " + minutes + "m " + seconds + "s";
        document.getElementById("timer").innerHTML = time_str;
        time_left--;
        setTimeout(countdown, 1000);
    }
}

countdown();
</script>';

// Close the database connection
$conn->close();
?>
