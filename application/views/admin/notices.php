<?php if(isset($msg)){?>
<?php if($msg=="-1"){?>
<!-- Info notice -->
	<div class="notice outer">
		<div class="note note-danger">
			<button type="button" class="close">×</button>
				<?= lang("operation_error")?>
		</div>
	</div>
		<div class="notice outer">
		<div class="note note-warning" style="text-align: right;">
			<button type="button" class="close">×</button>
				<?= $message?>
		</div>
	</div>
<!-- /info notice -->
<?php }elseif($msg == "1"){?>
	<div class="notice outer">
		<div class="note note-success">
			<button type="button" class="close">×</button>
				<?= $message?>
		</div>
	</div>
<?php }?>
<?php }?>
<?php if($this->session->userdata("msg")){?>
<?php if($this->session->userdata("def") == "1"){?>
	<div class="notice outer">
		<div class="note note-danger">
			<button type="button" class="close">×</button>
				<?= $this->session->userdata("error_message")?>
		</div>
	</div>
		<div class="notice outer">
		<div class="note note-success" style="text-align: right;">
			<button type="button" class="close">×</button>
				<?= $this->session->userdata("message")?>
		</div>
	</div>
<?php }elseif($this->session->userdata("msg")=="1"){?>
	<div class="notice outer">
		<div class="note note-success">
			<button type="button" class="close">×</button>
				<?= lang("operation_success")?>
		</div>
	</div>
<?php }elseif($this->session->userdata("msg") == "-1"){?>
	<div class="notice outer">
		<div class="note note-danger">
			<button type="button" class="close">×</button>
				<?= lang("operation_error")?>
		</div>
	</div>
		<div class="notice outer">
		<div class="note note-warning" style="text-align: right;">
			<button type="button" class="close">×</button>
				<?= $this->session->userdata("message")?>
		</div>
	</div>
<?php }?>
<?php $this->session->unset_userdata("msg")?>
<?php $this->session->unset_userdata("def")?>
<?php $this->session->unset_userdata("error_message")?>
<?php $this->session->unset_userdata("message")?>
<?php }?>
<?php if($this->session->flashdata("msg")){?>
<?php if($this->session->flashdata("def") == "1"){?>
	<div class="notice outer">
		<div class="note note-danger">
			<button type="button" class="close">×</button>
				<?= $this->session->flashdata("error_message")?>
		</div>
	</div>
		<div class="notice outer">
		<div class="note note-success" style="text-align: right;">
			<button type="button" class="close">×</button>
				<?= $this->session->flashdata("message")?>
		</div>
	</div>
<?php }elseif($this->session->flashdata("msg")=="1"){?>
	<div class="notice outer">
		<div class="note note-success">
			<button type="button" class="close">×</button>
				<?= lang("operation_success")?>
		</div>
	</div>
<?php }elseif($this->session->flashdata("msg") == "-1"){?>
	<div class="notice outer">
		<div class="note note-danger">
			<button type="button" class="close">×</button>
				<?= lang("operation_error")?>
		</div>
	</div>
		<div class="notice outer">
		<div class="note note-warning" style="text-align: right;">
			<button type="button" class="close">×</button>
				<?= $this->session->flashdata("message")?>
		</div>
	</div>
<?php }?>
<?php }?>
