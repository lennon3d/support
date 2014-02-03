<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/sms/modifyGate/<?=$gate->id?>">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("gate_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title" id="" value="<?=$gate->title?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("send_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="required span12" name="send_url" id="" ><?=$gate->send_url?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="username" id="" value="<?=$gate->username?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("password")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="required span12" name="password" id="" value="<?=$gate->password?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("sender_name")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="sender_name" id="name_text" value="<?=$gate->sender_name?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("success_op")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="required span12 style" name="success_op"  >
						<option value="equal" <?=($gate->success_op=="equal"?"selected='selected'":"")?>>يساوي</option>
						<option value="greater" <?=($gate->success_op=="greater"?"selected='selected'":"")?>>أكبر من</option>
						<option value="lesser" <?=($gate->success_op=="lesser"?"selected='selected'":"")?>>أقل من</option>
						<option value="contain" <?=($gate->success_op=="contain"?"selected='selected'":"")?>>يحوي على</option>
						<option value="start_with" <?=($gate->success_op=="start_with"?"selected='selected'":"")?>>يبدأ بــ</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("success_status")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="success_status" id="name_text" value="<?=$gate->success_status?>" />
					</div>
				</div>		
				<div class="control-group">
					<label class="control-label"><?=lang("active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($gate->active=="1"?"checked='checked'":"")?> name="active" /></div>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?=lang("method")?>: <span class="req">*</span></label>
					<div class="controls">
						<label class="radio inline"><input type="radio" name="method" value="POST" class="style" <?=($gate->method=="POST"?"checked='checked'":"")?> >POST</label>
						<label class="radio inline"><input type="radio" name="method" value="GET" class="style" <?=($gate->method=="GET"?"checked='checked'":"")?> >GET</label>
					</div>
				</div>	
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>