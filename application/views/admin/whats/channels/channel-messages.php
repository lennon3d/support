<!-- Timeline messages -->
<div class="block well">
	<div class="body">
<?php if($messages == 3){?>
<div style="text-align: center;"><?=lang("number_unavailable")?></div>
<?php }elseif(count($messages)<1){?>
<div style="text-align: center;"><?=lang("no_messages")?></div>
<?php }else{?>
		<div class="timeline-messages">
<?php foreach($messages as $message){?>
<?php if(isset($message["message"])){?>
	<!-- Comment -->
			<div class="message">
				<div class="message-body">
					<div class="text">
						<p><?=$message["message"]?></p>
					</div>
					<p class="attribution">
						by <a href="#non"><?=$message["from"]?></a> at <?=$message["time"]?>
			</p>
				</div>
			</div>
			<!-- /comment -->
	<?php }?>
	<?php }?>
	<?php }?>
</div>
	</div>
</div>