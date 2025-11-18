<?
	$headers  = "MIME-Version: 1.0\r\n";
	//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");
    $Query = "SELECT * FROM requests WHERE sentcron = 'N'";
    $queryexe = mysql_query($Query);
    if ($myrow = mysql_fetch_array($queryexe)) {
	  do {

       $email = $myrow["email"];
       $fname = $myrow["firstname"];

	   $message2 = "Dear $fname :\n\nThank you for your interest in InkRockit's top quality business products and solutions. We have received your request for samples which will be sent by First Class Mail immediately. You should receive them within three to five business days.\n\nIn the interim, if I can help answer any questions you might have, please contact me directly.\n\nSincerely,\n\n\nDon Traub, ehp\n\nThe InkRockit Team\n1357 Ana Maria Circle\nPort Orange, FL 32129\n\n800.900.5632\n386.299.3300 Cell";

	   mail($email, "InkRockit Printed Samples Request", $message2, $headers);

      } while ($myrow = mysql_fetch_array($queryexe));
    }

    $Query = "UPDATE `requests` SET `sentcron` = 'Y' WHERE sentcron = 'N'";
    $queryexe = mysql_query($Query);
?>
<html>
<body>
Complete
</body>
</html>
