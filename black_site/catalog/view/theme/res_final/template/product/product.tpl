<?php echo $header; ?>
<!-- Add jQuery library -->

<!-- Add fancyBox -->

					<? #BEGIN ?>
							<?php
							$parent_id = 0;
							$categories = array();
							$product_categories = $this->model_catalog_product->getCategories($product_id);
							$parent_id = $product_categories[0]['category_id'];
							$parent_categories = $this->model_catalog_category->getCategories($parent_id);
							foreach ($parent_categories as $category) {
							$categories[] = array(
							'name' => $category['name'],
							'href' => $this->url->link('product/category', 'path=' . $category['parent_id'] . '_' . $category['category_id'])
							);
							$children = $this->model_catalog_category->getCategories($category['category_id']);
							}
							if ($categories) { ?>
							<div>
							<ul>
							<?php foreach ($categories as $category) { ?>
							<?php } ?>
							</ul>
							</div>
							<?php } ?>
					<? #END ?>

<script type="text/javascript" src="/catalog/view/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>


<div class="product-info">
<div id="content-wrapper">
    <div class="section big_catalog prod_card">
	<div id="notification"></div>
	<div id="notification2"></div>
		<div class="one-fourth">
			<?php echo $column_left; ?>
			<div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <!--<div class="title no_border">Каталог виробників</div>-->
                            <div class="left_nav">
                                <?php if (isset($manufacturers_left) && $manufacturers_left) { ?>
                                <ul class="maufacturers_list">
                                    <?php foreach ($manufacturers_left as $manuf_name => $manufacturer) { ?>
                                        <li>
                                            <a href="javascript:;"><?php echo $manuf_name; ?></a>
                                            <?php if (isset($manufacturer['products']) && $manufacturer['products']) { ?>
                                                <ul>
                                                    <li><a href="<?php echo $manufacturer['category']['href']; ?>" class="manufacturer_category"><?php echo $text_prod_alltov; ?> <?php echo $manufacturer['category']['name']; ?> <?php echo $manuf_name; ?></a></li>
                                                    <?php foreach ($manufacturer['products'] as $product) { ?>
                                                        <li><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>

                                <!---------------------------------------->

                                <?php if (isset($products_left) && $products_left) { ?>
                                    <ul class="maufacturers_list">
                                        <li>
                                            <a href="javascript:;"><?php echo $products_left['category']['name']; ?></a>
                                            <?php if (isset($products_left['products']) && $products_left['products']) { ?>
                                                <ul>
                                                    <!--<li><a href="<?php echo $products_left['category']['href']; ?>" class="manufacturer_category">Всі товари категорії <?php echo $products_left['category']['name']; ?></a></li>-->
                                                    <?php foreach ($products_left['products'] as $product) { ?>
                                                        <li><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    </ul>
									<div style="margin-left:7px;margin-top:8px;">
												<?#category?>
												<?php if ($categories) { ?>
												  <div class="category-list">
													<?php if (count($categories) <= 5) { ?>
													<ul>
													  <?php foreach ($categories as $category) { ?>
													  <li><a href="<?php echo $category['href']; ?>">> <?php echo $category['name']; ?></a></li>
													  <?php } ?>
													</ul>
													<?php } else { ?>
													<?php for ($i = 0; $i < count($categories);) { ?>
													<ul>
													  <?php $j = $i + ceil(count($categories) / 4); ?>
													  <?php for (; $i < $j; $i++) { ?>
													  <?php if (isset($categories[$i])) { ?>
													  <li><a href="<?php echo $categories[$i]['href']; ?>">> <?php echo $categories[$i]['name']; ?></a></li>
													  <?php } ?>
													  <?php } ?>
													</ul>
													<?php } ?>
													<?php } ?>
												  </div>
												  <?php } ?>
												<?#category_end?>
									</div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="three-fourth last" itemscope="" itemtype="http://schema.org/Product">
			<div class="adress_line">
            <div xmlns:v="http://rdf.data-vocabulary.org/#">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<?php echo $breadcrumb['separator']; ?><span typeof="v:Breadcrumb"><a href="<?php echo $breadcrumb['href']; ?>" rel="v:url" property="v:title"><?php echo $breadcrumb['text']; ?></a></span>
				<?php } ?>
            </div>
			</div>

					<div class="title no_border"><h1 class="detail-title" itemprop="name"><?php echo $heading_title; ?></h1></div>
					<?php if ($sku) { ?>
					<div class="prod_code"><?php echo $text_prod_code; ?> <meta itemprop="sku" content="<?php echo $sku; ?>"><?php echo $sku; ?><!--<span id="istatclientcode">00-000</span>--></div>
					<?php } ?>

			<div class="prod_descr clear">
				<div class="one-half">
		

					<div class="image_product">
                        <?php if ($thumb || $images) { ?>
							<?php if ($special != '') { ?>
								<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_prod_akcimg; ?>" width="80" height="80" alt="<?php echo $text_prod_akcija; ?>" title="<?php echo $text_prod_akcija; ?>" />
							<?php } ?>
                            <a class="fancybox" rel="gallery1" href="#popup_image">
                                <img src="<?php echo $thumb; ?>" alt="<?php echo str_replace('"',"",$heading_title); ?>" title="<?php echo str_replace('"',"",$heading_title); ?>" itemprop="image" />
                            </a>

                            <div id="popup_image" style="display: none;">
                                <p class="popup_name"><?php echo $heading_title; ?></p>
								<p class="popupimg">
									<img src="<?php echo $popup; ?>" alt="" />
								</p>
                                <div class="popup_buttons">
                                    <input type="button" id="button-cart" value="<?php echo $text_prod_buy; ?>" class="site_button cart_button_popup"/>
									<?php /*if ($special == '') { //old ?>
										<div class="prod_price price_popup"><span><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php } else { ?>
										<div class="prod_price price_popup"><span><?php echo $special; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php }*/ ?>	
									<?php if ($special == '') { //3274// ?>
										<div class="prod_price price_popup"><span><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php } else { ?>
										<div class="prod_price price_popup"><span><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php }?>										
								</div>
                            </div>
                        <?php } ?>
					</div>


					<?php if ($images) { ?>
                        <div class="additional_img">
                            <?php foreach ($images as $key => $image) { ?>
                                <a class="fancybox" rel="gallery1" href="#popup_image_<?php echo $key; ?>">
                                    <img src="<?php echo $image['thumb']; ?>" alt="" />
                                </a>

                                <div id="popup_image_<?php echo $key; ?>" style="display: none;">
                                    <p class="popup_name"><?php echo $heading_title; ?></p>
                                    <img src="<?php echo $image['popup']; ?>" alt="" />
                                    <div class="popup_buttons">
                                        <input type="button" id="button-cart" value="<?php echo $text_prod_buy; ?>" class="site_button cart_button_popup"/>
									<?php if ($special == '') { ?>
                                        <div class="prod_price price_popup"><span><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php } else { ?>
										<div class="prod_price price_popup"><span><?php echo $special; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
									<?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
					<?php } ?>
				</div>
				<div class="one-half last">

				<!-- TITLE OLD -->
				
				 
				 
					<?php if ($special != '') { ?> 
						<div class="action">
						<div class="actname"><?php echo $text_prod_akcdie; ?> <?php echo $special_end['2']; ?>.<?php echo $special_end['1']; ?>.<?php echo $special_end['0']; ?></div>
							<div style="width:27%;float:left;display:none;">
								<img style="border:none;margin: 10px 0;" draggable="false" src="/image/ico/akcij15p.png" width="80" height="80" alt="<?php echo $text_prod_akcija; ?>" title="<?php echo $text_prod_akcija; ?>">
							</div>
							<div id="container">
								<span class="subtitle" style="margin-left: 20px;"><?php echo $text_prod_akcend; ?></span>
								<!-- Начало панели счетчика -->
								<div id="countdown_dashboard">
									<div class="dash weeks_dash">
										<span class="dash_title"><?php echo $text_prod_week; ?></span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
									<div class="dash days_dash">
										<span class="dash_title"><?php echo $text_prod_day; ?></span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
									<div class="dash hours_dash">
										<span class="dash_title"><?php echo $text_prod_hour; ?></span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
									<div class="dash minutes_dash">
										<span class="dash_title"><?php echo $text_prod_min; ?></span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
									<div class="dash seconds_dash">
										<span class="dash_title"><?php echo $text_prod_sec; ?></span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
								</div>
								<!-- Завершение панели счетчика -->
								<!--<div class="dev_comment">
								</div>-->
								<script language="javascript" type="text/javascript">
									jQuery(document).ready(function() {
										$('#countdown_dashboard').countDown({
											targetDate: {
												'day': 		<?php echo $special_end['2']; ?>,
												'month': 	<?php echo $special_end['1']; ?>,
												'year': 	<?php echo $special_end['0']; ?>,
												//'hour':	12,
												'hour': 	<?php if ($special_end_time[0]){ echo $special_end_time[0];}else{ '12'; } ?>, //12 //3274//
												'min': 		00,
												'sec': 		00					}
										});
										
									});
								</script>
							</div>							
						</div>
					<?php } ?>
			
		<div class="product-nav">
			<div class="left-side-prodinfo">
					<div class="for_buy" style="float:left;">
						
						<?php if ($special == '') { ?>
							<div class="prod_price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
								<span itemprop="price"><meta itemprop="priceCurrency" content="UAH"><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span>
							</div>
							<div style="clear:both;"></div>
						<?php } else { ?>
							<div class="prod_price" style="height: 58px;" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
							<div class="price-old">
								<hr style="margin: 13px 5% 0 5%;width:90%;">
								<span><?php echo $special; ?></span><span class="currency"><?php echo $text_prod_val; ?></span>
							</div>
							<div class="price-new">
								<span itemprop="price"><meta itemprop="priceCurrency" content="UAH"><?php echo $price; ?></span><span class="currency"><?php echo $text_prod_val; ?></span>
							</div>
							</div>
							<div style="clear:both;"></div>
						<?php } ?>
					
					
						<?php if ($stock != '0') { ?>
						<link itemprop="availability" href="http://schema.org/InStock"> 
						<?php } else { ?>
						<link itemprop="availability" href="http://schema.org/OutOfStock">
						<?php } ?>
						
						<div class="prod_quant"><?php echo $text_prod_kil; ?> <input type="text" value="1" name="quantity"/></div>
						<div style="clear:both;"></div>
						<input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
						<div style="/*float:left;*/ margin:0px;width: 154px;height: 62px;display: inline-block;">
							<input type="button" id="button-cart" value="<?php echo $text_prod_buy; ?>" class="site_button" style="margin-bottom:8px;"/><br />
							<a href="#" class="callme_viewform buy-1c"><?php echo $text_prod_zvjz; ?></a>
						</div>
						
					</div>
					<div style="clear:both;"></div>			
					
					<div class="prod_option">
						<?php if ($price == '0.00') { ?>
							<span><?php echo $text_prod_cinytoch; ?></span><br />
						<?php } ?>
					
						<?php if ($stock != '0') { ?>
								<span><?php echo $text_prod_available; ?> - <?php echo $stock; ?> <?php echo $unit; ?></span><br />
						<?php } else { ?>
							<!-- adding for days of delivery -->
								<?php foreach ($attribute_groups as $attribute_group) { ?>
										<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
										  <?php if ($attribute['name'] == $text_prod_term) { $days = $attribute['text'];} ?>
										<?php } ?>
								<?php } ?>
							<!-- adding for days of delivery -->
								<span style="color:#7AAF1B;"><img src="/catalog/view/theme/res_final/image/deliver.png" alt="delivery" style="width:23px; height:14px; margin-bottom: -2px;"><?php echo $text_prod_podzakaz; ?> <?php echo $days ?></span><br />
						<?php } ?>
                        <?php echo $compare_link; ?><br />
						<div class="share">
							<!--<span style="font-size:12px; position:absolute; margin:-12px 0 0 0px;"><?php echo $text_prod_share; ?></span>-->
							<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
						</div>
                    </div>


					<?php if ($options) { ?>
						<div class="options">
							<h2><?php echo $text_option; ?></h2>
							<br />
							<?php foreach ($options as $option) { ?>
							<?php if ($option['type'] == 'select') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <select name="option[<?php echo $option['product_option_id']; ?>]">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach ($option['option_value'] as $option_value) { ?>
								<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price']) { ?>
								(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
								<?php } ?>
								</option>
								<?php } ?>
							  </select>
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'radio') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <?php foreach ($option['option_value'] as $option_value) { ?>
							  <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
							  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price']) { ?>
								(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
								<?php } ?>
							  </label>
							  <br />
							  <?php } ?>
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'checkbox') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <?php foreach ($option['option_value'] as $option_value) { ?>
							  <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
							  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price']) { ?>
								(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
								<?php } ?>
							  </label>
							  <br />
							  <?php } ?>
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'image') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <table class="option-image">
								<?php foreach ($option['option_value'] as $option_value) { ?>
								<tr>
								  <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
								  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
								  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
									  <?php if ($option_value['price']) { ?>
									  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
									  <?php } ?>
									</label></td>
								</tr>
								<?php } ?>
							  </table>
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'text') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'textarea') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'file') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
							  <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'date') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'datetime') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
							</div>
							<br />
							<?php } ?>
							<?php if ($option['type'] == 'time') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
							  <?php if ($option['required']) { ?>
							  <span class="required">*</span>
							  <?php } ?>
							  <b><?php echo $option['name']; ?>:</b><br />
							  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
							</div>
							<br />
							<?php } ?>
							<?php } ?>
						  </div>
					<?php } ?>
					
			</div>

			<div class="right-side-prodinfo">

						<?php if ($review_status) { ?>
							<div class="star" typeof="v:Review-aggregate" xmlns:v="http://rdf.data-vocabulary.org/#">
                				<span class="star-rating" style="background:none;">
                					 <img src="catalog/view/theme/res_final/image/stars-<?php echo $rating . '.png'; ?>" draggable="false" alt="rating" />
                				</span><div style="clear:both"></div>
                                <span style="display:none;" property="v:itemreviewed"><?php echo $text_prod_review; ?></span>
                                <span rel="v:rating">
                            	<span typeof="v:Rating">
                            	<span property="v:average"><?php echo $rating; ?></span>
                            		<?php echo $text_prod_iz; ?>
                            	<span property="v:best">5</span>
                            	</span>
                                </span>
                                    <?php echo $text_prod_naosn; ?>
                            	<span property="v:votes"><?php echo $reviews_counter; ?></span><?php echo $text_prod_ocenok; ?><br>
                            	<span property="v:count"><?php echo $reviews_counter; ?></span><?php echo $text_prod_otzuvov; ?>
							</div>
						<?php } ?>
							
						<div class="right_dost_inf">
							<div class="blok-prod-dost">

								<div class="blok-inf-zag first">
									<div class="inf-img">i</div><span style=""><?php echo $text_prod_dost; ?></span>
								</div>

								<div style="font-size:12px;">
								<?php echo $text_prod_dost_text; ?>
								<a href="#delivery_cost" class="fancybox_delivery"><?php echo $text_prod_rozrah; ?></a>                        
								<div id="delivery_cost">
									<span style="font-size:15px;"><?php echo $text_prod_rozrahh; ?> <br /> <em><?php echo $heading_title; ?></em></span>
									
									<fieldset>
										<legend><?php echo $text_prod_gorod; ?></legend>
										
										<div id="region"></div>
										<div id="city"></div>
									</fieldset>
									
									<fieldset>
										<legend><?php echo $text_prod_tipysl; ?></legend>
										
										<select name="delivery_type">
											<option value="4"><?php echo $text_prod_tipysl1; ?></option>
											<option value="3"><?php echo $text_prod_tipysl2; ?></option>                                
											<option value="1"><?php echo $text_prod_tipysl3; ?></option>
											<option value="2"><?php echo $text_prod_tipysl4; ?></option>                                
										</select>
									</fieldset>
									
									<fieldset>
										<legend><?php echo $text_prod_kilk; ?></legend>
										
										<input type="text" name="delivery_quantity" value="1" style="border: 1px solid #ACACAC; padding: 5px;" />
									</fieldset>
									
									<button><?php echo $text_prod_summi; ?></button>
									
									<div id="total_cost"></div>
								</div>
								</div>
							</div>
							<div class="blok-prod-opl">

								<div class="blok-inf-zag">
									<div class="inf-img">i</div><span style=""><?php echo $text_prod_oplata; ?></span>
								</div>

								<div style="font-size:12px;">
								<?php echo $text_prod_oplata_text; ?>
								</div>
							</div>
							<div class="blok-prod-gar">

								<div class="blok-inf-zag">
									<div class="inf-img">i</div><span style=""><?php echo $text_prod_gar; ?></span>
								</div>

								<div style="font-size:12px;">
								<?php echo $text_prod_gar_text; ?>
								</div>
							</div>
						</div>
			</div>
		</div>
			<div style="clear:both;"></div>			
			
					<div class="prod_info" itemprop="description">
                        <table class="attribute">
                                <tbody>
							<!--Краткие характеристики-->

                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?> 
								  <?php if ($attribute['name'] != $text_prod_term) { ?>
                                    <?php if ($key == 4) break; ?>
                                    <tr>
                                        <td><?php echo $attribute['name']; ?></td>
                                        <td><b><?php echo $attribute['text']; ?></b></td>
                                    </tr>
								  <?php } ?>
                                <?php } ?>
							<?php } ?>

                                </tbody>
                        </table>
						<div class="mistake"><?php echo $text_prod_soo; ?></div>
					</div>
				</div>
			</div>
			<div id="prod_tabs" class="tab1">
				<div class="title">
						<a href="javascript:" class="tab1"><?php echo $text_prod_opis; ?></a>
						<?php if ($attribute_groups) { ?>
							<a href="javascript:" class="tab2"><?php echo $text_prod_xarak; ?></a>
						<?php } ?>
						<a href="javascript:" class="tab3"><?php echo $text_prod_otzuv; ?></a>
				</div>
				<div class="tab1">
					<?php echo $description; ?>
				</div>
				<div class="tab2">
					<table class="attribute">
						<?php foreach ($attribute_groups as $attribute_group) { ?>
							<tbody>
								<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
							  <?php if ($attribute['name'] != $text_prod_term) { ?>
								<tr>
									<td><?php echo $attribute['name']; ?></td> 
									<td><b><?php echo $attribute['text']; ?></b></td> 
								</tr>
							  <?php } ?>
								<?php } ?>
							</tbody>
						<?php } ?>
					</table>
				</div>
				<div class="tab3">
						<?php if ($review_status) { ?>
							<span id="review"></span>
                            
                            <h2 id="review-title"><?php echo $text_prod_napotzuv; ?> про товар <?php echo $heading_title; ?></h2>
                            
                            <ul class="contact_form rev">
                                <li>
                                    <div class="field_name"><?php echo $text_prod_rejt; ?></div>
                                    
                                    <div class="star2">
           						        <span class="star-rating">
                                            <input type="radio" name="rating" value="1" /><i></i>
                                        	<input type="radio" name="rating" value="2" /><i></i>
                                        	<input type="radio" name="rating" value="3" /><i></i>
                                        	<input type="radio" name="rating" value="4" /><i></i>
                                        	<input type="radio" name="rating" value="5" /><i></i>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="field_name"><?php echo $text_prod_name; ?></div>
                                    <input type="text" name="rev_name" class="form_input" value="" />
                                </li>
                                <li>
                                    <div class="field_name"><?php echo $text_prod_text; ?></div>
                                    <textarea name="text" class="form_input"></textarea>
                                </li>
                                <li>
                                    <div class="field_name"><?php echo $text_prod_captcha; ?></div>
                                    <img src="index.php?route=product/product/captcha" style="float: left;" alt="" />
                                    <input type="text" class="form_input rev_captcha" name="captcha" value="" />
                                    <div class="clear"></div>
                                </li>
                                <li>
                                    <div class="field_name"></div>
                                    <a href="javascript:;" id="button-review"><?php echo $text_prod_napotzuv; ?></a>
                                </li>
                            </ul>
                            
							
					  <?php } ?>
				</div>
			</div>
		</div>
    <div class="clear"></div>

