<head>
<link rel="stylesheet"
	href="<?=base_url()?>assets/site/js/flexslider2.css" type="text/css"
	media="screen" />
<link rel="stylesheet" href="<?=base_url()?>assets/site/js/colorbox.css" />
<script src="<?=base_url()?>assets/site/js/jquery.colorbox.js"></script>
<script src="<?=base_url()?>assets/site/js/news.js"></script>
<script type="text/javascript"
	src="<?=base_url()?>assets/site/js/jquery.sudoSlider.min.js"></script>
</head>

<div class="title-3"> <?=lang("news")?></div>

<div class="colors_blue-2">
	<div class="col-70">
		<div style="direction: ltr">
			<div class="colors_blue-3 border-4 padd bx-shadow">
				<div id="slider">
					<ul>				
					<?php if($news){?>
					<?php foreach($news as $new){?>
					<?php if($new->position == "1"){?>
						<li>
							<div class="news-slide">
								<img src="<?=$new->thumb_url?>" alt="image description" class="pic-in-slide f-right" />
								<p class="f-left">
									<h1><i class="icon-stop"></i> <?=$new->title?></h1>
									<?=$new->short_description?>
									<div class="clr"></div>
									<a class="colors_grey-2 padd f-left" href="<?=$new->url?>"><?=lang("more")?></a>
								</p>
								<div class="clr"></div>
							</div>
						</li>
					<?php }?>
					<?php }?>
					<?php }?>
					</ul>
				</div>
			</div>
		</div>
		<div class="clr"></div>
		<?php if($news){?>
		<?php foreach($news as $new){?>
		<?php if($new->position == "2"){?>
		<div class="news-li">
			<img class="pic-in-gallery" src="<?=$new->thumb_url?>" />
			<div class="col-" style="width: 74%;">
				<a class="title-2 colors_grey-1 bx-shadow block" href="<?=$new->url?>"><?=$new->title?></a>
				<p><?=$new->short_description?></p>
				<a class="colors_grey-2 padd f-left" href="<?=$new->url?>"><?=$langs_titles[$lang_seg]["set_more"]?></a>
			</div>
			<div class="clr"></div>
		</div>
		<?php }?>
		<?php }?>
		<?php }?>
		</div>
		<div class="col-40">
		<?php if($news){?>
		<?php foreach($news as $new){?> 
		<?php if($new->position == "3"){?>                 
		<div class="news-li2">
			<img class="pic-in-gallery" src="<?=$new->thumb_url?>" />
			<div class="col-" style="width: 69%;">
			<a href="<?=$new->url?>"><?=$new->short_description?></a>
			</div>
			<div class="clr"></div>
		</div>
		<?php }?>
		<?php }?>
		<?php }?>
		<div class="margin-12"></div>
			<div class="colors_grey-2 bx-shadow">
				<div class="colors_blue-1 bx-shadow padd">
					<i class="icon-chevron-left"></i> <?=lang("links")?>
				</div>
			<div class="padd f">
			<?php if($links){?>
			<?php foreach($links as $link){?>
				<i class="icon-"><img style="height:30px; width:60px;" src="<?=$link->photo_url?>" /></i>
				<div class="names">
					<a href="<?=$link->url?>"><?=$link->title?></a>
				</div>
				<div class="clr"></div>
			<?php }?>
			<?php }?>
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</div>