<?

	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: InkRockit <lead@inkrockit.com>\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

	$date = date("h:i, jS F Y", time() + 3600*3);
	$message = "InkRockit Printed Samples Request \nDate: $date \n\n$co \nATTN: $fname $lname \n$street \n$city, $state $zip \n\n($area) $phone \n$email \n\nOS: $os \nGraphics App: $app \nReference Source: $ref \nOther Source: $refOpt \nIndustry: $industry \n$position ";
	if ( mail("leads@inkrockit.com", "InkRockit Printed Samples Request", $message, $headers)){
	mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);
	echo "<script language='JavaScript' type='text/javascript'>document.location = 'sent.html';</script>";
	}else{
	echo "<script language='JavaScript' type='text/javascript'>document.location = 'fail.html';</script>";
	}
?>