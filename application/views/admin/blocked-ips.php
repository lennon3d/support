<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("users_actions")?>" />
	<input type="hidden" name="method" />
</form>
<div class="table-overflow block well">
<?php if($ips){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=(!$ips?"":"id='data-table'")?>>
<thead>
<tr>
<th><?=lang("ipaddress")?></th>
<th><?=lang("datetime")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$ips){?>
<tr><td style="text-align: center;" colspan="6"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($ips as $ip){?>
<tr>
	<td style="width:30%"><?=$ip->ipaddress?></td>
	<td style="width:30%"><?=date("Y-m-d s:i a", $ip->datetime)?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->blockip["delete"]=="1"){?>
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/guests/unBlockGuest/<?=$ip->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("unblock_guest")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
