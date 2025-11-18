<?
 session_start();
$_SESSION['search_id'] = $_SERVER['HTTP_REFERER'];
if (!empty($_SERVER['HTTP_REFERER'])) {
    $parse_url = parse_url($_SERVER['HTTP_REFERER']);
    if(!empty($parse_url['query']) && strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])===FALSE){
        $all = @explode('&',$parse_url['query']);
        foreach($all as $val){
            $v = @explode('=', $val);
            if(!empty($v[0]) && $v[0]=='q'){
                $_SESSION['keyword'] = $v[1];
            }
        }
    }
}
?>
<?php

// initiate cURL w/ protocol & URL of remote host
$ch=curl_init("https://www.eProcessingNetwork.Com/cgi-bin/tdbe/transact.pl");

$chargeamount = $_POST['chargeamount'];

// normal POST request
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ePNAccount=090367&CardNo=".$_POST['credit_card_number']."&ExpMonth=".$_POST['exp_month']."&ExpYear=".$_POST['exp_year']."&Total=".$chargeamount."&Address=".$_POST['Address']."&Zip=".$_POST['ZIP']."&HTML=No&Email=".$_POST['Email']."&CVV2Type=1&CVV2=".$_POST['sec_code']);

// $_POST['credit_card_number']

// set response to return as variable
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// trap response into $response var
$response=curl_exec($ch);

// close cURL transfer
curl_close($ch);

$auth=substr($response,1,1);

$orderstatus = "Declined";
if ($auth=="Y")
{
  $orderstatus = "Approved";
}

