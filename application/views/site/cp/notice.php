<div id="notice_container">
<?php if(isset($status)){?>
<?php if($status == "-1"){?>
<div class="alert alert-block alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/error.png"/>
	<p>
        <?= lang("operation_error")?>
	</p>
</div>
<div class="alert alert-block alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/warning.png"/>
	<p>
        <?=$message?>
	</p>
</div>
<?php }elseif($status == "1"){?>
<div class="alert alert-block alert-success fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/success.png"/>
	<p>
        <?= lang("operation_success")?>
	</p>
</div>
<?php }?>
<?php }?>
<?php if($this->session->flashdata("msg")){?>
<?php if($this->session->flashdata("msg")=="1"){?>
<div class="alert alert-block alert-success fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/success.png"/>
	<p>
        <?= lang("operation_success")?>
	</p>
</div>
<?php }elseif($this->session->flashdata("msg") == "-1"){?>
<div class="alert alert-block alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/error.png"/>
	<p>
        <?= lang("operation_error")?>
	</p>
</div>
<div class="inner">
	<div class="alert alert-block semi-block" style="text-align: center;">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<img src="<?=base_url()?>assets/site/images/warning.png"/>
		<?= $this->session->flashdata("message")?>
	</div>
</div>
<div class="alert alert-block alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/warning.png"/>
	<p>
        <?= $this->session->flashdata("message")?>
	</p>
</div>
<?php }?>
<?php }?>
</div>
<div id="error_notice" style="display: none;">
<div class="alert alert-block alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/error.png"/>
	<p>
        <?php echo lang("operation_error")?>
	</p>
</div>
<div class="alert alert-block alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/warning.png"/>
	<p>
        <span id="error_notice_message" style="display:inline;"></span>
	</p>
</div>
</div>
<div class="alert alert-block alert-success fade in" id="success_notice" style="display: none;">
	<button type="button" class="close" data-dismiss="alert"></button>
	<img src="<?=base_url()?>assets/site/images/success.png"/>
	<p>
        <span id="success_notice_message" style="display:inline;"></span>
	</p>
</div>