<?php
    $dblink2 = mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
    //mysql_set_charset("UTF8", $dblink2);
    mysql_select_db("preprod");


    $q = 'yaroswell@gmail.com';
    $comp_exist = mysql_query('SELECT id, first_name, last_name FROM users WHERE email="' . mysql_real_escape_string($q) . '"');
    $comp = mysql_fetch_array($comp_exist);

    echo $value[0]['first_name'];