<?php if ($products) { ?>
   <div class="section leaders clear">
    <div class="title clear"><?php echo $text_prod_sxojitov; ?></div>
    
      <?php foreach ($products as $product) { ?>    
	  
	  <div class="one-fourth">
		<div class="prod_container">
            <div class="one_prod">
      <div>

	<?php $product['price'] = str_replace($text_prod_val,"",$product['price']); ?>
	<?php $product['special'] = str_replace($text_prod_val,"",$product['special']); ?>

	  
		<?php if ($product['special'] != '') { ?> 
			<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_prod_akcimg; ?>" width="60" height="60" alt="akcija" /> 
		<?php } ?>
        <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo str_replace('"',"",$product['name']); ?>" /></a>

		<div class="star">
                        <span class="star-rating">

                        	<img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating'] . '.png'; ?>" alt="" />
                        </span>
                        <div class="control"><a href="<?php echo $product['href']; ?>"><?php echo $product['reviews']?> </a></div>
                    
        </div>
		<div class="name_quant">
            <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <div class="prod_quant"><?php echo $text_prod_kilk; ?> <input type="text" value="1"/></div>
        </div>

		<div class="for_cart clear">
		<?php if ($product['special'] == '') { ?>
			<div class="prod_price"><span><?php echo $product['price']; ?></span><span class="currency"><?php echo $text_prod_val; ?></span></div>
 			<input type="button" value="<?php echo $text_prod_buy; ?>" class="site_button" onclick="addToCart('<?php echo $product['product_id']; ?>');" />
		<?php } else { ?>
            <div class="prod_price" style="height: 53px;margin-top:-8px;">
				<div class="price-old">
					<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
					<span><?php echo $product['special']; ?></span><span class="currency"><?php echo $text_prod_val; ?></span>
				</div>
				<div class="price-new">
					<span><?php echo $product['price']; ?></span><span class="currency"><?php echo $text_prod_val; ?></span>
				</div>
			</div>
 			<input type="button" value="<?php echo $text_prod_buy; ?>" class="site_button" onclick="addToCart('<?php echo $product['product_id']; ?>');" />
		<?php } ?>
        </div>
          <?php echo $product['compare_link_related']; ?>

		  <div class="prod_info">
            <?php foreach ($product['attribute_groups'] as $attribute_group) { ?>
                <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                    <p><?php echo $attribute['name']; ?>: <b><?php echo $attribute['text']; ?></b></p>
                <?php } ?>
            <?php } ?>
		  </div>
      </div>
     <script>
	 $('.control').each(function(){
        var num = parseInt($('.control .count').text());
        if(num == 0 || num == 5 || num == 6 || num == 7 || num == 8 || num == 9 || num == 10 || num == 11 || num == 12 || num == 13 || num == 14 || num == 15 || num == 16 || num == 18 || num == 19 || num == 20 || num == 25){
        	$('.control .count_text').text('<?php echo $text_prod_otzuvov; ?>');
        }
        else  {
        	$('.control .count_text').text('<?php echo $text_prod_otzuvv; ?>');
        }
        /*else if(num == 2 || num == 3 || num == 4 || num == 22 || num == 23 || num == 24) {
        	$('.count_text').text('відгуки');
        }
        else {
        	$('.count_text').text('відгук');
        }*/
	});
	</script>
	  
    </div>
  </div>
</div>
 <?php } ?>
 </div>
 
	<script>
		$('.leaders .one-fourth:last-child').addClass('last');
	</script>
  <?php } ?>
		<?php echo $content_bottom; ?>
		
		<script>
			$('.one-fourth:last-child').addClass('last');
		</script>
		
		</div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<!-- END HOME -->
