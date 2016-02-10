<div class="footer">
    <div class="section">

        <div class="col-1">
           <div class="raw1">
           <div style="float:left;width: 100%;">
            <center><span style="color:#5f8f00; font-size:16px; "><?php echo $text_footer_zvjaz; ?></span>
            <center><span style="font-size:16px;"><?php echo $text_footer_tel1; ?></span></center>
            <center><span style="font-size:12px;"><?php echo $text_footer_mnogok; ?></span></center>
            <center><span style="font-size:16px;"><?php echo $text_footer_tel2; ?></span></center>
           </div>
           </div>
           <div class="raw1" style="clear:both;">
            <center><span style="font-size:14px;"><?php echo $text_footer_graf; ?></span></center>
            <center><span style="font-size:14px;"><?php echo $text_footer_grafm; ?></span></center>
           </div>
        </div>

        <div class="col-2">
           <div class="raw2">
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/delivery.html"><?php echo $text_footer_dost; ?></a></span><br>
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/warranty.html"><?php echo $text_footer_garser; ?></a></span><br>
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/about.html"><?php echo $text_footer_about; ?></a></span><br>
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/news/"><?php echo $text_footer_nwsstat; ?></a></span>
           </div>
           <div class="raw2" style="clear:both;">

           </div>
        </div>

        <div class="col-3">
           <div class="raw3">
            <span style="color:#5f8f00; font-size:14px; "><?php echo $text_footer_spivp; ?></span><br>
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/spіvpracja-z-klіеntami.html"><?php echo $text_footer_spivpkli; ?></a></span><br>
            <span style="font-size:14px;"><a href="<?php echo $pref_lang; ?>/spіvpracja-z-postachalnikami.html"><?php echo $text_footer_spivppost; ?></a></span>
           </div>
           <div class="raw3" style="clear:both;">
           </div>
        </div>

        <div class="col-4">
           <div class="raw4">
            <span style="font-size:14px;"><?php echo $text_footer_socslidk; ?></span><br>
            <div id="s5_social_wrap">
		<div id="s5_youtube" onclick="window.open('https://www.youtube.com/channel/UCH82iPNLGs1fK07T0kRjVsw')"></div>
		<div id="s5_google" onclick="window.open('https://plus.google.com/u/2/b/100099297495087366027/+ResUaElectro')"></div>
		<div id="s5_facebook" onclick="window.open('https://www.facebook.com/groups/1593330017548565/')"></div>
		<div id="s5_vk" onclick="window.open('https://vk.com/res_ua')"></div>
		<div id="s5_twitter" style="display:none;" onclick="window.open('#')"></div>
		<div id="s5_rss" style="display:none;" onclick="window.open('#')"></div>
		<div style="clear:both; height:0px"></div>	
	    </div>
           </div>
           <div class="raw4" style="display:none;">
            <span style="font-size:14px;"><?php echo $text_footer_doopl; ?></span><br>
             <div>
              <img class="" draggable="false" alt="visa-mc" title="visa-mc" src="/image/data/visa-mc.gif">
			 </div>
           </div>
		   

		<div class="subscribe" style="float: right;width:310px;">
		  <div class="box-contentt" style="text-align: center;">
			<div class="col-head" style="margin-bottom:4px;text-align:right;"><?php echo $text_footer_podpiska; ?></div>
		   <div id="frm_subscribee">
			  <form name="subscribe" id="subscribe" style="float:right;">
					   <div class="button" onclick="email_subscribe()" style="float:right;cursor:pointer;height:23px;line-height:22px;border-radius:0 5px 5px 0;">
						 <span><?php echo $text_footer_subscribe; ?></span>
					   </div>
					   <div style="margin-bottom:4px;float:right;">
						 <input type="text" value="" placeholder="Email" name="subscribe_email" id="subscribe_email2" style="width:105px;padding:3px;text-align:center;border:1px solid #87B928;border-radius:5px 0 0 5px;">
					   </div>
					   <div>
						 <div id="subscribe_result"></div>
					   </div>
			  </form>
		   </div>
		  </div>
			<script language="javascript">
				function email_subscribe(){
					$.ajax({
							type: 'post',
							url: 'index.php?route=module/newslettersubscribe/subscribe',
							dataType: 'html',
							data:$("#subscribe").serialize(),
							success: function (html) {
								eval(html);
							}}); 
				}
				function email_unsubscribe(){
					$.ajax({
							type: 'post',
							url: 'index.php?route=module/newslettersubscribe/unsubscribe',
							dataType: 'html',
							data:$("#subscribe").serialize(),
							success: function (html) {
								eval(html);
							}}); 
				}
					  
				// $('.fancybox_sub').fancybox({
					// width: 180,
					// height: 180,
					// autoDimensions: false
				// });
			</script>
		</div>

		   
		   
           <div class="raw4" style="clear:both;margin-top:0px;">
            <span style="font-size:12px;"><?php echo $text_footer_copyright; ?></span><br>
            <span style="font-size:12px;">© 2014-<?php echo (date("Y ")); ?> <?php echo $text_footer_podpis; ?></span>
           </div>

        </div>   

    </div>
</div>



</div><!-- END WRAPPER --> 

<!-- START FOOTER -->

<a href="#" id="back-top">Top</a>

<!-- css -->
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" >
<link rel="stylesheet" href="catalog/view/theme/res_final/stylesheet/flexslider.css" type="text/css" media="screen" >
<link type="text/css" rel="stylesheet" href="catalog/view/theme/res_final/stylesheet/search_ajax.css" >
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/thumb-scroller.css" >

