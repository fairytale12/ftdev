var ftHelper = function() {};

ftHelper.isAjaxBusy = false;
ftHelper.tabDirection = 'rtl';

ftHelper.showPreloader = function() {
	if(!$('#site-preloader').length) {
		return false;
	}
	
	$('#site-preloader').show();
	return true;
};

ftHelper.hidePreloader = function() {
	if(!$('#site-preloader').length) {
		return false;
	}
	
	$('#site-preloader').hide();
	return true;
};

ftHelper.showButtonPreloader = function(_this) {
	$(_this).addClass('button-loading');
	return false;
};

ftHelper.hideButtonPreloader = function(_this) {
	$(_this).removeClass('button-loading').blur();
	return false;
};

ftHelper.destroy = function() {
	
	// iCheck
	//$('input[type="checkbox"]').iCheck('destroy');
	//$('.done-task-block input[type="checkbox"]').unbind('ifChecked');
};

ftHelper.init = function() {
	/*
	// iCheck
	$('input[type="checkbox"]').iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal',
		increaseArea: '20%' // optional
	});
	
	$('.done-task-block input[type="checkbox"]').unbind('ifChecked').bind('ifChecked', function(event){
		// Задание выполнено
		ftUserLesson.lessonComplete(this);
	});
	
	if($('#vk-comments').length) {
		VK.Widgets.Comments('vk-comments', {limit: 10, attach: false, autoPublish: 0}, $('#vk-comments').data('id'));
	}

	*/
	// Подгрузка картинок
	var allPImageNumber = $('.tab img').length;
	var currentPImageNumber = 0;
	// Устанавливает футер, при полной подгрузке картинок
	allImageLoaded = function() {
		currentPImageNumber++;
		if(currentPImageNumber == allPImageNumber) {
			setFooterY();
		}
	};

	$('.tab img').each(function(){
		var img = $(this);
		$('<img/>').load(function() {
			// Выполнится при загрузке картинок
			//setFooterY();
			allImageLoaded();
		}).error(function() {
			//currentPImageNumber++;
			img.remove();
			allImageLoaded();
		}).attr('src', img.attr('src'));
	});

	graph_init('services-graph', 1000);
	$('.tab').find('pre code').each(function(i, e) {hljs.highlightBlock(e)});
	setFooterY();
};

ftHelper.showModal = function(id, closeBtn) {
	
	if(closeBtn == undefined) {
		closeBtn = true;
	}
	
	var settings = {
		closeBtn: closeBtn,
		padding: 10,
		helpers : {
			overlay : {
				css : {
					'overflow': 'hidden' 
				},
				closeClick: closeBtn,
				locked: false
			}
		},
		keys: {
			close: []
		}
	};
	
	$.fancybox(id, settings);
	
	return false;
};

ftHelper.showIframe = function(href, closeBtn) {
	
	if(closeBtn == undefined) {
		closeBtn = true;
	}
	
	var settings = {
		closeBtn: closeBtn,
		href: href,
		type: 'iframe',
		//width: 400,
		maxWidth: 280,
		fitToView: false,
		padding: 0,
		scrolling: 'no',
		iframe: {
			scrolling: 'no'
		},
		helpers : {
			overlay : {
				css : {
					'overflow': 'hidden' 
				},
				closeClick: closeBtn,
				locked: false
			}
		},
		keys: {
			close: []
		}
	};
	
	$.fancybox(settings);
	
	
	/*
	$.magnificPopup.open({
		items: {
			src: href
		},
		type: 'iframe',
		modal: !closeBtn,
		preloader: true

		// You may add options here, they're exactly the same as for $.fn.magnificPopup call
		// Note that some settings that rely on click event (like disableOn or midClick) will not work here
	}, 0);
	*/
	return false;
};


ftHelper.closeModal = function() {
	$.fancybox.close();
	// var magnificPopup = $.magnificPopup.instance;
	// magnificPopup.close();
	return false;
};