if ($orderstatus == "Approved") {
    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");
    $today = date("m/d/Y");

	if (strlen($_POST['credit_card_number']) != 0) {
	  $credit_card_number2 = substr($_POST['credit_card_number'],strlen($_POST['credit_card_number'])-4,strlen($_POST['credit_card_number']));
	} else {
	  $credit_card_number2 = "";
	}
	$credit_card_number = $_POST['credit_card_number'];

  if (isset($_POST['custid']) && $_POST['custid'] != '') {
      $sql = "UPDATE `ink_customers` SET `name` = '" . $_POST['Name'] . "', `company` = '" . $_POST['Company'] . "', `address` = '" . $_POST['Address'] . "', `city` = '" . $_POST['City'] . "', `state` = '" . $_POST['State'] . "', `zip` = '" . $_POST['ZIP'] . "', `country` = '" . $_POST['Country'] . "', `phone` = '" . $_POST['Phone'] . "', `fax` = '" . $_POST['Fax'] . "', `email` = '" . $_POST['Email'] . "', `shipname` = '" . $_POST['ShipName'] . "', `shipcompany` = '" . $_POST['ShipCompany'] . "', `shipaddress` = '" . $_POST['ShipAddress'] . "', `shipcity` = '" . $_POST['ShipCity'] . "', `shipstate` = '" . $_POST['ShipState'] . "', `shipzip` = '" . $_POST['ShipZIP'] . "', `shipcountry` = '" . $_POST['ShipCountry'] . "' WHERE id = " . $_POST['custid'];
      $queryexe = mysql_query($sql);
	  $custid = $_POST['custid'];
  } else {
    $sql = "INSERT INTO `ink_customers` ( `name` , `company` , `address` , `city` , `state` , `zip` , `country`, `phone` , `fax`, `email`, `shipname`, `shipcompany`, `shipaddress`, `shipcity`, `shipstate`, `shipzip`, `shipcountry`, `username`, `password` )  VALUES ( '".$_POST['Name']."',  '".$_POST['Company']."',  '".$_POST['Address']."',  '".$_POST['City']."',  '".$_POST['State']."',  '".$_POST['ZIP']."',  '".$_POST['Country']."',  '".$_POST['Phone']."',  '".$_POST['Fax']."',  '".$_POST['Email']."', '".$_POST['ShipName']."', '".$_POST['ShipCompany']."', '".$_POST['ShipAddress']."', '".$_POST['ShipCity']."', '".$_POST['ShipState']."', '".$_POST['ShipZIP']."', '".$_POST['ShipCountry']."', '".$_POST['username']."', '".$_POST['password']."' )";
    $queryexe = mysql_query($sql);

	$Query = "SELECT id FROM ink_customers ORDER BY id";
	$queryexe = mysql_query($Query);
	mysql_data_seek($queryexe, mysql_num_rows($queryexe)-1);
	$myrow = mysql_fetch_array($queryexe);
	$custid = $myrow["id"];
  }

    $sql = "INSERT INTO `ink_orders` ( `custid` , `size` , `inkcolors_side1` , `pmscolors_side1` , `pmsmetalcolors_side1` , `specialfinish_side1` , `foilstampoption_side1` , `emboss_side1` , `spotuv_side1` , `inkcolors_side2` , `pmscolors_side2` , `pmsmetalcolors_side2` , `specialfinish_side2` , `foilstampoption_side2` , `emboss_side2` , `spotuv_side2` , `diecut` , `velcrotabs` , `quantity` , `subtotal` , `shipping` , `shippingoption` , `total` , `credit_card_number` , `exp_month` , `exp_year` , `cardtype` , `sec_code` , `comments` , `orderdate` )
VALUES (
".$custid.", '".$_POST['size']."', '".$_POST['inkcolors_side1']."', '".$_POST['pmscolors_side1']."', '".$_POST['pmsmetalcolors_side1']."', '".$_POST['specialfinish_side1']."', '".$_POST['foilstampoption_side1']."', '".$_POST['emboss_side1']."', '".$_POST['spotuv_side1']."', '".$_POST['inkcolors_side2']."', '".$_POST['pmscolors_side2']."', '".$_POST['pmsmetalcolors_side2']."', '".$_POST['specialfinish_side2']."', '".$_POST['foilstampoption_side2']."', '".$_POST['emboss_side2']."', '".$_POST['spotuv_side2']."', '".$_POST['diecut']."', '".$_POST['velcrotabs']."', '".$_POST['quantity']."', '".$_POST['subtotal']."', '".$_POST['shipping']."', '".$_POST['shippingoption']."', '".$_POST['total']."', '".$credit_card_number."', '".$_POST['exp_month']."', '".$_POST['exp_year']."', '".$_POST['cardtype']."', '".$_POST['sec_code']."', '".$_POST['comments']."', '".$today."');";

    $queryexe = mysql_query($sql);

//	print ($sql."<br><br>");
//	print ($queryexe."<br><br>");
//	print ($mysql_error."<br><br>");

	$Query = "SELECT id FROM ink_orders ORDER BY id";
	$queryexe = mysql_query($Query);
	mysql_data_seek($queryexe, mysql_num_rows($queryexe)-1);
	$myrow = mysql_fetch_array($queryexe);
    $orderid = $myrow["id"];

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
//	$headers .= "From: InkRockit <".$_POST['email'].">\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

	$date = date("h:i, jS F Y", time() + 3600*3);
	$message = "An Inkrockit order has been placed on: ".$date." \n\n";
	$message = $message . "Order ID: " . $orderid . " \n\n";
	$message = $message . "Go to https://www.inkrockit.com/vieworder.php?nAuth=hef2185AK!&id=".$orderid." to view order information";

//	mail("john@johnappt.com", "InkRockit Order", $message, $headers);
	mail("dtraub@inkrockit.com", "InkRockit Order", $message, $headers);
}

