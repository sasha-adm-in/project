<?php echo $header; ?>
<div id="content-wrapper">
    <div class="section">
        <div class="one">
            <div class="adress_line">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				<?php } ?>
            </div>
            <div class="title"><?php echo $heading_title; ?></div>
			 <div style="height:500px;">
             <div style="font-size:20px; position:absolute; left:50%; margin-left:-210px; color:red;"><?php echo $text_error_404; ?></div>
			 <div style="font-size:20px; margin-top:31px; position:absolute; left:50%; margin-left:-210px;"><H1><?php echo $text_error_stornezn; ?></H1></div>
			 <div style="font-size:16px; text-align:left; line-height:1.5; position:absolute; left:50%; margin-left:-208px; margin-top: 70px; z-index:1">
			  <?php echo $text_error_soobw; ?>
			 </div>
			 <!--<?php echo $text_error; ?>-->
			 
			 
			 <!--
    <div class="search" style="margin-top:120px; position:absolute; left:50%; margin-left:-285px;">
        <input type="text" id="search-link" placeholder="Що Ви хочете знайти?"/>
        <input type="button" id="search-me" value="Знайти" class="button"/>
        <div class="search_example">
            Наприклад: <a style="cursor:pointer" id="search-example">лампа</a>
        </div>
    </div>
			 -->
			 
			 
			 
			</div>
        </div> 
    </div>
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 

<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>