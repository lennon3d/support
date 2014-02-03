<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
			<div class="row-fluid">
<div class="span8 well">
				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="username" id="username_text" value="<?=$user->username?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("name")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="name" id="name_text" value="<?=$user->name?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("email")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="email" id="emailField" value="<?=$user->email?>" />
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label"><?=lang("mobile")?>: <span class="req">*</span></label>
					<div class="controls">
						<input readonly type="text" class="required span12" name="mobile" id="digitsOnly" value="<?=$user->mobile?>" />
					</div>
				</div>
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>				
				</div>
			<div class="span4 well">

				<div class="control-group">
					<label class="control-label"><?=lang("birthdate")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="birthdate" value="<?=$user->birth_date?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("phone")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="phone" value="<?=$user->phone?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("country")?>: </label>
					<div class="controls">
						<select class="style span12" name="country" id="" >
						<option value=""><?=lang("choose_country")?></option>
						<?php foreach($countries as $country1){?>
							<option <?=($country1->c_id == $user->country?"selected='selected'":"")?> value="<?=$country1->c_id?>"><?=$country1->c_name?></option>
						<?php }?>
						</select>
					</div>
				</div>	
			</div>				
			</div>
	</fieldset>
</form>
