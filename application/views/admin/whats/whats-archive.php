<?php if($archive){?>
<div class="block well body row-fluid">
<div class="span4">
	<p class="muted">عرض:
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=10&page_num=<?=$page_num?>"><span class="label label-info">10</span></a>
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=25&page_num=<?=$page_num?>"><span class="label label-info">25</span></a>
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=100&page_num=<?=$page_num?>"><span class="label label-info">100</span></a>
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=200&page_num=<?=$page_num?>"><span class="label label-success">200</span></a>
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=500&page_num=<?=$page_num?>"><span class="label label-important">500</span></a>
		<a href="<?=base_url()?>admin/reports/WhatsArchive?limit=all&page_num=<?=$page_num?>"><span class="label label-warning"><?=lang("all")?></span></a>
	</p>
</div>
<div class="span4">
<button class="btn btn-inverse" onClick="javascript:$('#search_form').toggle()"><b class="font-search"></b>بحث</button>
</div>
</div>
	<?php }?>
<form style="<?=(!isset($_GET["search"])?"display: none;":"")?>" class="form-horizontal" method="get" action="" id="search_form">
<input type="hidden" name="limit" value="<?=$limit?>"/>
<input type="hidden" name="page" value="<?=$page_num?>"/>
<div class="block well body row-fluid">
<div class="control-group">
<div class="span4"><label class="control-label">الحالة :</label><div class="controls"><input value="<?=$status?>" type="text" name="status" placeholder="الحالة"/></div></div>
<div class="span4"><label style="width:35%;" class="control-label">الاسم المستعار :</label><div class="controls"><input value="<?=$nickname?>" type="text" name="nickname" placeholder="الاسم المستعار"/></div></div>
<div class="span4"><label style="width:35%;" class="control-label">المستخدم :</label><div class="controls"><input value="<?=$user?>" type="text" name="user" placeholder="المستخدم"/></div></div>
</div>
<div class="control-group">
<div class="span4"><label style="width:35%;" class="control-label">رقم الجوال :</label><div class="controls"><input value="<?=$number?>" type="text" name="number" placeholder="رقم الجوال"/></div></div>
<div class="span4"><label class="control-label">الرسالة :</label><div class="controls"><textarea name="message"><?=$message?></textarea></div></div>

<div class="span4"><div class="controls"><input class="btn btn-success" type="submit" value="بحث" name="search"/></div></div>
</div>
</div>
</form>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display: none;" name="tbody"></textarea>
	<textarea style="display: none;" name="thead"></textarea>
	<input type="hidden" name="table" value="<?=lang("whats_archive")?>" />
	<input type="hidden" name="method" />
</form>
<form action="" method="post" id="table_form">
<div class="table-overflow block well">
<?php if($archive){?>
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
		<div class="pagination pagination-small pull-right">
			<ul>
			<?php if($limit!="all"){?>
				<li><a href="<?=($page_num>0?base_url()."admin/reports/WhatsArchive?limit=".$limit."&page_num=".($page_num-1):"#")?>"><?=lang("prev")?></a></li>
			<?php for($i=0;$i<ceil($archive["count"]/$limit);$i++){?>
				<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?base_url()."admin/reports/WhatsArchive?limit=$limit&page_num=".$i:"#")?>"><?= $i + 1?></a></li>
			<?php }?>
				<li><a href="<?=(ceil($archive["count"]/$limit)>$page_num+1?base_url()."admin/reports/WhatsArchive?limit=".$limit."&page_num=".(int)($page_num+1):"#")?>"><?=lang("next")?></a></li>
			<?php }?>
			</ul>
		</div>
		</div>
	</div>
<?php }?>
<table class="table table-bordered table-hover table-checks table-block tablesorter">
<thead>
<tr>
	<th><input type="checkbox" id="check-all" class="style"/>
	<th><?=lang("username")?></th>
	<th><?=lang("rec_number")?></th>
	<th><?=lang("channel_id")?></th>
	<th><?=lang("message")?></th>
	<th><?=lang("send_time")?></th>
	<th><?=lang("nickname")?></th>
	<th><?=lang("status")?></th>
</tr>
</thead>
<tbody>
<?php if(!$archive){?>
<tr><td style="text-align: center;" colspan="8"><?=lang("no_inputs")?></td></tr>
<?php }else{?>
<?php foreach($archive["results"] as $row){?>
<tr>
	<td><input class="style" type="checkbox" value="<?=$row->id?>" name="archive[]"/></td>
	<td><?=($row->user_id != 0?$this->musers->getUserById($row->user_id)->username:"")?></td>
	<td><?=$row->number?></td>
	<td><?=$row->channel_id?></td>
	<td><div style="overflow-y:scroll; height:75px; direction:ltr;"><?=$row->message?></div></td>
	<td style="width:20%"><?=date("Y-m-d h:i a", $row->time)?></td>
	<td><?=$row->nickname?></td>
	<td><?=$row->status?></td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
<div class="table-footer well body">
<label>المجموع الكلي: <?=$archive["count"]?></label>
<div class="pagination">
			<ul>
			<?php if($limit!="all"){?>
				<li><a href="<?=($page_num>0?base_url()."admin/reports/WhatsArchive?limit=".$limit."&page_num=".($page_num-1):"#")?>"><?=lang("prev")?></a></li>
			<?php for($i=0;$i<ceil($archive["count"]/$limit);$i++){?>
				<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?base_url()."admin/reports/WhatsArchive?limit=$limit&page_num=".$i:"#")?>"><?= $i + 1?></a></li>
			<?php }?>
				<li><a href="<?=(ceil($archive["count"]/$limit)>$page_num+1?base_url()."admin/reports/WhatsArchive?limit=".$limit."&page_num=".(int)($page_num+1):"#")?>"><?=lang("next")?></a></li>
			<?php }?>
			</ul>
</div>
</div>
<?php //if($permissions->actions["delete"]=="1"){?>
<div class="control-group">
	<a type="submit" data-toggle="modal" class="btn btn-danger" href="#confirm_delete_table_dialog"><i class="font-remove"></i><?=lang("delete") ?></a>
</div>
<?php //}?>
</form>