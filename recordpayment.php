<?
  session_start();
  $_SESSION['search_id'] = $HTTP_REFERER;

  $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
  mysql_select_db ("db37838_imageteam_com_pca");
	

  $sql = "UPDATE `ink_orders` SET `invoice` = '".$_POST['invoice']."', `txn_id` = '".$_POST['txn_id']."', `payment_status` = '".$_POST['payment_status']." WHERE id = " . $_POST['invoice'];
    
  $queryexe = mysql_query($sql);
	
?>