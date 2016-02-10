<!DOCTYPE html>
<?php if ($lang == "rus") {$p_lang = "ru";} else {$p_lang = "uk";}?>
<html dir="<?php echo $direction; ?>" lang="<?php echo $p_lang; ?>">
<head>
<meta charset="UTF-8" >
<meta name="viewport" content="initial-scale=1, maximum-scale=1" >
<meta name="viewport" content="width=device-width" >
<meta name="cypr-verification" content="a94d6f4a69bb12281a90ccef3aa2e0cb">
<?php $drct = $this->request->get['route'];
if ($drct=='product/search' || $drct=='account/account' || $drct=='account/address' || $drct=='account/edit' || $drct=='account/forgotten' || $drct=='account/login' || $drct=='account/logout' || $drct=='account/newsletter' || $drct=='account/order' || $drct=='account/password' || $drct=='account/return' || $drct=='account/reward' || $drct=='account/simpleaddress' || $drct=='account/simpleedit' || $drct=='account/simpleregister' || $drct=='account/success' || $drct=='account/transaction' || $drct=='account/voucher' || $drct=='account/wishlist') { ?>
<meta name="robots" content="noindex, nofollow, noarchive" />
<?php } ?>
<?php $title = str_replace('"','',$title);?>
<meta name="robots" content="noindex, nofollow, noarchive" />

	<?php if (!$seotitle25) { ?>
	<?php if ($current_page=='home' || $current_page=='category' || $current_page=='product' || $current_page=='info' || $current_page=='contact') { ?>
		<?php if ($current_page=='home') { ?>
			<title><?php echo $title; ?><?php echo $text_home_title_postadd;?></title>
		<?php } ?>
		<?php if ($current_page=='category') { ?>
			<title><?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php if($cat_stage5){echo $cat_stage5;}?><?php echo $title;?><?php if(isset($page)){echo $text_cat_title_postadd2str;}else{echo $text_cat_title_postadd;}?></title>
		<?php } ?>
		<?php if ($current_page=='product') { ?>
			<title><?php echo $title; ?><?php echo $text_prod_title_postadd;?><?php echo $sku; ?></title>
		<?php } ?>
		<?php if ($current_page=='info') { ?>
			<title><?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php echo $title; ?><?php echo $text_info_title_postadd;?></title>
		<?php } ?>
		<?php if ($current_page=='contact') { ?>
			<title><?php echo $text_contact_title_postadd;?></title>
		<?php } ?>
	<?php } else { ?>
	  <title><?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php echo $title; ?><?php echo $text_other_title_postadd;?></title>
	<?php } ?>
	<?php } else { ?><title><?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php echo $title;?><?php if(isset($page)){echo $text_other2_title_postadd;}?></title><?php } ?>

	<?php if (!$description) { ?>
	<?php if ($current_page=='home' || $current_page=='category' || $current_page=='product' || $current_page=='info' || $current_page=='contact') { ?>
		<?php if ($current_page=='home') { ?>
			<?php if ($description) { ?><meta name="description" content="<?php echo $description;?>" ><?php } ?>
		<?php } ?>
		<?php if ($current_page=='category') { ?>
			<meta name="description" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php echo $text_cat_descr_preadd;?><?php if($cat_stage5){echo $cat_stage5;}?><?php echo $title;?><?php echo $text_cat_descr_postadd;?>" >
		<?php } ?>
		<?php if ($current_page=='product') { ?>
			<meta name="description" content="<?php if($title2){echo $title2;}else{echo $title;}?> - <?php echo $sku; ?><?php echo $text_prod_descr_postadd;?>" >
		<?php } ?>
		<?php if ($current_page=='info') { ?>
			<meta name="description" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php if($title2){echo $title2;}else{echo $title;}?><?php echo $text_info_descr_postadd;?>" >
		<?php } ?>
		<?php if ($current_page=='contact') { ?>
			<meta name="description" content="<?php echo $text_contact_descr_postadd;?>" >
		<?php } ?>
	<?php } else { ?>
	  <?php if ($description) { ?><meta name="description" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php echo $description;?>" ><?php } ?>
	<?php } ?>
	<?php } else { ?><meta name="description" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).' '.$text_chaptu.' ';}?><?php if(isset($page)){if($title2){echo $title2;}else{echo $title;}}else{echo $description;}?><?php if(isset($page)){echo $text_other2_descr_postadd;}?>" ><?php } ?>

	<?php if (!$keywords) { ?>
	<?php if ($current_page=='home' || $current_page=='category' || $current_page=='product' || $current_page=='info' || $current_page=='contact') { ?>
		<?php if ($current_page=='home') { ?>
			<?php if ($keywords) { ?><meta name="keywords" content="<?php echo $keywords; ?>" ><?php } ?>
		<?php } ?>
		<?php if ($current_page=='category') { ?>
			<meta name="keywords" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).', '.$text_chapt.' ';}?><?php if($cat_stage5){echo $cat_stage5;}?><?php if($title2){echo $title2;}else{echo $title;}?><?php if(!(isset($page))){echo $text_cat_keyw_postadd;}?>" >
		<?php } ?>
		<?php if ($current_page=='product') { ?>
			<meta name="keywords" content="<?php if($title2){echo $title2;}else{echo $title;}?> - <?php echo $sku; ?><?php echo $text_prod_keyw_postadd;?>" >
		<?php } ?>
		<?php if ($current_page=='info') { ?>
			<meta name="keywords" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).', '.$text_chapt.' ';}?><?php if($title2){echo $title2;}else{echo $title;}?><?php echo $text_info_keyw_postadd;?>" >
		<?php } ?>
		<?php if ($current_page=='contact') { ?>
			<meta name="keywords" content="<?php echo $text_contact_keyw_postadd;?>" >
		<?php } ?>
	<?php } else { ?>
	  <?php if ($keywords) { ?><meta name="keywords" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).', '.$text_chapt.' ';}?><?php echo $keywords; ?>" ><?php } ?>
	<?php } ?>
	<?php } else { ?><meta name="keywords" content="<?php if(isset($page)){echo $text_page.' '.((int)$page).', '.$text_chapt.' ';}?><?php echo $keywords; ?>" ><?php } ?>


     <base href="<?php echo $base; ?>" />

