	tinyMCE.init({
		// General options
		selector : "textarea#content_text",
	    theme: "modern",
	    plugins: [
	              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	              "searchreplace wordcount visualblocks visualchars code fullscreen",
	              "insertdatetime media nonbreaking save table contextmenu directionality",
	              "emoticons template paste textcolor"
	          ],

		convert_urls: false,
		
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    toolbar2: "print preview media | forecolor backcolor emoticons",
	    image_advtab: true,		
		
		//Open Manager Options
		file_browser_callback : elFinderBrowser,

	});

	function elFinderBrowser (field_name, url, type, win) {
		  tinymce.activeEditor.windowManager.open({
		    file: '<?=base_url()?>assets/admin/js/elfinder/elfinder.html',// use an absolute path!
		    title: 'elFinder 2.0',
		    width: 900,  
		    height: 450,
		    resizable: 'yes'
		  }, {
		    setUrl: function (url) {
		      win.document.getElementById(field_name).value = url;
		    }
		  });
		  return false;
		}
	