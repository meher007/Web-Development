<?php require_once('Connections/MyConnection.php'); ?>
<?php require_once('Connections/myconnect.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO applicant_personal_details_table (first_name, surname, Date_of_Birth, position_applied_for, Gender, House_No, Street_name, City, Country, post_code, Tel_No, email) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['Date_of_Birth'], "date"),
                       GetSQLValueString($_POST['position_applied_for'], "text"),
                       GetSQLValueString($_POST['RadioGroup1'], "text"),
                       GetSQLValueString($_POST['House_Number'], "text"),
                       GetSQLValueString($_POST['Streel Name'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Post_code'], "text"),
                       GetSQLValueString($_POST['Telephone_Number'], "text"),
                       GetSQLValueString($_POST['Email'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ``aplicant's_qualification_table`` (Highest_Degree, Specialization, University, Grade) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Higher_Degree'], "text"),
                       GetSQLValueString($_POST['Specialization'], "text"),
                       GetSQLValueString($_POST['University'], "text"),
                       GetSQLValueString($_POST['grade'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());
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

mysql_select_db($database_myconnect, $myconnect);
$query_Appform = "SELECT * FROM applicant_personal_details_table";
$Appform = mysql_query($query_Appform, $myconnect) or die(mysql_error());
$row_Appform = mysql_fetch_assoc($Appform);
$totalRows_Appform = mysql_num_rows($Appform);
$query_Login = "SELECT * FROM `user`";
$Login = mysql_query($query_Login, $MyConnection) or die(mysql_error());
$row_Login = mysql_fetch_assoc($Login);
$totalRows_Login = mysql_num_rows($Login);
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
body,td,th {
	font-size: smaller;
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
<p>Please fill up the form.</p>
<div id="Content">
	<div id="PageHeading">
	  <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
	    <table width="959" border="0">
	      <tr>
	        <td width="226">First Name</td>
	        <td width="218"><label for="fname"></label>
            <input name="fname" type="text" class="StyleTxtField" id="fname" /></td>
	        <td width="185">Last Name</td>
	        <td width="312"><label for="lname"></label>
            <input name="lname" type="text" class="StyleTxtField" id="lname" /></td>
          </tr>
	      <tr>
	        <td>Date of Birth</td>
	        <td><label for="Date_of_Birth"></label>
            <input name="Date_of_Birth" type="text" class="StyleTxtField" id="Date_of_Birth" /></td>
	        <td>position applied for</td>
	        <td><label for="position_applied_for"></label>
            <input name="position_applied_for" type="text" class="StyleTxtField" id="position_applied_for" /></td>
          </tr>
	      <tr>
	        <td>Gender</td>
	        <td><p>
	          <label>
                <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0" />
                Male</label>
	          <label>
	            <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_1" />
                Female</label>
              <br />
          </p></td>
	        <td>House Number</td>
	        <td><label for="House_Number"></label>
            <input name="House_Number" type="text" class="StyleTxtField" id="House_Number" /></td>
          </tr>
	      <tr>
	        <td>Street Name:</td>
	        <td><label for="Streel Name"></label>
            <input name="Streel Name" type="text" class="StyleTxtField" id="Streel Name" /></td>
	        <td>City</td>
	        <td><label for="City"></label>
            <input name="City" type="text" class="StyleTxtField" id="City" /></td>
          </tr>
	      <tr>
	        <td>Country</td>
	        <td><label for="Country"></label>
            <input name="Country" type="text" class="StyleTxtField" id="Country" /></td>
	        <td>Post Code</td>
	        <td><label for="Post_code"></label>
            <input name="Post_code" type="text" class="StyleTxtField" id="Post_code" /></td>
          </tr>
	      <tr>
	        <td>Telephone Number</td>
	        <td><label for="Telephone_Number"></label>
            <input name="Telephone_Number" type="text" class="StyleTxtField" id="Telephone_Number" /></td>
	        <td>Email</td>
	        <td><label for="Email"></label>
            <input name="Email" type="text" class="StyleTxtField" id="Email" /></td>
          </tr>
	      <tr>
	        <td>Right to work</td>
	        <td><p>
	          <label>
	            <input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_0" />
	            Yes</label>
	          <label>
	            <input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_1" />
	            No</label>
	          <br />
            </p></td>
	        <td>Passport Number</td>
	        <td><label for="passport_number"></label>
            <input name="passport_number" type="text" class="StyleTxtField" id="passport_number" /></td>
          </tr>
	      <tr>
	        <td>Nationality</td>
	        <td><label for="nationality"></label>
            <input name="nationality" type="text" class="StyleTxtField" id="nationality" /></td>
	        <td>Higher Degree</td>
	        <td><label for="Higher_Degree"></label>
            <input name="Higher_Degree" type="text" class="StyleTxtField" id="Higher_Degree" /></td>
          </tr>
	      <tr>
	        <td>Specialization</td>
	        <td><label for="Specialization"></label>
            <input name="Specialization" type="text" class="StyleTxtField" id="Specialization" /></td>
	        <td>University</td>
	        <td><label for="University"></label>
            <input name="University" type="text" class="StyleTxtField" id="University" /></td>
          </tr>
	      <tr>
	        <td>Grade</td>
	        <td><label for="grade"></label>
	          <select name="grade" id="grade">
	            <option>1st class</option>
	            <option>2nd class</option>
	            <option>3rd class</option>
            </select></td>
	        <td>Job title</td>
	        <td><label for="Job_title"></label>
            <input name="Job_title" type="text" class="StyleTxtField" id="Job_title" /></td>
          </tr>
	      <tr>
	        <td>Job Description</td>
	        <td><label for="Job_Description"></label>
            <input name="Job_Description" type="text" class="StyleTxtField" id="Job_Description" /></td>
	        <td>Salary</td>
	        <td><label for="Salary"></label>
            <input name="Salary" type="text" class="StyleTxtField" id="Salary" /></td>
          </tr>
	      <tr>
	        <td><label for="startdate">Start Date</label></td>
	        <td><span id="sprytextfield1">
            <label for="start_date"></label>
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
	          <input name="startdate" type="text" class="StyleTxtField" id="startdate" /></td>
	        <td><label for="enddate">End Date</label></td>
	        <td><span id="sprytextfield2">
            <label for="End_date"></label>
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
	          <input name="enddate" type="text" class="StyleTxtField" id="enddate" /></td>
          </tr>
	      <tr>
	        <td>Notice Period</td>
	        <td><label for="Notice period"></label>
	          <select name="Notice period" id="Notice period">
	            <option>One week</option>
	            <option>two week</option>
	            <option>one month</option>
            </select></td>
	        <td>Employee name</td>
	        <td><label for="Employee_name"></label>
            <input name="Employee_name" type="text" class="StyleTxtField" id="Employee_name" /></td>
          </tr>
	      <tr>
	        <td>Address</td>
	        <td><label for="address1"></label>
            <textarea name="address1" id="address1" cols="45" rows="5"></textarea></td>
	        <td>Tel Number</td>
	        <td><label for="Tel_Number"></label>
            <input name="Tel_Number" type="text" class="StyleTxtField" id="Tel_Number" /></td>
          </tr>
	      <tr>
	        <td>Email</td>
	        <td><label for="Email1"></label>
            <input name="Email1" type="text" class="StyleTxtField" id="Email1" /></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>Reference 1</td>
	        <td><label for="Reference_1"></label>
            <input name="Reference_1" type="text" class="StyleTxtField" id="Reference_1" /></td>
	        <td>Reference 2</td>
	        <td><label for="Reference2"></label>
            <input name="Reference2" type="text" class="StyleTxtField" id="Reference2" /></td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td><input type="submit" name="Submit" id="Submit" value="Submit" /></td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
          </tr>
        </table>
	    <p id="Appform"></p>
	    <input type="hidden" name="MM_insert" value="form1" />
      </form>
	</div>
</div>

<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd.mm.yyyy"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd.mm.yyyy"});
</script>
</body>
</html>
<?php
mysql_free_result($Login);

mysql_free_result($Appform);
?>