<?php if (isset($_GET['page'])) { ?>
  <meta name="robots" content="noindex,follow">
<?php } ?>
<?php if ($current_page=='product') { ?>
  <meta name="robots" content="index,follow">
<?php } ?>

<?php if ($lang == "ru") { ?>
<link rel="alternate" href="<?php echo $uk_url; ?>" hreflang="uk-ua" />
<link rel="alternate" href="<?php echo $ru_url; ?>" hreflang="ru-ua" />
<?php } else { ?>
<link rel="alternate" href="<?php echo $ru_url; ?>" hreflang="ru-ua" />
<link rel="alternate" href="<?php echo $uk_url; ?>" hreflang="uk-ua" />
<?php } ?>
<meta name="title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" >
<meta name="author" content="RES.UA" >
<meta name="copyright" content="RES.UA" >
<meta name="rights" content="RES.UA" >
<link rel="author" href="https://plus.google.com/108188106710066256354" >
<link rel="publisher" href="https://plus.google.com/108188106710066256354" >
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $icon; ?>">
<link rel="image_src" href="<?php echo $logo; ?>" >
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" >
<?php if ($current_page=='product') { ?>
<meta property="og:type" content="product" >
<?php } else { ?>
<meta property="og:type" content="website" >
<?php } ?>
<meta property="og:url" content="<?php echo $og_url; ?>" >
<meta property="og:locale" content="uk_UA" >
<meta property="og:locale:alternate" content="ru_RU" >
<meta property="og:locale:alternate" content="en_US" >
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" >
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" >
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" >
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" >
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" >
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/style.css?02092014" >
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/responsive.css" >
<?php /* ?>
<!--<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" >
<?php } ?>-->
<?php */ ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<?php /* ?>
<!--<?php if ($current_page=='home' && $_COOKIE['showehint'] != '1') { ?>
	<script src="/catalog/view/javascript/enjoyhint/jquery-1.11.3.min.js"></script>
	<script src="/catalog/view/javascript/enjoyhint/enjoyhint.js"></script>
	<link rel="stylesheet" href="/catalog/view/javascript/enjoyhint/enjoyhint.css">
<?php } ?>-->
<?php */ ?>
<?php /* ?>
<!--<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>-->
<?php */ ?>
<?php if ($current_page=='category' || $this->request->get['route']=='product/search') { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.total-storage.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.selectbox-0.2.js"></script>
<script type="text/javascript" src="catalog/view/javascript/mf/iscroll.js?v1.3.0.0.0"></script>
<script type="text/javascript" src="catalog/view/javascript/mf/mega_filter.js?v1.3.0.0.0"></script>
<?php } ?>
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>

