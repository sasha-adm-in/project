<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a><a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left"><?php if ($sort == 'name') { ?>
              <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
              <?php } ?></td>
            <td class="left"><?php echo $column_image; ?></td>
            <td class="right"><?php if ($sort == 'sort_order') { ?>
              <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
              <?php } ?></td>
            <td class="right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($albums) { ?>
          <?php foreach ($albums as $album) { ?>
          <tr>
            <td style="text-align: center;"><?php if ($album['selected']) { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $album['album_id']; ?>" checked="checked" />
              <?php } else { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $album['album_id']; ?>" />
              <?php } ?></td>
            <td class="left"><b><?php echo $album['name']; ?></b><br />
            <span class="help">
            <?php if(!$album['status']){ 
            	echo $text_disabled;
            }else{ 
            	echo $text_enabled;
            } ?>
            </span>
            <span class="help">
            	<?php echo $album['date_added']; ?>
            </span>
            <span class="help">
            	<?php echo $text_viewed. ':' .$album['viewed']; ?>
            </span>
            </td>
            <td class="left"><img src="<?php echo $album['thumb']; ?>" /></td>
            <td class="right"><?php echo $album['sort_order']; ?></td>
            <td class="right"><?php foreach ($album['action'] as $action) { ?>
              [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
              <?php } ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="5"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
    <div class="pagination"><?php echo $pagination; ?></div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
	

$(document).ready(function()
			{
				$('#product').sortable({
					axis: 'y',
					forcePlaceholderSize: true,
					placeholder: 'group_move_placeholder',
					stop: function(event, ui)
					{
						$('#product input[name$="[sort_order]"]').each(function(i)
						{
							$(this).val(i);
						});			
					}
				});
			});

</script>

<?php echo $footer; ?>