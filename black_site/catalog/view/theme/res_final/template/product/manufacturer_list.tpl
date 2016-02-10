<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section big_catalog">
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul>
                                    <?php foreach ($informations as $information) { ?>
                                        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo $pref_lang; ?>/news/"><?php echo $text_manuflist_news; ?></a></li>
<!--                                    <li><a href="<?php echo $pref_lang; ?>/brands/" class="current"><?php echo $text_manuflist_brends; ?></a></li>-->
                                    <li><a href="<?php echo $pref_lang; ?>/contact/"><?php echo $text_manuflist_contact; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="three-fourth last">
            <div class="adress_line">
                 <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				 <?php } ?>
            </div>
            <div class="title"><?php echo $text_manuflist_brends; ?></div>
            <div class="content">
                  <?php if ($categories) { ?>
                      <p class="brands_categories"><b><?php echo $text_index; ?></b>
                        <?php foreach ($categories as $category) { ?>
                        &nbsp;&nbsp;&nbsp;<a href="brands/#<?php echo $category['name']; ?>"><b><?php echo $category['name']; ?></b></a>
                        <?php } ?>
                      </p>
                      <div class="brands">
                          <?php foreach ($categories as $category) { ?>
                              <?php if ($category['manufacturer']) { ?>
                                  <?php for ($i = 0; $i < count($category['manufacturer']); $i++) { ?>
                                    <?php if (isset($category['manufacturer'][$i])) { ?>
                                        <div class="one-fourth brand">
                                            <a id="<?php echo $category['name']; ?>"></a>
                                            <a href="<?php echo $category['manufacturer'][$i]['href']; ?>" class="brand_name"><?php echo $category['manufacturer'][$i]['name']; ?></a>
                                            <a href="<?php echo $category['manufacturer'][$i]['href']; ?>" class="brand_img">
                                                <img src="<?php echo $category['manufacturer'][$i]['thumb']; ?>" alt="" />
                                            </a>
                                        </div>
                                    <?php } ?>                          
                                  <?php } ?>                          
                              <?php } ?>
                          <?php } ?>
                      </div>
                      <script type="text/javascript">
                        $('.brand:nth-child(4n)').addClass('last');
                      </script>
                  <?php } else { ?>
                    <?php echo $text_manuflist_brendsabs; ?>
                  <?php } ?>	  
			</div>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>