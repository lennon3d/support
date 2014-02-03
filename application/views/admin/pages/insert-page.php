<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/edit_area/edit_area_full.js"></script>
<script type="text/javascript">
<?php foreach($this->_LANGS as $lang) { ?>
editAreaLoader.init({
	id: "css_text_<?=$lang->code?>"	// id of the textarea to transform	
	,start_highlight: true	
	,font_size: "8"
	,font_family: "verdana, monospace"
	,allow_resize: "y"
	,allow_toggle: false
	,language: "en"
	,syntax: "css"	
	,toolbar: "new_document, |, charmap, |, search, go_to_line, |, undo, redo"
	,plugins: "charmap"
	,charmap_default: "arrows"
		
});
<?php } ?>
	tinyMCE.init({
		// General options
		selector : "textarea.content_text",
	    theme: "modern",
	    plugins: [
	              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	              "searchreplace wordcount visualblocks visualchars code fullscreen",
	              "insertdatetime media nonbreaking save table contextmenu directionality",
	              "emoticons template paste textcolor"
	          ],

		convert_urls: false,
		
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    toolbar2: "print preview media | forecolor backcolor emoticons",
	    image_advtab: true,
	    templates: [
	        {title: 'Test template 1', content: 'Test 1'},
	        {title: 'Test template 2', content: 'Test 2'}
	    ],
		
		
		//Open Manager Options
		file_browser_callback : elFinderBrowser,

		// Example content CSS (should be your site CSS)
		content_css : "<?=base_url()?>assets/site/css/style.css"

	});

	function elFinderBrowser (field_name, url, type, win) {
		  tinymce.activeEditor.windowManager.open({
		    file: '<?=base_url()?>assets/admin/js/elfinder/elfinder.html',// use an absolute path!
		    title: 'elFinder 2.0',
		    width: 900,  
		    height: 450,
		    resizable: 'yes'
		  }, {
		    setUrl: function (url) {
		      win.document.getElementById(field_name).value = url;
		    }
		  });
		  return false;
		}
</script>

<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/pages/insertPage">
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
					<label class="control-label"><?=lang("page_title")?>: <span class="req">*</span></label>
					<div class="controls">
						<input type="text" class="span12 required" name="title_<?=$lang->code?>" id="" value="<?=$post["title_$lang->code"]?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Meta Tags: </label>
					<div class="controls">
						<textarea class="span12" name="meta_tag_<?=$lang->code?>" id="" dir="ltr"><?=$post["meta_tag_$lang->code"]?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Meta Description: </label>
					<div class="controls">
						<textarea class="span12" name="meta_desc_<?=$lang->code?>" id="" dir="ltr"><?=$post["meta_desc_$lang->code"]?></textarea>
					</div>
				</div>
				<!-- 
				<div class="control-group">
					<label class="control-label"><?=lang("active")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="" checked="checked" name="active" /></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("have_contact")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="" checked="checked" name="contact" /></div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("contact_title")?></label>
					<div class="controls">
						<input type="text" class="span12" name="contact_title" value="<?=set_value("meta_desc")?>"/>
					</div>
				</div>										
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
				<div class="control-group">
					<label class="control-label"><?=lang("page_style")?>: </label>
					<div class="controls">
						<textarea id="css_text_<?=$lang->code?>" class="span12" name="style_<?=$lang->code?>" dir="ltr"><?=$post["style_$lang->code"]?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("page_content")?>: <span class="req">*</span></label>
					<div style="overflow-x: scroll;" class="controls">
						<textarea  rows="30" class="span12 content_text" name="content_<?=$lang->code?>" id="" dir="ltr"><?=$post["content_$lang->code"]?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("status")?></label>
					<div class="controls on_off">
						<div class="checkbox inline"><input type="checkbox" id="check20" <?=($post["active_$lang->code"]=="1"?"checked='checked'":"")?> name="active_<?=$lang->code?>" /></div>
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