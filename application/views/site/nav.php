<?php $nav = $this->msite->getNav($this->_seg);?>
<!-- BEGIN HEADER -->
<div class="header navbar navbar-default navbar-static-top">
    <!-- BEGIN TOP BAR -->

    <div class="front-topbar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 login-reg-links">
                    <ul class="list-unstyled inline">
                    <?php if(!$this->session->userdata('validated')){?>
                        <li><a href="<?=$this->SITE_URL."user/login"?>"><?=lang("login")?></a></li>
                        <li class="sep"><span>|</span></li>
                        <li><a href="<?=$this->SITE_URL."user/register"?>">مستخدم جديد</a></li>
                    <?php }else{?>
                        <li><a href="<?=$this->SITE_URL."logout"?>">تسجيل الخروج</a></li>
                    <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- END TOP BAR -->

<div class="container">

    <div class="navbar-header">
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    </button>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN LOGO (you can use logo image instead of text)-->
    <a class="navbar-brand logo-v1" href="">
    	<img src="<?=base_url().$this->_titles[$this->_seg]["set_logo"]?>" id="logoimg" alt="">
    </a>
    <!-- END LOGO -->
    </div>


<!-- BEGIN TOP NAVIGATION MENU -->
<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
<?php if($nav){?>
	<?php foreach($nav as $row){?>
	<li><a href="<?=$this->SITE_URL.$row->url?>" ><?=$row->title?></a></li>
	<?php }?>
<?php }?>
    <li><a href="<?=$this->SITE_URL?>cp/whatsapp/send/sendMessage" ><?=lang("user_panel")?></a></li>
	</ul>
</div>
<!-- BEGIN TOP NAVIGATION MENU -->
</div>
</div>