<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		selector : "textarea#content_text",
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
<?php if($permissions->groups["create"]=="1"){?>
		<a class="btn btn-primary" data-toggle="modal" href="#email_sub_dialog"><i class="font-plus"></i><?=lang("insert_emails")?></a>
		<?php }?>
		<?php if($permissions->email_send["send"]=="1"){?>
		<div class="btn-group">
			<button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><?=lang("send")?> <span class="caret dd-caret"></span></button>
			<ul class="dropdown-menu">
				<li><a id="send_email_selected_btn" data-toggle="modal" href="#send_email_dialog"><i class="font-list-ul"></i><?=lang("send_to_selected")?></a></li>
				<li><a id="send_email_all_btn" data-toggle="modal" href="#send_email_dialog"><i class="font-envelope"></i><?=lang("send_to_all")?></a></li>
			</ul>
		</div>
		<?php }?>
		<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
		<textarea style="display: none;" name="tbody"></textarea>
		<textarea style="display: none;" name="thead"></textarea>
		<input type="hidden" name="method" />
		<input type="hidden" name="table" value="<?=lang("email_group")?>" />
		</form>
		<form method="post" action="<?=base_url()?>admin/groups/deleteEmailSub" id="table_form">
			<div class="table-overflow block well">
				<?php if($emails){?>
				<div class="navbar">
					<div class="navbar-inner">
						<div class="nav pull-right">
							<a href="#" class="dropdown-toggle just-icon" data-toggle="dropdown"><i class="font-cog"></i></a>
							<ul class="dropdown-menu pull-right">
								<li><a href="#" class="table_pdf_export_but"><img src="<?=base_url()?>assets/admin/images/pdf.png"/> <?=lang("export_to_pdf")?></a></li>
								<li><a href="#" class="table_excel2003_export_but"><img src="<?=base_url()?>assets/admin/images/excel2003.png"/> <?=lang("export_to_excel2003")?></a></li>
								<li><a href="#" class="table_excel2007_export_but"><img src="<?=base_url()?>assets/admin/images/excel2007.png"/> <?=lang("export_to_excel2007")?></a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php }?>
				<table class="table_for_print table table-bordered table-hover table-checks table-block" id="<?=(!$emails?"":"data-table")?>">
					<thead>
						<tr>
							<th><input type="checkbox" class="style checkbox-all"/></th>
							<th style="width: 40%;"><?=lang("name")?></th>
							<th><?=lang("email")?></th>
							<th><?=lang("sub_date")?></th>
						</tr>
					</thead>
					<tbody>
					<?php if(!$emails){?>
						<tr>
							<td colspan="5" style="text-align: center;"><?=lang("no_inputs")?></td>
						</tr>
					<?php }else{?>
					<?php foreach($emails as $email){?>
						<tr>
							<td><input class="style email_checks" type="checkbox" name="email[]" value="<?=$email->id?>"/></td>
							<td><?=$email->name?></td>
							<td><?=$email->email?></td>
							<td><?=date("Y-m-d H:i a", $email->datetime)?></td>
						</tr>
					<?php }?>
					<?php }?>
					</tbody>
				</table>
			</div>
			<div class="control-group">
			<a type="submit"  data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog"><?=lang("delete")?></a>
			</div>
		</form>
		
		
		<!-- add email subscribers dialog  -->
<div id="email_sub_dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_email_sub") ?></h5>
	</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="tabbable"><!-- default tabs -->
					<ul class="nav nav-tabs">
						<li class="active"><a href="#excel_tab" data-toggle="tab"><?=lang("upload_from_excel")?></a></li>
						<li><a href="#text_tab" data-toggle="tab"><?=lang("upload_from_text")?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="excel_tab">
							<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
							<input type="hidden" value="email" name="target"/>
							<input type="hidden" value="excel" name="type"/>
								<div class="control-group">
									<label class="control-label"><?=lang("filename")?></label><br/>
									<div class="controls">
										<input type="file" class="span12" name="userfile" />
									</div>
								</div>
								<div style="direction: ltr;" class="control-group">
								<input type="submit" class="btn btn-success" value="<?=lang('add')?>"/>
								</div>								
							</form>
						</div>
						<div class="tab-pane" id="text_tab">
							<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" value="text" name="type"/>
								<input type="hidden" value="email" name="target"/>
								<div class="control-group">
									<label class="control-label"><?=lang("filename")?></label><br/>
									<div class="controls">
										<input type="file" class="span12" name="userfile" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?=lang("fields_sep")?></label>
									<div class="controls">
										<select class="style" name="sep" >
										<option value=",">,</option>
										<option value=";">;</option>
										<option value="@">@</option>
										<option value="#">#</option>
										<option value="-">-</option>
										<option value="/">/</option>
										</select>
									</div>
								</div>
								<div style="direction: ltr;" class="control-group">
								<input type="submit" class="btn btn-success" value="<?=lang('add')?>"/>
								</div>								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal"><?= lang("close") ?></button>
		</div>
</div>

<!-- send email dialog -->
<div id="send_email_dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("send_email") ?></h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<form action="<?=base_url()?>admin/groups/sendEmail" method="post">
				<div class="control-group">
				<label class="control-label"><?=lang("email_subject")?></label>
				<div class="controls">
					<input type="text" class="span12" name="email_subject" />
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label"><?=lang("emails")?></label>
				<div class="controls">
					<textarea class="span12" name="emails" id="emails_content" dir="ltr"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang("email_content")?></label>
					<div class="controls">
					<textarea  rows="30" id="content_text" class="span12" name="email_content" id="" dir="ltr"></textarea>
				</div>
				</div>
				<div class="contro-group">
					<input type="submit" class="btn btn-success" value="<?=lang("send")?>"/>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal"><?= lang("close") ?></button>
	</div>
</div>

