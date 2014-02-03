<!DOCTYPE html>
<html>
<head>
<?php $this->load->view("site/cp/head")?>
</head>
<body class="header-fixed-top sidebar-left-pinned">
<?php $this->load->view("site/cp/menu")?>
<div id="page-container">
<?php $this->load->view("site/cp/nav")?>
<div id="fx-container" class="fx-none">
    <div id="page-content" class="block">
<?php $this->load->view("site/cp/notice")?>
	<?php switch($target){
		case "show_numbers":
			$this->load->view("site/cp/whatsapp/show-numbers");
			break;
		case "numbers":
			$this->load->view("site/cp/whatsapp/numbers");
			break;
		case "sub_groups":
			$this->load->view("site/cp/whatsapp/sub-groups");
			break;
		case "numbers_groups":
			$this->load->view("site/cp/whatsapp/numbers-groups");
			break;
		case "send_message":
			$this->load->view("site/cp/whatsapp/send-message");
			break;
		case "edit_profile":
			$this->load->view("site/blocks/edit-profile");
			break;
		case "change_password":
			$this->load->view("site/blocks/change-password");
			break;
		case "home":
			$this->load->view("site/cp/home");
			break;
		case "settings":
			$this->load->view("site/cp/settings");
			break;
	 }?>
</div>
<?php $this->load->view("site/cp/footer")?>
</div>
</div>
</body>
</html>
