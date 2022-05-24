/**
	* @package Alchemists HTML
	*
	* Template Scripts
	* Created by Dan Fisher
*/

;(function($){
	"use strict";
        
	$.fn.exists = function () {
		return this.length > 0;
	};

	/* ----------------------------------------------------------- */
	/*  Predefined Variables
	/* ----------------------------------------------------------- */
	var $template_var = $('body').attr('class'),
			$color_primary = '#ffdc11',
			$main_nav     = $('.main-nav');


	if ( $template_var == 'template-soccer' ) {
		$color_primary = '#1892ed';
	} else if ( $template_var == 'template-football' ) {
		$color_primary = '#f92552';
	}

	var Core = {

		initialize: function() {

			this.SvgPolyfill();

			this.headerNav();

		},

		SvgPolyfill: function() {
			svg4everybody();
		},

		headerNav: function() {

			if ( $main_nav.exists() ) {

				var $top_nav     = $('.nav-account'),
						$top_nav_li  = $('.nav-account > li'),
						$social      = $('.social-links--main-nav'),
						$info_nav_li = $('.info-block--header > li'),
						$wrapper     = $('.header-standard'),
						$nav_list    = $('.main-nav__list'),
						$nav_list_li = $('.main-nav__list > li'),
						$toggle_btn  = $('#header-mobile__toggle'),
						$pushy_btn   = $('.pushy-panel__toggle');

			
				// Clone Shopping Cart to Mobile Menu
				var $shop_cart = $('.info-block__item--shopping-cart > .info-block__link-wrapper').clone();
				$shop_cart.appendTo($nav_list).wrap('<li class="main-nav__item--shopping-cart"></li>');

				// Add arrow and class if Top Bar menu ite has submenu
				$top_nav_li.has('ul').addClass('has-children').prepend('<span class="main-nav__toggle"></span>');

				// Clone Top Bar menu to Main Menu
				if ( $top_nav.exists() ) {
					var children = $top_nav.children().clone();
					$nav_list.append(children);
				}

				
				// Clone Header Info to Mobile Menu
				var header_info1 = $('.info-block__item--contact-primary').clone();
				var header_info2 = $('.info-block__item--contact-secondary').clone();
				$nav_list.append(header_info1).append(header_info2);

				// Clone Social Links to Main Menu
				if ( $social.exists() ) {
					var social_li = $social.children().clone();
					var social_li_new = social_li.contents().unwrap();
					social_li_new.appendTo($nav_list).wrapAll('<li class="main-nav__item--social-links"></li>');
				}

				// Add arrow and class if Info Header Nav has submenu
				$info_nav_li.has('ul').addClass('has-children');

				// Mobile Menu Toggle
				$toggle_btn.on('click', function(){
					$wrapper.toggleClass('site-wrapper--has-overlay');
				});

				$('.site-overlay, .main-nav__back').on('click', function(){
					$wrapper.toggleClass('site-wrapper--has-overlay');
				});

				// Pushy Panel Toggle
				$pushy_btn.on('click', function(e){
					e.preventDefault();
					$wrapper.toggleClass('site-wrapper--has-overlay-pushy');
				});

				$('.site-overlay, .pushy-panel__back-btn').on('click', function(e){
					e.preventDefault();
					$wrapper.removeClass('site-wrapper--has-overlay-pushy site-wrapper--has-overlay');
				});

				// Add toggle button and class if menu has submenu
				$nav_list_li.has('.main-nav__sub').addClass('has-children').prepend('<span class="main-nav__toggle"></span>');
				$nav_list_li.has('.main-nav__megamenu').addClass('has-children').prepend('<span class="main-nav__toggle"></span>');

				$('.main-nav__toggle').on('click', function(){
					$(this).toggleClass('main-nav__toggle--rotate')
					.parent().siblings().children().removeClass('main-nav__toggle--rotate');

					$(".main-nav__sub, .main-nav__megamenu").not($(this).siblings('.main-nav__sub, .main-nav__megamenu')).slideUp('normal');
					$(this).siblings('.main-nav__sub').slideToggle('normal');
					$(this).siblings('.main-nav__megamenu').slideToggle('normal');
				});

				// Add toggle button and class if submenu has sub-submenu
				$('.main-nav__list > li > ul > li').has('.main-nav__sub-2').addClass('has-children').prepend('<span class="main-nav__toggle-2"></span>');
				$('.main-nav__list > li > ul > li > ul > li').has('.main-nav__sub-3').addClass('has-children').prepend('<span class="main-nav__toggle-2"></span>');

				$('.main-nav__toggle-2').on('click', function(){
					$(this).toggleClass('main-nav__toggle--rotate');
					$(this).siblings('.main-nav__sub-2').slideToggle('normal');
					$(this).siblings('.main-nav__sub-3').slideToggle('normal');
				});

				// Mobile Search
				$('#header-mobile__search-icon').on('click', function(){
					$(this).toggleClass('header-mobile__search-icon--close');
					$('.header-mobile').toggleClass('header-mobile--expanded');
				});
			}
		},

	};

	$(document).on('ready', function() {
		Core.initialize();
	});

})(jQuery);