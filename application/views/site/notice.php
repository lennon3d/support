<div id="notice_container">
<?php if(isset($status)){?>
<?php if($status == "-1"){?>
<div class="inner">
	<div class="alert alert-error semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/error.png"/>
		<?php echo lang("operation_error")?>
	</div>
</div>
<div class="inner">
	<div class="alert alert-block semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/warning.png"/>
		<?php echo $message?>
	</div>
</div>
<?php }elseif($status == "1"){?>
<div class="inner">
	<div class="alert alert-success semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/success.png"/>
		<?= lang("operation_success")?>
	</div>
</div>
<?php }?>
<?php }?>
<?php if($this->session->flashdata("msg")){?>
<?php if($this->session->flashdata("msg")=="1"){?>
<div class="inner">
	<div class="alert alert-success semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/success.png"/>
		<?= lang("operation_success")?>
	</div>
</div>
<?php }elseif($this->session->flashdata("msg") == "-1"){?>
<div class="inner">
	<div class="alert alert-error semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/error.png"/>
		<?php echo lang("operation_error")?>
	</div>
</div>
<div class="inner">
	<div class="alert alert-block semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/warning.png"/>
		<?= $this->session->flashdata("message")?>
	</div>
</div>
<?php }?>
<?php }?>
</div>
<div id="error_notice" style="display: none;">
<div class="inner">
	<div class="alert alert-error semi-block" style="text-align: center;">
	<button class="close" data-dismiss="alert" type="button">×</button>
		<img src="<?=base_url()?>assets/site/images/error.png"/>
		<?php echo lang("operation_error")?>
	</div>
</div>
<div class="inner">
	<div class="alert alert-block semi-block" style="text-align: center;">
	<button class="close" data-dismiss="alert" type="button">×</button>
		<img src="<?=base_url()?>assets/site/images/warning.png"/>
		<span id="error_notice_message" style="display:inline;"></span>
	</div>
</div>
</div>
<div class="inner" id="success_notice" style="display: none;">
	<div class="alert alert-success semi-block" style="text-align: center;">
	<button class="close" data-dismiss="alert" type="button">×</button>
		<img src="<?=base_url()?>assets/site/images/success.png"/>
		<span id="success_notice_message" style="display:inline;"></span>
	</div>
</div>