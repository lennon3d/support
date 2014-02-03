<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?=lang("admin_login")?></title>
<link href="<?=base_url()?>assets/admin/css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="<?=base_url()?>assets/admin/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/jquery_ui_custom.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.validate.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/forms/jquery.cleditor.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/wizard/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/wizard/jquery.form.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.jgrowl.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.pie.chart.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.fullcalendar.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.elfinder.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/ui/jquery.fancybox.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/tables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/bootstrap/bootstrap-bootbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/bootstrap/bootstrap-progressbar.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/functions/custom.js"></script>

</head>

<body>


<!-- Main wrapper -->
<div class="login-wrapper">

    <div class="login">
        <!-- Login block -->
        <div class="well">
            <div class="navbar">
                <div class="navbar-inner">
                    <h6><i class="font-user"></i><?=lang("admin_login")?></h6>
                </div>
            </div>
            <form action='<?=base_url()?>admin/login/process' class="row-fluid" method="post">
			<?php if(! is_null($msg)) echo $msg;?>
                <div class="control-group">
                    <label class="control-label"><?= lang("username") ?>:</label>
                    <div class="controls"><input class="span12" type="text" name="username" placeholder="<?= lang("username") ?>" /></div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?= lang("password") ?>:</label>
                    <div class="controls"><input class="span12" type="password" name="password" placeholder="<?= lang("password") ?>" /></div>
                </div>

                <div class="login-btn"><input type="submit" value="<?=lang("login")?>" class="btn btn-info btn-block btn-large" /></div>
            </form>
        </div>
        <!-- /login block -->

    </div>

</div>
<!-- /main wrapper -->

</body>
</html>
