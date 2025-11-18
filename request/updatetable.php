<?
    $dblink = mysql_connect("localhost", "imageteam_pca", "mmtldm6");
    mysql_select_db ("db37838_imageteam_com_pca");

//	    $Query = "ALTER TABLE `inkrockit_orders` ADD `username` VARCHAR( 50 ) NOT NULL , ADD `password` VARCHAR( 50 ) NOT NULL";
//	    $queryexe = mysql_query($Query);

//$Query = "CREATE TABLE `ink_customers` (`id` int( 11 ) NOT NULL AUTO_INCREMENT ,`name` varchar( 50 ) NOT NULL default '',`company` varchar( 50 ) NOT NULL default '',`address` varchar( 100 ) NOT NULL default '',`city` varchar( 50 ) NOT NULL default '',`state` varchar( 50 ) NOT NULL default '',`zip` varchar( 50 ) NOT NULL default '',`country` varchar( 50 ) NOT NULL default '',`phone` varchar( 50 ) NOT NULL default '',`fax` varchar( 50 ) NOT NULL default '',`email` varchar( 50 ) NOT NULL default '',`shipname` varchar( 50 ) NOT NULL default '',`shipcompany` varchar( 50 ) NOT NULL default '',`shipaddress` varchar( 100 ) NOT NULL default '',`shipcity` varchar( 50 ) NOT NULL default '',`shipstate` varchar( 50 ) NOT NULL default '',`shipzip` varchar( 50 ) NOT NULL default '',`shipcountry` varchar( 50 ) NOT NULL default '',`username` varchar( 50 ) NOT NULL default '',`password` varchar( 50 ) NOT NULL default '',PRIMARY KEY ( `id` ) )";
//	    $queryexe = mysql_query($Query);

//$Query = "CREATE TABLE `ink_orders` (`custid` int( 11 ) NOT NULL default 0 ,`size` varchar( 50 ) NOT NULL default '',`inkcolors_side1` varchar( 50 ) NOT NULL default '',`pmscolors_side1` varchar( 50 ) NOT NULL default '',`pmsmetalcolors_side1` varchar( 50 ) NOT NULL default '',`specialfinish_side1` varchar( 50 ) NOT NULL default '',`foilstampoption_side1` varchar( 50 ) NOT NULL default '',`emboss_side1` varchar( 50 ) NOT NULL default '',`spotuv_side1` varchar( 50 ) NOT NULL default '',`inkcolors_side2` varchar( 50 ) NOT NULL default '',`pmscolors_side2` varchar( 50 ) NOT NULL default '',`pmsmetalcolors_side2` varchar( 50 ) NOT NULL default '',`specialfinish_side2` varchar( 50 ) NOT NULL default '',`foilstampoption_side2` varchar( 50 ) NOT NULL default '',`emboss_side2` varchar( 50 ) NOT NULL default '',`spotuv_side2` varchar( 50 ) NOT NULL default '',`diecut` varchar( 50 ) NOT NULL default '',`velcrotabs` varchar( 50 ) NOT NULL default '',`quantity` varchar( 50 ) NOT NULL default '',`subtotal` varchar( 50 ) NOT NULL default '',`shipping` varchar( 50 ) NOT NULL default '',`shippingoption` varchar( 50 ) NOT NULL default '',`total` varchar( 50 ) NOT NULL default '',`credit_card_number` varchar( 50 ) NOT NULL default '',`exp_month` varchar( 50 ) NOT NULL default '',`exp_year` varchar( 50 ) NOT NULL default '',`cardtype` varchar( 50 ) NOT NULL default '',`sec_code` varchar( 50 ) NOT NULL default '',`comments` longtext NOT NULL ,`orderdate` varchar( 50 ) NOT NULL default '',INDEX ( `custid` ) )";
//	    $queryexe = mysql_query($Query);

	    $Query = "ALTER TABLE `ink_orders` ADD `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY";
	    $queryexe = mysql_query($Query);

?>