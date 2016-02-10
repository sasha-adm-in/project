<?php if($options || $manufacturers || $attributes || $price_slider) { ?>

	<div class="box-content">
		<!-- <div style="height: 15px><a class="clear_filter"><?php echo $clear_filter?></a></div> -->
		<form id="filterpro">
			<?php if($manufacturers) { ?>
			<?php foreach($manufacturers as $manufacturer) { ?>
				<input type="hidden" class="m_name" id="m_<?php echo $manufacturer['manufacturer_id']?>" value="<?php echo $manufacturer['name']?>">
				<?php } ?>
			<?php } ?>

			<?php if($options) { ?>
			<?php foreach($options as $option) { ?>
				<?php foreach($option['option_values'] as $option_value) { ?>
					<input type="hidden" class="o_name" id="o_<?php echo $option_value['option_value_id']?>" value="<?php echo $option_value['name']?>">
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
			<input type="hidden" name="page" id="filterpro_page" value="0">
			<input type="hidden" name="path" value="<?php echo $path ?>">
			<input type="hidden" name="sort" id="filterpro_sort" value="">
			<input type="hidden" name="order" id="filterpro_order" value="">
			<input type="hidden" name="limit" id="filterpro_limit" value="">
			
			
			<?php if($manufacturers && count($manufacturers) > 1) { ?>
			<div class="one_filter">
				<div class="title"><?php echo $text_manufacturers; ?></div>
				<?php if($display_manufacturer == 'select') { ?>
				<div class="collapsible">
					<select name="manufacturer[]" class="filtered">
						<option value=""><?php echo $text_all?></option>
						<?php foreach($manufacturers as $manufacturer) { ?>
						<option id="manufacturer_<?php echo $manufacturer['manufacturer_id']?>" class="manufacturer_value" value="<?php echo $manufacturer['manufacturer_id']?>"><?php echo $manufacturer['name']?></option>
						<?php } ?>
					</select>
				</div>
				<?php } elseif($display_manufacturer == 'checkbox') { ?>
				<table class="collapsible">
					<?php foreach($manufacturers as $manufacturer) { ?>
					<tr>
						<td>
							<input id="manufacturer_<?php echo $manufacturer['manufacturer_id']?>" class="manufacturer_value filtered"
								   type="checkbox" name="manufacturer[]"
								   value="<?php echo $manufacturer['manufacturer_id']?>">
						</td>
						<td>
							<label for="manufacturer_<?php echo $manufacturer['manufacturer_id']?>"><?php echo $manufacturer['name']?></label>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } elseif($display_manufacturer == 'radio') { ?>
				<table class="collapsible">
					<?php foreach($manufacturers as $manufacturer) { ?>
					<tr>
						<td>
							<input id="manufacturer_<?php echo $manufacturer['manufacturer_id']?>" class="manufacturer_value filtered"
								   type="radio" name="manufacturer[]"
								   value="<?php echo $manufacturer['manufacturer_id']?>">
						</td>
						<td>
							<label for="manufacturer_<?php echo $manufacturer['manufacturer_id']?>"><?php echo $manufacturer['name']?></label>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php }?>
			</div>
			
			<?php } ?>
			
			
			
			<?php if ($attributes) { ?>
			<?php foreach($attributes as $attribute_group_id => $attribute) { ?>
			<div class="option_box">
				<!--<div class="attribute_group_name"><?php echo $attribute['name']; ?></div>-->
				<?php foreach($attribute['attribute_values'] as $attribute_value_id => $attribute_value) { ?>
                    <?php if (count($attribute_value['values']) > 1) { ?>
			<?php if ($attribute_value['name'] == 'Температура експлуатації, °С' and $category_id == '35'
			or $attribute_value['name'] == 'Розмір' and $category_id == '145'
			) {?> <!-- УБрать параметр/характеристику фильтра в определённой категории -->
			<?php } else {?>
						<div class="attribute_box">
                            <div class="option_name">
                                <span><?php echo $attribute_value['name']; ?></span>

                                <?php if ($attribute_value['description']) { ?>
                                    <div class="tooltip">
                                        <span class="custom help">
                                            <img src="/catalog/view/theme/res_final/images/Help.png" alt="<?php echo $text_filter_help; ?>" height="48" width="48">
                                            <em><?php echo $text_home_title; ?><?php echo $text_filter_help; ?></em> <?php echo $attribute_value['description']; ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if($attribute_value['display'] == 'select') { ?>
                            <div class="collapsible">
                                <select class="filtered" name="attribute_value[<?php echo $attribute_value_id?>][]">
                                    <option value=""><?php echo $text_all?></option>
                                    <?php foreach($attribute_value['values'] as $i => $value) { ?>
                                    <option class="a_name"
                                            at_v_i="<?php echo $attribute_value_id . '_' . $value ?>"
                                            at_v_t="<?php echo $attribute_value_id . '_' . $value ?>"
                                            data-value = "<?php echo $value ?>"
                                            value="<?php echo $value ?>"><?php echo $value ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <?php } elseif($attribute_value['display'] == 'checkbox') {?>
                            <table class="collapsible">
                                <?php foreach($attribute_value['values'] as $i => $value) { ?>
                                <tr>
                                    <td>
                                        <input class="filtered a_name"
                                               id="attribute_value_<?php echo $attribute_value_id . $i; ?>"
                                               type="checkbox" name="attribute_value[<?php echo $attribute_value_id?>][]"
                                               at_v_i="<?php echo $attribute_value_id . '_' . $value ?>"
                                               value="<?php echo $value ?>">
                                    </td>
                                    <td>
                                        <label for="attribute_value_<?php echo $attribute_value_id . $i; ?>"
                                               at_v_t="<?php echo $attribute_value_id . '_' . $value ?>"
                                               data-value = "<?php echo $value ?>"
                                               value="<?php echo $value ?>"><?php echo $value?></label>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                            <?php } elseif($attribute_value['display'] == 'radio') {?>
                            <table class="collapsible">
                                <?php foreach($attribute_value['values'] as $i => $value) { ?>
                                <tr>
                                    <td>
                                        <input class="filtered a_name"
                                               id="attribute_value_<?php echo $attribute_value_id . $i; ?>"
                                               type="radio" name="attribute_value[<?php echo $attribute_value_id?>][]"
                                               at_v_i="<?php echo $attribute_value_id . '_' . $value ?>"
                                               value="<?php echo $value ?>">
                                    </td>
                                    <td>
                                        <label for="attribute_value_<?php echo $attribute_value_id . $i; ?>"
                                                at_v_t="<?php echo $attribute_value_id . '_' . $value ?>"
                                                data-value = "<?php echo $value ?>"
                                                value="<?php echo $value ?>"><?php echo $value?></label>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                            <?php }?>
                        </div>
			<?php } ?>
                    <?php } ?>
				<?php } ?>
			</div>
			<?php } ?>
			<?php } ?>

			<?php if($options) { ?>
			<?php foreach($options as $option) { ?>
			<div class="option_box">
				<div class="option_name"><?php echo $option['name']; ?></div>
				<?php if($option['display'] == 'select') { ?>
				<div class="collapsible">
					<select class="filtered" name="option_value[<?php echo $option['option_id']?>][]">
						<option value=""><?php echo $text_all?></option>
						<?php foreach($option['option_values'] as $option_value) { ?>
						<option class="option_value" id="option_value_<?php echo $option_value['option_value_id']?>" value="<?php echo $option_value['option_value_id'] ?>"><?php echo $option_value['name']?></option>
						<?php }?>
					</select>
				</div>
				<?php } elseif($option['display'] == 'checkbox') {?>
					<table class="collapsible">
						<?php foreach($option['option_values'] as $option_value) { ?>
						<tr>
							<td>
								<input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>"
									   type="checkbox" name="option_value[<?php echo $option['option_id']?>][]"
									   value="<?php echo $option_value['option_value_id']?>">
							</td>
							<td>
								<label for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
							</td>
						</tr>
						<?php } ?>
					</table>
				<?php } elseif($option['display'] == 'radio') {?>
				<table class="collapsible">
					<?php foreach($option['option_values'] as $option_value) { ?>
					<tr>
						<td>
							<input class="filtered option_value" id="option_value_<?php echo $option_value['option_value_id']?>"
								   type="radio" name="option_value[<?php echo $option['option_id']?>][]"
								   value="<?php echo $option_value['option_value_id']?>">
						</td>
						<td>
							<label for="option_value_<?php echo $option_value['option_value_id']?>"><?php echo $option_value['name']?></label>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php }?>
			</div>
			<?php } ?>
			<?php } ?>


			

			<div class="one_filter" style="width:225px;<?php if(!$price_slider) {echo ' display:none;';}?>" >
				<div class="title"><?php echo $text_price_range?></div>
				<table>
					<tr>
					    <td class="price_pad"><?php echo $text_filter_ot; ?></td>
						<td><input class="price_limit" type="text" name="min_price" value="-1" id="min_price"/></td>
						<td class="price_pad"><?php echo $text_filter_do; ?></td>
						<td><input class="price_limit" type="text" name="max_price" value="-1" id="max_price"/></td>
					</tr>
				</table> 
				
			<div id="slider-range" style="margin-top:12px;"></div>

			</div>

		
		
		
		
		</form>

<script id="productTemplate" type="text/x-jquery-tmpl">
    <div class="one-third">
    		<div class="prod_container">
                <div class="one_prod">
		{{if special != ""}}
			<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_filter_akcimg; ?>" width="60" height="60" alt="akcija" /> 
		{{/if}}
           <a class="prod_img" href="${href}"><img src="${thumb}" alt="${name}"/></a>
           
          <div class="prod_about">
        	  <div class="star">
        		<span class="star-rating">
                    <img src="catalog/view/theme/res_final/image/stars-${rating}.png" alt="" />
        		</span>
				<!--<span>${sku}</span>-->
              </div>
        	  <div class="name_quant">
        		  <div class="prod_name"><a href="${href}">${name}</a></div>

				  {{each(attribute_group, val) attribute_groups2}}
                        {{each(prop, val) val}}
                            {{if prop == "attribute"}}
                                {{each(prop, val) val}}
						  {{if val.name != text_filter_term }}
						  {{else days=val.text}}
						  {{/if}}
                                {{/each}}
                            {{/if}}
                        {{/each}}
                    {{/each}}

				  
          		{{if quantity > 0}}
					<span><?php echo $text_filter_available; ?> ${quantity} ${unit}</span>
				{{else}}
					<span style="color:#7AAF1B;"><img src="/catalog/view/theme/res_final/image/deliver.png" alt="<?php echo $text_filter_dostavka; ?>" style="width:23px; height:14px; margin-bottom: -2px;"><?php echo $text_filter_podzak; ?> ${days}</span>
				{{/if}}

        		  <div class="prod_quant quant_p_${product_id}"><?php echo $text_filter_kolvo; ?> <input type="text" value="1"/></div>
        	  </div>
        	  <div class="for_cart clear">

					{{if special == ""}}
						<div class="prod_price">
							<span>${price}</span>
						</div>
						<input type="button" onclick="addToCart('${product_id}', $('.quant_p_${product_id} input[type=\'text\']').val());" value="<?php echo $text_filter_buy; ?>" class="site_button"/>
					{{else}}
						<div class="prod_price" style="height:53px;margin-top:-8px;" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
						<div class="price-old">
						<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
							<span>${special}</span>
						</div>
						<div class="price-new">
							<span>${price}</span>
						</div>
						</div>
						<input type="button" onclick="addToCart('${product_id}', $('.quant_p_${product_id} input[type=\'text\']').val());" value="<?php echo $text_filter_buy; ?>" class="site_button"/>
					{{/if}}

					
              </div>
			  {{if price == "0.00 <?php echo $text_filter_cur; ?>"}}
				<span><?php echo $text_filter_cenyyto4; ?></span><br />
			  {{/if}}
        	   {{html compare_link}}
          </div>
          
    			<div class="prod_info">
    				{{each(attribute_group, val) attribute_groups}}

                        {{each(prop, val) val}}

                            {{if prop == "attribute"}}

                                {{each(prop, val) val}}

							{{if val.name != text_filter_term }}
									<p>${val.name}: <b>${val.text}</b></p>
							{{/if}}

                                {{/each}}

                            {{/if}}

                        {{/each}}

                    {{/each}}
    			</div>
    	   </div>
    	</div>
    </div>
</script>
</div>

<?php } ?>