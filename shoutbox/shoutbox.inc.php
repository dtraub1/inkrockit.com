<?
/*
 +-------------------------------------------------------------------+
 |                      S H O U T B O X   (v3.12)                    |
 |                                                                   |
 | Copyright Gerd Tentler                www.gerd-tentler.de/tools   |
 | Created: Jun. 1, 2004                 Last modified: Mar. 7, 2010 |
 +-------------------------------------------------------------------+
 | This program may be used and hosted free of charge by anyone for  |
 | personal purpose as long as this copyright notice remains intact. |
 |                                                                   |
 | Obtain permission before selling the code for this program or     |
 | hosting this software on a commercial website or redistributing   |
 | this software over the Internet or in any other medium. In all    |
 | cases copyright must remain intact.                               |
 +-------------------------------------------------------------------+
*/
  error_reporting(E_WARNING);

//========================================================================================================
// Set variables, if they are not registered globally; needs PHP 4.1.0 or higher
//========================================================================================================

  if(isset($_SERVER['HTTP_HOST'])) $HTTP_HOST = $_SERVER['HTTP_HOST'];

//========================================================================================================
// Includes
//========================================================================================================

  if($HTTP_HOST == 'localhost' || $HTTP_HOST == '127.0.0.1' || ereg('^192\.168\.0\.[0-9]+$', $HTTP_HOST)) {
    include('config_local.inc.php');
  }
  else {
    include('config_main.inc.php');
  }
  if(!isset($language)) $language = 'en';
  include("languages/lang_$language.inc");
  include('smilies.inc');

//========================================================================================================
// Set session variables (message ID); needs PHP 4.1.0 or higher
//========================================================================================================

  if($enableIDs && !$_SESSION['msgID']) {
    srand((double) microtime() * 1000000);
    $_SESSION['msgID'] = md5(uniqid(rand()));
  }

//========================================================================================================
// Main
//========================================================================================================

  if($boxFolder && !ereg('/$', $boxFolder)) $boxFolder .= '/';
?>
<script language="JavaScript"> <!--
var shout_popup = 0;

function newWindow(url, w, h, x, y, scroll, menu, tool, resizable) {
  if(shout_popup && !shout_popup.closed) shout_popup.close();
  if(!x && !y) {
    x = Math.round((screen.width - w) / 2);
    y = Math.round((screen.height - h) / 2);
  }
  shout_popup = window.open(url, "shout_popup", "width=" + w + ",height=" + h +
                            ",left=" + x + ",top=" + y + ",scrollbars=" + scroll +
                            ",menubar=" + menu + ",toolbar=" + tool + ",resizable=" + resizable);
  shout_popup.focus();
}

function refreshBox() {
  document.fShout.sbText.value = "";
  document.fShout.admin.value = "";
  document.fShout.submit();
  setTimeout("document.fShout.Refresh.disabled=false", 1000);
}

function shoutIt() {
  document.fShout.admin.value = "";
  document.fShout.submit();
  setTimeout("document.fShout.sbText.value=''", 1000);
  setTimeout("document.fShout.Shout.disabled=false", 1000);
}

function login() {
  var pass = prompt("<? echo $msg['pass']; ?>", "");
  if(pass) {
    document.fShout.admin.value = pass;
    document.fShout.submit();
  }
  document.fShout.Admin.disabled = false;
}
//--> </script>
<link rel="stylesheet" href="<? echo $boxFolder; ?>shoutbox.css" type="text/css">
<table border="0" cellspacing="0" cellpadding="0">
<form name="fShout" action="<? echo $boxFolder; ?>shout.php" target="ShoutBox" method="post">
<input type="hidden" name="sbID" value="<? echo $_SESSION['msgID']; ?>">
<input type="hidden" name="admin">
<tr valign="top">
<?
  $inputsPosition = strtolower($inputsPosition);
  
  if($inputsPosition == 'left' || $inputsPosition == 'right') {
    $txtHeight = round($boxHeight * 0.65);
  }
  else $txtHeight = 50;

  if($inputsPosition == 'right' || $inputsPosition == 'bottom') {
?>
    <td>
    <iframe name="ShoutBox" src="<? echo $boxFolder; ?>shout.php" class="cssShoutBox"
     width="<? echo $boxWidth; ?>" height="<? echo $boxHeight; ?>" frameborder="0"></iframe>
    </td>
<?
    if($inputsPosition == 'bottom') {
?>
      </tr><td height="5"></td><tr>
<?
    }
    else {
?>
      <td width="20">&nbsp;</td>
<?
    }
  }
?>
<td>
  <table border="0" cellspacing="0" cellpadding="0" width="<? echo $boxWidth; ?>"><tr>
  <td class="cssShoutText"><? echo $msg['name']; ?>:</td>
  <td align="right"><input type="text" name="sbName" maxlength="20" class="cssShoutForm" style="width:<? echo round($boxWidth * 0.65); ?>px"></td>
  </tr><tr>
  <td class="cssShoutText"><? echo $msg['eMail']; ?>:</td>
  <td align="right"><input type="text" name="sbEMail" maxlength="75" class="cssShoutForm" style="width:<? echo round($boxWidth * 0.65); ?>px"></td>
  </tr><tr>
  <td colspan="2">
    <table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td class="cssShoutText"><? echo $msg['message']; ?>:</td>
    <td align="right"><input type="button" value="<? echo $msg['smilies']; ?>" class="cssShoutButton" onClick="newWindow('<? echo $boxFolder; ?>smilies.php', 130, 300, 0, 0, 1)"></td>
    </tr></table>
  <textarea name="sbText" rows="3" style="width:<? echo $boxWidth; ?>px; height:<? echo $txtHeight; ?>px" wrap="virtual" class="cssShoutForm"></textarea>
    <table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td><input type="button" name="Refresh" value="<? echo $msg['refresh']; ?>" class="cssShoutButton" onClick="this.disabled=true; refreshBox()"></td>
    <td align="center"><input type="button" name="Admin" value="<? echo $msg['admin']; ?>" class="cssShoutButton" onClick="this.disabled=true; login()"></td>
    <td align="right"><input type="button" name="Shout" value="<? echo $msg['shout']; ?>" class="cssShoutButton" onClick="this.disabled=true; shoutIt()"></td>
    </tr></table>
  </td>
  </tr></table>
</td>
<?
  if($inputsPosition == 'left' || $inputsPosition == 'top') {
    if($inputsPosition == 'top') {
?>
      </tr><td height="10"></td><tr>
<?
    }
    else {
?>
      <td width="20">&nbsp;</td>
<?
    }
?>
    <td>
    <iframe name="ShoutBox" src="<? echo $boxFolder; ?>shout.php" class="cssShoutBox"
     width="<? echo $boxWidth; ?>" height="<? echo $boxHeight; ?>" frameborder="0"></iframe>
    </td>
<?
  }
?>
</tr>
</form>
</table>
