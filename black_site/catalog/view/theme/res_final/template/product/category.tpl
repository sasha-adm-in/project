<?php
    echo $header;

    $path = $this->request->get['path'];
    $arr = explode('_',$path);
    $size = count($arr);
    if ($size == 1) {
?>

<div id="content-wrapper">

    <div class="section for_slider">
        <div class="adress_line">
            <div xmlns:v="http://rdf.data-vocabulary.org/#">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?><span typeof="v:Breadcrumb"><a href="<?php echo $breadcrumb['href']; ?>" rel="v:url" property="v:title"><?php echo $breadcrumb['text']; ?></a></span>
            <?php } ?>
            </div>
        </div>

        <div id="notification"></div>
		<div id="notification2"></div>

    	<?php echo $content_top; ?>

    </div>

<div class="section one_catalog clear">


  <?php if ($categories) { ?>
  <div class="title clear"><h1><?php echo $heading_title; ?></h1></div>

      <?php foreach ($categories as $category) { ?>
	   <div class="one-fifth">
            <a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>"/></a>
            <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        </div>
      <?php } ?>



  <?php } ?>

  <?php if (!$categories && !$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php } ?>
  </div>
  </div>

<?php } else { ?>

<div id="content-wrapper">
    <div class="section big_catalog">
	<div id="notification"></div>
	<div id="notification2"></div>


		<div class="one-fourth">
		  <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
								<?php echo $column_left; ?>
						</div>
					</div>
				</div>
		  </div>
		</div>

		<div class="three-fourth last">
            <div class="adress_line" id="adress_line">
                <div xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <?php echo $breadcrumb['separator']; ?><span typeof="v:Breadcrumb"><a href="<?php echo $breadcrumb['href']; ?>" rel="v:url" property="v:title"><?php echo $breadcrumb['text']; ?></a></span>
                <?php } ?>
                </div>
            </div>

		<div class="section for_slider" style="width:100%;">
    	<?php echo $content_top; ?>
		</div>

            <div class="title"><h1><?php echo $heading_title; ?></h1></div>
            <?php if (isset($categories) && $categories) { ?>
                <div class="grid row6 items">
    				<?php foreach ($categories as $category) { ?>
    					<div>
    						<a href="<?php echo $category['href']; ?>"><img style="width:80px;" src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>"/></a>
    						<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
    					</div>
    				<?php } ?>
                </div>
            <?php } ?>
            <!--<select>
            <?php //foreach ($sorts as $sorts) { ?>
                <option value="<?php //echo $sorts['href']; ?>"><?php //echo $sorts['text']; ?></option>
            <?php //} ?>
            </select>-->
            <div class="view_items clear">
                <div class="sort">
                    <span><?php echo $text_cat_vuvod; ?> </span>
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
                <div class="view_type">
                    <a href="javascript:" class="current" id="view_block"><img alt="" src="catalog/view/theme/res_final/images/block.png"/></a>
                    <a href="javascript:" id="view_list"><img alt="" src="catalog/view/theme/res_final/images/table.png"/></a>
                </div>
            </div>


				<?php if ($products) { ?>

					<div class="product-list" id="prod_section">
                        <?php foreach ($products as $product) { ?>
                        <div class="one-third">
                            <div class="prod_container">
                                <div class="one_prod">
                        		<?php if ($product['special']){ ?>
                        			<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_akcimg; ?>" width="60" height="60" alt="akcija" />
                        		<?php } ?>
                                    <?php $pr_s = array("'",'"'); ?>
                                    <?php $pr_name = str_replace($pr_s,'',$product['name']); ?>
                                   <a class="prod_img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $pr_name; ?>" alt="<?php echo $pr_name; ?>"/></a>
                                    <div class="prod_about">
                                	  <div class="star">
                                		<span class="star-rating">
                                            <img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
                                		</span>
                                      </div>
                                	  <div class="name_quant">
                                		  <div class="prod_name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>

                                      		<?php if ($product['quantity'] > 0) { ?>
                            					<span><?php echo $text_available . ' : ' . $product['quantity'] . ' ' . $product['unit'] ?></span>
                            				<?php } else { ?>
                            					<span style="color:#7AAF1B;"><img src="/catalog/view/theme/res_final/image/deliver.png" alt="<?php echo $text_dostavka; ?>" style="width:23px; height:14px; margin-bottom: -2px;"><?php echo $text_podzak . ' ' . $product['days']; ?></span>
                            				<?php } ?>

                                    		<div class="prod_quant quant_p_<?php echo $product_id; ?>"><?php echo $text_quantity; ?> <input type="text" value="1"/></div>
                                      </div>
                                      <div class="for_cart clear">
                                        <?php if (!$product['special']){ ?>
                    						<div class="prod_price">
                    							<span><?php echo $product['price']; ?></span>
                    						</div>
                    						<input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>');" value="<?php echo $text_buy; ?>" class="site_button"/>
                    					<?php } else { ?>
                    						<div class="prod_price" style="height:53px;margin-top:-8px;">
                    						<div class="price-old">
                    						<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
                    							<span><?php echo $product['special']; ?></span>
                    						</div>
                    						<div class="price-new">
                    							<span><?php echo $product['price']; ?></span>
                    						</div>
                    						</div>
                    						<input type="button" onclick="addToCart('<?php echo $product['product_id']; ?>');" value="<?php echo $text_buy; ?>" class="site_button"/>
                    					<?php } ?>
                                      </div>
                                      <?php if ($product['price'] == "0.00 грн."){ ?>
                        				<span><?php echo $text_cenyyto4; ?></span><br />
                        			  <?php } ?>
                                      <?php echo $product['compare_link']; ?>

                    				</div>
                                    <div class="prod_info">
                                        <?php foreach ($product['attribute_groups'] as $attribute_group) { ?>
                                            <?php foreach ($attribute_group as $prop) { ?>
                                                <?php foreach ($prop as $key => $attribute) { ?>
                                                    <p><?php echo $attribute['name']; ?>: <b><?php echo $attribute['text']; ?></b></p>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                    		        </div>
                        	   </div>
                        	</div>
                        </div>
                        <?php } ?>

					<div class="clear"></div>
					<div class="pagination"><?php echo $pagination; ?></div>

					<script type="text/javascript">

							$(document).ready(function() {
								$("#select").selectbox();
							});

					</script>

				<?php } ?>

				<?php if ($thumb || $description) { ?>
				<div class="category-info">
				<?php if ($thumb) { ?>
				<!--//*<div class="image" style="float:left; padding:0 10px 10px 0;"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>*/-->
				<?php } ?>
				<?php if ($description && $page=='') { ?>
				<div style="float:left;"><?php echo $description; ?></div>
				<?php } ?>
				</div>
				<?php } ?>

		</div>





<?php } ?>

<script>
    var cats = $('.one-fifth');

    for (var i = 4, cats_len = cats.length; i < cats_len; i += 5) {
        cats.eq(i).addClass('last');
    }
</script>

</div>
</div>
<div class="clear"></div>
<?php echo $content_bottom; ?>
<script type="text/javascript"><!--
//function display(view) {
//	if (view == 'list') {
//	    $.cookie("display", "list");
//
//		$('.product-grid').attr('class', 'product-list');
//
//		$('.product-list > div').each(function(index, element) {
//			html  = '<div class="right">';
//			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
//			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
//			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
//			html += '</div>';
//
//			html += '<div class="left">';
//
//			var image = $(element).find('.image').html();
//
//			if (image != null) {
//				html += '<div class="image">' + image + '</div>';
//			}
//
//			var price = $(element).find('.price').html();
//
//			if (price != null) {
//				html += '<div class="price">' + price  + '</div>';
//			}
//
//			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
//			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
//
//			var rating = $(element).find('.rating').html();
//
//			if (rating != null) {
//				html += '<div class="rating">' + rating + '</div>';
//			}
//
//			html += '</div>';
//
//			$(element).html(html);
//		});
//
//		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
//
//		$.totalStorage('display', 'list');
//	} else {
//	    $.cookie("display", "grid");
//
//		$('.product-list').attr('class', 'product-grid');
//
//		$('.product-grid > div').each(function(index, element) {
//			html = '';
//
//			var image = $(element).find('.image').html();
//
//			if (image != null) {
//				html += '<div class="image">' + image + '</div>';
//			}
//
//			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
//			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
//
//			var price = $(element).find('.price').html();
//
//			if (price != null) {
//				html += '<div class="price">' + price  + '</div>';
//			}
//
//			var rating = $(element).find('.rating').html();
//
//			if (rating != null) {
//				html += '<div class="rating">' + rating + '</div>';
//			}
//
//			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
//			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
//			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
//
//			$(element).html(html);
//		});
//
//		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
//
//		$.totalStorage('display', 'grid');
//	}
//}
//
//view = $.totalStorage('display');

//if (view) {
//	display(view);
//} else {
//	display('list');
//}
//--></script>
<?php echo $footer; ?>