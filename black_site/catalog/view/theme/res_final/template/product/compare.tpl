<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
    <div id="content-wrapper">
    <div class="section">
        <div id="notification"></div>
        <div class="one">
            <div class="adress_line">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				<?php } ?>
            </div>
            <div class="title"><?php echo $heading_title; ?></div>
            
            <?php if ($products) { ?>

                <div id="tabs" class="htabs compared">
                    <a id="show_all" href="javascript:;" class="selected" style="display: inline;"><?php echo $text_compare_title; ?></a>

                    <?php foreach($categories as $key => $category) { ?>
                        <?php if ($category) { ?>
                            <a href="javascript:;" id="<?php echo $key; ?>" class="category_button" style="display: inline;"><?php echo $category; ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>

                <?php foreach($categories_links as $cat) { ?>
                    <a href="<?php echo $cat['cat_href']; ?>" id="cat_<?php echo $cat['cat_id']; ?>" class="compare_link button-link" style="float:right; display: none; margin: 10px 0;"><?php echo $text_compare_addtocomp; ?></a>
                <?php } ?>
																																									<!--&ref=<? echo urlencode($_SERVER['HTTP_REFERER']);?>-->
				<div style="margin: 12px 5px 13px 0;float: right;"><a class="button remove_compare" href="<?php echo $pref_lang; ?>/index.php?route=product/compare&clear=1"><?php echo $text_compare_clear; ?></a></div>
				
              <table class="compare-info">
                <thead>
                  <tr>
                    <td class="compare-product" colspan="<?php echo count($products) + 1; ?>"><?php echo $text_product; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $text_name; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="name_<?php echo $products[$product['product_id']]['category_id']; ?>" class="name"><a href="<?php echo $products[$product['product_id']]['href']; ?>"><?php echo $products[$product['product_id']]['name']; ?></a></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td><?php echo $text_image; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="image_<?php echo $products[$product['product_id']]['category_id']; ?>" class="image"><?php if ($products[$product['product_id']]['thumb']) { ?>
                      <img src="<?php echo $products[$product['product_id']]['thumb']; ?>" alt="<?php echo $products[$product['product_id']]['name']; ?>" />
                      <?php } ?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td><?php echo $text_price; ?></td>
                    <?php foreach ($products as $product) { ?>
                      <td id="price_<?php echo $products[$product['product_id']]['category_id']; ?>" class="price"><?php if ($products[$product['product_id']]['price']) { ?>
                      <?php if (!$products[$product['product_id']]['special']) { ?>
                      <?php echo $products[$product['product_id']]['price']; ?>
                      <?php } else { ?>
                      <span class="price-old"><?php echo $products[$product['product_id']]['special']; ?></span> <span class="price-new"><?php echo $products[$product['product_id']]['price']; ?></span>
                      <?php } ?>
                      <?php } ?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td><?php echo $text_model; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="model_<?php echo $products[$product['product_id']]['category_id']; ?>" class="model"><?php echo $products[$product['product_id']]['model']; ?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td><?php echo $text_manufacturer; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="manufacturer_<?php echo $products[$product['product_id']]['category_id']; ?>" class="manufacturer"><?php echo $products[$product['product_id']]['manufacturer']; ?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <td><?php echo $text_availability; ?></td>
                    <?php foreach ($products as $product) { ?>
						<?php if ($products[$product['product_id']]['availability'] != $text_compare_absent ) { ?>
							<td id="availability_<?php echo $products[$product['product_id']]['category_id']; ?>" class="availability"><?php echo $products[$product['product_id']]['availability']; ?>
						<?php } else {?>
							<?php foreach ($attribute_groups as $attribute_group) { ?>
							<?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>						
								<?php foreach ($products as $product) { ?>
									<?php if (isset($products[$product['product_id']]['attribute'][$key]) and $attribute['name'] == "Термін доставки" ) { ?>
										<?php $days = $products[$product['product_id']]['attribute'][$key]; ?>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							<?php } ?>
							<td id="availability_<?php echo $products[$product['product_id']]['category_id']; ?>" class="availability"><?php echo $text_compare_zak; ?> <?php echo $days; ?>
						<?php } ?>
						</td>
                    <?php } ?>
                  </tr>
            	  <?php if ($review_status) { ?>
                  <tr>
                    <td><?php echo $text_rating; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="rating_<?php echo $products[$product['product_id']]['category_id']; ?>" class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $products[$product['product_id']]['rating']; ?>.png" alt="<?php echo $products[$product['product_id']]['reviews']; ?>" /><br />
                      <?php echo $products[$product['product_id']]['reviews']; ?></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
            	  <tr>
                    <td><?php echo $text_summary; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <td id="description_<?php echo $products[$product['product_id']]['category_id']; ?>" class="description"><?php echo $products[$product['product_id']]['description']; ?></td>
                    <?php } ?>
                  </tr>
                </tbody>
                <?php foreach ($attribute_groups as $attribute_group) { ?>
                <thead>
                  <tr>
                    <td class="compare-attribute" colspan="<?php echo count($products) + 1; ?>"><!--<?php echo $attribute_group['name']; ?>--><?php echo $text_compare_xarakt; ?></td>
                  </tr>
                </thead>
                <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
			<?php if ($attribute['name'] != "Термін доставки" ) { ?>
                <tbody>
                  <tr>
                    <td><?php echo $attribute['name']; ?></td>
                    <?php foreach ($products as $product) { ?>
                        <?php if (isset($products[$product['product_id']]['attribute'][$key])) { ?>
                            <td id="attribute_<?php echo $products[$product['product_id']]['category_id']; ?>" class="attribute"><?php echo $products[$product['product_id']]['attribute'][$key]; ?></td>
                        <?php } else { ?>
                            <td id="attribute_<?php echo $products[$product['product_id']]['category_id']; ?>" class="attribute"></td>

                    <?php } ?>
                    <?php } ?>
                  </tr>
                </tbody>
			<?php } ?>
                <?php } ?>
                <?php } ?>
                <tr>
                  <td></td>
                  <?php foreach ($products as $product) { ?>
                      <td id="cart_<?php echo $products[$product['product_id']]['category_id']; ?>" class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></td>
                  <?php } ?>
                </tr>
                <tr>
                  <td></td>
                  <?php foreach ($products as $product) { ?>
                      <td id="remove_<?php echo $products[$product['product_id']]['category_id']; ?>" class="remove"><a href="<?php echo $product['remove']; ?>" class="button remove_compare"><?php echo $button_remove; ?></a></td>
                  <?php } ?>
                </tr>
              </table>
              <?php } else { ?>
              <div class="content"><?php echo $text_empty; ?></div>
            <?php } ?>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 

<?php echo $content_bottom; ?>

    <script type="text/javascript">
        $('.compared a').click(function() {
            $('.compare_link').hide();

            var cat_id = $(this).attr('id');

            $('#cat_' + cat_id).show();
        });

        $('.category_button').click(function(){
            $(".compare-info tbody tr").each(function() {
                    $(this).show();
            });

            var id = $(this).attr('id');
            $('#show_all').removeClass('selected');
            if ($('.compare-info td').hasClass('equal')) {
                $('.compare-info td').removeClass('equal');
            }
            if ($('.compare-info td').hasClass('different')) {
                $('.compare-info td').removeClass('different');
            }
            if ($('.warning').length > 0) {
                $('.warning').remove();
            }
            $('#equal_diff_button').show();
            $('.name, .image, .price, .model, .manufacturer, .availability, .rating, .description, .weight, .dimension, .attribute, .cart, .remove').hide();
            $('#name_'+id+', #image_'+id+', #price_'+id+', #model_'+id+', #manufacturer_'+id+', #availability_'+id+', #rating_'+id+', #description_'+id+', #weight_'+id+', #dimension_'+id+', #attribute_'+id+', #cart_'+id+', #remove_'+id).show();
            $('.category_button').removeClass('selected');
            $(this).addClass('selected');

            $(".compare-info tbody tr td[id^='attribute_']:visible").each(function() {
                if ($(this).text() == '') {
                    $(this).parent().hide();
                }
            });
        });

        $('#show_all').click(function(){
            $(".compare-info tbody tr").each(function() {
                $(this).show();
            });

            if ($('.compare-info td').hasClass('equal')) {
                $('.compare-info td').removeClass('equal');
            }
            if ($('.compare-info td').hasClass('different')) {
                $('.compare-info td').removeClass('different');
            }
            if ($('.category_button').hasClass('selected')) {
                $('.category_button').removeClass('selected');
            }
            $(this).addClass('selected');
            $('#equal_diff_button').hide();
            $('.name, .image, .price, .model, .manufacturer, .availability, .rating, .description, .weight, .dimension, .attribute, .cart, .remove').show();
        });


    </script>

<?php echo $footer; ?>