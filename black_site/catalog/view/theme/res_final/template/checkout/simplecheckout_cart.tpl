<?php if ($attention) { ?>
    <div class="simplecheckout-warning-block"><?php echo $attention; ?></div>
<?php } ?>    
<?php if ($error_warning) { ?>
    <div class="simplecheckout-warning-block"><?php echo $error_warning; ?></div>
<?php } ?>

<style type="text/css"> 
    @media print { 
        .cart_header, 
        .title_cart, 
        .contact_data, 
        .payment_method,
        .print_button,
        .footer { 
            display:none
        } 
        
    } 
</style>

   <div class="your_order">
   <div class="">

                    <div class="title"><?php echo $text_cart_order; ?></div>  
                    <div class="grey_logo">
                        <img src="catalog/view/theme/res_final/images/grey_logo.jpg" draggable="false"/>
                    </div>
                    <div class="print_button">
                        <a href="javascript:;" onclick="window.print();">
                            <img src="catalog/view/theme/res_final/images/print.png"/>
                        </a> 
                    </div>
                    <div class="clear"></div>
    </div>

   <ul>
    <?php foreach ($products as $product) { ?>
        <?php if (!empty($product['recurring'])) { ?>
            <tr>
                <td class="simplecheckout-recurring-product" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" /><span style="float:left;line-height:18px; margin-left:10px;"> 
                    <strong><?php echo $text_recurring_item ?></strong>
                    <?php echo $product['profile_description'] ?>
                </td>
            </tr>
        <?php } ?>

        <li class="clear">
            <div class="table_name">
                <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                <?php if (!$product['stock']) { ?>
                    <span class="empty_stock">*</span>
                <?php } ?>
            </div>
            <div class="table_price"><span><?php echo $product['price']; ?></span></div>
            <div class="table_x">&times;</div>
            <div class="table_quant"> <input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" onchange="simplecheckout_reload('cart_value_changed')" /></div>
            <div class="table_total"><span><?php echo $product['total']; ?></span></div>
            <div class="table_del clear"><a href="javascript:" onclick="jQuery('#simplecheckout_remove').val('<?php echo $product['key']; ?>');simplecheckout_reload('product_removed');"><?php echo $text_payment_deltov; ?></a></div>
            <div class="clear"></div>
            
        </li>
        <br />
        <li style="border-top: 1px dashed #797979;"></li>
        
       
            <?php } ?>

    </ul>
            <?php foreach ($vouchers as $voucher_info) { ?>
                <tr>
                    <td class="image"></td>  
                    <td class="name"><?php echo $voucher_info['description']; ?></td>
                    <td class="model"></td>
                    <td class="quantity">1</td>
                    <td class="price"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
                    <td class="total"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
                    <td class="remove">
                    <img style="cursor:pointer;" src="<?php echo $simple->tpl_joomla_path() ?>catalog/view/image/close.png" onclick="jQuery('#simplecheckout_remove').val('<?php echo $voucher_info['key']; ?>');simplecheckout_reload('product_removed');" />
                    </td>
                </tr>
            <?php } ?>
 
    
