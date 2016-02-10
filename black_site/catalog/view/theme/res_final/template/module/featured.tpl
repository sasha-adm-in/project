<?php if ($products) { ?>

<script type="text/javascript">
$(document).ready(function() {
    var settings = {
    	slideWidth:266,
    	slideHeight:420,
    	slideMargin:4,
    	slideBorder:8,
        numDisplay: 4,
    	responsive:true,
        easing: 'swing',
    	captionEffect:'fade',
    	mousewheel:false,
    	keyboard:true,
    	swipe:true,
        control: 'scrollbar',
        navButtons: 'none',
        pageInfo: false,
        init: function() {
            var width = $(window).width();
            
            if (width >= 960 && width < 1170) {
                this.numDisplay = 3;
                this.slideHeight = 390;
            }
            
            if (width >= 767 && width < 960) {
                this.numDisplay = 2;
                this.slideHeight = 360;
            }
            
            if (width < 767) {
                this.numDisplay = 1;
                this.slideHeight = 280;
            }
        }
    };
    
    settings.init();
    
    $('#ts1').thumbScroller(settings);
    
});
</script>

<div class="section leaders clear">
<div class="title clear"><?php echo $text_feature_title; ?></div>
    <div class="wrap-wrap">
		<div class="inside">   
            <div id="ts1" class="thumb-scroller">
                <ul class="ts-list"> 
            		<?php foreach ($products as $product) { ?> 
                        <li>
                    		<div class="one-fourth">
                    			<div class="prod_container"> 
                                    <div class="one_prod">
                                        <?php if ($product['thumb']) { ?>
										<?php if ($product['special'] != '') { ?> 
											<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_feature_akcimg; ?>" width="60" height="60" alt="akcija" /> 
										<?php } ?>
                                            <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo str_replace('"',"",$product['name']); ?>" /></a>
                                        <?php } ?>
                                        
                                        <div class="star">
                                            <span class="star-rating">
                                                <img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating'] . '.png'; ?>" alt="" />
                                            </span>
                                            <div class="control"><a href="<?php echo $product['href']; ?>"><?php echo $text_feature_vidg; ?><?php echo $product['reviews']?> </a></div>
                                        </div>
                                        
                                        <div class="name_quant">
                                            <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                                            <div class="prod_quant quant_f_<?php echo $product['product_id']; ?>"><?php echo $text_feature_number; ?><input type="text" value="1"/></div>
                                        </div>
                                        
                                        <div class="for_cart clear">

							<?php $product['special'] = str_replace( $text_feature_cur ,"",$product['special']); ?>
							<?php $special = str_replace( $text_feature_cur ,"",$special); ?>
							<?php $product['price'] = str_replace( $text_feature_cur ,"",$product['price']); ?>

									<?php if ($product['special'] == '') { ?>
                                            <div class="prod_price"><span><?php echo $product['price']; ?></span><?php echo $text_feature_cur; ?></div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_f_<?php echo $product['product_id']; ?> input[type=\'text\']').val());" value="<?php echo $text_feature_btnbuy; ?>" class="site_button"/>
									<?php } else { ?>
                                            <div class="prod_price" style="height: 53px;margin-top:-8px;">
												<div class="price-old">
													<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
													<span><?php echo $product['special']; ?></span><span class="currency">&thinsp;<?php echo $text_feature_cur; ?></span>
												</div>
												<div class="price-new">
													<span><?php echo $product['price']; ?></span><span class="currency">&thinsp;<?php echo $text_feature_cur; ?></span>
												</div>
											</div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_f_<?php echo $product['product_id']; ?> input[type=\'text\']').val());" value="<?php echo $text_feature_btnbuy; ?>" class="site_button"/>
									<?php } ?>
                                        </div>

                                        <?php echo $product['compare_link']; ?>
                                    </div>
                    			</div>
                    		</div>
                        </li>
            		<?php } ?>
                </ul>
            </div>
		</div>
	</div>
</div>

<br /><br />

<script>
    $('.leaders .one-fourth:last-child').addClass('last');
</script>

<?php } ?>