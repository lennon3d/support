<form action="<?= base_url()?>admin/users/changePermissions/<?=$group_id?>" method="post" class="form-horizontal">
	<div class="block well">
		<div class="table-overflow">
			<table id="notes_table"
				class="table table-block table-bordered table-checks"
				id="notes_table">
				<thead>
					<tr>
						<th width="150px"><?= lang("table")?></th>
						<th><?= lang("see")?></th>
						<th><?= lang("create")?></th>
						<th><?= lang("modify")?></th>
						<th><?= lang("delete")?></th>
						<th><?= lang("choose_row")?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($permissions1 as $key =>$permission){?>
					<tr><td><?= lang($key)?></td>
					<?php foreach($permission as $key1=> $value){?>
					<td><?php if($value!=""){?> 
					<input type="hidden" name="permissions[<?=$key."_".$key1?>]" value="0" />
					<input name="permissions[<?=$key."_".$key1?>]" type="checkbox" class="permissions_checks style" <?= ($value=="1")?"checked='checked'":''; ?> value="1" /> 
					<?php }?>
					</td>
					<?php }?>
					<td><input type="checkbox" class="permission_row_check style" /></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
		<div class="form-actions align-right">
			<button type="submit" class="btn btn-primary"><?= lang('modify') ?></button>
		</div>		
	</div>
</form>