<?
  session_start();
  $_SESSION['search_id'] = $HTTP_REFERER;

  $name = '';
  $company = '';
  $address = '';
  $city = '';
  $state = '';
  $zip = '';
  $country = '';
  $email = '';
  $phone = '';
  $shipname = '';
  $shipcompany = '';
  $shipaddress = '';
  $shipcity = '';
  $shipstate = '';
  $shipzip = '';
  $shipcountry = '';

  $lookup = '';
  $found = '';

  if (isset($_POST['username2'])) {
    $lookup = 'N';
    if (isset($_POST['password2']) && $_POST['password2'] != '') {
	    $password = 'Y';

		$dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
		mysql_select_db ("db37838_imageteam_com_pca");
		$Query = "SELECT * FROM ink_customers WHERE username = '" . $_POST['username2'] . "' AND password = '" . $_POST['password2'] . "'";
		$queryexe = mysql_query($Query);
		if ($myrow = mysql_fetch_array($queryexe)) {
		  $custid = $myrow["id"];
		  $name = $myrow["name"];
		  $company = $myrow["company"];
		  $address = str_replace("\'", "'",$myrow["address"]);
		  $city = str_replace("\'", "'",$myrow["city"]);
		  $state = str_replace("\'", "'",$myrow["state"]);
		  $zip = str_replace("\'", "'",$myrow["zip"]);
		  $country = str_replace("\'", "'",$myrow["country"]);
		  $email = str_replace("\'", "'",$myrow["email"]);
		  $phone = $myrow["phone"];
		  $shipname = $myrow["shipname"];
		  $shipcompany = $myrow["shipcompany"];
		  $shipaddress = str_replace("\'", "'",$myrow["shipaddress"]);
		  $shipcity = str_replace("\'", "'",$myrow["shipcity"]);
		  $shipstate = str_replace("\'", "'",$myrow["shipstate"]);
		  $shipzip = str_replace("\'", "'",$myrow["shipzip"]);
		  $shipcountry = str_replace("\'", "'",$myrow["shipcountry"]);
		  $lookup = 'Y';
		}
	} else {
	    $password = 'N';
		$dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
		mysql_select_db ("db37838_imageteam_com_pca");
		$Query = "SELECT * FROM ink_customers WHERE username = '" . $_POST['username2'] . "' AND password = ''";
		$queryexe = mysql_query($Query);
		if ($myrow = mysql_fetch_array($queryexe)) {
		  $custid2 = $myrow["id"];
		  $name2 = $myrow["name"];
		  $email2 = str_replace("\'", "'",$myrow["email"]);
		  $found = 'Y';
		}

        if ($found == 'Y') {
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: Don Traub <dtraub@inkrockit.com>\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();

			$message2 = "<HTML><BODY>";
			$message2 .= "<FONT face='Lucida Grande, Verdana, Helvetica, Arial'><SPAN style='FONT-SIZE: 12px'>";
			$message2 .= "Dear " . $name2 . ",<BR><BR>";
			$message2 .= "Thank you for wanting to create an account with InkRockit. Your username is your email address: " . $email2 . ".  Please click on the link below to enter your password.<BR><BR>";
			$message2 .= "<FONT face='Lucida Grande, Verdana, Helvetica, Arial'><SPAN style='FONT-SIZE: 12px'><a href='http://www.inkrockit.com/updatecustpassword.php?c=".$custid2."'>Enter Password</a></span></font><br><br>";
			$message2 .= "Respectfully yours,<BR></SPAN></FONT><SPAN style='FONT-SIZE: 12px'><FONT face='Verdana, Helvetica, Arial'><BR></FONT><FONT face='Helvetica, Verdana, Arial'><BR></FONT><FONT face=Arial><B>Don Traub<BR></B></FONT></SPAN><FONT face=Arial><FONT color=#bdbdbd><SPAN style='FONT-SIZE: 11px'>-----------------<BR></SPAN></FONT>";
			$message2 .= "<FONT color=#fa6400><FONT size=2><SPAN style='FONT-SIZE: 10px'><B>INKROCKIT</B></SPAN></FONT></FONT><FONT size=2><SPAN style='FONT-SIZE: 10px'><FONT color=#7b7b7b> &nbsp;</FONT></SPAN></FONT><SPAN style='FONT-SIZE: 11px'>| San Francisco | Orlando | Atlanta | Hong Kong<BR>U.S. Sales Office: 205 Springview Dr,, Sanford, FL 32773<BR>800.900.5632 | c: 386.299.3300 | f: 407.842.7965<BR><A href='http://www.inkrockit.com'>http://www.inkrockit.com</A> | http;//www.imageteam.com<BR></SPAN></FONT><FONT face='Lucida Grande, Verdana, Helvetica, Arial'><SPAN style='FONT-SIZE: 12px'><BR><BR>";
			$message2 .= "<img src='http://www.inkrockit.com/images/SAMPLE_PACK.jpg' width='540' height='360'><BR></SPAN></FONT>";
			$message2 .= "</BODY></HTML>";

			   mail($email2, "Create Your InkRockit Account!", $message2, $headers);


    }

	}
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
.style66 {color: #FF0000}
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
        <td valign="top"><form name="form1" method="post" action="payment.php">
        <input type="hidden" name="size" value="<? print($_POST['size']); ?>">
        <input type="hidden" name="inkcolors_side1" value="<? print($_POST['inkcolors_side1']); ?>">
        <input type="hidden" name="pmscolors_side1" value="<? print($_POST['pmscolors_side1']); ?>">
        <input type="hidden" name="pmsmetalcolors_side1" value="<? print($_POST['pmsmetalcolors_side1']); ?>">
        <input type="hidden" name="specialfinish_side1" value="<? print($_POST['specialfinish_side1']); ?>">
        <input type="hidden" name="foilstampoption_side1" value="<? print($_POST['foilstampoption_side1']); ?>">
        <input type="hidden" name="emboss_side1" value="<? print($_POST['emboss_side1']); ?>">
        <input type="hidden" name="spotuv_side1" value="<? print($_POST['spotuv_side1']); ?>">
        <input type="hidden" name="inkcolors_side2" value="<? print($_POST['inkcolors_side2']); ?>">
        <input type="hidden" name="pmscolors_side2" value="<? print($_POST['pmscolors_side2']); ?>">
        <input type="hidden" name="pmsmetalcolors_side2" value="<? print($_POST['pmsmetalcolors_side2']); ?>">
        <input type="hidden" name="specialfinish_side2" value="<? print($_POST['specialfinish_side2']); ?>">
        <input type="hidden" name="foilstampoption_side2" value="<? print($_POST['foilstampoption_side2']); ?>">
        <input type="hidden" name="emboss_side2" value="<? print($_POST['emboss_side2']); ?>">
        <input type="hidden" name="spotuv_side2" value="<? print($_POST['spotuv_side2']); ?>">
        <input type="hidden" name="diecut" value="<? print($_POST['diecut']); ?>">
        <input type="hidden" name="velcrotabs" value="<? print($_POST['velcrotabs']); ?>">
        <input type="hidden" name="quantity" value="<? print($_POST['quantity']); ?>">
        <input type="hidden" name="subtotal" value="<? print($_POST['subtotal']); ?>">
        <input type="hidden" name="shipping" value="<? print($_POST['shipping']); ?>">
        <input type="hidden" name="shippingoption" value="<? print($_POST['shippingoption']); ?>">
        <input type="hidden" name="total" value="<? print($_POST['total']); ?>">
        <input type="hidden" value="Y" name="lookup">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <? if ($lookup != 'Y') { ?>
            <tr>
              <td class="style65">
              <? if ($lookup == 'N') { ?>
                <? if ($password == 'Y') { ?>
              <span class="style66">We were unable to locate your account.  Please re-enter your username/password or create a new account below.</span>
                <? } else { ?>
                <? if ($password == 'N' && $found !='Y') { ?>
                 <span class="style66">We were unable to locate your email address.  Please create a new account below.</span>
                <? } else { ?>
                 <span class="style66">We located your email address.  An email was sent to this address with the steps to create a username and password for your account.</span>
                <? } ?>
                <? } ?>
              <? } else { ?>
              Enter your username/password to load your account information or enter your information below to create a new account.
              If you have ordered a sample pack from us before, you can enter your email address for us to look up your previous information.<? } ?>              </td>
            </tr>
            <tr>
              <td class="style65">Username/Email: <font face="Verdana,Arial" size="-1">
                <input name="username2" type="Text" id="username2" size="15">
              </font>Password: <font face="Verdana,Arial" size="-1">
              <input name="password2" type="password" id="password2" size="15">
              </font>
              <input type="submit" name="button" id="button" value="Login"></td>
            </tr>
  <? } ?>
          </table>
                </form>

        <hr>
        <form method="POST" action="confirm.php" name="FrontPage_Form1" id="FrontPage_Form1" language="JavaScript">
        <input type="hidden" name="custid" value="<? print($custid); ?>">
        <input type="hidden" name="size" value="<? print($_POST['size']); ?>">
        <input type="hidden" name="inkcolors_side1" value="<? print($_POST['inkcolors_side1']); ?>">
        <input type="hidden" name="pmscolors_side1" value="<? print($_POST['pmscolors_side1']); ?>">
        <input type="hidden" name="pmsmetalcolors_side1" value="<? print($_POST['pmsmetalcolors_side1']); ?>">
        <input type="hidden" name="specialfinish_side1" value="<? print($_POST['specialfinish_side1']); ?>">
        <input type="hidden" name="foilstampoption_side1" value="<? print($_POST['foilstampoption_side1']); ?>">
        <input type="hidden" name="emboss_side1" value="<? print($_POST['emboss_side1']); ?>">
        <input type="hidden" name="spotuv_side1" value="<? print($_POST['spotuv_side1']); ?>">
        <input type="hidden" name="inkcolors_side2" value="<? print($_POST['inkcolors_side2']); ?>">
        <input type="hidden" name="pmscolors_side2" value="<? print($_POST['pmscolors_side2']); ?>">
        <input type="hidden" name="pmsmetalcolors_side2" value="<? print($_POST['pmsmetalcolors_side2']); ?>">
        <input type="hidden" name="specialfinish_side2" value="<? print($_POST['specialfinish_side2']); ?>">
        <input type="hidden" name="foilstampoption_side2" value="<? print($_POST['foilstampoption_side2']); ?>">
        <input type="hidden" name="emboss_side2" value="<? print($_POST['emboss_side2']); ?>">
        <input type="hidden" name="spotuv_side2" value="<? print($_POST['spotuv_side2']); ?>">
        <input type="hidden" name="diecut" value="<? print($_POST['diecut']); ?>">
        <input type="hidden" name="velcrotabs" value="<? print($_POST['velcrotabs']); ?>">
        <input type="hidden" name="quantity" value="<? print($_POST['quantity']); ?>">
        <input type="hidden" name="subtotal" value="<? print($_POST['subtotal']); ?>">
        <input type="hidden" name="shipping" value="<? print($_POST['shipping']); ?>">
        <input type="hidden" name="shippingoption" value="<? print($_POST['shippingoption']); ?>">
        <input type="hidden" name="total" value="<? print($_POST['total']); ?>">
          <center class="style65">
            Note: Be sure to enter the information below
              exactly as it appears on your credit card. All data is kept confidential.<br>
              * Indicates information is required.<br>
              <br>
          </center>
          <table width="100%" border="0" align="center">
            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">BILLING INFORMATION</div></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Name*:</font></td>
              <td ><font face="Verdana,Arial" size="-1">
                <input name="Name" type="Text" id="Name" size="30" value="<? print ($name); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Company:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input type="Text" name="Company" size="30" value="<? print ($company); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Address*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="Address" type="Text" id="Address" size="30" value="<? print ($address); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> City*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="City" type="Text" id="City" size="25" value="<? print ($city); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> State*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <select name="State" size="1">
                  <option selected value></option>
                  <option value="AL" <? if ($state == 'AL') { ?>selected<? } ?>>AL</option>
                  <option value="AK" <? if ($state == 'AK') { ?>selected<? } ?>>AK</option>
                  <option value="AZ" <? if ($state == 'AZ') { ?>selected<? } ?>>AZ</option>
                  <option value="AR" <? if ($state == 'AR') { ?>selected<? } ?>>AR</option>
                  <option value="CA" <? if ($state == 'CA') { ?>selected<? } ?>>CA</option>
                  <option value="CO" <? if ($state == 'CO') { ?>selected<? } ?>>CO</option>
                  <option value="CT" <? if ($state == 'CT') { ?>selected<? } ?>>CT</option>
                  <option value="DE" <? if ($state == 'DE') { ?>selected<? } ?>>DE</option>
                  <option value="DC" <? if ($state == 'DC') { ?>selected<? } ?>>DC</option>
                  <option value="FL" <? if ($state == 'FL') { ?>selected<? } ?>>FL</option>
                  <option value="GA" <? if ($state == 'GA') { ?>selected<? } ?>>GA</option>
                  <option value="HI" <? if ($state == 'HI') { ?>selected<? } ?>>HI</option>
                  <option value="ID" <? if ($state == 'ID') { ?>selected<? } ?>>ID</option>
                  <option value="IL" <? if ($state == 'IL') { ?>selected<? } ?>>IL</option>
                  <option value="IN" <? if ($state == 'IN') { ?>selected<? } ?>>IN</option>
                  <option value="IA" <? if ($state == 'IA') { ?>selected<? } ?>>IA</option>
                  <option value="KS" <? if ($state == 'KS') { ?>selected<? } ?>>KS</option>
                  <option value="KY" <? if ($state == 'KY') { ?>selected<? } ?>>KY</option>
                  <option value="LA" <? if ($state == 'LA') { ?>selected<? } ?>>LA</option>
                  <option value="ME" <? if ($state == 'ME') { ?>selected<? } ?>>ME</option>
                  <option value="MD" <? if ($state == 'MD') { ?>selected<? } ?>>MD</option>
                  <option value="MA" <? if ($state == 'MA') { ?>selected<? } ?>>MA</option>
                  <option value="MI" <? if ($state == 'MI') { ?>selected<? } ?>>MI</option>
                  <option value="MN" <? if ($state == 'MN') { ?>selected<? } ?>>MN</option>
                  <option value="MS" <? if ($state == 'MS') { ?>selected<? } ?>>MS</option>
                  <option value="MO" <? if ($state == 'MO') { ?>selected<? } ?>>MO</option>
                  <option value="MT" <? if ($state == 'MT') { ?>selected<? } ?>>MT</option>
                  <option value="NE" <? if ($state == 'NE') { ?>selected<? } ?>>NE</option>
                  <option value="NV" <? if ($state == 'NV') { ?>selected<? } ?>>NV</option>
                  <option value="NH" <? if ($state == 'NH') { ?>selected<? } ?>>NH</option>
                  <option value="NJ" <? if ($state == 'NJ') { ?>selected<? } ?>>NJ</option>
                  <option value="NM" <? if ($state == 'NM') { ?>selected<? } ?>>NM</option>
                  <option value="NY" <? if ($state == 'NY') { ?>selected<? } ?>>NY</option>
                  <option value="NC" <? if ($state == 'NC') { ?>selected<? } ?>>NC</option>
                  <option value="ND" <? if ($state == 'ND') { ?>selected<? } ?>>ND</option>
                  <option value="OH" <? if ($state == 'OH') { ?>selected<? } ?>>OH</option>
                  <option value="OK" <? if ($state == 'OK') { ?>selected<? } ?>>OK</option>
                  <option value="OR" <? if ($state == 'OR') { ?>selected<? } ?>>OR</option>
                  <option value="PA" <? if ($state == 'PA') { ?>selected<? } ?>>PA</option>
                  <option value="RI" <? if ($state == 'RI') { ?>selected<? } ?>>RI</option>
                  <option value="SC" <? if ($state == 'SC') { ?>selected<? } ?>>SC</option>
                  <option value="SD" <? if ($state == 'SD') { ?>selected<? } ?>>SD</option>
                  <option value="TN" <? if ($state == 'TN') { ?>selected<? } ?>>TN</option>
                  <option value="TX" <? if ($state == 'TX') { ?>selected<? } ?>>TX</option>
                  <option value="UT" <? if ($state == 'UT') { ?>selected<? } ?>>UT</option>
                  <option value="VT" <? if ($state == 'VT') { ?>selected<? } ?>>VT</option>
                  <option value="VA" <? if ($state == 'VA') { ?>selected<? } ?>>VA</option>
                  <option value="WA" <? if ($state == 'WA') { ?>selected<? } ?>>WA</option>
                  <option value="WV" <? if ($state == 'WV') { ?>selected<? } ?>>WV</option>
                  <option value="WI" <? if ($state == 'WI') { ?>selected<? } ?>>WI</option>
                  <option value="WY" <? if ($state == 'WY') { ?>selected<? } ?>>WY</option>
                  <option value="AB" <? if ($state == 'AB') { ?>selected<? } ?>>Alberta</option>
                  <option value="BC" <? if ($state == 'BC') { ?>selected<? } ?>>British Columbia</option>
                  <option value="MB" <? if ($state == 'MB') { ?>selected<? } ?>>Manitoba</option>
                  <option value="NB" <? if ($state == 'NB') { ?>selected<? } ?>>New Brunswick</option>
                  <option value="NL" <? if ($state == 'NL') { ?>selected<? } ?>>Newfoundland and Labrador</option>
                  <option value="NT" <? if ($state == 'NT') { ?>selected<? } ?>>Northwest Territories</option>
                  <option value="NS" <? if ($state == 'NS') { ?>selected<? } ?>>Nova Scotia</option>
                  <option value="NU" <? if ($state == 'NU') { ?>selected<? } ?>>Nunavut</option>
                  <option value="ON" <? if ($state == 'ON') { ?>selected<? } ?>>Ontario</option>
                  <option value="PE" <? if ($state == 'PE') { ?>selected<? } ?>>Prince Edward Island</option>
                  <option value="QC" <? if ($state == 'QC') { ?>selected<? } ?>>Quebec</option>
                  <option value="SK" <? if ($state == 'SK') { ?>selected<? } ?>>Saskatchewan</option>
                  <option value="YT" <? if ($state == 'YT') { ?>selected<? } ?>>Yukon</option>
                </select>
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Zip*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ZIP" type="Text" id="ZIP" size="7" value="<? print ($zip); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Country*:</font> </td>
              <td><select name="Country" id="Country">
                  <option value="United States" <? if ($country == 'United States') { ?>selected<? } ?>>United States</option>
                  <option value="Canada" <? if ($country == 'Canada') { ?>selected<? } ?>>Canada</option>
                </select>              </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> E-mail*:</font> </td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="Email" type="Text" id="Email" size="30" value="<? print ($email); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Phone*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="Phone" type="Text" id="Phone" size="30" onBlur="formatPhone(this);"  value="<? print ($phone); ?>">
              </font> </td>
            </tr>

            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Fax:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input type="Text" name="Fax" size="30" onBlur="formatPhone(this);">
              </font> </td>
            </tr>
  <? if ($lookup != 'Y') { ?>
            <tr>
              <td colspan="2"><font face="Verdana,Arial" size="-1">Enter a username and password if you would like to create an account</font></td>
              </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Username:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input type="Text" name="username" size="30">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Password:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input type="password" name="password" size="30">
              </font> </td>
            </tr>
  <? } ?>
            <tr>
              <td colspan="2" align="right" bgcolor="#333333"><div align="left" class="style64">SHIPPING INFORMATION</div></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><input name="sameasbill" type="checkbox" id="sameasbill" value="Y" onClick="document.FrontPage_Form1.ShipName.value = document.FrontPage_Form1.Name.value;document.FrontPage_Form1.ShipCompany.value = document.FrontPage_Form1.Company.value;document.FrontPage_Form1.ShipAddress.value = document.FrontPage_Form1.Address.value;document.FrontPage_Form1.ShipCity.value = document.FrontPage_Form1.City.value;document.FrontPage_Form1.ShipZIP.value = document.FrontPage_Form1.ZIP.value;document.FrontPage_Form1.ShipCountry.value = document.FrontPage_Form1.Country.value;document.FrontPage_Form1.ShipState.value = document.FrontPage_Form1.State.value;">
                  <font face="Verdana,Arial" size="-1">Check here if same as billing</font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Name*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ShipName" type="Text" id="ShipName" size="30" value="<? print ($shipname); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Company:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ShipCompany" type="Text" id="ShipCompany" size="30" value="<? print ($shipcompany); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Address*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ShipAddress" type="Text" id="ShipAddress" size="30" value="<? print ($shipaddress); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> City*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ShipCity" type="Text" id="ShipCity" size="25" value="<? print ($shipcity); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> State*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <select name="ShipState" size="1" id="ShipState">
                  <option selected value></option>
                  <option value="AL" <? if ($shipstate == 'AL') { ?>selected<? } ?>>AL</option>
                  <option value="AK" <? if ($shipstate == 'AK') { ?>selected<? } ?>>AK</option>
                  <option value="AZ" <? if ($shipstate == 'AZ') { ?>selected<? } ?>>AZ</option>
                  <option value="AR" <? if ($shipstate == 'AR') { ?>selected<? } ?>>AR</option>
                  <option value="CA" <? if ($shipstate == 'CA') { ?>selected<? } ?>>CA</option>
                  <option value="CO" <? if ($shipstate == 'CO') { ?>selected<? } ?>>CO</option>
                  <option value="CT" <? if ($shipstate == 'CT') { ?>selected<? } ?>>CT</option>
                  <option value="DE" <? if ($shipstate == 'DE') { ?>selected<? } ?>>DE</option>
                  <option value="DC" <? if ($shipstate == 'DC') { ?>selected<? } ?>>DC</option>
                  <option value="FL" <? if ($shipstate == 'FL') { ?>selected<? } ?>>FL</option>
                  <option value="GA" <? if ($shipstate == 'GA') { ?>selected<? } ?>>GA</option>
                  <option value="HI" <? if ($shipstate == 'HI') { ?>selected<? } ?>>HI</option>
                  <option value="ID" <? if ($shipstate == 'ID') { ?>selected<? } ?>>ID</option>
                  <option value="IL" <? if ($shipstate == 'IL') { ?>selected<? } ?>>IL</option>
                  <option value="IN" <? if ($shipstate == 'IN') { ?>selected<? } ?>>IN</option>
                  <option value="IA" <? if ($shipstate == 'IA') { ?>selected<? } ?>>IA</option>
                  <option value="KS" <? if ($shipstate == 'KS') { ?>selected<? } ?>>KS</option>
                  <option value="KY" <? if ($shipstate == 'KY') { ?>selected<? } ?>>KY</option>
                  <option value="LA" <? if ($shipstate == 'LA') { ?>selected<? } ?>>LA</option>
                  <option value="ME" <? if ($shipstate == 'ME') { ?>selected<? } ?>>ME</option>
                  <option value="MD" <? if ($shipstate == 'MD') { ?>selected<? } ?>>MD</option>
                  <option value="MA" <? if ($shipstate == 'MA') { ?>selected<? } ?>>MA</option>
                  <option value="MI" <? if ($shipstate == 'MI') { ?>selected<? } ?>>MI</option>
                  <option value="MN" <? if ($shipstate == 'MN') { ?>selected<? } ?>>MN</option>
                  <option value="MS" <? if ($shipstate == 'MS') { ?>selected<? } ?>>MS</option>
                  <option value="MO" <? if ($shipstate == 'MO') { ?>selected<? } ?>>MO</option>
                  <option value="MT" <? if ($shipstate == 'MT') { ?>selected<? } ?>>MT</option>
                  <option value="NE" <? if ($shipstate == 'NE') { ?>selected<? } ?>>NE</option>
                  <option value="NV" <? if ($shipstate == 'NV') { ?>selected<? } ?>>NV</option>
                  <option value="NH" <? if ($shipstate == 'NH') { ?>selected<? } ?>>NH</option>
                  <option value="NJ" <? if ($shipstate == 'NJ') { ?>selected<? } ?>>NJ</option>
                  <option value="NM" <? if ($shipstate == 'NM') { ?>selected<? } ?>>NM</option>
                  <option value="NY" <? if ($shipstate == 'NY') { ?>selected<? } ?>>NY</option>
                  <option value="NC" <? if ($shipstate == 'NC') { ?>selected<? } ?>>NC</option>
                  <option value="ND" <? if ($shipstate == 'ND') { ?>selected<? } ?>>ND</option>
                  <option value="OH" <? if ($shipstate == 'OH') { ?>selected<? } ?>>OH</option>
                  <option value="OK" <? if ($shipstate == 'OK') { ?>selected<? } ?>>OK</option>
                  <option value="OR" <? if ($shipstate == 'OR') { ?>selected<? } ?>>OR</option>
                  <option value="PA" <? if ($shipstate == 'PA') { ?>selected<? } ?>>PA</option>
                  <option value="RI" <? if ($shipstate == 'RI') { ?>selected<? } ?>>RI</option>
                  <option value="SC" <? if ($shipstate == 'SC') { ?>selected<? } ?>>SC</option>
                  <option value="SD" <? if ($shipstate == 'SD') { ?>selected<? } ?>>SD</option>
                  <option value="TN" <? if ($shipstate == 'TN') { ?>selected<? } ?>>TN</option>
                  <option value="TX" <? if ($shipstate == 'TX') { ?>selected<? } ?>>TX</option>
                  <option value="UT" <? if ($shipstate == 'UT') { ?>selected<? } ?>>UT</option>
                  <option value="VT" <? if ($shipstate == 'VT') { ?>selected<? } ?>>VT</option>
                  <option value="VA" <? if ($shipstate == 'VA') { ?>selected<? } ?>>VA</option>
                  <option value="WA" <? if ($shipstate == 'WA') { ?>selected<? } ?>>WA</option>
                  <option value="WV" <? if ($shipstate == 'WV') { ?>selected<? } ?>>WV</option>
                  <option value="WI" <? if ($shipstate == 'WI') { ?>selected<? } ?>>WI</option>
                  <option value="WY" <? if ($shipstate == 'WY') { ?>selected<? } ?>>WY</option>
                  <option value="AB" <? if ($shipstate == 'AB') { ?>selected<? } ?>>Alberta</option>
                  <option value="BC" <? if ($shipstate == 'BC') { ?>selected<? } ?>>British Columbia</option>
                  <option value="MB" <? if ($shipstate == 'MB') { ?>selected<? } ?>>Manitoba</option>
                  <option value="NB" <? if ($shipstate == 'NB') { ?>selected<? } ?>>New Brunswick</option>
                  <option value="NL" <? if ($shipstate == 'NL') { ?>selected<? } ?>>Newfoundland and Labrador</option>
                  <option value="NT" <? if ($shipstate == 'NT') { ?>selected<? } ?>>Northwest Territories</option>
                  <option value="NS" <? if ($shipstate == 'NS') { ?>selected<? } ?>>Nova Scotia</option>
                  <option value="NU" <? if ($shipstate == 'NU') { ?>selected<? } ?>>Nunavut</option>
                  <option value="ON" <? if ($shipstate == 'ON') { ?>selected<? } ?>>Ontario</option>
                  <option value="PE" <? if ($shipstate == 'PE') { ?>selected<? } ?>>Prince Edward Island</option>
                  <option value="QC" <? if ($shipstate == 'QC') { ?>selected<? } ?>>Quebec</option>
                  <option value="SK" <? if ($shipstate == 'SK') { ?>selected<? } ?>>Saskatchewan</option>
                  <option value="YT" <? if ($shipstate == 'YT') { ?>selected<? } ?>>Yukon</option>
                </select>
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Zip*:</font></td>
              <td><font face="Verdana,Arial" size="-1">
                <input name="ShipZIP" type="Text" id="ShipZIP" size="7" value="<? print ($shipzip); ?>">
              </font> </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1"> Country*:</font> </td>
              <td><select name="ShipCountry" id="ShipCountry">
                  <option value="United States" <? if ($shipcountry == 'United States') { ?>selected<? } ?>>United States</option>
                  <option value="Canada" <? if ($shipcountry == 'Canada') { ?>selected<? } ?>>Canada</option>
                </select>              </td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Comments:</font></td>
              <td valign="top"><textarea rows="3" name="comments" cols="40"></textarea>              </td>
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
              <td valign="top" bgcolor="#FFFFFF"><font face="Verdana,Arial" size="-1">
                <input type="radio" value="Visa" checked name="cardtype">
                Visa &nbsp;
                <input type="radio" name="cardtype" value="MasterCard">
                MasterCard &nbsp;
                <input type="radio" name="cardtype" value="Amex">
                American Express&nbsp;
                <br>
                <input type="radio" name="cardtype" value="PayPal">
                PayPal&nbsp; </font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Card #:</font></td>
              <td valign="top"><font face="Arial" size="2">
                <input name="credit_card_number" type="text" id="credit_card_number" size="30" onBlur="stringFilter(credit_card_number);" >
                <br>
                No dashes or spaces</font></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Exp. Date:</font></td>
              <td valign="top"><font face="Verdana,Arial" size="-1">Month:</font>
                  <select name="exp_month" id="exp_month">
                    <option selected>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                &nbsp;&nbsp;&nbsp;&nbsp;<font face="Verdana,Arial" size="-1">Year:</font>
                <select name="exp_year" id="exp_year">
                  <option value="08" selected>2008</option>
                  <option value="09">2009</option>
                  <option value="10">2010</option>
                  <option value="11">2011</option>
                  <option value="12">2012</option>
                  <option value="13">2013</option>
                  <option value="14">2014</option>
                  <option value="15">2015</option>
                  <option value="16">2016</option>
                  <option value="17">2017</option>
                  <option value="18">2018</option>
                  <option value="19">2019</option>
                </select></td>
            </tr>
            <tr>
              <td align="right"><font face="Verdana,Arial" size="-1">Sec. Code:</font></td>
              <td valign="top"><font face="Arial" size="2">
                <input name="sec_code" type="text" id="sec_code" size="4">
                <img src="images/cvv.gif" width="26" height="17"><br>
                3 or 4 digit code</font></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td valign="top"><input name="B1" type="submit" onClick="if (document.FrontPage_Form1.cardtype[3].checked == true) { MM_validateForm('Name','','R','Address','','R','City','','R','ZIP','','R','Email','','RisEmail','Phone','','R','ShipName','','R','ShipAddress','','R','ShipCity','','R','ShipZIP','','R');return document.MM_returnValue } else {  MM_validateForm('Name','','R','Address','','R','City','','R','ZIP','','R','Email','','RisEmail','Phone','','R','ShipName','','R','ShipAddress','','R','ShipCity','','R','ShipZIP','','R','credit_card_number','','RisNum','sec_code','','R');return document.MM_returnValue }" value="Next"></td>
            </tr>
          </table>
          <br>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="clickhereMap"><area shape="rect" coords="23,38,122,70" href="javascript:requestSamples();" onMouseOver="MM_swapImage('clickhere','','images/index_new/IRlogo_top_ro.jpg',1)" onMouseOut="MM_swapImgRestore()">
</map>
</body>
</html>
