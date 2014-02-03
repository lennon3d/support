$(document).ready(function() {

	// add new main group in main groups window
	$("#main_container").on("click", "#add_group_btn", function() {
		$.ajax({
			url : site_url + "whatsajax/addMainGroup",
			data : {
				"group_title" : $("#add_group_text").val()
			},
			type : "post",
			success : function(data) {
				if (data == "1"){
					$("#add_group_text").val("");
					//alert(lang("main_group_added"));
					showNotify("success", lang("main_group_added"));
					getPage(referer, "#main_container");
				}
				else if (data == "2"){
					showNotify("error", lang("main_group_title_send"));
				}
				else if (data == "-2"){
					showNotify("error", lang("group_existed"));
				}
				else if (data == "3")
					showNotify("error", lang("main_group_title_empty"));
			}
		});
		return false;
	});
	
	// add new sub group in sub groups window
	$("#main_container").on("click","#add_sub_group_btn, #add_sub_group_main_btn", function() {
		var btn_id = this.id;
		$.ajax({
			url : site_url + "whatsajax/addSubGroup",
			data : {
				"group_title" : $("#add_sub_group_text").val(),
				"group_id" : $("#main_group_id").val()
			},
			type : "post",
			success : function(data) {
				if (data == "1"){
					$("#add_sub_group_text").val("");
					$("#main_group_id").val("").select();
					getPage(referer, "#main_container");
					showNotify("success", lang("sub_group_added"));
				}
				else if (data == "2")
				showNotify("error", lang("sub_group_title_send"));
				else if (data == "-2")
				showNotify("error", lang("group_existed"));
				else if (data == "4")
				showNotify("error", lang("choose_main_group"));
				else if (data == "3")
				showNotify("error", lang("main_group_title_empty"));
			}
		});
		return false;
	});
	
	$("#main_container").on("click", ".edit_group", function(){
		$(this).hide();
		var group_title = $("#group_title_"+this.id).text();
		$("#group_title_"+this.id)
		.html("<input type='text' value='"+group_title+"' id='group_text_"+this.id+"' class='form-control'/>" +
				"<a href='#' class='btn btn-xs green ok_edit_group' id='ok_"+group_title+"_"+this.id+"'><b class='fa fa-check'></b></a>" +
				"<a href='#' class='btn btn-xs red cancel_edit_group' id='cancel_"+group_title+"'><b class='fa fa-times'></b></a>");
	});
	
	
	$("#main_container").on("click", ".edit_number", function(){
		var arr = this.id.split("_");
		var number = $("#number_"+arr[arr.length-1]).html();
		var name = $("#name_"+arr[arr.length-1]).html();
		$("#name_"+arr[arr.length-1]).html("<input type='text' class='form-control' value='"+name+"' " +
				"id='name_text_"+arr[arr.length-1]+"'/>");
		$("#number_"+arr[arr.length-1]).html("<input type='text' class='form-control' value='"+number+"' " +
				"id='number_text_"+arr[arr.length-1]+"'/>");
		$(this).closest("td").html("<a href='#' class='btn green btn-xs ok_edit_number' id='ok_"+arr[arr.length-1]+"'><b class='fa fa-check'></b></a>" +
				"<a href='#' class='btn red btn-xs cancel_edit_number' id='cancel_"+arr[arr.length-1]+"'><b class='fa fa-times'></b></a>");
	});
	
	$("#main_container").on("click", ".empty_group", function(){
		if(confirm(lang("empty_confirm"))){
		$.ajax({
			url:site_url+"whatsajax/emptyUserGroup",
			data:{"group_id": this.id},
			type:"post",
			success:function(data){
				if(data == "1"){
					getPage(referer, "#main_container");
					showNotify("success", lang("group_emptied"));
				}
			}
		});
		}
		return;
	});

	$("#main_container").on("click", ".delete_group", function(){
		if(confirm(lang("delete_confirm"))){
			$.ajax({
				url:site_url+"whatsajax/deleteUserGroup",
				data:{"group_id": this.id},
				type:"post",
				success:function(data){
					if(data == "1"){
						getPage(referer, "#main_container");
						showNotify("success", lang("group_deleted"));
					}
				}
			});
		}
		return;
	});
	
	$("#main_container").on("click", ".delete_number", function(){
		var arr = this.id.split("_");
		if(confirm(lang("delete_confirm"))){
			$.ajax({
				url:site_url+"whatsajax/deleteUserNumber",
				data:{"number_id": arr[arr.length-1]},
				type:"post",
				success:function(data){
					if(data == "1"){
						getPage(referer, "#main_container");
						showNotify("success", lang("number_deleted"));
					}
				}
			});
		}
		return;
	});
	
	$("#main_container").on("click", ".cancel_edit_group", function(){
		var arr = this.id.split("_");
		getPage(referer, "#main_container");
	});
	
	$("#main_container").on("click", ".cancel_edit_number", function(){
		getPage(referer, "#main_container");
	});
	
	$("#main_container").on("click", ".ok_edit_group", function(){
		var arr = this.id.split("_");
		var title = $("#group_text_"+arr[arr.length-1]).val();
		$.ajax({
			url:site_url+"whatsajax/editUserGroup",
			data:{"title":title, "group_id":arr[arr.length-1]},
			type:"post",
			success: function(data){
				if(data == "1"){
					getPage(referer, "#main_container");
					showNotify("success", lang("group_edited"));
				}else if(data == "4")
				showNotify("error", lang("main_group_title_empty"));
				else if (data == "-2")
				showNotify("error", lang("group_existed"));
				else
				showNotify("error", lang("edit_group_error"));
			}
		});
	});
	
	$("#main_container").on("click", ".ok_edit_number", function(){
		var arr = this.id.split("_");
		var name = $("#name_text_"+arr[arr.length-1]).val();
		var number = $("#number_text_"+arr[arr.length-1]).val();
		$.ajax({
			url:site_url+"whatsajax/editUserNumber",
			data:{"number":number, "name":name, "number_id": arr[arr.length-1], "group_id":$("#group_id_hidden").val()},
			type:"post",
			success: function(data){
				if(data == "1"){
					getPage(referer, "#main_container");
					showNotify("success", lang("number_edited"));
				}else if(data == "4")
				showNotify("error", lang("entermobile"));
				else if(data == "3")
				showNotify("error", lang("number_id_empty"));
				else if(data == "5")
				showNotify("error", lang("numeric"));
				else if(data == "6")
				showNotify("error", lang("mobile_12"));
				else if (data == "-2")
				showNotify("error", lang("number_existed"));
				else if (data == "-3")
				showNotify("error", lang("no_whats_registered"));
				else
				showNotify("error", lang("edit_number_error"));
				
			}
		});
	});
	

	// add new mobile number numbers window
	$("#main_container").on("click", "#add_number_btn", function() {
		$.ajax({
			url : site_url + "whatsajax/addUserNumber",
			data : {
				"name" : $("#add_name_text").val(),
				"group_id" : $("#number_group_id").val(),
				"mobile" : $("#add_mobile_text").val()
			},
			type : "post",
			success : function(data) {
				if (data == "1"){
					$("#add_name_text").val("");
					$("#add_mobile_text").val("");
					getPage(referer, "#main_container");
					showNotify("success", lang("new_number_added"));
				}
				else if (data == "2")
				showNotify("error", lang("number_send"));
				else if (data == "3")
				showNotify("error", lang("entermobile"));
				else if(data == "4")
				showNotify("error", lang("numeric"));
				else if (data == "5")
				showNotify("error", lang("mobile_12"));
				else if (data == "-2")
				showNotify("error", lang("number_existed"));
				else if (data == "-3")
				showNotify("error", lang("no_whats_registered"));
			}
		});
		return false;
	});
	
	
	
	
	
	
	
	
	
	
});



// function to get user numbers groups
function getUserGroups(table_id) {
	$.ajax({
		url : site_url + "whatsajax/getUserMainGroups",
		dataType : "json",
		success : function(data) {
			// $("#"+table_id).find("td").remove();
			for (var i = 0; i < data.length; i++) {
			}
		}
	});
}

function editGroup(id, title){
	
}