<form id="usualValidate" class="form-horizontal" method="post" action="">
	<div class="block well">
		<div class="row-fluid">
			<div class="control-group">
					<label class="control-label"><?=lang("active_service")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($set->active_service=="1"?"checked='checked'":"")?> name="active_service" /></div>
					</div>
				</div>
			<div class="control-group">
				<label class="control-label"><?=lang("register_points")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="register_points" value="<?=$set->register_points?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?=lang("free_messages")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="free_messages" value="<?=$set->free_messages?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?=lang("notify_nick")?>: </label>
				<div class="controls">
					<input type="text" class="span12" name="notify_nick" value="<?=$set->notify_nick?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?=lang("notify_user")?>: </label>
				<div class="controls">
					<select name="notify_user" class="style">
					<option><?=lang("choose_user")?></option>
					<?php foreach($users as $user){?>
					<option <?=($user->id == $set->notify_user?"selected='selected'":"")?> value="<?=$user->id?>"><?=$user->username?></option>
					<?php }?>
					</select>
				</div>
			</div>	
			<div class="control-group">
				<label class="control-label"><?=lang("test_user")?>: </label>
				<div class="controls">
					<select name="test_user" class="style">
					<option><?=lang("choose_user")?></option>
					<?php foreach($users as $user){?>
					<option <?=($user->id == $set->test_user?"selected='selected'":"")?> value="<?=$user->id?>"><?=$user->username?></option>
					<?php }?>
					</select>
				</div>
			</div>							
		</div>
	<div class="form-actions align-right">
		<input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" />
	</div>		
	</div>
</form>

