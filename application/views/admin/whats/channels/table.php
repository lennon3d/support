<script src="<?=base_url()?>assets/admin/js/plugins/tables/jquery.tablesorter.min.js"></script>
<link type="text/css" rel="stylesheet" href="http://localhost/whats/assets/admin/css/blue/style.css">
<script type="text/javascript">
		$(document).ready(function() {
			$("table").tablesorter();
		});
</script>
<style>
label.control-label{
	width:25% !important;
}

</style>
<form>
<input type="hidden" name="limit" value="<?=$limit?>"/>
<input type="hidden" name="page" value="<?=$page_num?>"/>
<input type="text" name="search"/>

<input type="submit" value="بحث"/>
</form>
<!--
<form class="form-horizontal" method="get" action="">
<input type="hidden" name="limit" value="<?=$limit?>"/>
<input type="hidden" name="page" value="<?=$page_num?>"/>
<div class="block well body row-fluid">
<div class="control-group">
<div class="span4"><label class="control-label">الحالة :</label><div class="controls"><input type="text" name="status" placeholder="الحالة"/></div></div>
<div class="span4"><label class="control-label">المستخدم :</label><div class="controls"><input type="text" name="user" placeholder="المستخدم"/></div></div>
<div class="span4"><label class="control-label">المشكلة :</label><div class="controls"><input type="text" name="reason" placeholder="المشكلة"/></div></div>
</div>
<div class="control-group">
<div class="span4"><label class="control-label">رقم الجوال :</label><div class="controls"><input type="text" name="phone" placeholder="رقم الجوال"/></div></div>
<div class="span4"><label class="control-label">بواسطة :</label><div class="controls"><input type="text" name="added_by" placeholder="بواسطة"/></div></div>
<div class="span4"><div class="controls"><input class="btn btn-success" type="submit" value="بحث" name="submit"/></div></div>
</div>
</div>
</form>
-->
<div class="block well body row-fluid">
<div class="span6">
<?php if($permissions->whats_channels["see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/channels/addChannel"><i class="font-plus"></i><?=lang("add_channel")?></a>
<?php }?>
</div>
<div class="span6">
	<p class="muted">عرض:
	<?php if($channels){?>
		<a href="<?=base_url()?>admin/channels?limit=100"><span class="label label-info">100</span></a>
		<a href="<?=base_url()?>admin/channels?limit=200"><span class="label label-success">200</span></a>
		<a href="<?=base_url()?>admin/channels?limit=500"><span class="label label-important">500</span></a>
		<a href="<?=base_url()?>admin/channels?limit=all"><span class="label label-warning"><?=lang("all")?></span></a>
	<?php }?>
	</p>
</div>
</div>
<div class="table-overflow block well">
<table class="table table-bordered table-hover table-checks table-block">
<tbody>
<?php if($test_user){?>
<tr>
<td style="width:30%;"><?=lang("test_channel")?></td>
<td><?=$test_user->phone?></td>
<td>
<ul class="table-controls">
<li>
<a href="<?=base_url()?>admin/channels/channelContacts/<?=$test_user->id?>" class="btn btn-info hovertip" title="<?=lang("show_messages")?>"><b class="font-envelope"></b></a>
</li>
</ul></td>
</tr>
<?php }?>
<?php if($notify_user){?>
<tr>
<td style="width:30%;"><?=lang("notify_channel")?></td>
<td><?=$notify_user->phone?></td>
<td>
<ul class="table-controls">
<li>
</li>
</ul></td>
</tr>
<?php }?>
</tbody>
</table>
</div>
<form action="" method="post">
<div class="table-overflow block well">
	<div class="navbar">
		<div class="navbar-inner">
<div class="pagination pagination-small pull-right">
	<ul>
		<?php if($limit!="all"){?>
			<li><a href="<?=($page_num>0?base_url()."admin/channels?limit=".$limit."&page=".($page_num-1):"#")?>"><?=lang("prev")?></a></li>
			<?php for($i=0;$i<ceil($channels["count"]/$limit);$i++){?>
			<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?base_url()."admin/channels?limit=$limit&page=$i":"#")?>"><?= $i + 1?></a></li>
			<?php }?>
			<li><a href="<?=(ceil($channels["count"]/$limit)>$page_num+1?base_url()."admin/channels?limit=".$limit."&page=".(int)($page_num+1):"#")?>"><?=lang("next")?></a></li>
		<?php }?>
	</ul>
</div>
		</div>
	</div>
