<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<div class="title"><?php echo $text_cart_contactd; ?></div>
<div class="tab1" id="cart_tabs">
<?php if ($this->customer->isLogged() ) { ?>
<!--<a class="tab1">Я постійний покупець</a>-->
<?php } else { ?>
<a href="javascript:;" class="tab1"><?php echo $text_cart_newp; ?></a>
<?php }  ?>
<?php if ($this->customer->isLogged() ) {} else { ?><a href="javascript:" class="tab2"><?php echo $text_cart_dcpok; ?></a> <?php } ?>
<div class="tab1">
<div id="new_cust" class="tab1_3" style="display:block;">
    <p class="person-type">
    <?php if (!$this->customer->isLogged()) { ?>
	<!--<label class="clear">
        <input type="radio" id="without" name="customer_group_id2" value="1"   />
        <span class="tab1_1">Оформити замовлення без реєстрації</span>
    </label>-->
    <?php } ?>
	<label class="clear">
        <input type="radio" id="with_fiz"  name="customer_group_id2"  value="2"  />
		<label></label>
        <span class="tab1_1"><?php echo $text_cart_fizl; ?></span>
    </label>
	<label class="clear">
        <input type="radio" id="with_uri"  name="customer_group_id2"  value="3"  />
		<label></label>
        <span class="tab1_1"><?php echo $text_cart_url; ?></span>
    </label>
	<!-- 
	<?php foreach ($customer_groups as $id => $name) { ?>
	<label class="clear">
       <input type="radio" onchange="simplecheckout_reload('payment_changed')" name="customer_group_id" value="<?php echo $id ?>" <?php echo $id == $customer_group_id ? 'checked="checked"' : '' ?>>
       <span class="tab1_1"><?php echo $name ?></span>
    </label>
    <?php } ?>
	-->
   
	</p>
                          
<div class="tab1_1" style="display:block;">
<div class="simplecheckout-block-heading" style="display:none;"> <?php echo $simple_customer_hide_if_logged ? 'style="display:none"' : '' ?>
    <?php echo $text_checkout_customer ?>
    <?php if ($simple_customer_view_login) { ?>
    <span class="simplecheckout-block-heading-button">
        <a href="<?php echo $default_login_link ?>" <?php if (!$is_mobile) { ?>onclick="simple_login_open();return false;"<?php } ?> id="simplecheckout_customer_login"><?php echo $text_checkout_customer_login ?></a>
    </span>
    <?php } ?>
