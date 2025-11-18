<?
    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");
    $Query = "ALTER TABLE `ink_orders` ADD `invoice` VARCHAR( 50 ) NOT NULL , ADD `txn_id` VARCHAR( 50 ) NOT NULL , ADD `payment_status` VARCHAR( 50 ) NOT NULL ";
    $queryexe = mysql_query($Query);

?>