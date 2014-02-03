<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/admin/js/elfinder/css/theme.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/admin/js/elfinder.js"></script>
<style>
input, textarea{
	direction: ltr;
}
input[name=company_name], input[name=copyrights]{
	direction: rtl;
}
</style>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/setSiteSettings">

		<div class="block well">
			<div class="row-fluid">
	<div class="tabbable"><!-- default tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#set_tab" data-toggle="tab"><?= lang("sitesettings")?></a></li>
			<li><a href="#social_tab" data-toggle="tab"><?=lang("social_set")?></a></li>
			<li><a href="#other_tab" data-toggle="tab"><?=lang("other_set")?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="set_tab">
							<div class="control-group">
					<label class="control-label"><?=lang("site_open")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($settings->site_open=="1"?"checked='checked'":"")?> name="site_open" /></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("meta_tag")?>: </label>
					<div class="controls">
						<textarea class="span12" name="meta_tag" id="" ><?=$settings->meta_tag?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("meta_key")?>: </label>
					<div class="controls">
						<textarea class="span12" name="meta_key" id="" ><?=$settings->meta_key?></textarea>
					</div>
				</div>
				
								<div class="control-group">
					<label class="control-label"><?=lang("site_url")?>: </label>
					<div class="controls">
					<span class="help-block"><?=lang("url_pattern")?></span>
						<input type="text" class="span12" name="site_url" id="urlField" value="<?=$settings->site_url?>"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("admin_mobiles")?>:</label>
					<div class="controls"><input type="text" id="tags1" class="tags" name="admin_mobiles" value="<?=$settings->admin_mobiles?>" /></div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?=lang("admin_emails")?>:</label>
					<div class="controls"><input type="text" id="tags1" class="tags" name="admin_emails" value="<?=$settings->admin_emails?>" /></div>
				</div>	

			
			</div>
			<div class="tab-pane" id="social_tab">
							<div class="control-group">
					<label class="control-label"><?=lang("facebook_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="facebook_link" id="" value="<?=$settings->facebook_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("twitter_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="twitter_link" id="" value="<?=$settings->twitter_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("instgram_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="instgram_link" id="" value="<?=$settings->instgram_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("youtube_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="youtube_link" id="" value="<?=$settings->youtube_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("linkedin_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="linkedin_link" id="" value="<?=$settings->linkedin_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("googleplus_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="googleplus_link" id="" value="<?=$settings->googleplus_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("wiki_link")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="wiki_link" id="" value="<?=$settings->wiki_link?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("googleanalist_id")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="googleanalist_id" id="" value="<?=$settings->googleanalist_id?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("alexa_id")?>: </label>
					<div class="controls">
						<input type="text" class="span12" name="alexa_id" id="" value="<?=$settings->alexa_id?>"/>
					</div>
				</div>	
				
			</div>
			
			
			
			<div class="tab-pane" id="other_tab">
							<div class="tabbable">
					<ul class="nav nav-tabs">
					<?php if($langs){?>
					<?php foreach($langs as $lang){?>
						<li <?=($lang->default==1?"class='active'":"")?>><a href=<?="#".$lang->code."_tab"?> data-toggle="tab"><?=$lang->language?></a></li>
						<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
					<?php if($langs){?>
					<?php foreach($langs as $lang){?>
						<div class="tab-pane <?=($lang->default==1?"active":"")?>" id="<?=$lang->code?>_tab">
						<?php if($titles){?>
						<?php foreach($titles as $title){?>
						<?php if($title->lang == $lang->code){?>
						<?php if($title->title=="set_logo"){?>
								<div class="control-group">
									<label class="control-label"><?=lang($title->title)?>: </label>
									<div class="controls">
										<div class="input-append"><input type="text" class="span12" value="<?=$title->text?>" name="<?=$title->title."_".$title->lang?>" id="<?=$title->title."_".$title->lang?>"  /><a class="btn open_elfinder" data-toggle="modal" href="#elfinder_dialog"><b class="font-folder-open"></b></a></div>
									
									</div>
								</div>							
						<?php }else{?>
								<div class="control-group">
									<label class="control-label"><?=lang($title->title)?>: </label>
									<div class="controls">
										<input type="text" class="span12" name="<?=$title->title."_".$title->lang?>" id="" value="<?=$title->text?>" />
									</div>
								</div>	
								<?php }?>												
								<?php }?>												
								<?php }?>												
						</div>
						<?php }?>
						<?php }?>
						<?php }?>
					</div>
					</div>
			</div>
			
			
			
		</div>
	</div>			
				<div class="form-actions align-right"><input type="submit" value="<?= lang("modify")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
</form>

<!-- elfinder dialog  -->
<div id="elfinder_dialog" class="modal hide fade" tabindex="-1"	role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_link") ?></h5>
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