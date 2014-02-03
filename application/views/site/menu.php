<!-- Left sidebar -->
	<div class="sidebar" id="left-sidebar">
	<?php if($this->session->userdata("validated")) {?>
	        <ul class="navigation standard"><!-- standard nav -->
            <li class="active"><a href="index.html" title=""><img src="<?=base_url("assets/admin")?>/images/icons/mainnav/dashboard.png" alt="" />ارسال الرسائل</a>
				<ul>
                    <li><a href="<?=base_url($this->_seg."/whatsapp/send/sendMessage")?>" title="">ارسال رسالة نصية</a></li>
                    <li><a href="form_wizards.html" title="">ارسال رسالة صورة</a></li>
                    <li><a href="form_wizards.html" title="">ارسال رسالة فيديو</a></li>
                    <li><a href="form_grid.html" title="">أرشيف الرسائل</a></li>
                </ul>
                </li>
            <li><a href="#" title="" class="expand"><img src="<?=base_url("assets/admin")?>/images/icons/mainnav/form-elements.png" alt="" />الأرقام والمجموعات<strong>3</strong></a>
           		<ul>
                    <li><a href="<?=base_url($this->_seg."/whatsapp/groups/")?>" title="">إدارة المجموعات</a></li>
                    <li><a href="forms.html" title="">تحميل أرقام من ملف</a></li>
                    <li><a href="forms.html" title="">تصدير الأرقام</a></li>
                    <li><a href="forms.html" title="">تفحص الأرقام</a></li>
                </ul>
			</li>
            <li><a href="#" title="" class="expand"><img src="<?=base_url("assets/admin")?>/images/icons/mainnav/form-elements.png" alt="" />الرصيد<strong>3</strong></a>
                <ul>
                    <li><a href="forms.html" title="">متابعة الرصيد</a></li>
                    <li><a href="form_wizards.html" title="">طلب شحن نقاط</a></li>
                    <li><a href="form_grid.html" title="">تحويل نقاط</a></li>
                </ul>
            </li>
            <li><a href="#" title="" class="expand"><img src="<?=base_url("assets/admin")?>/images/icons/mainnav/form-elements.png" alt="" />الرسائل<strong>3</strong></a>
                <ul>
                    <li><a href="forms.html" title="">أرشيف الرسائل</a></li>
                    <li><a href="form_wizards.html" title="">الرسائل المفضلة</a></li>
                    <li><a href="form_grid.html" title="">الرسائل بوقت لاحق</a></li>
                </ul>
            </li>
            </ul>
            <?php $user = $this->musers->getUserById($this->session->userdata("id"))?>
		<div class="block outer body">
			<div class="" style="text-align: center; font-size:12px;">بيانات المستخدم:</div>
			<div class="gap"></div>
			<div class="" style="text-align: right; font-size:12px;">الرصيد: <span id="user_credits_span"><?=$this->msite->getWhatsCredits($this->session->userdata("id"))?></span></div>
			<div class="" style="text-align: right; font-size:12px;"><a href="<?=base_url($this->_seg."/user/editProfile")?>">تعديل البيانات الشخصية</a></div>
			<div class="" style="text-align: right; font-size:12px;"><a href="<?=base_url($this->_seg."/user/changePassword")?>">تغيير كلمة المرور</a></div>
			<a onClick="javascript:if(!confirm('<?=lang("confirm_logout")?>')) return false;" class="btn btn-danger btn-block" href="<?=base_url().$this->_seg?>/logout">تسجيل الخروج</a>
		</div>
		<div class="separator-doubled"></div>
		<?=$this->load->view("site/blocks/fast-message")?>  
	<?php }?>

            <?php if(!$this->session->userdata("validated")) {?>
            <?=$this->load->view("site/blocks/free-message")?>
		            <!-- Form elements -->
			<div class="block outer body">
		            <div class="" style="text-align: center; font-size:12px;">تسجيل الدخول</div>
		            <div class="gap"></div>
            <form action="<?=base_url().$this->_seg?>/user/login" class="block" method="POST">
                <input type="text" value="" placeholder="اسم المستخدم" class="spacer-bottom" name="username" />
                <input type="password" value="" placeholder="كلمة المرور	" class="spacer-bottom" name="password" />
				<!-- <input type="checkbox" class="style" name="rememberme" value="1"/> تذكرني-->
                <div class="form-actions">
                    <input  name="submit" value="تسجيل الدخول" type="submit" class="btn btn-block btn-success pull-left" />
                </div>
            </form>
            </div>
            <div class="separator-doubled"></div>
            <?php } ?>
						<!-- /form elements -->
<?php if($this->_set->register_active && !$this->session->userdata("validated")){?>						
		            <!-- Form elements -->
			<div class="block outer body">
				<div class="" style="text-align: center; font-size:12px;">مستخدم جديد</div>
				<div class="gap"></div>
            	<form action="<?=base_url().$this->_seg?>/user/register/" class="block" method="POST">
            	<input type="hidden" name="group_id" value="<?=MFunctions::GROUP_WHATSAPP?>"/>
                	<input type="text" value="" placeholder="اسم المستخدم" class="spacer-bottom" name="username" />
                	<input type="text" value="" placeholder="البريد الالكتروني" class="spacer-bottom" name="email" />
                	<input type="text" value="" placeholder="الاسم الكامل" class="spacer-bottom" name="name" />
                	<label style="font-size:10px;">مثال:96655111111</label>
                	<input type="text" value="" placeholder="رقم الجوال" class="spacer-bottom" name="mobile" />
                	<input type="password" value="" placeholder="كلمة المرور" class="spacer-bottom" name="password" />
                	<input type="password" value="" placeholder="تأكيد كلمة المرور" class="spacer-bottom" name="repassword" />
                	<img src="user/captchaImage" alt="captcha" />
                	<input type="text" value="" placeholder="أدخل الكود الظاهر" class="spacer-bottom" name="captcha" />
                	<input type="hidden" name="menu"/>
                	<div class="form-actions">
                    	<input name="submit" value="مستخدم جديد" type="submit" class="btn btn-block btn-primary pull-left" />
                	</div>
            	</form>
            </div>
<?php }?>
		</div>
		<!-- /left sidebar -->