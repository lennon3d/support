<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/theme.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/admin/js/elfinder.js"></script>
<form id="usualValidate" class="form-horizontal" method="post" action="">
	<fieldset>
			<div class="row-fluid">
			<div class="tab-pane" id="other_tab">
							<div class="tabbable">
					<ul class="nav nav-tabs">
					<?php if($service){?>
					<?php foreach($service as $row){?>
						<li <?=($this->mfunctions->getDefCode()==$row->lang?"class='active'":"")?>><a href=<?="#".$row->lang."_tab"?> data-toggle="tab"><?=$this->mfunctions->getLangByCode($row->lang)->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($service){?>
					<?php foreach($service as $row){?>
						<div class="tab-pane <?=($this->mfunctions->getDefCode()==$row->lang?"active":"")?>" id="<?=$row->lang?>_tab">
					<div class="control-group">
						<label class="control-label"><?=lang("service_title")?>: <span class="req">*</span></label>
						<div class="controls">
							<input type="text" name="title_<?=$row->lang?>" class="span12" value="<?=$row->title?>"/>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label"><?=lang("service_url")?>: </label>
						<div class="controls">
							<select class="style" name="url_<?=$row->lang?>" id="" >
								<option value="#"><?=lang("choose_page")?></option>
								<?php foreach($pages as $page){?>
								<option <?=($row->url == $page["url"]?"selected='selected'":"")?> value="<?=$page["url"]?>"><?=$page["title"]?></option>
								<?php }?>
							</select>
							<input id="urlField" type="text" name="out_url_<?=$row->lang?>" class="span12" value="<?=$row->out_url?>" dir="ltr"/>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label"><?=lang("service_thumb")?>: </label>
						<div class="controls">
							<div class="input-append"><input type="text" class="span12" name="thumb_<?=$row->lang?>" id="thumb_<?=$row->lang?>" value="<?=$row->thumb?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
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
		</div>
		</div>
	</fieldset>
	<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
</form>

<!-- elfinder dialog  -->
<div id="elfinder_dialog" class="modal hide fade" tabindex="-1"	role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_banner") ?></h5>
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