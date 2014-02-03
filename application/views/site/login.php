<!-- BEGIN CONTAINER -->
<div class="container margin-bottom-40">
  <div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-signup-page">
        <form method="post">
            <input type="hidden" name="group_id" value="<?=MFunctions::GROUP_WHATSAPP?>" />
            <h2><?=lang("login")?></h2>

            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="username" type="text" class="form-control" placeholder="<?=lang("username")?>">
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="<?=lang("password")?>">

                <a href="#" class="login-signup-forgot-link">نسيت؟</a>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="checkbox-list"><label class="checkbox"><input type="checkbox">تذكرني</label></div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <button type="submit" class="btn theme-btn pull-right"><?=lang("login")?></button>
                </div>
            </div>

            <hr>

        </form>
    </div>
  </div>
</div>
<!-- END CONTAINER -->
