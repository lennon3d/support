<?php if($permissions->banners["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/banners/insertBanner"><i class="font-plus"></i><?=lang("insert_banner")?></a>
<?php }?>
<form method="post" action="<?=base_url()?>admin/banners/setOrder">
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block" <?=($banners?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("banner_photo")?></th>
<th><?=lang("banner_url")?></th>
<th><?=lang("banner_position")?></th>
<th><?=lang("order")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$banners){?>
<tr><td style="text-align: center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($banners as $banner){?>
<tr>
	<td><img style="width:100px; height:100px;" src="<?=$banner->photo_url?>"/></td>
	<td><?=$banner->url?></td>
	<td><?=$this->mfunctions->getLangByCode($banner->lang)->language?></td>
	<td><input type="text" value="<?=$banner->order?>" name="banners[<?=$banner->common_id?>]"/></td>
	<td><?=($banner->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->banners["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/banners/modifyBanner/<?=$banner->common_id?>" class="btn hovertip btn-info" title="<?=lang("modify_banner")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->banners["delete"] == "1"){?>	
			<li><a data-toggle="modal" id="<?=base_url()?>admin/banners/deleteBanner/<?=$banner->common_id?>" href="#confirm_delete_dialog" class="btn btn-red hovertip delete_a" title="<?=lang("delete_banner")?>"><b class="font-remove"></b></a> </li>
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