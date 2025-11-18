<?php if(!session_id()) session_start(); ?>
<html>
<head>

</head>
<body>

<?php 
  $pathToShoutBox = 'shoutbox';
  include("$pathToShoutBox/shoutbox.inc.php"); 
?>

</body>
</html>
