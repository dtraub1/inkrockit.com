<?php
session_start();

//header('Content-Type: application/json; charset=utf-8');
// required headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define("RECAPTCHA_V3_SECRET_KEY", '6LdAWuEcAAAAAEcodjCcH5Oi1j5gZDY2nMh8Pw7h');
define("CAPTCHA_ENABLED", true);



// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
if(isset($_GET['is_post'])) {
    $data = $_POST;
} else {
    $data = json_decode($json, true);
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode('Request failed');
    exit();
}

if ($data['country'] == 'Ukraine' || $data['country'] == 'Russian Federation') {
    response('success', 'Success');
}

if (CAPTCHA_ENABLED) {
    validateCaptcha($data['token']);
}


function validateCaptcha($token)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'secret'   => RECAPTCHA_V3_SECRET_KEY,
        'response' => $token
    )));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);

    // verify the response
    if ($arrResponse["success"] == '1' && $arrResponse["action"] == 'submit' && $arrResponse["score"] >= 0.5) {
        return true;
    } else {
        response('error', 'Invalid captcha');
    }
}

function response($status, $message)
{
    echo json_encode(array(
        'status'  => $status,
        'message' => $message
    ));
    exit();
}


function validate_list_fields($data, $post)
{
    foreach ($data as $key => $list) {
        if ($key !== 'state') {
            $list = array_flip($list);
        }

        if (isset($post[$key]) && !isset($list[$post[$key]])) {
            response('error', 'Incorrect ' . $key . ' value');
        }
    }
}