<!-- Flexslider JavaScript Files -->
<script type="text/javascript">
$(document).ready(function(){
  $(".sys_menu li a").each(function() {
    if ($(this).attr('href') == window.location) {
        $(this).addClass('current');
    }
  });
});
</script>
<!-- Flexslider JavaScript Files -->
<?php echo $google_analytics; ?>

<!-- Код Google Analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-56525581-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- Код Google Analytics-->

</head>

<body id="top">

<div id="contblock" style="display: none;">
<div id="contact" class="vcard">
   <h3 class="fn"><?php echo $text_header_namemag; ?></h3>
   <p>
		<a class="email" href="<?php echo $text_header_hmail; ?>"></a>
   </p>
   <div class="adr">
     <div class="street-address"><?php echo $text_header_adr; ?></div>
     <div class="locality"><?php echo $text_header_city; ?></div>
     <div class="region"><?php echo $text_header_state; ?></div>
   </div>
	<div class="tel">
		<span class="value"><?php echo $text_header_phone; ?></span>
    </div>
</div>
</div>


<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = "";$GLOBALS["langcur"]="uk";} else {$GLOBALS["langcur"]="rus";}?>
<div id="lng_det" class="lng_det" style="display:none;"><?php echo $pref_lang; ?></div>


<?php if ($current_page=='home') { ?>
    <script>
    var enjoyhint_instance = new EnjoyHint({});
    var enjoyhint_script_steps = [
  {
   <?php if ($lang == "ru") { ?>
  	'next #search-link' : 'Швидко знаходьте потрібний товар скориставшись пошуком.<br>Введіть що вас цікавить і натисніть ENTER',
  	'nextButton' : {className: "myNext", text: "Далі"},
  	'skipButton' : {className: "mySkip", text: "Пропустити"}
   <?php } else { ?>
  	'next #search-link' : 'Быстро находите нужный товар воспользовавшись поиском.<br>Введите что вас интересует и нажмите ENTER',
  	'nextButton' : {className: "myNext", text: "Далее"},
  	'skipButton' : {className: "mySkip", text: "Пропустить"}
   <?php } ?>
  },
  {
   <?php if ($lang == "ru") { ?>
  	'key .priccee' : "Для більш зручного пошуку можете скористатися<br> алфавітним каталогом",
  	'skipButton' : {className: "mySkip", text: "Я зрозумів"},
   <?php } else { ?>
  	'key .priccee' : "Для более удобного поиска можете воспользоваться<br> алфавитным каталогом",
  	'skipButton' : {className: "mySkip", text: "Я понял"},
   <?php } ?>
  	'keyCode' : 13
  },
  {
  	'click .btn' : 'This button allows you to switch between the search results'
  },
  {
  	'next .about' : 'Check the list of all the features available',
  	'shape': 'circle'
  },
  {
  	'next .contact' : 'Your feedback will be appreciated',
  	'shape': 'circle',
  	'radius': 70,
  	'showSkip' : false,
  	'nextButton' : {className: "myNext", text: "Got it!"}
  }

];

      function totop() {
        $('html, body').animate({ scrollTop: 0 }, 'fast');
        $('body').css({'overflow':'hidden'});
        $(document).on("touchmove",lockTouch);

      };
      function totopreset() {
        setCookie('showehint', '1');
      };

      if (getCookie('showehint') != '1') {
		enjoyhint_instance.set(enjoyhint_script_steps);
		setTimeout('totop()', 4800);
        setTimeout('enjoyhint_instance.runScript()', 5000);
      }

        // Установить куки
        function setCookie(name, value, options) {
          options = options || {};

          var expires = options.expires;

          if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
          }
          if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
          }

          value = encodeURIComponent(value);

          var updatedCookie = name + "=" + value;

          for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
              updatedCookie += "=" + propValue;
            }
          }

          document.cookie = updatedCookie;
        }

        // Получить куки
        function getCookie(name) {
          var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
          ));
          return matches ? decodeURIComponent(matches[1]) : undefined;
        }
    </script>