<!--<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" >
<?php } ?>-->

<?php if ($current_page=='info') { ?>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/category-menu/category-menu.css" media="screen" >
<?php } ?>

<?php if ($current_page=='category' || $this->request->get['route']=='product/search') { ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/filterpro.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/jquery.selectbox.css" media="screen" >

<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/jquery.selectbox.css" media="screen" >
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/mf/style.css?v1.3.0.0.0" media="screen" >
<link rel="stylesheet" type="text/css" href="catalog/view/theme/res_final/stylesheet/mf/style-2.css?v1.3.0.0.0" media="screen" >
<?php } ?>

<?php if ($current_page=='product') { ?>
<link rel="stylesheet" href="/catalog/view/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="/catalog/view/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="/catalog/view/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<?php } ?>

<!-- css -->

<!-- js -->

<!--<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>-->

<?php /* ?>
<!--<?php if ($current_page!='home') { ?>
    <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<?php } ?>
<?php if ($current_page=='home' && $_COOKIE['showehint'] == '1') { ?>
    <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<?php } ?>-->
<?php */ ?>
    <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>

<script type="text/javascript" src="catalog/view/javascript/jquery.thumb-scroller.min.js"></script>

<?php if ($current_page!='product') { ?>
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="/catalog/view/javascript/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/catalog/view/javascript/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/catalog/view/javascript/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="/catalog/view/javascript/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/catalog/view/javascript/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="/catalog/view/javascript/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <link rel="stylesheet" href="/catalog/view/javascript/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="/catalog/view/javascript/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$(".fancybox").fancybox();
    	});
    </script>
<?php } ?>
<?php if ($current_page=='product') { ?>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="/catalog/view/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/catalog/view/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/catalog/view/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/catalog/view/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<?php } ?>

<?php if ($current_page=='category' || $current_page=='search') { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.deserialize.js"></script>
<?php } ?>



<script type="text/javascript" src="catalog/view/javascript/search_ajax.js"></script>

<script type="text/javascript" src="catalog/view/javascript/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/custom.js"></script>
<script type="text/javascript" src="catalog/view/javascript/header.js"></script>
<script type="text/javascript" src="catalog/view/javascript/my.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery.flexslider.js"></script>

<!-- js -->

	<!--CallMe-->
	<script type="text/javascript" src="/callme/js/callme.js"></script>
	<!--CallMe-->
	<!--BackForm-->
		<script type="text/javascript" src="/backform/js/js-form.js"></script>
		<link rel="stylesheet" href="/backform/css/style.css" />
	<!--BackForm-->
	<!--AddToCopy-->
		<script type="text/javascript" src="catalog/view/javascript/addtocopy.js"></script>
	<!--AddToCopy-->
	<!--SOO-->
		<script type="text/javascript" src="catalog/view/javascript/soo.js"></script>
		<link rel="stylesheet" type="text/css" href="catalog/view/javascript/soo.css" >
	<!--SOO-->
	<!--<script language="Javascript" type="text/javascript" src="/catalog/model/counter/js/jquery-1.4.1.js"></script>-->
	<script language="Javascript" type="text/javascript" src="/catalog/model/counter/js/jquery.lwtCountdown-0.9.5.js"></script>
	<script language="Javascript" type="text/javascript" src="/catalog/model/counter/js/misc.js"></script>
	<link rel="Stylesheet" type="text/css" href="/catalog/model/counter/style/main.css">

    <?php /* ?>
	<!--OTZUVU PREDLOJENIJA-->
<!--		<script type="text/javascript">
			var reformalOptions = {
				project_id: 900993,
				tab_orientation: "bottom-right",
				tab_indent: "10px",
				tab_bg_color: "#aedb44",
				tab_border_color: "#FFFFFF",
				tab_image_url: "/image/tab.png",
				tab_border_width: 1
			};

			(function func() {
				var script = document.createElement('script');
				script.type = 'text/javascript'; script.async = true;
				script.src = '/image/reformal.js';
				document.getElementsByTagName('head')[0].appendChild(script);
			})();
		</script><noscript><a href=""><img src="" alt=""/></a><a href=""><?php echo $text_footer_vidg; ?></a></noscript>-->

		<!--<script type="text/javascript">
			function func() {
				$("a#reformal_tab").click();
			}
			setTimeout(func, 1000);
		</script>
	<!--OTZUVU PREDLOJENIJA-->
    <?php */ ?>

	<!--POPAP-->
		<script type="text/javascript" src="/catalog/view/javascript/popup.js"></script>
	<!--POPAP-->

<!-- Код тега ремаркетинга Google -->
<!-- Код тега ремаркетинга Google -->

<!-- Start SiteHeart code -->
<!-- End SiteHeart code -->

<!-- Calltraking -->
<!-- Calltraking -->

<!-- Yandex.Metrika counter -->
<!-- /Yandex.Metrika counter -->

<div style="visibility: hidden;">
	<!--LiveInternet counter-->
    <!--/LiveInternet-->
</div>

<? if ( (date("m")=='12' && date("d")>=17) || (date("m")=='01' && date("d")<=4) ) { ?>
<!-- SNOW NEW YEAR -->
<script type="text/javascript">
sitePath = "/";
sflakesMax = 64;
sflakesMaxActive = 64;
svMaxX = 3;
svMaxY = 3;
ssnowStick = 1;
sfollowMouse = 1;
</script>
<script type="text/javascript" src="newyear/snow/snow.js"></script>
<!-- SNOW NEW YEAR -->
<? } ?>

</body>
</html>