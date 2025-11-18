<?
    session_start();
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $customers_id = $_SESSION['customers_id'];

    if ($Submit == 'Delete Payment') {
	  $sql = "DELETE FROM payment_book where customers_id = '" . $customers_id . "' AND payment_book_id = '" . $ID . "'";
	  $queryexe = mysql_query($sql);
    } else {
	  $sql = "update payment_book set payment_identifier = '" . $Payment_Identifier . "', cctype = '" . $Credit_Card_Type . "', ccnumber = '" . $Credit_Card_Number . "', ccexpdate = '" . $Expiration_Date . "', ccseccode = '" . $Security_Code . "', nameoncard = '" . $Name_On_Card . "' where customers_id = '" . $customers_id . "' AND payment_book_id = '" . $ID . "'";
	  $queryexe = mysql_query($sql);
	}

    header("Location: revieworder.php");
?>

<? print $Submit;?>
