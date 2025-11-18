<?
    session_start();
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $customers_id = $_SESSION['customers_id'];

    $sql = "INSERT INTO `payment_book` ( `customers_id` , `payment_identifier` , `cctype` , `ccnumber` , `ccexpdate` , `ccseccode` , `nameoncard` )  VALUES ( '$customers_id',  '$Payment_Identifier',  '$Credit_Card_Type',  '$Credit_Card_Number',  '$Expiration_Date',  '$Security_Code',  '$Name_On_Card' )";
    $queryexe = mysql_query($sql);

    header("Location: revieworder.php");
?>


