<?php require_once('Connections/MyConnection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_MyConnection, $MyConnection);
$query_Login = "SELECT * FROM `user`";
$Login = mysql_query($query_Login, $MyConnection) or die(mysql_error());
$row_Login = mysql_fetch_assoc($Login);
$totalRows_Login = mysql_num_rows($Login);
$query_Login = "SELECT * FROM `user`";
$Login = mysql_query($query_Login, $MyConnection) or die(mysql_error());
$row_Login = mysql_fetch_assoc($Login);
$totalRows_Login = mysql_num_rows($Login);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "UserID";
  $MM_redirectLoginSuccess = "Account.php";
  $MM_redirectLoginFailed = "Login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_MyConnection, $MyConnection);
  	
  $LoginRS__query=sprintf("SELECT Username, Password, UserID FROM `user` WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyConnection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'UserID');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
h1 {
	font-size: larger;
}
h2 {
	font-size: x-large;
	color: #666;
}
h6 {
	font-size: 14px;
	color: #999;
}
</style>
</head>

<body>
<div id="Holder">
<div id="Header"></div>
<div id="NavBar">
	<nav> 
    	<ul> <li><a href="Home.php">Home</a></li>
        	<li><a href="Job_ List.php">Job List</a></li>
            <li><a href="Apply_job.php">Apply Job</a></li>
            
            <li><a href="Login.php">Login</a></li>
            <li><a href="Register.php">Register</a></li>
           <li><a href="contactus.php">Contact us</a></li>
            
      </ul>
    </nav>
 </div>
<div id="Content">
	<div id="PageHeading">	Welcome to Global Recruiters</div>
	<p>    		<img src="Assets/Recruitment-Agencies.jpg" width="960" height="220" longdesc="Assets/Recruitment-Agencies.jpg" /></p>
	<p><a href="Login.php">Please click here to Login</a></p>
	<table width="974" height="398" border="0">
	  <tr>
	    <td width="963"><p>In 1999, globalrecruiters.com became the first recruitment website offered by a recruitment agency in the UK.Since then, globalrecruiters.co.uk has branched out to become the UK's #1 job site, featuring vacancies from over 25,000 recruiters a year, including private and public sector employers, leading recruitment agencies and consultants from globalrecruiters's network of 350 offices across the UK, and around the world.</p>
<p><strong>Our mission is simple: to help the world Love Mondays.</strong></p>
	      <p>Each month, more than 7 million jobseekers turn to globalrecruiters.co.uk in their search for work, making over 160,000 applications every day.Take a look around globalrecruiters.co.uk and you'll find jobs across 42 industry specialisms, from thousands recruiters across the UK and beyond.Home for globalrecruiters.co.uk is Covent Garden, London.</p>
<h2>For jobseekers</h2>
	      <p>globalrecruiters.co.uk provides a full online service for anyone looking for a new job. We're not a recruitment agency, we're a job site. This means we advertise vacancies on behalf of employers and recruitment agencies who are looking for staff.</p>
	      <p>As a registered user of globalrecruiters.co.uk, you can receive email job alerts, apply for vacancies, manage your applications, create your very own jobseeking profile and store your CV securely online. You can also make it available to be searched for by thousands of recruitment agencies.</p>
	      <p>globalrecruiters.co.uk's <a href="http://www.reed.co.uk/courses/">Courses</a> features a full course search from a range of learning providers and partners and includes distance learning, online, classroom-based and free courses.</p>
	      <p>We also offer a range of <a href="http://www.reed.co.uk/career-advice">career advice, news and information</a>, all designed to help you whatever stage you're at in your career.</p>
	      <p><a href="https://www.reed.co.uk/account/register">Register with globalrecruiters.co.uk »</a></p>
	      <h2>For recruiters</h2>
	      <p>globalrecruiters.co.uk works with thousands of organisations to fulfil their online recruitment needs.Direct employers and recruitment agencies can choose from a range of services, including: <a href="https://www.reed.co.uk/recruiter/advertise-a-job">job advertising</a> with full applicant management, <a href="https://www.reed.co.uk/recruiter/cv-search">CV search</a>, a platform for specifically hiring temporary staff, branding, display advertising and email services.</p>
<p><a href="https://www.reed.co.uk/recruiter">Recruiter services from globalrecruiters.co.uk »</a></p>
<div id="ContentRight">
            <form id="LoginForm" name="LoginForm" method="post" action="<?php echo $loginFormAction; ?>">
              <table width="400" border="0" align="center">
                <tr> </tr>
                <tr> </tr>
              </table>
            </form>
        </div></td>
	    <td width="10">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="67"><img src="Assets/c.jpg" width="952" height="165" alt="aa" longdesc="Assets/c.jpg" /></td>
	    <td>&nbsp;</td>
      </tr>
    </table>
	<p>&nbsp;</p>
</div>

<div id="Footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($Login);
?>
