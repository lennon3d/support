<link rel="stylesheet" href="<?=base_url()?>assets/site/js/flexslider2.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>assets/site/js/colorbox.css" />
<script src="<?=base_url()?>assets/site/js/jquery.colorbox.js"></script>
<script src="<?=base_url()?>assets/site/js/gallery.js"></script>
<div class="title-3"><?=$titles[$lang]["set_gallery"]?><i class="icon-picture"></i></div>
	<div class="inner">
	<?php if($gallery){?>
	<?php foreach($gallery as $photo){?>
		<a title="<?=$photo->title?>" href="<?=$photo->photo_url?>" class="group1"><img src="<?=$photo->thumb_url?>" class="pic-in-gallery radius" /></a>	
	<?php }?>
	<?=lang("no_photo_in_gallery")?>
	<?php }?>
		<div class="clr"></div>
	</div>
