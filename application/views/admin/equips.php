<?php
$array=array("en"=>"الانجليزية",
			"ru"=>"الروسية","it"=>"الايطالية",
			"fr"=>"الفرنسية","jp"=>"اليابانية",
			"in"=>"الهندية","ch"=>"الصينية",)?>
<?php $fields = array("")?>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/equipments/updateEquips">
	<fieldset>
		<div class="block well">
			<div class="row-fluid">
				<div class="tabbable">
					<!-- default tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href=<?="#ar_tab"?> data-toggle="tab">العربية</a></li>
					<?php foreach($array as $code=>$title){?>
						<li ><a href=<?="#".$code."_tab"?> data-toggle="tab"><?=$title?></a></li>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php if($equips){?>
						<?php foreach($equips as $lang => $equip){?>
						<div class="tab-pane <?=($lang=="ar"?"active":"")?>" id="<?=$lang?>_tab">
								<div class="control-group">
									<label class="control-label"><?=lang("equip_title")?>: <span class="req">*</span></label>
									<div class="controls">
										<input type="text" class="required span12" name="<?="title_".$lang?>" id="" value="<?=$equip["title"]?>" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><?=lang("content")?>: <span class="req">*</span></label>
									<div class="controls">
										<textarea class="span12" name="content_<?=$lang?>" ><?=$equip["content"]?></textarea>
									</div>
								</div>
						</div>										
								<?php }?>	
								<?php }?>	
					
						</div>
					</div>
				</div>
				<div class="form-actions align-right">
				<?php if($permissions->langs_titles["modify"]=="1"){?>
					<input type="submit" value="<?= lang("update")?>" class="btn btn-primary" />
					<?php }?>
				</div>
			</div>
	</fieldset>
</form>