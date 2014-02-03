<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/nav/insertNav">
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
					<label class="control-label"><?=lang("nav_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$lang->code?>" id="" value="<?=$post["title_$lang->code"]?>"/>
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
					<label class="control-label"><?=lang("nav_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="url_<?=$lang->code?>" id="" >
						<option value="#"><?=lang("choose_page")?></option>
						<?php foreach($pages as $page){?>
							<option <?=($post["url_$lang->code"] == $page["url"]?"selected='selected'":"")?> value="<?=$page["url"]?>"><?=$page["title"]?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("is_products")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" name="is_product" /></div>
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
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
			</div>
		</div>
	</fieldset>
</form>