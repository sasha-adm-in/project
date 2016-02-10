<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
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
                                    <li><a href="<?php echo $pref_lang; ?>/news/" class="current"><?php echo $text_blog_news; ?></a></li>
<!--                                    <li><a href="<?php echo $pref_lang; ?>/brands/"><?php echo $text_blog_brends; ?></a></li>-->
                                    <li><a href="<?php echo $pref_lang; ?>/contact/"><?php echo $text_blog_contact; ?></a></li>
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
            <div class="title"><?php echo $heading_title; ?></div>

            <?php echo $description; ?>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 

<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>