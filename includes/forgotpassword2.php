<?php

  require('includes/mime.php');
  require('includes/email.php');

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

////
//! Send email (text/html) using MIME
// This is the central mail function. The SMTP Server should be configured
// correct in php.ini
// Parameters:
// $to_name           The name of the recipient, e.g. "Jan Wildeboer"
// $to_email_address  The eMail address of the recipient,
//                    e.g. jan.wildeboer@gmx.de
// $email_subject     The subject of the eMail
// $email_text        The text of the eMail, may contain HTML entities
// $from_email_name   The name of the sender, e.g. Shop Administration
// $from_email_adress The eMail address of the sender,
//                    e.g. info@mytepshop.com

  function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address) {
    // Instantiate a new mail object
    $message = new email(array('X-Mailer: osCommerce Mailer'));

    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
      $message->add_html($email_text, $text);
    } else {
      $message->add_text($text);
    }

    // Send message
    $message->build_message();
    $message->send($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject);
  }

	define('EMAIL_PASSWORD_REMINDER_SUBJECT', 'InkRockit - New Password');
	define('EMAIL_PASSWORD_REMINDER_BODY', 'A new password was requested from ' . $REMOTE_ADDR . '.' . "\n\n" . 'Your new password to \'InkRockit\' is:' . "\n\n" . '   %s' . "\n\n");

    $email_address = $HTTP_POST_VARS['email_address'];

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
	mysql_select_db ("db37838_imageteam_com_catalog");

	$Query = "select customers_firstname, customers_lastname, customers_password, customers_id FROM customers WHERE customers_email_address = '" . $email_address . "'";
    $queryexe = mysql_query($Query);

    if ($check_customer = mysql_fetch_array($queryexe)) {

      $new_password = tep_create_random_value(5);
      $crypted_password = tep_encrypt_password($new_password);

      $sql = "update customers set customers_password = '" . $crypted_password . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'";
      $queryexe = mysql_query($sql);

      tep_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password), 'info', 'info@inkrockit.com');

      print('<div class="style16"><br><br>Success: A new password has been sent to your e-mail address.<br><br><a href="login.php"><img src="images/button_back.gif" border="0" alt="Back" title=" Back " width="100" height="22"></a></div>');
    } else {
      print('<div class="style16"><br><br>Error: The E-Mail Address was not found in our records, please try again.<br><br><a href="forgotpassword.php"><img src="images/button_back.gif" border="0" alt="Back" title=" Back " width="100" height="22"></a></div>');
    }

?>
