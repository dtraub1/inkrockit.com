<?
/*
  session_start();
  if (empty($_SESSION['search_id'])) {
  $_SESSION['search_id'] = $_SERVER['HTTP_REFERER'];
  }
  if (!empty($_SESSION['search_id'])) {
  $parse_url = pathinfo($_SESSION['search_id']);
  $base = explode('?', $parse_url['basename']);
  if (!empty($base[1])) {
  $all = @explode('&', $base[1]);
  if (!empty($all)) {
  foreach ($all as $val) {
  $v = @explode('=', $val);
  if (!empty($v[0]) && $v[0] == 'q') {
  $_SESSION['keyword'] = $v[1];
  }
  }
  }
  }
  } */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/normalize.css" type="text/css" rel="stylesheet" />
        <link href="js/jquery.fancybox.css" type="text/css" rel="stylesheet" />
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<![endif]-->
        <script src="js/jquery.js"></script>
<!--        <script src="js/smartspinner.js" type="text/javascript"></script>
        <script src="js/external/mootools-1.2.4-core-yc.js"></script>
        <script src="js/external/mootools-more.js"></script>
        <script src="js/dg-picture-zoom.js"></script>
        <script src="js/dg-picture-zoom-autoload.js"></script>-->
        <script type="text/javascript">
//            $(document).ready(function() {
//                var s = $('#red').spinit({height: 16, width: 18, min: 0,
//                    //                initValue: 40,
//                    max: 255, callback: onred, callback: onred});
//                function onred(val) {
//                    r = val;
//
//                }
//            });
        </script>
        <!--<script src="js/mousestop.js"></script>-->
        <script src="js/myscripts.js"></script>
        <script src="js/jquery.fancybox.js" type="text/javascript"></script>
        <script src="js/jquery.fancybox.pack.js" type="text/javascript"></script>
        <title>Inkrockit.com</title>
    </head>
    <body>
        <div id="order_form">
            <section class="orderList">
            </section>
        </div>  
        <img style="display:none" src="image/buttonBgSelect.png">

        <header class="TopHeader">
            <a class="logo" href="" ><img src="image/logo.png"></a>
            <div class="HeadItem">
                <div class="headtext">
                    <p class="headitemname2"><img src="image/SempleImg.png"></p>
                    <p class="headitemtext2">
                        See the quality and custom
                        finishes that set us apart.
                    </p>
                        <a href="samples.php" data-fancybox-type="iframe" class="headbutton various">Send Me Samples</a>
                </div>
                <img class="item2Bg" src="image/headitem2.png">
            </div>
            <span class="landingTopPhone"><img src="image/headerPhone.png"></span>
        </header>

        <br class="clear">
        <div class="main">

            <div class="LandingPage">
                <h2 class="landingTitle"><span>Hello.</span> Welcome to the world of InkRockit!</h2>
                <h1 class="landingTitle">Your #1 Source for Photo Frames <div class="text-gradient"></div></h1>

                <div class="landingLeft">
                    <img src="image/title.jpg">
                    <span class="info">
                        Showcase a destination, event or special occassion using eye-catching custom photo frames designed and printed by <em>InkRockit</em>.
                    </span>

                    <div class="custom_finish">
                        <h3>CUSTOM FINISHES</h3>
                        <span class="descr">Get the “WOW” Factor!</span><br>

                        <p class="info_descr">
                            Ask about maximizing the impact of your photo frames for a price that won’t hurt your budget by using one or more of InkRockit’s affordable custom finishes. 
                        </p>
                        <ul>
                            <li>Custom Die-cuts</li>
                            <li>UV Coating</li>
                            <li>Spot UV Coating</li>
                            <li>Lamination</li>
                            <li>Embossing</li>
                        </ul>

                        <ul>
                            <li>Foil Stamping</li>
                            <li>PMS Colors</li>
                            <li>Metallic Colors</li>
                            <li>Custom Sizes</li>
                            <li>Specialty Papers</li>
                        </ul>
                    </div>
                </div>

                <div class="landingRight">
                    <div class="landRightTop">
                        <b>1000 Custom Photo Frames</b>
                        <div class="price">$1.48 each</div>
                        <em>Total Price $1,479 - Shipping Included!</em>
                    </div>
                    <hr class="blue">
                    <div class="landRightBoldText"> 7in x 5in Custom Photo Frames include:</div>
                    <ul class="landRightFirstText">
                        <li>Full Color (4-color front, back & inside)</li>
                        <li>FREE Matte Lamination</li>
                        <li>Custom Die Cut</li>
                        <li>Premium 12pt Paper</li>
                    </ul>
                    <br class="clear">
                    
                    <div class="Landlogos">
                        <table width="100%">
                            <tr class="bold">
                                <td width="65">Quantity</td>
                                <td width="60">Price*</td>
                                <td>Price Per Piece</td>
                            </tr>
                            <tr class="odd">
                                <td>1500</td>
                                <td>$1,855</td>
                                <td>$1.24</td>
                            </tr>
                            <tr>
                                <td>3000</td>
                                <td>$3,172</td>
                                <td>$1.06</td>
                            </tr>
                            <tr class="odd">
                                <td>4500</td>
                                <td>$4,443</td>
                                <td>$0.99</td>
                            </tr>
                            <tr>
                                <td>6000</td>
                                <td>$5,900</td>
                                <td>$0.98</td>
                            </tr>
                            <tr class="odd">
                                <td>9000</td>
                                <td>$8,342</td>
                                <td>$0.93</td>
                            </tr>
                        </table>
                        <em>* Price includes shipping.</em>
                    </div>
                </div>

                <br class="clear">
                <div class="mainFoot">
                    <span class="mainFooterBorder"><img src="image/mainFooterBorder.png"></span>
                    <div class="mainFooterFirstBlock">
                        <p class="mainFooterBlockText"> An award-winning creative team that will maximize the impact of your piece or take your brand to the next level.</p>
                    </div>
                    <div class="footerSeparator">
                    </div>
                    <div class="mainFooterSecondBlock">
                        <p class="mainFooterBlockText"> Attractively priced, premium quality printing supported by our unmatched service and Rockit fast delivery.</p>
                    </div>
                    <div class="footerSeparator">

                    </div>
                    <div class="mainFooterThirdBlock">
                        <p class="mainFooterBlockText">Effective Direct Mail services that deliver your marketing materials to the right people at the right time. </p>
                    </div>
                </div>
            </div>
            <br class="clear">
        </div>

        <? /*

          <!-- Start of Zopim Live Chat Script -->
          <script type="text/javascript">
          window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=
          z.s=d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o
          ){z.set._.push(o)};$.setAttribute('charset','utf-8');$.async=!0;z.set.
          _=[];$.src=('https:'==d.location.protocol?'https://ssl':'http://cdn')+
          '.zopim.com/?oJyipXXEO2CXYdc2p1rl1eZPFY56nfb2';$.type='text/java'+s;z.
          t=+new Date;z._=[];e.parentNode.insertBefore($,e)})(document,'script')
          </script>
          <script type="text/javascript">
          var google_conversion_id = 1071175607;
          var google_conversion_language = "en";
          var google_conversion_format = "3";
          var google_conversion_color = "ffffff";
          var google_conversion_label = "sdcJCOfp4wIQt6_j_gM";
          var google_conversion_value = 0;
          </script>
          <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
          </script>
          <div style="display:none;">
          <img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1071175607/?label=sdcJCOfp4wIQt6_j_gM&amp;guid=ON&amp;script=0"/>
          </div>
         */ ?>
    </body>
</html>
