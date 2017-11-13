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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="Register.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT Username FROM `user` WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_MyConnection, $MyConnection);
  $LoginRS=mysql_query($LoginRS__query, $MyConnection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "RegisterForm")) {
  $insertSQL = sprintf("INSERT INTO ``user`` (Fname, Lname, Email, Username, Password) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Fname'], "text"),
                       GetSQLValueString($_POST['Lname'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_MyConnection, $MyConnection);
  $Result1 = mysql_query($insertSQL, $MyConnection) or die(mysql_error());

  $insertGoTo = "Login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_MyConnection, $MyConnection);
$query_Register = "SELECT * FROM `user`";
$Register = mysql_query($query_Register, $MyConnection) or die(mysql_error());
$row_Register = mysql_fetch_assoc($Register);
$totalRows_Register = mysql_num_rows($Register);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
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
	<div id="PageHeading"></div>
	<p>
	<h1>UK'S leading hiring company Global Recruiters</h1> </p>
	<div>
	  <h2>Contact Details </h2>
	  <div>
	    <div>
	      <div>
	        <div>
	          <div>
	            <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
	              <h6>ADDRESS</h6>
	              <p>84 HIGH HOLBORN</p>
<p>WC1V 6DF </p>
	              <p>LONDON</p>
                </div>
              </div>
            </div>
	        <div></div>
          </div>
        </div>
	    <div>
	      <div>
	        <div>
	          <div>
	            <div>
	              <h6>Email</h6>
	              <ul>
	                <li><a href="mailto:info@ukcbc.co.uk"><span itemprop="email">info@gr.uk</span></a></li>
                  </ul>
	              <h6>Telephone</h6>
	              <ul>
	                <li><a href="tel:020 8518 4994"><span itemprop="telephone">020 8518 4994</span></a> Telephone</li>
	                <li><a href="tel:0800 043 4994"><span itemprop="telephone">0800 043 4994</span></a> Freephone</li>
	                <li><a href="tel:020 8518 0978"><span itemprop="faxNumber">020 8518 0978</span></a> Fax</li>
                  </ul>
                </div>
              </div>
            </div>
	        <div></div>
          </div>
        </div>
      </div>
    </div>
	<div></div>
	<br />
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div id="ContentRight">
      <form id="RegisterForm" name="RegisterForm" method="POST" action="reg.process.php">
        <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th scope="col"><table width="385" border="0" cellpadding="0" cellspacing="0">
            <tr>              </tr>
          </table></th>
        </tr>
        <tr>          </tr>
        <tr>          </tr>
        <tr>
          <td><table width="378" border="0" cellpadding="0" cellspacing="0">
            <tr>              </tr>
          </table></td>
        </tr>
        </table>
      </form>
    </div>
</div>

<div id="Footer"></div>
</div>
</body>
</html>
<?php
mysql_free_result($Register);
?>