<?php } ?>

	<script type="text/javascript">
	$(document).ready(function(){
	 $('.spoiler_links').click(function(){
	  $(this).next('.spoiler_body').toggle('normal');
	  return false;
	 });
	});
	</script>

	<!--AddToCopy-->
	<script type="text/javascript">
		$(function(){
		$("#content-wrapper").addtocopy({htmlcopytxt: '<br><?php echo $text_header_addtocop; ?>: <a href="'+window.location.href+'">'+window.location.href+'</a>', minlen:35, addcopyfirst: false});
		});
	</script>
	<!--AddToCopy-->

<a href="<?php echo $pref_lang; ?>/compare-products/" class="compare <?php echo $compared_total ? '' : 'hide'; ?>"><?php echo $text_header_compare; ?></a>

<div class="overlayExit"></div>

<div class="message_sent"></div>

<div class="popup_call">
    <div class="popup_close"></div>
    <center><div style="padding: 16px 0;line-height: 114%;font-weight: 300;font-size: 18px;"><?php echo $text_header_callback; ?></div></center>

    <input type="text" name="name" value="" placeholder="<?php echo $text_header_callback_inpname; ?>" />
    <input type="text" name="phone" value="" placeholder="<?php echo $text_header_callback_inptel; ?>" />

    <a href="javascript:;"><?php echo $text_header_callback_callbtn; ?></a>
</div>

<div id="wrapper">

