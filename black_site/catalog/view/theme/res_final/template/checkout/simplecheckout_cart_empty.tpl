<?php 
$simple_page = '';
include $simple->tpl_header();
include $simple->tpl_static();
?>
<div id="content-wrapper">
    <div class="section big_catalog">
        <div class="one">
            <div class="content">
                <?php echo $text_error; ?><br /><br /><br />
                <a href="<?php echo $continue; ?>" class="button-link"><<<</a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php include $simple->tpl_footer() ?>