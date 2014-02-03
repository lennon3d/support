<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(isset($page)){?>
<meta name="description" content="<?=$page->meta_desc.",".$this->_set->meta_tag?>">
<meta name="keywords" content="<?=$page->meta_tag.",".$this->_set->meta_key?>">
<?php }else{?>
<meta name="description" content="<?=$this->_set->meta_tag?>">
<meta name="keywords" content="<?=$this->_set->meta_key?>">
<?php }?>
<?php if($this->_set->alexa_id!=""){?>
<meta name="alexaVerifyID" content="<?=$this->_set->alexa_id?>">
<?php }?>





<!-- just this block *********************** you can play with -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="<?=base_url()?>assets/site_metro/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url()?>assets/site_metro/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
   <link href="<?=base_url()?>assets/site_metro/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" href="<?=base_url()?>assets/site_metro/plugins/revolution_slider/css/rs-style.css" media="screen">
   <link rel="stylesheet" href="<?=base_url()?>assets/site_metro/plugins/revolution_slider/rs-plugin/css/settings.css" media="screen">
   <link href="<?=base_url()?>assets/site_metro/plugins/bxslider/jquery.bxslider-rtl.css" rel="stylesheet" />
   <!-- END PAGE LEVEL PLUGIN STYLES -->

   <!-- BEGIN THEME STYLES -->
   <link href="<?=base_url()?>assets/site_metro/css/style-metronic-rtl.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url()?>assets/site_metro/css/style-rtl.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url()?>assets/site_metro/css/themes/blue-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<?=base_url()?>assets/site_metro/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url()?>assets/site_metro/css/custom-rtl.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url()?>assets/site_metro/css/site.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <link rel="shortcut icon" href="favicon.ico" />
   <script>
<?php echo $this->msite->js()?>
</script>
       <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/site_metro/plugins/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url()?>assets/site_metro/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/site_metro/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/site_metro/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/hover-dropdown.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/back-to-top.js"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/site_metro/plugins/bxslider/jquery.bxslider.min.js"></script>
    <script src="<?=base_url()?>assets/site_metro/scripts/app.js"></script>
    <script src="<?=base_url()?>assets/site_metro/scripts/index.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
            App.initBxSlider();
            Index.initRevolutionSlider();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
<!-- ********************************************************** -->


<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/send.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/groups.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/site.js"></script>

<!--

<?php if($this->_set->googleanalist_id !=""){?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?=$this->_set->googleanalist_id ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php }?>
-->