<?php foreach ($totals as $total) { 
		if($total['code'] == 'total_sub_total') {
		
		}
		else if($total['code'] == 'sub_total') {
?>

    <div class="delivery clear" id="total_<?php echo $total['code']; ?>">
<!--         <div class="table_name"><?php echo $total['title']; ?></div>-->
         <div class="table_name"><?php echo $text_payment_totalsum; ?></div>
         <div class="table_price"><nobr><?php echo $total['text']; ?></nobr></div>
       
    </div>
<?php } else if ($total['code'] == 'shipping') { ?>
	<div class="delivery clear" id="total_<?php echo $total['code']; ?>">
<!--         <div class="table_name"><?php echo $total['title']; ?></div>-->
         <div class="table_name"><?php echo $text_payment_totalsum; ?></div>
         <div class="table_price"><nobr><?php echo $total['text']; ?></nobr></div>
       
    </div>
<?php } else { ?>
    <div class="cart_summ clear">
<!--        <div class="table_name"><?php echo $total['title']; ?></div>-->
        <div class="table_name"><?php echo $text_payment_totalsum; ?></div>
        <div class="table_price clear"><?php echo $total['text']; ?></div>
    </div>
<?php } } ?>
<?php if ($is_logged) { ?>
<!--<div class="cart_summ clear">
    <div class="table_name">Сума зі знижкою</div>
    <div class="table_price clear"><?php echo $total_sum; ?> грн.</div>
</div>-->
<?php } ?>
<?php if (isset($modules['coupon']) && $is_logged) { ?>
  <div class="cart_summ clear">
        <span class="inputs"><?php echo $text_cart_code; ?>&nbsp;<input style="height:20px; border: 1px solid rgba(167, 164, 164, 1);" type="text" name="coupon" value="<?php echo $coupon; ?>" onchange="simplecheckout_reload('coupon_changed')"  /></span>
    </div>
<?php } ?>
<?php if (isset($modules['reward']) && $points > 0) { ?>
    <div class="simplecheckout-cart-total">
        <span class="inputs"><?php echo $entry_reward; ?>&nbsp;<input type="text" name="reward" value="<?php echo $reward; ?>" onchange="simplecheckout_reload('reward_changed')"  /></span>
    </div>
<?php } ?>
<?php if (isset($modules['voucher'])) { ?>
    <div class="simplecheckout-cart-total">
        <span class="inputs"><?php echo $entry_voucher; ?>&nbsp;<input type="text" name="voucher" value="<?php echo $voucher; ?>" onchange="simplecheckout_reload('voucher_changed')"  /></span>
    </div>
<?php } ?>
<?php if (isset($modules['coupon']) && $is_logged) { ?>
    <div class="simplecheckout-cart-total simplecheckout-cart-buttons">
        <span class="inputs buttons"><a id="simplecheckout_button_cart"  style="padding: 3px 3px;
margin-left: 10px;cursor:pointer;" onclick="simplecheckout_reload('cart_changed');" class="button btn"><span style="padding:2px;"><?php echo $text_cart_codebtn; ?></span></a></span>
    </div>
<?php } ?>

   <div class="cart_summ clear"><input type="button" value="<?php echo $text_cart_confirmorder; ?>" class="site_button confirm_order"/></div>
    
<input type="hidden" name="remove" value="" id="simplecheckout_remove">
<div style="display:none;" id="simplecheckout_cart_total"><?php echo $cart_total ?></div>
<script type="text/javascript">
    jQuery(function(){
        jQuery('#cart_total').html('<?php echo $cart_total ?>');
        jQuery('#cart-total').html('<?php echo $cart_total ?>');
        jQuery('#cart_menu .s_grand_total').html('<?php echo $cart_total ?>');
        <?php if ($simple_show_weight) { ?>
        jQuery('#weight').text('<?php echo $weight ?>');
        <?php } ?>
        <?php if ($template == 'shoppica2') { ?>
        jQuery('#cart_menu div.s_cart_holder').html('');
        $.getJSON('index.php?<?php echo $simple->tpl_joomla_route() ?>route=tb/cartCallback', function(json) {
            if (json['html']) {
                jQuery('#cart_menu span.s_grand_total').html(json['total_sum']);
                jQuery('#cart_menu div.s_cart_holder').html(json['html']);
            }
        });
        <?php } ?>
        <?php if ($template == 'shoppica') { ?>
            jQuery('#cart_menu div.s_cart_holder').html('');
            jQuery.getJSON('index.php?<?php echo $simple->tpl_joomla_route() ?>route=module/shoppica/cartCallback', function(json) {
                if (json['output']) {
                    jQuery('#cart_menu span.s_grand_total').html(json['total_sum']);
                    jQuery('#cart_menu div.s_cart_holder').html(json['output']);
                }
            });
        <?php } ?>
    });
