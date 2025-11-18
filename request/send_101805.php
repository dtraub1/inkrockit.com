<?

    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");
    $today = date("Ymd");
    $completeaddress = "$co \nATTN: $fname $lname \n$street \n$city, $state $zip \n\n($area) $phone";

    $sql = "INSERT INTO `requests` ( `requestdate` , `company` , `firstname` , `lastname` , `street` , `city` , `state` , `zipcode` , `areacode`, `phonenumber` , `email` , `operatingsys` , `graphicsapp` , `refsource` , `othersource` , `industry` , `position` , `completeaddress` )  VALUES ( '$today',  '$co',  '$fname',  '$lname',  '$street',  '$city',  '$state',  '$zip',  '$area',  '$phone',  '$email',  '$os',  '$app',  '$ref',  '$refOpt' ,  '$industry' , '$position' , '$completeaddress' )";
    $queryexe = mysql_query($sql);

	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

	$date = date("h:i, jS F Y", time() + 3600*3);
	$message = "InkRockit Printed Samples Request \nDate: $date \n\n$co \nATTN: $fname $lname \n$street \n$city, $state $zip \n\n($area) $phone \n$email \n\nOS: $os \nGraphics App: $app \nReference Source: $ref \nOther Source: $refOpt \nIndustry: $industry \n$position ";
//	$message2 = "Dear $fname :\n\nThank you for your interest in InkRockit's top quality business products and solutions. We have received your request for samples which will be sent by First Class Mail immediately. You should receive them within three to five business days.\n\nIn the interim, if I can help answer any questions you might have, please contact me directly.\n\nSincerely,\n\n\nDon Traub, ehp\n\nThe InkRockit Team\n1357 Ana Maria Circle\nPort Orange, FL 32129\n\n800.900.5632\n386.299.3300 Cell";
	if ( mail("leads@imageteam.com", "InkRockit Printed Samples Request", $message, $headers))
	{
	  mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);
//	  mail($email, "InkRockit Printed Samples Request", $message2, $headers);
//	  echo "<script language='JavaScript' type='text/javascript'>document.location = 'sent.html';</script>";
      header("Location: sent.html");
	} else {
//	  echo "<script language='JavaScript' type='text/javascript'>document.location = 'fail.html';</script>";
      header("Location: fail.html");
	}
?>

