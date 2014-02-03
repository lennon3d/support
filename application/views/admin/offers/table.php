<?php if($permissions->offers["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/offers/insert"><i class="font-plus"></i><?=lang("insert_offer")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="method" />
	<input type="hidden" name="table" value="<?=lang("offers")?>" />
</form>
<form method="post" action="<?=base_url()?>admin/offers/setOrder">
<div class="table-overflow block well">
<?php if($offers){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?($offers?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("offer_title")?></th>
<th><?=lang("offer_thumb")?></th>
<th><?=lang("order")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$offers){?>
<tr><td style="text-align:center;" colspan="4"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($offers as $offer){?>
<tr>
	<td style="width:20%;"><?=$offer->title?></td>
	<td style="width:30%;" ><img style="width:100px; height:100px;" src="<?=$offer->thumb?>"/></td>
	<td><input type="text" value="<?=$offer->order?>" name="offer[<?=$offer->common_id?>]"/></td>
	<td><?=($offer->status==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->offers["modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/offers/modify/<?=$offer->common_id?>" class="btn btn-info hovertip" title="<?=lang("modify_offer")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->offers["delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/offers/delete/<?=$offer->common_id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_offer")?>"><b class="font-remove"></b></a> </li>
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