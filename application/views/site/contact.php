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
<div class="block-two blue">
	<div class="block-holder">
		<div class="block-title">
			<h1>
				<span><?=lang("contactus")?></span>
			</h1>
		</div>
		<div class="block-body">
			<form action="#" method="post">
				<div class="row">
					<div class="name"><?=lang("name")?></div>
					<div class="field">
						<input name="name" type="text" value="<?=$name?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">
					<div class="name"><?=lang("email")?></div>
					<div class="field">
						<input name="email" type="text" value="<?=$email?>" class="email" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">
					<div class="name"><?=lang("contactus_title")?></div>
					<div class="field">
						<input name="title" type="text" value="<?=$title?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">
					<div class="name"><?=lang("contactus_message")?></div>
					<div class="field">
						<textarea name="body"><?=$body?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<a href="#" class="submit send"></a>
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
<!--/block-two-->
<div class="clear"></div>