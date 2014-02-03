<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/theme.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/admin/js/elfinder.js"></script>
<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
			<div class="tab-pane" id="other_tab">
				<div class="tabbable">
					<ul class="nav nav-tabs">
					<?php if($new){?>
					<?php foreach($new as $row){?>
						<li <?=($this->mfunctions->getDefCode()==$row->lang?"class='active'":"")?>><a href=<?="#".$row->lang."_tab"?> data-toggle="tab"><?=$this->mfunctions->getLangByCode($row->lang)->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($new){?>
					<?php foreach($new as $row){?>
						<div class="tab-pane <?=($this->mfunctions->getDefCode()==$row->lang?"active":"")?>" id="<?=$row->lang?>_tab">
				<div class="control-group">
					<label class="control-label"><?=lang("new_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$row->lang?>" id="" value="<?=$row->title?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("new_desc")?>: </label>
					<div class="controls">
						<textarea class="span12" name="short_description_<?=$row->lang?>" id="" ><?=$row->short_description?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("new_thumb")?>: </label>
					<div class="controls">
						<div class="input-append"><input type="text" class="span12" name="thumb_url_<?=$row->lang?>" id="thumb_url_<?=$row->lang?>" value="<?=$row->thumb_url?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
					</div>
				</div>
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("language")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="lang" id="" >
						<?php foreach($langs as $lang){?>
							<option value="<?=$lang->code?>" <?=($lang->code==$new->lang?"selected='selected'":"")?>><?=$lang->language?></option>
						<?php }?>
						</select>
					</div>
				</div>		
				-->
				<div class="control-group">
					<label class="control-label"><?=lang("position")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="position_<?=$row->lang?>" id="" >
							<option value="1" <?=($row->position=="1"?"selected='selected'":"")?>>سلايدر</option>
							<option value="2" <?=($row->position=="2"?"selected='selected'":"")?>>يمين أسفل</option>
							<option value="3" <?=($row->position=="3"?"selected='selected'":"")?>>قائمة يسرى</option>
						</select>
					</div>
				</div>					
				<div class="control-group">
					<label class="control-label"><?=lang("new_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="url_<?=$row->lang?>" id="" >
						<option value=""><?=lang("choose_page")?></option>
						<?php foreach($pages as $page){?>
							<option value="<?=$page["url"]?>" <?=($page["url"]==$row->url?"selected='selected'":"")?>><?=$page["title"]?></option>
						<?php }?>
						</select>
					</div>
				</div>
								
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
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
			</div>
		</div>
	</fieldset>
</form>


<!-- elfinder dialog  -->
<div id="elfinder_dialog" class="modal hide fade" tabindex="-1"	role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_video") ?></h5>
	</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<div id="elfinder"></div>
					<input type="hidden" id="elfinder_url_text"/>
					<input type="hidden" id="elfinder_dest_text"/>
				</div>	
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal"><?= lang("close") ?></button>
			<input value="<?= lang("choose")?>" data-dismiss="modal" type="submit" class="btn btn-primary" id="elfinder_ok_btn" />
		</div>
</div>