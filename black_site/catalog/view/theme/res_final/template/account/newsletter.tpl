<?php $pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }?>
<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
        <div class="one-fourth">
            <div class="sedebar_middle">
                <div class="sidebar_top">
                    <div class="sidebar_bottom">
                        <div class="left_container">
                            <div class="left_sidebar">
                                <ul class="sys_menu">
                                    <li><a href="<?php echo $pref_lang ?>/my-account/"><?php echo $text_mycabinet_options; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/order-history/"><?php echo $text_mycabinet_zakaz; ?></li>
                                    <li><a href="<?php echo $pref_lang ?>/newsletter/"><?php echo $text_mycabinet_pidpr; ?></a></li>
                                    <li><a href="<?php echo $pref_lang ?>/logout/"><?php echo $text_mycabinet_exit; ?></a></li>
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
            
            <div class="content">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td><?php echo $entry_newsletter; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if ($newsletter) { ?>
                                    <input type="radio" name="newsletter" value="1" checked="checked" />
                                    <?php echo $text_yes; ?>&nbsp;
                                    <input type="radio" name="newsletter" value="0" />
                                    <?php echo $text_no; ?>
                                <?php } else { ?>
                                    <input type="radio" name="newsletter" value="1" />
                                    <?php echo $text_yes; ?>&nbsp;
                                    <input type="radio" name="newsletter" value="0" checked="checked" />
                                    <?php echo $text_no; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <br />
                    
                    <input type="submit" value="<?php echo $text_mycabinet_save; ?>" class="button" />
                </form>
			</div>
        </div> 
    </div>
    
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>