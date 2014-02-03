<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("users_actions")?>" />
	<input type="hidden" name="method" />
</form>
<form action="<?=base_url()?>admin/reports/deleteActionReports" method="post" id="table_form">
<div class="table-overflow block well">
<?php if($actions){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=(!$actions?"":"id='data-table'")?>>
<thead>
<tr>
<th><input type="checkbox" id="check-all" class="style"/>
<th><?=lang("username")?></th>
<th><?=lang("ipaddress")?></th>
<th><?=lang("datetime")?></th>
<th><?=lang("action")?></th>
<th><?=lang("table")?></th>
</tr>
</thead>
<tbody>
<?php if(!$actions){?>
<tr><td style="text-align: center;" colspan="7"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($actions as $action){?>
<tr>
	<td><input class="style" type="checkbox" value="<?=$action->id?>" name="reports[]"/></td>
	<td><a href="<?=base_url()?>admin/reports/actionsReports?user=<?=$action->user?>"><?=$action->user?></a></td>
	<td><?=$action->ipaddress?></td>
	<td style="width:20%"><?=date("Y-m-d h:i a", $action->datetime)?></td>
	<td><?=lang($action->action)?></td>
	<td><?=lang($action->table)?></td>
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