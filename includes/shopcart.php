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

      $Query = "SELECT pov.products_options_values_name FROM products_attributes pa, products_options_values pov WHERE pa.options_values_id = pov.products_options_values_id and pa.options_id = 1 and pa.products_id = $_sItemNo AND pa.options_values_price = $Colors";
      $queryexe = mysql_query($Query);
      $myrow = mysql_fetch_array($queryexe);
      $_sCartItemColors[] = $myrow['products_options_values_name'];

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

<table style="text-align:left;" border="0" width="480" cellpadding="0" cellspacing="0" bgcolor="white" align="center">
  <tr>
    <td valign="top" align="left" ><!-- #BeginEditable "555" -->
      <table width="100%" border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td>
            <br>
              <? if ($_sMode == "checkout") { ?>
                <form action="revieworder.php" method="POST">
              <? } else { ?>
                <form action="shopcart.php" method="POST">
              <? } ?>
              <?
  if ($_nNumCartItems <= 0) {
    print("<center><font face='Verdana,Arial' color='#FF6100' size='-1'>There are no items in your shopping cart.</font></center><br>");
  } else {
    if ($_sMode == "checkout") {
?>

<h5>Please fill out the following information below:</h5>
<br>
<h5>Customer Information:</h5>
<br>
<TABLE  width="473">
<TR><TD width="169">Name:    </TD><TD width="294" valign="bottom"><input type="text" size="18" name="name"></TD></TR>
<TR><TD width="169">Address: </TD><TD width="294"><input type="text" size="37" name="address"> </TD></TR>
<TR><TD width="169">City:    </TD><TD width="294"><input type="text" size="21" name="city"> </TD></TR>
<TR><TD width="169">State:   </TD><TD width="294">
        <select name="state" size="1">
          <option value=""></option>
		<?
		  $Query2 = "SELECT * FROM state ORDER BY name";
		  $queryexe2 = mysql_query($Query2);
		if ($myrow2 = mysql_fetch_array($queryexe2)) {
		  do {
		?>
          <option value="<? print($myrow2["abbrev"]);?>"><? print($myrow2["name"]);?></option>
	    <?
		  } while ($myrow2 = mysql_fetch_array($queryexe2));
		}?>
        </select>
</TD></TR>
<TR><TD width="169">Zip:     </TD><TD width="294"><input type="text" size="5"  name="zip"></TD></TR>
<TR><TD width="169">Phone:   </TD><TD width="294"><input type="text" size="37" name="phone"></TD></TR>
<TR><TD width="169">Email:   </TD><TD width="294"><input type="text" size="37" name="email"> </TD></TR>
</TABLE>
<? IF (1 == 2) { ?>
<h5>Billing Information:</h5>
<br>
<TABLE  width="473">
  <tr>
    <td>Credit Card Number:</td>
    <td valign="bottom"><input type="text" name="ccnumber" size="37"></td>
  </tr>
  <tr>
    <td>Expiration Date:</td>
    <td valign="bottom"><input type="text" name="expdate" size="37"></td>
  </tr>
  <tr>
    <td>Security Code:</td>
    <td valign="bottom"><input type="text" name="seccode" size="37"></td>
  </tr>
</TABLE>
<? } ?>

<h5>Comments/Special Instructions:</h5><br>
<TEXTAREA NAME="comment" ROWS=6 COLS=40 style="font-size: 10pt; font-family: Arial; color: #000000">
</TEXTAREA>


            <?
    }
?>
<? if ($_sMode != "checkout") { ?>
            <table align="left" border="1" cellpadding="5" cellspacing="0" width="470">
              <tr bgcolor="#818181">
                <th width="295"><font face="Verdana,Arial" color="#ffffff" size="-1"><center>ITEM</center></font></td>
                <th width="100"><font face="Verdana,Arial" color="#ffffff" size="-1"><center>DELIVERY</center></font></td>
                <th width="75"><font face="Verdana,Arial" color="#ffffff" size="-1"><center>PRICE</center></font></td>
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

				  <?
				     if ($_sMode != "checkout") {
					   print("<a href='shopcart.php?mode=remove&ID=$_i'><font color='#3572B3'><b>Remove</b></font></a>");
				     }
                  ?>
                  </font></td>
                <td align="left" valign="top"> <font face="Verdana,Arial" color="#000000" size="-1">
                  STANDARD<br>
                  +$14.95<br>
                  5-7 business<br>
                  days
                  </font></td>
                <?
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
                <th align="right" colspan="2"> <font face="Verdana,Arial" size="-1" color="#818181">SUBTOTAL</font></td>
                <th align="right"><font face="Verdana,Arial" size="-1" color="#F66508">
                  <?
                    $_cSubTotal2 = $_cSubTotal;
                    $_cSubTotal = sprintf("%01.2f", $_cSubTotal);
                    print("\$$_cSubTotal");
                  ?>
                  </font></td>
              </tr>
              <?
                $_cShippingamount = 0;

             ?>
              <tr bgcolor="#ffffff">
                <th align="right" colspan="2"> <font face="Verdana,Arial" size="-1" color="#818181">SHIPPING & HANDLING</font></td>
                <th align="right"><font face="Verdana,Arial" size="-1" color="#F66508">
                  <?
                    $_cShippingamount = sprintf("%01.2f", $_cShippingamount);
                    print("\$$_cShippingamount");
                  ?>
                  </font></td>
              </tr>
              <? $_cTotal = $_cSubTotal + $_cShippingamount ?>
              <tr >
                <th align="right" colspan = "2" bgcolor="#818181"> <font face="Verdana,Arial" size="-1" color="#ffffff">YOUR
                  TOTAL</font></td>
                <th align="right" bgcolor="#F66508"><font face="Verdana,Arial" size="-1" color="#ffffff">
                  <?
                    $_cTotal = sprintf("%01.2f", $_cTotal);
                    print("\$$_cTotal");
                    print("<input type='hidden' name='TOTAL' value='\$$_cTotal'>");
                  ?>
                  </font></td>
              </tr>
              <tr>
                <td colspan="3" align="center">
              <? if ($_sMode != "checkout") { ?>
              <? } ?>
              <? if ($_sMode == "checkout") { ?>
            <FONT ><b><input class="btn" type=submit Value="Review Order"> <INPUT class="btn" type=RESET value="  Clear Form  ">
               </b></font></p>
              <? } else { ?>
              <input type="hidden" name="cmdSubmit" value="Proceed to Checkout">
              <input type="image" src="images/inner/placemyorder.jpg" width="181" height="30" border="0" value="Proceed to Checkout" name="cmdSubmit" id="cmdSubmit" alt="Proceed to Checkout">
              <? } ?>
                 </td>
               </tr>
            </table>
         <? } ?>
          </form>
          <? } ?></td>
        </tr>
      </table>
      <!-- #EndEditable -->
    </td>
  </tr>
</table>


