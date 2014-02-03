<?php if($permissions->videos["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/videos/insertVideo"><i class="font-plus"></i><?=lang("insert_video")?></a>
<?php }?>
<form method="post" action="<?=base_url()?>admin/videos/setOrder">
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block" <?=($videos?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("video_thumb")?></th>
<th><?=lang("video_title")?></th>
<th><?=lang("order")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$videos){?>
<tr><td style="text-align: center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($videos as $video){?>
<tr>
	<td style="width:30%;" ><img style="width:100px; height:100px;" src="<?=$video->thumb_url?>"/></td>
	<td ><?=$video->title?></td>
	<td><input type="text" value="<?=$video->order?>" name="video[<?=$video->common_id?>]"/></td>
	<td><?=($video->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->videos["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/videos/modifyVideo/<?=$video->common_id?>" class="btn btn-info hovertip" title="<?=lang("modify_video")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->videos["delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/videos/deleteVideo/<?=$video->common_id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_video")?>"><b class="font-remove"></b></a> </li>
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