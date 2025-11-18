<?
    session_start();
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $customers_id = $_SESSION['customers_id'];

    $sql = "INSERT INTO `address_book` ( `customers_id` , `addidentifier` , `entry_company` , `entry_firstname` , `entry_lastname` , `entry_street_address` , `entry_city` , `entry_state` , `entry_postcode` , `entry_country_id` , `addresstype` )  VALUES ( '$customers_id',  '$Shipping_Identifier',  '$entry_company',  '$Shipping_First_Name',  '$Shipping_Last_Name',  '$Shipping_Street_Address',  '$Shipping_City',  '$Shipping_State',  '$Shipping_Postal_Code',  '$entry_country_id',  'S' )";
    $queryexe = mysql_query($sql);

    header("Location: revieworder.php");
?>


