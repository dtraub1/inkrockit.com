<?php
session_start();

function add_user_func($company)
{
    mysql_query('INSERT INTO users (login,password,email,first_name,last_name,group_id,user_abbr,company_id,street,street2,city,state,zipcode,phone,phone_ext,position,industry,fax,country) 
                    VALUES ("' . mysql_real_escape_string($_POST['email']) . '","","' . mysql_real_escape_string($_POST['email']) . '","' . convFormat($_POST['fname']) . '",
                        "' . convFormat($_POST['lname']) . '",1,"","' . $company . '","' . convFormat($_POST['street']) . '","' . convFormat($_POST['street2']) . '","' . convFormat($_POST['city']) . '",
                        "' . mysql_real_escape_string($_POST['state']) . '","' . mysql_real_escape_string($_POST['zip']) . '","' . mysql_real_escape_string($_POST['phone']) . '", "' . mysql_real_escape_string($_POST['ext']) . '",
                        "' . mysql_real_escape_string($_POST['position']) . '","' . mysql_real_escape_string($_POST['industry']) . '","' . mysql_real_escape_string($_POST['fax']) . '",
                        "' . mysql_real_escape_string($_POST['country']) . '")');
    $user_id = mysql_insert_id();
    mysql_query('INSERT INTO credit_card_shipping (user_id,company_id,title,first_name,last_name,company,address,address2,suite,city,state,zip,country,phone,email,public) 
                VALUES ("' . $user_id . '","' . $company . '","default","' . mysql_real_escape_string($_POST['fname']) . '","' . mysql_real_escape_string($_POST['lname']) . '",
                    "' . mysql_real_escape_string($_POST['co']) . '","' . mysql_real_escape_string($_POST['street']) . '","' . mysql_real_escape_string($_POST['street2']) . '","","' . mysql_real_escape_string($_POST['city']) . '",
                        "' . mysql_real_escape_string($_POST['state']) . '","' . mysql_real_escape_string($_POST['zip']) . '","' . mysql_real_escape_string($_POST['country']) . '",
                            "' . mysql_real_escape_string($_POST['phone']) . '","' . mysql_real_escape_string($_POST['email']) . '",0)');
    mysql_query('INSERT INTO credit_card_billing (user_id,title,first_name,last_name,company,address,address2,suite,city,state,zip,country,phone,phone_ext,email,`default`,visible) 
                VALUES ("' . $user_id . '","default","' . mysql_real_escape_string($_POST['fname']) . '","' . mysql_real_escape_string($_POST['lname']) . '",
                    "' . mysql_real_escape_string($_POST['co']) . '","' . mysql_real_escape_string($_POST['street']) . '","' . mysql_real_escape_string($_POST['street2']) . '","","' . mysql_real_escape_string($_POST['city']) . '",
                        "' . mysql_real_escape_string($_POST['state']) . '","' . mysql_real_escape_string($_POST['zip']) . '","' . mysql_real_escape_string($_POST['country']) . '",
                            "' . mysql_real_escape_string($_POST['phone']) . '","' . mysql_real_escape_string($_POST['ext']) . '","' . mysql_real_escape_string($_POST['email']) . '",1,1)') or die(mysql_error());

    return $user_id;
}

function convFormat($val) {
   // return iconv("ISO-8859-1", "UTF-8//TRANSLIT", mysql_real_escape_string($val));
     return mysql_real_escape_string($val);
}

if ($_POST['email'] == "" || $_POST['country'] == 'Ukraine' || $_POST['country'] == 'Russian Federation') {

} else {

    $today = date("Ymd");
    $searchid = $_SESSION['search_id'];
    $completeaddress = mysql_real_escape_string($_POST['co']) . " \nATTN: " . mysql_real_escape_string($_POST['fname']) . " " . mysql_real_escape_string($_POST['lname']) . " \n" . mysql_real_escape_string($_POST['street']) . " \n" . mysql_real_escape_string($_POST['city']) . ", " . mysql_real_escape_string($_POST['state']) . " " . $_POST['zip'] . " \n\n(" . mysql_real_escape_string($_POST['area']) . ") " . mysql_real_escape_string($_POST['phone']);
    $keywords = (empty($_SESSION['keyword'])) ? '' : str_replace('+', ' ', $_SESSION['keyword']);
    if (empty($keywords) && !empty($searchid)) {
        $str = explode('&', $searchid);
        if (!empty($str)) {
            foreach ($str as $val) {
                $one_req = explode('=', $val);
                if (!empty($one_req) && $one_req[0] == 'q') {
                    $keywords = str_replace('+', ' ', $one_req[1]);
                    $keywords = str_replace('%20', ' ', $keywords);
                }
            }
        }
    }

    $_POST['co'] = trim($_POST['co']);

//    mysql_close();
    //new DB
    $dblink2 = mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
   // mysql_query("SET NAMES 'utf8';");
   // mysql_set_charset("utf8", $dblink2);
    mysql_select_db("preprod");

    //check company
    $comp_exist = mysql_query('SELECT id FROM users_company WHERE company="' . mysql_real_escape_string($_POST['co']) . '"');
    $comp = mysql_fetch_array($comp_exist);

    //add new company
    mysql_query('INSERT INTO users_company (company) VALUES ("' . mysql_real_escape_string($_POST['co']) . '")');
    $comp_id = mysql_insert_id();

    //keep eye on it
    mysql_query('INSERT INTO eye_user_company (uid, company_id) VALUES (1, "' . $comp_id . '")');

    //add new user
    $user['id'] = add_user_func($comp_id);
    //update company main user
    mysql_query('UPDATE users_company SET main_user="' . $user['id'] . '" WHERE id="' . $comp_id . '"');
    $req_status = 1;

    if (!empty($comp)) {
        mysql_query('UPDATE users_company SET duplicate=1 WHERE id="' . $comp_id . '"');
    }

//    if (empty($comp)) {
//        //add new company
//    } else {
//        $comp_id = $comp['id'];
//
//        //check user data
//        $user_exist = mysql_query('SELECT * FROM users WHERE company_id="' . $comp_id . '" AND email="' . mysql_real_escape_string($_POST['email']) . '" AND first_name="' . mysql_real_escape_string($_POST['fname']) . '" AND last_name="' . mysql_real_escape_string($_POST['lname']) . '"');
//        $user = mysql_fetch_array($user_exist);
//        if (empty($user)) {
//            //add new user
//            $user['id'] = add_user_func($comp_id);
//            $req_status = 1;
//        } else {
//            //check fields
//            $req_status = 1;
//            if ($user['country'] != $_POST['country'] || trim($user['city']) != trim($_POST['city']) || $user['state'] != $_POST['state'] || intval($user['zipcode']) != intval($_POST['zip']) || trim($user['street']) != trim($_POST['street'])) {
//                mysql_query('UPDATE users SET street="' . mysql_real_escape_string($_POST['street']) . '",street2="' . mysql_real_escape_string($_POST['street2']) . '",city="' . mysql_real_escape_string($_POST['city']) . '",state="' . mysql_real_escape_string($_POST['state']) . '",zipcode="' . mysql_real_escape_string($_POST['zip']) . '",phone="' . mysql_real_escape_string($_POST['phone']) . '",phone_ext="' . mysql_real_escape_string($_POST['ext']) . '",position="' . mysql_real_escape_string($_POST['position']) . '",
//                    industry="' . mysql_real_escape_string($_POST['industry']) . '", fax="' . mysql_real_escape_string($_POST['fax']) . '",country="' . mysql_real_escape_string($_POST['country']) . '" WHERE id="' . $user['id'] . '"');
//            }
////                //send confirm email
////                $link_confirm = 'http://' . $_SERVER['SERVER_NAME'] . '/request_new/confirm.php?key='. md5($comp_id . $user['id'] . 'q'); //request_new to request
////                $text_message = 'Your confirm link: <a href="' . $link_confirm . '">' . $link_confirm . '</a>';
////                $headers = "MIME-Version: 1.0\r\n";
////                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
////                $headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
////                mail($_POST['email'], 'Confirm request email', $text_message, $headers);
////                $req_status = 0;
////
////                //DELETE and ADD tmp user information
////                mysql_query('DELETE FROM users_tmp_data WHERE uid="'.$user['id'].'"');
////                mysql_query('INSERT INTO users_tmp_data (uid, country, city, state, zipcode, street, phone, phone_ext)
////                    VALUES ("'. $user['id'] .'","'.  mysql_real_escape_string($_POST['country']).'","'.  mysql_real_escape_string($_POST['city']).'",
////                        "'.  mysql_real_escape_string($_POST['state']).'","'.  mysql_real_escape_string($_POST['zip']).'",
////                        "'.  mysql_real_escape_string($_POST['street']).'","'.  mysql_real_escape_string($_POST['phone']).'","'.  mysql_real_escape_string($_POST['ext']).'")');
//        }
//    }

    $order_data = array();
    foreach (array(
                 'folders' => 'Folders',
                 'sales' => 'Sales/Product Sheets',
                 'media' => 'Media/Press Kits',
                 'brochures' => 'Brochures/Catalogs',
                 'buscards' => 'Business Cards',
                 'stationery' => 'Stationery Package',
                 'directmail' => 'Direct Mail',
                 'photoframe' => 'Photo Frame',
             ) as $k => $v) {
        if (!empty($_POST[$k])) {
            $order_data[$k] = $v;
        }
    }
    if (!empty($_POST['other'])) {
        $order_data['other'] = $_POST['othertext'];
    }
    $ref_source = (empty($_GET['src'])) ? '' : $_GET['src'];
    mysql_query('INSERT INTO requests (job_id, user_id, company_id, request_date, operating_sys, graphics_app, ref_source, other_source, processed_date, industry, conversations, complete_address, search_id, offers, order_data, tracking_number, search_keyword, user_ip, status) 
    VALUES ("", ' . $user['id'] . ', "' . $comp_id . '", NOW(), "' . mysql_real_escape_string($_POST['os']) . '", "' . mysql_real_escape_string($_POST['app']) . '", "' . mysql_real_escape_string($_POST['ref']) . '", 
        "' . mysql_real_escape_string($ref_source) . '", NULL, "' . mysql_real_escape_string($_POST['industry']) . '", "", "' . $completeaddress . '", "' . $searchid . '", "' . mysql_real_escape_string($_POST['offers']) . '", "' . mysql_real_escape_string(serialize($order_data)) . '", "", "' . $keywords . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '", "' . $req_status . '")');

    $id = mysql_insert_id();
    //add event
    mysql_query('INSERT INTO events (date,`type`,`text`,type_id) VALUES (NOW(),"new_request","","' . $id . '")');


    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    $date = date("h:i, jS F Y", time() + 3600 * 3);
    $message = "InkRockit Printed Samples Request \nDate: $date \n\n" . $_POST['co'] . " \nATTN: " . $_POST['fname'] . " " . $_POST['lname'] . " \n" . $_POST['street'] . " \n" . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip'] . " \n\n(" . $_POST['area'] . ") " . $_POST['phone'] . " \n" . $_POST['email'] . " \n\nReference Source: " . $_POST['ref'] . " \nIndustry: " . $_POST['industry'] . " \n" . $_POST['position'] . " ";
    $message = str_replace("\'", "'", $message);
    $message = $message . "\n\nOther Information\n\n";
    if ($_POST['offers'] != '') {
        $message = $message . "E-mail me with special offers from InkRockit: " . $_POST['offers'] . "\n\n";
    }
    $message = $message . "\n\nWhat products are you interested in?\n\n";
    if ($_POST['folders'] != '') {
        $message = $message . "Folders\n";
    }
    if ($_POST['media'] != '') {
        $message = $message . "Media/Press Kits\n";
    }
    if ($_POST['sales'] != '') {
        $message = $message . "Sales/Product Sheets\n";
    }
    if ($_POST['brochures'] != '') {
        $message = $message . "Brochures/Catalogs\n";
    }
    if ($_POST['buscards'] != '') {
        $message = $message . "Business Cards\n";
    }
    if ($_POST['stationery'] != '') {
        $message = $message . "Stationery Package\n";
    }
    if ($_POST['directmail'] != '') {
        $message = $message . "Direct Mail\n";
    }
    if ($_POST['photoframe'] != '') {
        $message = $message . "Photo Frame\n";
    }
    if ($_POST['other'] != '') {
        $message = $message . "Other: " . $_POST['othertext'] . "\n";
    }


//
    if (mail("leads@imageteam.com", "InkRockit Printed Samples Request", $message, $headers)) {
        mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);

        //send to user
        $fname = $_POST['fname'];
        $company = $_POST['co'];

        $comp_exist = mysql_query('SELECT val FROM settings WHERE `key`="request_email_template"');
        $comp = mysql_fetch_array($comp_exist);
        $message2 = $comp['val'];
        $message2 = str_replace(array('%name%', '%company%', "\'"), array($fname, $company, "'"), $message2);

        function mail_attachment($filename, $path, $mailto, $subject, $message)
        {
            $file = $path . $filename;
            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);
            $name = basename($file);
            $from = "Don Traub <dtraub@inkrockit.com>";
            $separator = md5(time());
            $eol = PHP_EOL;
            $attachment = chunk_split(base64_encode($content));

            $headers = "From: " . $from . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";

            $body = "--" . $separator . $eol;
            $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
//            $body .= "This is a MIME encoded message." . $eol;
            $body .= "--" . $separator . $eol;

            $body .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
            $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
            $body .= $message . $eol;

            $body .= "--" . $separator . $eol;
            $body .= "Content-Type: application/octet-stream; name=\"" . $name . "\"" . $eol;
            $body .= "Content-Transfer-Encoding: base64" . $eol;
            $body .= "Content-Disposition: attachment" . $eol . $eol;
            $body .= $attachment . $eol;
            $body .= "--" . $separator . "--";
            if (mail($mailto, $subject, $body, $headers)) {
//                echo "mail send ... OK"; // or use booleans here
            }
        }

        $my_file = "IR_ENVELOPE.pdf";
        $my_path = $_SERVER['DOCUMENT_ROOT'] . "/request/";
        $subject = "Hi " . $fname . ", welcome to InkRockit!";
        mail_attachment($my_file, $my_path, $_POST['email'], $subject, $message2);


        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
        <html>
        <head>
            <title>InkRockit - Thank You for Requesting Samples</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <style>
                a:hover {
                    color: #FFCC33;
                    text-decoration: none;
                    text-weight: 900;
                }

                a {
                    color: #FFFFFF;
                    text-decoration: none;
                    text-weight: 900;
                }
            </style>
        </head>
        <body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td valign="middle" align="center">
                    <?
                    if ($req_status == 1) {
                        ?><span style="color: #000000"><font face="Verdana" style="font-size:12pt;font-weight:bolder;">Thank you,</font><br/>
                        <font face="Verdana" style="font-size:9pt;font-weight:bolder;"> your samples will be sent by 1st class mail.<br/>
                            You should receive them within 3-5 business days.</font></span><?
                    } else {
                        ?><span style="color: #000000"><font face="Verdana" style="font-size:12pt;font-weight:bolder;">Thank you,</font><br/>
                        <font face="Verdana" style="font-size:9pt;font-weight:bolder;">for confirmation your request please confirm your email.<br/>
                        </font></span><?
                    }
                    ?>
                    <br>
                    <br>
                </td>
            </tr>
        </table>
        <div align="center">
            <script src="https://www.googletagmanager.com/gtag/js?id=AW-1071175607" type="text/javascript"></script>
            <script type="text/javascript">
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag('js', new Date());
                gtag('config', 'AW-1071175607');
                gtag('event', 'conversion', {
                    'send_to': 'AW-1071175607/6MGTCP22RRC3r-P-Aw',
                    'value': 1.0,
                    'currency': 'USD'
                });
                window.history.pushState({done: 1}, "InkRockit Printed Samples", "/");
            </script>
            <!-- Event snippet for Lead conversion page -->
        </div>
        <SCRIPT LANGUAGE="JavaScript">
            var cc_tagVersion = "1.0";
            var cc_accountID = "1110981352";
            var cc_marketID = "0";
            var cc_protocol = "http";
            var cc_subdomain = "convctr";
            if (location.protocol == "https:") {
                cc_protocol = "https";
                cc_subdomain = "convctrs";
            }
            var cc_queryStr = "?" + "ver=" + cc_tagVersion + "&aID=" + cc_accountID + "&mkt=" + cc_marketID + "&ref=" + escape(document.referrer);
            var cc_imageUrl = cc_protocol + "://" + cc_subdomain + ".overture.com/images/cc/cc.gif" + cc_queryStr;
            var cc_imageObject = new Image();
            cc_imageObject.src = cc_imageUrl;
        </SCRIPT>
        </body>
        </html>
        <?
    } else {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
        <html>
        <head>
            <title>InkRockit - Thank You for Requesting Samples</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <style>
                a:hover {
                    color: #FFCC33;
                    text-decoration: none;
                    text-weight: 900;
                }

                a {
                    color: #FFFFFF;
                    text-decoration: none;
                    text-weight: 900;
                }
            </style>
        </head>
        <body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td valign="middle" align="center">
                    <font face="Verdana" color="#CC0000" style="font-size:14pt;font-weight:bolder;">SERVER ERROR!</font><br>
                    <font face="Verdana" color="#00000" style="font-size:9pt;font-weight:bolder;">There has been an
                        error<br> sending your information.<br><br> Please close this window and retry.<br> If the
                        problem persists contact:<br><a href="mailto:leads@inkrockit.com">leads@inkrockit.com</a></font><br><br>

                </td>
            </tr>
        </table>
        </body>
        </html>
        <?
    }
    ?>
    <?
}
?>

