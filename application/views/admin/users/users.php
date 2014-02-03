<?php if($permissions->users["users_create"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/users/insertUser"><i class="font-plus"></i><?=lang("insert_user")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("users")?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/users/deleteUser" id="table_form">
<div class="table-overflow block well">
<?php if($users){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=($users?"id='data-table'":"")?>>
<thead>
<tr>
<th><input type="checkbox" class="checkbox-all style"/></th>
<th><?=lang("username")?></th>
<th><?=lang("name")?></th>
<th><?=lang("mobile")?></th>
<th><?=lang("email")?></th>
<th><?=lang("group")?></th>
<th><?=lang("active")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<tr>
<?php $admin = $this->musers->getUserById("1")?>
<td></td>
<td><?=$admin->username?></td>
<td><?=$admin->name?></td>
<td><?=$admin->mobile?></td>
<td><?=$admin->email?></td>
<td style="color:<?=$this->musers->getGroupById($admin->group)->color?>;"><?=$this->musers->getGroupById($admin->group)->title?></td>
<td><?=($admin->active==1)?lang("activated"):lang("inactive")?></td>
<td>
<ul class="table-controls">
		<?php if($permissions->users["users_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/users/modifyUser/<?=$admin->id?>" class="btn btn-info hovertip" title="<?=lang("modify_user")?>"><b class="font-file"></b></a> </li>
		<?php }?>
		</ul>
		</td>
</tr>
<?php foreach($users as $user){?>
<?php if($user->id == 1) {continue;}?>
<tr>
	<td><input class="style" type="checkbox" name="user_id[]" value="<?=$user->id?>"/></td> 
	<td><?=$user->username?></td>
	<td><?=$user->name?></td>
	<td><?=$user->mobile?></td>
	<td><?=$user->email?></td>
	<td style="color:<?=$this->musers->getGroupById($user->group)->color?>;"><?=$this->musers->getGroupById($user->group)->title?></td>
	<td><?=($user->active==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->users["users_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/users/modifyUser/<?=$user->id?>" class="btn btn-info hovertip" title="<?=lang("modify_user")?>"><b class="font-file"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
</tbody>
</table>
</div>
<div class="control-group">
<a type="submit" data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog" ><i class="font-remove"></i><?=lang("delete")?></a>
</div>

</form>