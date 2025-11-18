<?
  session_start();

  if ($_POST['email'] == "") {

   // nothing
   print ("");

  } else {

    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");
	
	$usernameexists = "N";
	
    if ($_POST['email'] != "") {	
 		$Query = "SELECT * FROM ink_customers WHERE username = '" . $_POST['email'] . "'";
 		$queryexe = mysql_query($Query);
 		if ($myrow = mysql_fetch_array($queryexe)) {
 		  $usernameexists = "Y";
 		}
	}
 
    $today = date("Ymd");
    $searchid = $_SESSION['search_id'];
    $completeaddress = $_POST['co']." \nATTN: ".$_POST['fname']." ".$_POST['lname']." \n".$_POST['street']." \n".$_POST['city'].", ".$_POST['state']." ".$_POST['zip']." \n\n(".$_POST['area'].") ".$_POST['phone'];

    $sql = "INSERT INTO `requests` ( `requestdate` , `company` , `firstname` , `lastname` , `street` , `city` , `state` , `zipcode` , `areacode`, `phonenumber` , `email` , `operatingsys` , `graphicsapp` , `refsource` , `othersource` , `industry` , `position` , `completeaddress`, `searchid`, `offers`, `folders`, `sales`, `media`, `brochures`, `buscards`, `stationery`, `directmail`, `other`, `othertext`, `username` )  VALUES ( '$today',  '".$_POST['co']."',  '".$_POST['fname']."',  '".$_POST['lname']."',  '".$_POST['street']."',  '".$_POST['city']."',  '".$_POST['state']."',  '".$_POST['zip']."',  '".$_POST['area']."',  '".$_POST['phone']."',  '".$_POST['email']."',  '".$_POST['os']."',  '".$_POST['app']."',  '".$_POST['ref']."',  '".$_POST['refOpt']."' ,  '".$_POST['industry']."' , '".$_POST['position']."' , '$completeaddress', '$searchid', '".$_POST['offers']."', '".$_POST['folders']."', '".$_POST['sales']."', '".$_POST['media']."', '".$_POST['brochures']."', '".$_POST['buscards']."', '".$_POST['stationery']."', '".$_POST['directmail']."', '".$_POST['other']."', '".$_POST['othertext']."', '".$_POST['email']."' )";
    $queryexe = mysql_query($sql);

 if ($usernameexists == "N") {
    $sql = "INSERT INTO `ink_customers` ( `company` , `name` , `address` , `city` , `state` , `zip` , `phone`, `email` , `username` )  VALUES ( '".$_POST['co']."',  '".$_POST['fname']." ".$_POST['lname']."',  '".$_POST['street']."',  '".$_POST['city']."',  '".$_POST['state']."',  '".$_POST['zip']."',  '(".$_POST['area'].") ".$_POST['phone']."',  '".$_POST['email']."', '".$_POST['email']."' )";
    $queryexe = mysql_query($sql);
  }

	$headers  = "MIME-Version: 1.0\r\n";
//	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
	$headers .= "From: InkRockit <".$_POST['email'].">\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

	$date = date("h:i, jS F Y", time() + 3600*3);
	$message = "InkRockit Printed Samples Request \nDate: $date \n\n".$_POST['co']." \nATTN: ".$_POST['fname']." ".$_POST['lname']." \n".$_POST['street']." \n".$_POST['city'].", ".$_POST['state']." ".$_POST['zip']." \n\n(".$_POST['area'].") ".$_POST['phone']." \n".$_POST['email']." \n\nReference Source: ".$_POST['ref']." \nIndustry: ".$_POST['industry']." \n".$_POST['position']." ";
	$message = str_replace("\'", "'",$message);
	$message = $message . "\n\nOther Information\n\n";
	if ($_POST['offers'] != '') {
	  $message = $message . "E-mail me with special offers from InkRockit: ".$_POST['offers']."\n\n";
	}
	$message = $message . "\n\nWhat products are you interested in?\n\n";
	if ($_POST['folders'] != '') {
	  $message = $message . "Folders\n";
	}
	if ($_POST['media'] != '') {
	  $message = $message . "Media/Press Kits\n";
	}
	if ($_POST['sales'] != '') {
	  $message = $message . "Sales/Product Sheets\n";
	}
	if ($_POST['brochures'] != '') {
	  $message = $message . "Brochures/Catalogs\n";
	}
	if ($_POST['buscards'] != '') {
	  $message = $message . "Business Cards\n";
	}
	if ($_POST['stationery'] != '') {
	  $message = $message . "Stationery Package\n";
	}
	if ($_POST['directmail'] != '') {
	  $message = $message . "Direct Mail\n";
	}
	if ($_POST['other'] != '') {
	  $message = $message . "Other: ".$_POST['othertext']."\n";
	}
	if ( mail("leads@imageteam.com", "InkRockit Printed Samples Request", $message, $headers))
	{
	  mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>InkRockit - Thank You for Requesting Samples</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
a:hover{
color:#FFCC33;
text-decoration:none;
text-weight:900;
}
a{
color:#FFFFFF;
text-decoration:none;
text-weight:900;
}
</style>
</head>
<body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="middle" align="center">
<span style="color: #000000"><font face="Verdana" style="font-size:12pt;font-weight:bolder;">Thank you,</font><br />
<font face="Verdana" style="font-size:9pt;font-weight:bolder;"> your samples will be sent by 1st class mail.<br />
You should receive them within 3-5 business days.</font></span><br>
<br>
</td>
</tr>
</table>
<div align="center">
<!-- Google Code for Lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1071175607;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "000000";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "Lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1071175607/?value=1&label=Lead&script=0">
</noscript>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!-- Overture Services Inc. 07/15/2003
var cc_tagVersion = "1.0";
var cc_accountID = "1110981352";
var cc_marketID =  "0";
var cc_protocol="http";
var cc_subdomain = "convctr";
if(location.protocol == "https:")
{
    cc_protocol="https";
     cc_subdomain="convctrs";
}
var cc_queryStr = "?" + "ver=" + cc_tagVersion + "&aID=" + cc_accountID + "&mkt=" + cc_marketID +"&ref=" + escape(document.referrer);
var cc_imageUrl = cc_protocol + "://" + cc_subdomain + ".overture.com/images/cc/cc.gif" + cc_queryStr;
var cc_imageObject = new Image();
cc_imageObject.src = cc_imageUrl;
// -->
</SCRIPT></body>
</html>
<?
	} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>InkRockit - Thank You for Requesting Samples</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
a:hover{
color:#FFCC33;
text-decoration:none;
text-weight:900;
}
a{
color:#FFFFFF;
text-decoration:none;
text-weight:900;
}
</style>
</head>
<body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="middle" align="center">
<font face="Verdana" color="#CC0000" style="font-size:14pt;font-weight:bolder;">SERVER ERROR!</font><br>
<font face="Verdana" color="#00000" style="font-size:9pt;font-weight:bolder;">There has been an error<br> sending your information.<br><br>  Please close this window and retry.<br>  If the problem persists contact:<br><a href="mailto:leads@inkrockit.com">leads@inkrockit.com</a></font><br><br>

</td>
</tr>
</table>
</body>
</html>
<?
	}
?>
<?
	}
?>

