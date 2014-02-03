<?php $slider = $this->msite->getSlider();?>
<div class="block">
<!--slider-->
	<div id="slider-container">
		<div class="slider-content">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<?php if($slider){?>
						<?php foreach($slider as $slide){?>
							<a href="<?=$slide->url?>"><img src="<?=$slide->photo_url?>" alt="" /></a>
						<?php }?>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
<!--/slider-->
</div>