<p class="style25">Shipping Information - <a href="addshipping.php"><font class="style17" color="#000000">Add New</font></a> </p>
<table border="1" cellpadding="5" cellspacing="0" >
<tr>
  <td class="style15"><div align="center">Identifier</div></td>
  <td class="style15"><div align="center">Name</div></td>
  <td class="style15"><div align="center">Address</div></td>
  <td class="style15"><div align="center">City, State, Zip</div></td>
</tr>
<?
 $Query = "SELECT * FROM address_book WHERE addresstype = 'S' AND customers_id = " . $_SESSION['customers_id'];
 $queryexe = mysql_query($Query);
 if ($myrow = mysql_fetch_array($queryexe)) {
   do {
?>
<tr>
  <td class="style17"><a href="editshipping.php?ID=<?print($myrow[address_book_id]);?>"><font color="#000000"><?print($myrow[addidentifier]);?></font></a></td>
  <td class="style17"><?print($myrow[entry_firstname]);?> <?print($myrow[entry_lastname]);?></td>
  <td class="style17"><?print($myrow[entry_street_address]);?></td>
  <td class="style17"><?print($myrow[entry_city]);?>, <?print($myrow[entry_state]);?>, <?print($myrow[entry_postcode]);?></td>
</tr>
<?
   } while ($myrow = mysql_fetch_array($queryexe));
 }
?>
</table>
<p class="style25">Billing Information - <a href="addbilling.php"><font class="style17" color="#000000">Add New</font></a> </p>
<table border="1" cellpadding="5" cellspacing="0" >
<tr>
  <td class="style15"><div align="center">Identifier</div></td>
  <td class="style15"><div align="center">Name</div></td>
  <td class="style15"><div align="center">Address</div></td>
  <td class="style15"><div align="center">City, State, Zip</div></td>
</tr>
<?
 $Query = "SELECT * FROM address_book WHERE addresstype = 'B' AND customers_id = " . $_SESSION['customers_id'];
 $queryexe = mysql_query($Query);
 if ($myrow = mysql_fetch_array($queryexe)) {
   do {
?>
<tr>
  <td class="style17"><a href="editbilling.php?ID=<?print($myrow[address_book_id]);?>"><font color="#000000"><?print($myrow[addidentifier]);?></font></a></td>
  <td class="style17"><?print($myrow[entry_firstname]);?> <?print($myrow[entry_lastname]);?></td>
  <td class="style17"><?print($myrow[entry_street_address]);?></td>
  <td class="style17"><?print($myrow[entry_city]);?>, <?print($myrow[entry_state]);?>, <?print($myrow[entry_postcode]);?></td>
</tr>
<?
   } while ($myrow = mysql_fetch_array($queryexe));
 }
?>
</table>
<p class="style25">Payment Information - <a href="addpayment.php"><font class="style17" color="#000000">Add New</font></a> </p>
<table border="1" cellpadding="5" cellspacing="0" width="95%">
<tr>
  <td class="style15"><div align="center">Identifier</div></td>
  <td class="style15"><div align="center">CC Type</div></td>
  <td class="style15"><div align="center">Name on Card</div></td>
  <td class="style15"><div align="center">CC Number</div></td>
  <td class="style15"><div align="center">Exp Date</div></td>
</tr>
<?
 $Query = "SELECT * FROM payment_book WHERE customers_id = " . $_SESSION['customers_id'];
 $queryexe = mysql_query($Query);
 if ($myrow = mysql_fetch_array($queryexe)) {
   do {
?>
<tr>
  <td class="style17"><a href="editpayment.php?ID=<?print($myrow[payment_book_id]);?>"><font color="#000000"><?print($myrow[payment_identifier]);?></font></a></td>
  <td class="style17"><?print($myrow[cctype]);?></td>
  <td class="style17"><?print($myrow[nameoncard]);?></td>
  <td class="style17">XXXXXXXXXXXX-<?print(substr($myrow[ccnumber],strlen($myrow[ccnumber])-4,4));?></td>
  <td class="style17"><?print($myrow[ccexpdate]);?></td>
</tr>
<?
   } while ($myrow = mysql_fetch_array($queryexe));
 }
?>
</table>
<br><br>