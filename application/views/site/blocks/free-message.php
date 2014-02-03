	<!-- Form elements -->
			<div class="block outer body">
			<img src="<?=base_url()?>assets/admin/images/elements/loaders/1.gif" alt="" style="float: left;" />
				<div class="" style="text-align: center; font-size:12px;"><label><?=lang("free_message")?></label></div>			
				<div class="gap"></div>
            	<form action="<?=base_url().$this->_seg?>/whatsapp/send/freeMessage" class="block" name="" method="POST" id="free_msg_form">
                	<input id="free_number_text" name="number" type="text" value="" placeholder="رقم المستقبل" class="spacer-bottom" />
                	<textarea id="free_message_text" name="message" cols="4" rows="4" placeholder="نص الرسالة" class="spacer-bottom"></textarea>
                	<div class="form-actions">
                    	<input type="submit" value="ارسال" class="btn btn-block btn-warning pull-right" />
                	</div>
            	</form>
            </div>
            <!-- /form elements -->
            <div class="separator-doubled"></div>