<?php if ($products && count($products) > 4) { ?>

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
    
    $('#ts').thumbScroller(settings);
});

</script>

<div class="section viewed clear">
<div class="title clear"><?php echo $text_viewed_title; ?></div>
    <div class="wrap-wrap">
		<div class="inside">   
            <div id="ts" class="thumb-scroller">
                <ul class="ts-list">
            		<?php foreach ($products as $product) { ?> 
                        <li>
                    		<div class="one-fourth">
                    			<div class="prod_container">
                                    <div class="one_prod">
                                        <?php if ($product['thumb']) { ?>
										<?php if ($product['special'] != '') { ?> 
											<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_viewed_akcimg; ?>" width="60" height="60" alt="akcija" />
										<?php } ?>
                                            <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo str_replace('"',"",$product['name']); ?>" /></a>
                                        <?php } ?>
                                        
                                        <div class="star">
                                            <span class="star-rating">
                                                <img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating'] . '.png'; ?>" alt="" />
                                            </span>
                                            <div class="control"><a href="<?php echo $product['href']; ?>"><?php echo $text_viewed_otzuv; ?> <?php echo $product['reviews']?> </a></div>
                                        </div>
                                        
                                        <div class="name_quant">
                                            <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                                            <div class="prod_quant quant_v_<?php echo $product['product_id']; ?>"><?php echo $text_viewed_kilk; ?> <input type="text" value="1"/></div>
                                        </div>
										
									<?php $special = str_replace( $text_viewed_cur ,"",$product['special']); ?>

                                        <div class="for_cart clear">
									<?php if ($special == '') { ?>
                                            <div class="prod_price"><span><?php echo $product['price']; ?></span> <?php echo $text_viewed_cur; ?></div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_v_<?php echo $product['product_id']; ?> input[type=\'text\']').val());" value="<?php echo $text_viewed_buy; ?>" class="site_button"/>
									<?php } else { ?>
                                            <div class="prod_price" style="height: 53px;margin-top:-8px;">
												<div class="price-old">
												<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
													<span><?php echo $special; ?></span><span class="currency">&thinsp;<?php echo $text_viewed_cur; ?></span>
												</div>
												<div class="price-new">
													<span><?php echo $product['price']; ?></span><span class="currency">&thinsp;<?php echo $text_viewed_cur; ?></span>
												</div>
											</div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_v_<?php echo $product['product_id']; ?> input[type=\'text\']').val());" value="<?php echo $text_viewed_buy; ?>" class="site_button"/>
									<?php } ?>
                                        </div>

                                        <?php echo $product['compare_link']; ?>
                                        
                                        
                                        <?php if ($product['rating']) { ?>
                                        <!--  <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                                        -->   
                                        <?php } ?>
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

<?php } elseif ($products && count($products) <= 4) { ?>
<div class="section viewed clear">
<div class="title clear"><?php echo $text_viewed_title; ?></div>
    <?php foreach ($products as $product) { ?> 
		<div class="one-fourth">
			<div class="prod_container"> 
                <div class="one_prod">
                    <?php if ($product['thumb']) { ?>
						<?php if ($product['special'] != '') { ?> 
							<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_viewed_akcimg; ?>" width="60" height="60" alt="akcija" /> 
						<?php } ?>
                        <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo str_replace('"',"",$product['name']); ?>" /></a>
                    <?php } ?>
                    
                    <div class="star">
                        <span class="star-rating">
                            <img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating'] . '.png'; ?>" alt="" />
                        </span>
                        <div class="control"><a href="<?php echo $product['href']; ?>"><?php echo $text_viewed_otzuv; ?> <?php echo $product['reviews']?> </a></div>
                    </div>
                    
                    <div class="name_quant">
                        <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                        <div class="prod_quant quant_v_<?php echo $product['product_id']; ?>"><?php echo $text_viewed_kilk; ?> <input type="text" value="1"/></div>
                    </div>

					<?php $special = str_replace( $text_viewed_cur ,"",$product['special']); ?>
								<div class="for_cart clear">
									<?php if ($special == '') { ?>
												<div class="prod_price"><span><?php echo $product['price']; ?></span> <?php echo $text_viewed_cur; ?></div>
												<input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_v_<?php echo $product['product_id']; ?> input[type=\'text\']').val())" value="<?php echo $text_viewed_buy; ?>" class="site_button"/>
									<?php } else { ?>
                                            <div class="prod_price" style="height: 53px;margin-top:-8px;">
												<div class="price-old">
												<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
													<span><?php echo $special; ?></span><span class="currency">&thinsp;<?php echo $text_viewed_cur; ?></span>
												</div>
												<div class="price-new">
													<span><?php echo $product['price']; ?></span><span class="currency">&thinsp;<?php echo $text_viewed_cur; ?></span>
												</div>
											</div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.quant_v_<?php echo $product['product_id']; ?> input[type=\'text\']').val());" value="<?php echo $text_viewed_buy; ?>" class="site_button"/>
									<?php } ?>
								</div>

                    <?php echo $product['compare_link']; ?>
                    
                    
                    <?php if ($product['rating']) { ?>
                    <!--  <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                    -->   
                    <?php } ?>
                </div>
			</div>
		</div>
	<?php } ?>
</div>
</div>
<?php } ?>

<script>
$('.one-fourth:last-child').addClass('last');
<!--/*//$('.box').css('display','none');*/-->

</script>