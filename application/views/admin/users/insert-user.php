<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/users/insertUser">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="username" id="username_text" value="<?=set_value("username")?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("password")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="required span12" name="password" id="enterPass" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("repassword")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="required span12" name="repassword" id="repeatPass" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("name")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="name" id="name_text" value="<?=set_value("name")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("email")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="email" id="emailField" value="<?=set_value("email")?>" />
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label"><?=lang("mobile")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="mobile" id="digitsOnly" value="<?=set_value("mobile")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("users_group")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="group" id="" >
						<?php foreach($groups as $group){?>
							<option value="<?=$group->id?>" <?=($group_select==$group->id?"selected='selected'":"")?>><?=$group->title?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				<div class="control-group">
					<label class="for control-label"><?=lang("active")?>: </label>
					<div class="controls">
						<label class="radio inline"><input type="radio" name="active" value="1" class="style" checked="checked"><?=lang("activated")?></label>
						<label class="radio inline"><input type="radio" name="active" value="0" class="style" ><?=lang("inactive")?></label>
					</div>
				</div>				
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>