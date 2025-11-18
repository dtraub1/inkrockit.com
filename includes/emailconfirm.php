<?
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

       $email = $customers_email_address;
       $fname = $customers_fname;

    $message2 = "$billing_company";
    $message2 .= "ATTN: $customers_name\n";
    $message2 .= "$billing_street_address\n";
    $message2 .= "$billing_city, $billing_state $billing_postcode\n\n";
    $message2 .= "$customers_telephone\n\n\n";
    $message2 .= "Dear $fname:\n\n";

	$message2 .= "Thank you for considering InkRockit for your project. We are happy to have the opportunity to serve you.\n\n";
	$message2 .= "This e-mail includes everything you should need to get your project started.\n\n";
	$message2 .= "     Your Order Number: $orders_id\n";
	$message2 .= "     Date of Order: $date_purchased\n";
	$message2 .= "     Click here to view your order information and upload any files:\n      https://ss41.shared.server-system.net/~imageteam.com/inkrockit.com/oscatalog/account_history_info.php?order_id=$orders_id\n\n";
	$message2 .= "Please contact your customer service representative if you should have any questions or need to make any changes to your order.\n\n";
    $message2 .= "Sincerely,\n\n";
    $message2 .= "The INKROCKIT Team\n1357 Ana Maria Circle\nPort Orange, FL 32129\n\n800.900.5632\n\n";
	$message2 .= "----------------------------------------------------------------------------\n\n\n";
	$message2 .= "                 INKROCKIT MATERIAL SUBMISSION INSTRUCTIONS\n\n";

	$message2 .= "You can download any necessary templates from http://www.inkrockit.com/templates.htm \n\n";


	$message2 .= "Please send the finished file(s) stuffed or zipped as either:\n\n";

	$message2 .= "   1. An Adobe Illustrator file with hi-res image(s) in position within the\n";
	$message2 .= "      provided Adobe Illustrator template and make sure to include all\n";
	$message2 .= "      placed files. Convert all type into outlines.\n\n";

	$message2 .= "   2. Photoshop file in CMYK format at 300 dpi to 350 dpi.\n\n";

	$message2 .= "   3. A Quark Xpress file with placed tiff image for the printed work in\n";
	$message2 .= "      position. Include all fonts used in the publication.\n\n";

	$message2 .= "Please make sure that all bitmap Files are at least 300 dpi at the size they are used, in either grayscale or CMYK.\n\n";

	$message2 .= "Completed artwork may be uploaded using the link listed above.\n\n";

	$message2 .= "Please notify us be e-mail once the files have been successfully uploaded.\n\n";

	$message2 .= "If you have any questions about preparing the artwork, please call\n";
	$message2 .= "800.900.5632 for assistance.\n\n";

	$message2 .= "Respectfully yours,\n\n";

	$message2 .= "Don Traub, ehp,\n\n";

	$message2 .= "InkRockit\n";
	$message2 .= "1357 Ana Maria Circle\n";
	$message2 .= "Port Orange, FL 32129\n\n";

	$message2 .= "www.inkrockit.com\n\n";

	$message2 .= "800.900.5632 North American Sales\n\n";

	$message2 .= "386.299.3300 cell\n";
	$message2 .= "386.322.1767 fax\n\n";

	$message2 .= "The information contained in this message may be privileged and/or confidential and protected from disclosure.  If the reader of this message is not the intended recipient or agent responsible for delivering this message to the intended recipient, you are hereby notified that any dissemination, distribution or copying of this communication is strictly prohibited.  If you have received this communication in error, please notify the sender immediately by replying to this message and deleting the material from any computer.\n";


	   mail($email, "INKROCKIT - Order Confirmation & Material Submission Instructions", $message2, $headers);

?>
