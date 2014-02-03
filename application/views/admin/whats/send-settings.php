<div class="block well-white body" style="text-align: center;">
<p class="muted"><span class="label label-important">تحذير: هذه الإعدادات يتم تحديدها بحذر شديد بعد التجربة والتأكد</span></p>
</div>
<form id="usualValidate" class="form-horizontal" method="post" action="">
	<div class="block well">
		<div class="row-fluid">
			<div class="control-group">
				<label class="control-label"><?=lang("active_send")?></label>
				<div class="controls on_off">
					<div class="checkbox inline"><input type="checkbox" id="check20" <?=($set->active_send==1?"checked='checked'":"")?> name="active_send" /></div>
				</div>
			</div>
			<div class="control-group">
					<label class="control-label"><?=lang("msg_per_channel")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="msg_per_channel" value="<?=$set->msg_per_channel?>" />
				</div>
				</div>
			<div class="control-group">
				<label class="control-label"><?=lang("channels_loop")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="channels_loop" value="<?=$set->channels_loop?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?=lang("send_hours")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="send_hours" value="<?=$set->send_hours?>" />
				</div>
			</div>
		</div>
	<div class="form-actions align-right">
		<input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" />
	</div>
	</div>
</form>

