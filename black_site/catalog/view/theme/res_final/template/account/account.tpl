<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
        <?php if ($success) { ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>

        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul class="sys_menu">
                                    <li><a href="<?php echo $pref_lang ?>/my-account/"><?php echo $text_mycabinet_options; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/order-history/"><?php echo $text_mycabinet_zakaz; ?></li>
                                    <li><a href="<?php echo $pref_lang ?>/newsletter/"><?php echo $text_mycabinet_pidpr; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/logout/"><?php echo $text_mycabinet_exit; ?></a></li>
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
            
            <div class="content">
                <h2 class="account_welcome"><?php echo $firstname; ?><?php echo $text_mycabinet_hello; ?></h2>
                <table class="account_info">
                    <tr>
                        <td><?php echo $text_mycabinet_name; ?></td>
                        <td><?php echo $firstname; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $text_mycabinet_email; ?></td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $text_mycabinet_phone; ?></td>
                        <td><?php echo $telephone; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $text_mycabinet_addres; ?></td>
                        <td><?php echo $city; ?></td>
                    </tr>
                </table>
                <ul>
                    <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                    <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                    <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                </ul>
			</div>
        </div> 
    </div>
    
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>