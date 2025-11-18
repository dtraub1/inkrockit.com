<?
    session_start();
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $customers_id = $_SESSION['customers_id'];

    $sql = "INSERT INTO `address_book` ( `customers_id` , `addidentifier` , `entry_company` , `entry_firstname` , `entry_lastname` , `entry_street_address` , `entry_city` , `entry_state` , `entry_postcode` , `entry_country_id` , `addresstype` )  VALUES ( '$customers_id',  '$Billing_Identifier',  '$bill_entry_company',  '$Billing_First_Name',  '$Billing_Last_Name',  '$Billing_Street_Address',  '$Billing_City',  '$Billing_State',  '$Billing_Postal_Code',  '$bill_entry_country_id',  'B' )";
    $queryexe = mysql_query($sql);

    header("Location: revieworder.php");
?>


