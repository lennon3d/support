<?php if($permissions->languages["lang_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/langs/insertLang"><i class="font-plus"></i><?=lang("insert_lang")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="method" />
	<input type="hidden" name="table" value="<?=lang("langs")?>" />
</form>
<form method="post" action="<?=base_url()?>admin/langs/setDefaultLang">
<div class="table-overflow block well">
<?php if($langs){?>
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
<table class="table table-bordered table-hover table-checks table-block" <?=($langs?"id='data-table'":"")?>>
<thead>
<tr>
<th></th>
<th><?=lang("language")?></th>
<th><?=lang("lang_code")?></th>
<th><?=lang("default")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$langs){?>
<tr><td style="text-align:center;" colspan="5"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($langs as $lang){?>
<tr>
	<td><input type="radio" name="lang" value="<?=$lang->id?>" <?=($lang->default==1?"checked='checked'":"")?>/></td> 
	<td><?=$lang->language?></td>
	<td><?=$lang->code?></td>
	<td <?=($lang->default=="1"?"style='color:green;'":"style='color:red'")?>><?=($lang->default==1?lang("yes"):lang("no"))?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->languages["lang_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/langs/modifyLang/<?=$lang->id?>" class="btn btn-info hovertip" title="<?=lang("modify_lang")?>"><b class="font-file"></b></a> </li>
		<?php }?>
		<?php if($permissions->languages["lang_delete"] == "1"){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/langs/deleteLang/<?=$lang->id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete_lang")?>"><b class="font-remove"></b></a> </li>
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
<button type="submit" class="btn btn-inverse" ><i class=""></i><?=lang("set_default")?></button>
</div>

</form>