</script>
<?php if ($simple->get_simple_steps() && $simple->get_simple_steps_summary()) { ?>
<div id="simple_summary" style="display: none;margin-bottom:15px;">
    <table class="simplecheckout-cart">
        <colgroup>
            <col class="image">
            <col class="name">
            <col class="model">
            <col class="quantity">
            <col class="price">
            <col class="total">
        </colgroup>
        <thead>
            <tr>
                <th class="image"><?php echo $column_image; ?></th>
                <th class="name"><?php echo $column_name; ?></th>
                <th class="model"><?php echo $column_model; ?></th>
                <th class="quantity"><?php echo $column_quantity; ?></th>
                <th class="price"><?php echo $column_price; ?></th>
                <th class="total"><?php echo $column_total; ?></th>
            </tr>
        </thead>
    <tbody>
    <?php foreach ($products as $product) { ?>
        <tr>
            <td class="image">
                <?php if ($product['thumb']) { ?>
                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                <?php } ?>
            </td> 
            <td class="name">
                <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
                    <span class="product-warning">***</span>
                <?php } ?>
                <div class="options">
                <?php foreach ($product['option'] as $option) { ?>
                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                <?php } ?>
                </div>
                <?php if ($product['reward']) { ?>
                <small><?php echo $product['reward']; ?></small>
                <?php } ?>
            </td>
            <td class="model"><?php echo $product['model']; ?></td>
            <td class="quantity"><?php echo $product['quantity']; ?></td>
            <td class="price"><nobr><?php echo $product['price']; ?></nobr></td>
            <td class="total"><nobr><?php echo $product['total']; ?></nobr></td>
            </tr>
            <?php } ?>
            <?php foreach ($vouchers as $voucher_info) { ?>
                <tr>
                    <td class="image"></td>  
                    <td class="name"><?php echo $voucher_info['description']; ?></td>
                    <td class="model"></td>
                    <td class="quantity">1</td>
                    <td class="price"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
                    <td class="total"><nobr><?php echo $voucher_info['amount']; ?></nobr></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
        
    <?php foreach ($totals as $total) { ?>
        <div class="simplecheckout-cart-total" id="total_<?php echo $total['code']; ?>">
            <span><b><?php echo $total['title']; ?>: </b></span>
            <span class="simplecheckout-cart-total-value"><nobr><?php echo $total['text']; ?></nobr></span>
        </div>
    <?php } ?>

    <?php if ($summary_comment) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
      <thead>
        <tr>
          <th class="name"><?php echo $text_summary_comment; ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $summary_comment; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($summary_payment_address || $summary_shipping_address) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
      <thead>
        <tr>
          <th class="name"><?php echo $text_summary_payment_address; ?></th>
          <?php if ($summary_shipping_address) { ?>
          <th class="name"><?php echo $text_summary_shipping_address; ?></th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $summary_payment_address; ?></td>
          <?php if ($summary_shipping_address) { ?>
          <td><?php echo $summary_shipping_address; ?></td>
          <?php } ?>
        </tr>
      </tbody>
    </table>
    <?php } ?>
</div></div>
<?php } ?>
<style>
#total_sub_total {display:none}
#total_total {display:none}
</style>
<script type="text/javascript">
	 $(document).ready(function(){
    $('#total_sub_total').css('display','none');
    $('#total_total').css('display','none');
    var summ = $('#total_total .table_price').html();
    //$('.cart_summ .table_price').html(summ);
	});

	$('#simplecheckout_button_confirm2').click(function(){
	$('#button-confirm').trigger('click');
	}); 
</script>

	<!--ADWORDS KOD OTSLEJIVANIJA DOB TOVARA V KORZINU-->
	<!--ADWORDS KOD OTSLEJIVANIJA DOB TOVARA V KORZINU-->
