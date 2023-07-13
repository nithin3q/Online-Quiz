<?php
session_start();
//set time limit for exam
$time_limit = 60*30; //30 minutes

//connect to database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "quiz_new";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//get questions from database
$sql = "SELECT * FROM mst_question ORDER BY RAND() LIMIT 10"; //select 10 random questions
$result = mysqli_query($conn, $sql);

//initialize score and question number
$score = 0;
$question_number = 1;

//start timer
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

//check if time limit has been reached
$elapsed_time = time() - $_SESSION['start_time'];
$remaining_time = $time_limit - $elapsed_time;
if ($remaining_time <= 0) {
    //time limit reached, end exam
    header("Location: end_exam.php");
    exit();
}

//display remaining time
echo "Time Remaining: " . gmdate("i:s", $remaining_time) . "<br>";

//display questions and options
echo "<form action='submit_exam.php' method='post'>";
while ($row = mysqli_fetch_assoc($result)) {
    $question = $row['que_desc'];
    $option1 = $row['ans1'];
    $option2 = $row['ans2'];
    $option3 = $row['ans3'];
    $option4 = $row['ans4'];
    $answer = $row['true_ans'];
    
    echo "<b>Question " . $question_number . ":</b> " . $question . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='1'>" . $option1 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='2'>" . $option2 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='3'>" . $option3 . "<br>";
    echo "<input type='radio' name='answer" . $question_number . "' value='4'>" . $option4 . "<br>";
    echo "<input type='hidden' name='correct_answer" . $question_number . "' value='" . $answer . "'>";
    
    $question_number++;
}

echo "<br><input type='submit' value='Submit Exam'></form>";

//submit exam and calculate score
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $answer = $_POST['answer' . $question_number];
        $correct_answer = $row['answer'];
        if ($answer == $correct_answer) {
            $score++;
        }
        $question_number++;
    }
    
    //insert score into database
    $username = $_SESSION['username'];
    $sql = "INSERT INTO scores (username, score) VALUES ('$username', '$score')";
    mysqli_query($conn, $sql);
    
    //end exam
    header("Location: end_exam.php");
    exit();
}

mysqli_close($conn);
?>