?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Presentation Folder Printing - Highest Quality at Great Prices - InkRockit</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta NAME="keywords" CONTENT="Discount Cheap Presentation Pocket Folder printing business card printing catalog printing cheap printing color printing commercial printing custom printing digital printing discount printing envelope printing flyer printing four color printing full color  printing offset printing online printing pocket folders post card printing presentation folders printing company printing services CMYK PMS CMYK Printing">
<meta NAME="description" CONTENT="Pocket Folder 4 color folder 4 page
folder business card folder Inkrockit Inkrocket Ink Rocket Ink Rockit
business folder cd presentation folder cheap folder, cheap pocket folder
color file folder color file jacket color folder colored file folder
corporate folder custom designed folder presentation printed, custom
folder custom pocket folder custom presentation folder custom printed
folder custom printed folder custom printed pocket folder customized
folder design folder discount folder embossed pocket folder embossed
presentation folder file folder file folder print file folder printed
file jacket file pocket folder foil stamped folder folder for business
presentation folder printer folder printing folder special full color
folders full color presentation folder glossy folder imprinted folder
laminated pocket folder legal size folder online file jacket online
folder online presentation folder online printing folder">
<meta NAME="author" CONTENT="HBO">
<meta name="allow-search" content="yes">
<meta name="audience" content="all">
<meta name="robots" content="all">
<meta name="Language" content="en">
<meta name="distribution" content="Global">
<meta name="Classification" content="Color Printing">
<style type="text/css">
<!--
body {
	background-color: #072d4f;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	font-style: italic;
	color: #FFFFFF;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #FFFFFF;
}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #FFFFFF; font-weight: bold; }
.style6 {
	font-size: 15px;
	color: #ffcc00;
}
.style23 {font-size: 15px; color: #ffcc00; font-weight: bold; }
.style64 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.style65 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
<!--
var wd = 530;
var ht = 760;

var wLeft = (screen.width - wd) / 2;
var wTop = (screen.height - ht) / 2;

function requestSamples(){
	window.open("request/","new","left="+wLeft+",top="+wTop+",width="+wd+",height="+ht+",statusbar=no,resizable=no");
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="javascript">

var nums=new Array('document.FrontPage_Form1.Phone', 'document.FrontPage_Form1.Fax');

function formatPhone(ph){

var re= /\D/;
// test for this format: (xxx)xxx-xxxx
// var re2 = /^\({1}\d{3}\)\d{3}-\d{4}/;
// test for this format: xxx-xxx-xxxx
var re2 = /^\d{3}-\d{3}-\d{4}/;

for (i=0; i<nums.length;i++){
var num=eval(nums[i]+'.value');

var newNum;
 if (num != "" && re2.test(num)!=true){
   if (num != ""){
     while (re.test(num)){
     num = num.replace(re,"");
     }
   }

  if (num.length != 10){
    alert('Please enter a 10 digit phone number');
    eval(nums[i]).select();
    break;
    }
   else {
     // for format (xxx)xxx-xxxx
     // newNum = '(' + num.substring(0,3) + ')' + num.substring(3,6) + '-' + num.substring(6,10);
     // for format xxx-xxx-xxxx
     newNum = num.substring(0,3) + '-' + num.substring(3,6) + '-' + num.substring(6,10);
     eval(nums[i]).value=newNum;
     }
   }
  }
}

</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function stringFilter (input) {
s = input.value;
filteredValues = " /-";     // Characters stripped out
var i;
var returnString = "";
for (i = 0; i < s.length; i++) {  // Search through string and append to unfiltered values to returnString.
var c = s.charAt(i);
if (filteredValues.indexOf(c) == -1) returnString += c;
}
input.value = returnString;
}
//  End -->
</script>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style60 {	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.style61 {font-size: 12px; font-weight: bold; }
.style63 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-style: italic; }
.style7 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #09468a;
}
.style8 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
-->
</style>
</head>

<!-- Google Code for Default Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_type = 'landing';
var google_conversion_id = 1071175607;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "669933";
//-->
</script>
<script language="JavaScript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="https://www.googleadservices.com/pagead/conversion/1071175607/extclk?script=0">
</noscript>

<body >
<table width="803" border="0" align="center" cellpadding="14" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="774" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="317" height="306" align="right" valign="top" ><img src="images/index_new/IRlogo_top.jpg" name="clickhere" width="317" height="76" border="0" usemap="#clickhereMap" id="clickhere"><br>
          <img src="images/index_new/IRlogo_bottom.jpg" width="317" height="230"></td>
        <td width="457" height="306" align="left" valign="top" class="style1" style="background-position:top; background-repeat:no-repeat;"><img src="images/index_new/astronaut.jpg" width="457" height="306"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252" valign="top"><table width="97%" border="0" cellpadding="0" cellspacing="0" bgcolor="1a6fab">
          <tr>
            <td colspan="2"><img src="images/index_new/topleft.gif" width="252" height="9"></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;<img src="images/VMA_logos.jpg" width="229" height="71">
              <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="072e52">
              <tr>
                <td width="246"><div class="style2" style="margin-left:23px; margin-right:23px; padding-top:10px;">If you need  your project printed in a hurry, but you want it all:  quality, price and service, then you&rsquo;ve come to the right place. <span class="style23">Our standard turn-around time is 5 to 7 working days <u><em>to your door!</em></u></span> And, we're  NOT a gang run printer like all of our competitors. Your job, no matter how small, is printed by itself to ensure the best color every time. That's why the biggest names in the business trust us with their  projects. You'd have to spend a  lot more money to get that kind of service from anyone else. We Guarantee 7 to 10 days to your door and if you need it  faster, we can print and deliver in just 3 working days.</div></td>
              </tr>
              <tr>
                <td><img src="images/index_new/crisisbottom.gif" width="246" height="15"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="6%">&nbsp;</td>
            <td width="94%">
              <div style="margin-left:17px; margin-right:17px; padding-top:5px; padding-bottom:50px;">
                <p class="style2"><span class="style23">Custom Folders <br>
                  Are Our Specialty</span><br>
      Do you need a folder that&rsquo;s out of the ordinary with an emboss, foil stamp, custom die, PMS color, or velcro tabs? No problem. We do it all for less money and less hassle than anyone in the business. Give us one try and you&rsquo;ll never go <br>
      anywhere else again!</p>
                <p class="style2"><strong><span class="style6">Products</span><br>
      Press Kits / Media Kits <br>
      Pocket Folders<br>
      Multipage Catalogs<br>
      Sales Sheets<br>
      Brochures<br>
      Posters<br>
      Business Cards<br>
      Letterhead<br>
      Envelopes<br>
      CD/DVD Sleeves &amp; Replication <br>
      Custom Orders</strong></p>
                <p><span class="style5"><span class="style6">Design Services</span><br>
      </span><span class="style2">Need a design that will help you make the sale, book your band or get your product placement? Let our award-winning creative team develop a design solution for your print collateral, website,multimedia presentation, or brand identity</span><span class="style5">.</span></p>
            </div></td>
          </tr>
          <tr>
            <td colspan="2"><img src="images/index_new/bottomleft.gif" width="252" height="12"></td>
          </tr>
        </table></td>
        <td width="28">&nbsp;</td>
        <td valign="top">
        <? if ($orderstatus == "Declined") { ?>
        <font face="Verdana,Arial" >Your payment has been declined.  The reason given is:<br><br>
        <? print ($response); ?></font>
        <? } else { ?>
        <font face="Verdana,Arial" >Your payment has been approved.<br><br></font>
        <table width="100%" border="0" align="center">
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Order ID:</font></td>
              <td ><font face="Verdana,Arial" size="-1"><? print($orderid); ?></font> </td>
            </tr>
            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">PRODUCT INFORMATION</div></td>
            </tr>
            <tr>
              <td colspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td width="49%" valign="top" class="style8"><div align="right" class="style60"><strong>Quantity:</strong></div></td>
                  <td width="65%" class="style8"><span class="style60"><? print($_POST['quantity']); ?></span></td>
                </tr>
                <tr>
                  <td width="49%" valign="top" class="style8"><div align="right" class="style60"><strong>Pocket Folder Size:</strong></div></td>
                  <td width="65%" class="style8"><span class="style60"><? print($_POST['size']); ?></span></td>
                </tr>
                <tr>
                  <td colspan="2" class="style7"><img src="images/index_new/graybar.gif" width="442" height="25"></td>
                </tr>
                <tr>
                  <td colspan="2" class="style7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="48%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td class="style7">Side I:</td>
                          <td colspan="2" class="style8">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Ink Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['inkcolors_side1']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Add PMS Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['pmscolors_side1']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Add PMS Metallic Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['pmsmetalcolors_side1']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Special Finishing Options:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['specialfinish_side1']); ?></span></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8"><div align="right" class="style61">Special Treatments:</div></td>
                          <td valign="top" class="style8"><span class="style60">
                            <? if ($_POST['foilstampoption_side1'] != 'None') { ?>
                            Foil Stamp
                            <? } ?>
                          </span></td>
                          <td valign="top" class="style60"><span class="style60">
                            <? if ($_POST['foilstampoption_side1'] != 'None') { ?>
                            <? print($_POST['foilstampoption_side1']); ?>
                            <? } ?>
                          </span></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8">&nbsp;</td>
                          <td valign="top" class="style8"><span class="style60"><? print($_POST['emboss_side1']); ?></span></td>
                          <td valign="top" class="style60"></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8">&nbsp;</td>
                          <td valign="top" class="style8"><span class="style60"><? print($_POST['spotuv_side1']); ?></span></td>
                          <td valign="top" class="style60"></td>
                        </tr>

                      </table></td>
                      <td width="4%" background="images/index_new/priceleft.gif" style="background-repeat:repeat-y">&nbsp;</td>
                      <td width="48%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td class="style7">Side II:</td>
                          <td colspan="2" class="style8">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Ink Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['inkcolors_side2']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Add PMS Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['pmscolors_side2']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Add PMS Metallic Colors:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['pmsmetalcolors_side2']); ?></span></td>
                        </tr>
                        <tr>
                          <td class="style8"><div align="right" class="style61">Special Finishing Options:</div></td>
                          <td colspan="2" class="style8"><span class="style60"><? print($_POST['specialfinish_side2']); ?></span></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8"><div align="right" class="style61">Special Treatments:</div></td>
                          <td valign="top" class="style8"><span class="style60">
                            <? if ($_POST['foilstampoption_side2'] != 'None') { ?>
                            Foil Stamp
                            <? } ?>
                          </span></td>
                          <td valign="top" class="style60"><span class="style60">
                            <? if ($_POST['foilstampoption_side2'] != 'None') { ?>
                            <? print($_POST['foilstampoption_side2']); ?>
                            <? } ?>
                          </span></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8">&nbsp;</td>
                          <td valign="top" class="style8"><span class="style60"><? print($_POST['emboss_side2']); ?></span></td>
                          <td valign="top" class="style60"></td>
                        </tr>
                        <tr>
                          <td valign="top" class="style8">&nbsp;</td>
                          <td valign="top" class="style8"><span class="style60"><? print($_POST['spotuv_side2']); ?></span></td>
                          <td valign="top" class="style60"></td>
                        </tr>

                      </table></td>
                    </tr>
                  </table></td>
                  </tr>


                <tr>
                  <td colspan="2" class="style8"><span class="style7"><img src="images/index_new/graybar.gif" width="442" height="25"></span></td>
                </tr>
                <tr>
                  <td colspan="2" class="style8"><span class="style7">Custom Options:</span></td>
                </tr>
                <tr>
                  <td valign="top" class="style8"><div align="right" class="style60"><strong>Die Cut:</strong></div></td>
                  <td class="style8"><span class="style60"><? print($_POST['diecut']); ?></span></td>
                </tr>
