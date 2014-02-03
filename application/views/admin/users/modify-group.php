<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/users/modifyGroup/<?=$group->id?>">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?=lang("group_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title" id="" value="<?=$group->title?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("group_color")?>:</label>
					<div class="controls">
						<input type="text" class=" span12" name="color" id="" value="<?=$group->color?>"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("group_desc")?>:</label>
					<div class="controls">
						<textarea class=" span12" name="description" id="" ><?=$group->description?></textarea>
					</div>
				</div>				
				<?php if($group->id != 1){?>
				<div class="control-group">
					<label class="control-label"><?=lang("active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($group->active=="1"?"checked='checked'":"")?> name="active" /></div>
					</div>
				</div>
				<?php }?>								
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>