          <style>
          div.error-div p{
          	color:red;
          	direction: rtl;
          	font-weight: bold;
          }
          div.success-div p{
          	color:green;
          	direction: rtl;
          	font-weight: bold;
          }          
          </style>  
                    <?php if(isset($status)){?>
                    <?php if($status == "-1"){?>
                    <div class="error-div" style="background-color: white; padding:20px;">
                    	<?php echo $message?>
                    </div>
                    <?php }elseif($status == "1"){?>
					<div class="success-div" style="background-color: white; padding:20px;">
                    	<p><?php echo $message?></p>
                    </div>
                    <?php }?>
                    <?php }?>
<div class="block-two orange">
	<div class="block-holder">
		<div class="block-title">
			<h1>
				<span><?=lang("reget_password")?></span>
			</h1>
		</div>
		<div class="block-body">
			<form action="<?=base_url().$this->_seg?>/forgetPassword"
				method="post">

				<div class="row" id="type-div">
					<div class="name"><?=lang("forget_type")?></div>
					<div class="field">
						<input name="forget_type" type="radio" value="mobile"
							onClick="javascript:$('#mobile-div').show();$('#username-div').hide();" /><?=lang("mobile")?>
						<input name="forget_type" type="radio" value="username"
							checked="checked"
							onClick="javascript:$('#username-div').show();$('#mobile-div').hide();" /><?=lang("username")?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="row" id="username-div">
					<div class="name"><?=lang("username")?></div>
					<div class="field">
						<input name="username" type="text" value="" />
					</div>
					<div class="clear"></div>
				</div>

				<div class="row" id="mobile-div" style="display: none;">
					<div class="name"><?=lang("mobile")?></div>
					<div class="field">
						<input name="mobile" type="text" value="" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<a href="#" class="submit login-2"></a>
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
