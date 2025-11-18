<?
  session_start();
?>
<?
  require('includes/db_connection.php');

    $sql = "INSERT INTO `customers` ( `customers_firstname` , `customers_lastname` , `customers_email_address` , `customers_telephone` , `customers_fax` , `customers_password`  )  VALUES ( '$firstname',  '$lastname',  '$email',  '$telephone',  '$fax',  '$password' )";
    $queryexe = mysql_query($sql);

    $Query = "SELECT * FROM customers ORDER BY customers_id";
    $queryexe = mysql_query($Query);
    mysql_data_seek($queryexe, mysql_num_rows($queryexe)-1);
    $myrow = mysql_fetch_array($queryexe);
    $custID = $myrow["customers_id"];

    $sql = "INSERT INTO `address_book` ( `customers_id` , `addidentifier` , `entry_company` , `entry_firstname` , `entry_lastname` , `entry_street_address` , `entry_city` , `entry_state` , `entry_postcode` , `entry_country_id`  )  VALUES ( '$custID',  '$shipaddressident',  '$company',  '$sfirstname',  '$slastname',  '$streetaddress',  '$city',  '$state',  '$postalcode',  '$country' )";
    $queryexe = mysql_query($sql);

    $sql = "INSERT INTO `payment_book` ( `customers_id` , `payment_identifier` , `cctype` , `ccnumber` , `ccexpdate` , `ccseccode` , `nameoncard` )  VALUES ( '$custID',  '$paymentident',  '$cctype',  '$ccnumber',  '$expdate',  '$seccode',  '$nameoncard' )";
    $queryexe = mysql_query($sql);

  header('Location: ordersummary.php');

?>
