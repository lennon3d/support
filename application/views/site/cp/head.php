<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<title><?=$this->_titles[$this->_seg]["set_companyname"]." | ".lang($target)?></title>
<script src="<?=base_url()?>assets/site/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<!-- ----------------------------------------------- -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic">
<link rel="stylesheet" href="<?=base_url()?>assets/user_cp/css/bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>assets/user_cp/css/plugins.css">
<link rel="stylesheet" href="<?=base_url()?>assets/user_cp/css/main.css">
<link rel="stylesheet" href="<?=base_url()?>assets/user_cp/css/themes.css">
<link href="<?=base_url()?>assets/user_cp/css/themes/dragon.css" rel="stylesheet">
<script src="<?=base_url()?>assets/user_cp/js/vendor/modernizr-2.6.2-respond-1.3.0.min.js"></script>
<script src="<?=base_url()?>assets/user_cp/js/vendor/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/user_cp/js/plugins.js"></script>
<script src="<?=base_url()?>assets/user_cp/js/main.js"></script>
<!-- ---------------------------------- -->
<link href="<?=base_url()?>assets/site_metro/css/site.css" rel="stylesheet" type="text/css"/>
<?php foreach($this->css as $css){?>
<link href="<?=$css?>" rel="stylesheet" type="text/css"/>
<?php }?>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/send.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/groups.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/site.js"></script>
<?php foreach($this->js as $js){?>
<script type="text/javascript" src="<?=$js?>"></script>
<?php }?>
<script>
<?php echo $this->msite->js()?>
</script>

