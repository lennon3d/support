<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
			<div class="tab-pane" id="other_tab">
				<div class="tabbable">
					<ul class="nav nav-tabs">
					<?php if($this->_LANGS){?>
					<?php foreach($this->_LANGS as $lang){?>
						<li <?=($lang->default==1?"class='active'":"")?>><a href=<?="#".$lang->code."_tab"?> data-toggle="tab"><?=$lang->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($this->_LANGS){?>
					<?php foreach($this->_LANGS as $lang){?>
				<div class="tab-pane <?=($lang->default==1?"active":"")?>" id="<?=$lang->code?>_tab">
				<div class="control-group">
					<label class="control-label"><?=lang("event_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$lang->code?>" id="" value="<?=$post["title_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("event_location")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="location_<?=$lang->code?>" id="" value="<?=$post["location_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("event_from")?>: </label>
					<div class="controls">
						<input type="text" readonly class="span12 datepicker" name="from_<?=$lang->code?>" id="" value="<?=$post["from_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("event_to")?>: </label>
					<div class="controls">
						<input type="text" readonly class="span12 datepicker" name="to_<?=$lang->code?>" id="" value="<?=$post["to_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("event_desc")?>: </label>
					<div class="controls">
						<textarea class="span12" name="desc_<?=$lang->code?>" id="" ><?=$post["desc_$lang->code"]?></textarea>
					</div>
				</div>
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("language")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="lang" id="" >
						<?php foreach($langs as $lang){?>
							<option value="<?=$lang->code?>" <?=set_select("lang",$lang->code);?> <?=($lang->default=="1"?"selected='selected'":"")?>><?=$lang->language?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				-->
				<div class="control-group">
					<label class="control-label"><?=lang("status")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($post["status_$lang->code"]=="1"?"checked='checked'":"")?> name="status_<?=$lang->code?>" /></div>
					</div>
				</div>	
				</div>
						<?php }?>
						<?php }?>
					
					</div>
					</div>
			</div>														
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
			</div>
	</fieldset>
</form>