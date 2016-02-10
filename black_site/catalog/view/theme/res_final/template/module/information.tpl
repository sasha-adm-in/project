<ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
	  <li><a href="/blog"><?php echo $text_info_news; ?></a></li>
<!--      <li><a href="/brands"><?php echo $text_info_brends; ?></a></li>-->
      <li><a href="/contact"><?php echo $text_info_contact; ?></a></li>
</ul>
  