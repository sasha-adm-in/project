<?php echo $header; ?>

<div id="content-wrapper">
<!--	<div id="backst"></div>-->
    <div class="section for_slider">
    	<?php echo $content_top; ?>
		<?php echo $column_left; ?>
    </div>	
    <div class="section catalog home_cats clear">
		<div id="notification"></div>
		<div id="notification2"></div>

        <div class="cele">
            <div class="cele_c1">
            <div><?php echo $text_zavl1; ?></div>
            </div>
            <div class="cele_c2 fade">
            <div><?php echo $text_zavl2; ?></div>
            </div>
            <div class="cele_c2 fade">
            <div><?php echo $text_zavl3; ?></div>
            </div>
            <div class="cele_c2 fade">
            <div><?php echo $text_zavl4; ?></div>
            </div>
            <div class="cele_c3 fade">
            <div><?php echo $text_zavl5; ?></div>
            </div>
        </div>
        <div style="clear:both;"></div>

        <style type="text/css">
        div.fade {display: none;}
        </style>

        <script type="text/javascript">
        $(document).ready(function(){
         $.fn.fade_div = function (ops) {
          var $elem = this;
          var res = $.extend({ delay: 800, speed: 300 }, ops);
          for (var i=0, pause=0, l=$elem.length; i<l; i++, pause+=res.delay) {
           $elem.eq(i).delay(pause).fadeIn(res.speed);
          }
          return $elem;
         };
         $('div.fade').fade_div();
        });
        </script>

        <div class="title clear"><?php echo $text_home_title; ?></div>
        <?php $imgcnt=1; ?>
        <?php foreach ($categories_home as $category) { ?>
            <div class="one-third cat_home rtw<?php echo $imgcnt; ?>">
                <div class="one-third cat_img">
				<?php $imgcnt=$imgcnt+1; ?>
                    <a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" id="cat<?php echo $imgcnt; ?>" alt="<?php echo $category['name']; ?>"/></a>
                </div>
                <div class="two-third last sub_catalog">
                    <a href="<?php echo $category['href']; ?>" class="title"><?php echo $category['name']; ?></a>
                    <?php foreach ($category['children'] as $child) { ?>

                        <a href="<?php echo $child['href']; ?>" ><?php echo $child['name']; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        
    </div>

    <script type="text/javascript">
        $('.cat_home:nth-of-type(3n + 2)').addClass('last');
    </script>


<div class="section viewed clear">
<div class="title clear"><?php echo $text_home_sertif; ?></div>
<div class="wrap-wrap">
<div class="inside2">
<div id="ts2" class="thumb-scroller ts-horizontal" style="padding-left: 0px; padding-right: 0px;"><div class="ts-header"><div class="ts-play-button ts-pause"></div></div>
<div class="ts-container sert"><ul class="ts-list" style="width: 200%; left: 0px;">

<li class="ts-slide ts-inside ts-border-box" style="width: 12.5%; padding-left: 4px; padding-right: 4px;"><div class="ts-wrapper" style="border-width: 8px; height: 385px;">
<div class="one-fourth last ts-content">
<div class="prod_container sert">
<div class="one_prod">
  <a class="fancybox" href="http://res.ua/image/data/images/articles/sertifikat_3.jpg" rel="group">
    <img alt="sklad-res" draggable="false" src="http://res.ua/image/data/images/articles/sertifikat_3.jpg" style="width:100%;">
  </a>
</div>
</div>
</div>
</div></li>

<li class="ts-slide ts-inside ts-border-box" style="width: 12.5%; padding-left: 4px; padding-right: 4px;"><div class="ts-wrapper" style="border-width: 8px; height: 385px;">
<div class="one-fourth last ts-content">
<div class="prod_container sert">
<div class="one_prod">
  <a class="fancybox" href="http://res.ua/image/data/images/articles/sertifikat_5.jpg" rel="group">
    <img alt="sklad-res" draggable="false" src="http://res.ua/image/data/images/articles/sertifikat_5.jpg" style="width:100%;">
  </a>
</div>
</div>
</div>
</div></li>

<li class="ts-slide ts-inside ts-border-box" style="width: 12.5%; padding-left: 4px; padding-right: 4px;"><div class="ts-wrapper" style="border-width: 8px; height: 385px;">
<div class="one-fourth last ts-content">
<div class="prod_container sert">
<div class="one_prod">
  <a class="fancybox" href="http://res.ua/image/data/images/articles/sertifikat_4.jpg" rel="group">
    <img alt="sklad-res" draggable="false" src="http://res.ua/image/data/images/articles/sertifikat_4.jpg" style="width:100%;">
  </a>
</div>
</div>
</div>
</div></li>

<li class="ts-slide ts-inside ts-border-box" style="width: 12.5%; padding-left: 4px; padding-right: 4px;"><div class="ts-wrapper" style="border-width: 8px; height: 385px;">
<div class="one-fourth last ts-content">
<div class="prod_container sert">
<div class="one_prod">
  <a class="fancybox" href="http://res.ua/image/data/images/articles/sertifikat_2.jpg" rel="group">
    <img alt="sklad-res" draggable="false" src="http://res.ua/image/data/images/articles/sertifikat_2.jpg" style="width:100%;">
  </a>
</div>
</div>
</div>
</div></li>

</ul>
</div>
<div class="title clear"> </div>
</div></div></div>
</div>
    <div class="sertt" style="text-align:center;"><a href="<?php echo $pref_lang; ?>/about.html"><?php echo $text_home_sertifmore; ?></a></div>


<?php echo $content_bottom; ?>

</div><!--END CONTENT-WRAPPER--> 

<!-- END HOME -->

<?php echo $footer; ?>