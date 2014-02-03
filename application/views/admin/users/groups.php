<?php if($permissions->users_groups["create"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/users/insertGroup"><i class="font-plus"></i><?=lang("insert_users_group")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("users_groups")?>" />
	<input type="hidden" name="method" />
</form>
<div class="table-overflow block well">
<?php if($groups){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=($groups?"id='data-table'":"")?>>
<thead>
<tr>
<th style="width:20%;"><?=lang("group_title")?></th>
<th><?=lang("group_color")?></th>
<th><?=lang("group_desc")?></th>
<th><?=lang("users_count")?></th>
<th><?=lang("active")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php foreach($groups as $group){?>
<tr>
	<td><?=$group->title?></td>
	<td style="color: <?=$group->color?>;"><?=$group->color?></td>
	<td style="width:30%;"><div style="overflow-y: scroll; height:75px; width:100%;"><?=$group->description?></div></td>
	<td><?=$this->musers->getUsersCount($group->id)?></td>
	<td><?=($group->active==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->users_groups["modify"]=="1"){?>
		
			<li><a href="<?=base_url()?>admin/users/modifyGroup/<?=$group->id?>" class="btn btn-info hovertip" title="<?=lang("modify_users_group")?>"><b class="font-file"></b></a> </li>
			<?php if($group->id != 1){?>
			<li><a href="<?=base_url()?>admin/users/changePermissions/<?=$group->id?>" class="btn btn-success hovertip" title="<?=lang("change_group_permissions")?>"><b class="font-cog"></b></a> </li>
			<?php }?>
		<?php }?>
				<?php if($permissions->users_groups["delete"]=="1"){?>	
				<?php if($group->id != 1 && $group->id != 2 && $group->id != 3){?>
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/users/deleteGroup/<?=$group->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
</tbody>
</table>
</div>
