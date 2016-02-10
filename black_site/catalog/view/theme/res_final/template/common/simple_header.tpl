<!DOCTYPE html>
<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; } ?>
<div id="lng_det" class="lng_det" style="display:none;"><?php echo $pref_lang; ?></div>

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
<meta name="viewport" content="width=device-width" />
<meta name="robots" content="noindex, nofollow, noarchive" />
<title><?php echo $heading_title; ?></title>
<base href="/" />

<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/style.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/responsive.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/custom.js"></script>
<script type="text/javascript" src="catalog/view/javascript/header.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/image/data/ico.png">
<link href="/image/data/ico.png" rel="icon" >


<script type="text/javascript" src="catalog/view/javascript/simple.js"></script>
<script type="text/javascript" src="catalog/view/javascript/simplecheckout.js"></script>
<script type="text/javascript" src="catalog/view/javascript/simpleaddress.js"></script>


</head>

<body id="top">

<!--<a href="compare-products/" class="compare <?php // echo $compared_total ? '' : 'hide'; ?>">Список порівняння</a>-->

<div class="overlayExit"></div>

<div class="message_sent"></div>

<div class="popup_call">
  <?php if ($pref_lang == "rus") { ?>
    <div class="popup_close"></div>
    <h3>Заказ обратного звонка</h3>
    <input type="text" name="name" value="" placeholder="Введите Ваше имя" />
    <input type="text" name="phone" value="" placeholder="Введите Ваш телефон" />
    <a href="javascript:;">Перезвоните мне</a>
  <?php } else { ?>
    <div class="popup_close"></div>
    <h3>Замовлення зворотнього дзвінка</h3>
    <input type="text" name="name" value="" placeholder="Введіть Ваше ім'я" />
    <input type="text" name="phone" value="" placeholder="Введіть Ваш телефон" />
    <a href="javascript:;">Передзвоніть мені</a>
  <?php } ?>
</div>

<div id="wrapper">	


<div>
<!-- START HEADER -->
<div id="header-wrapper" class="cart_header">

    <div class="top_nav_bg">
        <div class="section">
            <div id="primary-menu" class="top_nav">
          <ul class="menu navigation">           
            <!--<?php foreach ($informations as $information) { ?>
                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
            <?php } ?>-->
          </ul><!--END UL-->
        </div><!--END PRIMARY MENU-->  
            
            <div class="for_shop">
                <?php if($logged){ ?>  
                    <div class="logout">
                        <?php echo $text_logged; ?>
                    </div>
                <?php } else { ?>

                <?php } ?>
            </div>
        </div>
    </div>
	
	<div class="header clear" style="height: 105px;">
		
	<?php if ($pref_lang == "rus") { ?>
		<div id="logo" style="background: url('/image/data/images/logo_rus.jpg') 0 0 no-repeat;">	
			<a href="<?php echo $pref_lang; ?>/"><img src="/image/data/images/logo_rus.jpg" alt="" /></a>		
		</div><!--END LOGO-->
	<?php } else { ?>
		<div id="logo" style="background: url('/image/data/images/logo.jpg') 0 0 no-repeat;">	
			<a href="<?php echo $pref_lang; ?>/"><img src="/image/data/images/logo.jpg" alt="" /></a>		
		</div><!--END LOGO-->
	<?php } ?>
    <div class="phone">
        <div class="main_phone">
		<div class="mph1">
			<span>(067) 431-74-00</span><br>
			<!--<span style="text-align: left;"></span>-->
		</div>
		<div class="mph2">
			<span>(044) 531-74-00</span><br>
			<?php if ($pref_lang == "rus") { ?>
				<span style="font-size:12px;">(многоканальный)</span>
			<?php } else { ?>
				<span style="font-size:12px;">(багатоканальний)</span>
			<?php } ?>
		</div>
		<a href="javascript:;" style="font-size:11px;" class="order_call">
	<?php if ($pref_lang == "rus") { ?>
		<div class="circlle2 hvr-ripple-out" data-title="Заказать звонок">
	<?php } else { ?>
		<div class="circlle2 hvr-ripple-out" data-title="Замовити дзвінок">
	<?php } ?>
			<span class="lt-xbutton-bttn-flur"></span>
			<img class="" draggable="false" width="" alt="call" title="" src="/image/data/callcentr.png">
		</div>
		</a>
        </div>
        <div>
            <!--<a id="phone_field" style="height: 25px; padding: 3px 7px; margin-left:-7px; ">Всі телефони</a>
            <div class="phone_field" style="">
                <p>(044) 531-74-00</p>
                <p>(067) 431-74-00 </p>
            </div>-->
        </div>
    </div>
		
	</div><!--END HEADER-->	
	
</div><!--END HEADER-WRAPPER-->	
<div class="nav_wrapper title_cart">
    <div><span><?php echo $heading_title; ?></span></div>
</div>	

<!-- END HEADER -->
