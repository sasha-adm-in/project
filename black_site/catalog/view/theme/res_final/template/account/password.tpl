<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section big_catalog">
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul class="sys_menu">
                                    <li><a href="<?php echo $pref_lang ?>/my-account/"><?php echo $text_pas_options; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/order-history/"><?php echo $text_pas_zakaz; ?></li>
                                    <li><a href="<?php echo $pref_lang ?>/newsletter/"><?php echo $text_pas_pidpr; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/logout/"><?php echo $text_pas_exit; ?></a></li>
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
            <div class="content">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <ul class="contact_form">
                        <li>
                            <div class="field_name"><?php echo $text_pas_passw; ?></div>
                            <?php if ($error_password) { ?>
                                <span class="error"><?php echo $error_password; ?></span>
                            <?php } ?>
                            <input type="password" name="password" value="<?php echo $password; ?>" />
                        </li>
                        <li>
                            <div class="field_name"><?php echo $text_pas_confirm; ?></div>
                            <?php if ($error_confirm) { ?>
                                <span class="error"><?php echo $error_confirm; ?></span>
                            <?php } ?>
                            <input type="password" name="confirm" value="<?php echo $confirm; ?>" />
                        </li>
                        <li>
                            <div class="field_name"></div>
                            <input type="submit" style="margin-left: 0;" class="form_input site_button" value="<?php echo $text_pas_save; ?>" />
                        </li>
                    </ul>
                </form>
			</div>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $footer; ?>