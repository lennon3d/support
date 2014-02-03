<form method="post" action="<?=base_url()?>admin/notify">
<div class="table-overflow block well">
<?php if($notifies){?>
<?php foreach($notifies as $notify){?>
<div style="padding:10px;"><span><?=lang($notify->type)?></span></div>
	<div class="message row-fluid">

	<div dir="rtl" class="message-body">
			<textarea name="message[<?=$notify->type?>]" class="span8"><?=$notify->message?></textarea>
			<div dir="rtl">
			<p class="attribution">
			
			</div>
			<ul class="table-controls">
			<li>
			<div class="controls on_off">
			<div class="checkbox inline">
				<input type="hidden" name = "active[<?=$notify->type?>]" value="0"/>
				<input type="checkbox" id="check20" <?=($notify->active==1?"checked='checked'":"")?> name="active[<?=$notify->type?>]" />
				<label class="toggle-label">مفعل</label>
			</div>
			</div>
			</li>
			</ul>
		</div>
	</div>
	<?php }?>
	<?php }?>
</div>
<button type="submit" class="btn btn-primary" ><?=lang("set")?></button>

</form>