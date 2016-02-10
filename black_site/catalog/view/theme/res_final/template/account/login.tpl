<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
        <?php if ($success) { ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>
        
        <?php if ($error_warning) { ?>
            <div class="warning"><?php echo $error_warning; ?></div>
        <?php } ?>
        
        <div class="one">
            <div class="adress_line">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				<?php } ?>
            </div>
            <div class="title"><?php echo $heading_title; ?></div>
            
            <div id="cart_tabs" class="account_form">
                <form action="<?php echo $action; ?>" method="post">
                    <ul>
                        <li class="clear">
                            <div><?php echo $entry_email; ?></div>
                            <div><input type="text" name="mail" value="<?php echo $email; ?>" /></div>
                        </li>
                        <li class="clear">
                            <div><?php echo $entry_password; ?></div>
                            <div><input type="password" name="pass" value="<?php echo $password; ?>" /></div>
                        </li>
                        <?php if ($redirect) { ?>
                            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                        <?php } ?>
                        <li class="clear">
                            <div></div>
                            <div><div style="float: left; width:111px; margin-top: -8px;"><a style="float: none;line-height: 23px;" href="<?php echo $pref_lang ?>/index.php?route=account/simpleregister"><?php echo $text_login_register; ?></a><br /><a style="float: none;line-height: 23px;" href="<?php echo $pref_lang ?>/forgot-password/"><?php echo $text_login_regenpas; ?></a></div>
							<input type="submit" value="<?php echo $text_login_loginbtn; ?>" class="site_button"/></div>
                        </li>
                    </ul>
                </form>
            </div>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 

<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>