ftHelper.ajaxPager = function(_this) {
	
	if(ftHelper.isAjaxBusy) {
		return false;
	}
	
	ftHelper.isAjaxBusy = true;
	
	var currentLoadButtonBlock = $(_this).closest('.load-more');
	var link = $(_this).data('link');
	
	$(_this).addClass('loading');
	
	$.ajax({
		url: link,
		type: 'GET',
		data: {
			ftAjaxPager: 'Y'
		},
		dataType: 'html',
		success: function (data) {
			
			
			var content = $(data).filter('#ajax-pager-list');
			var loadButton = $(data).filter('.load-more');
			
			if($('#ajax-pager-list').length && content.length) {
				$('#ajax-pager-list').append(content.html());
			}
			
			if(loadButton.length) {
				currentLoadButtonBlock.html(loadButton.html());
			} else {
				currentLoadButtonBlock.remove();
			}
			

		},
		complete: function(xhr, textStatus) {
			
			ftHelper.isAjaxBusy = false;
			if(xhr.status == 200) {
				
			}
			
		}
		
	});
	
	return false;
	
};

ftHelper.addNotify = function(text, type, duration) {
	
	
	if(type == undefined) {
		type = 'warning';
	}
	
	if(duration == undefined) {
		duration = 4000;
	}
	
	if($('#notifies-block').length) {
		
		/*
		types:
			alert-warning
			alert-danger
			alert-success
		*/
		
		var block = '<div class="alert alert-' + type + '">' +
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + text + '</div>';

		//$('#notifies-block').prepend(block);
		$('#notifies-block').append(block);
		
		//var thisBlock = $('#notifies-block .alert:first');
		var thisBlock = $('#notifies-block .alert:last');
		
		setTimeout(
			function() {
				thisBlock.fadeOut(
					500, 
					function() {
						$(this).remove();
					}
				);
			}, 
			duration
		);
	}
};

ftHelper.selectMenu = function(pjaxData) {

	if(pjaxData != undefined) {

		$('#nav li').removeClass('current');
		if (pjaxData) {
			$('#nav li').find('a[data-pjax="' + pjaxData + '"]').parents('li').addClass('current');
		}
	}
};

ftHelper.hideTab = function() {
	$('html, body').animate({scrollTop : $('#content').offset().top}, 500, 'linear');
	$('.tab').hide().css({
		'height': 'auto',
		'margin-left': (ftHelper.tabDirection == "rtl") ? -0 - $(window).width() : -0 + $(window).width(),
		'opacity': 0
	}).show();
};

ftHelper.showTab = function() {
	$('.tab').css({
		'margin-left': (ftHelper.tabDirection == "rtl") ? -0 - $(window).width() : -0 + $(window).width()
	}).stop().animate({
		'margin-left': 0,
		'opacity': 1
	}, 300, "easeInOutExpo");

};

window.onpopstate = function(event) {
	//console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
	ftHelper.showTab();
};

$(document).pjax('a[data-pjax]', '#pjax-container', {
	scrollTo: false,
	timeout: 0
});

$(document).bind('pjax:click', function(options) {
	
	if(ftHelper.isAjaxBusy) {
		return false;
	}

	if($('#nav li.current a').data('pjax') != undefined &&
		$(options.target).data('pjax').toString() === $('#nav li.current a').data('pjax').toString()) {
		// Если открываем текущую страницу еще раз
		event.preventDefault();
		return false;
	}
	
	ftHelper.isAjaxBusy = true;
	//console.log('pjax:click', ftHelper.isAjaxBusy);

	ftHelper.selectMenu($(options.target).data('pjax'));
	
	//console.log($(options.target));
	/*
	if($(options.target).closest('#mobile-nav')) {
		$('#mobile-nav').data('mmenu').close();
	}
	*/
});

$(document).bind('pjax:start', function(xhr, options) {
	//ftHelper.showPreloader();
	//Pace.start();
	//ftHelper.pinger();
	ftHelper.hideTab();
});

$(document).bind('pjax:beforeReplace', function(contents, options) {
	ftHelper.destroy();
});


$(document).bind('pjax:complete', function(xhr, textStatus, options) {
	ftHelper.showTab();
	ftHelper.init();
});

$(document).bind('pjax:end', function(xhr, options) {
	//ftHelper.hidePreloader();

	ftHelper.isAjaxBusy = false;

});

$(document).bind('pjax:error', function(xhr, textStatus, errorThrown, options) {
	console.error('pjax:error', textStatus);
});