<?
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
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
  <link href="css/normalize.css?v=1" type="text/css" rel="stylesheet"/>
  <link href="js/jquery.fancybox.css" type="text/css" rel="stylesheet"/>
  <link href="css/style.css?v=1" type="text/css" rel="stylesheet"/>

  <!--Start of Zendesk Chat Script-->
  <script type="text/javascript">
    window.$zopim ||
    (function (d, s) {
      var z = ($zopim = function (c) {
          z._.push(c);
        }),
        $ = (z.s = d.createElement(s)),
        e = d.getElementsByTagName(s)[0];
      z.set = function (o) {
        z.set._.push(o);
      };
      z._ = [];
      z.set._ = [];
      $.async = !0;
      $.setAttribute("charset", "utf-8");
      $.src = "https://v2.zopim.com/?oJyipXXEO2CXYdc2p1rl1eZPFY56nfb2";
      z.t = +new Date();
      $.type = "text/javascript";
      e.parentNode.insertBefore($, e);
    })(document, "script");
  </script>
  <!--End of Zendesk Chat Script-->


  <!-- TrustBox script -->
  <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script><!-- End Trustbox script -->
  <script>
    var browser = navigator.userAgent;
    //            document.write(browser)
    var regV = /firefox/i;
    var regV1 = /opera/i;
    var regV2 = /chrome/i;
    var regV3 = /msie/i;
    var regV4 = /safari/i;
    if (browser.search(regV) != -1) {
      document.write('<link href="css/styleFireFox.css" type="text/css" rel="stylesheet" >')

    }
    if (browser.search(regV1) != -1) {
      document.write('<link href="css/styleOpera.css" type="text/css" rel="stylesheet" >')

    }
    if (browser.search(regV3) != -1) {
      document.write('<link href="css/styleMsie.css" type="text/css" rel="stylesheet" >')
    }
    if (browser.search(regV4) != -1 && browser.search(regV2) == -1) {
      document.write('<link href="css/styleSafari.css" type="text/css" rel="stylesheet" >')
    }
    if (browser.search(regV2) != -1 && browser.search(regV4) != -1) {
      document.write('<link href="css/styleChrome.css" type="text/css" rel="stylesheet" >')
    }
  </script>
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

  <link href="css/responsive.css" type="text/css" rel="stylesheet"/>
  <script src="js/jquery.js"></script>
  <script src="js/smartspinner.js" type="text/javascript"></script>
  <script src="js/external/mootools-1.2.4-core-yc.js"></script>
  <script src="js/external/mootools-more.js"></script>
  <script src="js/dg-picture-zoom.js"></script>
  <script src="js/dg-picture-zoom-autoload.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      var s = $('#red').spinit({
        height: 16, width: 18, min: 0,
        //                initValue: 40,
        max: 255, callback: onred, callback: onred
      });

      function onred(val) {
        r = val;

      }
    });
  </script>
  <script src="js/mousestop.js"></script>
  <script src="js/myscripts.js"></script>
  <script src="js/jquery.fancybox.js" type="text/javascript"></script>
  <script src="js/jquery.fancybox.pack.js" type="text/javascript"></script>
  <title>Custom Folders | Custom Pocket Folders | InkRockit</title><meta name="description" content="InkRockit offers premium quality custom pocket folders and other affordable custom services online. Our creative team is trained to provide superior solutions to take your pieces to the next level. Give us a call!">
  <link rel="canonical" href="https://inkrockit.com/custom_folders/"/>
</head>
<body>
<div id="order_form">
  <section class="orderList">
  </section>
</div>
<img style="display:none" src="image/buttonBgSelect.png" alt="selectbtn">
<header class="TopHeader">
  <a class="logo" href=""><img src="image/logo.png" alt="logo"></a>
  <a class="HeadItem">
    <div href="//www.inkrockit.com/request/" data-fancybox-type="iframe" class="headtext various">
      <p class="headitemname2"><img src="image/SempleImg.png" alt="simpleimg"></p>
      <p class="headitemtext2">
        See the quality and custom
        finishes that set us apart.
      </p>
      <div class="headbutton">Send Me Samples</div>
    </div>
    <img class="item2Bg" src="image/headitem2.png" alt="headeritem2">
  </a>
  <span class="landingTopPhone">
        <a href="tel:18009005632">
            <img src="image/headerPhone.png" alt="headerphone">

            <span class="click">click to call!</span>
            <span class="num">1.800.900.5632</span>
        </a>
    </span>
</header>

