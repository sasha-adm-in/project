<div class="title"><?php echo $text_payment_option; ?></div>

<?php if ($simple_show_errors && $error_warning) { ?>
    <div class="simplecheckout-warning-block"><?php echo $error_warning ?></div>
<?php } ?>  
<div class="simplecheckout-block-content">
    <?php if (!empty($disabled_methods)) { ?>
        <table class="simplecheckout-methods-table" style="margin-bottom:0px;">
            <?php foreach ($disabled_methods as $key => $value) { ?>
                <tr>
                    <td class="code">
                        <input type="radio" name="disabled_payment_method" disabled="disabled" value="<?php echo $key; ?>" id="<?php echo $key; ?>" />
                    </td>
                    <td class="title">
                        <label for="<?php echo $key; ?>">
                            <?php echo $value['title']; ?>
                        </label>
                    </td>
                </tr>
                <?php if (!empty($value['description'])) { ?>
                    <tr>
                        <td class="code">
                        </td>
                        <td class="title">
                            <label for="<?php echo $key; ?>"><?php echo $value['description']; ?></label>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    <?php } ?>
    <?php if (!empty($payment_methods)) { ?>
        <div class="label_block">
         
            <?php foreach ($payment_methods as $payment_method) { ?>
                <label>
                    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" <?php if ($payment_method['code'] == $code) { ?>checked="checked"<?php } ?> onchange="simplecheckout_reload('payment_changed')" />
                    
                    <span><?php echo $payment_method['title']; ?></span>
                </label>

                  
               <!-- <?php if (!empty($payment_method['description'])) { ?>
                    <tr>
                        <td class="code">
                        </td>
                        <td class="title">
                            <label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['description']; ?></label>
                        </td>
                    </tr>
                <?php } ?> -->
            <?php } ?>
        </div>
        <input type="hidden" name="payment_method_current" value="<?php echo $code ?>" />
        <input type="hidden" name="payment_method_checked" value="<?php echo $checked_code ?>" />
    <?php } ?>
    <?php if (empty($payment_methods) && $address_empty && $simple_payment_view_address_empty) { ?>
        <div class="simplecheckout-warning-text"><?php echo $text_payment_address; ?></div>
    <?php } ?>
    <?php if (empty($payment_methods) && !$address_empty) { ?>
        <div class="simplecheckout-warning-text"><?php echo $error_no_payment; ?></div>
    <?php } ?>
</div>
<?php if ($simple_debug) print_r($address); ?>
<div class="title"><?php echo $text_payment_deliver; ?></div>
<div class="clear"></div>

<!--<label class="redelivery">
    <input type="checkbox" id="redelivery" /> Зворотня доставка
</label>-->


<div id="region" class="region_select">
    <select name="region">
        <option value="0"><?php echo $text_deliver_oblc; ?></option>
        <?php foreach($regions as $region) { ?>
            <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
        <?php } ?>
    </select>
</div>


<div id="city" class="city_select"></div>
<div id="warenhouse" class="warenhouse_select"></div>

<?php if (isset($total_delivery)) { ?>
    <div id="total_cost">
        
        <p><?php echo $text_deliver_obl; ?><?php echo $total_delivery['region']; ?></p>
        <p><?php echo $text_deliver_gor; ?><?php echo $total_delivery['city']; ?></p>
        <p><?php echo $text_deliver_otd; ?><?php echo $total_delivery['warenhouse']; ?></p>
        
        <p><?php echo $text_deliver_sum; ?><?php echo $total_delivery['cost']; ?></p>
    </div>
<?php } ?>
 
 <!--<div id="payment-cost">Вартість доставки 25 грн.</div>-->
 
<script type="text/javascript">
$(document).on('change', 'select[name="region"]', function() {
    var _this = $(this);
    
    if (_this.val() == 0) return;
    
    $.ajax({
        type: 'POST',
        url: 'index.php?route=checkout/simplecheckout_payment/getCities',
        data: 'region=' + _this.val(),
        cache: false,
        beforeSend: function() {
			$('#city').html('<img class="loading" src="catalog/view/image/load.gif" alt="" />');
		},
		complete: function() {
			$('.loading').remove();
		},
        success: function(response) {
            if (response) {
                response = JSON.parse(response);
                
                var html = '<select name="city"> \
                            <option value="0"><?php echo $text_deliver_gorc; ?></option>',
                    response_len = response.length;
                
                for (var i = 0; i < response_len; i++) {
                    html += '<option value="' + response[i] + '">' + response[i] + '</option>';
                }
                
                html += '</select>';

                $('#city').html(html);
            }
        },
        
        error:function(xhr, status, errorThrown) { 
             alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
        }
    });  
});

$(document).on('change', 'select[name="city"]', function() {
//$(document).on('change', 'input[name="checkout_customer[main_city]"], select[name="city"]', function() {
    var _this = $(this);
    
    if (_this.val() == 0) return;
    
    $.ajax({
        type: 'POST',
        url: 'index.php?route=checkout/simplecheckout_payment/getWarenhouses',
        data: 'city=' + _this.val(),
        cache: false,
        beforeSend: function() {
			$('#warenhouse').html('<img class="loading" src="catalog/view/image/load.gif" alt="" />');
		},
		complete: function() {
			$('.loading').remove();
		},
        success: function(response) {
            if (response) {
                response = JSON.parse(response);
                
                var html = '<select name="warenhouse"> \
                            <option value="0"><?php echo $text_deliver_otdc; ?></option>',
                    response_len = response.length;
                
                for (var i = 0; i < response_len; i++) {
                    html += '<option value="' + response[i] + '">' + response[i] + '</option>';
                }
                
                html += '</select>';

                $('#warenhouse').html(html);
            }
        },
        
        error:function(xhr, status, errorThrown) { 
             alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
        }
    });  
});

$(document).on('change', 'select[name="warenhouse"]', function() {
    var _this = $(this),
        redelivery;
    
    if (_this.val() == 0) return;

    if ($('#redelivery').is(':checked')) {
        redelivery = 1;
    } else {
        redelivery = 0;
    }
     
    $.ajax({
        type: 'POST',
        url: 'index.php?route=checkout/simplecheckout_payment/calculate',
        data: 'warenhouse=' + _this.val() + '&redelivery=' + redelivery,
        cache: false,
        beforeSend: function() {
			//$('#total_cost').html('<img class="loading" src="catalog/view/image/load.gif" alt="" />');
		},
		complete: function() {
			//$('.loading').remove();
		},
        success: function() {
            simplecheckout_reload('cart_value_changed');
        },
        
        error:function(xhr, status, errorThrown) { 
             alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
        }
    });  
});

$(document).on('click', 'select[name="region"], select[name="city"], select[name="warenhouse"]', function() {
    $(this).removeClass('error_input');
});
</script>
