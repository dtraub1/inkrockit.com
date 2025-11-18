<?
session_start();
$_SESSION['search_id'] = $HTTP_REFERER;
if (!empty($HTTP_REFERER)) {
    $parse_url = parse_url($HTTP_REFERER);
    if(!empty($parse_url['query']) && strpos($HTTP_REFERER, $_SERVER['SERVER_NAME'])===FALSE){
        $all = @explode('&',$parse_url['query']);
        foreach($all as $val){
            $v = @explode('=', $val);
            if(!empty($v[0]) && $v[0]=='q'){
                $_SESSION['keyword'] = $v[1];
            }
        }
    }
}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>We are the Press Kit Design &amp; Printing Experts.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META NAME="Description" CONTENT="InkRockit.com is the source for quality presentation folders, media kits, kit covers and pocket folders. We can foil stamp, emboss or print your folders. ">

<meta name="description" content="Our extensive experience and hard earned knowledge allows us to offer you an impressive array of pocket folders, presentation folders, binders and envelope designs and graphic enhancements to choose from." />
			<meta name="keywords" content="folders, presentation folders, pocket folders, envelopes, binders, presentation folder printing, presentation folder, envelope" />



<META NAME="Keywords" CONTENT="presentation folders, pocket folders, portfolio folders, kit covers, media kits, legal folders, closing folders, tax Folders,">
<title>Pocket Folders, Presentation Folders, Media Kits, Portfolios </title>
<meta name="robots" content="index,follow">
<meta name="GOOGLEBOT" content="INDEX, FOLLOW">

