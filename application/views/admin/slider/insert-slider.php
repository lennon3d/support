<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/theme.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/admin/js/elfinder.js"></script>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/slider/insertSlide">
	<fieldset>
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?=lang("slide_url")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="url" id="" value="<?=set_value("url")?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("photo_url")?>: <span class="req">*</span></label>
					<div class="controls">
						<div class="input-append"><input type="text" class="required span12" name="photo_url" id="photo_url" value="<?=set_value("photo_url")?>" /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
					</div>
															
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