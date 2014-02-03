$(document).ready(function() {
	var elf = $('#elfinder').elfinder({
		url : site_url+'assets/admin/js/elfinder/php/connector.php',  // connector URL (REQUIRED)
		handlers : {
			select : function(event, elfinderInstance) {
				var selected = event.data.selected;
				if(selected.length > 0){
					var file = elfinderInstance.file(selected[0]);
					$("#elfinder_dialog #elfinder_url_text").val("assets/"+elfinderInstance.path(selected[0]));
				}
			}
		}
	}).elfinder('instance');
	$(".open_elfinder").on("click", function(){
		$("#elfinder_dialog #elfinder_dest_text").val($(this).parent().find("input").attr("id"));
	});
	
	$("#elfinder_dialog #elfinder_ok_btn").on("click", function(){
		$("#"+$("#elfinder_dialog #elfinder_dest_text").val()).val($("#elfinder_dialog #elfinder_url_text").val());
	});
});

function elfinderDialog(){

}