<?php if (count($languages) > 1) { ?>
<?php echo $text_language; ?>&nbsp;
<?php foreach ($languages as $language) {
if ($language['code'] != $language_code) {
?>
<a href="<?php echo $language['url']; ?>"><?php } ?><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /><?php if ($language['code'] != $language_code) { ?></a>
<?php } } ?>
<?php } ?>
<script>
$(document).ready(function() {
	var lprefix = '<?php  echo $language_prefix; ?>';

	$('form').each(function(index) {
		var laction = $(this).attr('action');
		if (typeof laction!='undefined') {
		 if (typeof laction.value!='undefined') {
			var llast = laction.value.length - 1;
			if (llast != '/') {
				laction = laction + '/';
			}
			var li = laction.indexOf( lprefix);
			if (li < 0) {
				$(this).attr('action', laction + lprefix);
			}
		 }
		}
	});
});
</script>