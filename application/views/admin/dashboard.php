<div class="table-overflow block well">
	<div class="navbar">
		<div class="navbar-inner">
		<h5><i class="font-file"></i><?=lang("contactus")?></h5>
		</div>
	</div>
<table class="table table-bordered table-hover table-checks table-block">
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
<?php if(!$contactus){?>
<tr><td colspan="6" style="text-align: center;"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($contactus as $contact){?>
<tr>
	<td><input class="style" type="checkbox" name="contacts[]" value="<?=$contact->id?>"/></td>
	<td><?=$contact->name?></td>
	<td><?=date("Y-m-d h:i a",$contact->datetime)?></td>
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

