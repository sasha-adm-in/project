<?php echo $header; ?>

<div id="content-wrapper">
    <div class="section big_catalog">
	    <div id="notification"></div>
		<div class="one">
            <div class="adress_line">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                <?php } ?>
            </div>
            <div class="title"><?php echo $heading_title; ?></div>

            <?php if ($products) { ?>
                <div class="view_items clear">
                    <div class="sort">
                        <span><?php echo $text_search_vuvod; ?> </span>
                        <select id="select" onchange="location = this.value;">
                            <?php foreach ($sorts as $sorts) { ?>
                                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                                    <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="product-list" id="prod_section">
                    <?php foreach ($products as $product) { ?>
                        <div class="one-fourth">
                  		    <div class="prod_container">
                                <div class="one_prod">
									<?php if ($product['special'] != '') { ?> 
										<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_search_akcimg; ?>" width="60" height="60" alt="akcija" /> 
									<?php } ?>
                                    <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo str_replace('"',"",$product['name']); ?>"/></a>

                                    <div class="prod_about">
                                        <div class="star">
                                            <span class="star-rating">
                                                <img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating'] . '.png'; ?>" alt="" />
                                            </span>
                                            <div class="control"><a href="<?php echo $product['href']; ?>"><?php echo $text_search_otzuvov; ?> <?php echo $product['reviews']?> </a></div>
                                        </div>
                                        <div class="name_quant">
                                            <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
											
											<!--<?php if ($quantity > 0) { ?>
												<span><?php echo $text_filter_available; ?> ${quantity} ${unit}</span>
											<?php } else { ?>
												<span style="color:#7AAF1B;"><img src="/catalog/view/theme/res_final/image/deliver.png" alt="<?php echo $text_search_dostavka; ?>" style="width:23px; height:14px; margin-bottom: -2px;"><?php echo $text_filter_podzak; echo $days;?></span>
											<?php } ?>-->
											
                                            <div class="prod_quant"><?php echo $text_search_kilk; ?> <input type="text" value="1"/></div>
                                        </div>
                                        <div class="for_cart clear">
									<?php if ($product['special'] == '') { ?>
                                            <div class="prod_price"><span><?php echo $product['price']; ?></span></div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.prod_quant input[type=\'text\']').val());" value="<?php echo $text_search_buy; ?>" class="site_button"/>
									<?php } else { ?>
                                            <div class="prod_price" style="height: 53px;margin-top:-8px;">
												<div class="price-old">
													<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
													<span><?php echo $product['special']; ?></span><span class="currency"><?php echo $text_search_vol; ?></span>
												</div>
												<div class="price-new">
													<span><?php echo $product['price']; ?></span><span class="currency"><?php echo $text_search_vol; ?></span>
												</div>
											</div>
                                            <input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>', $('.prod_quant input[type=\'text\']').val());" value="<?php echo $text_search_buy; ?>" class="site_button"/>
									<?php } ?>
                                        </div>
                                        <?php echo $product['compare_link']; ?>
                                    </div>
                                    
                                    <div class="prod_info">
                                        <?php foreach ($product['attribute_groups'] as $attribute_group) { ?>
                                            <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                                                <p><?php echo $attribute['name']; ?>: <b><?php echo $attribute['text']; ?></b></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                       	        </div>
                        	</div>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="clear"></div>  
                <div class="pagination"><?php echo $pagination; ?></div>
            <?php } else { ?>
                <br /><br /><?php echo $text_search_notfound; ?><br /><br /><br />
            <?php } ?>
            
            <script type="text/javascript">
                $(function () {
                    $("#select").selectbox();
                    
                    $('#prod_section .one-fourth:nth-child(4n)').addClass('last');
                });
            </script>
        </div>             
    </div>
</div>

<div class="clear"></div>

<?php echo $content_bottom; ?>
<?php echo $footer; ?>