		

// FOR SMART DEVICE BUTTON
jQuery(document).ready(function($){
	//prepend menu icon 
	$('#sidemenu').prepend('<div id="menu-icon">Menu</div>');
	
	//toggle nav 
	$("#menu-icon").on("click", function(){
		$("#nav").slideToggle();
		$(this).toggleClass("active");
		jQuery( 'ul#nav a' ).click( function(){
		  if ( jQuery( window ).width() < 420 ) {
		   $("#nav").slideToggle();
		  }
		 } );
	});
	 
	
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: true,
		smoothHeight: true,
		directionNav: true,
		slideshowSpeed: 5000,          
		animationDuration: 5000,
		nextText:"&rsaquo;",
		prevText:"&lsaquo;",
		keyboardNav: true,
		easing: 'easeInOutBack',
		useCSS: false,
	});
});

jQuery(document).ready(function($){
	
	$('.social-icons ul li a, .tooltips').tooltip();
	
	$(".social-icons ul li a img").css({"opacity": "0.7"});
		$(".social-icons ul li a img").hover(function() {
			$(this).stop().animate({opacity: 1,}, 100 );
		},
		function() {
			$(this).stop().animate({opacity: 0.7,}, 100 );
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme:'light_square', 
		autoplay_slideshow: false, 
		overlay_gallery: false, 
		show_title: false,
	});
	
	// Tweets Widget
	if( $.fn.tweet ) {
		$('.tweet-stream').tweet({
			username: "envato", 
			template: "{text}{time}"
		});
	}

	// Flickr Feed Widget
	if( $.fn.jflickrfeed ) {
		$('.flickr-stream ul').jflickrfeed({
			qstrings: {
				id: '52617155@N08'
			}, 
			limit: 9, 
			itemTemplate: '<li><a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
		});
	}
	if( $.fn.gmap ) {
		$('.google-maps').gmap({
			zoom: 14, 
			center: '-6.14687, 106.850746'
		});
	}	
	if( $.fn.tweet ) {
		$('.tweet-stream').tweet({
			username: "envato", 
			count: 1,
			template: "{text}{time}"
		});
	}
	
	// hide #back-top first
	$("#back-top").hide();		
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});	
		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});	
	
});

// FOR SKILLS GRAPH
jQuery(document).ready(function($){
								
	function isScrolledIntoView(id)
	{
		var elem = "#" + id;
		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();
	
		if ($(elem).length > 0){
			var elemTop = $(elem).offset().top;
			var elemBottom = elemTop + $(elem).height();
		}

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
		  && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
	}

	
	
	function sliding_horizontal_graph(id, speed){
		//alert(id);
		$("#" + id + " li span").each(function(i){
			var j = i + 1; 										  
			var cur_li = $("#" + id + " li:nth-child(" + j + ") span");
			var w = cur_li.attr("title");
			cur_li.animate({width: w + "%"}, speed);
		})
	}
	
	function graph_init(id, speed){
		$(window).scroll(function(){
			if (isScrolledIntoView(id)){
				sliding_horizontal_graph(id, speed);
			}
			else{
				//$("#" + id + " li span").css("width", "0");
			}
		})
		
		if (isScrolledIntoView(id)){
			sliding_horizontal_graph(id, speed);
		}
	}
	
	graph_init("services-graph", 1000);
});


$(document).ready(function(){
	jQuery("#contact_form").validate({
		meta: "validate",
		submitHandler: function (form) {
			
			var s_name=$("#name").val();
			var s_lastname=$("#lastname").val();
			var s_email=$("#email").val();
			var s_phone=$("#phone").val();
			var s_comment=$("#comment").val();
			$.post("contact.php",{name:s_name,lastname:s_lastname,email:s_email,phone:s_phone,comment:s_comment},
			function(result){
			  $('#sucessmessage').append(result);
			});
			$('#contact_form').hide();
			return false;
		},
		/* */
		rules: {
			name: "required",
			
			lastname: "required",
			// simple rule, converted to {required:true}
			email: { // compound rule
				required: true,
				email: true
			},
			phone: {
				required: true,
			},
			comment: {
				required: true
			}
		},
		messages: {
			name: "Please enter your name.",
			lastname: "Please enter your last name.",
			email: {
				required: "Please enter email.",
				email: "Please enter valid email"
			},
			phone: "Please enter a phone.",
			comment: "Please enter a comment."
		},
	}); /*========================================*/
});

