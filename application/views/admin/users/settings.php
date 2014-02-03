<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/users/updateSettings">
<input name="update" type="hidden"/>
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("register_active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($settings->register_active=="1"?"checked='checked'":"")?> name="register_active" /></div>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("register_admin")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($settings->register_admin=="1"?"checked='checked'":"")?> name="register_admin" /></div>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("register_mobile")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($settings->register_mobile=="1"?"checked='checked'":"")?> name="register_mobile" /></div>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("register_email")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($settings->register_email=="1"?"checked='checked'":"")?> name="register_email" /></div>
					</div>
				</div>
				
				<!-- 
				<div class="tabbable">
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
						<?php if($register_titles){?>
						<?php foreach($register_titles as $title){?>
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
				-->
				<div class="form-actions align-right">
					<input type="submit" value="<?= lang("update")?>" class="btn btn-primary" />
				</div>
			</div>
		</div>
	</fieldset>
</form>