<?
$mkdirMethod = "FTP";
define('FTPSERVER','ftp.imageteam.com');
define('FTPLOGIN','imageteam');
define('FTPPASSWORD','mmtldm6');

# PhpCollab root according to ftp account (only if $mkdirMethod == "FTP")
$ftpRoot = "/var/www/html/inkrockit.com/filestorage"; //no slash at the end


function uploadFile($path, $source, $dest) {
global $mkdirMethod,$ftpRoot;
if($mkdirMethod == "FTP") {
	$pathNew = $ftpRoot."/".$path;
	$ftp = ftp_connect(FTPSERVER);
	ftp_login($ftp,FTPLOGIN,FTPPASSWORD);
	ftp_chdir($ftp, $pathNew);
	ftp_put($ftp, $dest, $source, FTP_BINARY);
	ftp_quit($ftp);
} else {
	@move_uploaded_file($source, "../".$path."/".$dest);
}
}


$project = $_SESSION['orders_id'];
uploadFile("$project", $HTTP_POST_FILES['upload']['tmp_name'], $HTTP_POST_FILES['upload']['name']);
$filename = $HTTP_POST_FILES['upload']['name'];
?>
<?

    $dblink = mysql_connect("localhost", "imageteam", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_catalog");

    $sql = "INSERT INTO `orders_images` ( `orders_id` , `filename` , `comments` )  VALUES ( '$project',  '$filename',  '$c' )";
    $queryexe = mysql_query($sql);

?>

<div class="style16">
Your file has been uploaded.<br>
<br>
Click <a href="upload.php"><font color="#000000">here</font></a> if you would like to upload another file.</div>

