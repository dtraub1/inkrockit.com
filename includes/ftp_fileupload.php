<?
$mkdirMethod = "FTP";
define('FTPSERVER','ftp.imageteam.com');
define('FTPLOGIN','inkrockit');
define('FTPPASSWORD','upload');

# PhpCollab root according to ftp account (only if $mkdirMethod == "FTP")
$ftpRoot = "/home/inkrockit/webfiles"; //no slash at the end


function uploadFile($path, $source, $dest) {
global $mkdirMethod,$ftpRoot;
if($mkdirMethod == "FTP") {
//	$pathNew = $ftpRoot."/".$path;
	$pathNew = $ftpRoot;
	$ftp = ftp_connect(FTPSERVER,21,900);
    ftp_set_option($ftp, FTP_TIMEOUT_SEC, 900);
	ftp_login($ftp,FTPLOGIN,FTPPASSWORD);
	ftp_chdir($ftp, $pathNew);
	ftp_put($ftp, $dest, $source, FTP_BINARY);
	ftp_quit($ftp);
} else {
	@move_uploaded_file($source, "../".$path."/".$dest);
}
}


$project = "1";
uploadFile("$project", $HTTP_POST_FILES['upload']['tmp_name'], $HTTP_POST_FILES['upload']['name']);
$filename = $HTTP_POST_FILES['upload']['name'];
?>
<div class="style16">
Your file has been uploaded.<br>
<br>
Click <a href="ftp_upload.php"><font color="#000000">here</font></a> if you would like to upload another file.</div>

