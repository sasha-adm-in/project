<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul class="sys_menu">
                                    <li><a href="<?php echo $pref_lang ?>/my-account/"><?php echo $text_simpad_options; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/order-history/"><?php echo $text_simpad_zakaz; ?></li>
                                    <li><a href="<?php echo $pref_lang ?>/newsletter/"><?php echo $text_simpad_pidpr; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/logout/"><?php echo $text_simpad_exit; ?></a></li>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="simpleaddress">
                    <div class="simpleregister">
                        <?php
                            $first_field = reset($address_fields); 
                            $first_field_header = !empty($first_field) && $first_field['type'] == 'header'; 
                            $i = 0;
                        ?>
                        <?php if ($first_field_header) { ?>
                            <?php echo $first_field['tag_open'] ?><?php echo $first_field['label'] ?><?php echo $first_field['tag_close'] ?>
                        <?php } ?>
                            <div class="simpleregister-block-content">
                            <table class="simplecheckout-customer">
                                <?php foreach ($address_fields as $field) { ?>
                                    <?php if ($field['type'] == 'hidden') { continue; } ?>
                                    <?php $i++ ?>
                                    <?php if ($field['type'] == 'header') { ?>
                                    <?php if ($i == 1) { ?>
                                        <?php continue; ?>
                                    <?php } else { ?>
                                    </table>
                                    </div>
                                    <?php echo $field['tag_open'] ?><?php echo $field['label'] ?><?php echo $field['tag_close'] ?>
                                    <div class="simpleregister-block-content">
                                    <table class="simplecheckout-customer">
                                    <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td class="simplecheckout-customer-left">
                                                <?php if ($field['required']) { ?>
                                                    <span class="simplecheckout-required">*</span>
                                                <?php } ?>
                                                <?php echo $field['label'] ?>
                                            </td>
                                            <td class="simplecheckout-customer-right">
                                                <?php echo $simple->html_field($field) ?>
                                                <?php if (!empty($field['error']) && $simple_edit_address) { ?>
                                                    <span class="simplecheckout-error-text"><?php echo $field['error']; ?></span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?> 
                                <tr><td><input type="hidden" name="default" value="1" <?php echo $default ? ' checked="checked"' : '' ?> /></td></tr>              
                            </table>        
                            <?php foreach ($address_fields as $field) { ?>
                                <?php if ($field['type'] != 'hidden') { continue; } ?>
                                <?php echo $simple->html_field($field) ?>
                            <?php } ?>
                            <input type="hidden" name="simple_edit_address" id="simple_edit_address" value="1">
                        </div>
                    </div>
                    <div class="simpleregister-button-block buttons">
                        <div class="simpleregister-button-right">
                            <a href="javascript:;" onclick="$('#simpleaddress').submit();" class="button-link"><?php echo $text_simpad_save; ?></a>
                        </div>
                    </div>
                </form>
			</div>
        </div> 
    </div>
    
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>