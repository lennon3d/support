<div class="well">
<table class="table table-bordered table-hover table-checks table-block">
<tbody>
<tr><td style="width:20%;"><?=lang("contact_name")?>: </td><td style="width:70%;"><label><?=$contact->name?></label></td></tr>
<tr><td style="width:20%;"><?=lang("datetime")?>: </td><td style="width:70%;"><label><?=date("Y-m-d s:i a", $contact->datetime)?></label></td></tr>
<tr><td style="width:20%;"><?=lang("contact_email")?>: </td><td style="width:70%;"><label><?=$contact->email?></label></td></tr>
<tr><td style="width:20%;"><?=lang("contact_mobile")?>: </td><td style="width:70%;"><label><?=$contact->mobile?></label></td></tr>
<tr><td style="width:20%;"><?=lang("contact_country")?>: </td><td style="width:70%;"><label><?=$contact->country?></label></td></tr>
<tr><td style="width:20%;"><?=lang("contact_company")?>: </td><td style="width:70%;"><label><?=$contact->company?></label></td></tr>
<tr><td style="width:20%;"><?=lang("contact_content")?>: </td><td style="width:70%;"><div><?=$contact->body?></div></td></tr>
</tbody>
</table>
<?php if ($this->permissions->contacts_reply ["see"] != "1")?>
<?php if(!$replies){?>
<div class="well" style="padding:20px; text-align: center;"><?=lang("no_replies")?></div>
<?php }else{?>
<?php foreach($replies as $reply){?>
	<!-- Reply -->
	<div class="message">
		<a class="message-img" href="#"><img src="images/chat-user1.png" alt="" /></a>
		<div dir="rtl" class="message-body">
			<div class="text"><p><?=$reply->content?></p></div>
			<div dir="rtl"><p class="attribution"><?=lang("replied_by")?><a <?=($this->permissions->users["users_modify"]=="1"?"href='".base_url()."admin/users/modifyUser/".$reply->user."'":"")?>><?=$this->musers->getUserById($reply->user)->username?></a> <?=date("Y-m-d i:s a", $reply->datetime)?></p></div>
		</div>
	</div>
	<!-- /Reply -->
	<?php }?>
	<?php }?>
</div>
<?php if ($this->permissions->contacts_reply ["create"] == "1"){?>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/contacts/showContactus/<?=$contact->id?>">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("reply_content")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="required span12" name="content" id="" ><?=set_value("content")?></textarea>
					</div>
				</div>													
				<div class="form-actions align-right"><input type="submit" value="<?= lang("send_reply")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>
<?php }?>
