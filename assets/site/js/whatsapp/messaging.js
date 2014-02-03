function getChannelInbound(channel_id) {
	$.ajax({
		url : site_url+"whatsajax/channelInbound",
		dataType : "json",
		data:{"channel_id":channel_id},
		type:"get",
		async : true,
		cache : false,
		timeout:70000,
		success : function(data) {
			if(data){
				if (data.length > 0)
					for ( var i = 0; i < data.length; i++) {
						var old_value = parseInt($("#contact_"+data[i].number+" .badge").html());
						$("#contact_"+data[i].number+" .badge").html(parseInt(data[i].count)+old_value);
						$("#contact_"+data[i].number+" .badge").addClass("badge-success");
						$("#contact_"+data[i].number+" .badge").removeClass("badge-inverse");
						$("#contact_"+data[i].number+" .text").css("background-color","#CFFFC8");
						$("#contact_"+data[i].number+" #message-text").html(data[i].message);
					}
				}
			setTimeout(function() {
				getChannelInbound(channel_id);
			}, 1000);
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			setTimeout(function() {
				getChannelInbound(channel_id);
			}, 15000);
		}
	});
}
function getNumberInbound(channel_id, number) {
	$.ajax({
		url : site_url+"whatsajax/numberInbound",
		dataType : "json",
		data:{"number": number, "channel_id": channel_id},
		type:"get",
		async : true,
		cache : false,
		timeout:70000,
		success : function(data) {
			if(data){
				if (data.length > 0)
					for ( var i = 0; i < data.length; i++) {
						if(number != ""){
							$("#conv_container_ul").append(data[i]["message_container"]);
							var conv_div = document.getElementById("conv_container_div");
							if(conv_div != null)
								conv_div.scrollTop = conv_div.scrollHeight;
						}
					}
			}
			setTimeout(function() {
				getNumberInbound(channel_id, number);
			}, 1000);
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			setTimeout(function() {
				getNumberInbound(channel_id, number);
			}, 15000);
		}
	});
}

function getUngotenMessages(number) {
	$.ajax({
		url : site_url+"whatsajax/getUngotenMessages/"+number,
		dataType : "json",
		async : true,
		cache : false,
		success : function(data) {
			if(data){
			if (data.length > 0)
				for ( var i = 0; i < data.length; i++) {
					if(number != ""){
						$("#conv_container_ul").append(data[i]["message_container"]);
						var conv_div = document.getElementById("conv_container_div");
						if(conv_div != null)
							conv_div.scrollTop = conv_div.scrollHeight;
					}
				}
			}
			setTimeout(function() {
				getUngotenMessages(number);
			}, 1000);
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			setTimeout(function() {
				getUngotenMessages(number);
			}, 5000);
		}
	});
}