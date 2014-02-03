<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/email/setEmailSettings">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("email_server")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="server" id="" value="<?=$settings->server?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("email_port")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="port" id="" value="<?=$settings->port?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="username" id="" value="<?=$settings->username?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("password")?>: </label>
					<div class="controls">
						<input type="password" class="span12" name="password" id="" value="<?=$settings->password?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("sender_name")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="sendername" id="" value="<?=$settings->sendername?>"/>
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label"><?=lang("method")?>: </label>
					<div class="controls">
						<label class="radio inline"><input type="radio" name="method" value="SMTP" class="style" <?=($settings->method=="SMTP"?"checked='checked'":"")?>>SMTP</label>
						<label class="radio inline"><input type="radio" name="method" value="PHP" class="style" <?=($settings->method=="PHP"?"checked='checked'":"")?>>PHP mail</label>
					</div>
				</div>																																													
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>