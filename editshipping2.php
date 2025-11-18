<?
    session_start();
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $customers_id = $_SESSION['customers_id'];

    if ($Submit == 'Delete Shipping') {
	  $sql = "DELETE FROM address_book where customers_id = '" . $customers_id . "' AND address_book_id = '" . $ID . "'";
	  $queryexe = mysql_query($sql);
    } else {
	  $sql = "update address_book set addidentifier = '" . $Shipping_Identifier . "', entry_company = '" . $entry_company . "', entry_firstname = '" . $Shipping_First_Name . "', entry_lastname = '" . $Shipping_Last_Name . "', entry_street_address = '" . $Shipping_Street_Address . "', entry_city = '" . $Shipping_City . "', entry_state = '" . $Shipping_State . "', entry_postcode = '" . $Shipping_Postal_Code . "', entry_country_id = '" . $entry_country_id . "' where customers_id = '" . $customers_id . "' AND address_book_id = '" . $ID . "'";
	  $queryexe = mysql_query($sql);
	}

    header("Location: revieworder.php");
?>


<? print $Submit;?>