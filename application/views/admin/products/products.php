<?php if($permissions->products["products_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/products/insertProduct"><i class="font-plus"></i><?=lang("insert_product")?></a>
<!-- <a class="btn btn-inverse" href="<?=base_url()?>admin/products/updateTitles"><i class="font-pencil"></i><?=lang("update_products_titles")?></a>-->
<a class="btn btn-info" href="<?=base_url()?>admin/products/categories"><i class="font-slider"></i><?=lang("categories")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("products")?>" />
	<input type="hidden" name="method" />
</form>
<form method="post" action="<?=base_url()?>admin/products/setOrder">
<div class="table-overflow block well">
<?php if($products){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=(!$products?"":"id='data-table'")?>>
<thead>
<tr>
<th><?=lang("product_title")?></th>
<th><?=lang("cat_title")?></th>
<th><?=lang("product_subtitle")?></th>
<th><?=lang("active")?></th>
<th><?=lang("in_slider")?></th>
<th><?=lang("order")?></th>
<th><?=lang("language")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$products){?>
<tr><td style="text-align: center;" colspan="8"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($products as $product){?>
<tr>
	<td><?=$product->title?></td>
	<td><?=$this->mproducts->getCatById($product->category)->title?></td>
	<td><?=$product->subtitle?></td>
	<td><?=($product->active?lang("activated"):lang("inactive"))?></td>
	<td><?=($product->in_slider?lang("yes"):lang("no"))?></td>
	<td><input type="text" value="<?=$product->order?>" name="product[<?=$product->id?>]"/></td>
	<td><?=$this->mfunctions->getLangByCode($this->mproducts->getCatById($product->category)->lang)->language?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->products["products_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/products/modifyProduct/<?=$product->id?>" class="btn btn-info hovertip" title="<?=lang("modify_product")?>"><b class="font-cog"></b></a> </li>
			<li><a href="<?=base_url()?>admin/products/slides/<?=$product->id?>" class="btn btn-success hovertip" title="<?=lang("slider")?>"><b class="font-th"></b></a> </li>
		<?php }?>
		<?php if($permissions->products["products_delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/products/deleteProduct/<?=$product->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_product")?>"><b class="font-remove"></b></a> </li>
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