<?php if($permissions->pages["pages_see"]=="1"){?>
<a class="btn btn-primary" href="<?=base_url()?>admin/pages/insertPage"><i class="font-plus"></i><?=lang("insert_page")?></a>
<?php }?>
<form id="export_table_form" action="<?=base_url()?>admin/exportTable" method="post" target="_blank">
	<textarea style="display:none;" name="tbody"></textarea>
	<textarea style="display:none;" name="thead"></textarea>
	<input type="hidden" name="method" />
	<input type="hidden" name="table" value="<?=lang("pages")?>" />
</form>
<div class="table-overflow block well">
<?php if($pages){?>
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
		</div>
	</div>
<?php }?>
<table class="table table-bordered table-hover table-checks table-block" <?=($pages?"id='data-table'":"")?>>
<thead>
<tr>
<th><?=lang("page_title")?></th>
<th><?=lang("status")?></th>
<th><?=lang("actions")?></th>
</tr>
</thead>
<tbody>
<?php if(!$pages){?>
<tr><td colspan="3"><?=lang("no_inputs")?></td><td></td></tr>
<?php }else{?>
<?php foreach($pages as $page){?>
<tr>
	<td style="width: 30%;"><?=$page->title?></td>
	<td><?=($page->active==1)?lang("activated"):lang("inactive")?></td>
	<td>
		<ul class="table-controls">
		<?php if($permissions->pages["pages_modify"]=="1"){?>
			<li><a href="<?=base_url()?>admin/pages/modifyPage/<?=$page->common_id?>" class="btn btn-info hovertip" title="<?=lang("modify_page")?>"><b class="font-file"></b></a> </li>
		<?php }?>
		<!-- 
		<?php if($permissions->comments["see"]=="1"){?>
			<li><a href="<?=base_url()?>admin/pages/showComments/<?=$page->common_id?>" class="btn hovertip" title="<?=lang("show_comments")?>"><b class="font-pencil"></b></a> </li>
		<?php }?>
		-->
		<?php if($permissions->pages["pages_delete"]=="1" && $page->common_id != 0){?>	
			<li><a data-toggle="modal" href="#confirm_delete_dialog" id="<?=base_url()?>admin/pages/deletePage/<?=$page->common_id?>" class="btn btn-red hovertip delete_a" title="<?=lang("delete")?>"><b class="font-remove"></b></a> </li>
		<?php }?>
		</ul>
	</td>
</tr>
<?php }?>
<?php }?>
</tbody>
</table>
</div>
