$(document).ready(function(){
	
	$("#error_notice").hide();
	$("#success_notice").hide();
	
	
	$("#main_container").on("click",".checkbox-all ,#check-all", function(){
		if($(this).is(":checked")){
			$("table").find(".check_input").prop("checked", true);
			$("table").find(".check_input").parent().addClass("checked");
		}else{
			$("table").find(".check_input").prop("checked", false);
			$("table").find(".check_input").parent().removeClass("checked");
	}
	});
	
	//ajax loader show and hide on ajax requests
	$(".loader_div").hide();
	$(document).ajaxStart(function(){
		$(".loader_div").show();
	});
	$(document).ajaxStop(function(){
		$(".loader_div").hide();
	});
	
	//email subscribe form submit new email
	$("#subscribe-form").on("submit", function(){
		$.ajax({
			url:site_url+"subscribe",
			data:{"email":encodeURIComponent($(this).find("input[type=text]").val())},
			type:"get",
			success:function(data){
				if(data == 1)
					alert("تم تسجيل اشتراكك في القائمة البريدية");
			}
		});
		return false;
	});
	
	
	//hide later time text in begining
	$("#later_time").hide();
	
	//show later text when clicking on send later radio button
	$("#send_later_radio").on("click", function(){
		$("#later_time").show();
	});
	
	//hide later text when clicking on send Now radio button
	$("#send_now_radio").on("click", function(){
		$("#later_time").hide();
	});

});

function exportPdf(){
	$("#pdfcontainer").html($("#page_container").html());
	$("#export_pdf_form").submit();
}

function getPage(url, element){
	$.ajax({
		url:url,
		success:function(data){
			$(element).html( $(data).filter(element).html() );
		}
	});
	return;
}

function lang(index){
	return lang_array[index];
}

function showSuccess(message){
	$("#notice_container").hide();
	$("#error_notice").hide();
	$("#success_notice").hide();
	$("#success_notice").show("fade");
	$("#success_notice_message").html(message);
	return;
}

function showError(message){
	$("#notice_container").hide();
	$("#success_notice").hide();
	$("#error_notice").hide();
	$("#error_notice").show("fade");
	$("#error_notice_message").html(message);
	return;
}

function hideNotice(){
	$("#notice_container").hide();
	$("#error_notice").hide();
	$("#success_notice").hide();
	return;
}

function showNotify(type, message){
	$(".toast").hide();
	toastr.options.newestOnTop = false;
	switch(type){
	case "error":
		toastr.error(lang("operation_error"));
		toastr.warning(message);
		break;
	case "success":
		toastr.success(message);
		break;
	case "info":
		toastr.info(message);
		break;
	}
}
