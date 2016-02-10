<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section big_catalog">
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul>
                                    <?php foreach ($informations as $information) { ?>
                                        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo $pref_lang; ?>/news/"><?php echo $text_inf_news; ?></a></li>
<!--                                    <li><a href="<?php echo $pref_lang; ?>/brands/"><?php echo $text_inf_brends; ?></a></li>-->
                                    <li><a href="<?php echo $pref_lang; ?>/contact/" class="current"><?php echo $text_inf_contacts; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="three-fourth last">
            <div class="adress_line">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				<?php } ?>
            </div>
            <div class="title"><?php echo $heading_title; ?></div>

			<div class="content contact_info">
                    <?php echo $address2; ?>
            </div>

            <div class="small_title"><?php echo $text_map_locate; ?></div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2538.7617269911093!2d30.484120315804493!3d50.482779392915866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cde46aa207e5%3A0xffd46fddfa82ce66!2z0IbQvdGC0LXRgNC90LXRgi3RgdC60LvQsNC0INC10LvQtdC60YLRgNC40LrQuCBSRVMudWE!5e0!3m2!1sru!2sua!4v1447075806615" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            <br /><small><a href="https://www.google.com.ua/maps/place/%D0%86%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D1%81%D0%BA%D0%BB%D0%B0%D0%B4+%D0%B5%D0%BB%D0%B5%D0%BA%D1%82%D1%80%D0%B8%D0%BA%D0%B8+RES.ua/@50.4827794,30.4841203,17z/data=!3m1!4b1!4m2!3m1!1s0x40d4cde46aa207e5:0xffd46fddfa82ce66" target="_blank" rel="nofollow"><?php echo $text_map_big1; ?></a> <?php echo $text_map_big2; ?></small>

			<div class="content contact_info">
                    <?php echo $address3; ?>
            </div>

            <div class="small_title hideblock"><?php echo $text_inf_callback; ?></div>
            <form action="<?php echo $action; ?>" method="post" class="hideblock">
                <ul class="contact_form">
                    <li>
                        <div class="field_name"><?php echo $text_inf_fio; ?></div>
                        <?php if ($error_name) { ?>
                        <span class="error"><?php echo $error_name; ?></span>
                        <?php } ?>
                        <input type="text" name="name" class="form_input" value="<?php echo $name; ?>" />
                    </li>
                    <li>
                        <div class="field_name"><?php echo $text_inf_phone; ?></div>
                        <?php if ($error_phone) { ?>
                        <span class="error"><?php echo $error_phone; ?></span>
                        <?php } ?>
                        <input type="text" name="phone" class="form_input" value="<?php echo $phone; ?>" />
                    </li>
                    <li>
                        <div class="field_name"><?php echo $text_inf_mail; ?></div>
                        <?php if ($error_email) { ?>
                        <span class="error"><?php echo $error_email; ?></span>
                        <?php } ?>
                        <input type="text" name="email" class="form_input" value="<?php echo $email; ?>" />
                    </li>
                    <li>
                        <div class="field_name"><?php echo $text_inf_mes; ?></div>
                        <?php if ($error_enquiry) { ?>
                        <span class="error"><?php echo $error_enquiry; ?></span>
                        <?php } ?>
                        <textarea name="enquiry" class="form_input"><?php echo $enquiry; ?></textarea>
                    </li>
                    <li>
                        <div class="field_name"><?php echo $text_inf_result; ?></div>
                        <?php if ($error_captcha) { ?>
                        <span class="error"><?php echo $error_captcha; ?></span>
                        <?php } ?>
                        <img src="index.php?route=information/contact/captcha" alt="" /><br />
                        <input style="float: right; margin-right: 3px;" type="text" class="form_input" name="captcha" value="<?php echo $captcha; ?>" />
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="field_name"></div>
                        <input type="submit" class="form_input site_button" value="<?php echo $text_inf_btnsend; ?>"/>
                    </li>
                </ul>
            </form>

        </div>
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 

<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>