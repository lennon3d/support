<?php
$array=array("en"=>"الانجليزية",
			"ru"=>"الروسية","it"=>"الايطالية",
			"fr"=>"الفرنسية","jp"=>"اليابانية",
			"in"=>"الهندية","ch"=>"الصينية",)?>
<?php $fields = array("")?>
<form id="usualValidate" class="form-horizontal" method="post" action="<?=base_url()?>admin/contacts/updateTitles">
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
					<div class="tab-pane active" id="ar_tab">
						<?php foreach($contactus_titles as $title){?>
						<?php if($title->lang == "ar"){?>
								<div class="control-group">
									<label class="control-label"><?=lang($title->title)?>: <span class="req">*</span></label>
									<div class="controls">
										<input type="text" class="required span12" name="<?=$title->title."_".$title->lang?>" id="" value="<?=$title->text?>" />
									</div>
								</div>	
								<?php }?>												
								<?php }?>	
					</div>
					<?php foreach($array as $code=>$title1){?>
					<div class="tab-pane" id="<?=$code?>_tab">
						<?php if($contactus_titles){?>
						<?php foreach($contactus_titles as $title){?>
						<?php if($title->lang == $code){?>
								<div class="control-group">
									<label class="control-label"><?=lang($title->title)?>: <span class="req">*</span></label>
									<div class="controls">
										<input type="text" class="required span12" name="<?=$title->title."_".$title->lang?>" id="" value="<?=$title->text?>" />
									</div>
								</div>	
								<?php }?>												
								<?php }?>												
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