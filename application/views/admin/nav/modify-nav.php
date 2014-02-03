<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
			<div class="tab-pane" id="other_tab">
							<div class="tabbable">
					<ul class="nav nav-tabs">
					<?php if($nav){?>
					<?php foreach($nav as $row){?>
						<li <?=($this->mfunctions->getDefCode()==$row->lang?"class='active'":"")?>><a href=<?="#".$row->lang."_tab"?> data-toggle="tab"><?=$this->mfunctions->getLangByCode($row->lang)->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($nav){?>
					<?php foreach($nav as $row){?>
						<div class="tab-pane <?=($this->mfunctions->getDefCode()==$row->lang?"active":"")?>" id="<?=$row->lang?>_tab">
				<div class="control-group">
					<label class="control-label"><?=lang("nav_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$row->lang?>" id="" value="<?=$row->title?>"/>
					</div>
				</div>
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("language")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="lang" id="" >
						<?php foreach($langs as $lang){?>
							<option value="<?=$lang->code?>" <?=($lang->code==$nav->lang?"selected='selected'":"")?>><?=$lang->language?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				-->	
				<div class="control-group">
					<label class="control-label"><?=lang("nav_url")?>: </label>
					<div class="controls">
						<select class="style" name="url_<?=$row->lang?>" id="" >
						<option value="#"><?=lang("choose_page")?></option>
						<?php foreach($pages as $page){?>
							<option value="<?=$page["url"]?>" <?=($page["url"]==$row->url?"selected='selected'":"")?>><?=$page["title"]?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("is_products")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($nav->is_products=="1"?"checked='checked'":"")?> name="is_products" /></div>
					</div>
				</div>	
				-->
								
				<div class="control-group">
					<label class="control-label"><?=lang("status")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($row->status=="1"?"checked='checked'":"")?> name="status_<?=$row->lang?>" /></div>
					</div>
				</div>	
				</div>
				
				
						<?php }?>
						<?php }?>
					
					</div>
					</div>
			</div>																		
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
			</div>
		</div>
	</fieldset>
</form>