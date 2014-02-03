<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/products/updateTitles">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="tabbable">
					<!-- default tabs -->
					<ul class="nav nav-tabs">
					<?php if($langs){?>
					<?php foreach($langs as $lang){?>
						<li <?=($lang->default==1?"class='active'":"")?>><a href=<?="#".$lang->code."_tab"?> data-toggle="tab"><?=$lang->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($langs){?>
					<?php foreach($langs as $lang){?>
						<div class="tab-pane <?=($lang->default==1?"active":"")?>" id="<?=$lang->code?>_tab">
						<?php if($products_titles){?>
						<?php foreach($products_titles as $title){?>
						<?php if($title->lang == $lang->code){?>
								<div class="control-group">
									<label class="control-label"><?=lang($title->title)?>: <span class="req">*</span></label>
									<div class="controls">
										<input type="text" class="required span12" name="<?=$title->title."_".$title->lang?>" id="" value="<?=$title->text?>" />
									</div>
								</div>	
								<?php }?>												
								<?php }?>												
						</div>
						<?php }?>
						<?php }?>
						<?php }?>
					</div>
				</div>
				<div class="form-actions align-right">
				<?php if($permissions->langs_titles["modify"]=="1"){?>
					<input type="submit" value="<?= lang("update")?>" class="btn btn-primary" />
					<?php }?>
				</div>
			</div>
		</div>
	</fieldset>
</form>