function add_user_func($company, $data)
{
    mysql_query('INSERT INTO users (login,password,email,first_name,last_name,group_id,user_abbr,company_id,street,street2,city,state,zipcode,phone,phone_ext,position,industry,fax,country) 
                    VALUES ("' . mysql_real_escape_string($data['email']) . '","","' . mysql_real_escape_string($data['email']) . '","' . convFormat($data['fname']) . '",
                        "' . convFormat($data['lname']) . '",1,"","' . $company . '","' . convFormat($data['street']) . '","' . convFormat($data['street2']) . '","' . convFormat($data['city']) . '",
                        "' . mysql_real_escape_string($data['state']) . '","' . mysql_real_escape_string($data['zip']) . '","' . mysql_real_escape_string($data['phone']) . '", "' . mysql_real_escape_string($data['ext']) . '",
                        "' . mysql_real_escape_string($data['position']) . '","' . mysql_real_escape_string($data['industry']) . '","' . mysql_real_escape_string($data['fax']) . '",
                        "' . mysql_real_escape_string($data['country']) . '")');
    $user_id = mysql_insert_id();
    mysql_query('INSERT INTO credit_card_shipping (user_id,company_id,title,first_name,last_name,company,address,address2,suite,city,state,zip,country,phone,email,public) 
                VALUES ("' . $user_id . '","' . $company . '","default","' . mysql_real_escape_string($data['fname']) . '","' . mysql_real_escape_string($data['lname']) . '",
                    "' . mysql_real_escape_string($data['co']) . '","' . mysql_real_escape_string($data['street']) . '","' . mysql_real_escape_string($data['street2']) . '","","' . mysql_real_escape_string($data['city']) . '",
                        "' . mysql_real_escape_string($data['state']) . '","' . mysql_real_escape_string($data['zip']) . '","' . mysql_real_escape_string($data['country']) . '",
                            "' . mysql_real_escape_string($data['phone']) . '","' . mysql_real_escape_string($data['email']) . '",0)');
    mysql_query('INSERT INTO credit_card_billing (user_id,title,first_name,last_name,company,address,address2,suite,city,state,zip,country,phone,phone_ext,email,`default`,visible) 
                VALUES ("' . $user_id . '","default","' . mysql_real_escape_string($data['fname']) . '","' . mysql_real_escape_string($data['lname']) . '",
                    "' . mysql_real_escape_string($data['co']) . '","' . mysql_real_escape_string($data['street']) . '","' . mysql_real_escape_string($data['street2']) . '","","' . mysql_real_escape_string($data['city']) . '",
                        "' . mysql_real_escape_string($data['state']) . '","' . mysql_real_escape_string($data['zip']) . '","' . mysql_real_escape_string($data['country']) . '",
                            "' . mysql_real_escape_string($data['phone']) . '","' . mysql_real_escape_string($data['ext']) . '","' . mysql_real_escape_string($data['email']) . '",1,1)') or die(mysql_error());

    return $user_id;
}

function convFormat($val)
{
    // return iconv("ISO-8859-1", "UTF-8//TRANSLIT", mysql_real_escape_string($val));
    return mysql_real_escape_string($val);
}


$industries = array(
    'Arts, Entertainment and Media',
    'Music',
    'Christian',
    'Business, Consulting & Sales',
    'Finance',
    'Real Estate',
    'Education',
    'Construction, Engineering, Mining & Trades',
    'Restaurant and Food Service',
    'Sports, Fitness, Recreation',
    'Manufacturing',
    'Health Care',
    'Legal',
    'Computers and IT',
    'Advertising, Marketing & Public Relations',
    'Community Social/Non-Profit',
    'Printing and Publishing',
    'Military/Law Enforcement',
    'Graphic Design',
    'Tourism',
    'Government',
    'Manufacturing and Production',
    'Transportation & Logistics',
    'Personal Services'
);

$countries = array(
    "Afghanistan",
    "Albania",
    "Algeria",
    "American Samoa",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antarctica",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegowina",
    "Botswana",
    "Bouvet Island",
    "Brazil",
    "British Indian Ocean Territory",
    "Brunei Darussalam",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Cayman Islands",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Christmas Island",
    "Cocos (Keeling) Islands",
    "Colombia",
    "Comoros",
    "Congo",
    "Congo, the Democratic Republic of the",
    "Cook Islands",
    "Costa Rica",
    "Cote d'Ivoire",
    "Croatia (Hrvatska)",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East Timor",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Falkland Islands (Malvinas)",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "France Metropolitan",
    "French Guiana",
    "French Polynesia",
    "French Southern Territories",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Greenland",
    "Grenada",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Heard and Mc Donald Islands",
    "Holy See (Vatican City State)",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran (Islamic Republic of)",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, Democratic People's Republic of",
    "Korea, Republic of",
    "Kuwait",
    "Kyrgyzstan",
    "Lao, People's Democratic Republic",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libyan Arab Jamahiriya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macau",
    "Macedonia, The Former Yugoslav Republic of",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Martinique",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mexico",
    "Micronesia, Federated States of",
    "Moldova, Republic of",
    "Monaco",
    "Mongolia",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "Netherlands Antilles",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Norfolk Island",
    "Northern Mariana Islands",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn",
    "Poland",
    "Portugal",
    "Puerto Rico",
    "Qatar",
    "Reunion",
    "Romania",
    "Russian Federation",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia (Slovak Republic)",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Georgia and the South Sandwich Islands",
    "Spain",
    "Sri Lanka",
    "St. Helena",
    "St. Pierre and Miquelon",
    "Sudan",
    "Suriname",
    "Svalbard and Jan Mayen Islands",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syrian Arab Republic",
    "Taiwan, Province of China",
    "Tajikistan",
    "Tanzania, United Republic of",
    "Thailand",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Islands",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "United States Minor Outlying Islands",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Vietnam",
    "Virgin Islands (British)",
    "Virgin Islands (U.S.)",
    "Wallis and Futuna Islands",
    "Western Sahara",
    "Yemen",
    "Yugoslavia",
    "Zambia",
    "Zimbabwe"
);

$states = array(
    'AL' => "Alabama",
    'AK' => "Alaska",
    'AZ' => "Arizona",
    'AR' => "Arkansas",
    'CA' => "California",
    'CO' => "Colorado",
    'CT' => "Connecticut",
    'DE' => "Delaware",
    'DC' => "District Of Columbia",
    'FL' => "Florida",
    'GA' => "Georgia",
    'HI' => "Hawaii",
    'ID' => "Idaho",
    'IL' => "Illinois",
    'IN' => "Indiana",
    'IA' => "Iowa",
    'KS' => "Kansas",
    'KY' => "Kentucky",
    'LA' => "Louisiana",
    'ME' => "Maine",
    'MD' => "Maryland",
    'MA' => "Massachusetts",
    'MI' => "Michigan",
    'MN' => "Minnesota",
    'MS' => "Mississippi",
    'MO' => "Missouri",
    'MT' => "Montana",
    'NE' => "Nebraska",
    'NV' => "Nevada",
    'NH' => "New Hampshire",
    'NJ' => "New Jersey",
    'NM' => "New Mexico",
    'NY' => "New York",
    'NC' => "North Carolina",
    'ND' => "North Dakota",
    'OH' => "Ohio",
    'OK' => "Oklahoma",
    'OR' => "Oregon",
    'PA' => "Pennsylvania",
    'RI' => "Rhode Island",
    'SC' => "South Carolina",
    'SD' => "South Dakota",
    'TN' => "Tennessee",
    'TX' => "Texas",
    'UT' => "Utah",
    'VT' => "Vermont",
    'VA' => "Virginia",
    'WA' => "Washington",
    'WV' => "West Virginia"
);

$products = array(
    'folders'    => 'Folders',
    'sales'      => 'Sales/Product Sheets',
    'media'      => 'Media/Press Kits',
    'brochures'  => 'Brochures/Catalogs',
    'buscards'   => 'Business Cards',
    'stationery' => 'Stationery Package',
    'directmail' => 'Direct Mail',
    'photoframe' => 'Photo Frame',
    'other' => 'Other'
);

$listFields = array(
    'industry' => $industries,
    'country'  => $countries,
  //  'state'    => array_values($states)
);

validate_list_fields($listFields, $data);

if (isset($data['products'])) {
    foreach ($data['products'] as $product) {
        if (!array_key_exists($product, $products)) {
            response('error', 'Incorrect product ' . $product);
        }
    }
}

$required = array(
    'industry' => 'Industry',
    'co'       => 'Company',
    'fname'    => 'First name',
    'lname'    => 'Last name',
    'street'   => 'Address',
    'city'     => 'City',
    'state'    => 'State',
    'zip'      => 'Zip Code',
    'phone'    => 'Phone',
    'email'    => 'Email'
);

foreach ($required as $key => $field) {
    if (!isset($data[$key])) {
        response('error', 'field ' . $field . ' is required');
    }
}

//response('success', 'Success');


$today = date("Ymd");
$searchid = ($_SESSION['search_id']) ? $_SESSION['search_id'] : '';
$completeaddress = mysql_real_escape_string($data['co']) . " \nATTN: " . mysql_real_escape_string($data['fname']) . " " . mysql_real_escape_string($data['lname']) . " \n" . mysql_real_escape_string($data['street']) . " \n" . mysql_real_escape_string($data['city']) . ", " . mysql_real_escape_string($data['state']) . " " . $data['zip'] . " \n\n(" . mysql_real_escape_string($data['area']) . ") " . mysql_real_escape_string($data['phone']);
$keywords = (empty($_SESSION['keyword'])) ? '' : str_replace('+', ' ', $_SESSION['keyword']);
if (empty($keywords) && !empty($searchid)) {
    $str = explode('&', $searchid);
    if (!empty($str)) {
        foreach ($str as $val) {
            $one_req = explode('=', $val);
            if (!empty($one_req) && $one_req[0] == 'q') {
                $keywords = str_replace('+', ' ', $one_req[1]);
                $keywords = str_replace('%20', ' ', $keywords);
            }
        }
    }
}

$data['co'] = trim($data['co']);

//    mysql_close();
//new DB
$dblink2 = mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
// mysql_query("SET NAMES 'utf8';");
// mysql_set_charset("utf8", $dblink2);
mysql_select_db("preprod");

//check company
$comp_exist = mysql_query('SELECT id FROM users_company WHERE company="' . mysql_real_escape_string($data['co']) . '"');
$comp = mysql_fetch_array($comp_exist);

//add new company
mysql_query('INSERT INTO users_company (company) VALUES ("' . mysql_real_escape_string($data['co']) . '")');
$comp_id = mysql_insert_id();

//keep eye on it
mysql_query('INSERT INTO eye_user_company (uid, company_id) VALUES (1, "' . $comp_id . '")');

//add new user
$user['id'] = add_user_func($comp_id, $data);
//update company main user
mysql_query('UPDATE users_company SET main_user="' . $user['id'] . '" WHERE id="' . $comp_id . '"');
$req_status = 1;

if (!empty($comp)) {
    mysql_query('UPDATE users_company SET duplicate=1 WHERE id="' . $comp_id . '"');
}

$order_data = array();

if (!empty($data['products'])) {
    foreach ($data['products'] as $product) {
        $order_data[$product] = $products[$product];
    }
}

$ref_source = (empty($_GET['src'])) ? '' : $_GET['src'];

mysql_query('INSERT INTO requests (job_id, user_id, company_id, request_date, operating_sys, graphics_app, ref_source, other_source, processed_date, industry, conversations, complete_address, search_id, offers, order_data, tracking_number, search_keyword, user_ip, status) 
    VALUES ("", ' . $user['id'] . ', "' . $comp_id . '", NOW(), "' . mysql_real_escape_string($data['os']) . '", "' . mysql_real_escape_string($data['app']) . '", "' . mysql_real_escape_string($data['ref']) . '", 
        "' . mysql_real_escape_string($ref_source) . '", NULL, "' . mysql_real_escape_string($data['industry']) . '", "", "' . $completeaddress . '", "' . $searchid . '", "' . mysql_real_escape_string($data['offers']) . '", "' . mysql_real_escape_string(serialize($order_data)) . '", "", "' . $keywords . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '", "' . $req_status . '")');

$id = mysql_insert_id();
//add event
mysql_query('INSERT INTO events (date,`type`,`text`,type_id) VALUES (NOW(),"new_request","","' . $id . '")');


$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: InkRockit <dtraub@inkrockit.com>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$date = date("h:i, jS F Y", time() + 3600 * 3);
$message = "InkRockit Printed Samples Request \nDate: $date \n\n" . $data['co'] . " \nATTN: " . $data['fname'] . " " . $data['lname'] . " \n" . $data['street'] . " \n" . $data['city'] . ", " . $data['state'] . " " . $data['zip'] . " \n\n(" . $data['area'] . ") " . $data['phone'] . " \n" . $data['email'] . " \n\nReference Source: " . $data['ref'] . " \nIndustry: " . $data['industry'] . " \n" . $data['position'] . " ";
$message = str_replace("\'", "'", $message);
$message = $message . "\n\nOther Information\n\n";
if ($data['offers'] != '') {
    $message = $message . "E-mail me with special offers from InkRockit: " . $data['offers'] . "\n\n";
}
$message = $message . "\n\nWhat products are you interested in?\n\n";


if (!empty($data['products'])) {
    foreach ($data['products'] as $product) {
        $message = $message . "" . $products[$product] . "\n";
    }
}

if (mail("leads@imageteam.com", "InkRockit Printed Samples Request", $message, $headers)) {
     mail("clay@imageteam.com", "InkRockit Printed Samples Request", $message, $headers);

    //send to user
    $fname = $data['fname'];
    $company = $data['co'];

    $comp_exist = mysql_query('SELECT val FROM settings WHERE `key`="request_email_template"');
    $comp = mysql_fetch_array($comp_exist);
    $message2 = $comp['val'];
    $message2 = str_replace(array('%name%', '%company%', "\'"), array(
        $fname,
        $company,
        "'"
    ), $message2);

    function mail_attachment($filename, $path, $mailto, $subject, $message)
    {
        $file = $path . $filename;
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $name = basename($file);
        $from = "Don Traub <dtraub@inkrockit.com>";
        $separator = md5(time());
        $eol = PHP_EOL;
        $attachment = chunk_split(base64_encode($content));

        $headers = "From: " . $from . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";

        $body = "--" . $separator . $eol;
        $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
        //            $body .= "This is a MIME encoded message." . $eol;
        $body .= "--" . $separator . $eol;

        $body .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
        $body .= $message . $eol;

        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $name . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol . $eol;
        $body .= $attachment . $eol;
        $body .= "--" . $separator . "--";
        if (mail($mailto, $subject, $body, $headers)) {
            //                echo "mail send ... OK"; // or use booleans here
        }
    }

    $my_file = "IR_ENVELOPE.pdf";
    $my_path = $_SERVER['DOCUMENT_ROOT'] . "/request/";
    $subject = "Hi " . $fname . ", welcome to InkRockit!";
    mail_attachment($my_file, $my_path, $data['email'], $subject, $message2);
}

response('success', 'Success');