<style type="text/css">
<!--
body {
	background-color: #072d4f;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	font-style: italic;
	color: #FFFFFF;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #FFFFFF;
}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #FFFFFF; font-weight: bold; }
.style6 {
	font-size: 15px;
	color: #ffcc00;
}
.style12 {font-size: 13px;
	color: #013E8E;
}
.style14 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
}
.style15 {font-size: 9px}
.style7 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #09468a;
}
.style8 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-weight: bold; }
.style18 {color: #FFFFFF}
.style21 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #09468a; }
.style23 {font-size: 15px; color: #ffcc00; font-weight: bold; }
.style28 {font-size: 12px}
.style31 {color: #EB1B00}
.style35 {color: #000000}
.style37 {color: #990000}
.style38 {font-size: 15px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #990000; }
.style39 {font-size: 18px}
.style41 {
	color: #990000;
	font-size: 16px;
}
.style43 {font-family: Arial, Helvetica, sans-serif; color: #000000; font-size: 16px;}
.style45 {
	color: #990000;
	font-size: 16px;
}
.style46 {font-size: 15px; color: #09468a; font-family: Arial, Helvetica, sans-serif;}
.style48 {font-size: 16px; color: #09468a; font-family: Arial, Helvetica, sans-serif; }
.style50 {font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; color: #09468a; }
.style56 {color: #990000; font-size: 15px; }
.style57 {font-size: 15px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
.style59 {color: #EB1B00; font-weight: bold; }
.style63 {color: #FFFF00; }
.style65 {font-size: 14px}
.style66 {
	font-size: 12px;
	color: #000000;
}
.style2 a {
	color: #FFE400;
}
.style46 .style39 .style66 {
	color: #B21C04;
}
White Heading {
	color: #FFF;
}
.style39 {
	color: #FFF;
}
.style18 a {
	color: #FFF;
}
.style1 .style57 {
	color: #0B294A;
	font-size: 30px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>

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


<script language="JavaScript" type="text/javascript">
<!--
var wd = 530;
var ht = 765;

var wLeft = (screen.width - wd) / 2;
var wTop = (screen.height - ht) / 2;

function requestSamples(){
	window.open("request/","new","left="+wLeft+",top="+wTop+",width="+wd+",height="+ht+",statusbar=no,resizable=no,scrollbars=yes");
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<!-- Start of Zopim Live Chat Script -->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=
z.s=d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o
){z.set._.push(o)};$.setAttribute('charset','utf-8');$.async=!0;z.set.
_=[];$.src=('https:'==d.location.protocol?'https://ssl':'http://cdn')+
'.zopim.com/?oJyipXXEO2CXYdc2p1rl1eZPFY56nfb2';$.type='text/java'+s;z.
t=+new Date;z._=[];e.parentNode.insertBefore($,e)})(document,'script')
</script>
<!-- End of Zopim Live Chat Script -->
</head>

<!-- Google Code for Default Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_type = 'landing';
var google_conversion_id = 1071175607;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "669933";
//-->
</script>

    
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1071175607/extclk?script=0">
</noscript>

<body>
<table width="803" border="0" align="center" cellpadding="14" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="774" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="317" height="306" align="right" valign="top" ><a name="top"></a><img src="images/index_new/IRlogo_top2.jpg" alt="" name="clickhere" width="317" height="76" border="0" id="clickhere"><br>
          <img src="images/index_new/IRlogo_bottom2.jpg" alt="" width="317" height="230" border="0" usemap="#Map2"></td>
        <td width="457" height="306" align="left" valign="top" class="style1" style="background-position:top; background-repeat:no-repeat;"><img src="images/index_new/astronaut3.jpg" alt="" width="457" height="306" border="0" usemap="#Map"></td>
      </tr>
    </table>
      <map name="Map">
        <area shape="rect" coords="277,230,443,289" href="/webdesign.html" alt="Web site design samples">
      </map>
      <map name="Map2">
        <area shape="rect" coords="39,153,158,200" href="javascript:requestSamples();">
    </map></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252" valign="top" bgcolor="#002D51"><table width="93%" border="0" cellpadding="0" cellspacing="0" bgcolor="1a6fab">
          <tr>
            <td colspan="2"><img src="images/index_new/topleft.jpg" alt="" width="252" height="12"></td>
          </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#08294C"><img src="images/cc_panel.jpg" alt="" width="229" height="76" align="texttop"></td>
          </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#0D2645"><table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="072e52">
              <tr>
                <td align="left" valign="middle" bgcolor="#0B294A"><p class="style18"><img src="images/adobe_icon_selected.jpg" alt="" width="59" height="35" border="0" align="absmiddle">&nbsp;9 x 12 Pocket Folder<a href="index.php"><br>
                </a><a href="6x9_folders.php" class="style1"><img src="images/adobe_icon.jpg" alt="" width="59" height="35" border="0" align="absmiddle"></a>&nbsp;<a href="6x9_folders.php">6 x 9 Pocket Folder</a><br>
                <a href="4x9_folders.php" class="style1"><img src="images/adobe_icon.jpg" alt="" width="59" height="35" border="0" align="absmiddle"></a> <a href="4x9_folders.php" class="style18">4 x 9 Pocket Folder<br>
                </a><span class="style28"><a href="legal_size_folder.php" class="style1"><img src="images/adobe_icon.jpg" alt="" width="59" height="35" border="0" align="absmiddle"></a></span> <a href="legal_size_folder.php" class="style18"></a><a href="legal_size_folder.php" class="style18">9 x 14.5 Legal Folder</a><br>
                <span class="style28"><a href="10x13_mailing_envelope.php" class="style1"><img src="images/adobe_icon.jpg" alt="" width="59" height="35" border="0" align="absmiddle"></a></span> <a href="legal_size_folder.php" class="style18"></a><a href="10x13_mailing_envelope.php" class="style18">10 x 13 Mailing Envelope</a></p>
<p><img src="images/index_new/crisistop.gif" alt="" width="251" height="22"></p></td>
              </tr>
              <tr>
                <td width="251"><div class="style2" style="margin-left:23px; margin-right:23px; padding-top:10px;">
                  <p><span class="style65">If you need  it printed in a hurry, but you can't sacrifice quality, then you&rsquo;ve come to the right place.</span> <span class="style23">Our standard turn-around time is 5 to 7 working days <u><em>to your door!</em></u></span> <span class="style65">And because we're  NOT a gang run printer like  everyone else online, your job, no matter how small, will be printed by itself to ensure the </span><span class="style23">best color every time</span><span class="style65">. That's why the biggest names in the business trust us with their  projects. You'd have to spend a  lot more money to get the same service from anyone else. We Guarantee 7 to 10 days to your door, and if you need it  faster, we can print and deliver in as little as 3 working days!</span><br>
                    <br>
                  </p>
                </div></td>
              </tr>
              <tr>
                <td bgcolor="#0D2645">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="4%" bgcolor="#1F6BA7">&nbsp;</td>
            <td width="96%" bgcolor="#1A6FAB"><div style="margin-left:17px; margin-right:17px; padding-top:5px; padding-bottom:50px;"><br>
              <p class="style2"><span class="style23"><a href="ink_dreams/custom_folders.html" title="Custom Pocket Folders" target="ink_dreams/custom_folders.html">Custom Folders <br>
                Are Our Specialty</a></span><br>
                <span class="style65">Do you need a folder that&rsquo;s out of the ordinary with an <a href="#upgrades" class="style63">emboss, foil stamp, custom die, PMS color, or velcro tabs?</a> No problem. We do it everyday! And, we do it all for less money and less hassle than anyone in the business. Give us one try and you&rsquo;ll never go <br>
                  anywhere else again!</span></p>
              <p class="style2"><strong><span class="style6">Products</span><br>
                <a href="press_kits_home.php">Press Kits / Media Kits</a><br>
                <a href="index.php">Pocket Folders</a><br>
                Multipage Catalogs<br>
                Sales Sheets<br>
                Brochures<br>
                Posters<br>
                Business Cards<br>
                Letterhead<br>
                Envelopes<br>
                CD/DVD Sleeves &amp; Replication <br>
                Custom Orders</strong></p>
              <p><span class="style5"><span class="style6"><a href="http://inkrockit.com/webdesign.html" class="style6">Design Services</a></span><br>
                </span><span class="style2">Need a design that will help you make the sale, book your band or get your product placement? Let our award-winning creative team develop a design solution for your print collateral, website,multimedia presentation, or brand identity</span><span class="style5">.</span></p>
              </div></td>
          </tr>
          <tr>
            <td colspan="2"><img src="images/index_new/bottomleft.gif" width="252" height="12"></td>
          </tr>
        </table></td>
        <td width="28">&nbsp;
  </td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" class="style1"><span class="style57">Press Kits Are Our Specialty.</span></td>
          </tr>
          <tr>
            <td><p><img src="ink_dreams/images/lots_of_stuff5.jpg" width="522" height="316"></p></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="252" height="162" valign="top" background="images/new/main-multipagecatalogs.jpg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="37%">&nbsp;</td>
                      <td width="63%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="33" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td valign="top" class="style14"><img src="images/new/orangearrow.jpg" width="14" height="13"> 8 Page <span class="style18"><br>
                                    <img src="images/new/orangearrow.jpg" width="14" height="13"> </span>Self-cover <span class="style18"><br>
                                    <img src="images/new/orangearrow.jpg" width="14" height="13"></span> Full Color </td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td width="251" background="images/new/main-salesmarketingsheets.jpg">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="446"><table width="492" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3"><img src="images/index_new/pricetop.gif" width="492" height="9"></td>
                </tr>
              <tr>
                <td background="images/index_new/priceleft.gif">&nbsp;</td>
                <td align="center" valign="top">&nbsp;</td>
                <td background="images/index_new/priceright.gif">&nbsp;</td>
              </tr>
              <tr>
                <td width="23" background="images/index_new/priceleft.gif"><p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p></td>
                <td width="446" align="center" valign="top"><h2><a href="javascript:requestSamples();"><span class="style39"></span></a><a href="javascript:requestSamples();"><span class="style39"></span></a><strong>POCKET FOLDER (9&quot; x 12&quot;)</strong>
                </h2>
                  <p><span class="style7"><a href="javascript:requestSamples();"><img src="images/new/orangearrow.jpg" alt="" width="14" height="13" border="0" align="baseline">See, feel and touch the InkRockit Quality Difference!</a><br>
                    <img src="/images/folder_sample2.jpg" width="480" height="328"><br>
                    <span class="style31">Add <strong>just $350.00</strong> </span></span><span class="style35">to print behind the pockets as shown above.</span><span class="style7"><img src="images/index_new/graybar.gif" width="442" height="25"><br>
                      </span><span class="style48"><span class="style35">with Free Business Card &amp; CD Slits</span></span><span class="style7"><br>
                      </span></p>                  <span class="style38">Full Color (4-color front, back &amp; inside pockets),<br>
                  with 1 or 2 pockets</span>
<p class="style38"><strong>TECH SPECS: 4/0, 12pt (100# C1S Cover)</strong></p>
                  <table width="445" border="0" cellpadding="0" cellspacing="0" background="images/index_new/grid.gif" style="background-position:top; background-repeat:no-repeat;">
                    <tr>
                      <td width="80" height="25"><p align="right" class="style9">Quantity:</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">100</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">250</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">500</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">1000</p>                        </td>
                      <td width="13" class="style8">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="50"><div align="right" class="style9">SubTotal:<br>
                        Tax:<br>
                        Shipping:</div></td>
                      <td height="50" class="style8"><div align="right">$ 468.00<br>
                        N/A<br>
                        27.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 554.00<br>
                        N/A<br>
                        38.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 699.00<br>
                        N/A<br>
                        75.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 890.00<br>
                        N/A<br>
                        109.00</div></td>
                      <td class="style8">&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="35"><div align="right" class="style9">TOTAL:</div></td>
                      <td height="35" class="style8"><div align="right">495.00</div></td>
                      <td height="35" class="style8"><div align="right">592.00</div></td>
                      <td height="35" class="style8"><div align="right">774.00</div></td>
                      <td height="35" class="style8"><div align="right">999.00</div></td>
                      <td class="style8">&nbsp;</td>
                      </tr>
                  </table>
                  <h5><strong><span class="style38"><a href="http://www.inkrockit.com/templates/PF_9x12.zip"><img src="images/new/download_zip.jpg" alt="Download Pocket Folder Template" width="37" height="37" border="0" /></a></span><a href="http://www.inkrockit.com/templates/PF_9x12.zip"><span class="style38"><br>
                      </span></a><span class="style38">DOWNLOAD YOUR FREE</span></strong><br>
                      <strong><a href="http://www.inkrockit.com/templates/PF_9x12.zip"><span class="style48">9&quot;x12&quot; </span><span class="style38">Pocket Folder Template</span></a></strong>                  </h5>
                  <p align="center" class="style35"><a href="/upload"><strong><img src="/images/upload.jpg" alt="Upload Icon" width="37" height="37" border="0" /><br>
                  UPLOAD YOUR FINISHED FILE!</strong></a></p>
                  <p align="center" class="style41"><a name="6x9PressKit"></a><img src="images/index_new/graybar.gif" width="442" height="25"><br>
                    </p>
                  <h2 align="center">Mini Pocket Folder (6&quot; x 9&quot;)</h2>
                  <p align="center"><span class="style46"><span class="style43">with Business Card &amp; CD Slits</span></span><span class="style7"><br>
                    <span class="style28">Full Color (4-color front, back &amp; inside pockets), with 1 or 2 pockets</span></span></p>
                  <p align="center" class="style38"><strong>TECH SPECS: 4/0, 12pt (100# C1S Cover)</strong></p>
                  <table width="445" border="0" cellpadding="0" cellspacing="0" background="images/index_new/grid.gif" style="background-position:top; background-repeat:no-repeat;">
                    <tr>
                      <td width="80" height="25"><p align="right" class="style9">Quantity:</p></td>
                      <td width="88" height="25" class="style8"><p align="right">100</p></td>
                      <td width="88" height="25" class="style8"><p align="right">250</p></td>
                      <td width="88" height="25" class="style8"><p align="right">500</p></td>
                      <td width="88" height="25" class="style8"><p align="right">1000</p></td>
                      <td width="13" class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50"><div align="right" class="style9">SubTotal:<br>
                        Tax:<br>
                        Shipping:</div></td>
                      <td height="50" class="style8"><div align="right">$ 454.00<br>
                        N/A<br>
                        23.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 499.00<br>
                        N/A<br>
                        35.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 674.00<br>
                        N/A<br>
                        69.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 860.00<br>
                        N/A<br>
                        95.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="35"><div align="right" class="style9">TOTAL:</div></td>
                      <td height="35" class="style8"><div align="right">477.00</div></td>
                      <td height="35" class="style8"><div align="right">534.00</div></td>
                      <td height="35" class="style8"><div align="right">743.00</div></td>
                      <td height="35" class="style8"><div align="right">955.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                  </table>
                  <h5 align="center"><a href="http://www.inkrockit.com/templates/PF_6x9.zip" class="style28"><img src="images/new/download_zip.jpg" alt="Download Pocket Folder Template" width="37" height="37" border="0" /><br>
                    </a><strong><span class="style38">DOWNLOAD YOUR FREE</span></strong><a href="http://www.inkrockit.com/templates/PF_6x9.zip" class="style56"><br>
                    </a><span class="style57"><a href="http://www.inkrockit.com/templates/PF_6x9.zip" class="style48">6&quot; X 9&quot;</a><a href="http://www.inkrockit.com/templates/PF_6x9.zip" class="style56"> POCKET FOLDER TEMPLATE</a></span></h5>
                  <p align="center" class="style35"><a href="/upload"><strong><img src="/images/upload.jpg" alt="Upload Icon" width="37" height="37" border="0" /><br>
                    UPLOAD YOUR FINISHED FILE!</strong></a></p>
                  <p align="center" class="style45"><a name="4x9PressKit"></a><img src="images/index_new/graybar.gif" width="442" height="25"></p>
                  <h2>Mini Pocket Folder (4&quot; x 9&quot;)</h2>
                  <h1><span class="style48"><span class="style35">with Free Business Card &amp; CD Slits</span></span><span class="style7"><br>
                      <span class="style28">Full Color (4-color front, back &amp; inside pockets), with 1 or 2 pockets</span></span></h1>
                  <p><strong>TECH SPECS: 4/0, 12pt (100# C1S Cover)</strong></p>
                  <table width="445" border="0" cellpadding="0" cellspacing="0" background="images/index_new/grid.gif" style="background-position:top; background-repeat:no-repeat;">
                    <tr>
                      <td width="80" height="25"><p align="right" class="style9">Quantity:</p></td>
                      <td width="88" height="25" class="style8"><p align="right">100</p></td>
                      <td width="88" height="25" class="style8"><p align="right">250</p></td>
                      <td width="88" height="25" class="style8"><p align="right">500</p></td>
                      <td width="88" height="25" class="style8"><p align="right">1000</p></td>
                      <td width="13" class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50"><div align="right" class="style9">SubTotal:<br>
                        Tax:<br>
                        Shipping:</div></td>
                      <td height="50" class="style8"><div align="right">$ 440.00<br>
                        N/A<br>
                        21.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 490.00<br>
                        N/A<br>
                        31.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 654.00<br>
                        N/A<br>
                        63.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 831.00<br>
                        N/A<br>
                        79.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="35"><div align="right" class="style9">TOTAL:</div></td>
                      <td height="35" class="style8"><div align="right">461.00</div></td>
                      <td height="35" class="style8"><div align="right">521.00</div></td>
                      <td height="35" class="style8"><div align="right">717.00</div></td>
                      <td height="35" class="style8"><div align="right">910.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                  </table>
                  <p align="center"><strong><a href="http://www.inkrockit.com/templates/PF_4x9.zip" class="style28"><span class="style38"><img src="images/new/download_zip.jpg" alt="Download Pocket Folder Template" width="37" height="37" border="0" /><br>
</span></a><span class="style38">DOWNLOAD YOUR FREE</span><a href="http://www.inkrockit.com/templates/PF_4x9.zip" class="style28"><span class="style38"><br>
</span><span class="style48">4&quot; X 9&quot;</span><span class="style38"> POCKET FOLDER TEMPLATE</span></a></strong></p>
                  <p align="center" class="style35"><a href="/upload"><strong><img src="/images/upload.jpg" alt="Upload Icon" width="37" height="37" border="0" /><br>
                    UPLOAD YOUR FINISHED FILE!</strong></a></p>
                  <p align="center" class="style37"><a name="Legal_Pocket_Folder"></a><img src="images/index_new/graybar.gif" width="442" height="25"></p>
                  <h2>Legal Size Pocket Folder (9&quot; x 14.5&quot;)
                  </h2>
                  <p align="center"><span class="style48"><span class="style35">with Free Business Card &amp; CD Slits</span></span><span class="style7"><br>
                    <span class="style28">Full Color (4-color front, back &amp; inside pockets), with 1 or 2 pockets</span></span></p>
                  <p align="center"><strong>TECH SPECS: 4/0, 12pt (100# C1S Cover)</strong></p>
                  <p align="center"><img src="images/IR_PF_Legal_9x14.5_OUT.jpg" width="382" height="330" alt="legal_folder"></p>
                  <table width="445" border="0" cellpadding="0" cellspacing="0" background="images/index_new/grid.gif" style="background-position:top; background-repeat:no-repeat;">
                    <tr>
                      <td width="80" height="25"><p align="right" class="style9">Quantity:</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">100</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">250</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">500</p>                        </td>
                      <td width="88" height="25" class="style8"><p align="right">1000</p>                        </td>
                      <td width="13" class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50"><div align="right" class="style9">SubTotal:<br>
                        Tax:<br>
                        Shipping:</div></td>
                      <td height="50" class="style8"><div align="right">$ 562.00<br>
                        N/A<br>
                        32.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 665.00<br>
                        N/A<br>
                        46.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 839.00<br>
                        N/A<br>
                        90.00</div></td>
                      <td height="50" class="style8"><div align="right">$ 1069.00<br>
                        N/A<br>
                        130.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="35"><div align="right" class="style9">TOTAL:</div></td>
                      <td height="35" class="style8"><div align="right">594.00</div></td>
                      <td height="35" class="style8"><div align="right">711.00</div></td>
                      <td height="35" class="style8"><div align="right">929.00</div></td>
                      <td height="35" class="style8"><div align="right">1199.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                  </table>
                  <p align="center" class="style38"><a href="/templates/PF_Legal_9x14.5.zip"><img src="images/new/download_zip.jpg" alt="Download Legal Size Pocket Folder" width="37" height="37" border="0"></a></p>
                  <h5 align="center" class="style38"><strong>DOWNLOAD YOUR FREE</strong><strong><a href="/templates/PF_Legal_9x14.5.zip" class="style38"> <br>
                    <span class="style48">LEGAL SIZE</span> POCKET </a><a href="http://www.inkrockit.com/PF_9x12.zip" class="style38">FOLDER TEMPLATE</a></strong></h5>
                  <p align="center" class="style35"><a href="/upload"><strong><img src="/images/upload.jpg" alt="Upload Icon" width="37" height="37" border="0" /><br>
                    UPLOAD YOUR FINISHED FILE!</strong></a></p>
                  <h1 class="style50"><a name="upgrades" id="upgrades"></a></h1>
                  <p align="center" class="style37"><a name="Catalog_Mailing_Envelope" id="Catalog_Mailing_Envelope"></a><img src="images/index_new/graybar.gif" alt="" width="442" height="25"></p>
                  <h2>Catalog Mailing Envelope  (10&quot; x 13&quot;) </h2>
                  <p align="center"><span class="style48"><span class="style35">with optional wax Peal &amp; Seal&trade; &amp; EZ Tear off Strip&trade;</span></span><span class="style7"><br>
                    <span class="style28">Full Color (4-color front, back)</span></span></p>
                  <p align="center"><strong>TECH SPECS: 4/0+1/s Aqueous Coat,  (80# uncoated text)</strong></p>
                  <p align="center"><img src="Mailing_Envelope.jpg" width="487" height="654" alt="legal_folder"></p>
                  <table width="445" border="0" cellpadding="0" cellspacing="0" background="images/index_new/grid.gif" style="background-position:top; background-repeat:no-repeat;">
                    <tr>
                      <td width="80" height="25"><p align="right" class="style9">Quantity:</p></td>
                      <td width="88" height="25" class="style8"><p align="right">100</p></td>
                      <td width="88" height="25" class="style8"><p align="right">250</p></td>
                      <td width="88" height="25" class="style8"><p align="right">500</p></td>
                      <td width="88" height="25" class="style8"><p align="right">1000</p></td>
                      <td width="13" class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="50"><div align="right" class="style9">SubTotal:<br>
                        Tax:<br>
                        Shipping:</div></td>
                      <td height="50" class="style8"><div align="right">$ 499.55<br>
                        N/A<br>
                        28.45</div></td>
                      <td height="50" class="style8"><div align="right">$ 539.67<br>
                        N/A<br>
                        37.33</div></td>
                      <td height="50" class="style8"><div align="right">$ 589.74<br>
                        N/A<br>
                        63.26</div></td>
                      <td height="50" class="style8"><div align="right">$ 707.02<br>
                        N/A<br>
                        85.98</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="35"><div align="right" class="style9">TOTAL:</div></td>
                      <td height="35" class="style8"><div align="right">528.00</div></td>
                      <td height="35" class="style8"><div align="right">577.00</div></td>
                      <td height="35" class="style8"><div align="right">653.00</div></td>
                      <td height="35" class="style8"><div align="right">793.00</div></td>
                      <td class="style8">&nbsp;</td>
                    </tr>
                  </table>
                  <p align="center" class="style38"><a href="/templates/PF_Legal_9x14.5.zip"><img src="images/new/download_zip.jpg" alt="Download Legal Size Pocket Folder" width="37" height="37" border="0"></a></p>
                  <h5 align="center" class="style38"><strong>DOWNLOAD YOUR FREE</strong><strong><a href="/templates/ENV_10x13.zip" class="style38"> <br>
                    <span class="style48">10&quot; x 13&quot;</span> CATALOG MAILING ENVELOPE </a><a href="http://www.inkrockit.com/PF_9x12.zip" class="style38">TEMPLATE</a></strong></h5>
                  <p align="center" class="style35"><a href="/upload"><strong><img src="/images/upload.jpg" alt="Upload Icon" width="37" height="37" border="0" /><br>
                    UPLOAD YOUR FINISHED FILE!</strong></a></p>
                  <h1 class="style50"><img src="images/index_new/graybar.gif" width="442" height="25"></h1>
                  <blockquote>
                    <h1 class="style50"><a href="#top"><img src="images/IR_logo1.jpg" alt="&lt;InkRockit Logo&gt;" width="180" height="150" border="0"></a></h1>
                    <h3 class="style38">Custom Printing &amp; Finishing Options </h3>
                  </blockquote></td>
                <td width="23" background="images/index_new/priceright.gif">&nbsp;&nbsp;&nbsp;
                  
                  </td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/index_new/pricebottom.gif" width="492" height="9"></td>
                </tr>
            </table>
              <ul>
                <li><span class="style38" name="custom_die_line"><a name="custom_die_line"></a>Custom Die Cut <u><br>
                  </u></span><span class="style65">* Just a one-time $180.00, up to a 19&quot; x 16&quot; flat sheet size. </span></li>
                <li><span class="style38">Foil Stamping</span><br>
                  <span class="style65">Add $170.00 for all listed quantities  [+$80.00 one-time mold charge  up to a 6&quot; area].  &nbsp;&nbsp;&nbsp;Add $110.00 for each additional 1000</span></li>
                <li><span class="style38">Embossing</span><br>
                  <span class="style65">Add $180.00 for all listed quantities [+$80.00 one-time mold charge  up to a 6&quot; area]. &nbsp;&nbsp;Add $95.00 for each additional 1000</span></li>
                <li><span class="style38">Matte Lamination <br>
                  </span><span class="style65">Add $170.00 for 100, 250 or 500, Add $210.00 for 1000.<br>
                    Add $190.00 for each additional 1000</span></li>
                <li><span class="style38">UV Coating</span><br>
                  <span class="style65">Add $100.00 for all listed quantities.<br>
                    Add $70.00 for each additional 1000</span> </li>
                <li><span class="style38">Spot UV</span><br>
                  <span class="style65">$225.00 for all listed quantities [+$80.00 one-time mold charge for up to a 6&quot; area].Add $90.00 for each additional 1000</span> </li>
                <li><span class="style38">PMS Colors</span><br>
                  <span class="style65">Add $250.00 for each additional PMS color for all listed quantitie (excluding metallic colors).<br>
                    Add $85.00 for each additional 1000</span></li>
                <li><span class="style66"><span class="style38">PMS Metallic Colors</span><br>
                  </span><span class="style65">Add $225.00 for each metallic PMS color for all listed quantities<br>
                    Add $85.00 for each additional 1000</span></li>
                <li><span class="style38">Process 4-color (CMYK) </span><br>
                  <span class="style65">Add $350.00 for process 4-color on the inside of the folder for all listed quantities. Add $95.00 for each additional 1000</span></li>
                <li><span class="style38">Velcro Tabs<u><br>
                  </u></span><span class="style65">Add $150.00 for a velcro tab (up to 1/4 inch in diameter) for all listed quantities.Add $95.00 for each additional 1000</span> </li>
              </ul>
              <blockquote>
                <p><span class="style14">** Projects begin upon receipt of: (1) a 50% deposit AND (2) either camera-ready art OR signed approval of proofs. Deposits may be made by VISA, MasterCard, American Express, approved company check or  PayPal&trade;.</span></p>
              </blockquote>
              <p class="style8">
                <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','32','height','32','title','Website_Intro','src','Ink_Intro_sound7.wmv','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','scale','noborder','movie','Ink_Intro_sound7.wmv' ); //end AC code
              </script>
                <noscript>
                  </noscript>
              </p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<blockquote>&nbsp;</blockquote>
<p>&nbsp;</p>
<p><script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
  </script>
  
  
  <map name="Map">
    <area shape="rect" coords="277,230,443,289" href="/webdesign.html" alt="Web site design samples">
  </map>
</p>
<script type="text/javascript">
_uacct = "UA-343319-1";
urchinTracker();
  </script>
  <!-- Start Quantcast tag -->
<script type="text/javascript">
_qoptions={
qacct:"p-2aiGOYYoOa7hg"
};
</script>
<script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>
<noscript>
<img src="http://pixel.quantserve.com/pixel/p-2aiGOYYoOa7hg.gif" style="display: none;" border="0" height="1" width="1" alt="Quantcast"/>
</noscript>
<!-- End Quantcast tag -->
</body>
</html>
