<ul class="page-breadcrumb breadcrumb">
	<li>
		<i class="fa fa-home"></i>
		<a href="<?=$this->SITE_URL?>"><?=lang("home_page")?></a>
		<i class="fa fa-angle-left"></i>
	</li>
	<li>
		<a href="<?=$this->URI?>"><?=lang("main_groups")?></a>
	</li>
</ul>
<div class="col-md-8">
<form action="" method="post">
	<!-- BEGIN ALERTS PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-group"></i>مجموعات الأرقام
			</div>
			<div class="tools">
			</div>
		</div>
		<div class="portlet-body">
<div class="table-responsive">
	<table class="table table-condensed table-hover table-striped flip-content">
	<thead>
	<tr>
    	<th><input type="checkbox" class="checkbox-all style"/></th>
    	<th><?=lang("group_title")?></th>
    	<th><?=lang("sub_groups_count")?></th>
    	<th><?=lang("create_time")?></th>
    	<th><?=lang("actions")?></th>
	</tr>
	</thead>
	<tbody>
		<?php if(!$groups){?>
		<tr><td style="text-align:center;" colspan="5"><?=lang("no_inputs")?></td></tr>
		<?php }else{?>
		<?php foreach($groups["results"] as $group){?>
		<tr>
			<td><input class="style check_input" type="checkbox" name="checks[]" value="<?=$group->id?>"/></td>
			<td style="width:20%;"><div id="group_title_<?=$group->id?>"><?=$group->title?></div></td>
			<td style="width:30%;"><?=$group->count?></td>
			<td style="width:20%;"><?=date("d-m-Y",$group->create_time)?></td>
	<td>
		<?php // if($permissions->users["users_modify"]=="1"){?>
			<a href="<?=$this->SITE_URL?>cp/whatsapp/groups/subGroups/<?=$group->id?>" class="btn default btn-xs dark tooltips" title="<?=lang("show_sub_groups")?>"><b class="fa fa-file-o"></b></a>
			<a id="<?=$group->id?>" href="#" class="btn default btn-xs blue edit_group tooltips"  title="<?=lang("edit_group")?>"><b class="fa fa-pencil"></b></a>
			<a id="<?=$group->id?>" href="#" class="btn default btn-xs yellow empty_group tooltips" title="<?=lang("empty_group")?>"><b class="fa fa-trash-o"></b></a>
			<a id="<?=$group->id?>" href="#" class="btn default btn-xs red delete_group tooltips" title="<?=lang("delete_group")?>"><b class="fa fa-times"></b></a>
		<?php // }?>
	</td>
		</tr>
		<?php }?>
		<?php }?>
		<tr><td colspan="5" style="text-align:center;"><?=lang("total_results")?>: <?=$groups["count"]?></td></tr>
	</tbody>
	</table>
</div>
	<?php if($groups["results"]){?>
	<div class="form">
	<div class="row">
	<div class="col-md-8">
		<label><?=lang("check_all_groups")?></label><input type="checkbox" name="check_all"/>
		<div class="input-group input-medium">
		<select class="form-control" name="action">
			<option value=""><?=lang("choose_action")?></option>
			<option value="delete"><?=lang("delete")?></option>
			<option value="empty"><?=lang("do_empty")?></option>
			<option value="delete_sub"><?=lang("delete_sub_groups")?></option>
		</select>
			<span class="input-group-btn">
			 <input onClick="javascript:if(!confirm('<?=lang('confirm_submit')?>')) return false;" type="submit" value="<?=lang("submit")?>" name="submit" class="btn green"/>
			</span>
		</div>
		</div>
<?php if($limit!="all"){?>
<div class="col-md-4">
	<ul class="pagination pagination-sm">
		<li>
		<a href="<?=($page_num>0?$this->SITE_URL."cp/whatsapp/groups?search_word=$search&limit=".$limit."&page=".($page_num-1):"#")?>"><?=lang("prev")?></a>
		</li>
		<?php for($i=0;$i<ceil($groups["count"]/$limit);$i++){?>
		<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?$this->SITE_URL."cp/whatsapp/groups?limit=$limit&page=$i&search_word=$search":"#")?>"><?= $i + 1?></a></li>
		<?php }?>
        <li><a href="<?=$this->SITE_URL."cp/whatsapp/groups?search_word=$search&limit=".$limit."&page=".(int)($page_num+1)?>"><?=lang("next")?></a></li>
	</ul>
	</div>
	<?php }?>
	</div>
	</div>
