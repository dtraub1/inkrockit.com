<?
    session_start();
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function printWindow() {
bV = parseInt(navigator.appVersion);
if (bV >= 4) window.print();
}
//  End -->
</script>
<?
   include "includes/db_connection.php";

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

   // GET CUSTOMER ID
   $customers_id = $_SESSION['customers_id'];

   // GET ALL NECESSARY CUSTOMER INFORMATION
   $Query2 = "SELECT * FROM customers WHERE customers_id = " . $customers_id;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $customers_name = $myrow2["customers_firstname"]." ".$myrow2["customers_lastname"];
      $customers_fname = $myrow2["customers_firstname"];
      $customers_telephone = $myrow2["customers_telephone"];
      $customers_email_address = $myrow2["customers_email_address"];
    }

   $Query2 = "SELECT * FROM address_book WHERE addresstype = 'S' AND address_book_id = " . $ship_address_id . " AND customers_id = " . $customers_id;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $delivery_name = $myrow2["entry_firstname"]." ".$myrow2["entry_lastname"];
      $delivery_company = $myrow2["entry_company"];
      $customers_company = $myrow2["entry_company"];
      $delivery_street_address = $myrow2["entry_street_address"];
      $customers_street_address = $myrow2["entry_street_address"];
      $delivery_city = $myrow2["entry_city"];
      $customers_city = $myrow2["entry_city"];
      $delivery_state = $myrow2["entry_state"];
      $customers_state = $myrow2["entry_state"];
      $delivery_postcode = $myrow2["entry_postcode"];
      $customers_postcode = $myrow2["entry_postcode"];
      $delivery_country = $myrow2["entry_country_id"];
      $customers_country = $myrow2["entry_country_id"];
    }

   $Query2 = "SELECT countries_name FROM countries WHERE countries_id = " . $delivery_country;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $delivery_country = $myrow2["countries_name"];
    }

   $Query2 = "SELECT countries_name FROM countries WHERE countries_id = " . $customers_country;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $customers_country = $myrow2["countries_name"];
    }

    $Query2 = "SELECT * FROM address_book WHERE addresstype = 'B' AND address_book_id = " . $bill_address_id . " AND customers_id = " . $customers_id;
    $queryexe2 = mysql_query($Query2);

    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $billing_name = $myrow2["entry_firstname"]." ".$myrow2["entry_lastname"];
      $billing_company = $myrow2["entry_company"];
      $billing_street_address = $myrow2["entry_street_address"];
      $billing_city = $myrow2["entry_city"];
      $billing_state = $myrow2["entry_state"];
      $billing_postcode = $myrow2["entry_postcode"];
      $billing_country = $myrow2["entry_country_id"];
    }

   $Query2 = "SELECT countries_name FROM countries WHERE countries_id = " . $billing_country;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $billing_country = $myrow2["countries_name"];
    }

    $Query2 = "SELECT * FROM payment_book WHERE payment_book_id = " . $payment_id . " AND customers_id = " . $customers_id;
    $queryexe2 = mysql_query($Query2);
    if ($myrow2 = mysql_fetch_array($queryexe2)) {
      $payment_method = "Credit Card";
      $cc_type = $myrow2["cctype"];
      $cc_number = $myrow2["ccnumber"];
      $cc_expires = $myrow2["ccexpdate"];
      $cc_owner = $myrow2["nameoncard"];
    }

    $date_purchased = date("Ymd");

    // SAVE CUSTOMER INFORMATION TO ORDERS TABLE
    $sql = "INSERT INTO `orders` ( `customers_id` , `customers_name` , `customers_company` , `customers_street_address` , `customers_city` , `customers_postcode` , `customers_state` , `customers_country` , `customers_telephone` , `customers_email_address` , `delivery_name` , `delivery_company` , `delivery_street_address` , `delivery_city` , `delivery_postcode` , `delivery_state` , `delivery_country` , `billing_name` , `billing_company` , `billing_street_address` , `billing_city` , `billing_postcode` , `billing_state` , `billing_country` , `payment_method` , `cc_type` , `cc_owner` , `cc_number` , `cc_expires` , `date_purchased` , `orders_status` , `currency` , `currency_value` , `customers_address_format_id` , `delivery_address_format_id` , `billing_address_format_id` )  VALUES ( '$customers_id' , '$customers_name' , '$customers_company' , '$customers_street_address' , '$customers_city' , '$customers_postcode' , '$customers_state' , '$customers_country' , '$customers_telephone' , '$customers_email_address' , '$delivery_name' , '$delivery_company' , '$delivery_street_address' , '$delivery_city' , '$delivery_postcode' , '$delivery_state' , '$delivery_country' , '$billing_name' , '$billing_company' , '$billing_street_address' , '$billing_city' , '$billing_postcode' , '$billing_state' , '$billing_country' , '$payment_method' , '$cc_type' , '$cc_owner' , '$cc_number' , '$cc_expires' , '$date_purchased', '1', 'USD', '1', '2', '2', '2' )";
    $queryexe = mysql_query($sql);

    // GET NEW ORDER ID
    $Query = "SELECT * FROM orders ORDER BY orders_id";
    $queryexe = mysql_query($Query);
    mysql_data_seek($queryexe, mysql_num_rows($queryexe)-1);
    $myrow = mysql_fetch_array($queryexe);
    $orders_id = $myrow["orders_id"];
    $_SESSION['orders_id'] = $orders_id;

    // SAVE ORDER TOTAL INFORMATION TO ORDERS_TOTAL TABLE
    $sql = "INSERT INTO `orders_total` ( `orders_id` , `title` , `text` , `value` , `class` , `sort_order` )  VALUES ( '$orders_id' , 'Sub-Total' , '\$$subtotaltotal' , '$subtotaltotal' , 'ot_subtotal' , '1' )";
    $queryexe = mysql_query($sql);
    $sql = "INSERT INTO `orders_total` ( `orders_id` , `title` , `text` , `value` , `class` , `sort_order` )  VALUES ( '$orders_id' , 'Shipping' , '\$$shippingtotal' , '$shippingtotal' , 'ot_shipping' , '2' )";
    $queryexe = mysql_query($sql);
    $sql = "INSERT INTO `orders_total` ( `orders_id` , `title` , `text` , `value` , `class` , `sort_order` )  VALUES ( '$orders_id' , 'Total' , '\$$ordertotal' , '$ordertotal' , 'ot_total' , '4' )";
    $queryexe = mysql_query($sql);

    // SAVE PRODUCT CATEGORIES TO ORDERS_PRODUCTS TABLE
    for ($_i = 0; $_i < $_nNumCartItems; $_i++) {
      $_idcount = $_i + 1;
      $Query = "SELECT categories_name FROM categories_description cd, products_to_categories pc WHERE cd.categories_id = pc.categories_id AND pc.products_id = $_sCartItemNums[$_i]";
      $queryexe = mysql_query($Query);

      if ($myrow = mysql_fetch_array($queryexe)) {
	  do {
	    $sql = "INSERT INTO `orders_products` ( `orders_id` , `products_id` , `products_model` , `products_name` , `products_price` , `final_price` , `products_quantity` )  VALUES ( '$orders_id' , '$_sCartItemNums[$_i]' , '<b><i>".$myrow["categories_name"]."</i></b>' , '".$myrow["categories_name"]."' , '$_sCartItemTotal[$_i]' , '$_sCartItemTotal[$_i]' , 1  )";
	    $queryexe4 = mysql_query($sql);

	    // GET NEW ORDERS PRODUCTS ID
	    $Query5 = "SELECT * FROM orders_products ORDER BY orders_products_id";
	    $queryexe5 = mysql_query($Query5);
	    mysql_data_seek($queryexe5, mysql_num_rows($queryexe5)-1);
	    $myrow5 = mysql_fetch_array($queryexe5);
	    $orders_products_id = $myrow5["orders_products_id"];

            // SAVE PRODUCT ATTRIBUTES FOR THE CATEGORY

        if ($_sCartItemColors[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Colors' , '$_sCartItemColors[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemPaper[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Paper' , '$_sCartItemPaper[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemCoating[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Coating' , '$_sCartItemCoating[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemNumberofpages[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Number of Pages' , '$_sCartItemNumberofpages[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemCoverpaper[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Cover Paper' , '$_sCartItemCoverpaper[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemInsidepagespaper[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Inside Pages Paper' , '$_sCartItemInsidepagespaper[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemBinding[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Binding' , '$_sCartItemBinding[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemHoledrilling[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Hole Drilling' , '$_sCartItemHoledrilling[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemPerforation[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Perforation' , '$_sCartItemPerforation[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemUpgradestock[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Upgrade Stock to 12pt' , '$_sCartItemUpgradestock[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemSecondsheets[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Second Sheets' , '$_sCartItemSecondsheets[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemSlotorientation[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Slot Orientation' , '$_sCartItemSlotorientation[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemBusinesscardslot[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Business Card Slot' , '$_sCartItemBusinesscardslot[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemEnvelopesize[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Envelope Size' , '$_sCartItemEnvelopesize[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemPaperfold[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Paper Fold' , '$_sCartItemPaperfold[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemPostcardsize[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Post Card Size' , '$_sCartItemPostcardsize[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }
        if ($_sCartItemScoring[$_i] != '') {
	      $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Scoring' , '$_sCartItemScoring[$_i]'  )";
	      $queryexe6 = mysql_query($sql2);
	    }

	    $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Turnaround' , '$_sCartItemTurnaround[$_i]'  )";
	    $queryexe6 = mysql_query($sql2);
	    $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Proof' , '$_sCartItemProof[$_i]'  )";
	    $queryexe6 = mysql_query($sql2);
	    $sql2 = "INSERT INTO `orders_products_attributes` ( `orders_id` , `orders_products_id` , `products_options` , `products_options_values` )  VALUES ( '$orders_id' , '$orders_products_id' , 'Colors' , '$_sCartItemQuantity[$_i]'  )";
	    $queryexe6 = mysql_query($sql2);


          } while ($myrow = mysql_fetch_array($queryexe));
      }

    }

	$mkdirMethod = "FTP";
	define('FTPSERVER','ftp.imageteam.com');
	define('FTPLOGIN','imageteam');
	define('FTPPASSWORD','mmtldm6');

	# PhpCollab root according to ftp account (only if $mkdirMethod == "FTP")
	$ftpRoot = "/var/www/html/inkrockit.com/filestorage"; //no slash at the end

	function createDirectory($path) {
	global $mkdirMethod,$ftpRoot;
	if($mkdirMethod == "FTP") {
		$pathNew = $ftpRoot."/".$path;
		$ftp = ftp_connect(FTPSERVER);
		ftp_login($ftp,FTPLOGIN,FTPPASSWORD);
		ftp_chdir($ftp, $ftpRoot);
		ftp_mkdir($ftp, $path);
		ftp_quit($ftp);
	} else {
		@move_uploaded_file($source, "../".$path."/".$dest);
	}
	}

	$project = $_SESSION['orders_id'];
	createDirectory("$project");
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
?>
<table style="text-align:left;" border="0" width="480" cellpadding="0" cellspacing="0" bgcolor="white" align="center">
  <tr>
    <td valign="top" align="left" ><!-- #BeginEditable "555" -->
      <table width="100%" border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td>
              <form action="upload.php" method="POST">
              <?
  if ($_nNumCartItems == 0) {
    print("There are no items in your shopping cart.<br>");
  } else {
?>
<div align="right"><a href="javascript:printWindow()"><font face="Verdana,Arial" color="#000000" size="-2"><u>Print This Page</u></font></a>&nbsp;&nbsp;&nbsp;</div>
<div align="left">
  <font face="Verdana,Arial" color="#000000" size="-1"><b>Your Confirmation Number: <? print ($orders_id); ?></b>
  <br>Date of Order: <? print ($date_purchased); ?></font>
</div>
            <table border="1" cellpadding="5" cellspacing="0" width="470">
              <tr bgcolor="#818181">
                <th ><font face="Verdana,Arial" color="#ffffff" size="-1"><center>ITEM</center></font></td>
                <th ><font face="Verdana,Arial" color="#ffffff" size="-1"><center>SHIP TO</center></font></td>
                <th ><font face="Verdana,Arial" color="#ffffff" size="-1"><center>DELIVERY</center></font></td>
                <th ><font face="Verdana,Arial" color="#ffffff" size="-1"><center>PRICE</center></font></td>
              </tr>
              <?
  $_cSubTotal = 0;
  $_nNumItems = 0;
  $_cShipping = 0;
  $_cShippingamount = 0;

  for ($_i = 0; $_i < $_nNumCartItems; $_i++) {
    $_idcount = $_i + 1;
    $Query = "SELECT categories_name FROM categories_description cd, products_to_categories pc WHERE cd.categories_id = pc.categories_id AND pc.products_id = $_sCartItemNums[$_i]";
    $queryexe = mysql_query($Query);

    if ($myrow = mysql_fetch_array($queryexe)) {
	  do {
?>
              <tr align="left" >
                <td align="left" valign="top"> <font face="Verdana,Arial" color="#000000" size="-1">
                  <b><? print($myrow["categories_name"]); ?></b><br>
                  <? if ($_sCartItemColors[$_i] != '') { ?>
                  Colors: <font size="-2"><? print $_sCartItemColors[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemPaper[$_i] != '') { ?>
                  Paper: <font size="-2"><? print $_sCartItemPaper[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemCoating[$_i] != '') { ?>
                  Coating: <font size="-2"><? print $_sCartItemCoating[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemNumberofpages[$_i] != '') { ?>
                  Number of Pages: <font size="-2"><? print $_sCartItemNumberofpages[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemCoverpaper[$_i] != '') { ?>
                  Cover Paper: <font size="-2"><? print $_sCartItemCoverpaper[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemInsidepagespaper[$_i] != '') { ?>
                  Inside Pages Paper: <font size="-2"><? print $_sCartItemInsidepagespaper[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemBinding[$_i] != '') { ?>
                  Binding: <font size="-2"><? print $_sCartItemBinding[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemHoledrilling[$_i] != '') { ?>
                  Hole Drilling: <font size="-2"><? print $_sCartItemHoledrilling[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemPerforation[$_i] != '') { ?>
                  Perforation: <font size="-2"><? print $_sCartItemPerforation[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemUpgradestock[$_i] != '') { ?>
                  Upgrade Stock to 12pt: <font size="-2"><? print $_sCartItemUpgradestock[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemSecondsheets[$_i] != '') { ?>
                  Second Sheets: <font size="-2"><? print $_sCartItemSecondsheets[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemSlotorientation[$_i] != '') { ?>
                  Slot Orientation: <font size="-2"><? print $_sCartItemSlotorientation[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemBusinesscardslot[$_i] != '') { ?>
                  Business Card Slot: <font size="-2"><? print $_sCartItemBusinesscardslot[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemEnvelopesize[$_i] != '') { ?>
                  Envelope Size: <font size="-2"><? print $_sCartItemEnvelopesize[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemPaperfold[$_i] != '') { ?>
                  Paper Fold: <font size="-2"><? print $_sCartItemPaperfold[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemPostcardsize[$_i] != '') { ?>
                  Post Card Size: <font size="-2"><? print $_sCartItemPostcardsize[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemScoring[$_i] != '') { ?>
                  Scoring: <font size="-2"><? print $_sCartItemScoring[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemTurnaround[$_i] != '') { ?>
                  Turnaround: <font size="-2"><? print $_sCartItemTurnaround[$_i]; ?></font><br>
                  <? } ?>
                  <? if ($_sCartItemProof[$_i] != '') { ?>
                  Proof: <font size="-2"><? print $_sCartItemProof[$_i]; ?></font><br>
                  <? } ?>
                  Qty: <font size="-2"><? print $_sCartItemQuantity[$_i]; ?></font><br>
                  </font></td>
                <td valign="top">
                <?
                    $Query2 = "SELECT * FROM address_book WHERE addresstype = 'S' AND address_book_id = " . $ship_address_id . " AND customers_id = " . $_SESSION['customers_id'];
				    $queryexe2 = mysql_query($Query2);

				    if ($myrow2 = mysql_fetch_array($queryexe2)) {
				      $addidentifier = $myrow2["addidentifier"];
				      $firstname = $myrow2["entry_firstname"];
				      $lastname = $myrow2["entry_lastname"];
				      $company = $myrow2["entry_company"];
				      $street_address = $myrow2["entry_street_address"];
				      $city = $myrow2["entry_city"];
				      $state = $myrow2["entry_state"];
				      $postcode = $myrow2["entry_postcode"];
                    }
                ?>
                <font face="Verdana,Arial" color="#000000" size="-1">
                <? print $firstname; ?> <? print $lastname; ?><br>
                <? if ($company != '') { ?>
                  <? print $company; ?><br>
                <? } ?>
                <? print $street_address; ?><br>
                <? print $city; ?>, <? print $state; ?> <? print $postcode; ?>
                </font>
                </td>
                <td align="left" valign="top"> <font face="Verdana,Arial" color="#000000" size="-1">
                  STANDARD<br>
                  +$14.95<br>
                  5-7 business<br>
                  days
                  </font></td>
                <?
                    $_cShippingamount = $_cShippingamount + 14.95;
                    $_cPrice = $_sCartItemTotal[$_i];
                ?>
                <td align="right" valign="top"> <font face="Verdana,Arial" color="#000000" size="-1">
                  <b><?
                    $_cPrice = sprintf("%01.2f", $_cPrice);
                    print("\$$_cPrice");
                    $_cSubTotal = $_cSubTotal + $_cPrice;
                  ?></b>
                  </font></td>
              </tr>
              <?
  } while ($myrow = mysql_fetch_array($queryexe));
} else {
  echo "<tr><td colspan=3><font face='Arial' size='2'>Sorry, no product information is currently available.</font></td></tr>";
}

}
              ?>
              <tr bgcolor="#ffffff">
                <th align="right" colspan="3"> <font face="Verdana,Arial" size="-1" color="#818181">SUBTOTAL</font></td>
                <th align="right"><font face="Verdana,Arial" size="-1" color="#F66508">
                  <?
                    print("<input type='hidden' name='subtotaltotal' value='$_cSubTotal'>");
                    $_cSubTotal2 = $_cSubTotal;
                    $_cSubTotal = sprintf("%01.2f", $_cSubTotal);
                    print("\$$_cSubTotal");
                  ?>
                  </font></td>
              </tr>
              <tr bgcolor="#ffffff">
                <th align="right" colspan="3"> <font face="Verdana,Arial" size="-1" color="#818181">SHIPPING & HANDLING</font></td>
                <th align="right"><font face="Verdana,Arial" size="-1" color="#F66508">
                  <?
                    print("<input type='hidden' name='shippingtotal' value='$_cShippingamount'>");
                    $_cShippingamount = sprintf("%01.2f", $_cShippingamount);
                    print("\$$_cShippingamount");
                  ?>
                  </font></td>
              </tr>
              <? $_cTotal = $_cSubTotal + $_cShippingamount ?>
              <tr >
                <th align="right" colspan = "3" bgcolor="#818181"> <font face="Verdana,Arial" size="-1" color="#ffffff">TOTAL AMOUNT
                  PAID</font></td>
                <th align="right" bgcolor="#F66508"><font face="Verdana,Arial" size="-1" color="#ffffff">
                  <?
                    print("<input type='hidden' name='ordertotal' value='$_cTotal'>");
                    $_cTotal = sprintf("%01.2f", $_cTotal);
                    print("\$$_cTotal");
                    print("<input type='hidden' name='TOTAL' value='\$$_cTotal'>");
                  ?>
                  </font></td>
              </tr>
            </table>
            <br><br>
            <table border="1" cellpadding="5" cellspacing="0" width="470">
              <tr bgcolor="#818181">
                <th width="50%"><font face="Verdana,Arial" color="#ffffff" size="-1"><center>CREDIT CARD INFORMATION</center></font></td>
                <th width="50%"><font face="Verdana,Arial" color="#ffffff" size="-1"><center>BILLING ADDRESS</center></font></td>
              </tr>
              <tr align="left" >
                <td valign="top" width="50%">
                <?
                    $Query2 = "SELECT * FROM payment_book WHERE payment_book_id = " . $payment_id . " AND customers_id = " . $_SESSION['customers_id'];
				    $queryexe2 = mysql_query($Query2);

				    if ($myrow2 = mysql_fetch_array($queryexe2)) {
				      $payment_identifier = $myrow2["payment_identifier"];
				      $cctype = $myrow2["cctype"];
				      $ccnumber = $myrow2["ccnumber"];
				      $ccexpdate = $myrow2["ccexpdate"];
				      $ccseccode = $myrow2["ccseccode"];
				      $nameoncard = $myrow2["nameoncard"];
                    }
                ?>
                <font face="Verdana,Arial" color="#000000" size="-1">
                <? print $cctype; ?><br>
                <? print $nameoncard; ?><br>
                XXXXXXXXXXXX-<?print(substr($ccnumber,strlen($ccnumber)-4,4));?><br>
                Expiration Date: <? print $ccexpdate; ?>
                </font>
                </td>
                <td valign="top" width="50%">
                <?
                    $Query2 = "SELECT * FROM address_book WHERE addresstype = 'B' AND address_book_id = " . $bill_address_id . " AND customers_id = " . $_SESSION['customers_id'];
				    $queryexe2 = mysql_query($Query2);

				    if ($myrow2 = mysql_fetch_array($queryexe2)) {
				      $addidentifier = $myrow2["addidentifier"];
				      $firstname = $myrow2["entry_firstname"];
				      $lastname = $myrow2["entry_lastname"];
				      $company = $myrow2["entry_company"];
				      $street_address = $myrow2["entry_street_address"];
				      $city = $myrow2["entry_city"];
				      $state = $myrow2["entry_state"];
				      $postcode = $myrow2["entry_postcode"];
                    }
                ?>
                <font face="Verdana,Arial" color="#000000" size="-1">
                <? print $firstname; ?> <? print $lastname; ?><br>
                <? if ($company != '') { ?>
                  <? print $company; ?><br>
                <? } ?>
                <? print $street_address; ?><br>
                <? print $city; ?>, <? print $state; ?> <? print $postcode; ?>
                </font>
                </td>
              </tr>
            </table>
            <br>
            <table border="0" cellpadding="5" cellspacing="0" width="470">
              <tr>
                <td class="style17" width="60%">Now that you’ve paid for your order, it’s time to upload your files to complete the order process. If your files are not ready to be uploaded, you can come back to this site, go to Order Status, and continue with this order.
                </td>
                <td width="40%">
                  <input type="image" src="images/inner/gotoupload.jpg" width="163" height="40" border="0" value="Place My Order" name="cmdSubmit" id="cmdSubmit" alt="Place My Order">
                </td>
               </tr>
            </table>

         <? } ?>
          </form>
         </td>
        </tr>
      </table>
      <!-- #EndEditable -->
    </td>
  </tr>
</table>


