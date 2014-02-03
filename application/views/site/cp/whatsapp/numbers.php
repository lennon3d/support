<ul class="page-breadcrumb breadcrumb">
	<li><i class="fa fa-home"></i><a href="<?=$this->SITE_URL?>"><?=lang("home_page")?></a><i class="fa fa-angle-left"></i></li>
	<li><a href="<?=$this->SITE_URL?>cp/whatsapp/groups"><?=lang("main_groups")?></a><i class="fa fa-angle-left"></i></li>
	<li><a href="<?=$this->SITE_URL?>cp/whatsapp/groups/subGroups/<?=$main_group?>"><?=lang("sub_groups")?></a><i class="fa fa-angle-left"></i>
	</li><li><a href="<?=$this->URI?>"><?=lang("numbers")?></a></li>
</ul>
<div class="col-md-8">
<form action="" method="post">
<input type="hidden" name="" value="<?=$group_id?>" id="group_id_hidden"/>
	<!-- BEGIN ALERTS PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-group"></i>الأرقام
			</div>
			<div class="tools">
			</div>
		</div>
		<div class="portlet-body">
<div class="table-responsive">
	<table class="table table-condensed table-hover table-striped flip-content">
	<thead>
	<tr>
    	<th><input type="checkbox" class="checkbox-all"/></th>
	<th><?=lang("name")?></th>
	<th><?=lang("mobile_number")?></th>
	<th><?=lang("actions")?></th>
	</tr>
	</thead>
	<tbody>
			<?php if(!$numbers){?>
		<tr><td style="text-align:center;" colspan="4"><?=lang("no_inputs")?></td></tr>
		<?php }else{?>
		<?php foreach($numbers["results"] as $number){?>
		<tr>
			<td><input class="check_input" type="checkbox" name="checks[]" value="<?=$number->id?>"/></td>
			<td style="width:20%;"><div id="name_<?=$number->id?>"><?=$number->name?></div></td>
			<td style="width:20%;"><div id="number_<?=$number->id?>"><?=$number->number?></div></td>
			<td>
				<?php // if($permissions->users["users_modify"]=="1"){?>
				<a id="edit_<?=$number->id?>" href="#" class="btn default btn-xs blue tooltips edit_number" title="<?=lang("edit_number")?>"><b class="fa fa-pencil"></b></a>
				<a id="delete_<?=$number->id?>" href="#" class="btn default btn-xs red tooltips delete_number" title="<?=lang("delete_number")?>"><b class="fa fa-times"></b></a>
				<?php // }?>
			</td>
		</tr>
		<?php }?>
		<?php }?>
		<tr><td colspan="5" style="text-align:center;"><?=lang("total_results")?>: <?=$numbers["count"]?></td></tr>
	</tbody>
	</table>
	</div>
			<?php if($numbers["results"]){?>
	<div class="form">
	<div class="row">
	<div class="col-md-8">
		<label><?=lang("check_all_groups")?></label><input type="checkbox" name="check_all"/>
		<div class="input-group input-medium">
		<select class="form-control" name="action">
			<option value=""><?=lang("choose_action")?></option>
			<option value="delete"><?=lang("delete")?></option>
		</select>
			<span class="input-group-btn">
			 <input onClick="javascript:if(!confirm('<?=lang('confirm_submit')?>')) return false;" type="submit" value="<?=lang("submit")?>" name="submit" class="btn green"/>
			</span>
		</div>
		</div>
<?php if($limit!="all"){?>
<div class="col-md-4">
	<ul class="pagination pagination-sm">
		<li><a href="<?=($page_num>0?$this->URI."?search_word=$search&limit=".$limit."&page=".($page_num-1):"#")?>"><?=lang("prev")?></a></li>
		<?php for($i=0;$i<ceil($numbers["count"]/$limit);$i++){?>
		<li class="<?=($page_num==$i?"active":"")?>"><a href="<?=($page_num!=$i?$this->URI."?limit=$limit&page=$i&search_word=$search":"#")?>"><?= $i + 1?></a></li>
		<?php }?>
		<li><a href="<?=$this->URI."?search_word=$search&limit=".$limit."&page=".(int)($page_num+1)?>"><?=lang("next")?></a></li>
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
					<a data-toggle="tab" href="#add_number"><?=lang("add_number")?></a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#import_numbers"><?=lang("import_numbers")?></a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="add_number" class="tab-pane active">
			<input type="hidden" name="group_id" value="<?=$group_id?>" id="number_group_id"/>
			<div class="form-group">
				<label class="control-label"><?=lang("name")?>: </label>
					<input placeholder="الاسم" type="text" class="form-control" name="name" id="add_name_text" />
			</div>
			<div class="form-group">
				<label class="control-label"><?=lang("mobile")?>: <span class="required">*</span></label>
					<input placeholder="رقم الجوال" type="text" class="form-control" name="mobile" id="add_mobile_text"/>
			</div>
			<button class="btn green" type="button" id="add_number_btn"><?=lang("add")?></button>
						</div>
			<div id="import_numbers" class="tab-pane">
			<form action="" enctype="application/x-www-form-urlencoded" >
			<input type="hidden" name="group_id" value="<?=$group_id?>" id="number_group_id"/>
			<div class="form-group">
				<label class="control-label"><?=lang("choose_excel_file")?>: </label>
					<input placeholder="<?=lang("file")?>" type="file" class="form-control" name="file" />
			</div>
			<button class="btn green" type="button" id="add_number_btn"><?=lang("add")?></button>
			</form>
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
			<input class="form-control" type="text" name="search_word" placeholder="<?=lang("search_word")?>"/>
			<input type="hidden" name="page" value="<?=$page_num?>"/>
			<input type="hidden" name="limit" value="<?=$limit?>"/>
			<span class="input-group-btn">
			<button class="btn green" type="submit"><?=lang("search")?></button>
			</span>
		</div>
	</form>
	<?php if($numbers["results"]){?>
	<div class="well">
		<?=lang("show")?>:
		<a href="<?=$this->URI."?limit=25&page=$page_num&search_word=$search"?>"><span class="label label-info">25</span></a>
		<a href="<?=$this->URI."?limit=50&page=$page_num&search_word=$search"?>"><span class="label label-success">50</span></a>
		<a href="<?=$this->URI."?limit=100&page=$page_num&search_word=$search"?>"><span class="label label-warning">100</span></a>
		<a href="<?=$this->URI."?limit=all&page=0&search_word=$search"?>"><span class="label label-important"><?=lang("all")?></span></a>
	</div>
	<?php }?>

	</div>
	</div>
</div>
