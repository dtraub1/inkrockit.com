<?
  session_start();
?>
<?
  require('includes/db_connection.php');

  if (isset($_SERVER['QUERY_STRING'])) {
    $str = $_SERVER['QUERY_STRING'];
    parse_str($str);
  }

  $ID = 38;

  $Query = "SELECT products_price FROM products WHERE products_id = " . $ID;
  $queryexe = mysql_query($Query);
  $myrow = mysql_fetch_array($queryexe);
  $pricemultiplier = $myrow["products_price"];

?>
<?
  $_sCartItemNums = $_SESSION['cartitemnumarray'];
  $_nCartItemQtys = $_SESSION['cartitemqtyarray'];

  $_sCartItemQuantity = $_SESSION['cartitemquantityarray'];
  $_sCartItemColors = $_SESSION['cartitemcolorsarray'];
  $_sCartItemTurnaround = $_SESSION['cartitemturnaroundarray'];
  $_sCartItemProof = $_SESSION['cartitemproofarray'];
  $_sCartItemPaper = $_SESSION['cartitempaperarray'];
  $_sCartItemCoating = $_SESSION['cartitemcoatingarray'];
  $_sCartItemNumberofpages = $_SESSION['cartitemnumberofpagesarray'];
  $_sCartItemCoverpaper = $_SESSION['cartitemcoverpaperarray'];
  $_sCartItemInsidepagespaper = $_SESSION['cartiteminsidepagespaperarray'];
  $_sCartItemBinding = $_SESSION['cartitembindingarray'];
  $_sCartItemHoledrilling = $_SESSION['cartitemholedrillingarray'];
  $_sCartItemPerforation = $_SESSION['cartitemperforationarray'];
  $_sCartItemUpgradestock = $_SESSION['cartitemupgradestockarray'];
  $_sCartItemSecondsheets = $_SESSION['cartitemsecondsheetsarray'];
  $_sCartItemSlotorientation = $_SESSION['cartitemslotorientationarray'];
  $_sCartItemBusinesscardslot = $_SESSION['cartitembusinesscardslotarray'];
  $_sCartItemEnvelopesize = $_SESSION['cartitemenvelopesizearray'];
  $_sCartItemPaperfold = $_SESSION['cartitempaperfoldarray'];
  $_sCartItemPostcardsize = $_SESSION['cartitempostcardsizearray'];
  $_sCartItemScoring = $_SESSION['cartitemscoringarray'];

  $_sCartItemTotal = $_SESSION['cartitemtotalarray'];
  $_nNumCartItems = count($_sCartItemNums);

//  Determine the mode of this page's operation. If we got here from a
//  link that had a "mode" querystring of "add", mode is add:
  $_sMode = $mode;
  if (!isset($_sMode)) {
    if (isset($_POST['mode'])) {
      if ($_POST['mode'] == "add") {
        $_sMode = "add";
      }
    }
  }

