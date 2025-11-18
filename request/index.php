<?
mysql_connect("localhost", "preprod_user", "!1q2w3eZ");
mysql_select_db("preprod");
$all_industry = array();
$ind = mysql_query('SELECT * FROM is_types');
while ($val = mysql_fetch_array($ind)) {
    $all_industry[] = $val['title'];
}

//when call using url + ?kit=1
$from_press_kit = !empty($_GET['kit']);
$append_url = ($from_press_kit) ? '?src=kit' : '';

?><!DOCTYPE html>
<html>
<head>
    <title>InkRockit - Request Printed Samples</title>
    <meta name="viewport"
          content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link rel="stylesheet" href="normalize.css?v=1">
    <link rel="stylesheet" href="sample_pack2.css?v=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<script>
    function checkForm() {
        var required = new Array('industry', 'co', 'fname', 'lname', 'street', 'city', 'state', 'zip', 'phone', 'email'),
            submitcount = 0;
        for (i = 0; i < required.length; i++) {
            elem = document.forms[0][required[i]];
            if (elem.value == "") {
                alert('Your "' + elem.title + '" is required to send.');
                elem.focus();
                return false;
            }
        }
        if (submitcount == 0) {
            submitcount++;

            // gtag('event', 'conversion', {
            //   'send_to': 'AW-1071175607/6MGTCP22RRC3r-P-Aw',
            //   'value': 1.0,
            //   'currency': 'USD'
            // });
            return true;
        } else {
            alert("This form has already been submitted.  Thanks!");
            return false;
        }
    }
</script>
<body>


<form method="POST" id="request" onSubmit="return checkForm();"
      action="//www.inkrockit.com/request/send.php<?= $append_url ?>">
    <div class="box_sample_pack" style="display: block;">
        <div class="title_box_sample_pack">
            Order Your Free Sample Pack
        </div>
        <div class="content_sample_pack">

            <div class="block_top_sample_pack">
                <div class="left_block_sample_pack">
                    <div class="block_title_see_sample_pack">
                        <div class="title_see_sample_pack"></div>
                    </div>
                    <div class="text_sample_pack bold_title_14 left marg_t10">
                        Our sample packs showcase the quality
                        of<br> our work and include a variety of
                        custom finishes that will spark your imagination.
                    </div>

                    <div class="text_sample_pack left marg_t17">
                        <strong>TIP:</strong> Before placing an order with any printing service (including us),
                        you should look at samples of their work to avoid any surprises.
                    </div>
                    <img src="img/img_sample_pack.png" class="left marg_t23" style="margin-bottom: 100px">

                </div>
                <div class="right_block_sample_pack right">
                    <div class="left marg_l10 marg_t15 bold_title_12" style="width: 269px;">
                        Please let us know what industry you are in so we can mail
                        you the best sample pack option.

                        <select title="Industry" name="industry" class="big_select select_state_box_ship marg_t10">
                            <option value="">Select Your Industry</option>
                            <?
                            if (!empty($all_industry)) {
                                foreach ($all_industry as $val) {
                                    ?>
                                    <option value="<?= $val ?>"><?= $val ?></option><?
                                }
                            }
                            ?>
                        </select>

                        <div style="display: none" id="error"></div>
                    </div>

                    <table class="form_adress_sample_pack">
                        <tbody>
                        <tr>
                            <td>
                                <div class="label_input_box_ship">Company</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <input type="text" class="input_box_ship" name="co" title="Company">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship">First Name</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <input type="text" title="First Name" class="input_box_ship" name="fname">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship">Last Name</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <input type="text" title="Last Name" class="input_box_ship" name="lname">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship">Address</div>
                            </td>
                            <td>
                                <div style="" class="one_form_input">
                                    <input type="text" title="Address" class="input_box_ship" name="street"
                                           placeholder="* No P.O. Box deliveries">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="label_input_box_ship">Address 2</div>
                            </td>
                            <td>
                                <div style="" class="one_form_input">
                                    <input type="text" class="input_box_ship" name="street2">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship">City</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <input type="text" class="input_box_ship" name="city" title="City">
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <div class="label_input_box_ship">State</div>
                            </td>
                            <td>
                                <div style="" class="one_form_input">
                                    <select name="state" title="State" class="select_state_box_ship">
                                        <option></option>
                                        <option value="AK">Alaska</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="IA">Iowa</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MD">Maryland</option>
                                        <option value="ME">Maine</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MT">Montana</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NY">New York</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VA">Virginia</option>
                                        <option value="VT">Vermont</option>
                                        <option value="WA">Washington</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship" style="margin-top: 7px;">ZIP Code</div>
                            </td>
                            <td>
                                <div style="" class="one_form_input">
                                    <input name="zip" id="zip" type="text" title="Zip Code"
                                           class="small_input input_box_ship">
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <div class="label_input_box_ship">Country</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <select name="country">
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia/Herzegowina">Bosnia/Herzegowina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea">Korea</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Isl">Northern Mariana Isl</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome/Principe">Sao Tome/Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard/Jan Mayen Isl">Svalbard/Jan Mayen Isl</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks And Caicos Isl">Turks And Caicos Isl</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States" selected="true">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="US Minor Islands">US Minor Islands</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                        <option value="Wallis/Futuna Islands">Wallis/Futuna Islands</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Yugoslavia">Yugoslavia</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship" style="margin-top: 7px;">Phone</div>
                            </td>
                            <td>
                                <div class="one_form_input">
                                    <input name="phone" id="phone" type="text" class="small_input input_box_ship left"
                                           autocomplete="off" title="Phone Number">
                                    <div class="right">
                                        <span class="left"
                                              style="margin-top: 4px; width: 25px; padding-left: 15px">Ext</span>
                                        <input type="text" name="ext" class="small_input_ext right">
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="label_input_box_ship">Email</div>
                            </td>
                            <td>
                                <div style="" class="one_form_input">
                                    <input name="email" type="email" class="input_box_ship" name="company"
                                           title="E-mail">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="marg_t10"><strong>What products are you interested in?</strong></div>

                                <table class="marg_t10" width="100%" style="line-height: 20px">
                                    <tr>
                                        <td width="50%">
                                            <input name="folders" type="checkbox" value="Folders"><span
                                                    class="checkboxtext">Folders</span>
                                        </td>
                                        <td>
                                            <input name="buscards" type="checkbox" value="Business Cards"><span
                                                    class="checkboxtext">Business Cards</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <input name="sales" type="checkbox" value="Sales/Product Sheets"><span
                                                    class="checkboxtext">Sales/Product Sheets</span>
                                        </td>
                                        <td>
                                            <input name="stationery" type="checkbox" value="Stationery Package"><span
                                                    class="checkboxtext">Stationery Package</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <input name="media" type="checkbox" value="Media/Press Kits"><span
                                                    class="checkboxtext">Media/Press Kits</span>
                                        </td>
                                        <td>
                                            <input name="directmail" type="checkbox" value="Direct Mail"><span
                                                    class="checkboxtext">Direct Mail</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <input name="brochures" type="checkbox" value="Brochures/Catalogs"><span
                                                    class="checkboxtext">Brochures/Catalogs</span>
                                        </td>
                                        <td>
                                            <input name="other" type="checkbox" value="Other"><span
                                                    class="checkboxtext">Other</span>
                                            <input name="othertext" type="text" id="othertext" class="right"
                                                   style="width: 76px">
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="left marg_t14 f12" style="width: 269px; color: #000; margin-left: 7px">
                        <input type="checkbox" name="offers" checked="checked" value="Yes" class="left">
                        <span class="checkboxtext">Yes, please email me special InkRockit offers.</span>
                    </div>
                    <div class="block_apply_cancel_sample_pack">
                        <a class="cancel_buttom_sample_pack close">Cancel</a>
                        <input class="Submit_Button" type="submit" value="Submit">
                    </div>
                </div>
            </div>
            <div class="bottom_block_sample_pack">
                <img src="img/clod_sample_pack.png" class="left marg_t4">
                <img src="img/spam_sample_pack.png" class="left marg_l10">
                <div class="left marg_l12 marg_t10" style="width: 490px;">
                    All personal information provided to InkRockit is secure and confidential,
                    and will will not be shared with any third parties or affiliates.
                </div>

                <div class="left marg_t13">
                    <strong>DELIVERY TIME:</strong> Please allow 5-7 business days for delivery.
                    If you are pressed for time and need overnight or 2-day delivery,
                    please call one of our representatives at 1.800.900.5632
                </div>
            </div>
        </div>
    </div>
