<!-- Message -->
<li class="<?=($user == "0"?"by-user":"by-me")?>"><a href="#"
	title=""><img src="<?=($user == "0"?base_url()."assets/uploads/whatsapp/profile/preview_".$number.".jpg":"")?>" style="width:44px;height:44px;" alt="" /></a>
	<div class="area">
		<span class="arrow"></span>
		<div class="info-row">
			<span class="pull-left"><strong><?=($user == "0"?$number:lang("by_me"))?></strong></span>
			<span class="pull-right"><?=$this->mwhats->getTimeDef(time(),$time)?></span>
		</div>
		<p>
		<?php switch($type){
			case "text":
				echo "<span class='$message'>$message</span>";
				break;
			case "image":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message'/></a>";
				break;
			case "audio":
				echo "<audio controls><source src='".$message."' type='audio/aac'>المتصفح لا يدعم لاحقة aac</audio> ";
				break;
			case "video":
				echo "<video controls><source src='".$message."' type='video/mp4'>المتصفح لا يجعم لاحقة mp4</video>";
				break;
			case "card":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message'/></a>";
				break;
			case "location":
				echo "<a href=''><img style='width:50px;height:50px;' src='$message'/></a>";
				break;
		}?>
		</p>
	</div></li>
<!-- /message -->