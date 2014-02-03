$.expr[':'].textEquals = function(a, i, m) {
	//ex. $("#top .list a:textEquals('TEXT')").addClass('current');
	return $(a).text().match("^" + m[3] + "$");
};
var Browser = {
	Version: function() {
		var version = 999;
		if (navigator.appVersion.indexOf("MSIE") != -1){
			version = parseFloat(navigator.appVersion.split("MSIE")[1]);
		}
		return version;
	}
};
function isValidEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
function is_int(value) {
	for (i = 0; i < value.length; i++) {
		if ((value.charAt(i) < '0') || (value.charAt(i) > '9')) return false
	}
	return true;
}
var apprise_config = {
	'textOk' : 'موافق',
	'textCancel' : 'تجاهل',
	'textYes' : 'نعم',
	'textNo' : 'لا'
};
function alert_(text, focus_element){
	apprise(text, apprise_config, function (e) {
		if(e){
			setTimeout(function () {
				$(focus_element).focus();
			},200);
		}
	});
}
function confirm_(text){
	apprise_config['confirm'] = true;
	apprise(text, apprise_config, function (e) {
		if(e){
			return true;
		}else{
			return false;
		}
	});
}
/*\INTERNET_EXPLORER_6_ERROR*/
$(document).ready(function() {
	if (Browser.Version() <= 6) {
		$('#ie6-error').show();
		$(window).scroll(function() {
			$("#ie6-error").css("top", $(window).scrollTop() + "px");
		});
		$(window).resize(function() {
			$("#ie6-error").css("top", $(window).scrollTop() + "px");
		});
	}
	$('#ie6-error .close').click(function(){
		$('#ie6-error').fadeOut(300);
	});
});
/*\INTERNET_EXPLORER_6_ERROR*/
/*Defaults*/
$(document).ready(function() {
	var CurrentDirection = $('html').css('direction').toLowerCase();
	/*placeholder*/
	if (Browser.Version() <= 9) {
		$('input[placeholder]').each(function() {
			if($(this).parent()[0].tagName.toLowerCase() == 'label'){
				$(this).parent('lable').css('position', 'relative');
				$(this).placeholder();
			}else if($(this).parent()[0].tagName.toLowerCase() == 'span'){
				$(this).parent('span').css('position', 'relative');
				$(this).placeholder();
			}
		});
	}
	/*\placeholder*/
	/*focus ie7*/
	if (Browser.Version() <= 7) {
		$('input, textarea').focus(function () {
			$(this).addClass('focus');
		});
		$('input, textarea').focusout(function () {
			$(this).removeClass('focus');
		});
	}
	/*\focus ie7*/
	/*input submit*/
	$('input').keypress(function(e){
		if(e.keyCode == 13){
			if($(this).parents('form').length > 0){
				$(this).parents('form').submit();
				return false;
			}
		}
	});
	/*\input submit*/
	/*a submit*/
	$('a.submit').click(function(e){
		if($(this).parents('form').length > 0){
			$(this).parents('form').submit();
			return false;
		}
	});
	/*\a submit*/
});
/*\Defaults*/
/*##################################################################################################*/
/*##################################################################################################*/
$(document).ready(function() {
	/*search*/
	var SearchForm = '#header .search form';
	if($(SearchForm).length > 0){
		$(SearchForm).submit(function(){
			if($(this).find('input[type="text"]').val() == ''){
				alert_('الرجاء كتابة كلمة البحث' , $(this).find('input[type="text"]'));
				return false;
			}
		});
	}
	/*\search*/
	/*login*/
	var LoginForm = '#header .login form';
	if($(LoginForm).length > 0){
		$(LoginForm).submit(function(){
			if($(this).find('input[type="text"]').val() == ''){
				var InputName = 'إسم المستخدم';
				if($(this).find('input[type="text"]').attr('placeholder')){
					InputName = $(this).find('input[type="text"]').attr('placeholder');
				}
				alert_('الرجاء كتابة ' + InputName, $(this).find('input[type="text"]'));
				return false;
			}else if($(this).find('input[type="password"]').val() == ''){
				var InputName = 'كلمة المرور';
				if($(this).find('input[type="password"]').attr('placeholder')){
					InputName = $(this).find('input[type="password"]').attr('placeholder');
				}
				alert_('الرجاء كتابة ' + InputName, $(this).find('input[type="password"]'));
				return false;
			}
		});
	}
	/*\login*/
	/*slider*/
	if($('#slider-container .slider-content .slider-wrapper').length > 0){
		$(window).load(function() {
			$('#slider-container .slider-content .slider-wrapper #slider').nivoSlider({
				controlNav: true,
				pauseTime: 5000
			});
		});
	}
	/*\slider*/
	/*mailing-list*/
	var MailingForm = '#container .blocks .block.mailing-block .holder .body form';
	if($(MailingForm).length > 0){
		$(MailingForm).submit(function () {
			if($(this).find('input[type="text"]').val() == ''){
				alert_('الرجاء كتابة بريدك الإلكتروني', $(this).find('input[type="text"]'));
				return false;
			}else if(!isValidEmail($(this).find('input[type="text"]').val())){
				alert_('الرجاء كتابة بريدك الإلكتروني بشكل صحيح', $(this).find('input[type="text"]'));
				return false;
			}
		});
	}
	/*\mailing-list*/
	/*companies-block*/
	if($('#container .blocks .block.companies-block .holder .body .list-container').length > 0){
		$.fn.extend ({
			SlideItems : function(options){
				return this.each(function() {
					var SlideContent = {
						'direction' : 'rtl',
						'body' : '',
						'arrows_class' : '.arrows',
						'arrows' : function(){
							return $(this['body']).find(this['arrows_class']);
						},
						'loading_class' : '.loading',
						'loading' : function(){
							return $(this['body']).find(this['loading_class']);
						},
						'right-arrow_class' : '.arrows .to-right',
						'right-arrow' : function(){
							return $(this['body']).find(this['right-arrow_class']);
						},
						'left-arrow_class' : '.arrows .to-left',
						'left-arrow' : function(){
							return $(this['body']).find(this['left-arrow_class']);
						},
						'item_class' : '.list .item',
						'item' : function(){
							return $(this['body']).find(this['item_class']);
						},
						'current-first-item-index': 0,
						'current-last-item-index': 0,
						'speed': 500,
						'easing': 'easeOutBack',
						'next-arrow' : function () {
							if(this['direction'] == 'rtl'){
								return  this['left-arrow']();
							}else{
								return this['right-arrow']();
							}
						},
						'prev-arrow' : function () {
							if(this['direction'] == 'rtl'){
								return  this['right-arrow']();
							}else{
								return this['left-arrow']();
							}
						},
						'item_length' : function () {
							return this['item']().length;
						},
						'max-item-index' : function () {
							return this['item_length']() - 1;
						},
						'check_last_arrows' : function () {
							if(this['current-last-item-index'] == this['max-item-index']()){
								this['next-arrow']().addClass('last');
							}else{
								if(this['next-arrow']().hasClass('last')){
									this['next-arrow']().removeClass('last');
								}
							}
							if(this['current-first-item-index'] == 0){
								this['prev-arrow']().addClass('last');
							}else{
								if(this['prev-arrow']().hasClass('last')){
									this['prev-arrow']().removeClass('last');
								}
							}
						},
						'get_next' : function () {
							this['current-last-item-index']++;
							this['item']().eq(this['current-first-item-index']).slideUp(this['speed'], this['easing']);
							this['item']().eq(this['current-last-item-index']).slideDown(this['speed'], this['easing']);
							this['current-first-item-index']++;
							this['check_last_arrows']();
						},
						'get_prev' : function () {
							this['current-first-item-index']--;
							this['item']().eq(this['current-first-item-index']).slideDown(this['speed'], this['easing']);
							this['item']().eq(this['current-last-item-index']).slideUp(this['speed'], this['easing']);

							this['current-last-item-index']--;
							this['check_last_arrows']();
						},
						'run' : function () {
							if(this['item_length']() <= 0){
								this['loading']().hide();
							}else{
								if(this['item_length']() <= 3){
									this['loading']().hide();
									//$(this['body']).show();
								}else{
									$(this['loading']()).hide();
									//$(this['body']).show();
									this['next-arrow']().show();
									this['prev-arrow']().show();
									for(var i = 0; i <= this['current-last-item-index']; i++){
										this['item']().eq(i).show();
									}
									this['check_last_arrows']();
								}
							}
						},
						'events' : function () {
							this['next-arrow']().click({'o':this},function (event) {
								if(!$(this).hasClass('last')){
									event.data['o']['get_next']();

								}
							});
							this['prev-arrow']().click({'o':this},function (event) {
								if(!$(this).hasClass('last')){
									event.data['o']['get_prev']();
								}
							});
						},
						'start' : function (options) {
							$.extend(this, options);
							this['run']();
							this['events']();
						}
					};
					$.extend(SlideContent, options);
					SlideContent['start']({
						'body': this
					});
				});
			}
		});
		$('#container .blocks .block.companies-block .holder .body').SlideItems({
			'speed': 300,
			'easing': 'easeInOutCirc'
		});
	}
	/*\companies-block*/
	/*logout*/
	var LogoutButton = '#header .user-info a.logout';
	if($(LogoutButton).length > 0){
		$(LogoutButton).click(function () {
			if(!confirm('هل أنت متأكد؟')){
				return false;
			}
		});
	}
	/*\logout*/
	/*tabs*/
	if($('#container #main .main-block .main-block-body .service-content .details').length > 0){
		$("#container #main .main-block .main-block-body .service-content .details").easytabs({
			tabs: "> ul.buttons > li",
			defaultTab: "li:eq(0)",
			tabActiveClass: "current",
			updateHash : true
		});
	}
	if($('#container #main .main-block .main-block-body .service-content .details .contents .tab.photos .slides').length > 0){
		$('#container #main .main-block .main-block-body .service-content .details .contents .tab.photos .slides').slidesjs({
			width: 565,
			height: 393,
			navigation : {
				active : true,
				effect : "fade"
			},
			effect: {
				slide : {
					speed : 500
				},
				fade : {
					speed : 300,
					crossfade : true
				}
			},
			pagination: {
				active: true,
				effect: 'fade'
			},
			play: {
				active: true,
				effect: 'fade'
			},
			callback : {
				loaded: function() {
					$('#container #main .main-block .main-block-body .service-content .details .contents .tab.photos .slides').find('a').each(function () {
						$(this).attr('title', '');
					});
				}
			}
		});
	}
	/*\tabs*/
});