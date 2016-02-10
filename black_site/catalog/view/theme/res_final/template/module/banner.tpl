<?php if ($banners) { ?>

<div class="one-half mp_catalog">
    <?php foreach ($banners as $banner) { ?>
    <?php if ($banner['category_id'] != $category_id) continue; ?>
        <?php // echo $banner['category_id'] .'----'. $category_id;?>
        <div class="one-half">
            <?php if ($banner['link']) { ?> 
                <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
                <!--<div class="input_block">
                    <input type="button" value="<?php //echo $banner['title']; ?>"/>
                </div> -->
            <?php } else { ?>
                <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image'];?>" /> </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<script>
$('.mp_catalog .one-half:nth-child(2)').addClass('last');
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
  $('#banner<?php echo $module; ?> div:first-child').css('display', 'block');
});

var banner = function() {
  $('#banner<?php echo $module; ?>').cycle({
    before: function(current, next) {
      $(next).parent().height($(next).outerHeight());
    }
  });
}

setTimeout(banner, 2000);
//--></script>

<?php } ?>