<?php if (!$status_input) { ?>
<div class="box">
 <div class="box-heading"><?php echo $heading_title; ?></div>
 <div class="box-content">
  <div class="box-product"><input id="<?php echo $input_id; ?>" type="text" style="display:block;" /></div>
 </div>
</div>
<?php } ?>
<script type="text/javascript">
var key = 0;
$(document).ready(function () {
	var input_id = '<?php echo $input_id; ?>';
	var radio = '';
	
	<?php if ($setting['status_name']) { ?>
	radio += '<input style="display: none" type="radio" name="key_' + key + '" value="name" checked="checked" /> <?php //echo $setting["label_name"]; ?>';
	<?php } if ($setting['status_model']) { ?>
	radio += '<input type="radio" name="key_' + key + '" value="model" /> <?php echo $setting["label_model"]; ?><br />';
	<?php } if ($setting['status_sku']) { ?>
	radio += '<input type="radio" name="key_' + key + '" value="sku" /> <?php echo $setting["label_sku"]; ?><br />';
	<?php } ?>
	
	SearchAjax(input_id, radio);
	key++;
});
</script>