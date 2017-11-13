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
    	<ul> 
        <li><a href="Home.php">Home</a></li>
        	<li><a href="Job_ List.php">Job List</a></li>
            <li><a href="Apply_job.php">Apply Job</a></li>
            
            <li><a href="Login.php">Login</a></li>
            <li><a href="Register.php">Register</a></li>
           <li><a href="contactus.php">Contact us</a></li>
            
        
        
      </ul>
    </nav>
 </div>
<div id="Content">
	<div id="PageHeading">
	  <p>Job List</p>
	  <p><img src="Assets/XY1.jpg" width="300" height="130" longdesc="Assets/XY1.jpg" /><img src="Assets/XY.jpg" width="300" height="130" longdesc="Assets/XY.jpg" /><img src="Assets/XY2.jpg" width="310" height="130" longdesc="Assets/XY2.jpg" /></p>
	</div>
	<p><img src="Assets/JOBLIST.jpg" width="960" height="400" longdesc="Assets/JOBLIST.jpg" /></p>
	<table width="974" height="398" border="0">
	  <tr>
	    <td width="899"><p>Global Recruiters is one of the UK's leading jobs boards, attracting around 6 million jobseekers every month on the hunt for one of 110,000 live job ads the site carries at any one time. All of this activity generates over 2 million applications a month, cementing totaljobs.com's strong reputation among jobseekers and recruiters alike. Thousands of recruiters from multinationals to smaller regionally-based businesses, recruitment consultants and advertising agencies use totaljobs.com to recruit individuals across almost every sector in the UK.</p>
          <p>Totaljobs.com is part of Totaljobs Group Ltd; the UK's largest and fastest-growing online recruitment company, comprising six job boards, which between them carry over 190,000 jobs, and attract 7 million jobseekers every month, generating 3.3 million applications. The job boards are CareerStructure.com, Caterer.com, Catererglobal.com, CWJobs.co.uk, RetailChoice.com and totaljobs.com.</p>
          <p>Global Recruiters has seven offices throughout the UK, covering all regions. To enquire about advertising your job vacancies on totaljobs, please <a href="Home.php">contact your local office</a>.</p>
          <div id="ContentRight">
            <form id="LoginForm" name="LoginForm" method="post" action="<?php echo $loginFormAction; ?>">
              <table width="400" border="0" align="center">
                <tr> </tr>
                <tr> </tr>
              </table>
            </form>
        </div></td>
	    <td width="65">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="67">&nbsp;</td>
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
