<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("sms_reports")?>" />
	<input type="hidden" name="method" />
</form>
<form action="<?=base_url()?>admin/reports/deleteSmsReports" method="post" id="table_form">
<div class="table-overflow block well">
<?php if($sms_reports){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=(!$sms_reports?"":"id='data-table'")?>>
<thead>
<tr>
<th><input type="checkbox" id="check-all" class="style"/>
<th><?=lang("gate_title")?></th>
<th><?=lang("mobiles_count")?></th>
<th><?=lang("status")?></th>
<th><?=lang("message")?></th>
<th><?=lang("datetime")?></th>
</tr>
</thead>
<tbody>
<?php if(!$sms_reports){?>
<tr><td style="text-align: center;" colspan="7"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($sms_reports as $report){?>
<?php $str = str_replace(array("Success:","Failed:"), array("<span style='color:green; font-weight:bold;'>Success: </span>","<span style='font-weight:bold;color:red;'>Failed: </span>"), $report->status)?>
<tr>
	<td><input class="style" type="checkbox" value="<?=$report->id?>" name="reports[]"/></td>
	<td><?=$report->gate?></td>
	<td><a target="_blank" href="<?=base_url()?>admin/reports/showMobiles/<?=$report->id?>"><?=count(explode(",",$report->mobiles))?></a></td>
	<td><div style="overflow-y:scroll; height:75px; direction:ltr;"><?=$str?></div></td>
	<td style="width:30%;"><div style="overflow-y: scroll; height:75px; width:100%;"><?=$report->message ?></div></td>
	<td style="width:20%"><?=date("Y-m-d h:i a", $report->datetime)?></td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
<?php if($permissions->sms_reports["delete"]=="1"){?>
<div class="control-group">
	<a type="submit" data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog"><i class="font-remove"></i><?=lang("delete") ?></a>
</div>
<?php }?>
</form>