</div>  
<div class="simplecheckout-block-content" <?php echo $simple_customer_hide_if_logged ? 'style="display:none"' : '' ?>>
    <!--<?php //if ($simple_customer_registered) { ?>
        <div class="success" id="customer_registered" style="text-align:left;"><?php //echo $simple_customer_registered ?></div>
    <?php //} ?>
    <?php //if ($text_you_will_be_registered) { ?>
        <div class="you-will-be-registered"><?php //echo $text_you_will_be_registered ?></div>
    <?php //} ?>-->
    <?php if ($simple_customer_view_address_select && !empty($addresses)) { ?>
        <div class="simplecheckout-customer-address">
        <span><?php echo $text_select_address ?>:</span>&nbsp;
        <select name='customer_address_id' id="customer_address_id" reload='address_changed'>
            <option value="0" <?php echo $customer_address_id == 0 ? 'selected="selected"' : '' ?>><?php echo $text_add_new ?></option>
            <?php foreach($addresses as $address) { ?>
                <option value="<?php echo $address['address_id'] ?>" <?php echo $customer_address_id == $address['address_id'] ? 'selected="selected"' : '' ?>><?php echo $address['firstname']; ?> <?php echo !empty($address['lastname']) ? ' '.$address['lastname'] : ''; ?><?php echo !empty($address['address_1']) ? ', '.$address['address_1'] : ''; ?><?php echo !empty($address['city']) ? ', '.$address['city'] : ''; ?></option>
            <?php } ?>
        </select>
        </div>
    <?php } ?>
    <input type="hidden" name="<?php echo Simple::SET_CHECKOUT_CUSTOMER ?>[address_id]" id="customer_address_id" value="<?php echo $customer_address_id ?>" />
    <?php $split_previous = false; ?>
    <?php $user_choice = false; ?>
    <div class="tab1_1">
    
        <?php $email_field_exists = false; ?>
        <?php $i = 0; ?>
        <?php $geo_selector_used = false; ?>
        <?php foreach ($checkout_customer_fields as $field) { ?>
            <?php if ($i == 0 && !$customer_logged && $simple_customer_action_register == Simple::REGISTER_USER_CHOICE) { ?>

                <tr style="display:none;">
                    <td class="simplecheckout-customer-left" style="display:none;">
                      
                    </td>
                    <td class="simplecheckout-customer-right" style="display:none;">
                      <label style="display:none;"><input style="display:none;" type="radio" id="yes_reg" name="register" onchange="simplecheckout_reload('payment_changed')" value="1" <?php echo $register == 1 ? 'checked="checked"' : ''; ?>  /><?php echo $text_yes ?></label>&nbsp;
                      <label style="display:none;"><input style="display:none;" type="radio" id="no_reg" name="register" onchange="simplecheckout_reload('payment_changed')" value="0" <?php echo $register == 0 ? 'checked="checked"' : ''; ?> /><?php echo $text_no ?></label>
                    </td>
                </tr>

                <?php $user_choice = true; ?>
            <?php $i++ ?>
            <?php } ?>
            <?php if ($field['type'] == 'hidden') { ?>
                <?php continue; ?>
            <?php } elseif ($field['type'] == 'header') { ?>
            <tr class="simple_table_row" <?php echo !empty($field['place']) ? 'place="'.$field['place'].'"' : '' ?>>
                <td colspan="2" <?php echo $user_choice && $split_previous ? 'class="simple-header-right"' : ''; ?>>
                    <?php echo $field['tag_open'] ?><?php echo $field['label'] ?><?php echo $field['tag_close'] ?>
                </td>
            </tr>
            <?php } elseif ($field['type'] == 'split') { ?>
                </table>
                <table class="<?php echo $simple_customer_two_column ? 'simplecheckout-customer-two-column-right' : 'simplecheckout-customer-one-column' ?>">
                <?php $split_previous = true; ?>
            <?php } else { ?>
                <?php if ((($user_choice && $i == 1) || (!$user_choice && $i == 0)) && $simple_customer_view_customer_type) { ?>
                    <li style="display:none;"> <!-- CUSTOMER TYPE HERE -->
                       <div>
                            
                            <?php echo $entry_customer_type ?>
                        </div>
                         <div>
                            <?php if ($simple_type_of_selection_of_group == 'select') { ?>
                            <select name="customer_group_id" reload="group_changed">
                                <?php foreach ($customer_groups as $id => $name) { ?>
                                <option value="<?php echo $id ?>" <?php echo $id == $customer_group_id ? 'selected="selected"' : '' ?>><?php echo $name ?></option>
                                <?php } ?>
                            </select>
                            <?php } else { ?>
                                <?php foreach ($customer_groups as $id => $name) { ?>
                                <label><input type="radio" id="custmomer<?php echo $id ?>" onchange="simplecheckout_reload('payment_changed')" name="customer_group_id" value="<?php echo $id ?>" <?php echo $id == $customer_group_id ? 'checked="checked"' : '' ?>><?php echo $name ?></label><br>
                                <?php } ?>
                            <?php } ?>
                        </div>	
                    </li>	<!-- CUSTOMER TYPE HERE -->
					<script>
					$('input1').change(function(){
						alert('ok');
					});
					</script>
					<ul>
                    <?php $i++ ?>
                    <?php $split_previous = false; ?>
                <?php } ?>
                <?php if ($field['id'] == 'main_email') { ?>
                    <?php if (!$customer_logged) { ?>
                        <?php if (!$simple_customer_action_register &&  !$simple_customer_view_email && !$simple_customer_view_customer_type) { continue; } ?>
                        <?php $split_previous = false; ?>
                        <?php if (!($simple_customer_view_email == Simple::EMAIL_NOT_SHOW && ($simple_customer_action_register == Simple::REGISTER_NO || ($simple_customer_action_register == Simple::REGISTER_USER_CHOICE && !$register)))) { ?>
                        <?php $email_field_exists = true; ?>
                        <li class="clear" id="labemail">
                            <div>
                                <?php if ($field['required']) { ?>
                                   <!-- <span class="simplecheckout-required" <?php echo ($simple_customer_view_email == Simple::EMAIL_SHOW_AND_NOT_REQUIRED && ($simple_customer_action_register == Simple::REGISTER_NO || ($simple_customer_action_register == Simple::REGISTER_USER_CHOICE && !$register))) ? ' style="display:none"' : '' ?>>*</span> -->
                                <?php } ?>
                                <?php echo $field['label'] ?>
                            </div>
                            <div>
                                <?php echo $simple->html_field($field) ?>
                                <?php if (!empty($field['error']) && $simple_show_errors) { ?>
                                    <span class="simplecheckout-error-text"><?php echo $field['error']; ?></span>
                                <?php } ?>
								<span id="validEmail" style="padding-left:16px;"></span>
                            </div>
                        </li>
                        <?php if ($simple_customer_view_email_confirm) { ?>
                        <li class="clear">
                            <div>
                                <?php if ($field['required']) { ?>
                                    <span class="simplecheckout-required" <?php echo ($simple_customer_view_email == Simple::EMAIL_SHOW_AND_NOT_REQUIRED && ($simple_customer_action_register == Simple::REGISTER_NO || ($simple_customer_action_register == Simple::REGISTER_USER_CHOICE && !$register))) ? ' style="display:none"' : '' ?>>*</span>
                                <?php } ?>
                                <?php echo $entry_email_confirm ?>
                            </div>
                            <div>
                                <input name="email_confirm" id="email_confirm" type="text" value="<?php echo $email_confirm ?>">
                                <span class="simplecheckout-error-text" id="email_confirm_error" <?php if (!($email_confirm_error && $simple_show_errors)) { ?>style="display:none;"<?php } ?>><?php echo $error_email_confirm; ?></span>
                            </div>
                        </li>
                        <?php } ?>
                        <?php if ($simple_customer_action_register == Simple::REGISTER_YES || ($simple_customer_action_register == Simple::REGISTER_USER_CHOICE && $register)) { ?>
                            <li class="clear" id="password_row" <?php echo $simple_customer_generate_password ? ' style="display:none;"' : '' ?> <?php echo $simple_customer_generate_password ? 'autogenerate="1"' : '' ?>>
                                <div>
                                    <!--<span class="simplecheckout-required">*</span>-->
                                    <?php echo $entry_password ?>
                                </div>
                                <div>
                                    <input <?php echo !empty($error_password) ? 'class="simplecheckout-red-border"' : '' ?> type="password" name="password" value="<?php echo $password ?>">
                                    <?php if (!empty($error_password) && $simple_show_errors) { ?>
                                        <span class="simplecheckout-error-text"><?php echo $error_password; ?></span>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php if ($simple_customer_view_password_confirm) { ?>
                            <li class="clear" style="margin-top:15px;" id="confirm_password_row" <?php echo $simple_customer_generate_password ? ' style="display:none;"' : '' ?> <?php echo $simple_customer_generate_password ? 'autogenerate="1"' : '' ?>>
                                <div class="simplecheckout-customer-left">
                                   <!-- <span class="simplecheckout-required">*</span> -->
                                    <?php echo $entry_password_confirm ?>
                                </div>
                                <div>
                                    <input <?php echo !empty($error_password_confirm) ? 'class="simplecheckout-red-border"' : '' ?> type="password" name="password_confirm" value="<?php echo $password_confirm ?>">
                                    <?php if (!empty($error_password_confirm) && $simple_show_errors) { ?>
                                        <span class="simplecheckout-error-text"><?php echo $error_password_confirm; ?></span>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($customer_logged) { continue; } ?>
                <?php } else { ?>
                    <li id="field<?php $i=$i+1; echo $i ?>" class="clear simple_table_row <?php echo !empty($field['selector']) ? ' simple-geo-selector-customer' : '' ?>" <?php echo !empty($field['place']) ? 'place="'.$field['place'].'"' : '' ?><?php echo !empty($field['selector']) ? ' style="display:none;"' : '' ?>>
                        <div>
                            <?php if ($field['required']) { ?>
                                <!-- <span class="simplecheckout-required">*</span> -->
                            <?php } ?>
                            <?php echo $field['label'] ?>
                        </div>
                        <div>
                            <?php echo $simple->html_field($field) ?>
                            <?php if (!empty($field['error']) && $simple_show_errors) { ?>
                                <span class="simplecheckout-error-text"><?php echo $field['error']; ?></span>
                            <?php } ?>
                        </div>
                    </li>
                    <?php $split_previous = false; ?>
                    <?php $geo_selector_used = $geo_selector_used || !empty($field['selector']); ?>
                <?php } ?>
                <?php $i++; ?>
            <?php } ?>
        <?php } ?>
        <?php if ($geo_selector_used) { ?>
            <tr id="simple_geo_selector_customer">
                <td colspan="2" style="text-align:center;">
                    <a onclick="simplecheckout_show_selector('customer');"><?php echo $text_show_selector ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if ($simple_customer_action_subscribe == Simple::SUBSCRIBE_USER_CHOICE && $email_field_exists) { ?>
            <tr id="subscribe_row"<?php echo $simple_customer_action_register == Simple::REGISTER_USER_CHOICE && !$register && !$simple_customer_view_email ? ' style="display:none;"' : '' ?>>
                <td class="simplecheckout-customer-left">
                   <?php echo $entry_newsletter; ?>
                </td>
                <td class="simplecheckout-customer-right">
                  <label><input type="radio" name="subscribe" value="1" <?php echo $subscribe == 1 ? 'checked="checked"' : ''; ?> /><?php echo $text_yes ?></label>&nbsp;
                  <label><input type="radio" name="subscribe" value="0" <?php echo $subscribe == 0 ? 'checked="checked"' : ''; ?> /><?php echo $text_no ?></label>
                </td>
            </tr>
        <?php } ?>
   
    <?php foreach ($checkout_customer_fields as $field) { ?>
        <?php if ($field['type'] == 'hidden') { ?>
        <?php echo $simple->html_field($field) ?>
        <?php } ?>
    <?php } ?>
    </div>
</div>

<?php if ($simple_show_shipping_address) { ?>
<div class="simplecheckout-customer-same-address" style="display:none;">
<?php if ($simple_show_shipping_address_same_show) { ?>
    <label><input type="checkbox" name="shipping_address_same" id="shipping_address_same" value="1" <?php if ($shipping_address_same) { ?>checked="checked"<?php } ?> reload="address_same">&nbsp;<?php echo $entry_address_same ?></label>
<?php } ?>
</div>
<?php if (!$shipping_address_same) { ?>
<div class="simplecheckout-block-heading simplecheckout-shipping-address" <?php echo $simple_address_hide_if_logged ? 'style="display:none"' : '' ?>>
    <?php echo $text_checkout_shipping_address ?>
</div>  
<div class="simplecheckout-block-content simplecheckout-shipping-address" <?php echo $simple_address_hide_if_logged ? 'style="display:none"' : '' ?>>
    <?php if ($simple_shipping_view_address_select && !empty($addresses)) { ?>
        <div class="simplecheckout-customer-address">
        <span><?php echo $text_select_address ?>:</span>&nbsp;
        <select name='shipping_address_id' id="shipping_address_id" reload='address_changed'>
            <option value="0" <?php echo $shipping_address_id == 0 ? 'selected="selected"' : '' ?>><?php echo $text_add_new ?></option>
            <?php foreach($addresses as $address) { ?>
                <option value="<?php echo $address['address_id'] ?>" <?php echo $shipping_address_id == $address['address_id'] ? 'selected="selected"' : '' ?>><?php echo $address['firstname']; ?> <?php echo !empty($address['lastname']) ? ' '.$address['lastname'] : ''; ?><?php echo !empty($address['address_1']) ? ', '.$address['address_1'] : ''; ?><?php echo !empty($address['city']) ? ', '.$address['city'] : ''; ?></option>
            <?php } ?>
        </select>
        </div>
    <?php } ?>
    <input type="hidden" name="<?php echo Simple::SET_CHECKOUT_ADDRESS ?>[address_id]" id="shipping_address_id" value="<?php echo $shipping_address_id ?>" />
    <div class="tab1_1">
    <table class="<?php echo $simple_customer_two_column ? 'simplecheckout-customer-two-column-left' : 'simplecheckout-customer-one-column' ?>">
        <?php $geo_selector_used = false; ?>
        <?php foreach ($checkout_address_fields as $field) { ?>
            <?php if ($field['type'] == 'hidden') { ?>
                <?php continue; ?>
            <?php } elseif ($field['type'] == 'header') { ?>
            <tr class="simple_table_row" <?php echo !empty($field['place']) ? 'place="'.$field['place'].'"' : '' ?>>
                <td colspan="2">
                    <?php echo $field['tag_open'] ?><?php echo $field['label'] ?><?php echo $field['tag_close'] ?>
                </td>
            </tr>
            <?php } elseif ($field['type'] == 'split') { ?>
                </table>
                <table class="<?php echo $simple_customer_two_column ? 'simplecheckout-customer-two-column-right' : 'simplecheckout-customer-one-column' ?>">
            <?php } else { ?>
            <tr class="simple_table_row <?php echo !empty($field['selector']) ? ' simple-geo-selector-address' : '' ?>" <?php echo !empty($field['place']) ? 'place="'.$field['place'].'"' : '' ?><?php echo !empty($field['selector']) ? ' style="display:none;"' : '' ?>>
                <td class="simplecheckout-customer-left">
                    <?php if ($field['required']) { ?>
                        <!-- <span class="simplecheckout-required">*</span> -->
                    <?php } ?>
                    <?php echo $field['label'] ?>
                </td>
                <td class="simplecheckout-customer-right">
                    <?php echo $simple->html_field($field) ?>
                    <?php if (!empty($field['error']) && $simple_show_errors) { ?>
                        <span class="simplecheckout-error-text"><?php echo $field['error']; ?></span>
                    <?php } ?>
                </td>
            </tr>
            <?php $geo_selector_used = $geo_selector_used || !empty($field['selector']); ?>
            <?php } ?>
        <?php } ?>
        <?php if ($geo_selector_used) { ?>
            <tr id="simple_geo_selector_address">
                <td colspan="2" style="text-align:center;">
                    <a onclick="simplecheckout_show_selector('address');"><?php echo $text_show_selector ?></a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php foreach ($checkout_address_fields as $field) { ?>
        <?php if ($field['type'] == 'hidden') { ?>
        <?php echo $simple->html_field($field) ?>
        <?php } ?>
    <?php } ?>
    </div>
	
</div> <!-- END TAB 1 -->
<?php } ?>
<?php } ?>
<?php if ($simple_debug) print_r($customer); ?>
<?php if ($simple_debug) print_r($comment); ?>
<li class="clear" >

    <!--<div><input type="button" value="Підтвердити замовлення" class="site_button confirm_order"/></div>-->
</li>
</div> <!-- END TAB 1 -->
</div>
</div>

</ul>

<?php if ($this->customer->isLogged() ) {} else { ?>
<div class="tab2">
    <ul>
        <form action="<?php echo $pref_lang ?>/login/" method="post" enctype="multipart/form-data">
            <li class="clear">
        		<div><?php echo $text_cart_email; ?></div>
        		
                <div><input type="text" name="mail" /></div>
            </li>                
            <li class="clear">
                <div><?php echo $text_cart_passw; ?></div>
                <div><input type="password" name="pass" /></div>
            </li>
            <li class="clear">
                <div><input type="submit" value="<?php echo $text_cart_login; ?>" class="site_button"/></div>
                <div><a href="<?php echo $pref_lang ?>/forgot-password/"><?php echo $text_cart_passwrem; ?></a></div>
            </li>
        </form>
    </ul>
</div>
<?php } ?>
</div>

<script>

$(document).ready(function() {  
 $("#checkout_customer_main_email").keyup(function(){
    
    var email = $("#checkout_customer_main_email").val();
    var email2 = $("#checkout_customer_main_email");
  
    if(email != 0) {
		if(isValidEmailAddress(email)) {
			$("#validEmail").css({		"background": "url('/catalog/view/theme/res_final/image/success.png') no-repeat"		});
			document.getElementById('validEmail').innerHTML = 'Ok';
			email2.removeClass('error_input');
		} else {
			$("#validEmail").css({			"background": "url('/catalog/view/theme/res_final/image/warning.png') no-repeat"			});
			document.getElementById('validEmail').innerHTML = '<?php echo $text_cart_mailworn; ?>';
			email2.addClass('error_input');
			var element = document.getElementById("errorlb");
			element.parentNode.removeChild(element);
		}
    } else {
		$("#validEmail").css({		"background": "none"		}); 
		document.getElementById('validEmail').innerHTML = '';
		email2.removeClass('error_input');
    }
  
    });
	
 $("#checkout_customer_main_firstname").keyup(function(){
    var frstnm = $("#checkout_customer_main_firstname");
	frstnm.removeClass('error_input');
	var element = document.getElementById("errorlb");
	element.parentNode.removeChild(element);
    });
 $("#checkout_customer_main_telephone").keyup(function(){
    var tel = $("#checkout_customer_main_telephone");
	tel.removeClass('error_input');
	var element = document.getElementById("errorlb");
	element.parentNode.removeChild(element);
    });
  
});
  
    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
    }
	
	
$(document).on('click', '.confirm_order', function() {
    $('.simplecheckout-error-text').remove();

    var fio = $('#checkout_customer_main_firstname');
    if (!fio.val() && document.getElementById('with_uri').checked != true) {
        fio.after('<span id="errorlb" class="simplecheckout-error-text"><?php echo $text_cart_worning; ?><br></span>');
		fio.addClass('error_input');
        return;   
    } else {fio.removeClass('error_input');}

    var phone_num = $('#checkout_customer_main_telephone');
    if (!phone_num.val() || phone_num.val() && phone_num.val().search(/\+380\d{9}/) == -1) {
        phone_num.after('<span id="errorlb" class="simplecheckout-error-text"><?php echo $text_cart_telworn; ?><br></span>');
		phone_num.addClass('error_input');
        return;   
    } else {phone_num.removeClass('error_input');}

  if (document.getElementById('checkout_customer_main_email')) {
    var mail = $('#checkout_customer_main_email');
    if (!mail.val() && document.getElementById('with_uri').checked != true ) {
        mail.after('<span id="errorlb" class="simplecheckout-error-text"><?php echo $text_cart_worning; ?><br></span>');
		mail.addClass('error_input');
        return;   
    } else {mail.removeClass('error_input');}

	if ( document.getElementById('with_uri').checked != true ) {
    var email = $("#checkout_customer_main_email").val();
    var email2 = $("#checkout_customer_main_email");
		if(email != 0) {
			if(isValidEmailAddress(email)) {
				$("#validEmail").css({	"background": "url('/catalog/view/theme/res_final/image/success.png') no-repeat"    });
				document.getElementById('validEmail').innerHTML = 'Ok';
				email2.removeClass('error_input');
			} else {
				$("#validEmail").css({	"background": "url('/catalog/view/theme/res_final/image/warning.png') no-repeat"    });
				document.getElementById('validEmail').innerHTML = '<?php echo $text_cart_mailworn; ?>';
				email2.addClass('error_input');
				return;   
			}
		} else {
			$("#validEmail").css({	"background": "none"    }); 
			document.getElementById('validEmail').innerHTML = '';
			email2.removeClass('error_input');
		}
	}
  }
	
    if (parseInt(<?php echo $delivery_calculated; ?>) == 0 && document.getElementById('with_uri').checked != true) {
        if ($('select[name="region"]').val() == 0) {
            $('select[name="region"]').addClass('error_input');
        }
        
        if ($('select[name="city"]').val() == 0) {
            $('select[name="city"]').addClass('error_input');
        }
        
        if ($('select[name="warenhouse"]').val() == 0) {
            $('select[name="warenhouse"]').addClass('error_input');
        }
    } else {
        simplecheckout_submit();
    }

});

//$("#confirm-button").click(function(){
//	$("#simplecheckout_button_confirm").trigger('click');
//});
</script>