<br class="clear">
<div class="main">


  <!-- TrustBox widget - Carousel -->
  <!--    <div class="trustpilot-widget" style="padding: 20px 5px 5px 0"-->
  <!--         data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5bbbb4440f71f300012e2dab"-->
  <!--         data-style-height="130px" data-style-width="100%" data-theme="light" data-stars="1,2,3,4,5"><a-->
  <!--                href="//www.trustpilot.com/review/www.inkrockit.com" target="_blank">Trustpilot</a></div>-->
  <!-- End TrustBox widget -->

  <div class="LandingPage">
    <div class="landingLeft">
      <span class="landingTitle"><img src="image/landingTitle.png" alt="landing title"></span>
      <span><h1 style="text-align: center; font-size:40px;">InkRockit Custom Folders</h1></span>
      <span id="landImg1" class="landingImg"><img src="image/Landing1Img.jpg" alt="landingimg"></span>
      <span id="landImg2" class="landingImg" style="display:none;"><img src="image/Landing2Img.jpg" alt="landingimg2"></span>
      <span id="landImg3" class="landingImg" style="display:none;"><img src="image/Landing3Img.jpg" alt="landingimg3"></span>
      <span id="landImg4" class="landingImg" style="display:none;"><img src="image/Landing4Img.jpg" alt="landingimg4"></span>
      <span id="landImg5" class="landingImg" style="display:none;"><img src="image/Landing5Img.jpg" alt="landingimg5"></span>
    </div>
    <div class="landingRight">
      <span class="landRightTop"><img src="image/landingDiferense.png" alt="landingdif"></span>
      <p class="landRightBoldText"> InkRockit is an innovative printing, packaging and design company with a fanatical devotion to quality and service</p>
      <p class="landRightFirstText">We don't cut corners or sacrifice service
        to boost our bottom line. What we do is
        provide our customers with results. We're
        not afraid of rolling up our sleeves and
        climbing into the trenches with you. As a
        matter of fact, that's the way we prefer it.
        Understanding your company, your goals
        and your challenges allows us to provide
        you with superior solutions.

      </p>
      <p class="landRightSecText">Since 1989, we've built our success on
        helping our customers build theirs, and
        we'd love the opportunity to discuss what
        we can do for you.</p>
      <div class="Landlogos">
        <p class="LandImg1"><img src="image/LandVH1.png" alt="landvh1"></p>
        <p class="LandImg2"><img src="image/LandMtv.png" alt="landmtv"></p>
        <p class="LandImg3"><img src="image/LandSony.png" alt="landsony"></p>
        <p class="LandImg4"><img src="image/LandLamb.png" alt="landlamb"></p>
        <p class="LandImg5"><img src="image/LandSpike.png" alt="landspike"></p>
        <p class="LandImg6"><img src="image/LandNickel.png" alt="landnickel"></p>
        <p class="LandImg7"><img src="image/LandNascar.png" alt="landnascar"></p>

        <p class="LandLogogsText">Whether you're an established brand or a rising star, InkRockit will help you shine!</p>
      </div>
    </div>

    <br class="clear">

    <div class="tr-wrap">
      <div class="tr-review-wrap">
        <a href="https://www.trustpilot.com/evaluate/www.inkrockit.com" class="tr-review" target="_blank">
          <img src="image/rewiew.jpg" alt="reviewbig" class="big">
          <img src="image/rewiew-m.jpg" alt="reviewmid" class="mid">
        </a>
      </div>

      <a href="https://www.trustpilot.com/review/www.inkrockit.com" class="trust-back" target="_blank">
        <img src="image/trust1.jpg" alt="trust1" class="big">
        <img src="image/trust2.jpg" alt="trust2" class="big">
        <img src="image/trust3.jpg" alt="trust3" class="big">

        <img src="image/trust1-m.jpg" alt="trust1-m" class="mid">
        <img src="image/trust2-m.jpg" alt="trust2-m" class="mid">
        <img src="image/trust3-m.jpg" alt="trust3-m" class="mid">

        <img src="image/trust1-s.jpg" alt="trust1-s" class="sml">
        <img src="image/trust2-s.jpg" alt="trust2-s" class="sml">
        <img src="image/trust3-s.jpg" alt="trust3-s" class="sml">
      </a>
    </div>

    <br class="clear">
    <div class="mainFoot">
      <span class="mainFooterBorder"><img src="image/mainFooterBorder.png" alt="mainfooter"></span>
      <div class="mainFooterFirstBlock">
        <p class="mainFooterBlockText"> An award-winning creative team that will maximize the impact of your piece or take your brand to the next
          level.</p>
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
<script src="//code.tidio.co/fa4oqney5b8swkmrmq2l9a7lqlckuz2k.js" async></script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList", 
  "itemListElement": [{
    "@type": "ListItem", 
    "position": 1, 
    "name": "Homepage",
    "item": "https://inkrockit.com/"  
  },{
    "@type": "ListItem", 
    "position": 2, 
    "name": "Custom Folders",
    "item": "https://inkrockit.com/custom_folders/"  
  }]
}
</script>


<!-- Start of Zopim Live Chat Script -->
<script type="text/javascript">
  window.$zopim || (function (d, s) {
    var z = $zopim = function (c) {
      z._.push(c)
    }, $ =
      z.s = d.createElement(s), e = d.getElementsByTagName(s)[0];
    z.set = function (o
    ) {
      z.set._.push(o)
    };
    $.setAttribute('charset', 'utf-8');
    $.async = !0;
    z.set._ = [];
    $.src = ('https:' == d.location.protocol ? 'https://ssl' : 'https://cdn') +
      '.zopim.com/?oJyipXXEO2CXYdc2p1rl1eZPFY56nfb2';
    $.type = 'text/java' + s;
    z.t = +new Date;
    z._ = [];
    e.parentNode.insertBefore($, e)
  })(document, 'script')
</script>
<script type="text/javascript">
  /* <![CDATA[ */
  var google_conversion_type = 'landing';
  var google_conversion_id = 1071175607;
  var google_conversion_language = "en";
  var google_conversion_format = "3";
  var google_conversion_color = "ffffff";
  var google_conversion_label = "3SG_COfqhgQQt6_j_gM";
  // var google_conversion_label = "sdcJCOfp4wIQt6_j_gM";
  var google_conversion_value = 0;
  /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<!-- Global site tag (gtag.js) - Google Ads: 1071175607 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-1071175607"></script>
<script> window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }

  gtag('js', new Date());
  gtag('config', 'AW-1071175607'); </script>
<div style="display:none;">
  <img height="1" width="1" style="border-style:none;" alt=""
       src="//www.googleadservices.com/pagead/conversion/1071175607/?label=3SG_COfqhgQQt6_j_gM&amp;guid=ON&amp;script=0"/>
</div>
</body>
</html>
