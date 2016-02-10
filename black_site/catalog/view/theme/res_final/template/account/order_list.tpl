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
                <?php if ($orders) { ?>
                    <?php foreach ($orders as $order) { ?>
                        <div class="order-list">
                            <div class="order-id"><b><?php echo $text_order_id; ?></b> #<?php echo $order['order_id']; ?></div>
                            <div class="order-status"><b><?php echo $text_status; ?></b> <?php echo $order['status']; ?></div>
                            <div class="order-content">
                                <div><b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
                                <b><?php echo $text_products; ?></b> <?php echo $order['products']; ?><br />
                                <b><?php echo $text_products_count; ?></b> <?php echo $order['products_count']; ?></div>
                                <div>
                                    <b><?php echo $text_customer; ?></b> <?php echo $order['name']; ?><br />
                                    <b><?php echo $text_total; ?></b> <?php echo $order['total']; ?><br />
                                    <b><?php echo $text_mycabinet_totals; ?></b> <?php echo $order['total_with_discount']; ?>
                                </div>
                                <div class="order-info"><a href="<?php echo $order['href']; ?>"><img src="catalog/view/theme/default/image/info.png" alt="<?php echo $button_view; ?>" title="<?php echo $button_view; ?>" /></a></div>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="pagination"><?php echo $pagination; ?></div>
                <?php } else { ?>
                    <?php echo $text_empty; ?>
                <?php } ?>
			</div>
        </div> 
    </div>
    
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>