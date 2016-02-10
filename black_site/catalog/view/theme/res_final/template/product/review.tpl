<?php if ($reviews) { ?>
    <?php foreach ($reviews as $review) { ?>
        <div class="review" itemprop="review" itemscope="" itemtype="http://schema.org/Review">
		<span itemprop="name" content="<?php echo $heading_title; ?>"></span>
		<div itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" style="display:none">
			<meta itemprop="worstRating" content="1">
			<meta itemprop="bestRating" content="<?php echo $review['rating']; ?>">
			<meta itemprop="ratingValue" content="<?php echo $review['rating']; ?>">
		</div>
            <div class="author"><span itemprop="author"><b><?php echo $review['author']; ?></b></span> <?php echo $text_on; ?> <?php echo $review['date_added']; ?></div>
			<meta itemprop="datePublished" content="<?php echo $review['date_added']; ?>">
            <div class="rating"><img src="catalog/view/theme/res_final/image/stars-<?php echo $review['rating'] . '.png'; ?>" alt="<?php echo $review['reviews']; ?>" /></div>
            <div class="text" itemprop="description"><?php echo $review['text']; ?></div>
        </div>
    <?php } ?>
    <div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
    <div class="content">...</div>
<?php } ?>
