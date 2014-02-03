<?php if($permissions->news["news_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/news/insertNew"><i class="font-plus"></i><?=lang("insert_new")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("news")?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/news/setOrder">
<div class="table-overflow block well">
<?php if($news){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=($news?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("new_title")?></th>
<th><?=lang("order")?></th>
<th><?=lang("position")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$news){?>
<tr><td style="text-align: center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($news as $new){?>
<tr>
	<td style="width:30%;"><?=$new->title?></td>
	<td><input type="text" value="<?=$new->order?>" name="new[<?=$new->common_id?>]"/></td>
	<td><?=$this->mnews->getPosition($new->position)?></td>
	<td><?=($new->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->news["news_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/news/modifyNew/<?=$new->common_id?>" class="btn btn-info hovertip" title="<?=lang("modify_new")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->news["news_delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/news/deleteNew/<?=$new->common_id?>"  class="btn btn-red hovertip delete_a" title="<?=lang("delete_new")?>"><b class="font-remove"></b></a> </li>
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