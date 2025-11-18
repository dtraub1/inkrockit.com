<?

$dblink = mysql_connect("localhost", "fedex", "!1q2w3eZ")or die(mysql_error());
mysql_select_db("stating_fedex")or die(mysql_error());

echo '<pre>';var_dump($dblink);echo'</pre>';