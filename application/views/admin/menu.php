<div class="sidebar" id="left-sidebar">
	<ul class="navigation standard">
		<!-- standard nav -->
		<li class="<?=($target=="dashboard"?"active":"")?>"><a href="<?=base_url()?>admin" title=""><img src="<?=base_url()?>assets/admin/images/icons/mainnav/dashboard.png" alt="" /><?=lang("dashboard")?></a></li>
		<li class="<?=($target=="users_settings"||$target=="users"||$target=="users_groups"?"active":"")?>">
		<a href="#" title="" class="expand" id="<?=($target=="users_settings"||$target=="users"||$target=="users_groups"?"current":"") ?>"><img src="<?=base_url()?>assets/admin/images/icons/mainnav/form-elements.png" alt="" /><?=lang("users")?><strong>3</strong></a>
			<ul>
				<?php if($permissions->sitesettings["see"]=="1"){?>
				<li class="<?=($target=="users_settings"?"current":"")?>"><a href="<?=base_url()?>admin/users/updateSettings" title=""><?=lang("users_settings")?></a></li>
				<?php }?>
				<?php if($permissions->users_groups["see"]=="1"){?>
				<li class="<?=($target=="users_groups"?"current":"")?>"><a href="<?=base_url()?>admin/users/groups" title=""><?=lang("users_groups")?></a></li>
				<?php }?>
				<?php if($permissions->users["users_see"]=="1"){?>
				<li class="<?=($target=="users"?"current":"")?>"><a href="<?=base_url()?>admin/users/" title=""><?=lang("users")?></a></li>
				<?php }?>
			</ul>
		</li>
		<li class="<?=($target=="langs"||$target=="browser"||$target=="blocked_ips"||$target=="site_settings"?"active":"")?>">
		<a href="#" title="" class="expand" id="<?=($target=="langs"||$target=="browser"||$target=="blocked_ips"||$target=="site_settings"?"current":"") ?>"><img src="<?=base_url()?>assets/admin/images/icons/mainnav/form-elements.png" alt="" /><?=lang("site")?><strong>4</strong></a>
			<ul>
				<?php if($permissions->sitesettings["see"]=="1"){?>
				<li class="<?=($target=="site_settings"?"current":"")?>"><a href="<?=base_url()?>admin/siteSettings" title=""><?=lang("site_settings")?></a></li>
				<?php }?>
				<?php if($permissions->blockip["see"]=="1"){?>
				<li class="<?=($target=="blocked_ips"?"current":"")?>"><a href="<?=base_url()?>admin/guests/blockedIps" title=""><?=lang("blocked_list")?></a></li>
				<?php }?>
				<?php if($permissions->browser["see"]=="1"){?>
				<li class="<?=($target=="browser"?"current":"")?>"><a href="<?=base_url()?>admin/browser" title=""><?=lang("browser")?></a></li>
				<?php }?>
				<?php if($permissions->languages["lang_see"]=="1"){?>
				<li class="<?=($target=="langs"?"current":"")?>"><a href="<?=base_url()?>admin/langs" title=""><?=lang("languages")?></a></li>
				<?php }?>

			</ul>
		</li>
		<li class="<?=($target=="equips"||$target=="pages"||$target=="videos"||$target=="slider"||$target=="nav"||$target=="banners"||$target=="products"||$target=="pro_cats"||$target=="news"||$target=="gallery"||$target=="links"||$target=="footer"?"active":"")?>">
		<a href="#" title="" class="expand" id="<?=($target=="equips"||$target=="pages"||$target=="slider"||$target=="banners"||$target=="nav"||$target=="videos"||$target=="footer"||$target=="pro_cats"||$target=="products"||$target=="news"||$target=="gallery"||$target=="links"?"current":"") ?>"><img src="<?=base_url()?>assets/admin/images/icons/mainnav/form-elements.png" alt="" /><?=lang("cms")?><strong>12</strong></a>
			<ul>
				<?php if($permissions->pages["pages_see"]=="1"){?>
				<li class="<?=($target=="pages"?"current":"")?>"><a href="<?=base_url()?>admin/pages" title=""><?=lang("pages")?></a></li>
				<?php }?>
				<?php if($permissions->products["products_see"]=="1"){?>
				<li class="<?=($target=="pro_cats"?"current":"")?>"><a href="<?=base_url()?>admin/products/categories" title=""><?=lang("categories")?></a></li>
				<?php }?>
				<?php if($permissions->products["products_see"]=="1"){?>
				<li class="<?=($target=="products"?"current":"")?>"><a href="<?=base_url()?>admin/products" title=""><?=lang("products")?></a></li>
				<?php }?>
				<?php if($permissions->news["news_see"]=="1"){?>
				<li class="<?=($target=="news"?"current":"")?>"><a href="<?=base_url()?>admin/news" title=""><?=lang("news")?></a></li>
				<?php }?>
				<?php if($permissions->gallery["see"]=="1"){?>
				<li class="<?=($target=="gallery"?"current":"")?>"><a href="<?=base_url()?>admin/gallery" title=""><?=lang("gallery")?></a></li>
				<?php }?>
				<?php if($permissions->links["links_see"]=="1"){?>
				<li class="<?=($target=="links"?"current":"")?>"><a href="<?=base_url()?>admin/links" title=""><?=lang("links")?></a></li>
				<?php }?>
				<?php if($permissions->videos["see"]=="1"){?>
				<li class="<?=($target=="videos"?"current":"")?>"><a href="<?=base_url()?>admin/videos" title=""><?=lang("videos")?></a></li>
				<?php }?>
				<?php if($permissions->slider["see"]=="1"){?>
				<li class="<?=($target=="slider"?"current":"")?>"><a href="<?=base_url()?>admin/slider" title=""><?=lang("slider")?></a></li>
				<?php }?>
				<?php if($permissions->footer["see"]=="1"){?>
				<li class="<?=($target=="footer"?"current":"")?>"><a href="<?=base_url()?>admin/footer" title=""><?=lang("footer")?></a></li>
				<?php }?>
				<?php if($permissions->banners["see"]=="1"){?>
				<li class="<?=($target=="banners"?"current":"")?>"><a href="<?=base_url()?>admin/banners" title=""><?=lang("banners")?></a></li>
				<?php }?>
				<?php if($permissions->nav["nav_see"]=="1"){?>
				<li class="<?=($target=="nav"?"current":"")?>"><a href="<?=base_url()?>admin/nav" title=""><?=lang("nav")?></a></li>
				<?php }?>
			</ul>
		</li>
		<li class="<?=($target=="sms_gates"||$target=="email_settings"||$target=="email_group"||$target=="mobile_group"||$target=="contacts"||$target=="notify")?"active":""?>">
		<a href="#" title="" class="expand" id="<?=($target=="sms_gates"||$target=="email_settings"||$target=="email_group"||$target=="mobile_group"||$target=="contacts"||$target=="notify")?"current":"" ?>"><img src="<?=base_url()?>assets/admin/images/icons/mainnav/components.png" alt="" /><?=lang("transactions")?><strong>6</strong></a>
			<ul>
				<?php if($permissions->smsgates["smsgates_see"]=="1"){?>
				<li class="<?=($target=="sms_gates"?"current":"")?>"><a href="<?=base_url()?>admin/sms/" title=""><?=lang("smsgates")?></a></li>
				<?php }?>
				<?php if($permissions->emailsettings["see"]=="1"){?>
				<li class="<?=($target=="email_settings"?"current":"")?>"><a href="<?=base_url()?>admin/email/emailSettings" title=""><?=lang("email_settings")?></a></li>
				<?php }?>
				<?php if($permissions->groups["see"]=="1"){?>
				<li class="<?=($target=="email_group"?"current":"")?>"><a href="<?=base_url()?>admin/groups/emailGroup" title=""><?=lang("email_group")?></a></li>
				<?php }?>
				<?php if($permissions->groups["see"]=="1"){?>
				<li class="<?=($target=="mobile_group"?"current":"")?>"><a href="<?=base_url()?>admin/groups/mobileGroup" title=""><?=lang("mobile_group")?></a></li>
				<?php }?>
				<?php if($permissions->contacts["see"]=="1"){?>
				<li class="<?=($target=="contacts"?"current":"")?>"><a href="<?=base_url()?>admin/contacts/" title=""><?=lang("contacts")?></a></li>
				<?php }?>
				<?php if($permissions->notify["see"]=="1"){?>
				<li class="<?=($target=="notify"?"current":"")?>"><a href="<?=base_url()?>admin/notify/" title=""><?=lang("notify_messages")?></a></li>
				<?php }?>
			</ul>
		</li>
		<li class="<?=($target=="sms_reports"||$target=="email_reports"||$target=="online_guests"||$target=="visits"||$target=="user_actions")?"active":""?>">
		<a href="#" title="" class="expand" id="<?=($target=="sms_reports"||$target=="email_reports"||$target=="online_guests"||$target=="visits"||$target=="user_actions")?"current":"" ?>">
		<img src="<?=base_url()?>assets/admin/images/icons/mainnav/components.png" alt="" /><?=lang("reports")?><strong>5</strong></a>
			<ul>

				<li class="<?=($target=="visits"?"current":"")?>"><a href="<?=base_url()?>admin/reports/visits" title=""><?=lang("guests")?></a></li>
				<li class="<?=($target=="online_guests"?"current":"")?>"><a href="<?=base_url()?>admin/guests/onlineGuests" title=""><?=lang("online_guests")?></a></li>
				<?php if($permissions->actions["see"]=="1"){?>
				<li class="<?=($target=="user_actions"?"current":"")?>"><a href="<?=base_url()?>admin/reports/actionsReports" title=""><?=lang("users_actions")?></a></li>
				<?php }?>
				<?php if($permissions->sms_reports["see"]=="1"){?>
				<li class="<?=($target=="sms_reports"?"current":"")?>"><a href="<?=base_url()?>admin/reports/smsReports" title=""><?=lang("sms_reports")?></a></li>
				<?php }?>
				<?php if($permissions->email_reports["see"]=="1"){?>
				<li class="<?=($target=="email_reports"?"current":"")?>"><a href="<?=base_url()?>admin/reports/emailReports" title=""><?=lang("email_reports")?></a></li>
				<?php }?>
			</ul>
		</li>

		<!-- WhatsApp -->
		<li class="<?=($target=="whats_archive"||$target=="whats_send_settings"||$target=="whats_channels"||$target=="whats_settings"||$target=="whats_send_message"||$target=="whats_users"||$target=="whats_numbers_groups")?"active":""?>">
		<a href="#" title="" class="expand" id="<?=($target=="whats_archive"||$target=="whats_send_settings"||$target=="whats_channels"||$target=="whats_settings"||$target=="whats_send_message"||$target=="whats_users"||$target=="whats_numbers_groups")?"current":"" ?>">
		<img src="<?=base_url()?>assets/admin/images/icons/mainnav/components.png" alt="" /><?=lang("whatsapp")?><strong>5</strong></a>
			<ul>
				<li class="<?=($target=="whats_settings"?"current":"")?>"><a href="<?=base_url()?>admin/whats/settings" title=""><?=lang("whats_settings")?></a></li>
				<li class="<?=($target=="whats_send_settings"?"current":"")?>"><a href="<?=base_url()?>admin/whats/sendSettings" title=""><?=lang("whats_send_settings")?></a></li>
				<li class="<?=($target=="whats_channels"?"current":"")?>"><a href="<?=base_url()?>admin/channels" title=""><?=lang("whats_channels")?></a></li>
				<li class="<?=($target=="whats_archive"?"current":"")?>"><a href="<?=base_url()?>admin/reports/whatsArchive" title=""><?=lang("whats_archive")?></a></li>
				<li class="<?=($target=="whats_send_message"?"current":"")?>"><a href="<?=base_url()?>admin/whats/sendMessage" title=""><?=lang("whats_send_message")?></a></li>
				<li class="<?=($target=="whats_users"?"current":"")?>"><a href="<?=base_url()?>admin/whats/users" title=""><?=lang("whats_users")?></a></li>
				<li class="<?=($target=="whats_credits_enquiries"?"current":"")?>"><a href="<?=base_url()?>admin/whats/users" title=""><?=lang("whats_credits_enquiries")?></a></li>
				<li class="<?=($target=="whats_numbers_groups"?"current":"")?>"><a href="<?=base_url()?>admin/whats/numbersGroups" title=""><?=lang("whats_numbers_groups")?></a></li>
			</ul>
		</li>
		<!-- /WhatsApp-->

	</ul>
</div>