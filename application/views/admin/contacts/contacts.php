<?php if($permissions->langs_titles["see"]=="1"){?>
<!-- <a class="btn btn-inverse" href="<?=base_url()?>admin/contacts/updateTitles"><i class="font-pencil"></i><?=lang("update_contacts_titles")?></a>-->
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="method" />
	<input type="hidden" name="table" value="<?=lang("contacts")?>" />
</form>
<form method="post" action="<?=base_url()?>admin/contacts/deleteContacts" id="table_form">
<div class="table-overflow block well">
<?php if($contacts){?>
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
<table class="table table-bordered table-hover table-checks table-block" id="<?=(!$contacts?"":"data-table")?>">
<thead>
<tr>
<th><input type="checkbox" class="checkbox-all style"/></th>
<th><?=lang("name")?></th>
<th><?=lang("datetime")?></th>
<th><?=lang("email")?></th>
<th><?=lang("mobile")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$contacts){?>
<tr><td colspan="6" style="text-align: center;"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($contacts as $contact){?>
<tr>
	<td><input class="style" type="checkbox" name="contacts[]" value="<?=$contact->id?>"/></td>
	<td><?=$contact->name?></td>
	<td><?=date("Y-m-d s:i a",$contact->datetime)?></td>
	<td><?=$contact->email?></td>
	<td><?=$contact->mobile?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->contacts_reply["see"] == "1"){?>	
			<li><a href="<?=base_url()?>admin/contacts/showContactus/<?=$contact->id?>" class="btn hovertip btn-success" title="<?=lang("show_contactus")?>"><b class="font-file"></b></a> </li>
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
	<a type="submit" data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog" ><i class="font-remove"></i><?=lang("delete")?></a>
</div>

</form>