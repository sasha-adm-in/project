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
                                    <li><a href="<?php echo $pref_lang ?>/my-account/"><?php echo $text_simped_options; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/order-history/"><?php echo $text_simped_zakaz; ?></li>
                                    <li><a href="<?php echo $pref_lang ?>/newsletter/"><?php echo $text_simped_pidpr; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/logout/"><?php echo $text_simped_exit; ?></a></li>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="simpleedit">
                    <div class="simpleregister">
                        <?php
                            $first_field = reset($customer_fields); 
                            $first_field_header = !empty($first_field) && $first_field['type'] == 'header'; 
                            $i = 0;
                        ?>
                        <?php if ($first_field_header) { ?>
                            <?php echo $first_field['tag_open'] ?><?php echo $first_field['label'] ?><?php echo $first_field['tag_close'] ?>
                        <?php } ?>
                            <div class="simpleregister-block-content">
                            <table class="simplecheckout-customer">
                                <?php foreach ($customer_fields as $field) { ?>
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
                                                <?php if (!empty($field['error']) && $simple_edit_account) { ?>
                                                    <span class="simplecheckout-error-text"><?php echo $field['error']; ?></span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($field['id'] == 'main_email') { ?>
                                        <?php if ($simple_account_view_customer_type) { ?>
                                        <tr>
                                            <td class="simplecheckout-customer-left">
                                                <span class="simplecheckout-required">*</span>
                                                <?php echo $entry_customer_type ?>
                                            </td>
                                            <td class="simplecheckout-customer-right">
                                                <?php if ($simple_type_of_selection_of_group == 'select') { ?>
                                                <select name="customer_group_id" onchange="$('#simpleedit').submit();">
                                                    <?php foreach ($customer_groups as $id => $name) { ?>
                                                    <option value="<?php echo $id ?>" <?php echo $id == $customer_group_id ? 'selected="selected"' : '' ?>><?php echo $name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php } else { ?>
                                                    <?php foreach ($customer_groups as $id => $name) { ?>
                                                    <label><input type="radio" name="customer_group_id" onchange="$('#simpleedit').submit();" value="<?php echo $id ?>" <?php echo $id == $customer_group_id ? 'checked="checked"' : '' ?>><?php echo $name ?></label><br>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                
                            </table>        
                            <?php foreach ($customer_fields as $field) { ?>
                                <?php if ($field['type'] != 'hidden') { continue; } ?>
                                <?php echo $simple->html_field($field) ?>
                            <?php } ?>
                            <input type="hidden" name="simple_edit_account" id="simple_edit_account" value="">
                        </div>
                    </div>
                    <div class="simpleregister-button-block buttons">
                        
                        <div class="simpleregister-button-right">
                            <a href="javascript:;" onclick="$('#simple_edit_account').val(1);$('#simpleedit').submit();" class="button-link"><span><?php echo $text_simped_save; ?></span></a>
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