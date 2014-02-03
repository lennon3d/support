<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/theme.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder.js"></script>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/products/insertProduct">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("categories")?>: <span class="req">*</span></label>
					<div class="controls">
						<select class="style" name="category" id="" >
						<?php foreach($cats as $cat){?>
							<option value="<?=$cat->id?>" <?=set_select("category",$cat->id);?> ><?=$cat->title?></option>
						<?php }?>
						</select>
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label"><?=lang("product_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="title" id="username_text" value="<?=set_value("title")?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("product_subtitle")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="subtitle" id="" value="<?=set_value("subtitle")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("year")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="year" id="" value="<?=set_value("year")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("director")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="director" id="" value="<?=set_value("director")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("editor")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="editor" id="" value="<?=set_value("editor")?>" />
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label"><?=lang("actors")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="actors" id="" value="<?=set_value("actors")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("country")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="country" id="" value="<?=set_value("country")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("copyrights")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="required span12" name="copyrights" id="" value="<?=set_value("copyrights")?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("description")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="required span12" name="description" id="" ><?=set_value("description")?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("product_thumb")?>: <span class="req">*</span></label>
					<div class="controls">
						<div class="input-append"><input type="text" class="span12" name="thumb" id="thumb" value="<?=set_value("thumb")?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("in_slider")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20"  name="in_slider" /></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("active")?>: </label>
					<div class="controls on_off">
						<div class="checkbox inline"><input checked="checked" type="checkbox" id="check20"  name="active" /></div>
					</div>
				</div>
				<!-- 
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
				-->														
				<div class="form-actions align-right"><input type="submit" value="<?= lang("add")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>

<!-- elfinder dialog  -->
<div id="elfinder_dialog" class="modal hide fade" tabindex="-1"	role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_slide") ?></h5>
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