<div class="well">
<?php if ($this->permissions->comments["see"] != "1")?>
<?php if(!$comments){?>
<div style="text-align: center; padding:20px;"><?=lang("no_comments")?></div>
<?php }else{?>
<?php foreach($comments as $comment){?>
	<!-- Reply -->
	<div class="message block row-fluid">
		<div dir="rtl" class="message-body">
			<form method="post" action="<?=base_url()?>admin/pages/modifyComment/<?=$page_id.DIRECTORY_SEPARATOR.$comment->id?>">
			<textarea name="comment" class="span8"><?=$comment->comment?></textarea>
			<div dir="rtl">
			<p class="attribution">
			<?=lang("commented_by")?>
			<?php if($comment->user!=0){?>
			<a <?=($this->permissions->users["users_modify"]=="1"?"href='".base_url()."admin/users/modifyUser/".$comment->user."'":"")?>>
			<?=$this->musers->getUserById($comment->user)->username?></a>
			<?php }else{?>
			<span><?=$comment->name?></span>
			<?php }?>
			<?=date("Y-m-d i:s a", $comment->datetime)?></p>
			<span>Ip: <?=$comment->ipaddress?></span>
			</div>
			<ul class="table-controls">
			<li><a class="btn btn-red" href="<?=base_url()?>admin/pages/deleteComment/<?=$page_id.DIRECTORY_SEPARATOR.$comment->id?>"><b class="font-remove"></b></a></li>
			<li><button type="submit" class="btn btn-primary" ><i class="font-pencil" style="color:white;"></i></button></li>
			</ul>
			</form>
		</div>
	</div>
	<!-- /Reply -->
	<?php }?>
	<?php }?>
</div>
<?php if ($this->permissions->comments ["create"] == "1"){?>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/pages/insertComment/<?=$page_id?>">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?=lang("comment_content")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="required span12" name="comment" id="" ><?=set_value("comment")?></textarea>
					</div>
				</div>													
				<div class="form-actions align-right"><input type="submit" value="<?= lang("send_comment")?>" class="btn btn-primary" /></div>										
			</div>
		</div>
	</fieldset>
</form>
<?php }?>
