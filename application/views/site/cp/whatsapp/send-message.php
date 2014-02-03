<ul class="page-breadcrumb breadcrumb">
	<li>
		<i class="fa fa-home"></i>
		<a href="<?=$this->SITE_URL?>"><?=lang("home_page")?></a>
		<i class="fa fa-angle-left"></i>
	</li>
	<li>
		<a href="<?=$this->URI?>"><?=lang("send_message")?></a>
	</li>
</ul>
<link href="<?=base_url()?>assets/admin/css/emoji/emoji.css" rel="stylesheet" type="text/css" />
<div class="row">
<form action="" method="post" class="" id="send_bulk_message_form">
<div class="col-md-8">
	<!-- BEGIN ALERTS PORTLET-->
	<div class="portlet blue box">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-envelope-o"></i>ارسال بولك
			</div>
			<div class="tools">
			</div>
		</div>
		<div class="portlet-body form">
		  <div class="form-body">
			<div class="form-group">
				<label class="control-label"><?=lang("nickname")?>: <span class="required">*</span></label>
				<input type="text" name="nickname" value="<?=$nickname?>" id="send_bult_nickname" class="form-control"/>
			</div>
				<div class="form-group">
					<label class="control-label"><?=lang("message")?>: <span class="required">*</span></label>
					<div class="controls">
						<div class="enter-message">
							<div id="fake_bulk_message" class="span12 fake_message" style="height:75px;" contenteditable="true" ></div>
							<textarea id="bulk_message_text" name="message" style="display:none;" ></textarea>
							<div class="message-actions">
							<?php $this->load->view("admin/whats/channels/emoji")?>
							</div>
						</div>
					</div>
				</div>
        </div>
					<!--
				<div class="control-group">
					<label class="control-label"><?=lang("receiver_numbers")?>: <span class="req">*</span></label>
					<div class="controls">
						<textarea class="span12 max580" name="numbers" ></textarea>
					</div>
				</div>
				-->

				<div class="form-actions align-right"><input type="submit" value="<?=lang("send")?>" class="btn btn-success" /></div>
		</div>
	</div>
	<!-- END ALERTS PORTLET-->
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
					<a data-toggle="tab" href="#send_groups"><?=lang("numbers_groups")?></a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#ads_groups"><?=lang("ads_groups")?></a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="send_groups" class="tab-pane active">
						  <div class="form-body">
			<div class="form-group">
							<label><?=lang("main_group")?>:</label>
								<select id="main_groups_select" name="main_group" class="form-control">
									<option value=""><?=lang("choose_group")?></option>
									<?php foreach($main_groups["results"] as $group){?>
									<option <?=($group->id == $main_group?"selected='selected'":"")?> value="<?=$group->id?>"><?=$group->title?></option>
									<?php }?>
								</select>
						</div>
						<div class="form-group">
							<label><?=lang("sub_group")?>:</label>
								<select id="sub_groups_select" name="sub_group" class="form-control">
									<option value=""><?=lang("choose_group")?></option>
									<?php if($main_group != ""){?>
									<?php foreach($sub_groups["results"] as $group){?>
									<option <?=($group->id == $sub_group?"selected='selected'":"")?> value="<?=$group->id?>"><?=$group->title?></option>
									<?php }?>
									<?php }?>
								</select>
						</div>
						</div>
						</div>
                <div id="ads_groups" class="tab-pane">
				</div>
					</div>

			</div>
		</div>
	</div>
</div>
	<!-- END ALERTS PORTLET-->
	</form>
</div>
