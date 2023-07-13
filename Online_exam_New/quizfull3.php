<?php
session_start();
error_reporting(1);
include("database.php");


extract($_POST);
extract($_GET);
extract($_SESSION);
$num_questionss=20;
$time_limit = 50;

$result = mysql_query("SELECT * FROM mst_result WHERE login = '$login' AND test_id = '$tid'");
if(mysql_num_rows($result) > 0){
    echo '<script>alert("you have already submitted")</script>';
          echo "<script>location.href='signout.php';</script>";
    exit;
}

if(isset($subid) && isset($testid))
{
$_SESSION[sid]=$subid;
$_SESSION[tid]=$testid;
header("location:quizfull3.php");
}
if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
{
	header("location: index.php");
}

if(!isset($_SESSION[qn]))
{
	$_SESSION[qn]=0;
	mysql_query("delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysql_error());
	$_SESSION[trueans]=0;	
}


if($submit=='Get Result' or isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0')
{
	$rs = mysql_query("select * from mst_question where test_id=$tid ORDER BY RAND()", $cn) or die(mysql_error());
	$num_questions = mysql_num_rows($rs);
	
	$total_score = 0;
	for ($i = 0; $i < $num_questions; $i++) {
		mysql_data_seek($rs, $i);
		$row = mysql_fetch_row($rs);
		
		if(isset(${"ans".$i})) {
			if(${"ans".$i} == ${"trueans".$i}) {
				$total_score++;
			}
			mysql_query("insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."',$tid,'$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]',".${"ans".$i}.")") or die(mysql_error());
		}
	}
	echo'<img border="0" src="111.png" width="100%" height="120" >';
    echo "<div align=\"right\"><strong><a href=\"index.php\"> Home </a>|<a href=\"signout.php\">Signout</a></strong></div>";
	echo "<h1 style='color:purple;text-align:center;text-decoration: overline;'> Result</h1>";
	
    echo "<h1 style='color:#142E4B;text-align:center;'> Your score is <span style='color:green;'>$total_score</span>  out of 20</h1>";

    echo'<h1 style="color:#8CECFC;text-align:center;"><a href= "signout.php" style="display: inline-block;
  padding: 15px 25px;
  background-color: #27D0B9;
  color: #143601;
  text-decoration: none;
  border-radius: 5px;
  font-size: 25px;
  font-weight: bold;" onmouseover="this.style.backgroundColor=\'#056457\'" onmouseout="this.style.backgroundColor=\'#27D0B9\'">SIGNOUT</a></h1>';
	mysql_query("insert into mst_result(login,test_id,score) values('$login',$tid,$total_score)") or die(mysql_error());
	unset($_SESSION[qn]);
	unset($_SESSION[sid]);
	unset($_SESSION[tid]);
	unset($_SESSION[trueans]);
	exit;
}

// check if the user is trying to refresh the page


?>

<html>

<head>
  <style>
body {
  font-family: Arial, sans-serif;
  background-color: #E8E8D0;
  
}
form{
	border-radius: 15px;
}
#timer {
  position: fixed;
  top: 10px;
  right: 272px;
  background-color: #ddd;
  padding: 5px 10px;
  font-size: 18px;
  color: green;
  margin-top: 50px;
  font-weight: bold;
}

#submit-btn {
  position: fixed;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  bottom: 10px;
  right: 45%;
}

#submit-btn:hover {
  background-color: #3e8e41;
}

/* CSS for questions */
#questions {
  margin-top: 50px;
}

table {
  width: 65%;
  padding: 46px;
  margin-top: 90px;
  margin-bottom: 50px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50px;
  border-collapse: collapse;
}


th, td {
  padding: 6px;
  text-align: left;
  border-radius: 0px;
}

th {
  background-color: #f2f2f2;
}

.style9{
  background-color: #ddd;
}


.style2 {
  font-size: 16px;
  font-weight: bold;
}

.style8 {
  font-size: 15px;
  background-color: floralwhite;
}

@media (max-width: 768px) {
  /* adjust timer position */
  #timer {
    top: 50px;
    right: 10%;
  }

  /* adjust submit button position */
  #submit-btn {
    bottom: 50px;
    right: 10%;
  }

  /* adjust table padding */
  table {
    padding: 10px;
  }
}

@media (max-width: 480px) {
  /* adjust timer position */
  #timer {
    top: 20px;
    right: 5%;
    font-size: 14px;
  }

  /* adjust submit button position */
  #submit-btn {
    bottom: 20px;
    right: 5%;
    font-size: 14px;
  }

  /* adjust table font size */
  table {
    font-size: 12px;
  }
}
.style35{
	font-weight: bold;
	position: fixed;
  top: 70px;
  left: 100px;
  font-size: 25px;
  color: rebeccapurple;
}
</style>

</head>
<body>
<?php
$rs=mysql_query("select * from mst_question where test_id=$tid ORDER BY RAND() limit 20",$cn) or die(mysql_error());
$num_questions = mysql_num_rows($rs);
echo "<div align=\"left\" class='style35'><strong>$login</strong></div>";
echo '<div id="timer"></div>';
echo '<script>
var time_left = ' . $time_limit . ';
var timer_element = document.getElementById("timer");

function countdown() {
    if (time_left == 0) {
        document.getElementById("submit-btn").click();
    } else {
        var minutes = Math.floor(time_left / 60);
        var seconds = time_left % 60;
        var time_str = "Time remaining: " + minutes + "m " + seconds + "s";
        document.getElementById("timer").innerHTML = time_str;
        time_left--;
        if (time_left < 30) {
                if (timer_element.style.color == "red") {
                    timer_element.style.color = "#24014D";
                } else {
                    timer_element.style.color = "red";
                }
            }
        setTimeout(countdown, 1000);
    }
}

countdown();
</script>';


?>
<form name="myfm" method="post" action="quizfull3.php">
  <table border="0">
    <?php for ($i = 0; $i < $num_questions; $i++) {
      mysql_data_seek($rs, $i);
      $row = mysql_fetch_row($rs); ?>
      <tr class="style9">
        <td>
          <span class="style2">Q<?php echo $i + 1 ?>: <?php echo $row[2] ?></span>
        </td>
      </tr>
      <tr>
        <td class="style8">
          <input type="radio" id="ans<?php echo $i ?>_1" name="ans<?php echo $i ?>" value="1">
          <label for="ans<?php echo $i ?>_1"><?php echo $row[3] ?></label>
        </td>
      </tr>
      <tr>
        <td class="style8">
          <input type="radio" id="ans<?php echo $i ?>_2" name="ans<?php echo $i ?>" value="2">
          <label for="ans<?php echo $i ?>_2"><?php echo $row[4] ?></label>
        </td>
      </tr>
      <tr>
        <td class="style8">
          <input type="radio" id="ans<?php echo $i ?>_3" name="ans<?php echo $i ?>" value="3">
          <label for="ans<?php echo $i ?>_3"><?php echo $row[5] ?></label>
        </td>
      </tr>
      <tr>
        <td class="style8">
          <input type="radio" id="ans<?php echo $i ?>_4" name="ans<?php echo $i ?>" value="4">
          <label for="ans<?php echo $i ?>_4"><?php echo $row[6] ?></label>
          <input type="hidden" name="trueans<?php echo $i ?>" value="<?php echo $row[7] ?>">
        </td>
      </tr>
    <?php } ?>
  </table>
  <button id="submit-btn" type="submit" name="submit" value="Get Result">Get Result</button>
</form>

</body>