</form>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-1071175607"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'AW-1071175607');
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="input.format.js"></script>
<script>
    $(function () {

        $("#phone").mask("(999) 999-9999");
        $("#zip").mask("99999");

        $('input[type=text],select').blur(function () {
            var comp = $('input[name=co]').val();
            if (comp) {
                $.post('ajax.php', {
                    'form': $('#request').serialize(),
                    'type': 'check_form'
                }, function (data) {
                    if (data.err) {
                        $('#error').show().html(data.err);
                    } else {
                        $('#error').hide();
                    }
                }, 'json');
            } else {
                $('#error').hide();
            }
        });


        $('.close').click(function () {
            window.close();
        });
    });
</script>


<div class="hide">
    <script type="text/javascript">
        _qoptions = {
            qacct: "p-2aiGOYYoOa7hg"
        };
    </script>
    <script type="text/javascript" src="//edge.quantserve.com/quant.js"></script>
    <noscript>
        <img src="//pixel.quantserve.com/pixel/p-2aiGOYYoOa7hg.gif" style="display: none;" border="0" height="1"
             width="1" alt="Quantcast"/>
    </noscript>
    <!-- End Quantcast tag -->
    <!-- Google Code for Visit Conversion Page -->
    <script type="text/javascript">
        /* <![CDATA[ */
        // var google_conversion_id = 1071175607;
        // var google_conversion_language = "en";
        // var google_conversion_format = "2";
        // var google_conversion_color = "ffffff";
        // var google_conversion_label = "6MGTCP22RRC3r-P-Aw";
        // var google_conversion_value = 0;
        /* ]]> */
    </script>
    <!--  <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">-->
    <!--  </script>-->
    <!--  <noscript>-->
    <!--    <div style="display:inline;">-->
    <!--      <img height="1" width="1" style="border-style:none;" alt=""-->
    <!--           src="//www.googleadservices.com/pagead/conversion/1071175607/?value=0&amp;label=3SG_COfqhgQQt6_j_gM&amp;guid=ON&amp;script=0"/>-->
    <!--    </div>-->
    <!--  </noscript>-->
    <!--  <img src="img/buttonBgSel.png" class="hide">-->
</div>

</body>
</html>

