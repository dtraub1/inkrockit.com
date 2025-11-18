<?

exit;
//$dblink2 = mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
//mysql_select_db("preprod");
//
//if (!empty($_GET['key'])) {
//    $_GET['key'] = htmlspecialchars($_GET['key']);
//    $req_exist = mysql_query('SELECT * FROM requests WHERE MD5(CONCAT(company_id,user_id,"q"))="' . mysql_real_escape_string($_GET['key']) . '"');
//    $find = mysql_fetch_array($req_exist);
//    if (empty($find)) {
//        ?>
        <p>Sorry, incorrect key.</p> 
        //<?
//
//    } else {
//        $user = mysql_query('SELECT * FROM users_tmp_data WHERE uid="' . $find['user_id'] . '"');
//        $user_data = mysql_fetch_array($user);
//        if (!empty($user_data)) {
//            mysql_query('UPDATE users SET country="' . $user_data['country'] . '", city="' . $user_data['city'] . '", state="' . $user_data['state'] . '", zipcode="' . $user_data['zipcode'] . '", 
//                street="' . $user_data['street'] . '", phone="' . $user_data['phone'] . '", phone_ext="' . $user_data['phone_ext'] . '" WHERE id="' . $user_data['uid'] . '"');
//            mysql_query('UPDATE requests SET status=1 WHERE MD5(CONCAT(company_id,user_id,"q"))="' . mysql_real_escape_string($_GET['key']) . '"');
//            mysql_query('DELETE FROM users_tmp_data WHERE uid="'.$find['user_id'].'"');
//        }
//        ?>
        <p>Thank you, request confirmed.</p>
        //<?
//
//    }
//}
//mysql_close();
?>