</div>

<script type="text/javascript">
$(".fancybox").fancybox({
	openEffect	: 'none',
	closeEffect	: 'none'
});

$(".fancybox_delivery").fancybox({
	openEffect	: 'none',
	closeEffect	: 'none',
    afterLoad: function() {
        $.ajax({
            type: 'POST',
            url: 'index.php?route=product/product/getRegions',
            cache: false,
            beforeSend: function() {
    			$('#region').html('<img class="loading" src="/catalog/view/image/load.gif" alt="" />');
                $('#city').html('');
                $('#total_cost').html('');
                $('input[name="delivery_quantity"]').val(1);
    		},
    		complete: function() {
    			$('.loading').remove();
    		},
            success: function(response) {
                if (response) {
                    response = JSON.parse(response);
                    
                    var html = '<select name="region"> \
                                <option value="0"><?php echo $text_prod_vubobl; ?></option>',
                        response_len = response.length;
                    
                    for (var i = 0; i < response_len; i++) {
                        html += '<option value="' + response[i] + '">' + response[i] + '</option>';
                    }
                    
                    html += '</select>';

                    $('#region').html(html);
                }
            },
            
            error:function(xhr, status, errorThrown) { 
                 alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
            }
        });        
    }
});

$(document).on('change', 'select[name="region"]', function() {
    var _this = $(this);
    
    $.ajax({
        type: 'POST',
        url: 'index.php?route=product/product/getRegions',
        data: 'region=' + _this.val(),
        cache: false,
        beforeSend: function() {
			$('#city').html('<img class="loading" src="/catalog/view/image/load.gif" alt="" />');
		},
		complete: function() {
			$('.loading').remove();
		},
        success: function(response) {
            if (response) {
                response = JSON.parse(response);
                
                var html = '<select name="city"> \
                            <option value="0"><?php echo $text_prod_vubgor; ?></option>',
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

$(document).on('click', 'select[name="region"], select[name="city"], input[name="delivery_quantity"]', function() {
    $(this).removeClass('error_input');
});

$('#delivery_cost button').click(function() {
    var _this = $(this);
    
    if ($('select[name="region"]').val() == 0) {
        $('select[name="region"]').addClass('error_input');
        return;
    }
    
    if ($('select[name="city"]').val() == 0) {
        $('select[name="city"]').addClass('error_input');
        return;
    }
    
    var delivery_quantity = $('input[name="delivery_quantity"]');
    
    if (!delivery_quantity.val() || isNaN(delivery_quantity.val()) || parseInt(delivery_quantity.val()) <= 0) {
        delivery_quantity.addClass('error_input');
        return;
    }
    
    $.ajax({
        type: 'POST',
        url: 'index.php?route=product/product',
        data: 'region=' + $('select[name="region"]').val() + '&city=' + $('select[name="city"]').val() + '&delivery_type=' + $('select[name="delivery_type"]').val() + '&delivery_calc=' + true + '&delivery_quantity=' + delivery_quantity.val() + '&product_id=' + <?php echo $product_id; ?>,
        cache: false,
        beforeSend: function() {
			$('#total_cost').html('<img class="loading" src="catalog/view/image/load.gif" alt="" />');
		},
		complete: function() {
			$('.loading').remove();
		},
        success: function(response) {
            if (response) {
                response = JSON.parse(response);
                
                if (response.cost[0]) {
                    $('#total_cost').html('<?php echo $text_prod_totaldost; ?> - ' + response.cost[0] + '<?php echo $text_prod_val; ?>');
                } else {
                    $('#total_cost').html('Error');
                }
                
            }
        },
        
        error:function(xhr, status, errorThrown) { 
             alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
        }
    }); 
});
    
$('#button-cart').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="/catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');

                $('.checkout').removeClass('hide');

                $.fancybox.close();
					
				$('#cart').html('<div class="filled_cart"><span id="cart-total">' + json['total'] + '</span></div>');
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
                
                $(".success").delay(3000).fadeOut();
			}	
		}
	});
});
</script>
<?php if ($options) { ?>
<script type="text/javascript" src="/catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript">
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="/catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
</script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript">
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'rev_name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('.rev input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'rev_name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
			    $('input[name=\'captcha\']').val('');
			}
		}
	});
});
</script> 
<script type="text/javascript">
$('#prod_tabs .title a').tabs();
</script> 

									<div class="b-popup" id="popup1" style="display:none;">
									<div class="b-popup-content">
									<a id="cancel" href="javascript:PopUpHide()"></a>
									<div class="p-content">	
						<?php echo $text_popup_dost; ?>
									</div></div></div>


									<div class="b-popup" id="popup2" style="display:none;">
									<div class="b-popup-content">
									<a id="cancel" href="javascript:PopUpHide2()"></a>
									<div class="p-content">	
						<?php echo $text_popup_opl; ?>
									</div></div></div>



									<div class="b-popup" id="popup3" style="display:none;">
									<div class="b-popup-content">
									<a id="cancel" href="javascript:PopUpHide3()"></a>
									<div class="p-content">	
						<?php echo $text_popup_gar; ?>
									</div></div></div>


<?php echo $footer; ?>