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
 <div class="box">
  <div class="heading">
   <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons">
    <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
    <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
   </div>
  </div>
  <div class="content">
   <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <table class="list">
     <tbody>
      <tr>
       <td class="left" width="30%"><?php echo $entry_module_title; ?></td>
       <td class="left">
        <input type="text" name="search_ajax_setting[module_title]" value="<?php echo $search_ajax_setting['module_title']; ?>" size="60" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_image; ?></td>
       <td class="left">
        <input type="text" name="search_ajax_setting[image_width]" value="<?php echo $search_ajax_setting['image_width']; ?>" size="3" />
        x
        <input type="text" name="search_ajax_setting[image_height]" value="<?php echo $search_ajax_setting['image_height']; ?>" size="3" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_limit; ?></td>
       <td class="left">
        <input type="text" name="search_ajax_setting[limit]" value="<?php echo $search_ajax_setting['limit']; ?>" size="3" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_link_target; ?></td>
       <td class="left">
        <select name="search_ajax_setting[link_target]">
         <?php foreach ($link_targets as $link_target) { ?>
         <?php if ($search_ajax_setting['link_target'] == $link_target['target']) { ?>
         <option value="<?php echo $link_target['target']; ?>" selected="selected"><?php echo $link_target['name']; ?></option>
         <?php } else { ?>
         <option value="<?php echo $link_target['target']; ?>"><?php echo $link_target['name']; ?></option>
         <?php } ?>
         <?php } ?>
        </select>
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_search_label; ?></td>
       <td class="left"><input type="text" name="search_ajax_setting[label_search]" value="<?php echo $search_ajax_setting['label_search']; ?>" size="77" /></td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_search_name; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_name']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_name]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_name]" value="1" />
        <?php } ?>
        &nbsp;&nbsp;&nbsp;
        <?php echo $label_text; ?> <input type="text" name="search_ajax_setting[label_name]" value="<?php echo $search_ajax_setting['label_name']; ?>" size="70" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_search_model; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_model']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_model]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_model]" value="1" />
        <?php } ?>
        &nbsp;&nbsp;&nbsp;
        <?php echo $label_text; ?> <input type="text" name="search_ajax_setting[label_model]" value="<?php echo $search_ajax_setting['label_model']; ?>" size="70" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_search_sku; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_sku']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_sku]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_sku]" value="1" />
        <?php } ?>
        &nbsp;&nbsp;&nbsp;
        <?php echo $label_text; ?> <input type="text" name="search_ajax_setting[label_sku]" value="<?php echo $search_ajax_setting['label_sku']; ?>" size="70" />
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_status_image; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_image']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_image]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_image]" value="1" />
        <?php } ?>
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_status_price; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_price']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_price]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_price]" value="1" />
        <?php } ?>
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_status_special; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_special']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_special]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_special]" value="1" />
        <?php } ?>
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_status_rating; ?></td>
       <td class="left">
        <?php if ($search_ajax_setting['status_rating']) { ?>
        <input type="checkbox" name="search_ajax_setting[status_rating]" value="1" checked="checked" />
        <?php } else { ?>
        <input type="checkbox" name="search_ajax_setting[status_rating]" value="1" />
        <?php } ?>
       </td>
      </tr>
      <tr>
       <td class="left"><?php echo $entry_status_description; ?></td>
       <td class="left"><input type="text" name="search_ajax_setting[status_description]" value="<?php echo $search_ajax_setting['status_description']; ?>" size="3" /></td>
      </tr>
     </tbody>
    </table>
    <table id="module" class="list">
     <thead>
      <tr>
       <td class="left" width="9%"><?php echo $entry_status_input; ?></td>
       <td class="left" width="30%"><?php echo $entry_input_id; ?></td>
       <td class="left" width="10%"><?php echo $entry_layout; ?></td>
       <td class="left" width="15%"><?php echo $entry_position; ?></td>
       <td class="left" width="10%"><?php echo $entry_status; ?></td>
       <td class="center" width="12%"><?php echo $entry_sort_order; ?></td>
       <td class="left" width="14%"></td>
      </tr>
     </thead>
     <?php $module_row = 0; ?>
     <?php foreach ($modules as $module) { ?>
     <tbody id="module-row<?php echo $module_row; ?>">
      <tr>
       <td class="center">
        <?php if ($module['status_input']) { ?>
        <?php $display = TRUE; ?>
        <input type="checkbox" name="search_ajax_module[<?php echo $module_row; ?>][status_input]" value="1" checked="checked" onclick="toggleInputId(<?php echo $module_row; ?>);" />
        <?php } else { ?>
        <?php $display = FALSE; ?>
        <input type="checkbox" name="search_ajax_module[<?php echo $module_row; ?>][status_input]" value="1" onclick="toggleInputId(<?php echo $module_row; ?>);" />
        <?php } ?>
       </td>
       <td class="left">
       <?php if ($display) { ?>
       <input type="text" name="search_ajax_module[<?php echo $module_row; ?>][input_id]" value="<?php echo $module['input_id']; ?>" size="60" />
       <?php } else { ?>
       <input type="text" name="search_ajax_module[<?php echo $module_row; ?>][input_id]" value="<?php echo $module['input_id']; ?>" size="60" style="display:none;" />
       <?php } ?>
       </td>
       <td class="left">
        <select name="search_ajax_module[<?php echo $module_row; ?>][layout_id]">
         <?php foreach ($layouts as $layout) { ?>
         <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
         <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
         <?php } else { ?>
         <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
         <?php } ?>
         <?php } ?>
        </select>
       </td>
       <td class="left">
        <select name="search_ajax_module[<?php echo $module_row; ?>][position]">
         <?php if ($module['position'] == 'content_top') { ?>
         <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
         <?php } else { ?>
         <option value="content_top"><?php echo $text_content_top; ?></option>
         <?php } ?>
         <?php if ($module['position'] == 'content_bottom') { ?>
         <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
         <?php } else { ?>
         <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
         <?php } ?>
         <?php if ($module['position'] == 'column_left') { ?>
         <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
         <?php } else { ?>
         <option value="column_left"><?php echo $text_column_left; ?></option>
         <?php } ?>
         <?php if ($module['position'] == 'column_right') { ?>
         <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
         <?php } else { ?>
         <option value="column_right"><?php echo $text_column_right; ?></option>
         <?php } ?>
        </select>
       </td>
       <td class="left">
        <select name="search_ajax_module[<?php echo $module_row; ?>][status]">
         <?php if ($module['status']) { ?>
         <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
         <option value="0"><?php echo $text_disabled; ?></option>
         <?php } else { ?>
         <option value="1"><?php echo $text_enabled; ?></option>
         <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
         <?php } ?>
        </select>
       </td>
       <td class="center"><input type="text" name="search_ajax_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
       <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
      </tr>
     </tbody>
     <?php $module_row++; ?>
     <?php } ?>
     <tfoot>
      <tr>
       <td colspan="6"></td>
       <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
      </tr>
     </tfoot>
    </table>
   </form>
  </div>
 </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '<tr>';
	html += '<td class="center"><input type="checkbox" name="search_ajax_module[' + module_row + '][status_input]" value="1" onclick="toggleInputId(' + module_row + ');" /></td>';
	html += '<td class="left"><input type="text" name="search_ajax_module[' + module_row + '][input_id]" value="" size="60" style="display:none;" /></td>';
	html += '<td class="left"><select name="search_ajax_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '<option value="<?php echo $layout["layout_id"]; ?>"><?php echo $layout["name"]; ?></option>';
	<?php } ?>
	html += '</select></td>';
	html += '<td class="left"><select name="search_ajax_module[' + module_row + '][position]">';
	html += '<option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '<option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '<option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '<option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '</select></td>';
	html += '<td class="left"><select name="search_ajax_module[' + module_row + '][status]">';
	html += '<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	html += '<option value="0"><?php echo $text_disabled; ?></option>';
	html += '</select></td>';
	html += '<td class="center"><input type="text" name="search_ajax_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '<td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	module_row++;
}

function toggleInputId(id) {
	var status_input = $('input[name="search_ajax_module[' + id + '][status_input]"]');
	var input_id = $('input[name="search_ajax_module[' + id + '][input_id]"]');
	if (status_input.attr('checked')) {
		input_id.css({'display':''}).attr('value', '');
	} else {
		input_id.css({'display':'none'}).attr('value', 'search_ajax_' + id);
	}
}
//--></script> 
<?php echo $footer; ?>