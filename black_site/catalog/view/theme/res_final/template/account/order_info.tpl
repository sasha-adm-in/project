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
            
            <div class="title"><?php echo $heading_title; ?> #<?php echo $order_id; ?></div>
            
            <div class="content">
                  <table class="list">
                    <thead>
                      <tr>
                        <td class="left" colspan="2"><?php echo $text_order_detail; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="left" style="width: 50%;"><?php if ($invoice_no) { ?>
                          <b><?php echo $text_invoice_no; ?></b> <?php echo $invoice_no; ?><br />
                          <?php } ?>
                          <b><?php echo $text_order_id; ?></b> #<?php echo $order_id; ?><br />
                          <b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?></td>
                        <td class="left" style="width: 50%;"><?php if ($payment_method) { ?>
                          <b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
                          <?php } ?>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="list">
                    <thead>
                      <tr>
                        <?php if ($shipping_address) { ?>
                        <td class="left"><?php echo $text_shipping_address; ?></td>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php if ($shipping_address) { ?>
                        <td class="left"><?php echo $shipping_address; ?></td>
                        <?php } ?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="list">
                    <thead>
                      <tr>
                        <td class="left"><?php echo $column_name; ?></td>
                        <td class="left"><?php echo $column_model; ?></td>
                        <td class="right"><?php echo $column_quantity; ?></td>
                        <td class="right"><?php echo $column_price; ?></td>
                        <td class="right"><?php echo $column_total; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($products as $product) { ?>
                      <tr>
                        <td class="left"><?php echo $product['name']; ?>
                          <?php foreach ($product['option'] as $option) { ?>
                          <br />
                          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                          <?php } ?></td>
                        <td class="left"><?php echo $product['model']; ?></td>
                        <td class="right"><?php echo $product['quantity']; ?></td>
                        <td class="right"><?php echo $product['price']; ?></td>
                        <td class="right"><?php echo $product['total']; ?></td>
                      </tr>
                      <?php } ?>
                      <?php foreach ($vouchers as $voucher) { ?>
                      <tr>
                        <td class="left"><?php echo $voucher['description']; ?></td>
                        <td class="left"></td>
                        <td class="right">1</td>
                        <td class="right"><?php echo $voucher['amount']; ?></td>
                        <td class="right"><?php echo $voucher['amount']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <?php foreach ($totals as $total) { ?>
                      <tr>
                        <td colspan="3"></td>
                        <td class="right"><b><?php echo $total['title']; ?>:</b></td>
                        <td class="right"><?php echo $total['text']; ?></td>
                      </tr>
                      <?php } ?>
                      <!--<tr>
                        <td colspan="3"></td>
                        <td class="right"><b>Сумма зі знижкою:</b></td>
                        <td class="right"><?php echo $total_with_discount; ?></td>
                      </tr>-->
                    </tfoot>
                  </table>
                  <?php if ($comment) { ?>
                  <table class="list">
                    <thead>
                      <tr>
                        <td class="left"><?php echo $text_comment; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="left"><?php echo $comment; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php } ?>
                  <?php if ($histories) { ?>
                  <h2><?php echo $text_history; ?></h2>
                  <table class="list">
                    <thead>
                      <tr>
                        <td class="left"><?php echo $column_date_added; ?></td>
                        <td class="left"><?php echo $column_status; ?></td>
                        <td class="left"><?php echo $column_comment; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($histories as $history) { ?>
                      <tr>
                        <td class="left"><?php echo $history['date_added']; ?></td>
                        <td class="left"><?php echo $history['status']; ?></td>
                        <td class="left"><?php echo $history['comment']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php } ?>
			</div>
        </div> 
    </div>
    
    <div class="clear"></div>
</div><!--END CONTENT-WRAPPER--> 
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>