//  Or, we could have gotten here from a form:
if (isset($_POST['cmdSubmit'])) {
  if ($_POST['cmdSubmit'] == "Proceed to Checkout") {
      $_sMode = "checkout";
  }
  if ($_POST['cmdSubmit'] == "Recalculate Order") {
      $_sMode = "recalc";
  }
  if ($_POST['cmdSubmit'] == "Continue Shopping") {
      $_sMode = "continue";
  }
}

  if (!isset($special)) {
    $special = "No";
  }

  if (!isset($_sMode)) {
    $_sMode = "view";
  }


  if ($_sMode == "add") {
    $_nThisItemIndex = -1;
    $_sItemNo = $itemno;
//  TURN OFF FOR PRODUCT OPTIONS
//    if ($_nNumCartItems > 0) {
//      for ($_i = 0; $_i < $_nNumCartItems; $_i++) {
//          $_temp2 = $_sCartItemNums[$_i];
//          if ($_temp2 == $_sItemNo) {
//            $_nThisItemIndex = $_i;
//          }
//      }
//    }


    if ($_nThisItemIndex == -1) {
      $_sCartItemNums[] = $_sItemNo;

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 1 and pa.products_id = $_sItemNo AND pa.options_values_price = $colors";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemColors[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 19 and pa.products_id = $_sItemNo AND pa.options_values_price = $postcardsize";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemPostcardsize[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 20 and pa.products_id = $_sItemNo AND pa.options_values_price = $scoring";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemScoring[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 12 and pa.products_id = $_sItemNo AND pa.options_values_price = $perforation";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemPerforation[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 2 and pa.products_id = $_sItemNo AND pa.options_values_price = $Turnaround";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemTurnaround[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 3 and pa.products_id = $_sItemNo AND pa.options_values_price = $Proof";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemProof[] = $myrow['products_options_values_name'];

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 4 and pa.products_id = $_sItemNo AND pa.options_values_price = $Quantity";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemQuantity[] = $myrow['products_options_values_name'];

//      $_sCartItemColors[] = '';
      $_sCartItemPaper[] = '';
      $_sCartItemCoating[] = '';
      $_sCartItemNumberofpages[] = '';
      $_sCartItemCoverpaper[] = '';
      $_sCartItemInsidepagespaper[] = '';
      $_sCartItemBinding[] = '';
      $_sCartItemHoledrilling[] = '';
//      $_sCartItemPerforation[] = '';
      $_sCartItemUpgradestock[] = '';
      $_sCartItemSecondsheets[] = '';
      $_sCartItemSlotorientation[] = '';
      $_sCartItemBusinesscardslot[] = '';
      $_sCartItemEnvelopesize[] = '';
      $_sCartItemPaperfold[] = '';
//      $_sCartItemPostcardsize[] = '';
//      $_sCartItemScoring[] = '';

      $_sCartItemTotal[] = $nTotal;
      $_nCartItemQtys[] = 1;
    } else {
      $_nCartItemQtys[$_nThisItemIndex] = $_nCartItemQtys[$_nThisItemIndex] + 1;
    }
    $_SESSION['cartitemnumarray'] = $_sCartItemNums;
    $_SESSION['cartitemqtyarray'] = $_nCartItemQtys;

    $_SESSION['cartitemquantityarray'] = $_sCartItemQuantity;
    $_SESSION['cartitemcolorsarray'] = $_sCartItemColors;
    $_SESSION['cartitemturnaroundarray'] = $_sCartItemTurnaround;
    $_SESSION['cartitemproofarray'] = $_sCartItemProof;
    $_SESSION['cartitempaperarray'] = $_sCartItemPaper;
    $_SESSION['cartitemcoatingarray'] = $_sCartItemCoating;
    $_SESSION['cartitemnumberofpagesarray'] = $_sCartItemNumberofpages;
    $_SESSION['cartitemcoverpaperarray'] = $_sCartItemCoverpaper;
    $_SESSION['cartiteminsidepagespaperarray'] = $_sCartItemInsidepagespaper;
    $_SESSION['cartitembindingarray'] = $_sCartItemBinding;
    $_SESSION['cartitemholedrillingarray'] = $_sCartItemHoledrilling;
    $_SESSION['cartitemperforationarray'] = $_sCartItemPerforation;
    $_SESSION['cartitemupgradestockarray'] = $_sCartItemUpgradestock;
    $_SESSION['cartitemsecondsheetsarray'] = $_sCartItemSecondsheets;
    $_SESSION['cartitemslotorientationarray'] = $_sCartItemSlotorientation;
    $_SESSION['cartitembusinesscardslotarray'] = $_sCartItemBusinesscardslot;
    $_SESSION['cartitemenvelopesizearray'] = $_sCartItemEnvelopesize;
    $_SESSION['cartitempaperfoldarray'] = $_sCartItemPaperfold;
    $_SESSION['cartitempostcardsizearray'] = $_sCartItemPostcardsize;
    $_SESSION['cartitemscoringarray'] = $_sCartItemScoring;

    $_SESSION['cartitemtotalarray'] = $_sCartItemTotal;
    $_nNumCartItems = count($_sCartItemNums);
  }

  if ($_sMode == "remove") {
    $_y = 0;
    for ($_i = 0; $_i < $_nNumCartItems-1; $_i++) {
      if ($_i == $ID) {
        $_y = $_y + 1;
      }
      $_sCartItemNums[$_i] = $_sCartItemNums[$_y] ;
      $_nCartItemQtys[$_i] = $_nCartItemQtys[$_y];

      $_sCartItemQuantity[$_i] = $_sCartItemQuantity[$_y];
      $_sCartItemColors[$_i] = $_sCartItemColors[$_y];
      $_sCartItemTurnaround[$_i] = $_sCartItemTurnaround[$_y];
      $_sCartItemProof[$_i] = $_sCartItemProof[$_y];
      $_sCartItemPaper[$_i] = $_sCartItemPaper[$_y];
      $_sCartItemCoating[$_i] = $_sCartItemCoating[$_y];
      $_sCartItemNumberofpages[$_i] = $_sCartItemNumberofpages[$_y];
      $_sCartItemCoverpaper[$_i] = $_sCartItemCoverpaper[$_y];
      $_sCartItemInsidepagespaper[$_i] = $_sCartItemInsidepagespaper[$_y];
      $_sCartItemBinding[$_i] = $_sCartItemBinding[$_y];
      $_sCartItemHoledrilling[$_i] = $_sCartItemHoledrilling[$_y];
      $_sCartItemPerforation[$_i] = $_sCartItemPerforation[$_y];
      $_sCartItemUpgradestock[$_i] = $_sCartItemUpgradestock[$_y];
      $_sCartItemSecondsheets[$_i] = $_sCartItemSecondsheets[$_y];
      $_sCartItemSlotorientation[$_i] = $_sCartItemSlotorientation[$_y];
      $_sCartItemBusinesscardslot[$_i] = $_sCartItemBusinesscardslot[$_y];
      $_sCartItemEnvelopesize[$_i] = $_sCartItemEnvelopesize[$_y];
      $_sCartItemPaperfold[$_i] = $_sCartItemPaperfold[$_y];
      $_sCartItemPostcardsize[$_i] = $_sCartItemPostcardsize[$_y];
      $_sCartItemScoring[$_i] = $_sCartItemScoring[$_y];

      $_sCartItemTotal[$_i] = $_sCartItemTotal[$_y];
      $_y = $_y + 1;
    }
      unset($_sCartItemNums[$_i]) ;
      unset($_nCartItemQtys[$_i]);

      unset($_sCartItemQuantity[$_i]);
      unset($_sCartItemColors[$_i]);
      unset($_sCartItemTurnaround[$_i]);
      unset($_sCartItemProof[$_i]);
      unset($_sCartItemPaper[$_i]);
      unset($_sCartItemCoating[$_i]);
      unset($_sCartItemNumberofpages[$_i]);
      unset($_sCartItemCoverpaper[$_i]);
      unset($_sCartItemInsidepagespaper[$_i]);
      unset($_sCartItemBinding[$_i]);
      unset($_sCartItemHoledrilling[$_i]);
      unset($_sCartItemPerforation[$_i]);
      unset($_sCartItemUpgradestock[$_i]);
      unset($_sCartItemSecondsheets[$_i]);
      unset($_sCartItemSlotorientation[$_i]);
      unset($_sCartItemBusinesscardslot[$_i]);
      unset($_sCartItemEnvelopesize[$_i]);
      unset($_sCartItemPaperfold[$_i]);
      unset($_sCartItemPostcardsize[$_i]);
      unset($_sCartItemScoring[$_i]);

      unset($_sCartItemTotal[$_i]);
      $_nNumCartItems = $_nNumCartItems - 1;
      $_itest = $_i;
    $_SESSION['cartitemnumarray'] = $_sCartItemNums;
    $_SESSION['cartitemqtyarray'] = $_nCartItemQtys;

    $_SESSION['cartitemquantityarray'] = $_sCartItemQuantity;
    $_SESSION['cartitemcolorsarray'] = $_sCartItemColors;
    $_SESSION['cartitemturnaroundarray'] = $_sCartItemTurnaround;
    $_SESSION['cartitemproofarray'] = $_sCartItemProof;
    $_SESSION['cartitempaperarray'] = $_sCartItemPaper;
    $_SESSION['cartitemcoatingarray'] = $_sCartItemCoating;
    $_SESSION['cartitemnumberofpagesarray'] = $_sCartItemNumberofpages;
    $_SESSION['cartitemcoverpaperarray'] = $_sCartItemCoverpaper;
    $_SESSION['cartiteminsidepagespaperarray'] = $_sCartItemInsidepagespaper;
    $_SESSION['cartitembindingarray'] = $_sCartItemBinding;
    $_SESSION['cartitemholedrillingarray'] = $_sCartItemHoledrilling;
    $_SESSION['cartitemperforationarray'] = $_sCartItemPerforation;
    $_SESSION['cartitemupgradestockarray'] = $_sCartItemUpgradestock;
    $_SESSION['cartitemsecondsheetsarray'] = $_sCartItemSecondsheets;
    $_SESSION['cartitemslotorientationarray'] = $_sCartItemSlotorientation;
    $_SESSION['cartitembusinesscardslotarray'] = $_sCartItemBusinesscardslot;
    $_SESSION['cartitemenvelopesizearray'] = $_sCartItemEnvelopesize;
    $_SESSION['cartitempaperfoldarray'] = $_sCartItemPaperfold;
    $_SESSION['cartitempostcardsizearray'] = $_sCartItemPostcardsize;
    $_SESSION['cartitemscoringarray'] = $_sCartItemScoring;

    $_SESSION['cartitemtotalarray'] = $_sCartItemTotal;
  }

  if ($_sMode == "recalc" or $_sMode == "checkout" or $_sMode == "continue") {
    for ($_i = 0; $_i < $_nNumCartItems; $_i++) {
      $_fieldname = "txtItemQty$_i";
      $_nThisQty = $_POST[$_fieldname];
      $_nCartItemQtys[$_i] = $_nThisQty;
    }
    $_SESSION['cartitemnumarray'] = $_sCartItemNums;
    $_SESSION['cartitemqtyarray'] = $_nCartItemQtys;

    $_SESSION['cartitemquantityarray'] = $_sCartItemQuantity;
    $_SESSION['cartitemcolorsarray'] = $_sCartItemColors;
    $_SESSION['cartitemturnaroundarray'] = $_sCartItemTurnaround;
    $_SESSION['cartitemproofarray'] = $_sCartItemProof;
    $_SESSION['cartitempaperarray'] = $_sCartItemPaper;
    $_SESSION['cartitemcoatingarray'] = $_sCartItemCoating;
    $_SESSION['cartitemnumberofpagesarray'] = $_sCartItemNumberofpages;
    $_SESSION['cartitemcoverpaperarray'] = $_sCartItemCoverpaper;
    $_SESSION['cartiteminsidepagespaperarray'] = $_sCartItemInsidepagespaper;
    $_SESSION['cartitembindingarray'] = $_sCartItemBinding;
    $_SESSION['cartitemholedrillingarray'] = $_sCartItemHoledrilling;
    $_SESSION['cartitemperforationarray'] = $_sCartItemPerforation;
    $_SESSION['cartitemupgradestockarray'] = $_sCartItemUpgradestock;
    $_SESSION['cartitemsecondsheetsarray'] = $_sCartItemSecondsheets;
    $_SESSION['cartitemslotorientationarray'] = $_sCartItemSlotorientation;
    $_SESSION['cartitembusinesscardslotarray'] = $_sCartItemBusinesscardslot;
    $_SESSION['cartitemenvelopesizearray'] = $_sCartItemEnvelopesize;
    $_SESSION['cartitempaperfoldarray'] = $_sCartItemPaperfold;
    $_SESSION['cartitempostcardsizearray'] = $_sCartItemPostcardsize;
    $_SESSION['cartitemscoringarray'] = $_sCartItemScoring;

    $_SESSION['cartitemtotalarray'] = $_sCartItemTotal;
  }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/innerpages.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Post Cards - Inkrockit, Inkrocket, Ink Rocket, Ink Rockit, Pocket Folders,Discount Cheap Presentation Folders, Tri Panel Folders, Reinforced Folders,Legal Size Pocket Folders, Online Commercial Printing CMYK/PMS CMYK PMSColor Ink, Two Pocket, Single Pocket Presentation Folder, Low CostPresentation Folder, Pocket Presentation Folder Printing, Full Color PocketFolders, Mini Pocket Folders, Biz Cards Slits, Folders, Custom Folder withPockets, Designing Free Folders Desgin Affordable Printing Industry CompanyLamination Embossed Foil Stamped Laminated Pocket Presentatoin FolderPrinter Sellers Thermography</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
a.bodylink:link {color: #000000; text-decoration: underline; } /* links under CSS Pages heading */
a.bodylink:visited {color: #000000; text-decoration: underline; }
a.bodylink:active {color: #000000; text-decoration: underline; }
a.bodylink:hover {color: #FFD641; text-decoration: underline; }
.style1noU {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.pricecalcbox {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 21px;
	color: #00FF00;
	background-color: #002B73;
	background-position: right;
	text-align: right;
}
.style29 {font-size: 10px}
.style30 {color: #0A478A}
.style17Copy {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	margin: 0px;
	padding: 0px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
A:link { color: #FFFFFF; text-decoration : underline;}
A:visited { color: #FFFFFF; text-decoration : underline;}
A:active { color: #FFFFFF; text-decoration : underline;}
A:hover { color: #FFD641; text-decoration : underline;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: underline;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.style9 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-style: italic;
	font-size: 14px;
	color: #FF9C01;
}
.style10 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	font-style: italic;
	color: #FFFFFF;
	line-height: 14px;
}
.style15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style16 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style17 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.style23 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; }
.style25 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #002B73; }
.style26 {color: #FFFFFF}
.style27 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; color: #FFFFFF; }
.style28 {
font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #002B73;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
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
</head>

<body onLoad="MM_preloadImages('images/new/left-sendmesamples_ro.jpg')">
<table width="841" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/new/topbanner.jpg" width="841" height="99" border="0" usemap="#Map3"></td>
  </tr>
  <tr>
    <td><table width="841" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><!-- InstanceBeginEditable name="MainMenu" -->
<div id="colorsexp" style="position:absolute; width:375; height:0; z-index:99; left: 100px; top:100px; overflow: visible; visibility: hidden;">
  <table width=350 border=0 cellpadding=1 cellspacing=0 bgcolor=#041C43><tr><td><TABLE width=100% border=0 cellpadding=10 cellspacing=0><TR><TD bgcolor='white' class='style16'>You can choose one of three ways to print your product:<ul>
<li>Color Both Sides
<li>Color Front, Black Only Back
<li>Color Front, Blank Back
</ul><ul></ul></TD></TR></TABLE></td></tr></table></div>
<div id="postcardsizeexp" style="position:absolute; width:375; height:0; z-index:99; left: 100px; top:100px; overflow: visible; visibility: hidden"><table width=350 border=0 cellpadding=1 cellspacing=0 bgcolor=#041C43><tr><td><TABLE width=100% border=0 cellpadding=10 cellspacing=0><TR><TD bgcolor='white' class='style16'>Choose 4" x 6", 5" x 7", 5" x 8" or 6" x 9".<ul></ul></TD></TR></TABLE></td></tr></table></div>
<div id="perforationexp" style="position:absolute; width:375; height:0; z-index:99; left: 100px; top:100px; overflow: visible; visibility: hidden;">
  <table width=350 border=0 cellpadding=1 cellspacing=0 bgcolor=#041C43><tr><td><TABLE width=100% border=0 cellpadding=10 cellspacing=0><TR><TD bgcolor='white' class='style16'>Perforation allows for clean tearing of the paper product across a straight line. To show us where to perforate, draw a dashed line (e.g., "----------") beside your artwork in the bleed margin or otherwise outside the print area. Note: Your product must be at least 3" x 4".<ul></ul></TD></TR></TABLE></td></tr></table></div>
<div id="turnaround" style="position:absolute; width:375; height:0; z-index:99; left: 100px; top:100px; overflow: visible; visibility: hidden"><table width=350 border=0 cellpadding=1 cellspacing=0 bgcolor=#041C43><tr><td><TABLE width=100% border=0 cellpadding=10 cellspacing=0><TR><TD bgcolor='white' class='style16'>Turnaround time for your print job begins once your order has been placed and your files have been uploaded, attached and approved. If your job is approved by 5pm Pacific Time, turnaround time begins that business day. For example, a job for three-day turnaround that you approve by 1:00 pm Tuesday will be shipped out to you by the end of business Friday. Note: Our offices are closed Saturdays, Sundays and Holidays. As a result, these days are not considered when calculating turnaround time.<ul></ul></TD></TR></TABLE></td></tr></table></div>
<div id="proof" style="position:absolute; width:375; height:0; z-index:99; left: 100px; top:100px; overflow: visible; visibility: hidden"><table width=350 border=0 cellpadding=1 cellspacing=0 bgcolor=#041C43><tr><td><TABLE width=100% border=0 cellpadding=10 cellspacing=0><TR><TD bgcolor='white' class='style16'>You can choose one of four ways to proof your job:<br><font color=ff0000><b>*Note: The proofing process can/will delay the<br>
turnaround time of your job. </b><strong>The option of a hardcopy proof includes 3 proofs for the price of $35.00 (plus tax). <br>
</strong><br>
All proofs are sent to the billing address, unless told otherwise.</font>
<ul>

<li>Use the Online Preview for the fastest turnaround and/or if you are an experienced user.

<li>Choose a Fax Proof to assure a critical layout placement. Please make sure to add your fax number in your order form.


<li>Order a Standard Hardcopy Proof if you need the most accurate color proof to assure a high quality job. It also is a great way to visually calibrate your monitor to our presses.

<li>Order a Next Day Hardcopy Proof, which is the same as a Standard Hardcopy Proof, but is sent via UPS Next Day Air. <p>Customers must have successfully uploaded and attached a file(s) to their order by 1pm PST in order to ensure a next day delivery. We reserve the right to charge an additional $15.00 for extra Next Day Air Proofs</ul><ul></ul></TD></TR></TABLE></td></tr></table></div>


          <table width="841" height="31"  border="0" cellpadding="0" cellspacing="0" background="images/new/topbar.jpg">
            <tr>
              <td width="18">&nbsp;</td>
              <td width="41" class="style3"><a href="index.htm">Home</a></td>
              <td width="58" class="style3"><a href="products.htm">Products</a></td>
              <td width="91" class="style3"><a href="about.htm">About Inkrockit</a></td>
              <td width="113" class="style3"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account.php">My Account [LOGIN]</a> </td>
              <td width="75" class="style3"><a href="helpcenter.htm">Help Center</a> </td>
              <td width="72" class="style3"><a href="directmail.htm">Direct Mail</a> </td>
              <td width="100" class="style3"><a href="designservices.htm">Design Services</a> </td>
              <td width="92" class="style3"><a href="contactus.htm">Contact Us</a> </td>
              <td width="65" background="images/new/top-curve.jpg">&nbsp;</td>
              <td bgcolor="#1F73B3"><span class="style3"><a href="shopcart.php" class="style1">Shopping Cart</a></span></td>
            </tr>
          </table>
        <!-- InstanceEndEditable --></td>
      </tr>
      <tr>
        <td><table width="841" height="467" border="0" cellpadding="0" cellspacing="0" bgcolor="#002A72">
          <tr>
            <td width="179" height="467" valign="top" bgcolor="#3572B3"><!-- InstanceBeginEditable name="OrderSteps" --><img src="images/new/left-chooseyourproduct.jpg" width="179" height="123"><br>
              <img src="images/new/left-placeyourorder.jpg" width="179" height="35"><br>
              <img src="images/new/left-uploadyourfiles.jpg" width="179" height="35"><!-- InstanceEndEditable --><br>
              <img src="images/new/left-bar1.jpg" width="179" height="17"><br>			  <!-- InstanceBeginEditable name="LeftMenu" -->
              <table width="170" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td valign="bottom">&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/pocketfolders.php" class="style1">Pocket Folders</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/multipagecatalogs.php">Multipage Catalogs</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/salessheets.php">Sales Sheets</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/brochures.php" class="style1">Brochures</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/posters.php" class="style1">Posters</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/rackcards.php" class="style1">Rack Cards</a> </span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/businesscards.php" class="style1">Business Cards</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/letterhead.php" class="style1">Letterhead</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/envelopes.php" class="style1">Envelopes</a></span></td>
                </tr>
                <tr>
                  <td>&nbsp;<img src="images/new/yellowtriangle.jpg" width="12" height="12"> <span class="style1noU">Post Cards</span></td>
                </tr>
              </table>
              <!-- InstanceEndEditable -->
              <table width="179" height="45" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="14" colspan="3"><img src="images/new/sampletop.jpg" width="179" height="14"></td>
                    </tr>
                    <tr>
                      <td width="19" height="18"><img src="images/new/sampleleft.jpg" width="19" height="18"></td>
                      <td width="109" height="18" bgcolor="#155FA0" class="style1"><a href="sendsamples.htm">Send Me Samples</a> </td>
                      <td width="51" height="18"><img src="images/new/sampleright.jpg" width="51" height="18"></td>
                    </tr>
                    <tr>
                      <td height="13" colspan="3"><img src="images/new/samplebottom.jpg" width="179" height="13"></td>
                    </tr>
                </table></td>
            <td height="467" valign="top" background="images/inner/bluevertline-wide.jpg" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="MainBody" -->
              <table width="503" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table width="293" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr>
                        <td colspan="3"><img src="images/inner/postcards.jpg" width="293" height="42"></td>
                      </tr>
                      <tr>
                        <td width="19" background="images/inner/bluevertline.jpg">&nbsp;</td>
                        <td width="264"><p><FONT face="Verdana, Helvetica, Arial"><SPAN style="FONT-SIZE: 12px"><img src="images/inner/postcardspict.jpg" width="274" height="172">
                          </SPAN></FONT></p>
                          <table width="274"  border="0" cellspacing="0" cellpadding="0">
                            <tr valign="top">
                              <td width="14"><img src="images/inner/orangearrow.jpg" width="10" height="14"></td>
                              <td width="260" class="style15">Available in 4&rdquo; x 6&rdquo;, 5&rdquo; x 7&rdquo;, 5&rdquo; x 8&rdquo;and 6&rdquo; x 9&rdquo; formats (flat card)<br>
&nbsp; </td>
                            </tr>
                            <tr valign="top">
                              <td width="14"><img src="images/inner/orangearrow.jpg" width="10" height="14"></td>
                              <td width="260" class="style15">Premium 12 pt. gloss card stock<br>
&nbsp;</td>
                            </tr>
                            <tr valign="top">
                              <td><img src="images/inner/orangearrow.jpg" width="10" height="14"></td>
                              <td class="style15">Gloss-coated on front for durability (water-resistant)<br>
&nbsp; </td>
                            </tr>
                            <tr valign="top">
                              <td width="14"><img src="images/inner/orangearrow.jpg" width="10" height="14"></td>
                              <td width="260" class="style15">Full-color both sides, color front with blank back or color front with black-and-white back<br>
&nbsp; </td>
                            </tr>
                          </table>
                          <p><FONT face="Verdana, Helvetica, Arial"><SPAN style="FONT-SIZE: 12px">Post cards are effective at introducing new products or services to your prospects as well as to your existing client base. They may also be used on a personal level i.e. holiday greetings or thank you cards.</SPAN></FONT></p></td>
                      </tr>
                      <tr>
                        <td width="19" background="images/inner/bluevertline.jpg">&nbsp;</td>
                        <td width="264">&nbsp;</td>
                      </tr>
                  </table></td>
<SCRIPT Language="Javascript">
<!--
    function calc_1(itemID) {
    var iTot = 0;
    var mTot = 0;
    var pricemultiplier = <?php echo $pricemultiplier; ?>;

    var quantity = parseFloat(document.forms["cart_quantity"].elements["Quantity"].value);
	var colors = parseFloat(document.forms["cart_quantity"].elements["colors"].value);
	var postcardsize = parseFloat(document.forms["cart_quantity"].elements["postcardsize"].value);
	var postcardsizeindex = parseFloat(document.forms["cart_quantity"].elements["postcardsize"].selectedIndex);
	var scoring = parseFloat(document.forms["cart_quantity"].elements["scoring"].value);
	var perforation = parseFloat(document.forms["cart_quantity"].elements["perforation"].value);
	var turnaround = parseFloat(document.forms["cart_quantity"].elements["Turnaround"].value);
	var proof = parseFloat(document.forms["cart_quantity"].elements["Proof"].value);

	if (quantity > 0 && quantity <= 500 && postcardsizeindex == 0)
	{
	    iTot = iTot + ((((95*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 500 && quantity <= 1000 && postcardsizeindex == 0)
	{
	    iTot = iTot + .85*(((((155*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 1000 && quantity <= 2000 && postcardsizeindex == 0)
	{
	    iTot = iTot + .85*(((((155+(((quantity-1000)/1000)*90)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 2000 && quantity <= 4999 && postcardsizeindex == 0)
	{
	    iTot = iTot + .85*(((((165+(((quantity-1000)/1000)*80)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity == 5000 && postcardsizeindex == 0)
	{
	    iTot = iTot + .85*(((((150+((quantity/1000)*65)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 5000 && quantity <= 10000 && postcardsizeindex == 0)
	{
	    iTot = iTot + ((((150+((quantity/1000)*65)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 10000 && postcardsizeindex == 0)
	{
	    iTot = iTot + ((((300+((quantity/1000)*50)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 0 && quantity <= 500 && postcardsizeindex == 1)
	{
	    iTot = iTot + (((((175*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 500 && quantity <= 1000 && postcardsizeindex == 1)
	{
	    iTot = iTot + (.85*(((((245*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 1000 && quantity <= 2000 && postcardsizeindex == 1)
	{
	    iTot = iTot + (.85*(((((245+(((quantity-1000)/1000)*125)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 2000 && quantity <= 4999 && postcardsizeindex == 1)
	{
	    iTot = iTot + (.85*(((((245+(((quantity-1000)/1000)*125)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity == 5000 && postcardsizeindex == 1)
	{
	    iTot = iTot + (.85*(((((260+((quantity/1000)*90)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 5000 && quantity <= 10000 && postcardsizeindex == 1)
	{
	    iTot = iTot + (((((260+((quantity/1000)*90)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 10000 && postcardsizeindex == 1)
	{
	    iTot = iTot + (((((560+(((quantity-1000)/1000)*60)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 0 && quantity <= 500 && postcardsizeindex == 2)
	{
	    iTot = iTot + (((((175*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 500 && quantity <= 1000 && postcardsizeindex == 2)
	{
	    iTot = iTot + (.85*(((((245*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 1000 && quantity <= 2000 && postcardsizeindex == 2)
	{
	    iTot = iTot + (.85*(((((245+(((quantity-1000)/1000)*125)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 2000 && quantity <= 4999 && postcardsizeindex == 2)
	{
	    iTot = iTot + (.85*(((((245+(((quantity-1000)/1000)*125)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity == 5000 && postcardsizeindex == 2)
	{
	    iTot = iTot + (.85*(((((260+((quantity/1000)*90)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 5000 && quantity <= 10000 && postcardsizeindex == 2)
	{
	    iTot = iTot + (((((260+((quantity/1000)*90)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 10000 && postcardsizeindex == 2)
	{
	    iTot = iTot + (((((560+(((quantity-1000)/1000)*60)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 0 && quantity <= 500 && postcardsizeindex == 3)
	{
	    iTot = iTot + (((((200*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 500 && quantity <= 1000 && postcardsizeindex == 3)
	{
	    iTot = iTot + (.85*(((((355*colors))+(scoring*15)+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 1000 && quantity <= 2000 && postcardsizeindex == 3)
	{
	    iTot = iTot + (.85*(((((355+(((quantity-1000)/1000)*185)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 2000 && quantity <= 4999 && postcardsizeindex == 3)
	{
	    iTot = iTot + (.85*(((((355+(((quantity-1000)/1000)*145)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity == 5000 && postcardsizeindex == 3)
	{
	    iTot = iTot + (.85*(((((390+((quantity/1000)*100)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof))
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 5000 && quantity <= 10000 && postcardsizeindex == 3)
	{
	    iTot = iTot + (((((390+((quantity/1000)*100)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	if (quantity > 10000 && postcardsizeindex == 3)
	{
	    iTot = iTot + (((((590+(((quantity-1000)/1000)*80)*colors))+(scoring*(((quantity-1000)/1000)*15))+(perforation*((quantity/1000)*15)))*turnaround)+proof)
		mTot = mTot + iTot / quantity;
	}

	tTot = Math.round(iTot * 100) / 100 + .00001;
	var totX = "" + tTot;
	totX = totX.substring(0,totX.indexOf(".") + 3);

	document.forms["cart_quantity"].elements["total"].value = "$" + totX;
	document.forms["cart_quantity"].elements["bigtotal"].value = "$" + totX;
	document.forms["cart_quantity"].elements["nTotal"].value = tTot;

	pTot = (tTot/quantity);
	var totX = "" + pTot;
	totX = totX.substring(0,totX.indexOf(".") + 4);

	document.forms["cart_quantity"].elements["price"].value = "$" + totX;

}
// -->
</SCRIPT>
                  <td width="210" valign="top" bgcolor="#FFFFFF">
                  <form name="cart_quantity" action="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/postcards.php" method="post">
                    <input type="hidden" name="nTotal">
                    <input type="hidden" name="mode" value="add">
                    <input type="hidden" name="itemno" value="<? print $ID ?>">
                    <table width="210" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3"><img src="images/inner/pricecalculator.jpg" width="210" height="38"></td>
                      </tr>
                      <tr>
                        <td height="29" colspan="3"><table width="210" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10" height="32" bgcolor="#C6C6C6">&nbsp;</td>
                              <td height="32" align="right" bgcolor="#002B73"><input name='bigtotal' type='text' class="pricecalcbox" onChange="calc_1(1);" value='0' size=12 maxlength=10></td>
                              <td width="26" height="32" background="images/inner/grayright.jpg">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="3"><img src="images/inner/calc1.jpg" width="210" height="33"></td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" valign="top" bgcolor="#B9B9B9"><span class="style25">Color Options: <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom" onMouseOver="MM_showHideLayers('colorsexp','','show')" onMouseOut="MM_showHideLayers('colorsexp','','hide')"></span></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><select name="colors" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 1 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" valign="top" bgcolor="#B9B9B9"><span class="style25">Postcard Size: <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom" onMouseOver="MM_showHideLayers('postcardsizeexp','','show')" onMouseOut="MM_showHideLayers('postcardsizeexp','','hide')"></span></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><select name="postcardsize" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 19 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" valign="top" bgcolor="#B9B9B9"><span class="style25">Scoring: <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom"></span></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><select name="scoring" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 20 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" valign="top" bgcolor="#B9B9B9"><span class="style25">Perforation: <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom" onMouseOver="MM_showHideLayers('perforationexp','','show')" onMouseOut="MM_showHideLayers('perforationexp','','hide')"></span></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><select name="perforation" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 12 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><span class="style25">Turnaround Time : <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom" onMouseOver="MM_showHideLayers('turnaround','','show')" onMouseOut="MM_showHideLayers('turnaround','','hide')"></span></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="17" background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td width="167" bgcolor="#B9B9B9"><select name="Turnaround" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 2 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td width="26" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td bgcolor="#B9B9B9"><span class="style25">Proof: <img src="images/inner/questionmark.jpg" width="17" height="16" align="absbottom" onMouseOver="MM_showHideLayers('proof','','show')" onMouseOut="MM_showHideLayers('proof','','hide')"></span></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td bgcolor="#B9B9B9"><select name="Proof" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 3 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td bgcolor="#B9B9B9"><span class="style25">Quantity: </span></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td background="images/inner/grayleft.jpg">&nbsp;</td>
                        <td bgcolor="#B9B9B9"><select name="Quantity" class="style17Copy" onChange="return calc_1(1);">
<?
  $Query = "SELECT pa.options_values_price, pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 4 and pa.products_id = $ID ORDER BY pa.options_values_order";
  $queryexe = mysql_query($Query);

  if ($myrow = mysql_fetch_array($queryexe)) {
    do {
?>
       <option value="<?print($myrow['options_values_price']);?>"><?print($myrow['products_options_values_name']);?></option>
<?
  } while ($myrow = mysql_fetch_array($queryexe));
}
?>
                        </select></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td height="17" colspan="2"><img src="images/inner/calc2.jpg" width="184" height="20"></td>
                        <td width="26" height="17" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="184" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="9" bgcolor="#C6C6C6">&nbsp;</td>
                              <td width="89" bgcolor="#818181"><div align="right"><span class="style27">TOTAL:&nbsp;</span></div></td>
                              <td width="86" bgcolor="#818181"><input type='text' name='total' size=10 maxlength=10 value='' onChange="calc_1(1);">
                              </td>
                            </tr>
                        </table></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="184" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="9" bgcolor="#C6C6C6">&nbsp;</td>
                              <td width="89" bgcolor="#818181" class="style23"><div align="right" class="style26">Each:&nbsp;</div></td>
                              <td width="86" bgcolor="#818181"><input type='text' name='price' value='0' size='10' onChange="calc_1(1);"></td>
                            </tr>
                        </table></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="184" height="11" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="9" height="11" bgcolor="#C6C6C6">&nbsp;</td>
                              <td height="11" background="images/inner/grayhorizbar.jpg" class="style23"><div align="right" class="style26">&nbsp;</div></td>
                            </tr>
                        </table></td>
                        <td height="2" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="184" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="9" bgcolor="#C6C6C6">&nbsp;</td>
                              <td width="135" bgcolor="#818181" class="style28"><div align="right" class="style26">Shipping Options: </div></td>
                              <td width="40" bgcolor="#818181"><img src="images/inner/goblue.jpg" width="46" height="22"></td>
                            </tr>
                        </table></td>
                        <td background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="184" height="11" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="9" height="11" bgcolor="#C6C6C6">&nbsp;</td>
                              <td height="11" bgcolor="#818181" class="style28"><input type="image" src="images/inner/AddToCart.jpg" width="175" height="36" border="0" name="submit" alt="Submit"></td>
                            </tr>
                        </table></td>
                        <td height="2" background="images/inner/grayright.jpg">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="45" colspan="3" valign="top">
						   <a href="login.php"><img src="images/inner/order.jpg" alt="Order (Go To Step 2)" width="210" height="45" border="0"></a>
						</td>
                      </tr>
                  </table>
                  </form></td>
                </tr>
              </table>
<SCRIPT LANGUAGE="Javascript">
<!--
	calc_1(1);
// -->
</SCRIPT>
            <!-- InstanceEndEditable --></td>
            <td width="159" height="467" valign="top">
			  <!-- InstanceBeginEditable name="MyAccountMenu" -->
			<?
			  $cart_total = 0;
			  IF ($_nNumCartItems > 0) {
			?>
             <table width="159"  border="0" cellpadding="0" cellspacing="0" bgcolor="#2073B2">
                    <tr valign="top">
                      <td colspan="4" height="1" bgcolor="#0A478A"><img src="images/spacer.gif" width="1" height="1"></td>
                    </tr>
                    <tr valign="top">
                      <td width="8" bgcolor="#0A478A">&nbsp;</td>
                      <td width="12">&nbsp;</td>
                      <td colspan="2"><img src="images/new/yourcartitems.jpg" width="127" height="19"></td>
                    </tr>
			<?
			    for ($_i = 0; $_i < $_nNumCartItems; $_i++) {
                  $Query = "SELECT categories_name FROM categories_description cd, products_to_categories pc WHERE cd.categories_id = pc.categories_id AND pc.products_id = $_sCartItemNums[$_i]";
                  $queryexe = mysql_query($Query);

                  if ($myrow = mysql_fetch_array($queryexe)) {
	                do {
            ?>
                    <tr valign="top">
                      <td width="8" bgcolor="#0A478A">&nbsp;</td>
                      <td width="12">&nbsp;</td>
                      <td width="12"><img src="images/new/yellowtriangle.jpg" width="12" height="12"></td>
                      <td width="127"><span class="style16"><span class="style26"><span class="style29"><strong><? print($myrow["categories_name"]); ?></strong></span></span></span><br>
					    <span class="style16"><span class="style26"><span class="style29">Quantity: <? print $_sCartItemQuantity[$_i]; ?><br>
						Cost:						<?
				    $_cPrice = sprintf("%01.2f", $_sCartItemTotal[$_i]);
                    print("\$$_cPrice");
                  ?></span></span>
						</span>
					  </td>
                    </tr>
		    <?
			      $cart_total = $cart_total + $_sCartItemTotal[$_i];
                    } while ($myrow = mysql_fetch_array($queryexe));
			      }
				}
		    ?>
                    <tr valign="top">
                      <td width="8" bgcolor="#0A478A"><span class="style30"></span></td>
                      <td width="12">&nbsp;</td>
                      <td colspan="2" class="style1noU"><br>TOTAL: <?
				    $_showcarttotal = sprintf("%01.2f", $cart_total);
                    print("\$$_showcarttotal");
                  ?></td>
                    </tr>
                    <tr valign="top">
                      <td width="8" bgcolor="#0A478A"><span class="style30"></span></td>
                      <td width="12">&nbsp;</td>
                      <td colspan="2" class="style1"><a href="shopcart.php">Update Cart Items</a></td>
                    </tr>
                    <tr valign="top">
                      <td width="8" bgcolor="#0A478A"><span class="style30"></span></td>
                      <td width="12">&nbsp;</td>
                      <td colspan="2" class="style1"><a href="login.php">Order Cart Items</a></td>
                    </tr>
                    <tr valign="top">
                      <td colspan="4"><img src="images/new/yourcartitemsbotbar.jpg" width="159" height="10"></td>
                    </tr>
                  </table>
		    <?
			  }
			?>
			   <table width="159" height="68" border="0" cellpadding="0" cellspacing="0" bgcolor="#0A478A">
                 <tr>
                  <td colspan="3"><img src="images/new/right-myaccount.jpg" alt="My Account" width="159" height="44"></td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account.php">Login</a> </span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account.php">Order Status</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account.php">Order History</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account.php">My Info</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
              </table>
			  <!-- InstanceEndEditable --><img src="images/new/right-helpcenter.jpg" alt="Help Center" width="159" height="42"><br>
			  <!-- InstanceBeginEditable name="HelpCenterMenu" -->
			  <table width="159" height="68" border="0" cellpadding="0" cellspacing="0" bgcolor="#0A478A">
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="howtoorder.htm">How To Order</a> </span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="filepreparation.htm">File Preparation</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="printingguidelines.htm">Printing Guidelines</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                  <td width="125">&nbsp;<img src="images/new/yellowtriangle2.jpg" width="10" height="11"> <span class="style1"><a href="customersupport.htm">Customer Support</a></span></td>
                  <td width="17" background="images/new/middelbar.jpg">&nbsp;</td>
                </tr>
              </table>
			  <!-- InstanceEndEditable -->
			  <table width="159" height="118" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="20" colspan="3"><img src="images/new/right-bottomcurve.jpg" width="159" height="20"></td>
                  </tr>
                <tr>
                  <td width="20" height="98">&nbsp;</td>
                  <td width="129" height="98">                    <span class="style10"><img src="images/new/directmail.jpg" width="92" height="15"><br>
                    Boost your sales <br>
                    with direct mail.</span><br>
                    <span class="style3">&#8226; Marketing &amp; Design<br>
                    &#8226; Lists<br>
                    <a href="directmail.htm"><img src="images/new/gobutton.jpg" alt="Direct Mail" width="44" height="22" border="0" align="right"></a>&#8226; Mailing </span></td>
                  <td width="10" height="98">&nbsp;</td>
                </tr>
              </table>
                <table width="159" height="98" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="20" height="98">&nbsp;</td>
                    <td width="129" height="98"><span class="style9"><img src="images/new/designservices.jpg" width="124" height="15"><br>
                      </span>
                        <span class="style10">Need a superior design solution?</span><br>
      <span class="style3">&#8226; Web/Multimedia<br>
&#8226; Print Collateral<br>
&#8226; Identity<br>
      <a href="designservices.htm"><img src="images/new/gobutton.jpg" alt="Design Services" width="44" height="22" border="0" align="right"></a>&#8226; Branding </span></td>
                    <td width="10" height="98">&nbsp;</td>
                  </tr>
                </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="31"  border="0" cellpadding="0" cellspacing="0" background="images/new/bottombar.jpg">
          <tr>
            <td width="25">&nbsp;</td>
            <td width="213"><span class="style3">Sales/Customer Service: 800.900.5632 </span></td>
            <td width="289" class="style3">Call or <a href="mailto:%20info@inkrockit.com">email</a> us for a free brochure </td>
            <td width="315" class="style2"><a href="termsconditions.htm" class="style3">Terms &amp; Conditions</a> </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="Map3">
  <area shape="rect" coords="784,56,823,77" href="crisiscontrolcenter.htm" alt="Crisis Control Center">
  <area shape="rect" coords="6,4,178,95" href="index.htm">
</map>
</body>
<!-- InstanceEnd --></html>
