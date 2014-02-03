<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("visits")?>" />
	<input type="hidden" name="method" />
</form>
<form action="<?=base_url()?>admin/reports/deleteVisitReports" method="post" id="table_form">
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block" <?=(!$visits?"":"id='data-table'")?>>
<thead>
<tr>
<th><input type="checkbox" id="check-all" class="style"/>
<th><?=lang("day_date")?></th>
<th><?=lang("visits_count")?></th>
</tr>
</thead>
<tbody>
<?php if(!$visits){?>
<tr><td style="text-align: center;" colspan="7"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($visits as $visit){?>
<tr>
	<td style="width:10%;"><input class="style" type="checkbox" value="<?=$visit->id?>" name="reports[]"/></td>
	<td style="width:20%"><?=$this->mreports->dayReplace(date("D، j-M Y", $visit->date))?></td>
	<td style="width:40%;"><?=$visit->count?></td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
<?php if($permissions->actions["delete"]=="1"){?>
<div class="control-group">
	<a type="submit" data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog"><i class="font-remove"></i><?=lang("delete") ?></a>
</div>
<?php }?>
</form>