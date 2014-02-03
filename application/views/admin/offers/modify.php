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
					<?php if($offer){?>
					<?php foreach($offer as $row){?>
						<li <?=($this->mfunctions->getDefCode()==$row->lang?"class='active'":"")?>><a href=<?="#".$row->lang."_tab"?> data-toggle="tab"><?=$this->mfunctions->getLangByCode($row->lang)->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($offer){?>
					<?php foreach($offer as $row){?>
						<div class="tab-pane <?=($this->mfunctions->getDefCode()==$row->lang?"active":"")?>" id="<?=$row->lang?>_tab">
				<div class="control-group">
					<label class="control-label"><?=lang("offer_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title_<?=$row->lang?>" id="" value="<?=$row->title?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("offer_subtitle")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="subtitle_<?=$row->lang?>" id="" value="<?=$row->subtitle?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("offer_thumb")?>: </label>
					<div class="controls">
						<div class="input-append"><input type="text" class="span12" name="thumb_<?=$row->lang?>" id="thumb_text_<?=$row->lang?>" value="<?=$row->thumb?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
					</div>
				</div>		
				<div class="control-group">
					<label class="control-label"><?=lang("offer_country")?>: </label>
					<div class="controls">
						<select class="style countries_select" name="country_<?=$row->lang?>" id="" >
						<option value=""><?=lang("choose_country")?></option>
						<?php foreach($countries as $country){?>
							<option <?=($post["country_$row->lang"] == $country->c_id?"selected='selected'":"")?> value="<?=$country->c_id?>"><?=$country->c_name?></option>
						<?php }?>
						</select>
					</div>
				</div>					
				<div class="control-group">
					<label class="control-label"><?=lang("offer_city")?>: </label>
					<div class="controls">
						<select class="style cities_select" name="city_<?=$row->lang?>" id="" >
						<option value=""><?=lang("choose_city")?></option>
						<?php if($post["cities_$row->lang"]){?>
							<?php foreach($post["cities_$lang->code"] as $city){?>
								<option <?=($city->id == $post["city_$row->lang"]?"selected='selected'":"")?> value="<?=$city->id?>"><?=$city->city_name?></option>					
							<?php }?>
						<?php }?>
						</select>
					</div>
				</div>												
				<div class="control-group">
					<label class="control-label"><?=lang("offer_desc")?>: </label>
					<div class="controls">
						<textarea class="span12" name="desc_<?=$row->lang?>" id="" ><?=$row->desc?></textarea>
					</div>
				</div>
								
				<div class="control-group">
					<label class="control-label"><?=lang("offer_url")?>: </label>
					<div class="controls">
						<select class="style" name="url_<?=$row->lang?>" id="" >
						<option value=""><?=lang("choose_page")?></option>
						<?php foreach($pages as $page){?>
							<option <?=($row->url == $page["url"]?"selected='selected'":"")?> value="<?=$page["url"]?>"><?=$page["title"]?></option>
						<?php }?>
						</select>
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
		<h5 id=""><?= lang("mofidy_offer") ?></h5>
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