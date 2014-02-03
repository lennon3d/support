<?php if($permissions->slider["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/slider/insertSlide"><i class="font-plus"></i><?=lang("insert_slide")?></a>
<?php }?>
<form method="post" action="<?=base_url()?>admin/slider/setOrder">
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block" id="data-table">
<thead>
<tr>
<th><?=lang("slide_photo")?></th>
<th><?=lang("slide_url")?></th>
<th><?=lang("order")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$slides){?>
<tr><td colspan="7"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($slides as $slide){?>
<tr>
	<td><img style="width:100px; height:100px;" src="<?=base_url().str_replace("..","",$slide->photo_url)?>"/></td>
	<td><?=$slide->url?></td>
	<td><input type="text" value="<?=$slide->order?>" name="slider[<?=$slide->id?>]"/></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->slider["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/slider/modifySlide/<?=$slide->id?>" class="btn btn-info hovertip" title="<?=lang("modify_slide")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->slider["delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/slider/deleteSlide/<?=$slide->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_slide")?>"><b class="font-remove"></b></a> </li>
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
<button type="submit" class="btn btn-inverse" ><?=lang("set_order")?></button>
</div>

</form>