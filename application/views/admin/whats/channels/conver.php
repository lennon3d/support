<script src="<?=base_url()?>assets/site/js/whatsapp/send.js"></script>
<script src="<?=base_url()?>assets/site/js/whatsapp/messaging.js"></script>
<link href="<?=base_url()?>assets/admin/css/emoji/emoji.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(){
	var conv_div = document.getElementById("conv_container_div");
	if(conv_div != null)
		conv_div.scrollTop = conv_div.scrollHeight;
	$(document).ready(function(){
		getNumberInbound(<?=$channel_id?>,<?=$number?>);
	});
});
</script>

<div class="block">
<div class="body well">
		<?php if(!$messages){?>
<div style="text-align: center;"><?=lang("no_messages")?></div>
<?php }else{?>
	<!-- Messages -->
	<div style="overflow-y: scroll; height:300px;" id="conv_container_div">
	<ul class="messages" id="conv_container_ul">
<?php foreach($messages as $message){?>
		<!-- Message -->
		<li class="<?=($message->user_id == 0?"by-user":"by-me")?>"><a href="#" title="">
		<img src="<?=($message->user_id == 0?base_url()."assets/uploads/whatsapp/profile/preview_".$number.".jpg":$channel->profile_pic)?>" style="width:44px;height:44px;" alt="" /></a>
			<div class="area">
				<span class="arrow"></span>
				<div class="info-row">
					<span class="pull-left"><strong><?=($message->user_id == 0?$number:lang("by_me"))?></strong></span> <span
						class="pull-right"><?=$this->mwhats->getTimeDef(time(),$message->time)?></span>
				</div>
						<p>
		<?php switch($message->type){
			case "text":
				echo "<span class='$message->message'>$message->message</span>";
				break;
			case "image":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message->message'/></a>";
				break;
			case "audio":
				echo "<audio controls><source src='".$message->message."' type='audio/aac'>المتصفح لا يدعم لاحقة aac</audio> ";
				break;
			case "video":
				echo "<video controls><source src='".$message->message."' type='video/mp4'>المتصفح لا يجعم لاحقة mp4</video>";
				break;
			case "card":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message->message'/></a>";
				break;
			case "location":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message->message'/></a>";
				break;
		}?>
		</p>
			</div></li>
		<!-- /message -->
		<?php }?>
	</ul>
	</div>
		<?php }?>
		<?php $channel = $this->mwhats->getChannelById($channel_id)?>
		<?php if($channel->last_send < time() - 9 * 3600){?>
<div class="enter-message-divider"></div>
<!-- Enter message input -->
<form id="conv_send_form" class="form-horizontal" method="post" action="">
	<input type="hidden" class="" id="conv_number_text" name="number" value="<?=$number?>"/>
	<input type="hidden" class="" id="conv_channel_text" name="channel_id" value="<?=$channel_id?>"/>
	<div class="enter-message">
	<div id="fake_message" class="span12" style="height:75px;" contenteditable="true" ></div>
	<textarea id="conv_message_text" name="message" style="display:none;"	 ></textarea>
	<div class="message-actions">
		<div class="send-button">
		<input type="submit" name="send-message" class="btn btn-success" value="<?=lang("send")?>" />
			</div>
			<?php $this->load->view("admin/whats/channels/emoji")?>
		</div>
	</div>
</form>
<?php }?>

<!-- /enter message input -->

</div>
</div>