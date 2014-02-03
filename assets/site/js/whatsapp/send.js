$(document).ready(function(){
	var is_group_empty = false;
	//send free message
	$("#free_msg_form").submit(function(event){
		event.preventDefault();
		$.ajax({
			url:site_url+"whatsajax/freeMessage",
			data:{
				"number":$("#free_number_text").val(),
				"message":$("#free_message_text").val()
				},
			type:"POST",
			success:function(data){
				if(data == "1"){
					alert("تم ارسال الرسالة بنجاح!");
					$("#free_number_text").val("");
					$("#free_message_text").val("");
				}
				else if(data == "2")
					alert("الخدمة غير متاحة حالياً");
				else if(data == "3")
					alert("يرجى كتابة الرقم المستقبل");
				else if(data == "4")
					alert("يجب ان يكون الرقم المستقبل بطول 12 رقم");
				else if(data == "5")
					alert("يرجى كتابة نص الر سالة");
				else if(data == "6")
					alert("يجب كتابة الرقم المستقبل بأرقام فقط");
				else
				alert("حصل مشكلة في الارسال يرجى اعادة المحاولة");
				return false;
			}
		});
		return false;
	});
	
    $(".emoji").on('click', function() {
        var txtToAdd = this.className;
        $(".fake_message, #fake_message").append("<img class='"+txtToAdd+"'/>");
    });

	//send user single fast message
	$("#fast_message_form").submit(function(event){
		event.preventDefault();
		$.ajax({
			url:site_url+"whatsajax/sendSingleMessage",
			data:{
				"number":$("#free_number_text").val(),
				"message":$("#free_message_text").val()
			},
			type:"POST",
			dataType:"json",
			success:function(data){
				if(data["status"] == "1"){
					alert("تم ارسال الرسالة بنجاح!");
					$("#free_number_text").val("");
					$("#free_message_text").val("");
					$("#user_credits_span").text(data["credits"]);
				}
				else if(data["status"] == "2")
					alert("الخدمة غير متاحة حالياً");
				else if(data["status"] == "3")
					alert("يرجى كتابة الرقم المستقبل");
				else if(data["status"] == "4")
					alert("يجب ان يكون الرقم المستقبل بطول 12 رقم");
				else if(data["status"] == "6")
					alert("يجب كتابة الرقم المستقبل بأرقام فقط");
				else if(data["status"] == "5")
					alert("يرجى كتابة نص الر سالة");
				else
					alert("حصل مشكلة في الارسال يرجى اعادة المحاولة");
				return false;
			}
		});
		return false;
	});
	
	//send conversation message message
	$("#conv_send_form").submit(function(event){
		setMessage('div#fake_message', '#conv_message_text');
	    event.preventDefault();
		$.ajax({
			url:site_url+"whatsajax/sendSingleMessage",
			data:{
				"channel_id" : $("#conv_channel_text").val(),
				"number":$("#conv_number_text").val(),
				"message":$("#conv_message_text").val(),
				"fake_message":$("#fake_message").html(),
			},
			type:"POST",
			dataType:"json",
			success:function(data){
				if(data["status"] == "1"){
					$("#fake_message").html("");
					$("#conv_message_text").val("");
					$("#user_credits_span").text(data["credits"]);
					var conv_div = document.getElementById("conv_container_div");
					//var number_text = document.getElementById("conv_number_text");
					//if(number_text != null)
					//	number_text.value="";
					if(conv_div != null)
					conv_div.scrollTop = conv_div.scrollHeight;
				}
				else if(data["status"] == "2")
					alert("الخدمة غير متاحة حالياً");
				else if(data["status"] == "3")
					alert("يرجى كتابة الرقم المستقبل");
				else if(data["status"] == "4")
					alert("يجب ان يكون الرقم المستقبل بطول 12 رقم");
				else if(data["status"] == "6")
					alert("يجب كتابة الرقم المستقبل بأرقام فقط");
				else if(data["status"] == "5")
					alert("يرجى كتابة نص الر سالة");
				return false;
			}
		});
		return false;
	});
	
	// get user sub groups of a main group
	$("#main_container").on("change", "#main_groups_select", function() {
		$.ajax({
			url : site_url + "whatsajax/getUserSubGroups",
			data : {
				"group_id" : $(this).val()
			},
			dataType:"json",
			type : "post",
			success : function(data) {
				$("#sub_groups_select").empty();
				$("#sub_groups_select").append($("<option />").val("").text(lang("choose_group")));
				if (data.results != null){
					//hideNotice();
					$.each(data.results, function() {
					    $("#sub_groups_select").append($("<option />").val(this.id).text(this.title));
					});
				}
				else if (data == "2"){
					showNotify("error", lang("no_send_group"));
				}
				else if (data == "0")
					showNotify("error", lang("no_sub_groups"));
			}
		});
		return false;
	});
	
	//check if group have numbers or not
	$("#main_container").on("change", "#sub_groups_select", function(){
		$.ajax({
			url : site_url + "whatsajax/checkGroupEmpty",
			data: {"group_id": $(this).val()},
			type:"get",
			success: function(data){
				if(data == "1"){
					is_group_empty = true;
					hideNotice();
				}else{
					is_group_empty = false;
					showNotify("error", lang("group_empty"));
				}
			}
		});
		return false;
	});
	
	$("#main_container").on("submit", "form#send_bulk_message_form", function(){
		if($(this).find("#sub_groups_select").val() == ""){
			showNotify("error", lang("choose_sub_group"));
			return false;
		}
		if(is_group_empty == false){
			showNotify("error", lang("choose_sub_group_not_empty"));
			return false;
		}
		if($(this).find("#fake_bulk_message").html() == ""){
			showNotify("error", lang("enter_message"));
			return false;
		}
		if($("#send_bult_nickname").val() == ""){
			showNotify("error", lang("enter_nickname"));
			return false;
		}
		setMessage("div#fake_bulk_message", "textarea#bulk_message_text");
	});
	
	
});


//convert message from fake messsage container containing emojies to message encoding emojies
function setMessage(fake, hidden){
    //Store original html to replace back in box later.
    var original = $(fake).html();
    //Scan html code for emojis and replace with text and special marker.
    $(fake+' img').each(function(index) {
        var emojiUnicode = this.outerHTML.match(/emoji-(.*?)"/)[1];
        $(this).replaceWith('##' + emojiUnicode + '##');
    });
    //Replace all BR's with line breaks.
    var message = $.trim($(fake).html().replace(/<br\s?\/?>/g, "\n"));
    //Copy the corrected message text to our hidden input field to be serialised.
    $(hidden).val($(fake).html(message).text());
    //Replace the corrected text with the original html so it shows properly on a browser.
    $(fake).html(original);
}