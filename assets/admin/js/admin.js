$(document).ready(function(){

	$(".permission_row_check").on("click", function(){
		if($(this).is(":checked")){
			$(this).parent().parent().parent().parent().find(".permissions_checks").prop("checked", true);
			$(this).parent().parent().parent().parent().find(".permissions_checks").parent().addClass("checked");
		}else{
			$(this).parent().parent().parent().parent().find(".permissions_checks").prop("checked", false);
			$(this).parent().parent().parent().parent().find(".permissions_checks").parent().removeClass("checked");
	}
	});
	
	$("#confirm_delete_table_but").on("click", function(){
		$("#table_form").submit();
	});
	
	$(".delete_a").on("click", function(){
		$("#delete_confirm_form").prop("action", this.id);
	});

	$(".assign_channel").on("click", function(){
		$("#assign_channel_hidden").val(this.id);
	});
	
	$("#confirm_delete_but").on("click", function(){
		$("#delete_confirm_form").submit();
	})
	
	$("#table_pdf_export_but,.table_pdf_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("pdf");
		$("#export_table_form").submit();
	});
	$("#table_excel2003_export_but,.table_excel2003_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("excel2003");
		$("#export_table_form").submit();

	});
	$("#table_excel2007_export_but,.table_excel2007_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("excel2007");
		$("#export_table_form").submit();
	});
	
	$("#export_table_form").on("submit", function(){
		var thead = $(".table_for_print thead tr th");
		var tbody_tr = $("table tbody tr");
		var tbody_td = $("table tbody tr td");
		var thead_array = new Array();
		var tbody_array = new Array();
		$(this).closest("div").find("table thead tr th").each(function(key, value){
			thead_array.push(value.textContent);
		});
		$(this).closest("div").find("table tbody tr td").each(function(key, value){
				tbody_array.push(value.textContent);
			});
		thead_array = JSON.stringify(thead_array);
		tbody_array = JSON.stringify(tbody_array);
		$(this).find("textarea[name=tbody]")
		.val(tbody_array);
		$(this).find("input[name=src]")
		.val($("#talent_pic").attr("src"));
		$(this).find("textarea[name=thead]")
		.val(thead_array);
	});
	
	$(".checkbox-all ,#check-all").on("click", function(){
		if($(this).is(":checked")){
			$(this).parent().parent().parent().parent().parent().parent().find("input[type=checkbox]").prop("checked", true);
			$(this).parent().parent().parent().parent().parent().parent().find("input[type=checkbox]").parent().addClass("checked");
		}else{
			$(this).parent().parent().parent().parent().parent().parent().find("input[type=checkbox]").prop("checked", false);
			$(this).parent().parent().parent().parent().parent().parent().find("input[type=checkbox]").parent().removeClass("checked");
	}
	});
	
	// get emails of selected subscribers and put them in emails textarea
	$("#send_email_selected_btn").on("click", function(){
		var id_array="";
		$(".email_checks").each(function(){
			if($(this).is(':checked'))
				id_array += ($(this).val()) + ",";
		});
		$.ajax({
			url:site_url+"admin/groups/getSubsEmails",
			type:"post",
			data:{"ids":id_array},
			success:function(data){
				$("#emails_content").val(data);
			}
		});
	});
	
	// get emails of all subscribers and put them in emails textarea
	$("#send_email_all_btn").on("click", function(){
		var id_array="";
		$(".email_checks").each(function(){
			id_array += ($(this).val()) + ",";
		});
		$.ajax({
			url:site_url+"admin/groups/getSubsEmails",
			type:"post",
			data:{"ids":id_array},
			success:function(data){
				$("#emails_content").val(data);
			}
		});
	});
	
	// get mobiles numbers of selected subscribers and put them in mobiles
	// textarea
	$("#send_sms_selected_btn").on("click", function(){
		var id_array="";
		$(".mobile_checks").each(function(){
			if($(this).is(':checked'))
				id_array += ($(this).val()) + ",";
		});
		$.ajax({
			url:site_url+"admin/groups/getSubsMobiles",
			type:"post",
			data:{"ids":id_array},
			success:function(data){
				$("#mobiles_content").val(data);
			}
		});
	});
	
	// get mobiles numbers of all subscribers and put them in mobiles textarea
	$("#send_sms_all_btn").on("click", function(){
		var id_array="";
		$(".mobile_checks").each(function(){
			id_array += ($(this).val()) + ",";
		});
		$.ajax({
			url:site_url+"admin/groups/getSubsMobiles",
			type:"post",
			data:{"ids":id_array},
			success:function(data){
				$("#mobiles_content").val(data);
			}
		});
	});
	
	// get country cities
	$(".countries_select").on("change", function(){
		$.ajax({
			url:site_url+"admin/offers/getCountryCities",
			data:{"country_id":this.value},
			type:"get",
			dataType:"json",
			success: function(data){
				if(data){
					$(".cities_select").empty();
					for(var i=0; i<data.length; i++){
					     $('.cities_select')
					         .append($("<option></option>")
					         .attr("value",data[i].id)
					         .text(data[i].city_name)); 
					}
				}
			}
			});
		});
});

