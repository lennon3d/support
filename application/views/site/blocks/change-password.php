<form action="" method="post">
<div class="row-fluid">
	<div class="span12 well">
		<div class="control-group">
			<label class="control-label"><?=lang("last_password")?>: <span class="req">*</span></label>
			<div class="controls">
				<input type="password" class="span12" name="last_password" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?=lang("new_password")?>: <span class="req">*</span></label>
			<div class="controls">
				<input type="password" class="span12" name="password" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?=lang("new_repassword")?>: <span class="req">*</span></label>
			<div class="controls">
				<input type="password" class="span12" name="repassword" />
			</div>
		</div>
	<div class="form-actions align-right"><input type="submit" value="<?=lang("change_password")?>" class="btn btn-success" /></div>		
	</div>
</div>
</form>