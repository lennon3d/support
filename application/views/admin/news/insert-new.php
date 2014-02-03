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
					<label class="control-label"><?=lang("new_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$lang->code?>" id="" value="<?=$post["title_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("new_desc")?>: </label>
					<div class="controls">
						<textarea class="span12" name="short_description_<?=$lang->code?>" id="" ><?=$post["short_description_$lang->code"]?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("new_thumb")?>: </label>
					<div class="controls">
					<div class="input-append"><input type="text" class="span12" name="thumb_url_<?=$lang->code?>" id="thumb_url_<?=$lang->code?>" value="<?=$post["thumb_url_$lang->code"]?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
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
					<label class="control-label"><?=lang("position")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="position_<?=$lang->code?>" id="" >
							<option <?=($post["position_$lang->code"] == 1?"selected='selected'":"")?> value="1" >سلايدر</option>
							<option <?=($post["position_$lang->code"] == 2?"selected='selected'":"")?> value="2" >يمين أسفل</option>
							<option <?=($post["position_$lang->code"] == 3?"selected='selected'":"")?> value="3" >قائمة يسرى</option>
						</select>
					</div>
				</div>			
				<div class="control-group">
					<label class="control-label"><?=lang("new_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="url_<?=$lang->code?>" id="" >
						<option value=""><?=lang("choose_page")?></option>
						<?php foreach($pages as $page){?>
							<option <?=($post["url_$lang->code"] == $page["url"]?"selected='selected'":"")?> value="<?=$page["url"]?>"><?=$page["title"]?></option>
						<?php }?>
						</select>
					</div>
				</div>	
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