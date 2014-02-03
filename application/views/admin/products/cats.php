<?php if($permissions->products["products_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/products/insertCat"><i class="font-plus"></i><?=lang("insert_cat")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("categories")?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/products/setCatsOrder">
<div class="table-overflow block well">
<?php if($cats){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=(!$cats?"":"id='data-table'")?>>
<thead>
<tr>
<th><?=lang("cat_title")?></th>
<th><?=lang("order")?></th>
<th><?=lang("active")?></th>
<th><?=lang("language")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$cats){?>
<tr><td style="text-align: center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($cats as $cat){?>
<tr>
	<td style="width:30%;"><?=$cat->title?></td>
	<td><input type="text" value="<?=$cat->order?>" name="cats[<?=$cat->id?>]"/></td>
	<td><?=($cat->active?lang("activated"):lang("inactive"))?></td>
	<td><?=$this->mfunctions->getLangByCode($cat->lang)->language?></td>
	<td>
		<ul class="table-controls">
			<li><a href="<?=base_url()?>admin/products/index/<?=$cat->id?>" class="btn btn-success hovertip" title="<?=lang("show_cat_products")?>"><b class="font-file"></b></a> </li>
		<?php if($permissions->products["products_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/products/modifyCat/<?=$cat->id?>" class="btn btn-info hovertip" title="<?=lang("modify_cat")?>"><b class="font-cog"></b></a> </li>
		<?php }?>
		<?php if($permissions->products["products_delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/products/deleteCat/<?=$cat->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_cat")?>"><b class="font-remove"></b></a> </li>
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