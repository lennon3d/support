		<?php if($permissions->groups["create"]=="1"){?>
		<a class="btn btn-primary" data-toggle="modal" href="#mobile_sub_dialog"><i class="font-plus"></i><?=lang("insert_mobiles")?></a>
		<?php }?>
		<?php if($permissions->sms_send["send"]=="1"){?>
		<div class="btn-group">
			<button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><?=lang("send")?> <span class="caret dd-caret"></span></button>
			<ul class="dropdown-menu">
				<li><a id="send_sms_selected_btn" data-toggle="modal" href="#send_sms_dialog"><i class="font-list-ul"></i><?=lang("send_to_selected")?></a></li>
				<li><a id="send_sms_all_btn" data-toggle="modal" href="#send_sms_dialog"><i class="font-envelope"></i><?=lang("send_to_all")?></a></li>
			</ul>
		</div>
		<?php }?>
		<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
		<textarea style="display: none;" name="tbody"></textarea>
		<textarea style="display: none;" name="thead"></textarea>
		<input type="hidden" name="method" />
		<input type="hidden" name="table" value="<?=lang("mobile_group")?>" />
		</form>
		<form method="post" action="<?=base_url()?>admin/groups/deleteMobileSub">
			<div class="table-overflow block well">
				<?php if($mobiles){?>
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
				<table class="table table-bordered table-hover table-checks table-block" id="<?=(!$mobiles?"":"data-table")?>">
					<thead>
						<tr>
							<th><input type="checkbox" class="style checkbox-all"/></th>
							<th style="width: 40%;"><?=lang("name")?></th>
							<th><?=lang("mobile")?></th>
							<th><?=lang("sub_date")?></th>
						</tr>
					</thead>
					<tbody>
					<?php if(!$mobiles){?>
						<tr>
							<td colspan="5" style="text-align: center;"><?=lang("no_inputs")?></td>
						</tr>
					<?php }else{?>
					<?php foreach($mobiles as $mobile){?>
						<tr>
							<td><input class="style mobile_checks" type="checkbox" name="mobile[]" value="<?=$mobile->id?>"/></td>
							<td><?=$mobile->name?></td>
							<td><?=$mobile->mobile?></td>
							<td><?=date("Y-m-d H:i a", $mobile->datetime)?></td>
						</tr>
					<?php }?>
					<?php }?>
					</tbody>
				</table>
			</div>
			<div class="control-group">
			<button type="submit" class="btn btn-danger" ><?=lang("delete")?></button>
			</div>
		</form>                 
		<!-- add mobile subscribers dialog  -->
<div id="mobile_sub_dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("insert_mobile_sub") ?></h5>
	</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="tabbable"><!-- default tabs -->
					<ul class="nav nav-tabs">
						<li class="active"><a href="#mobile_excel_tab" data-toggle="tab"><?=lang("upload_from_excel")?></a></li>
						<li><a href="#mobile_text_tab" data-toggle="tab"><?=lang("upload_from_text")?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="mobile_excel_tab">
							<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
							<input type="hidden" value="mobile" name="target"/>
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
						<div class="tab-pane" id="mobile_text_tab">
							<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" value="text" name="type"/>
								<input type="hidden" value="mobile" name="target"/>
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


<!-- send sms dialog -->
<div id="send_sms_dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="width:800px !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h5 id=""><?= lang("send_sms") ?></h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<form action="<?=base_url()?>admin/groups/sendSms" method="post" >
				<div class="control-group">
					<label class="control-label"><?=lang("mobiles")?></label>
					<div class="controls">
					<textarea class="span12" name="mobiles_content" id="mobiles_content" dir="ltr"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?=lang('sms_content')?></label>
					<div class="controls">
					<textarea class="span12" name="sms_content" id="" dir="ltr"></textarea>
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