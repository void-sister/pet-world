jQuery.noConflict();
jQuery(document).ready(function($){

	"use strict";
	if( dttheme_urls.loadingbar === "enable") {
		Pace.on("done", function(){
			$(".loader").fadeOut(500);
			$(".pace").remove();
		});
	}

	if( $('.dt-sc-icon-box-type9').length ) {
		setTimeout(function(){
			$('.dt-sc-icon-box-type9').each(function(){
				$(this).find('.icon-wrapper').css('height', $(this).find('.icon-content').outerHeight(true) );
			});
		},1000);
    }

	if( $('ul.dt-sc-tabs-vertical-frame').length ) {
		$('ul.dt-sc-tabs-vertical-frame').each(function(){
			$(this).css('min-height', $(this).height() );
		});
	}

	if( $('ul.dt-sc-tabs-vertical').length ) {
		$('ul.dt-sc-tabs-vertical').each(function(){
			$(this).css('min-height', $(this).height() );
		});
	}

	// <select>
	$("select").each(function(){
		if($(this).css('display') != 'none') {
			$(this).wrap( '<div class="selection-box"></div>' );
		}
	});

	//To Top...
	$().UItoTop({ easingType: 'easeOutQuart' });

	$('.activity-type-tabs > ul >li:first').addClass('selected');
	$('.dir-form > .item-list-tabs > ul > li:first').addClass('selected');

	/*Menu */
	function petsworldMegaMenu() {
		var screenWidth = $(document).width(),
		containerWidth = $("#header .container").width(),
		containerMinuScreen = (screenWidth - containerWidth)/2;
		if( containerWidth == screenWidth ){

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){

				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > screenWidth ){
					var SwMinuOffset = screenWidth - ParentLeftPosition;
					var marginFromLeft = MegaMenuChildContainerWidth - SwMinuOffset;
					var marginFromLeftActual = (marginFromLeft) + 25;
					var marginLeftFromScreen = "-"+marginFromLeftActual+"px";
					$(this).css('left',marginLeftFromScreen);
				}

			});
		} else {

			$("li.menu-item-megamenu-parent .megamenu-child-container").each(function(){
				var ParentLeftPosition = $(this).parent("li.menu-item-megamenu-parent").offset().left,
				MegaMenuChildContainerWidth = $(this).width();

				if( (ParentLeftPosition + MegaMenuChildContainerWidth) > containerWidth ){
					var marginFromLeft = ( ParentLeftPosition + MegaMenuChildContainerWidth ) - screenWidth;
					var marginLeftFromContainer = containerMinuScreen + marginFromLeft + 20;

					if( MegaMenuChildContainerWidth > containerWidth ){
						var MegaMinuContainer	= ( (MegaMenuChildContainerWidth - containerWidth)/2 ) + 10;
						var marginLeftFromContainerVal = marginLeftFromContainer - MegaMinuContainer;
						marginLeftFromContainerVal = "-"+marginLeftFromContainerVal+"px";
						$(this).css('left',marginLeftFromContainerVal);
					} else {
						marginLeftFromContainer = "-"+marginLeftFromContainer+"px";
						$(this).css('left',marginLeftFromContainer);
					}
				}

			});
		}
	}

	petsworldMegaMenu();

	$(window).smartresize(function(){
		petsworldMegaMenu();
	});

	//Menu Hover Animation...

	function petsworldMenuHover() {

		$("li.menu-item-depth-0,li.menu-item-simple-parent ul li" ).mouseenter(function() {
			if( $(this).find(".megamenu-child-container").length  ){
				$(this).find(".megamenu-child-container").stop().fadeIn('fast');
			} else {
				$(this).find("> ul.sub-menu").stop().fadeIn('fast');
			}
		}).mouseleave(function() {
			if( $(this).find(".megamenu-child-container").length ){
				$(this).find(".megamenu-child-container").stop(true, true).hide();
			} else {
				$(this).find('> ul.sub-menu').stop(true, true).hide();
			}
		});
	}//Menu Hover End

	$("div.dt-video-wrap").fitVids();

	var isMobile = (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i) || navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ) ? true : false;

	var currentWidth = window.innerWidth || document.documentElement.clientWidth;

	if(typeof dttheme_urls !== 'undefined') {

        if (dttheme_urls.nicescroll == "enable" &&
			$(window).width() > 767 &&
        	! navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/) && ! navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ) {
            $("html").niceScroll({
                zindex: 999999,
                cursorborder: "1px solid #424242"
            });
        }

		//Sticky Navigation
		if( isMobile && dttheme_urls.mobilestickynav == "enable" ) {
			$(dttheme_urls.stickyele).sticky({ topSpacing: 0 });
		}
		if( dttheme_urls.stickynav === "enable" && currentWidth > 767 ) {
			$(dttheme_urls.stickyele).sticky({ topSpacing: 0 });

		}
	}

	var currentWidth = window.innerWidth || document.documentElement.clientWidth;
	if( currentWidth > 767 ) {
		if( $('#primary').hasClass('with-both-sidebar') ) {
			if( ( $('#secondary-left').is(':empty') && $('#secondary-right').is(':empty')) ){
				$('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-both-sidebar");
			}else if( $('#secondary-left').is(':empty') ){
				$('#primary').addClass("with-right-sidebar").removeClass("with-both-sidebar");
			}else if( $('#secondary-right').is(':empty') ){
				$('#primary').addClass("with-left-sidebar").removeClass("with-both-sidebar");
			}
		} else if( $('#primary').hasClass('with-left-sidebar') ) {
			if( $('#secondary-left').is(':empty') ){
				$('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-left-sidebar");
			}
		} else if( $('#primary').hasClass('with-right-sidebar') ) {
			if( $('#secondary-right').is(':empty') ){
				$('#primary').addClass("content-full-width").removeClass("page-with-sidebar with-right-sidebar");
			}
		}
	}

	//Mobile Menu
	$("#dt-menu-toggle").on('click',function( event ){
		event.preventDefault();

		var $menu = $("nav#main-menu").find("ul.menu:first");
		$menu.slideToggle(function(){
			$menu.css('overflow' , 'visible');
			$menu.toggleClass('menu-toggle-open');
		});

		var $right = $("nav#main-menu").find("ul.menu-right");
		if( $right.length ) {
			$right.slideToggle(function(){
				$right.css('overflow' , 'visible');
				$right.toggleClass('menu-toggle-open');
			});
		}
	});

	$(".dt-menu-expand").on('click',function(){
		if( $(this).hasClass("dt-mean-clicked") ){
			$(this).text("+");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideUp(300);
			} else {
				$(this).prev('.megamenu-child-container').find('ul:first').slideUp(300);
			}
		} else {
			$(this).text("-");
			if( $(this).prev('ul').length ) {
				$(this).prev('ul').slideDown(300);
			} else{
				$(this).prev('.megamenu-child-container').find('ul:first').slideDown(300);
			}
		}

		$(this).toggleClass("dt-mean-clicked");
		return false;
	});

	//if( !isMobile ){
		currentWidth = window.innerWidth || document.documentElement.clientWidth;
		if( currentWidth > 767 ){
			petsworldMenuHover();
		}
	//}
	//Mobile Menu End

	$('.dt-search-icon').on('click', function(e){
		e.stopPropagation();
		$('#header .top-menu-search-container').toggleClass('show-top-menu-search');
	});

	//Blog Template
	if( $(".apply-isotope").length ) {
		$(".apply-isotope").isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutter: 20} });
	}

	//Gallery Post Slider
    if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
	  	$("ul.entry-gallery-post-slider").bxSlider({auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true});
    }

	//Portfolio single
	if( $(".dt-portfolio-single-slider").find("li").length > 1 ) {
		$(".dt-portfolio-single-slider").bxSlider({ auto:false, video:true, useCSS:false, pagerCustom: '#bx-pager', autoHover:true, adaptiveHeight:true, controls:false });
	}

	//Pet single
	if( $(".dt-pet-single-slider").find("li").length > 1 ) {
		$(".dt-pet-single-slider").bxSlider({ auto:false, video:true, useCSS:false, pagerCustom: '#bx-pager', autoHover:true, adaptiveHeight:true, controls:false });
	}

	var $pphoto = $('a[data-gal^="prettyPhoto[gallery]"]');
	if ($pphoto.length) {
		$pphoto.prettyPhoto({
			hook: 'data-gal',
			show_title: false,
			deeplinking: false,
			social_tools: false,
			default_width: 500,
			default_height: 344
       });
	}

	$('.downcount').each(function(){
		var el = $(this);
		el.downCount({
			date	: el.attr('data-date'),
			offset	: el.attr('data-offset')
		});
	});

	//Smart Resize Start
	$(window).smartresize(function(){
		//Blog Template
		if( $(".apply-isotope").length ) {
			$(".apply-isotope").isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutter: 20} });
		}

		//Portfolio Template
		if( $('.dt-sc-portfolio-container').length ) {
			var $width = $('.dt-sc-portfolio-container').hasClass("no-space") ? 0 : 20;
			$('.dt-sc-portfolio-container').css({overflow:'hidden'}).isotope({itemSelector : '.column',masonry: { gutter: $width } });
		}

		// Filteralbe Pets
		if( $('.dt-sc-pet-container').length  ){
			$('.dt-sc-pet-container').css({overflow:'hidden'}).isotope({itemSelector : '.column',masonry: { gutter: 20 } });
		}
	});

	// Window Load Start
	$(window).on('load', function(){

		var portfolioHeight = $('.dt-sc-portfolio-wrapper .portfolio:first').height();
		$('.icon-link-title').css('height', portfolioHeight+'px');

		//Blog Template
		if( $(".apply-isotope").length ) {
			$(".apply-isotope").isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutter: 20} });
		}
		//Blog Template End

		//Portfolio Template : Sorting
		var $container = $('.dt-sc-portfolio-container');
		if( $container.length) {
			var $width = $container.hasClass("no-space") ? 0 : 20;

			$container.isotope({
				filter: '*',
				masonry: { gutter: $width },
				animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});
		}//Isotope End

		if($("div.dt-sc-portfolio-sorting").length){

			$("div.dt-sc-portfolio-sorting a").on('click',function(){
				$("div.dt-sc-portfolio-sorting a").removeClass("active-sort");
				var $width = $container.hasClass("no-space") ? 0 : 20;
				var selector = $(this).attr('data-filter');
				$(this).addClass("active-sort");

				$('.dt-sc-portfolio-container').isotope({
					filter: selector,
					masonry: { gutter: $width },
					animationOptions: { duration:750, easing: 'linear',  queue: false }
				});

				return false;
			});
		}
		//Portfolio Template : Sorting End

		// Filterable Pets
		if( $('.dt-sc-pet-container').length  ){

			$('.dt-sc-pet-container').isotope({
				filter: '*',
				masonry: { gutter: 20 },
				animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});
		}

		if( $("div.dt-sc-pet-sorting").length ) {
			$("div.dt-sc-pet-sorting a").on('click', function(){

				$(this).parent("div.dt-sc-pet-sorting").find("a.active-sort").removeClass("active-sort");
				$(this).addClass("active-sort");

				var selector = $(this).attr('data-filter');
				var $holder = $(this).parents("div.dt-sc-filterable-pets-wrapper").find('.dt-sc-pet-container');

				$holder.isotope({
					filter: selector,
					masonry: { gutter:20 },
					animationOptions: { duration:750, easing: 'linear',  queue: false }
				});


				return false;
			});
		}
		// Filterable Pets
	});

	$(".dt-like-this").on('click',function(){

		var el = jQuery(this);

		if( el.hasClass('liked') ) {
			return false;
		}

		var post = {
			action: 'petsworld_like_love',
			post_id: el.attr('data-id')
		};

		$.post(dttheme_urls.ajaxurl, post, function(data){
			el.find('span').html(data);
			el.addClass('liked');
		});
		return false;
	});

	if($('body').hasClass('page-template-tpl-onepage')) {
		$('nav#main-menu ul.menu').visualNav({
			selectedClass     : 'current_page_item',
			externalLinks     : 'external',
			useHash           : false
		});
		$('nav#main-menu ul.menu-left').visualNav({
			selectedClass     : 'current_page_item',
			externalLinks     : 'external',
			useHash           : false
		});
		$('nav#main-menu ul.menu-right').visualNav({
			selectedClass     : 'current_page_item',
			externalLinks     : 'external',
			useHash           : false
		});
		$('.left-header nav#main-menu ul.menu, .left-header-boxed nav#main-menu ul.menu, .left-header-creative nav#main-menu ul.menu').visualNav({
			selectedClass     : 'current_page_item',
			externalLinks     : 'external',
			useHash           : false
		});
	} else {
		if($('nav#main-menu ul.menu li a[href^="#"]').length){
			$('nav#main-menu ul.menu li a[href^="#"]').on('click', function(e) {
				$(location).attr('href', dttheme_urls.url+'/' + $(this).attr('href'));
			});
		}
	}

	if($('body').hasClass('left-header-creative')) {
		$('#header-wrapper').simpleSidebar({
			opener: '#toggle-sidebar',
			wrapper: '#main',
			animation: {
				easing: "easeOutQuint"
			},
			sidebar: {
				align: 'left',
				width: 260
			},
			sbWrapper: {
				display: true
			}
		});

		$('#toggle-sidebar, div[data-simplesidebar="mask"]').on('click',function(){
			$('#toggle-sidebar').toggleClass('close-icon');
		});
	}
	$('input, textarea').placeholder();

	if($(".dt-sc-scroll-wrapper").length){
		var scroll_wrapper = $(".dt-sc-scroll-wrapper").niceScroll({ cursorcolor:"#ffffff", cursorwidth: "2px"});
		scroll_wrapper.rail.addClass('dt-sc-skin');
	}

	// Gutenberg - Fullwidth Section Fix
	$('.alignfull').each(function() {
		if($(this).parents('body').hasClass('has-gutenberg-blocks') && $(this).parents('#primary').hasClass('content-full-width')) {
			if($(this).parents('body').hasClass('layout-boxed')) {
				var containerWidth = $('.layout-boxed .wrapper').width();
				$(this).css('width', containerWidth);

				var mainLeft = $('#main').offset().left;
				var primaryLeft = $('#primary').offset().left;

				var sectionMargin = parseInt(primaryLeft, 10) - parseInt(mainLeft, 10);

				var offset = 0 - sectionMargin;
				$(this).css('left', offset);
			} else {

				if($('body').hasClass('single-post')) {

					var windowWidth = $(window).width();
					$(this).css('width', windowWidth);

					var $container = '';
					$container = $(this).parents('.entry-body');

					console.log($(this).parents('.content-full-width').offset().left);
					console.log($(this).parents('.entry-body').offset().left);

					var offset = 0 - $container.offset().left;
					$(this).css('left', offset);

                } else {

					var windowWidth = $(window).width();
					$(this).css('width', windowWidth);

					var $container = '';
					$container = $(this).parents('.content-full-width');

					var offset = 0 - $container.offset().left;
					$(this).css('left', offset);

				}

			}
		}
	});

	// Gutenberg - WP Category Widget Fix
	if($('.wp-block-categories-list').length) {

		$('.wp-block-categories-list').find('li').each(function() {

			var span_text = $(this).find('span:first').html();
			$(this).find('span:first').remove()
			$('<span>'+span_text+'</span>').insertAfter($(this).find('a:first'));

		});

	}

});

(function() {

	function petsworldtoggleOverlay() {
		if( classie.has( overlay, 'open' ) ) {
			classie.remove( overlay, 'open' );
			classie.add( overlay, 'close' );
			var onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					if( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				classie.remove( overlay, 'close' );
			};
			if( support.transitions ) {
				overlay.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
				onEndTransitionFn();
			}
		}
		else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );
		}
	}

	if(jQuery('div.overlay.overlay-hugeinc').length) {

		var triggerBttn = document.getElementById( 'trigger-overlay' ),
			overlay = document.querySelector( 'div.overlay' ),
			closeBttn = overlay.querySelector( 'div.overlay-close' );
			transEndEventNames = {
				'WebkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd',
				'msTransition': 'MSTransitionEnd',
				'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions };

		triggerBttn.addEventListener( 'click', petsworldtoggleOverlay );
		closeBttn.addEventListener( 'click', petsworldtoggleOverlay );
	}

})();