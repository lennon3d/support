<?php $default_profile = base_url()."assets/uploads/whatsapp/profile/default.jpeg"?>
<script src="<?=base_url()?>assets/site/js/whatsapp/messaging.js"></script>
<script src="<?=base_url()?>assets/site/js/whatsapp/send.js"></script>
<link href="<?=base_url()?>assets/admin/css/emoji/emoji.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(){
	getChannelInbound("<?=$channel_id?>");
	//getUngotenMessages();
});
</script>
<style>
.emoji{
	cursor:pointer;
}
#fake_message {
                        height: 90px;
                        display:block;
                        background-color: #FFF;
                        padding: 5px;
                        border: 1px solid #e5e5e5;
                        border-radius: 5px;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                        box-shadow: 0 1px 2px rgba(0,0,0,.05);
                        font-size: 13px;
                        overflow-y: auto;
                        white-space: pre-wrap;
}
img.emoji {
    content: "";
    cursor: pointer;
    display: inline-block;
    padding-bottom: 2px;
    padding-left: 2px;
    padding-right: 2px;
    padding-top: 2px;
}
.icons-showcase li{
	width:10% !important;
}
.dropdown-menu{
	min-width: 250px;
}
.btn-group > .dropdown-toggle {
	padding:2px !important;
}
</style>
<!-- Timeline messages -->
<div class="block well">
	<div class="body">
		<div class="timeline-messages">
		<?php if(!$messages){?>
<div style="text-align: center;"><?=lang("no_contacts")?></div>
<?php }else{?>
<?php foreach($messages as $array){?>
	<!-- Comment -->
	<?php $filename = './assets/uploads/whatsapp/profile/preview_'.$array["number"].'.jpg'?>
	<?php $file_url = base_url().'assets/uploads/whatsapp/profile/preview_'.$array["number"].'.jpg'?>

			<div class="message" id="contact_<?=$array["number"]?>">
			<a class="message-img" href="#"><img src="<?=(file_exists($filename)?$file_url:$default_profile)?>" alt="" /></a>
				<div class="message-body">
					<div class="text" style="<?=($array["count"]>0?"background-color: #CFFFC8;":"")?>">
						<p>
						<a id="message-text" href="<?=base_url()?>admin/channels/channelConver/<?=$channel_id?>/<?=$array["number"]?>"><?=$array["message"]?></a>
						<span class="badge <?=($array["count"] <1?"badge-inverse":"badge-success")?> pull-right"><?=$array["count"]?></span>
						</p>
					</div>
					<p class="attribution">
						<a href="#non"></a><?=$array["nickname"]?>~<?=$array["number"]?>
			</p>
				</div>
			</div>
			<!-- /comment -->
	<?php }?>
	<?php }?>
</div>
		<?php $channel = $this->mwhats->getChannelById($channel_id)?>
		<?php if($channel->last_send < time() - 9 * 3600){?>
<div class="enter-message-divider"></div>
<!-- Enter message input -->

<form id="conv_send_form" class="form-horizontal" method="post" action="">
<input type="hidden" class="" id="conv_channel_text" name="channel_id" value="<?=$channel_id?>"/>
	<fieldset>
	<div class="row-fluid">
	<div class="control-group">
	<label class="control-label"><?=lang("rec_number")?>: <span class="req">*</span></label>
	<div class="controls"><input type="text" id="conv_number_text" class="required span12" name="number"/></div>
	</div>
	<div class="enter-message">
	<div  id="fake_message" class="span12" style="height:75px;" contenteditable="true" ></div>
	<textarea id="conv_message_text" name="message" style="display:none;"	 ></textarea>
	<div class="message-actions">
		<div class="send-button">
		<input type="submit" name="send-message" class="btn btn-success" value="<?=lang("send")?>" />
			</div>
			<?php $this->load->view("admin/whats/channels/emoji")?>
		</div>
	</div>
	</div>
	</fieldset>
	</form>
	<?php }?>

<!-- /enter message input -->
	</div>
</div>