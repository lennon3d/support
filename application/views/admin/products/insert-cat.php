<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/products/insertCat">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?=lang("cat_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title" id="username_text" value="<?=set_value("title")?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input checked="checked" type="checkbox" id="check20"  name="active" /></div>
					</div>
				</div>												
				<div class="control-group">
					<label class="control-label"><?=lang("language")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="language" id="" >
						<?php foreach($langs as $lang){?>
							<option value="<?=$lang->code?>" <?=set_select("lang",$lang->code);?> <?=($lang->default=="1"?"selected='selected'":"")?>><?=$lang->language?></option>
						<?php }?>
						</select>
					</div>
				</div>																
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>