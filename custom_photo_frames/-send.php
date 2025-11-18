<?
session_start();

if ($_POST['email'] == "") {

    // nothing
    print ("");
} else {

    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db("db37838_imageteam_com_pca");

    $usernameexists = "N";

//    if ($_POST['email'] != "") {
//        $Query = "SELECT * FROM ink_customers WHERE username = '" . $_POST['email'] . "'";
//        $queryexe = mysql_query($Query);
//        if ($myrow = mysql_fetch_array($queryexe)) {
//            $usernameexists = "Y";
//        }
//    }

    $today = date("Ymd");
    $searchid = $_SESSION['search_id'];
    $completeaddress = mysql_real_escape_string($_POST['co']) . " \nATTN: " . mysql_real_escape_string($_POST['fname']) . " " . mysql_real_escape_string($_POST['lname']) . " \n" . mysql_real_escape_string($_POST['street']) . " \n" . mysql_real_escape_string($_POST['city']) . ", " . mysql_real_escape_string($_POST['state']) . " " . $_POST['zip'] . " \n\n(" . mysql_real_escape_string($_POST['area']) . ") " . mysql_real_escape_string($_POST['phone']);
    $keywords = (empty($_SESSION['keyword'])) ? '' : str_replace('+', ' ', $_SESSION['keyword']);

//    $sql = "INSERT INTO `requests` ( `requestdate` , `company` , `firstname` , `lastname` , `street` , `city` , `state` , `zipcode` , `areacode`, `phonenumber` , `email` , `operatingsys` , `graphicsapp` , `refsource` , `othersource` , `industry` , `position` , `completeaddress`, `searchid`, `offers`, `folders`, `sales`, `media`, `brochures`, `buscards`, `stationery`, `directmail`, `photoframe`, `other`, `othertext`, `username`, `search_keyword`, `user_ip` )  VALUES ( '$today',  '" . mysql_real_escape_string($_POST['co']) . "',  '" . mysql_real_escape_string($_POST['fname']) . "',  '" . mysql_real_escape_string($_POST['lname']) . "',  '" . mysql_real_escape_string($_POST['street']) . "',  '" . mysql_real_escape_string($_POST['city']) . "',  '" . mysql_real_escape_string($_POST['state']) . "',  '" . mysql_real_escape_string($_POST['zip']) . "',  '" . mysql_real_escape_string($_POST['area']) . "',  '" . mysql_real_escape_string($_POST['phone']) . "',  '" . mysql_real_escape_string($_POST['email']) . "',  '" . mysql_real_escape_string($_POST['os']) . "',  '" . mysql_real_escape_string($_POST['app']) . "',  '" . mysql_real_escape_string($_POST['ref']) . "',  '" . mysql_real_escape_string($_POST['refOpt']) . "' ,  '" . mysql_real_escape_string($_POST['industry']) . "' , '" . mysql_real_escape_string($_POST['position']) . "' , '$completeaddress', '$searchid', '" . mysql_real_escape_string($_POST['offers']) . "', '" . mysql_real_escape_string($_POST['folders']) . "', '" . mysql_real_escape_string($_POST['sales']) . "', '" . mysql_real_escape_string($_POST['media']) . "', '" . mysql_real_escape_string($_POST['brochures']) . "', '" . mysql_real_escape_string($_POST['buscards']) . "', '" . mysql_real_escape_string($_POST['stationery']) . "', '" . mysql_real_escape_string($_POST['directmail']) . "', 'Photo Frame', '" . mysql_real_escape_string($_POST['other']) . "', '" . mysql_real_escape_string($_POST['othertext']) . "', '" . mysql_real_escape_string($_POST['email']) . "' , '" . $keywords . "' , '" . $_SERVER['REMOTE_ADDR'] . "')";
//    $queryexe = mysql_query($sql);

//    if ($usernameexists == "N") {
//        $sql = "INSERT INTO `ink_customers` ( `company` , `name` , `address` , `city` , `state` , `zip` , `phone`, `email` , `username` )  VALUES ( '" . mysql_real_escape_string($_POST['co']) . "',  '" . mysql_real_escape_string($_POST['fname']) . " " . mysql_real_escape_string($_POST['lname']) . "',  '" . mysql_real_escape_string($_POST['street']) . "',  '" . mysql_real_escape_string($_POST['city']) . "',  '" . mysql_real_escape_string($_POST['state']) . "',  '" . mysql_real_escape_string($_POST['zip']) . "',  '(" . mysql_real_escape_string($_POST['area']) . ") " . mysql_real_escape_string($_POST['phone']) . "',  '" . mysql_real_escape_string($_POST['email']) . "', '" . mysql_real_escape_string($_POST['email']) . "' )";
//        $queryexe = mysql_query($sql);
//    }
    mysql_close();

    //new DB
    $dblink2 = mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
    mysql_select_db("preprod");

    $user_exist = mysql_query('SELECT id FROM users WHERE email="' . mysql_real_escape_string($_POST['email']) . '"');
    $user = mysql_fetch_array($user_exist);
    if (empty($user)) {

        if(!empty($_POST['area'])){
            $phone = '' . mysql_real_escape_string($_POST['area']) . '-' . mysql_real_escape_string($_POST['phone']);
        }else{
            $phone = mysql_real_escape_string($_POST['phone']);
        }
        mysql_query('INSERT INTO users (login,password,email,first_name,last_name,group_id,user_abbr,company,street,city,state,zipcode,phone,position,industry,fax,country) 
                    VALUES ("' . mysql_real_escape_string($_POST['email']) . '","","' . mysql_real_escape_string($_POST['email']) . '","' . mysql_real_escape_string($_POST['fname']) . '",
                        "' . mysql_real_escape_string($_POST['lname']) . '",1,"","' . mysql_real_escape_string($_POST['co']) . '","' . mysql_real_escape_string($_POST['street']) . '","' . mysql_real_escape_string($_POST['city']) . '",
                        "' . mysql_real_escape_string($_POST['state']) . '","' . mysql_real_escape_string($_POST['zip']) . '","'.$phone.'",
                        "' . mysql_real_escape_string($_POST['position']) . '","' . mysql_real_escape_string($_POST['industry']) . '","' . mysql_real_escape_string($_POST['fax']) . '",
                        "' . mysql_real_escape_string($_POST['country']) . '")');
        $user['id'] = mysql_insert_id();
    }

    $order_data = array();
    foreach (array('folders' => 'Folders', 'sales' => 'Sales/Product Sheets', 'media' => 'Media/Press Kits', 'brochures' => 'Brochures/Catalogs', 'buscards' => 'Business Cards',
 'stationery' => 'Stationery Package', 'directmail' => 'Direct Mail') as $k => $v) {
        if (!empty($_POST[$k])) {
            $order_data[$k] = $v;
        }
    }
    if (!empty($_POST['other'])) {
        $order_data['other'] = $_POST['othertext'];
    }
    $order_data['photoframe'] = 'Photo Frame';


    mysql_query('INSERT INTO requests (job_id, user_id, request_date, operating_sys, graphics_app, ref_source, other_source, processed_date, industry, conversations, complete_address, search_id, offers, order_data, tracking_number, search_keyword, user_ip) 
    VALUES ("", ' . $user['id'] . ', NOW(), "' . mysql_real_escape_string($_POST['os']) . '", "' . mysql_real_escape_string($_POST['app']) . '", "' . mysql_real_escape_string($_POST['ref']) . '", 
        "' . mysql_real_escape_string($_POST['refOpt']) . '", NULL, "' . mysql_real_escape_string($_POST['industry']) . '", "", "' . $completeaddress . '", "' . $searchid . '", "' . mysql_real_escape_string($_POST['offers']) . '", "' . mysql_real_escape_string(serialize($order_data)) . '", "", "' . $keywords . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '")');






    $headers = "MIME-Version: 1.0\r\n";
//	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
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
    $message = $message . "<b>Photo Frame</b>\n";
    if ($_POST['other'] != '') {
        $message = $message . "Other: " . $_POST['othertext'] . "\n";
    }
    if (mail("leads@imageteam.com", "InkRockit Printed Samples Request", $message, $headers)) {
        mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);

        //send to user
        $fname = $_POST['fname'];
        $company = $_POST['co'];

        $message2 = '<html>
            <body><font face="Arial">Dear ' . $fname . ',<br><br>
        </font><div><font face="Arial">Thank you for requesting our legendary sample pack, and welcome to InkRockit!&nbsp;</font></div><div><font face="Arial"><br></font></div><div><font face="Arial">My Name is Don Traub and I will be your personal account manager, as well as your Agency Liaison if you need design, mailing,&nbsp;</font><span style="font-family:Arial">website development, animation,&nbsp;</span><span style="font-family:Arial">or any other strategic marketing deployment services. Consider me&nbsp;</span><span style="font-family:Arial">' . $company . '\'s personal, direct marketing concierge.</span></div>
        <div><font face="Arial"><br></font></div>
        <div>
            <font face="Arial">
            <span style="font-family:Helvetica">
                <font face="Arial">I understand your time is valuable, but I hope you will take a few minutes and let me share some very important things about InkRockit that&nbsp;<u>truly</u>&nbsp;make us different than anyone else you might be considering to produce your project.</font>
            </span>
            <span style="color:rgb(0,127,0);font-size:x-large">
                <b><br></b>
            </span>
            </font>
        </div>
        <div>
            <font face="Arial">
            <span style="font-family:Helvetica"><font face="Arial"><br></font></span>
            </font>
        </div>
        <div><div><div><font face="Arial">In the next several days you should be receiving our truly mind-blowing sample pack. I\'ve attached a picture of our custom outer envelope so you\'ll know what to be looking out for.&nbsp;</font><span style="font-family:Arial">Once you\'ve got it in your hot little hands, please give me a call me right away at <a href="tel:415.738.8439" value="+14157388439" target="_blank">415.738.8439</a>. I never get tired of hearing the spontaneous oohs and ahs from my customers when they first open it. I\'ll want to spend a few minutes with you to review the various finishing options you\'ll be seeing in the pack, and answer any questions that might come up.&nbsp;</span></div>
                <div>
                    <span style="font-family:Arial"><br></span>
                </div>
                <div>
                    <span style="font-family:Arial">Beyond our bedrock of uncompromising quality, we offer a variety of finishes that (as you\'ll see) make the difference between a good looking piece and a piece that will really get you noticed, and strike fear into your competition. :)&nbsp;</span>
                </div>
                <span style="font-family:Arial"><br></span>
                <div>
                    <font face="Arial">
                    If you don\'t want to wait to receive your samples before discussing a specific project with me, just give me a call anytime. If I happen to miss your call (I really try not to), just leave me a short message with the best number and time to reach you, and I\'ll get back to you as soon as I\'m able. Usually that\'s before you can eat a small bag of potato chips. :) You can also reach me on my personal cell phone number at <a href="tel:386.299.3300" value="386.299.3300" target="_blank">386.299.3300</a>.
                    <br>
                    <b><br></b></font>
                </div>
            </div>
        </div>
        <div><div>
                <font color="#007f00" face="Arial"><b>We are absolutely nuts about quality – seriously, we\'re obsessed! :)&nbsp;</b></font>
            </div><div><font color="#007f00" face="Arial"><b><br>
                </b></font></div><div><font color="#007f00" face="Arial"><b>To begin with:</b></font></div></div><div><div><font face="Arial"><br><font style="font-size:12px"><b><font color="#007f00">1. WE MAKE SURE YOUR JOB PRINTS PERFECTLY, EVEN IF YOUR ARTWORK ISN\'T PERFECT!</font><br>
                </b></font>We don\'t just run your files through some automated software. Your files are thoroughly examined by an experienced technician who makes sure everything in your files are technically and aesthetically correct. If we discover any issues with your files, well give you a complete report so you can repair the problems yourself and resubmit your files. Or for a small charge, you can have the peace of mind that comes with knowing our award-winning art department will fix the problems for you. By the way, our art department is The IMAGE Team – a full fledged, nationally awarded Ad Agency, so don\'t be surprised if we give you some ideas on small ways you can make your piece more aesthetically pleasing, or effective!&nbsp;</font><div>
                    <font face="Arial"><br></font></div><div><font face="Arial"><i><b>Why do we care so much about your print files?</b></i> Because we know that a good print job begins with good artwork. If your digital images have bad color then no matter how perfect we print them, they\'ll still look bad! If your die cuts, trim marks, or fold lines are positioned wrong, then the die cutting, trimming or folding will turn out wrong. And since the average person can\'t distinguish between a bad print job and bad artwork, we want to protect our reputation along with yours! :) So we make sure everything looks great so you can impress your customers, make more sales, get more distribution and airplay, or accomplish whatever your mission is, and we hope we\'ll earn your business for life. <b><i>We want to be your marketing partner not just some printing company!</i></b><br>
                    <br><font style="font-size:12px"><b><font color="#007f00">2. WE DON\'T DO GANG RUN PRINTING.</font><br></b></font><b>Your job will run by itself every time.</b>&nbsp;It costs a lot more for us to do it that way, but it\'s the only way anyone can really guarantee the quality. Most of our so-called competition are gang run printers. They\'re great if consistent color and quality are <u>not</u> important to what your printing, But if you care about your brand, and need all of your marketing materials to always look great and have matching color, you\'ll need to avoid the gang run printers. Gang run printers run several customers\' jobs on the same sheet of paper,&nbsp;</font><span style="font-family:Arial">at the same time</span><span style="font-family:Arial">.&nbsp;It\'s a great way to save money, but&nbsp;<b style="font-size:12px"><font color="#f90a17">when projects are gang run, it\'s <u>impossible</u> to deliver accurate color</font></b>. The result is everyones\' job has some amount of compromise as much as 20% or more! If you check the fine print on their sites, you\'ll notice their disclaimers disclose this fact.</span></div>
                <div><font face="Arial"><br><font style="font-size:12px"><font color="#007f00"><b>3. OUR STANDARD LINE SCREEN IS 240 LINES PER INCH!</b></font><br></font>We are one of only a very few printing companies that use this high quality standard line screen. By combining our incredible 240 line screen -- not 150-175 (which is the standard) with printing&nbsp;</font><span style="font-family:Arial">plates generated directly from your digital files, </span><span style="font-family:Arial">we are able to produce flawless blends (with no banding), and sharp photographs that pop with vibrant color and detail. The difference you\'ll notice in your images is like the difference between a high definition television picture and standard television picture. If you prefer high definition, that\'s us!</span></div>
                <div><font face="Arial"><br><b><font color="#007f00">4. CUSTOM IS OUR STANDARD</font></b></font></div><div><font face="Arial">Because we\'re NOT a gang run printer, you can let your imagination run wild on every aspect of your job, from the shape and size of your piece to having the ability to add PMS colors and special finishes like: matte or gloss laminations, or embosses and foil stamps. We even do custom holograms, spot UVs and sculptured embosses. And if all this doesn\'t make any sense to you, don\'t worry, once you get our pack, we\'ll give you a quick education so you can understand all of the possibilities available to you. &nbsp; &nbsp;</font></div>
                <div><font face="Arial"><br></font></div><div><font face="Arial"><font style="font-size:12px"><b><font color="#007f00">5. OUR PRICES ARE DECEPTIVELY LOW.</font></b></font></font></div><div></div>
                <div><font face="Arial">Our prices often compete with gang run printers, so you might think that we somehow cut corners, but as you\'ll see from our samples, and from everything I\'ve mentioned here, nothing could be further from the truth. We are able to offer such great prices on premium quality because we keep our operating costs down, and by integrating all of the special finishing services from one building. Many companies need to transport what they print from their factory to a third-party facility for die-cutting, then another facility for foil stamping, and so on. Most of our finishing services are produced on-site&nbsp;<br>
                    <br><font style="font-size:12px"><font color="#007f00"><b>6. WE DELIVER FASTER THAN ANYONE ELSE IN THE BUSINESS.</b></font><br></font>Were not called InkRockit for nothing. A lot of printers claim to be fast, but after you place your order suddenly their turnaround times turn out to be not so impressive. As a spin-off company of IMAGE Team a highly awarded, two decade old Ad Agency, we understand the importance of deadlines. No matter how good your printing looks, if it arrives one second after your tradeshow or special event, its worthless. In fact, when we quote turnaround times, we give you the exact dates you can expect to receive your order not when it will be ready to ship. And speaking of shipping, your order is double boxed, in 3 ply cartons so that when you open it at your office or special event, it\'s in the same pristine condition it was when it left our factory.<br>
                    <br>In closing, I can tell you that I\'ve sold printing for other companies before, but I\'ve never been more proud to work for a company that is so fanatically devoted to delivering exceptional quality and service on every job. I know if you give me the opportunity to serve you on one project, you\'ll never want to go anywhere else again. I hope you will give me that opportunity soon!<br>
                    <br>Respectfully yours,</font>
                    <br>
                    <span style="font-size:12px"><br><font face="Helvetica, Verdana, Arial"><br></font></span>
                    <font face="Lucida Grande, Verdana, Helvetica, Arial"><span style="font-size:12px"><span style="font-family:Arial"><b>Don Traub</b></span><br>
                        <span style="font-family:Arial;font-size:12px">Senior Account Manager / Agency Liaison</span><br><span style="color:rgb(114,114,114);font-family:Arial;font-size:12px">-----------------</span><br><span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#F35D00"><b>INKROCKIT</b></font></span><span style="font-size:12px;font-family:Arial;font-weight:normal">
                            <font color="#727272">&nbsp;|&nbsp;</font>
                        </span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal">
                            <font color="#747474">San Francisco&nbsp;</font>
                        </span><span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#B4B4B4">|</font></span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#747474">&nbsp;Orlando&nbsp;</font></span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#B4B4B4">|</font></span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#747474">&nbsp;Atlanta&nbsp;</font></span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#B4B4B4"><wbr>|</font></span>
                        <span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#747474">&nbsp;Hong Kong</font></span><br>
                        <span style="color:rgb(116,116,116);font-family:Arial;font-size:12px">Central Florida Sales | P O Box 951353 | Lake Mary, FL 32795-1353</span><br><span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#747474">O: <a href="tel:415.738.8439" value="+14157388439" target="_blank">415.738.8439</a>&nbsp;</font></span><span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#B4B4B4">|</font></span><span style="font-size:12px;font-family:Arial;font-weight:normal"><font color="#747474">&nbsp;C: <a href="tel:386.299.3300" value="+13862993300" target="_blank">386.299.3300</a> | F: <a href="tel:407.842.7965" value="+14078427965" target="_blank">407.842.7965</a></font></span><br>
                        <div><div><div><div><div><div><div>
                        <div><span style="border-collapse:separate;font-style:normal;font-variant:normal;letter-spacing:normal;line-height:normal;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><font style="font-size:medium;font-family:Helvetica;font-weight:normal" face="Arial"><a rel="nofollow" href="http://www.inkrockit.com/" target="_blank">www.inkrockit.com</a>&nbsp;|&nbsp;<a rel="nofollow" href="http://www.imageteam.com/" target="_blank">www.<wbr>imageteam.com</a></font></span></div></div></div></div></div></div></div></div></span></font>
                </div></div>
                </div></body>
                </html>';

        function mail_attachment($filename, $path, $mailto, $subject, $message) {
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
                    a:hover{
                        color:#FFCC33;
                        text-decoration:none;
                        text-weight:900;
                    }
                    a{
                        color:#FFFFFF;
                        text-decoration:none;
                        text-weight:900;
                    }
                </style>
            </head>
            <body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
                <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" align="center">
                            <span style="color: #000000"><font face="Verdana" style="font-size:12pt;font-weight:bolder;">Thank you,</font><br />
                                <font face="Verdana" style="font-size:9pt;font-weight:bolder;"> your samples will be sent by 1st class mail.<br />
                                    You should receive them within 3-5 business days.</font></span><br>
                            <br>
                        </td>
                    </tr>
                </table>
                <div align="center">

                    <!-- Google Code for Lead Conversion Page -->
                    <script type="text/javascript">
                        /* <![CDATA[ */
                        // var google_conversion_id = 1071175607;
                        // var google_conversion_language = "en";
                        // var google_conversion_format = "3";
                        // var google_conversion_color = "ffffff";
                        // var google_conversion_label = "6MGTCP22RRC3r-P-Aw";
                        // var google_conversion_value = 0;
                        /* ]]> */
                    </script>
                    <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
                    </script>
                    <noscript>
                        <div style="display:inline;">
                            <img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1071175607/?value=0&amp;label=6MGTCP22RRC3r-P-Aw&amp;guid=ON&amp;script=0"/>
                        </div>
                    </noscript>

                </div>
                <SCRIPT LANGUAGE="JavaScript">
                    <!-- Overture Services Inc. 07/15/2003
                    var cc_tagVersion = "1.0";
                    var cc_accountID = "1110981352";
                    var cc_marketID = "0";
                    var cc_protocol = "http";
                    var cc_subdomain = "convctr";
                    if (location.protocol == "https:")
                    {
                        cc_protocol = "https";
                        cc_subdomain = "convctrs";
                    }
                    var cc_queryStr = "?" + "ver=" + cc_tagVersion + "&aID=" + cc_accountID + "&mkt=" + cc_marketID + "&ref=" + escape(document.referrer);
                    var cc_imageUrl = cc_protocol + "://" + cc_subdomain + ".overture.com/images/cc/cc.gif" + cc_queryStr;
                    var cc_imageObject = new Image();
                    cc_imageObject.src = cc_imageUrl;
                    // -->
                </SCRIPT></body>
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
                    a:hover{
                        color:#FFCC33;
                        text-decoration:none;
                        text-weight:900;
                    }
                    a{
                        color:#FFFFFF;
                        text-decoration:none;
                        text-weight:900;
                    }
                </style>
            </head>
            <body style="margin:0;background-image: url();background-repeat: repeat-y;background-position: 100% 0%;">
                <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="middle" align="center">
                            <font face="Verdana" color="#CC0000" style="font-size:14pt;font-weight:bolder;">SERVER ERROR!</font><br>
                            <font face="Verdana" color="#00000" style="font-size:9pt;font-weight:bolder;">There has been an error<br> sending your information.<br><br>  Please close this window and retry.<br>  If the problem persists contact:<br><a href="mailto:leads@inkrockit.com">leads@inkrockit.com</a></font><br><br>

                        </td>
                    </tr>
                </table>
                <!-- Paste this code just above the closing </body> of your conversion page. The tag will record a conversion every time this page is loaded. Optional 'sku' and 'value' fields are described in the Help Center. -->
                <script src="//ah8.facebook.com/js/conversions/tracking.js"></script><script type="text/javascript">
                    try {
                        FB.Insights.impression({
                            'id': 6003634632295,
                            'h': '43212e6b65'
                        });
                    } catch (e) {
                    }
                </script>
            </body>
        </html>
        <?
    }
    ?>
    <?
}
?>

