<form action="" method="post" class="form-horizontal">
	<div class="row-fluid">
		<?php if($this->msite->getUserStatus($this->USER_ID) == MFunctions::REGISTER_STATUS_MOBILE || $this->msite->getUserStatus($this->USER_ID) == MFunctions::REGISTER_STATUS_BOTH){?>
			<div class="control-group">
				<label class="control-label"><?=lang("enter_mobile_code")?>: <span class="req">*</span></label>
				<div class="controls">
					<input type="text" class="span12" name="mobile_code"  />
				</div>
			</div>
			<?php }?>
		<?php if($this->msite->getUserStatus($this->USER_ID) == MFunctions::REGISTER_STATUS_EMAIL || $this->msite->getUserStatus($this->USER_ID) == MFunctions::REGISTER_STATUS_BOTH){?>
			<div class="control-group">
				<label class="control-label"><?=lang("enter_email_code")?>: <span class="req">*</span></label>
				<div class="controls">
					<input type="text" class="span12" name="email_code"  />
				</div>
			</div>
			<?php }?>
			<div class="control-group">
					<input type="submit" class="btn btn-success" value="<?=lang("verify")?>" />
			</div>
	</div>
</form>
