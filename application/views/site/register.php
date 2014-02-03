          <?php if($register == 0){?>
          			<div class="main-block empty-block PIE">
				<div class="main-block-title">
					<h1>التسجيل غير مفعل</h1>
				</div>
				<div class="main-block-body">
				التسجيل غير مفعل
				</div>
			</div>
          <?php }else{?>
			<form action="<?=base_url().$this->_seg?>/user/register" method="post" class="form-horizontal">
			<input type="hidden" name="group_id" value="<?=MFunctions::GROUP_WHATSAPP?>"/>
			<div class="row-fluid">
			<div class="span8 well">
				<div class="control-group">
					<label class="control-label"><?=lang("name")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="span12" name="name" value="<?=$name?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("username")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="span12" name="username" value="<?=$username?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("password")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="span12" name="password" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("repassword")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="password" class="span12" name="repassword" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("email")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="span12" name="email" value="<?=$email?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("mobile")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="span12" name="mobile" value="<?=$mobile?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("enter_captcha")?>: <span class="req">*</span></label>
					<div class="controls">
					<img src="user/captchaImage" alt="captcha" />
						<input type="text" value="" placeholder="<?=lang("enter_captcha")?>" class="span12" name="captcha" />
					</div>
				</div>						
				<div class="form-actions align-right"><input type="submit" value="<?=lang("registeration")?>" class="btn btn-success" /></div>		
			</div>
			<div class="span4 well">

				<div class="control-group">
					<label class="control-label"><?=lang("birthdate")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="birthdate" value="<?=(isset($birthdate)?$birthdate:"")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("phone")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="phone" value="<?=(isset($phone)?$phone:"")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("country")?>: </label>
					<div class="controls">
						<select class="style span12" name="country" id="" >
						<option value=""><?=lang("choose_country")?></option>
						<?php foreach($countries as $country1){?>
							<option <?=(isset($country) && $country == $country1->c_id?"selected='selected'":"")?> value="<?=$country1->c_id?>"><?=$country1->c_name?></option>
						<?php }?>
						</select>
					</div>
				</div>	
			</div>
				
		</div>
			</form>
<?php }?>