<?php }?>
		</div>
	</div>
	<!-- END ALERTS PORTLET-->
	</form>
</div>
<div class="col-md-4">
<div class="portlet box yellow tabbable">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>
		</div>
	</div>
	<div class="portlet-body">
		<div class=" portlet-tabs">
			<ul class="nav nav-tabs">
							<li class="active">
					<a data-toggle="tab" href="#add_main_group"><?=lang("add_main_group")?></a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#add_sub_group"><?=lang("add_sub_group")?></a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="add_main_group" class="tab-pane active">
                    <div class="form-body">
                        <div class="form-group">
		<label class="control-label"><?=lang("group_title")?> : </label>
		<div class="input-group">
    		<input class="form-control" type="text" name="group_title" placeholder="<?=lang("group_title")?>" id="add_group_text" />
    		<span class="input-group-btn">
    			<button type="button" class="btn green" id="add_group_btn"><?=lang("add")?></button>
    		</span>
    	</div>
		</div>
		</div>
						</div>
			<div id="add_sub_group" class="tab-pane">

			<div class="form-group">
		<label class="control-label"><?=lang("main_group_title")?> : </label>
			<select class="form-control" id="main_group_id">
			<option value=""><?=lang("choose_group")?></option>
			<?php if($all_groups){?>
			<?php foreach($all_groups["results"] as $group){?>
			<option value="<?=$group->id?>"><?=$group->title?></option>
			<?php }?>
			<?php }?>
			</select>
			</div>
			<label class="control-label"><?=lang("group_title")?> : </label>
			<div class="input-group">
			<input class="form-control" type="text" name="group_title" placeholder="<?=lang("group_title")?>" id="add_sub_group_text"/>
			<span class="input-group-btn">
			 <button class="btn green" type="button" id="add_sub_group_main_btn"><?=lang("add")?></button>
			</span>
		</div>
				</div>
					</div>

			</div>
		</div>
	</div>
	<div class="portlet box grey">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-search"></i>
		</div>
	</div>
	<div class="portlet-body">
	<form enctype="application/x-www-form-urlencoded" action="">
		<div class="input-group">
			<input class="form-control" type="text" name="search_word" placeholder="<?=lang("search_word")?>" id="add_sub_group_text"/>
			<input type="hidden" name="page" value="<?=$page_num?>"/>
			<input type="hidden" name="limit" value="<?=$limit?>"/>
			<span class="input-group-btn">
			 <button class="btn green" type="submit"><?=lang("search")?></button>
			</span>
		</div>
	</form>
	<?php if($groups){?>
	<div class="well">
		<?=lang("show")?>:
		<a href="<?=$this->SITE_URL."cp/whatsapp/groups?limit=25&page=$page_num&search_word=$search"?>"><span class="label label-info">25</span></a>
		<a href="<?=$this->SITE_URL."cp/whatsapp/groups?limit=50&page=$page_num&search_word=$search"?>"><span class="label label-success">50</span></a>
		<a href="<?=$this->SITE_URL."cp/whatsapp/groups?limit=100&page=$page_num&search_word=$search"?>"><span class="label label-warning">100</span></a>
		<a href="<?=$this->SITE_URL."cp/whatsapp/groups?limit=all&page=0&search_word=$search"?>"><span class="label label-danger"><?=lang("all")?></span></a>
	</div>
	<?php }?>

	</div>
	</div>
</div>
