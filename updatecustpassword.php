<?
  $updated = 'N';
   
  if (isset($_SERVER['QUERY_STRING'])) {
    $str = $_SERVER['QUERY_STRING'];
    parse_str($str);
  }

  if (isset($_POST['password'])) {

	  $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
	  mysql_select_db ("db37838_imageteam_com_pca");

      $sql = "UPDATE `ink_customers` SET `password` = '" . $_POST['password'] . "' WHERE id = " . $_POST['custid'];
      $queryexe = mysql_query($sql);
	  
	  $updated = 'Y';

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
<!--

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
//  En
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style67 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
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
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1071175607/extclk?script=0">
</noscript>

<body onLoad="MM_preloadImages('images/index_new/IRlogo_top_ro.jpg')">
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
        <? if ($updated == 'Y') { ?>
        <p><br>
          </p>
          <p align="center" class="style67">We have updated your password.</p>
          <p align="center" class="style67">You can close this window and continue with your login on the payment screen.</p>
          <p align="center" class="style67"><a href="#" onClick="window.close();">Close</a></p>
        <? } else { ?>  
        <form id='form1' name='form1' method='post' action='updatecustpassword.php'>
          <p align="center">
            <input type='hidden' name='custid' value='<? print ($c); ?>'>
              <FONT face='Lucida Grande, Verdana, Helvetica, Arial'><SPAN style='FONT-SIZE: 12px'>
              Please enter the password you would like for your account.</span></font></p>
          <p align="center"><FONT face='Lucida Grande, Verdana, Helvetica, Arial'><SPAN style='FONT-SIZE: 12px'>Password:</span></font> 
              <input type='text' name='password' id='password' />
              </p>
          <p align="center">
            <input type='submit' name='button' id='button' value='Submit' />
          </p>
        </form>
        <? } ?>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="clickhereMap"><area shape="rect" coords="23,38,122,70" href="javascript:requestSamples();" onMouseOver="MM_swapImage('clickhere','','images/index_new/IRlogo_top_ro.jpg',1)" onMouseOut="MM_swapImgRestore()">
</map>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-343319-1";
urchinTracker();
</script>
</body>
</html>
