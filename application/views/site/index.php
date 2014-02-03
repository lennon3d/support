<!DOCTYPE html>
<html>
<head>
<?php $this->load->view("site/head")?>
<?php if($target=="page"){?>
	<style>
		<?=$page->css?>
	</style>
	<title><?=$this->_titles[$this->_seg]["set_companyname"] . " | " .$page->title?></title>
<?php }else{?>
<title><?=$this->_titles[$this->_seg]["set_companyname"]." | ".lang($target)?></title>
<?php }?>
</head>
<body>
<div class="header navbar navbar-default navbar-static-top">
<div class="container">
<?php $this->load->view("site/header")?>
<?php $this->load->view("site/nav")?>
</div>
</div>
    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container">
    <!-- BEGIN CONTAINER -->
        <!-- BEGIN BREADCRUMBS -->
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1><?=lang($target)?></h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="">Pages</a></li>
                        <li class="active">Login</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
	<?php switch($target){
		case "enter_code":
			$this->load->view("site/blocks/enter-code");
			break;
			/*
		case "numbers":
			$this->load->view("site/whatsapp/numbers");
			break;
		case "sub_groups":
			$this->load->view("site/whatsapp/sub-groups");
			break;
		case "numbers_groups":
			$this->load->view("site/whatsapp/numbers-groups");
			break;
		case "send_message":
			$this->load->view("site/whatsapp/send-message");
			break;
		case "edit_profile":
			$this->load->view("site/blocks/edit-profile");
			break;
			*/
		case "change_password":
			$this->load->view("site/blocks/change-password");
			break;
		case "home":
			$this->load->view("site/home");
			break;
		case "login":
			$this->load->view("site/login");
			break;
		case "register":
			$this->load->view("site/register");
			break;
		case "contactus":
			$this->load->view("site/contact");
			break;
		case "success_page":
			$this->load->view("site/blocks/success-page");
			break;
		case "forget_password":
			$this->load->view("site/blocks/forget-password");
			break;
		case "page":
			$this->load->view("site/page");
			break;
		case "gallery":
			$this->load->view("site/gallery");
			break;
		case "videos":
			$this->load->view("site/videos");
			break;
		case "video":
			$this->load->view("site/video-inside");
			break;
		case "news":
			$this->load->view("site/news");
			break;
		case "products":
			$this->load->view("site/products");
			break;
		case "product":
			$this->load->view("site/product");
			break;
	 }?>
</div>
<?php $this->load->view("site/footer")?>
</body>
</html>