<!-- START HEADER -->
<div id="header-wrapper">
    <div class="top_nav_bg">
        <div class="section">
            <div id="primary-menu" class="top_nav">
          <ul class="menu navigation">
            <?php $i=0; ?>
            <?php foreach ($informations as $information) {?>
				<?php if ($i<=2) {?>
					<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
				<?php } ?>
				<?php global $link_spklient, $link_sppost, $title_spklient, $title_sppost  ?>
				<?php if ($i==3) { $link_spklient=$information['href']; $title_spklient=$information['title']; }?>
				<?php if ($i==4) { $link_sppost=$information['href']; $title_sppost=$information['title']; }?>
			<?php $i=$i+1; ?>	
            <?php } ?>
            <li><span style="cursor: default; line-height: 22px; padding-left: 10px; padding-right: 10px;"><?php echo $text_header_spivp; ?></span>
			  <ul>
				<li><a href="<?php echo $link_spklient;?>" title="z klientamu"><?php echo $title_spklient; ?></a></li>
				<li><a href="<?php echo $link_sppost;?>" title="z postachalnikami"><?php echo $title_sppost; ?></a></li>
			  </ul>
			</li>
            <li><a href="<?php echo $pref_lang; ?>/news/" class="current"><?php echo $text_header_news; ?></a></li>
            <li><a href="<?php echo $contact; ?>"><?php echo $text_header_contact; ?></a></li>
            <li style="padding:0 5px 0 20px;line-height: 23px;"><?php echo $language; ?></li>
          </ul><!--END UL-->
        </div><!--END PRIMARY MENU-->
            <div class="for_shop">
                <div class="cart">
                    <div class="cart_content">
                        <?php echo $cart; ?>
                    </div>
						<input type="button" id="confirm2" rel="nofollow" onclick="window.location.href='<?php echo $pref_lang; ?>/index.php?route=checkout/simplecheckout'" class="checkout<?php echo $cart_products ? '' : ' hide'; ?>" value="<?php echo $text_header_cartzak; ?>"/>
                </div>
                <?php if($logged){ ?>
                    <div class="logout">
                        <?php echo $text_logged; ?>
                    </div>
                <?php } else { ?>
                    <div class="login">
                        <a><?php echo $text_header_login; ?></a>

                        <div class="login_field">
                            <form action="<?php echo $pref_lang; ?>/login/" method="post" enctype="multipart/form-data">
                                <div><?php echo $text_header_mail; ?></div>
                                <input name="mail" type="text"/>
                                <div><?php echo $text_header_password; ?></div>
                                <input name="pass" type="password"/>
                                <a href="<?php echo $pref_lang; ?>/index.php?route=account/simpleregister" rel="nofollow"><?php echo $text_header_register; ?></a>
                                <a href="<?php echo $pref_lang; ?>/forgot-password/" rel="nofollow"><?php echo $text_header_repas; ?></a>
                                <input type="submit" class="site_button" value="<?php echo $text_header_login; ?>"/>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<div class="header clear">
    <div id="logo" style="background: url('<?php echo $logo ?>') 0 0 no-repeat;">
      <a href="<?php echo $pref_lang; ?>/"><img src="<?php echo $logo ?>" alt="RES.ua" /></a>
    </div><!--END LOGO-->

<?php if ($current_page=='nottttgjkhjlxjf') { ?> <!-- 404 -->
<div style="width:553px; display: inline-block; float: left;"> </div>
<?php } else { ?>
    <div class="search">
        <input type="text" id="search-link" placeholder="<?php echo $text_header_searchph; ?>"/>
        <input type="button" id="search-me" value="<?php echo $text_header_searchbtn; ?>" class="button"/>
        <div class="search_example">
			<!--<script type="text/javascript">
			document.write("<noindex>Наприклад: <a style='cursor:pointer' id='search-example'>лампа</a></noindex>");
			</script>-->
        </div>
    </div>
<?php } ?>

    <div class="phone">
        <div class="main_phone">
		<div class="mph1">
			<span><?php echo $text_header_teleph1; ?></span><br>
			<span style="text-align: left;"><!--<span id="istatclientcode">генерируем...</span>--></span>
		</div>
		<div class="mph2">
			<span><?php echo $text_header_teleph2; ?></span><br>
			<span style="font-size:12px;"><?php echo $text_header_telephopt; ?></span>
		</div>
		<a href="javascript:;" style="font-size:11px;" class="order_call">
		<div class="circlle2 hvr-ripple-out" data-title="<?php echo $text_header_zakcall; ?>">
			<span class="lt-xbutton-bttn-flur"></span>
			<img class="" draggable="false" alt="<?php echo $text_header_zakcall; ?>" title="" src="/image/data/callcentr.png">
		</div>
		</a>
        </div>
        <?php /* ?>
        <div style="text-align:center;height:20px;"><img style="vertical-align:middle;" src="/image/ico/kalendar.png" draggable="false" width="20px" alt="weekend"><a style="color:red;line-height:20px;" href="<?php echo $pref_lang; ?>/grafik-raboty-v-prazdnichnye-dni"><?php echo $text_header_weekend; ?></a></div>
        <?php */ ?>
        <?php /* ?><div>
            <!--<a id="phone_field" style="height: 25px; padding: 3px 7px; margin-left:-7px; ">Всі телефони</a>
            <div class="phone_field" style="">
                <p>(044) 531-74-00</p>
                <p>(067) 431-74-00 </p>
            </div>-->
        </div><?php */ ?>
    </div>
</div><!--END HEADER-->

</div><!--END HEADER-WRAPPER-->
<?php $active=''; ?>
<div class="nav_wrapper">
    <div class="section nav">
        <?php if ($categories) { ?>
            <table>
                <tr>
                    <?php foreach ($categories as $category) { ?>
                        <td>
                            <div>
                                <?php if ($category['active']) { ?>
                                    <a href="<?php echo $category['href']; ?>" class="current"><?php echo $category['name']; ?></a>
                                <?php } else { ?>

                                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                                <?php } ?>

                                <?php if ($category['children']) { ?>
                                    <?php for ($i = 0; $i < count($category['children']);) { ?>
                                        <ul style="margin-left: 0 !important;">
                                            <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                            <?php for (; $i < $j; $i++) { ?>
                                                <?php if (isset($category['children'][$i])) { ?>
                                                    <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    <?php } ?>
                        <td>
                            <div class="priccee">
                                    <a href="<?php echo $pref_lang; ?>/abcat.html"><?php echo $text_header_akcii; ?></a>
                            </div>
                        </td>
                </tr>
            </table>
        <?php } ?>
    </div>
</div>
<?php if ($current_page=='home') { ?>
<a href="<?php echo $pref_lang; ?>/bezkoshtovna-dostavka-produktsiji-">
	<div class="head-info"></div>
</a>
<?php } ?>
<!-- END HEADER -->