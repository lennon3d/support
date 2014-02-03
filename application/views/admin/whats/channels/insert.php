<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("mobile")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="mobile" id="" value="<?=$mobile?>"/>
					</div>
				</div>
				<div class="control-group">
				<label class="for control-label"><?=lang("code_type")?> : </label>
				<div class="controls">
					 <label class="radio inline"><input type="radio" class="style" name="code_type" value="sms"/><?=lang("sms")?></label>
					 <label class="radio inline"><input checked="checked" type="radio" class="style" name="code_type" value="voice"/><?=lang("voice")?></label>
				</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("channel_code")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="begin_code" id="" value="<?=$code?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("channel_hash")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="hash" id="" value="<?=$hash?>"/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?=lang("status")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" checked='checked' name="status" /></div>
					</div>
				</div>	
				</div>	
					</div>
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
	</fieldset>
</form>