<? if ($_POST['velcrotabs'] != "") { ?>
                <tr>
                  <td class="style8"><div align="right" class="style61">Velcro Tabs:</div></td>
                  <td class="style60"><span class="style60"><? print($_POST['velcrotabs']); ?></span></td>
                </tr>
<? } ?>
                <tr>
                  <td class="style8"><div align="right" class="style61">Quantity Desired:</div></td>
                  <td class="style8"><span class="style60"><? print($_POST['quantity']); ?></span></td>
                </tr>
                <tr>
                  <td colspan="2" class="style8"><span class="style7"><img src="images/index_new/graybar.gif" width="442" height="25"></span></td>
                </tr>
                <tr>
                  <td class="style8"><div align="right"><span class="style7">Subtotal:</span></div></td>
                  <td class="style60"><span class="style60"><? print($_POST['subtotal']); ?></span></td>
                </tr>
                <tr>
                  <td valign="top" class="style8"><div align="right"><span class="style7">Shipping:</span></div></td>
                  <td class="style60"><span class="style60"><? print($_POST['shipping']); ?></span></td>
                </tr>
                <tr>
                  <td class="style8"><div align="right"><span class="style7">TOTAL:</span></div></td>
                  <td class="style60"><span class="style60"><? print($_POST['total']); ?></span></td>
                </tr>
                <tr>
                  <td colspan="2" class="style8"><span class="style7"><img src="images/index_new/graybar.gif" width="442" height="25"></span></td>
                </tr>
