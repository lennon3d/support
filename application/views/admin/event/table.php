<?php if($permissions->event["create"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/event/insertEvent"><i class="font-plus"></i><?=lang("insert_event")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="method" />
	<input type="hidden" name="table" value="<?=lang("event")?>" />
</form>
<div class="table-overflow block well">
<?php if($events){?>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="nav pull-right">
				<a href="#" class="dropdown-toggle just-icon" data-toggle="dropdown"><i class="font-cog"></i></a>
				<ul class="dropdown-menu pull-right">
					<li><a href="#" id="table_pdf_export_but"><img src="<?=base_url()?>assets/admin/images/pdf.png"/> <?=lang("export_to_pdf")?></a></li>
					<li><a href="#" id="table_excel2003_export_but"><img src="<?=base_url()?>assets/admin/images/excel2003.png"/> <?=lang("export_to_excel2003")?></a></li>
					<li><a href="#" id="table_excel2007_export_but"><img src="<?=base_url()?>assets/admin/images/excel2007.png"/> <?=lang("export_to_excel2007")?></a></li>
				</ul>
			</div>
		</div>
	</div>
<?php }?>
<table class="table table-bordered table-hover table-checks table-block">
<thead>
<tr>
<th><?=lang("event_title")?></th>
<th><?=lang("event_from")?></th>
<th><?=lang("event_to")?></th>
<th><?=lang("event_location")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$events){?>
<tr><td colspan="6" style="text-align: center;"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($events as $event){?>
<tr>
	<td style="width:35%;"><?=$event->title?></td>
	<td><?=date("Y-m-d", $event->from)?></td>
	<td><?=date("Y-m-d", $event->to)?></td>
	<td><?=$event->location?></td>
	<td><?=($event->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->event["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/event/modifyEvent/<?=$event->common_id?>" class="btn btn-info hovertip btn-info" title="<?=lang("modify_event")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->event["delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/event/deleteEvent/<?=$event->common_id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_event")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
