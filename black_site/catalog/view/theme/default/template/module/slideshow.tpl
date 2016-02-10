<div class="one-half">
    
        <div class="flexslider" id="index-slider">
          <ul class="slides">
          <?php foreach ($banners as $banner) { ?>
            <?php 
              if ($banner['link']) { ?>
                <li>
                  <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>"  /></a>
                <?php } 
                else { ?>
                    <img src="<?php echo $banner['image']; ?>" />
                <?php } ?>
                </li>       
          <?php } ?>  
              
          </ul><!--END UL SLIDES-->
          
        </div><!--END FLEXSLIDER-->
        
      </div><!--END FULLWIDTH-->