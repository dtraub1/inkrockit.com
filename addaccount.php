<?
    session_start();
?>
<?

  // This function makes a new password from a plaintext password.
    function tep_encrypt_password($plain) {
      $password = '';

      for ($i=0; $i<10; $i++) {
        $password .= tep_rand();
      }

      $salt = substr(md5($password), 0, 2);

      $password = md5($salt . $plain) . ':' . $salt;

      return $password;
    }

  // Return a random value
    function tep_rand($min = null, $max = null) {
      static $seeded;

      if (!isset($seeded)) {
        mt_srand((double)microtime()*1000000);
        $seeded = true;
      }

      if (isset($min) && isset($max)) {
        if ($min >= $max) {
          return $min;
        } else {
          return mt_rand($min, $max);
        }
      } else {
        return mt_rand();
      }
    }

    function tep_create_random_value($length, $type = 'mixed') {
      if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;

      $rand_value = '';
      while (strlen($rand_value) < $length) {
        if ($type == 'digits') {
          $char = tep_rand(0,9);
        } else {
          $char = chr(tep_rand(0,255));
        }
        if ($type == 'mixed') {
          if (eregi('^[a-z0-9]$', $char)) $rand_value .= $char;
        } elseif ($type == 'chars') {
          if (eregi('^[a-z]$', $char)) $rand_value .= $char;
        } elseif ($type == 'digits') {
          if (ereg('^[0-9]$', $char)) $rand_value .= $char;
        }
      }

      return $rand_value;
    }

    $encryppassword = tep_encrypt_password($Customer_Password);

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $sql = "INSERT INTO `customers` ( `customers_firstname` , `customers_lastname` , `customers_email_address` , `customers_telephone` , `customers_fax` , `customers_password` )  VALUES ( '$Customer_First_Name',  '$Customer_Last_Name',  '$Customer_Email',  '$Customer_Telephone',  '$customers_fax',  '$encryppassword' )";
    $queryexe = mysql_query($sql);

	$Query3 = "SELECT customers_id FROM customers WHERE customers_email_address = '" . $Customer_Email . "'";
	$queryexe3 = mysql_query($Query3);
	$myrow3 = mysql_fetch_array($queryexe3);
	$customers_id = $myrow3[customers_id];

    $sql = "INSERT INTO `address_book` ( `customers_id` , `addidentifier` , `entry_company` , `entry_firstname` , `entry_lastname` , `entry_street_address` , `entry_city` , `entry_state` , `entry_postcode` , `entry_country_id` , `addresstype` )  VALUES ( '$customers_id',  'DEFAULT-Shipping Address',  '',  '$Customer_First_Name',  '$Customer_Last_Name',  '$Shipping_Street_Address',  '$Shipping_City',  '$Shipping_State',  '$Shipping_Postal_Code',  '$entry_country_id',  'S' )";
    $queryexe = mysql_query($sql);

	$Query4 = "SELECT address_book_id FROM address_book WHERE customers_id = '" . $customers_id . "' AND addresstype='S'";
	$queryexe4 = mysql_query($Query4);
	$myrow4 = mysql_fetch_array($queryexe4);
	$address_book_id = $myrow4[address_book_id];

	$sql = "update customers set customers_default_address_id = '" . $address_book_id . "' where customers_id = '" . $customers_id . "'";
	$queryexe = mysql_query($sql);

    $sql = "INSERT INTO `address_book` ( `customers_id` , `addidentifier` , `entry_company` , `entry_firstname` , `entry_lastname` , `entry_street_address` , `entry_city` , `entry_state` , `entry_postcode` , `entry_country_id` , `addresstype` )  VALUES ( '$customers_id',  'DEFAULT-Billing Address',  '',  '$Customer_First_Name',  '$Customer_Last_Name',  '$Shipping_Street_Address',  '$Shipping_City',  '$Shipping_State',  '$Shipping_Postal_Code',  '$entry_country_id',  'B' )";
    $queryexe = mysql_query($sql);

    $expdate = $Expiration_Date_Month."/".$Expiration_Date_Year;
    $sql = "INSERT INTO `payment_book` ( `customers_id` , `payment_identifier` , `cctype` , `ccnumber` , `ccexpdate` , `ccseccode` , `nameoncard` )  VALUES ( '$customers_id',  '$Credit_Card_Type',  '$Credit_Card_Type',  '$Credit_Card_Number',  '$expdate',  '$Security_Code',  '$Name_On_Card' )";
    $queryexe = mysql_query($sql);

    $date_customer = date("Ymd");
    $sql = "INSERT INTO `customers_info` ( `customers_info_id` , `customers_info_date_of_last_logon` , `customers_info_date_account_created` , `customers_info_date_account_last_modified` )  VALUES ( '$customers_id',  '$Credit_Card_Type',  '$date_customer',  '$date_customer',  '$date_customer' )";
    $queryexe = mysql_query($sql);

    $_SESSION['customers_id'] = $customers_id;
    header("Location: revieworder.php");
?>
<? print($_SESSION['customers_id']); ?>- ID<br>

