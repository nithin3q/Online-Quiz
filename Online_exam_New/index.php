<?php
session_start();
error_reporting(1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Student Online Examination Portal(SOEP)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
  * {
  box-sizing: border-box;
  margin: 0;
  padding: 0; 
  font-family: Raleway, sans-serif;
}


body {
  background: linear-gradient(90deg, #C7C5F4, #776BCC);
     
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding-bottom: 120px;

}

.screen {   
  background: linear-gradient(90deg, #5D54A4, #7C78B8);   
  position: relative; 
  height: 600px;
  width: 400px; 
  box-shadow: 0px 0px 24px #5C5696;
  border-radius: 20px;

}

.screen__content {
  z-index: 1;
  position: relative; 
  height: 100%;

}

.screen__background {   
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 0;
  -webkit-clip-path: inset(0 0 0 0);
  clip-path: inset(0 0 0 0);  
}

.screen__background__shape {
  transform: rotate(45deg);
  position: absolute;
}

.screen__background__shape1 {
  height: 520px;
  width: 520px;
  background: #FFF; 
  top: -50px;
  right: 120px; 
  border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
  height: 220px;
  width: 220px;
  background: #6C63AC;  
  top: -172px;
  right: 0; 
  border-radius: 32px;
}

.screen__background__shape3 {
  height: 540px;
  width: 190px;
  background: linear-gradient(270deg, #5D54A4, #6A679E);
  top: -24px;
  right: 0; 
  border-radius: 32px;
}

.screen__background__shape4 {
  height: 400px;
  width: 200px;
  background: #7E7BB9;  
  top: 420px;
  right: 50px;  
  border-radius: 60px;
}

.login {
  width: 320px;
  padding: 30px;
  padding-top: 156px;
}

.login__field {
  padding: 20px 0px ;  
  position: relative; 
}

.login__icon {
  position: absolute;
  top: 30px;
  color: #7875B5;
  width: 23px;
}

.login__input {
  border: none;
  border-bottom: 2px solid #D1D1D4;
  background: none;
  padding: 10px;
  padding-left: 24px;
  font-weight: 700;
  width: 95%;
  transition: .2s;
  font-size: 20px;
}
.login__inputs {
  border: none;
  width: 20%;
  background: none;
  padding: 0px;
  padding-left: 54px;
  width: 75%;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
  outline: none;
  border-bottom-color: #6A679E;
}

.login__submit {
  background: #fff;
  font-size: 14px;
  margin-top: 30px;
  padding: 16px 20px;
  border-radius: 26px;
  border: 1px solid #D4D3E8;
  text-transform: uppercase;
  font-weight: 700;
  display: flex;
  align-items: center;
  width: 100%;
  color: #4C489D;
  box-shadow: 0px 2px 2px #5C5696;
  cursor: pointer;
  transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
  border-color: #6A679E;
  outline: none;
}

.button__icon {
  font-size: 24px;
  margin-left: auto;
  color: #7875B5;
}

.social-login { 
  position: absolute;
  height: 140px;
  width: 160px;
  text-align: center;
  bottom: 0px;
  right: 0px;
  color: #fff;
}

.social-icons {
  display: flex;
  align-items: center;
  justify-content: center;
}

.social-login__icon {
  padding: 20px 10px;
  color: #fff;
  text-decoration: none;  
  text-shadow: 0px 0px 8px #7875B5;
}

.social-login__icon:hover {
  transform: scale(1.5);  
}
</style>
</head>

<body>
  <img border="0" src="clglogo.png" width="100%" height="120" ></td>
<?php
include("database.php");
extract($_POST);

if(isset($submit))
{
	$rs=mysql_query("select * from mst_user where login='$loginid' and pass='$pass'");
	if(mysql_num_rows($rs)<1)
	{
		$found="N";
	}
	else
	{
		$_SESSION[login]=$loginid;
	}
}
if (isset($_SESSION[login]))
{
  echo "<div align=\"right\"><strong><a href=\"index.php\"> Home </a>|<a href=\"signout.php\">Signout</a></strong></div>";
   
echo "<h1 class='style8' align=center>Welcome to Student Online Examination Portal(SOEP)</h1>";
		echo '<table width="98%"  border="0" align="center" style="padding:70px;">
  <tr>
  
    <td width="100%" height="80%" valign="bottom" bordercolor="#0000FF" align="center" style="padding:30px;"><a href="quizfull3.php?testid=9 & subid=1" class="style4"><h1>Start The Quiz </h1></a></td>
  </tr>
  <tr>
    
    <td valign="bottom" align="center" colspan="2"> <a href="result.php" class="style4" align="center"><h1>Result</h1> </a></td>
  </tr>
  
</table>';
   
		exit;
		

}


?>

          
<div class="container">
  <div class="screen">
    <div class="screen__content">
      <form class="login" name="form1" method="post" action="">
        <div class="login__field">
          <img src="profile.png" class="login__icon">
          <input type="text" class="login__input" name="loginid" id="loginid2" placeholder="Roll Number">
        </div>
        <div class="login__field">
          <img src="lock (2).png" class="login__icon">
          <input type="password" class="login__input" name="pass" id="pass2" placeholder="Password">
        </div>
        <div>
          <span class="errors">
            <?php
      if(isset($found))
      {
        echo "Invalid Username or Password";
      }
      ?>
          </span>
        </div>
        <button class="button login__submit" name="submit" type="submit" id="submit" value="Login">
          <span class="button__text">Log In User</span>
          
          <i class="button__icon fas fa-chevron-right"></i>
        </button>       
      </form>
      <div class="social-login">
        
        
      </div>
    </div>
    <div class="screen__background">
      <span class="screen__background__shape screen__background__shape4"></span>
      <span class="screen__background__shape screen__background__shape3"></span>    
      <span class="screen__background__shape screen__background__shape2"></span>
      <span class="screen__background__shape screen__background__shape1"></span>
    </div>    
  </div>
</div>
</body>
</html>
