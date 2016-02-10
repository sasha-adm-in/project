	<div class="box">
	  <div class="box-content">
		  <?php foreach ($products as $product) { ?>
		  <div class="box-product">
			<img style="position:absolute;border:none;" draggable="false" src="<?php echo $text_imgakcii ?>" width="60" height="60" alt="akcija">
			<?php if ($product['thumb']) { ?>
			<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
			<?php } ?>
			<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
			<?php if ($product['price']) { ?>

			<div class="prod_price" style="height:53px;margin-top:0px;margin-right:5px;">
			<div class="price-old">
			<hr style="margin: 13px 1% 0 1%;width:98%;height:1px;">
			<span><?php echo $product['special']; ?></span>
			</div>
			<div class="price-new">
			<span><?php echo $product['price']; ?></span>
			</div>
			</div>


			<?php } ?>
			<!--<?php if ($product['rating']) { ?>
			<div class="rating"><img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
			<?php } ?>-->
			<div class="rating"><img src="catalog/view/theme/res_final/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
			<div class="cart-price"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
		  </div>
		  <?php } ?>
	  </div>
	</div>
