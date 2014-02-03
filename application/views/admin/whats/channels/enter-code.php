<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<input type="hidden" name="mobile" value="<?=$mobile?>"/>
			<div class="control-group">
					<label class="control-label"><?=lang("whats_code")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="code" id="" value=""/>
					</div>
				</div>
				</div>	
					</div>
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
	</fieldset>
</form>
