<?php if($permissions->products["products_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/products/insertSlide/<?=$product->id?>"><i class="font-plus"></i><?=lang("insert_slide")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("slides").' - '.$product->title?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/products/setSlidesOrder/<?=$product->id?>">
<div class="table-overflow block well">
<?php if($slides){?>
	<div class="navbar">
		<div class="navbar-inner">
		<h5><i class="font-home"></i><?=lang("slides").' - '.$product->title?></h5>
		
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
<table class="table table-bordered table-hover table-checks table-block" <?=($slides?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("slide_url")?></th>
<th><?=lang("order")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$slides){?>
<tr><td style="text-align:center;" colspan="3"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($slides as $slide){?>
<tr>
	<td style="width: 60%;"><?=$slide->url?></td>
	<td><input name="slide[<?=$slide->id?>]" type="text" value="<?=$slide->order?>"/></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->products["products_delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/products/deleteSlide/<?=$product->id?>/<?=$slide->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_slide")?>"><b class="font-remove"></b></a> </li>
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