<table class="table table-bordered table-hover table-checks table-block tablesorter">
<thead>
<tr>
<th></th>
<th>ID</th>
<th><?=lang("mobile")?></th>
<th><?=lang("channel_hash")?></th>
<th><?=lang("user")?></th>
<th><?=lang("added_by")?></th>
<!-- <th><?=lang("last_update")?></th>-->
<th><?=lang("last_send")?></th>
<th><?=lang("status")?></th>
<th><?=lang("reason")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$channels["results"]){?>
<tr><td style="text-align: center;" colspan="10"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($channels["results"] as $channel){?>
<tr <?=($this->mchannels->getUserChannel($this->WHATS_SET->test_user)->id==$channel->id?"style='color: #47769A'":"")?>>
	<td><input type="radio" class="style" name="channel_radio" value="<?=$channel->id?>"/></td>
	<td><?=$channel->id?></td>
	<td ><?=$channel->phone?></td>
	<td ><?=$channel->hash?></td>
	<td ><?=($channel->user>0?$this->musers->getUserById($channel->user)->username:lang("no_assign"))?></td>
	<td ><?=$this->musers->getUserById($channel->added_by)->username?></td>
	<!-- <td ><?=date("Y-m-d h:i a",$channel->last_update)?></td>-->
	<td ><?=$this->mwhats->getTimeDef(time(),$channel->last_send)?></td>
	<td><?=$channel->status?></td>
	<td style="width:10%;"><?=$channel->reason?></td>
	<td style="width:10%;">
		<div class="btn-group">
			<button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><?=lang('actions')?> <span class="caret dd-caret"></span></button>
			<ul class="dropdown-menu">
			<?php if($permissions->whats_channels["modify"]=="1"){?>
			<?php $user_channel = $this->mchannels->getUserChannel($this->USER_ID)?>
				<li><a data-toggle="modal" href="<?=base_url()?>admin/channels/checkChannel/<?=$channel->id?>" class="" title="<?=lang("check_channel")?>"><i class="font-search"></i><?=lang("check_channel")?></a></li>
				<?php if($channel->id == $user_channel->id){?><li><a href="<?=base_url()?>admin/channels/channelContacts/<?=$channel->id?>" class="" title="<?=lang("whats_messager")?>"><i class="font-envelope"></i><?=lang("whats_messager")?></a></li><?php }?>
				<li><a data-toggle="modal" href="#assign_channel_user_dialog" id="<?=$channel->id?>" class="assign_channel" title="<?=lang("assign_channel_user")?>"><i class="font-bookmark"></i><?=lang("assign_channel_user")?></a></li>
				<li><a href="<?=base_url()?>admin/channels/channelSettings/<?=$channel->id?>" class="" title="<?=lang("channel_settings")?>"><i class="font-cog"></i><?=lang("channel_settings")?></a></li>
				<?php }?>
				<?php if($permissions->whats_channels["delete"] == "1"){?>
				<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/channels/deleteChannel/<?=$channel->id?>" class="delete_a" title="<?=lang("delete_channel")?>"><i class="font-remove"></i><?=lang("delete_channel")?></a></li>
				<?php }?>
			</ul>
		</div>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
                            <div class="table-footer">
                                <div class="table-actions">
<select name="set_options" class="style">
<option value=""><?=lang("choose_set_option")?></option>
<option value="test"><?=lang("set_test_channel")?></option>
<option value="notify"><?=lang("set_notify_channel")?></option>
</select>
<input type="submit" class="btn btn-inverse" name="set_test_channel" value="<?=lang("execute")?>"/>
</div>
<div class="pagination">
	<ul>
	<?php if($limit!="all"){?>
		<li><a href="<?=($page_num>0?base_url()."admin/channels?limit=".$limit."&page=".($page_num-1):"#")?>"><?=lang("prev")?></a></li>
	<?php for($i=0;$i<ceil($channels["count"]/$limit);$i++){?>
		<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?base_url()."admin/channels?limit=$limit&page=$i":"#")?>"><?= $i + 1?></a></li>
	<?php }?>
		<li><a href="<?=(ceil($channels["count"]/$limit)>$page_num+1?base_url()."admin/channels?limit=".$limit."&page=".(int)($page_num+1):"#")?>"><?=lang("next")?></a></li>
	<?php }?>
	</ul>
</div>
</div>
</form>
<!-- assign user to a channel-->
<div id="assign_channel_user_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<form action="" method="post">
	<input type="hidden" name="channel" id="assign_channel_hidden"/>
	<input type="hidden" name="assign_channel" />
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("assign_channel_user") ?>
		</h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="control-group">
				<label class="control-label"><?=lang("choose_user")?>: </label>
				<div class="controls">
					<select name="user_select" data-placeholder="<?=lang("choose_user")?>" class="select" tabindex="2">
					<option value=""></option>
					<?php foreach($users as $user){?>
					<option value="<?=$user->id?>"><?=$user->username?></option>
					<?php }?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
		<button type="submit" class="btn btn-primary" id="assign_channel_btn">
			<?= lang("assign")?>
		</button>
	</div>
	</form>
</div>