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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content"> 
      <form action="<?php echo $action; ?>" method="post" id="form">
        <table id="discounts" class="list">
            <thead>
              <tr>
                <td class="left">От</td>
                <td class="left">До</td>
                <td class="left">Процент</td>
                <td></td>
              </tr>
            </thead>
            <?php $discount_row = 0; ?>
            <?php foreach ($discounts as $discount) { ?>
            <tbody id="discount-row<?php echo $discount_row; ?>">
              <tr>
                <td class="left"><input type="text" name="discounts[<?php echo $discount_row; ?>][discount_from]" value="<?php echo $discount['discount_from']; ?>" /></td>
                <td class="left"><input type="text" name="discounts[<?php echo $discount_row; ?>][discount_to]" value="<?php echo $discount['discount_to']; ?>" /></td>
                <td class="left"><input type="text" name="discounts[<?php echo $discount_row; ?>][percent]" value="<?php echo $discount['percent']; ?>" /></td>
                <td class="left"><a onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
              </tr>
            </tbody>
            <?php $discount_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td class="left">
            		<a onclick="addDicsount();" class="button"><?php echo $button_add_image; ?></a><br/><br/>
            	</td>
              </tr>
            </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDicsount() {
    html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>';
	
	html += '  <td class="left"><input type="text" name="discounts[' + discount_row + '][discount_from]" /></td> \
               <td class="left"><input type="text" name="discounts[' + discount_row + '][discount_to]" /></td> \
               <td class="left"><input type="text" name="discounts[' + discount_row + '][percent]" /></td> \
               <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td> \
            ';
    
	html += '  </tr>';
	html += '</tbody>';
	
	$('#discounts tfoot').before(html);
	
	discount_row++;
}
//--></script>          
	
<?php echo $footer; ?>