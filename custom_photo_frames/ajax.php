<?
if (!empty($_POST['type']) && !empty($_POST['form'])) {
    $result_data = array();
    $arr = explode('&', $_POST['form']);
    if (!empty($arr)) {
        foreach ($arr as $val) {
            $values = explode('=', $val);
            $result_data[$values[0]] = trim(urldecode($values[1]));
        }
    }
    
    if (!empty($result_data) && !empty($result_data['co'])) {
        mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
        mysql_select_db("preprod");
        $comp_exist = mysql_query('SELECT * FROM users_company 
            WHERE company="'.mysql_real_escape_string($result_data['co']).'"');
        
        $comp = mysql_fetch_array($comp_exist);
        if(!empty($comp)){
            $users_exist = mysql_query('SELECT 1 FROM users WHERE company_id="'.$comp['id'].'" AND first_name="'.mysql_real_escape_string($result_data['fname']).'" AND last_name="'.mysql_real_escape_string($result_data['lname']).'"');
            $users = mysql_fetch_array($users_exist);
            if(!empty($users)){
                //User exist
                $message = array('err'=>'You appear to have already requested a sample pack in the last 90 days. Would you like to request an additional pack? If yes then complete order form with payment info, etc.');
            }else{
                //Company exist
                $message = array('err'=>'This Company are already exist in our database.');
            }
        }else{
            $message = array('ok'=>'1');
        }     
        mysql_close();
    }
    
    if(!empty($message)){
        echo json_encode($message);
    }
}
?>