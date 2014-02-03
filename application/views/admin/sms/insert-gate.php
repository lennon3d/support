<div class="block well-white body">
<p class="muted" style="width:20%;"><?=lang("username")?> : <span style="direction:ltr; float:left;" class="label label-info">#username</span></p>
<p class="muted" style="width:20%;"><?=lang("password")?> : <span style="direction:ltr; float:left;" class="label label-info">#password</span></p>
<p class="muted" style="width:20%;"><?=lang("sender_name")?> : <span style="direction:ltr; float:left;" class="label label-info">#sender</span></p>
<p class="muted" style="width:20%;"><?=lang("message")?> : <span style="direction:ltr; float:left;" class="label label-info">#message</span></p>
<p class="muted" style="width:20%;"><?=lang("mobiles")?> : <span style="direction:ltr; float:left;" class="label label-info">#numbers</span></p>
<p class="muted"><?=lang("example")?> : <span style="direction:ltr;" class="label label-success">http://www.4jawaly.net/api/sendsms.php?username=#username<br/>
&password=#password&message=#message&numbers=#numbers&sender=#sender&unicode=e&return=full</span></p>
</div>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/sms/insertGate">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("gate_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title" id="" value="<?=set_value("title")?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("send_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="required span12" name="send_url" id="" ><?=set_value("send_url")?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="username" id="" value="<?=set_value("username")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("password")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="required span12" name="password" id="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("sender_name")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="sender_name" id="name_text" value="<?=set_value("sender_name")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("success_op")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="required span12 style" name="success_op" >
						<option value="equal" selected="selected">يساوي</option>
						<option value="greater">أكبر من</option>
						<option value="lesser">أقل من</option>
						<option value="contain">يحوي على</option>
						<option value="start_with">يبدأ بـ </option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("success_status")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="success_status" id="name_text" value="<?=set_value("success_status")?>" />
					</div>
				</div>								
				<div class="control-group">
					<label class="control-label"><?=lang("active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=(set_value("active")=="1"?"checked='checked'":"")?> name="active" /></div>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?=lang("method")?>: <span class="req">*</span></label>
					<div class="controls">
						<label class="radio inline"><input type="radio" name="method" value="POST" class="style" checked="checked">POST</label>
						<label class="radio inline"><input type="radio" name="method" value="GET" class="style" >GET</label>
					</div>
				</div>	
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>