<?
  setlocale(LC_MONETARY, 'en_US');
?>
                <tr>
                  <td class="style8"><div align="right"><span class="style7">Amount Charged to<br>
                        Credit Card:</span></div></td>
                  <td class="style60"><span class="style60"><? print(money_format('%.2n',str_replace("$","",$_POST['total'])/2)); ?></span></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">BILLING INFORMATION</div></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Name:</font></td>
              <td ><font face="Verdana,Arial" size="-1"><? print($_POST['Name']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Company:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Company']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Address:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Address']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> City:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['City']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> State:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['State']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Zip:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ZIP']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Country:</font> </td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Country']); ?></font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> E-mail:</font> </td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Email']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Phone:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Phone']); ?></font> </td>
            </tr>

            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Fax:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['Fax']); ?></font> </td>
            </tr>
            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">SHIPPING INFORMATION</div></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Name:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipName']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Company:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipCompany']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Address:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipAddress']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> City:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipCity']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> State:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipState']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Zip:</font></td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipZIP']); ?></font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Country:</font> </td>
              <td><font face="Verdana,Arial" size="-1"><? print($_POST['ShipCountry']); ?></font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Comments:</font></td>
              <td valign="top"><font face="Verdana,Arial" size="-1"><? print($_POST['comments']); ?></font></td>
            </tr>

            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">PAYMENT INFORMATION</div></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td valign="top"><img src="images/credit_cards.gif" width="167" height="43"></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Select Payment:</font></td>
              <td valign="top" bgcolor="#FFFFFF"><font face="Verdana,Arial" size="-1"><? print($_POST['cardtype']); ?></font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Card #:</font></td>
              <td valign="top"><font face="Arial" size="-1">XXXX-XXXX-XXXX-<? print($credit_card_number2); ?></font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Exp. Date:</font></td>
              <td valign="top"><font face="Verdana,Arial" size="-1">Month: <? print($_POST['exp_month']); ?></font>

                &nbsp;&nbsp;&nbsp;&nbsp;<font face="Verdana,Arial" size="-1">Year: <? print($_POST['exp_year']); ?></font>
                </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Sec. Code:</font></td>
              <td valign="top"><font face="Arial" size="-1"><? print($_POST['sec_code']); ?></font></td>
            </tr>
          </table>
          <br>
          <br><center><font face="Verdana,Arial">Click <a href="http://www.inkrockit.com/upload/">here</a> to upload your artwork</font></center>
        <? } ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="clickhereMap"><area shape="rect" coords="23,38,122,70" href="javascript:requestSamples();" onMouseOver="MM_swapImage('clickhere','','images/index_new/IRlogo_top_ro.jpg',1)" onMouseOut="MM_swapImgRestore()">
</map>
</body>
</html>
