<?php if ($banners) { ?>

<?php if ($current_page=='category') { ?>
<div class="one-half tor<?php echo $module; ?>" style="width:100% !important;">
    <div class="flexslider" id="index-slider<?php echo $module; ?>">
        <ul class="slides">
            <?php foreach ($banners as $banner) { ?>
            <?php if ($banner['category_id'] != $category_id) continue; ?>
                <li>
                    <?php if ($banner['link']) { ?>
                        <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo $banner['image']; ?>" />
                    <?php } ?>
                </li>       
            <?php } ?>  
        </ul>
    </div>
</div>
<?php } else { ?>
<div class="one-half tor<?php echo $module; ?>">
    <div class="flexslider" id="index-slider<?php echo $module; ?>">
        <ul class="slides">
            <?php foreach ($banners as $banner) { ?>
            <?php if ($banner['category_id'] != $category_id) continue; ?>
                <li>
                    <?php if ($banner['link']) { ?>
					<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
                        <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo $banner['image']; ?>" />
                    <?php } ?>
                </li>       
            <?php } ?>  
        </ul>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#index-slider<?php echo $module; ?>').flexslider({
    animation: "fade",
    slideDirection: "",
    slideshowSpeed: 4500,
    animationDuration: 500,
    pauseOnHover: true,
    smoothHeight: true
  });
  $('#index-slider1').flexslider({
    animation: "fade",
    slideDirection: "",
    slideshowSpeed: 4000,
    animationDuration: 500,
    pauseOnHover: true,
    smoothHeight: true
  });

});

</script>

<?php } ?>