<?php if($permissions->services["create"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/services/insertService"><i class="font-plus"></i><?=lang("insert_service")?></a>
<?php }?>
<form method="post" action="<?=base_url()?>admin/services/setOrder">
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block">
<thead>
<tr>
<th><?=lang("service_title")?></th>
<th><?=lang("service_thumb")?></th>
<th><?=lang("service_url")?></th>
<th><?=lang("order")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$services){?>
<tr><td style="text-align: center;" colspan="6"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($services as $service){?>
<tr>
	<td style="width:20%;"><?=$service->title?></td>
	<td style="width:20%;" ><img style="width:100px; height:100px;" src="<?=base_url().$service->thumb?>"/></td>
	<td><?=($service->url == "0"?$service->out_url:$service->url)?></td>
	<td><input type="text" value="<?=$service->order?>" name="services[<?=$service->common_id?>]"/></td>
	<td><?=($service->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->services["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/services/modifyService/<?=$service->common_id?>" class="btn hovertip btn-info" title="<?=lang("modify_service")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->services["delete"] == "1"){?>	
			<li><a data-toggle="modal" id="<?=base_url()?>admin/services/deleteService/<?=$service->common_id?>" href="#confirm_delete_dialog" class="btn btn-red hovertip delete_a" title="<?=lang("delete_service")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-inverse" ><?=lang("set_order")?></button>
</div>
</div>
</form>