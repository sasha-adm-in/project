<?php echo $header; ?>

<div id="content-wrapper">
    <div class="section big_catalog">
        <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
        <?php } ?>

        <div class="one">
            <div class="title"><?php echo $heading_title; ?></div>
            
            <div class="content">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <p><?php echo $text_email; ?></p>
                    <h2><?php echo $text_your_email; ?></h2>
                    
                    <table class="form">
                        <tr>
                            <td><?php echo $entry_email; ?></td>
                            <td><input style="padding: 0 10px; border: 1px solid #eee;height: 28px;width: 225px;" type="text" name="email" value="" /></td>
                        </tr>
                    </table>
                    <br />

                    <input type="submit" value="<?php echo $text_pass_vidnov; ?>" class="button-link"  />
                </form>
            </div>
        </div> 
    </div>
    <div class="clear"></div>
</div>
<?php echo $footer; ?>