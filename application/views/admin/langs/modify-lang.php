<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/langs/modifyLang/<?=$lang->id?>">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("language")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="language" id="" value="<?=$lang->language?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("lang_code")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="code" id="" value="<?=$lang->code?>"/>
					</div>
				</div>
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>