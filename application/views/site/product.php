<script defer src="<?=base_url()?>assets/site/js/jquery.flexslider.js"></script>
<script src="<?=base_url()?>assets/site/js/product.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/site/js/flexslider2.css" type="text/css" media="screen" />

<div class="inner">
	<div class="col-50">
	<?php if($product){?>
		<div class="colors_orange-2 radius padd title-3">
			<i class="icon-arrow-left"></i><?=$product->title?><span
				style="font-size: 14px;"><?=$product->subtitle?></span>
		</div>
		<ul class="pro-ul inner">
			<li><?=$titles[$lang]["product_year"]?><span class="smallest"><?=$product->year?></span></li>
			<li><?=$titles[$lang]["product_director"]?><span class="smallest"><?=$product->director?></span></li>
			<li><?=$titles[$lang]["product_editor"]?><span class="smallest"><?=$product->editor?></span></li>
			<li><?=$titles[$lang]["product_actors"]?><span class="smallest"><?=$product->actors?></span></li>
			<li><?=$titles[$lang]["product_country"]?><span class="smallest"><?=$product->country?></span></li>
			<li><?=$titles[$lang]["product_copyrights"]?><span class="smallest"><?=$product->copyrights?></span></li>

		</ul>
		<div class="clr padd"></div>
		<div class="colors_grey-1 radius bx-shadow title-4"><?=$product->description?></div>
	</div>
	<?php }?>
	<div class="col-50" style="direction: ltr">

		<div class="flexslider2">
			<ul class="slides">
			<?php if($product_slides){?>
			<?php foreach($product_slides as $slide){?>
				<li data-thumb="<?=$slide->url?>"><img src="<?=$slide->url?>" />
				</li>
				<?php }?>
				<?php }?>
			</ul>
		</div>

	</div>
	<div class="clr"></div>
</div>