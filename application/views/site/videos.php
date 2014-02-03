<link rel="stylesheet" href="<?=base_url()?>assets/site/js/flexslider2.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>assets/site/js/colorbox.css" />
<script src="<?=base_url()?>assets/site/js/jquery.colorbox.js"></script>
<script src="<?=base_url()?>assets/site/js/gallery.js"></script>
<div class="title-3"><?=$titles[$lang]["set_videos"]?> <i class="icon-picture"></i></div>
	<div class="inner">
	<?php if($videos){?>
	<?php foreach($videos as $video){?>
		<a title="<?=$video->title?>" href="<?=base_url().$video->lang.DIRECTORY_SEPARATOR."showVideo?video=".$video->id?>" class="group1"><img src="<?=$video->thumb_url?>" class="pic-in-gallery radius" /></a>	
	<?php }?>
	<?php }else{?>
	
	<?php }?>
		<div class="clr"></div>
	</div>
