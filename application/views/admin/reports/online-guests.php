<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block" <?=(!$guests?"":"id='data-table'")?>>
<thead>
<tr>
<th><?=lang("enter_time")?></th>
<th><?=lang("ipaddress")?></th>
<th><?=lang("useragent")?></th>
<th><?=lang("current_page")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$guests){?>
<tr><td style="text-align: center;" colspan="6"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($guests as $guest){?>
<tr>
	<td style="width:20%"><?=date("Y-m-d h:i a", $guest->enter_time)?></td>
	<td><?=$guest->ipaddress?></td>
	<td style="width:30%;"><?=$guest->useragent?></td>
	<td><?=$guest->current_page?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->blockip["create"]=="1"){?>
			<li><a href="<?=base_url()?>admin/guests/blockGuest/<?=$guest->id?>" class="btn btn-danger hovertip" title="<?=lang("block_guest")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
