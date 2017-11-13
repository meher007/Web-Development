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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
	<div id="PageHeading">Sign Up!</div>
	<div id="ContentLeft">
	  <p>You are going Sing up for your dream Job!!!</p>
	</div>
    <div id="ContentRight">
      <form id="RegisterForm" name="RegisterForm" method="POST" action="reg.process.php">
        <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <th scope="col"><table width="385" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th width="124" scope="col"><p>
                  <label for="Fname"></label>
                  First Name</p>
                  <p><span id="sprytextfield2">
                    <input name="Fname" type="text" class="StyleTxtField" id="Fname" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></p></th>
                <th width="245" scope="col"><p>
                  <label for="Lname"></label>
                  Last Name</p>
                  <p><span id="sprytextfield3">
                    <input name="Lname" type="text" class="StyleTxtField" id="Lname" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></p></th>
              </tr>
            </table></th>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><p>
              <label for="Email"></label>
              E-Mail </p>
              <p><span id="sprytextfield1">
              <input name="Email" type="text" class="StyleTxtField" id="Email" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><p>
              <label for="Username"></label>
              User Name</p>
              <p><span id="sprytextfield4">
                <input name="Username" type="text" class="StyleTxtField" id="Username" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="378" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th scope="col"><p>
                  <label for="Password"></label>Password</p>
                  <p><span id="sprytextfield5">
                    <input name="Password" type="text" class="StyleTxtField" id="Password" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></p></th>
                <th scope="col"><p>
                  <label for="PasswordConfirm"></label>
                  Confirm Password</p>
                  <p><span id="sprytextfield6">
                    <input name="PasswordConfirm" type="text" class="StyleTxtField" id="PasswordConfirm" />
                  <span class="textfieldRequiredMsg">A value is required.</span></span></p></th>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type="submit" name="Submit" id="Submit" value="Register" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="RegisterForm" />
      </form>
    </div>
</div>

<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
</script>
</body>
</html>
<?php
mysql_free_result($Register);
?>
