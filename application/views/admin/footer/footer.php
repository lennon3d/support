<?php if($permissions->footer["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/footer/insertFooter"><i class="font-plus"></i><?=lang("insert_footer")?></a>
<?php }?>
<?php if($permissions->langs_titles["see"]=="1"){?>
<!-- <a class="btn btn-inverse" href="<?=base_url()?>admin/footer/updateTitles"><i class="font-pencil"></i><?=lang("update_footer_titles")?></a>-->
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("footer")?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/footer/setOrder">
<div class="table-overflow block well">
<?php if($footers){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=($footers?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("footer_title")?></th>
<th><?=lang("footer_position")?></th>
<th><?=lang("footer_url")?></th>
<th><?=lang("order")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$footers){?>
<tr><td style="text-align: center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($footers as $footer){?>
<tr>
	<td style="width:20%;"><?=$footer->title?></td>
	<td><?=$this->mfooter->getPositionByArrayKey($footer->position)?></td>
	<td style="width:30%;"><?=$footer->url?></td>
	<td><input type="text" value="<?=$footer->order?>" name="footer[<?=$footer->common_id?>]"/></td>
	<td><?=($footer->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->footer["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/footer/modifyFooter/<?=$footer->common_id?>" class="btn btn-info hovertip" title="<?=lang("modify_footer")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->footer["delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/footer/deleteFooter/<?=$footer->common_id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_footer")?>"><b class="font-remove"></b></a> </li>
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