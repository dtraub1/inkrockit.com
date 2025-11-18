<?php

print ("1<br>");

// initiate cURL w/ protocol & URL of remote host
$ch=curl_init("https://www.eProcessingNetwork.Com/cgi-bin/tdbe/transact.pl");

print ("2<br>");

// normal POST request
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ePNAccount=090367&CardNo=090367&ExpMonth=07&ExpYear=12&Total=5.00&Address=123 Main Street&Zip=43460&HTML=No&Email=john@johnappt.com&CVV2Type=1&CVV2=1");

print ("3<br>");

// set response to return as variable
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

print ("4<br>");

// trap response into $response var
$response=curl_exec($ch);

print ("5<br>");

// close cURL transfer
curl_close($ch);

print ("6<br>");

$auth=substr($response,1,1);

print ("7<br>");

if ($auth=="Y")
{
  print ("Authorized:<br>" . $response);
}
else
{
  print ("Declined:<br>" . $response);
}

?>
