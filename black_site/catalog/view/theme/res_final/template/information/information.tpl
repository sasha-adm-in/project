<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section big_catalog">

       <?php if ($_SERVER['REQUEST_URI']!= '/' . $pref_lang . '/abcat.html' && $_SERVER['REQUEST_URI']!= '/abcat.html' &&
                 $_SERVER['REQUEST_URI']!= '/' . $pref_lang . '/price.html' && $_SERVER['REQUEST_URI']!= '/price.html') { ?>
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul class="sys_menu">
                                    <?php foreach ($informations as $information) { ?>
                                        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo $pref_lang; ?>/news/"><?php echo $text_inf_news; ?></a></li>
<!--                                    <li><a href="<?php echo $pref_lang; ?>/brands/"><?php echo $text_inf_brends; ?></a></li>-->
                                    <li><a href="<?php echo $pref_lang; ?>/contact/"><?php echo $text_inf_contacts; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php } ?>

       <?php if ($_SERVER['REQUEST_URI']== '/' . $pref_lang . '/abcat.html' || $_SERVER['REQUEST_URI']== '/abcat.html' ||
                 $_SERVER['REQUEST_URI']== '/' . $pref_lang . '/price.html' || $_SERVER['REQUEST_URI']== '/price.html') { ?>
        <div class="three-fourth last" style="width:100%;">
       <?php } else {?>
        <div class="three-fourth last">
       <?php } ?>
	   
            <div class="adress_line">
                 <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				 <?php } ?>
            </div>
            <div class="title"><h1><?php echo $heading_title; ?></h1></div>
            <div class="content">
				  <?php echo $description; ?>
			</div>



               <?php if ($_SERVER['REQUEST_URI']== '/' . $pref_lang . '/abcat.html' || $_SERVER['REQUEST_URI']== '/abcat.html') { ?>
                <script type="text/javascript">
                $(document).ready(function(){
                    $('a[href^="<?php echo $_SERVER['REQUEST_URI'] ?>#"]').bind('click.smoothscroll',function (e) {
                        e.preventDefault();
                        var target = this.hash,
                        $target = $(target);
                        $('html, body').stop().animate({
                            'scrollTop': $target.offset().top - 50
                        }, 900, 'swing', function () {
                            window.location.hash = target;
                        });
                    });
                });
                </script>
                <script type="text/javascript">
                $(document).ready(function(){
                    $(window).scroll(function(){
                        var bo = $("body").scrollTop();
                    if ( bo > 200 ) {$("#alfukaz").addClass('alfukaz2');} else {$("#alfukaz").removeClass('alfukaz2');}
                    })
                })
                </script>

                    <div id="alfukaz" class="alfukaz">
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#a">А</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#b">Б</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#v">В</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#g">Г</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#d">Д</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#e">Е</a>
                    <?php if ($pref_lang != "rus") { ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#ee">Є</a>
                    <?php } ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#j">Ж</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#z">З</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#i">И</a>
                    <?php if ($pref_lang != "rus") { ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#ii">І</a>
                    <?php } ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#k">К</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#l">Л</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#m">М</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#n">Н</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#o">О</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#p">П</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#r">Р</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#s">С</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#t">Т</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#u">У</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#f">Ф</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#h">Х</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#c">Ц</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#ch">Ч</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#sh">Ш</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#sch">Щ</a>
                    <?php if ($pref_lang == "rus") { ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#eee">Э</a>
                    <?php } ?>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#yu">Ю</a>
                        <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#ya">Я</a>
                    </div>
                    <?php echo $content_top; ?>
                    <div style="clear:both;margin-bottom:20px;"></div>

			   <?php } ?>



               <?php if ($_SERVER['REQUEST_URI']== '/' . $pref_lang . '/price.html' || $_SERVER['REQUEST_URI']== '/price.html') { ?>

                    <?php echo $column_right; ?>

			   <?php } else {?>

       <?php if ($_SERVER['REQUEST_URI']!= '/' . $pref_lang . '/abcat.html' && $_SERVER['REQUEST_URI']!= '/abcat.html' &&
                 $_SERVER['REQUEST_URI']!= '/' . $pref_lang . '/price.html' && $_SERVER['REQUEST_URI']!= '/price.html') { ?>

			<div class="mistake"><?php echo $text_inf_soo; ?></div>

	   <?php } ?>

			   <?php } ?>

        </div>
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER-->
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>