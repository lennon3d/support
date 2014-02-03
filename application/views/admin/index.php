<?php $permissions = $this->musers->getGroupPermissions($this->session->userdata("group"))?>
<?php $data["permissions"] = (object)$permissions["permissions"]?>
<?php $data["target"] = $target?>
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view("admin/head")?>
</head>
<body>
<?php $this->load->view("admin/top-nav")?>

<!-- Main wrapper -->
<div class="wrapper">

<!-- Left sidebar -->
<?php $this->load->view("admin/menu", $data)?>
<!-- /left sidebar -->
<!-- Main content -->
<div class="content">
<?php $this->load->view("admin/notices")?>
	<div class="outer">
		<div class="inner">
			<div class="page-header">
			<!-- Page header -->
				<?php $this->load->view("admin/page_header")?>
			</div>
			<!-- /page header -->
			<div class="body">
				<ul class="breadcrumb">
					<li><a href="<?=base_url()?>admin/<?=$this->uri->segment(2)?>"><i class="font-home"></i><?=lang($this->uri->segment ( 2 ))?></a> <span class="divider">/</span></li>
					<?php if($this->uri->segment(3)){?>
					<li><a href="<?=$this->URI?>"><?=lang($target)?></a> <span class="divider">/</span></li>
					<?php }?>
				</ul>
			<?php switch($target){
					case "whats_archive":
						$this->load->view("admin/whats/whats-archive");
						break;
					case "whats_send_settings":
						$this->load->view("admin/whats/send-settings");
						break;
					case "whats_channel_settings":
						$this->load->view("admin/whats/channels/settings");
						break;
					case "channel_conver":
						$this->load->view("admin/whats/channels/conver");
						break;
					case "whats_settings":
						$this->load->view("admin/whats/settings");
						break;
					case "channel_contacts":
						$this->load->view("admin/whats/channels/channel-contacts");
						break;
					case "whats_enter_code":
						$this->load->view("admin/whats/channels/enter-code");
						break;
					case "whats_add_channel":
						$this->load->view("admin/whats/channels/insert");
						break;
					case "whats_channels":
						$this->load->view("admin/whats/channels/table");
						break;
					case "modify_offer":
						$this->load->view("admin/offers/modify");
						break;
					case "insert_offer":
						$this->load->view("admin/offers/insert");
						break;
					case "offers":
						$this->load->view("admin/offers/table");
						break;
					case "modify_sponsor":
						$this->load->view("admin/sponsors/modify");
						break;
					case "insert_sponsor":
						$this->load->view("admin/sponsors/insert");
						break;
					case "sponsors":
						$this->load->view("admin/sponsors/table");
						break;
					case "users_groups":
						$this->load->view("admin/users/groups");
						break;
					case "users_settings":
						$this->load->view("admin/users/settings");
						break;
					case "insert_users_group":
						$this->load->view("admin/users/insert-group");
						break;
					case "modify_users_group":
						$this->load->view("admin/users/modify-group");
						break;
					case "dashboard" :
						$this->load->view("admin/dashboard");
						break;
					case "equips" :
						$this->load->view("admin/equips");
						break;
					case "talents" :
						$this->load->view("admin/talent/talent");
						break;
					case "show_form" :
						$this->load->view("admin/talent/show-form");
						break;
					case "products_titles" :
						$this->load->view("admin/products/products-titles");
						break;
					case "users":
						$this->load->view("admin/users/users", $data);
						break;
					case "insert_user":
						$this->load->view("admin/users/insert-user");
						break;
					case "modify_user":
						$this->load->view("admin/users/modify-user");
						break;
					case "change_permissions":
						$this->load->view("admin/users/user-permissions");
						break;
					case "site_settings":
						$this->load->view("admin/site-settings");
						break;
					case "sms_gates":
						$this->load->view("admin/sms/gates");
						break;
					case "insert_gate":
						$this->load->view("admin/sms/insert-gate");
						break;
					case "modify_gate":
						$this->load->view("admin/sms/modify-gate");
						break;
					case "email_settings":
						$this->load->view("admin/email/email-settings");
						break;
					case "pages":
						$this->load->view("admin/pages/pages");
						break;
					case "insert_page":
						$this->load->view("admin/pages/insert-page");
						break;
					case "modify_page":
						$this->load->view("admin/pages/modify-page");
						break;
					case "langs":
						$this->load->view("admin/langs/langs");
						break;
					case "insert_lang":
						$this->load->view("admin/langs/insert-lang");
						break;
					case "modify_lang":
						$this->load->view("admin/langs/modify-lang");
						break;
					case "products":
						$this->load->view("admin/products/products");
						break;
					case "insert_product":
						$this->load->view("admin/products/insert-product");
						break;
					case "modify_product":
						$this->load->view("admin/products/modify-product");
						break;
					case "pro_cats":
						$this->load->view("admin/products/cats");
						break;
					case "insert_pro_cat":
						$this->load->view("admin/products/insert-cat");
						break;
					case "modify_pro_cat":
						$this->load->view("admin/products/modify-cat");
						break;
					case "slides":
						$this->load->view("admin/products/slides");
						break;
					case "insert_slide":
						$this->load->view("admin/products/insert-slide");
						break;
					case "news":
						$this->load->view("admin/news/news");
						break;
					case "insert_new":
						$this->load->view("admin/news/insert-new");
						break;
					case "modify_new":
						$this->load->view("admin/news/modify-new");
						break;
					case "nav":
						$this->load->view("admin/nav/nav");
						break;
					case "insert_nav":
						$this->load->view("admin/nav/insert-nav");
						break;
					case "modify_nav":
						$this->load->view("admin/nav/modify-nav");
						break;
					case "gallery":
						$this->load->view("admin/gallery/gallery");
						break;
					case "insert_photo":
						$this->load->view("admin/gallery/insert-photo");
						break;
					case "modify_photo":
						$this->load->view("admin/gallery/modify-photo");
						break;
					case "videos":
						$this->load->view("admin/videos/videos");
						break;
					case "insert_video":
						$this->load->view("admin/videos/insert-video");
						break;
					case "modify_video":
						$this->load->view("admin/videos/modify-video");
						break;
					case "links":
						$this->load->view("admin/links/links");
						break;
					case "insert_link":
						$this->load->view("admin/links/insert-link");
						break;
					case "modify_link":
						$this->load->view("admin/links/modify-link");
						break;
					case "slider":
						$this->load->view("admin/slider/slider");
						break;
					case "insert_slider":
						$this->load->view("admin/slider/insert-slider");
						break;
					case "modify_slider":
						$this->load->view("admin/slider/modify-slider");
						break;
					case "banners":
						$this->load->view("admin/banners/banners");
						break;
					case "insert_banner":
						$this->load->view("admin/banners/insert-banner");
						break;
					case "modify_banner":
						$this->load->view("admin/banners/modify-banner");
						break;
					case "browser":
						$this->load->view("admin/browser");
						break;
					case "footer":
						$this->load->view("admin/footer/footer");
						break;
					case "insert_footer":
						$this->load->view("admin/footer/insert-footer");
						break;
					case "modify_footer":
						$this->load->view("admin/footer/modify-footer");
						break;
					case "contacts":
						$this->load->view("admin/contacts/contacts");
						break;
					case "show_contact":
						$this->load->view("admin/contacts/show-contact");
						break;
					case "show_comments":
						$this->load->view("admin/pages/show-comments");
						break;
					case "online_guests":
						$this->load->view("admin/reports/online-guests");
						break;
					case "blocked_ips":
						$this->load->view("admin/blocked-ips");
						break;
					case "footer_titles":
						$this->load->view("admin/footer/footer-titles");
						break;
					case "contactus_titles":
						$this->load->view("admin/contacts/contactus-titles");
						break;
					case "email_group":
						$this->load->view("admin/groups/email_group");
						break;
					case "mobile_group":
						$this->load->view("admin/groups/mobile_group");
						break;
					case "notify":
						$this->load->view("admin/notify/notify");
						break;
					case "sms_reports":
						$this->load->view("admin/reports/sms-reports");
						break;
					case "email_reports":
						$this->load->view("admin/reports/email-reports");
						break;
					case "report_mobiles":
						$this->load->view("admin/reports/report-mobiles");
						break;
					case "report_emails":
						$this->load->view("admin/reports/report-emails");
						break;
					case "user_actions":
						$this->load->view("admin/reports/actions");
						break;
					case "visits":
						$this->load->view("admin/reports/visits");
						break;

			} ?>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /Main wrapper -->
<?php $this->load->view("admin/dialogs")?>
</body>
<!-- confirm delete tables row  -->
<div id="confirm_delete_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("confirm_delete") ?>
		</h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<?= lang("confirm_delete_msg") ?>
		<form action = "" id="delete_confirm_form">
		</form>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
		<button type="submit" class="btn btn-primary" id="confirm_delete_but">
			<?= lang("confirm")?>
		</button>

	</div>
</div>
<!-- confirm delete tables row  -->
<div id="confirm_delete_table_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("confirm_delete") ?>
		</h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<?= lang("confirm_delete_msg") ?>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
		<button type="submit" class="btn btn-primary" id="confirm_delete_table_but">
			<?= lang("confirm")?>
		</button>

	</div>
</div>
</html>
