<div id="cart">
    <?php if ($products || $vouchers) { ?>
    	<div class="filled_cart">       
            <span id="cart-total"><?php echo $text_items; ?></span>
        </div>
    <?php } else { ?>
    	<div class="cart">
            <div class="empty"><?php echo $text_empty; ?></div>
        </div>
    <?php } ?>
 </div>
