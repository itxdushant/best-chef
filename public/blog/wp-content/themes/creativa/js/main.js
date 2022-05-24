/*!
 * Creativa scripts
 */

(function($) {
	"use strict";

	$('.main-nav ul > li, .sidebar-nav ul > li, .full-nav ul > li, .nav-icons ul .nav-bag, #top-bar .woo-settings, #lang_sel li').hover(
        function(){
            $(this).children('ul').stop().slideDown(100).children('li').stop(true, true).delay(100).animate({
		    opacity: 1,
		  }, 200, function() {
		    // Animation complete.
		  });
        },
        function(){
            $(this).children('ul').stop().slideUp(100).children('li').stop(true, true).animate({
		    opacity: 0,
		  }, 100, function() {
		    // Animation complete.
		  });
        }
    );

    $('.main-nav ul .creativa-mega-menu > ul > li > a').click(function(){
    	return false;
    })

	$(".main-nav ul > li").on('mouseenter mouseleave', function (e) {
		var $this = $(this);
        if ($('ul', this).length) {
            var elm = $('ul:first', this);
            var off = elm.offset();
            var l = off.left;
            var w = elm.width();
            var docH = $(window).height();
            var docW = $(window).width();

            var isEntirelyVisible = (l + w >= docW);

            if ($('body').hasClass('rtl')) {
            	var isEntirelyVisible = (l <= 0);
            }

            if (isEntirelyVisible) {
                $this.children('.sub-menu').addClass('sub-menu--shift');
            } else {
                // $(this).children('.sub-menu').removeClass('sub-menu--shift');
                setTimeout(function() {
			       $this.children('.sub-menu').removeClass('sub-menu--shift');
			   }, 100);
            }
        } 
    });


    function creativa_mobileLogoWidth() {
		var navbarWidth = $('body:not(.header-centered) #navbar').outerWidth(),
			logo = $('body:not(.header-centered) #navbar .theme-logo'),
			logoWidth = logo.outerWidth(),
			menuWidth = $('body:not(.header-centered) #navbar .menu-nav').outerWidth(),
			icons = $('body:not(.header-centered) #navbar .nav-icons'),
			iconsSH = $('body:not(.header-centered) #sticky-header .nav-icons'),
			iconsWidth = icons.outerWidth();


			// console.log(iconsWidth);

		if (Modernizr.mq('(max-width: 1200px)')) {
			if (logoWidth + iconsWidth + menuWidth  >= navbarWidth) {
				icons.addClass('hidden-md');
				iconsSH.addClass('hidden-md');
			}

			if ($('body').hasClass('header-splitted')) {
				icons.addClass('hidden-md');
				iconsSH.addClass('hidden-md');
			}
		}

		if (Modernizr.mq('(max-width: 992px)')) {
			if (logoWidth + iconsWidth >= navbarWidth) {
				logo.css('max-width', navbarWidth - iconsWidth);
			} else {
				logo.css('max-width', '');
			}
		}
    }

    creativa_mobileLogoWidth();
    $(window).resize(function(){
    	creativa_mobileLogoWidth();
    });


	// Fit Vid
    $('.fit-vid').fitVids();
    $('.fit-vid').each(function(){
	    var AudIframeH = $(this).children('iframe').height();
	    $(this).css('height',AudIframeH);

	    $(window).resize(function(){	
		    var AudIframeH = $('.fit-vid iframe').height();
		    $(this).css('height',AudIframeH);
		});	
    })

    $(window).resize(function(){	
	    var VidIframeH = $('.fit-vid iframe').height();
	    $('.fit-vid').css('height',VidIframeH);
	});	

    // fit audio height fix	
    $('.fit-aud').each(function(){
	    var AudIframeH = $(this).children('iframe').height();
	    $(this).css('height',AudIframeH);

	    $(window).resize(function(){	
		    var AudIframeH = $('.fit-aud iframe').height();
		    $(this).css('height',AudIframeH);
		});	
    })

    

	// Article share
	var pageHref = $('link[rel=canonical]').eq(0).attr('href'),
		pageTitle = document.title;

	function creativa_facebookShare() {
		window.open( 'https://www.facebook.com/sharer/sharer.php?u='+ pageHref, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
		return false;
	}

	function creativa_twitterShare() {
		window.open( 'http://twitter.com/intent/tweet?text='+pageHref, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
		return false;
	}

	function creativa_googleplusShare() {
		window.open( 'https://plus.google.com/share?url='+pageHref, "googleplusWindow", "height=400,width=515,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
		return false;
	}

	function creativa_linkedInShare() {
		window.open( 'https://www.linkedin.com/shareArticle?mini=true&url='+pageHref+'&title='+pageTitle, "linkedinWindow", "height=640,width=720,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
		return false;
	}

	function creativa_pinterestShare() {
		var imgShare = $(".content-wrapper img").attr('src');
		window.open( 'http://pinterest.com/pin/create/button/?url='+pageHref+'&media='+imgShare, "pinterestWindow", "height=640,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
		return false;
	}

	$('.share-facebook').click(creativa_facebookShare);
	$('.share-twitter').click(creativa_twitterShare);
	$('.share-google-plus').click(creativa_googleplusShare);
	$('.share-linkedin').click(creativa_linkedInShare);
	$('.share-pinterest').click(creativa_pinterestShare);

	$('.shares-list .get-share a, #page-shares > ul > li > a').click(function(){ return false; })

	function creativa_masonryFWFix() {
		$('.portfolio-fullwidth .portfolio-items--container').each(function(){
			var contW = $('.layout-wrapper').outerWidth(),
			contWGap = $(this).find('.type-portfolio').css('paddingLeft');

			$(this).css('width', contW - parseInt(contWGap) * 4);
		})
	}

	creativa_masonryFWFix();

	$(window).resize(function(){
		creativa_masonryFWFix();
	})

	// portfolio masonry
	function creativa_portfolioMasonry() {
		var $masonryContainer = $('.portfolio--masonry'),
			loader = '<div class=\"spinner portfolio-spinner\"></div>';

		$masonryContainer.prepend(loader);
		$('.portfolio--masonry').each(function(){
			var portContWidth = $(this).width(),
				portContWidthOut = $(this).children('.row').outerWidth(),
				gapSize = portContWidthOut - portContWidth,
				paddGap = $(this).find('[class*="col-md"]').innerWidth() - $(this).find('[class*="col-md"]').width(),

					smallH = $(this).find('.portfolio_masonry--small').width(),
				wideH = $(this).find('.portfolio_masonry--wide').width() / 2,
				bigH = $(this).find('.portfolio_masonry--big').width(),
				tallH = $(this).find('.portfolio_masonry--tall').width(),

				elH = '',
				styleBH = 0;


			if (smallH != null) {
				elH = smallH;
			}
			else if (wideH != null) {
				elH = wideH;
			} 
			else if (bigH != null) {
				elH = (bigH / 2) - (paddGap / 2);
			} 
			else {
				elH = null;
			}

				
			$(this).find('.portfolio_masonry--wide .portfolio-item .portfolio_image-container').css({"height" : elH, "padding-bottom" : 0});
			$(this).find('.portfolio_masonry--small .portfolio-item .portfolio_image-container').css({"height" : elH, "padding-bottom" : 0});
			$(this).find('.portfolio_masonry--big .portfolio-item .portfolio_image-container').css({"height" : (elH * 2) + paddGap + styleBH, "padding-bottom" : 0});
			$(this).find('.portfolio_masonry--tall .portfolio-item .portfolio_image-container').css({"height" : (elH * 2) + paddGap + styleBH, "padding-bottom" : 0});


		})

		var $portfolioCont = $('.portfolio--masonry .row').imagesLoaded(function(){
			$('.portfolio-spinner').remove();

			// responsivePortfolioHeightFix();
			$portfolioCont.removeClass('pm-hidden').addClass('pm-visible').isotope({
			  // options...
			  itemSelector: '[class*="col-"]',
    		  layoutMode: 'packery',
			  getSortData: {
			    // name: '.name', // text from querySelector
			    likes: '[data-likes]',
			    views: '[data-views]',
			  },
			  sortAscending: false,
			  // masonry: {
			  //   // columnWidth: 1
			  // }
			});
		})
	}

	creativa_portfolioMasonry();
	$(window).resize(function(){
		creativa_portfolioMasonry();
	})

	jQuery(function($){$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />'),$(document).on("click",".plus, .minus",function(){var t=$(this).closest(".quantity").find(".qty"),a=parseFloat(t.val()),n=parseFloat(t.attr("max")),s=parseFloat(t.attr("min")),e=t.attr("step");a&&""!==a&&"NaN"!==a||(a=0),(""===n||"NaN"===n)&&(n=""),(""===s||"NaN"===s)&&(s=0),("any"===e||""===e||void 0===e||"NaN"===parseFloat(e))&&(e=1),$(this).is(".plus")?t.val(n&&(n==a||a>n)?n:a+parseFloat(e)):s&&(s==a||s>a)?t.val(s):a>0&&t.val(a-parseFloat(e)),t.trigger("change")})});

	function creativa_portfolioFiltering() {
		// portoflio filtering
		$('.portfolio--filtered .row').each(function(){
			var $container = $(this),
				contW = $(this).outerWidth();

			$container.imagesLoaded(function(){
				// initialize isotope
				$container.isotope({
				  // resizesContainer: false,
				  // animationEngine: 'best-available',
				  // isResizeBound: false,
				  getSortData: {
				    // name: '.name', // text from querySelector
				    likes: '[data-likes]',
				    views: '[data-views]',
				  },
				  sortAscending: false,
				  percentPosition: true,
				  // sortBy: likes,
				});
				
				// filter items when filter link is clicked
				$container.closest('.portfolio-wrapper').parent().find('.filter--a').click(function(){
				  var selector = $(this).attr('data-filter');
				  $container.isotope({ filter: selector });
				  
				  //active classes
				  $(this).parent().parent().find('.filter--a').removeClass('active');
				  $(this).addClass('active');
				  
				  return false;
				});

				$container.closest('.portfolio-wrapper').parent().find('.sorter--a').click(function() {
					var sortValue = $(this).attr('data-sort-value');
					$container.isotope({ sortBy: sortValue });

					$(this).parent().parent().find('.sorter--a').removeClass('active');
					$(this).addClass('active');

					return false;
				});

				$container.closest('.portfolio-wrapper').parent().find('.project--sorting > a').click(function() {return false;})

				$container.closest('.portfolio-wrapper').parent().find('.project--sorting').hover(
			        function(){
			            $(this).children('ul').stop().slideDown(100).children('li').stop(true, true).delay(100).animate({
					    opacity: 1,
					  }, 200, function() {
					    // Animation complete.
					  });
			        },
			        function(){
			            $(this).children('ul').stop().slideUp(100).children('li').stop(true, true).animate({
					    opacity: 0,
					  }, 100, function() {
					    // Animation complete.
					  });
			        }
			    );

	
			})

		})
	}

	creativa_portfolioFiltering();


	function creativa_masonryGalleryFix() {
		$('.blog-masonry').each(function(){
			var galleryImgHeight = $(this).find('.format-gallery .post-media .rsContent img').height(),
				galleryTmbHeight = $(this).find('.format-gallery .post-media .rsThumb img').height(),
				galleryHeight = galleryImgHeight + galleryTmbHeight + 12;

			$(this).find('.format-gallery .post-media').css('height', galleryHeight);
		})
	}


	// blog masonry
	function creativa_blogMasonry() {

		var $masonryContainer = $('.blog-masonry'),
			loader = '<div class=\"spinner blog-spinner\"></div>';
			$masonryContainer.before(loader);
		
		var $blogCont = $('.blog-masonry').imagesLoaded(function(){

			creativa_masonryGalleryFix();

			$('.blog-spinner').remove();
			$blogCont.removeClass('bm-hidden').addClass('bm-visible').isotope({
			  // options...
			  itemSelector: '[class^="col-"]',
			  masonry: {
			    // columnWidth: '[class^="col-"]'
			  }
			});

		}) 	

		$(window).on('resize', function(){
			setTimeout(function(){
				creativa_masonryGalleryFix();
				$blogCont.isotope('layout');
			}, 1000);
		})
	}


	creativa_blogMasonry();


	// timeline
	function creativa_shortcodeTimeline() {

		var $timelineContainer = $('.loprd_timeline_wrapper.timeline-center'),
			loader = '<div class=\"spinner timeline-spinner\"></div>';
			$timelineContainer.before(loader);
		
		var $timelineCont = $('.loprd_timeline_wrapper.timeline-center').imagesLoaded(function(){

			$('.timeline-spinner').remove();
			$timelineCont.removeClass('timeline-hidden').addClass('timeline-visible').isotope({
			  // options...
			  itemSelector: '.loprd_timeline_block_wrap',
			  stamp: '.timeline-stamp',
			  masonry: {
			    columnWidth: '.loprd_timeline_block_wrap'
			  }
			});

			$('.loprd_timeline_block_wrap').each(function(){
				var posLeft = $(this).position().left;

			if (posLeft == 0 ) {
				$(this).removeClass('tl_block_right');
				$(this).addClass('tl_block_left');
			} else {
				$(this).removeClass('tl_block_left');
				$(this).addClass('tl_block_right');
			}

			})

		}) 	
	}

	creativa_shortcodeTimeline();

	$(window).resize(function(){
		creativa_shortcodeTimeline();
	})

	$(window).on("orientationchange",function(){
	  creativa_shortcodeTimeline();
	});


	// blog masonry
	function creativa_imageGrid() {

		var $masonryContainer = $('.image_grid_ul'),
			loader = '<div class=\"spinner ig-spinner\"></div>';
			$masonryContainer.before(loader);
		
		var $blogCont = $('.image_grid_ul').imagesLoaded(function(){

			$('.ig-spinner').remove();
			$blogCont.removeClass('ig-hidden').addClass('ig-visible').isotope({
			  // options...
			  itemSelector: '.isotope-item',
			  masonry: {
			    columnWidth: '.isotope-item'
			  }
			});

		}) 	

		$(window).on('load resize', function(){
			setTimeout(function(){
				$blogCont.isotope('layout');
			}, 1000);
		})
	}

	creativa_imageGrid();

	function creativa_galleryCollage() {
		$('.loprd-gallery__collage').each(function() {

			var $collageContainer = $(this),
				collageTargetHeight = $collageContainer.data('collage-target'),
				collageGap = $collageContainer.data('collage-gap');

	
		    $collageContainer.justifiedGallery({
			    rowHeight : collageTargetHeight,
			    lastRow : 'nojustify',
			    captions: false,
			    margins : collageGap,
			    // fixedHeight : true,
			    maxRowHeight : '120%',
			    border : 0,
			    selector: '> .gallery-collage__inner',
			    imagesAnimationDuration: 300,
			});


		})
	}

	creativa_galleryCollage();

	function creativa_secondary_navigation() {

		var triggerBttn = $(".secondary-nav-btn"),
			overlay = document.querySelector( '.secondary-navigation' ),
			layoutWrap = document.querySelector( '.layout-wrapper' ),
			closeBttn = $('.sec-nav-close-btn a'),
			closeOvrl = $('.sec-nav-overlay'),
			$html = document.querySelector( 'html' ),
			transEndEventNames = {
				'WebkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd',
				'msTransition': 'MSTransitionEnd',
				'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions },

			// stickyH = document.querySelector( '#sticky-header' ),
			stickyHeader = $('#sticky-header'),
			stickyHVis = false,

			st = 0,
			currentPos = 0;

			$(window).scroll(function(){
				st = $(document).scrollTop();
			})

		function creativa_toggleOverlay() {
			if( classie.has( overlay, 'open' ) ) {
				classie.remove( overlay, 'open' );
				classie.remove( layoutWrap, 'open' );
				// classie.remove( $html , 'creativa-no-scroll' );
				classie.add( overlay, 'closed' );
				classie.add( layoutWrap, 'closed' );
				// stickyHeader.css('opacity','1');
				stickyHeader.delay(200).animate({
					opacity: 1,
				}, 200);
				setTimeout(function(){ creativa_footerFixed(); }, 800);
				var onEndTransitionFn = function( ev ) {
					if( support.transitions ) {
						if( ev.propertyName !== 'visibility' ) return;
						this.removeEventListener( transEndEventName, onEndTransitionFn );
					}
					classie.remove( overlay, 'closed' );
					classie.remove( layoutWrap, 'closed' );
				};
				if( support.transitions ) {
					overlay.addEventListener( transEndEventName, onEndTransitionFn );
				}
				else {
					onEndTransitionFn();
				}
			}
			else if( !classie.has( overlay, 'closed' ) ) {
				classie.add( overlay, 'open' );
				classie.add( layoutWrap, 'open' );
				// classie.add( $html , 'creativa-no-scroll' );
				if ($('body').hasClass('footer--fixed')) {
					$('.content-wrapper').css('margin-bottom', '0');
				}
				// stickyHeader.css('opacity','0');
				stickyHeader.animate({
					opacity: 0,
				}, 300);
			}

		}

		triggerBttn.click(function(){ 
			creativa_toggleOverlay(); 
			return false; 
		})
		closeBttn.click(function(){	
			creativa_toggleOverlay(); 
			return false; 
		})
		closeOvrl.click(function(){	
			creativa_toggleOverlay(); 
			return false; 
		})
	};

	creativa_secondary_navigation();

	function creativa_side_nav_responsive() {

		var sideNav = $('.nav-side'),
			contentWrap = $( '.side-nav--content-wrapper' ), 
			overlay = $('.nav-side__overlay');

			sideNav.on('scroll mouseenter', function(){
				var scrollH = $('.nav-side__wrapper').outerHeight();
				overlay.css('min-height', scrollH);
			})

		if (Modernizr.mq('(min-width: 1366px)')) {
			sideNav.addClass('open');
			contentWrap.addClass('open');

			$('.nav-side.open').perfectScrollbar();
		}
		if (Modernizr.mq('(max-width: 1365px)')) {
			sideNav.removeClass('open');
			contentWrap.removeClass('open');
			sideNav.addClass('closed');
			contentWrap.addClass('closed');

			sideNav.hover(
				function(){
					sideNav.removeClass('closed');
					contentWrap.removeClass('closed');
					sideNav.addClass('open');
					contentWrap.addClass('open');
					$('.nav-side.open').perfectScrollbar();
				}, 
				function(){
					sideNav.removeClass('open');
					contentWrap.removeClass('open');
					sideNav.addClass('closed');
					contentWrap.addClass('closed');

				}
			)

			contentWrap.click(function(){
				if (contentWrap.hasClass('open')) {
					sideNav.removeClass('open');
					contentWrap.removeClass('open');
					sideNav.addClass('closed');
					contentWrap.addClass('closed');
				}
			})
		}
	};

	creativa_side_nav_responsive();
	$(window).resize(function(){
		creativa_side_nav_responsive();
	})

	$('.sidebar-nav-wrap, .full-nav-wrap').perfectScrollbar();

	$('body').scrollspy({ target: 'nav' });

	var $hashScrollTo = $("a[href*='#']:not(.comment-reply-link):not([rel='nofollow']):not(#recentcomments a):not(.recent_comments_excerpt):not(.vc_pagination-trigger):not(.comments-link):not(.ui-tabs-anchor):not(.pagination a):not(.hash-external)");
	$hashScrollTo.on('click', function(e) {
	   // prevent default anchor click behavior
	   // store hash
	   var hash = this.hash,
			localPathname = location.pathname,
			linkPathname = e.currentTarget.pathname;

			if (linkPathname == localPathname) {
				e.preventDefault();

			   	if ( $(hash).length && $(this).attr('class') != 'ui-tabs-anchor') {
				   $('html, body').animate({
				       scrollTop: $(hash).offset().top
				     }, 500, function(){
				       window.location.hash = hash;
				    });
			   	}
			}

	   // animate

	});

	// Royal Slider 
	// Single Project Gallery
	function creativa_imageSlider() {
		var contNav = 'thumbnails';

		$('.image-slider').each(function(){
			var attr = $(this).attr('data-nav');

			var autoplay = $(this).attr('data-autoplay'),
				autoplayEn = false,
				transition = $(this).attr('data-transition'),
				transitionTp = 'move';

				if (autoplay != 0) {
					autoplayEn = true;
				}

				if (transition == 'fade') {
					transitionTp = 'fade';
				}

			if (typeof attr !== typeof undefined && attr !== false) {
			    if (attr == 'nav_thumbs') {
			    	contNav = 'thumbnails';
			    } 
			    else if (attr == 'nav_bullets') {
			    	contNav = 'bullets';
			    } 
			    else if (attr == 'nav_none') {
			    	contNav = 'none';
			    } 
			} else {
			    contNav = 'thumbnails';
			}

			// $(this).imagesLoaded(function(){

			$(this).royalSlider({
			    autoHeight: true,
			    arrowsNav: true,
			    arrowsNavAutoHide: false,
			    controlsInside: false,
			    fadeinLoadedSlide: true,
			    controlNavigationSpacing: 0,
			    controlNavigation: contNav,
			    imageScaleMode: 'none',
			    imageAlignCenter: true,
			    loop: false,
			    loopRewind: true,
			    numImagesToPreload: 4,
			    keyboardNavEnabled: true,
			    usePreloader: false,
			    transitionType: transitionTp,
	    		addActiveClass: true,
			    slidesSpacing: 4,
		    	autoPlay: {
		    		// autoplay options go gere
		    		enabled: autoplayEn,
		    		pauseOnHover: true,
		    		stopAtAction: true,
		    		delay: +autoplay,
		    	},
			    thumbs: {
			      appendSpan: true,
			      firstMargin: true,
			      arrows: true,
			      autoCenter: false
			    }
		 	});

			// });
		})

	}

	creativa_imageSlider();

	$(window).on('load resize',function() {
     // update size of slider (if you already initialized it before)
     	$('.image-slider').royalSlider('updateSliderSize', true);
     	$('.project-slider--wide').royalSlider('updateSliderSize', true);

     	creativa_imageSlider();
	});



	function creativa_projectWideHeight() {

		var heights = $(".project-slider--wide .slider__inner--wrap").imagesLoaded().map(function ()
	    {
	        return $(this).outerHeight();
	    }).get(),

	    maxHeight = Math.max.apply(null, heights);

	    $('.project-slider--wide').css('height', maxHeight);

	}

	$('.project-slider--wide').imagesLoaded(function(){
		creativa_projectWideHeight();
	})

    $(window).resize(function() {
    	creativa_projectWideHeight();
    })

	$('.project-slider--wide').royalSlider({
	    autoHeight: false,
	    arrowsNav: true,
	    arrowsNavAutoHide: false,
	    controlsInside: false,
	    fadeinLoadedSlide: false,
	    controlNavigationSpacing: 0,
	    controlNavigation: 'bullets',
	    imageScaleMode: 'none',
	    imageAlignCenter: true,
	    loop: false,
	    loopRewind: false,
	    numImagesToPreload: 4,
	    keyboardNavEnabled: true,
	    usePreloader: false,
	    slidesSpacing: 80,
	    addActiveClass: true,
 	});



	function creativa_recentsCarousel() {
		$('.content-carousel').each(function(){

			var navi = $(this).attr('data-carousel-nav'),
				autoplay = $(this).attr('data-autoplay'),
				autoplayEn = false,
				transition = $(this).attr('data-transition'),
				transitionTp = 'move',

				itemsGap = 30,
				itemsGapAttr = $(this).data('gap');

				if (typeof itemsGapAttr !== typeof undefined && itemsGapAttr !== false) {
					itemsGap = itemsGapAttr;
				}

				if (autoplay != 0) {
					autoplayEn = true;
				}

				if (transition == 'fade') {
					transitionTp = 'fade';
				}

			$(this).royalSlider({
			    autoHeight: true,
			    arrowsNav: true,
			    arrowsNavAutoHide: false,
			    controlsInside: false,
			    fadeinLoadedSlide: true,
			    controlNavigationSpacing: 0,
			    controlNavigation: navi,
			    navigateByClick: false,
			    loop: false,
			    loopRewind: true,
			    keyboardNavEnabled: true,
			    // slidesSpacing: 30,
			    transitionType: transitionTp,
			    addActiveClass: true,
			    slidesSpacing: +itemsGap,
		    	autoPlay: {
		    		// autoplay options go gere
		    		enabled: autoplayEn,
		    		pauseOnHover: true,
		    		stopAtAction: true,
		    		delay: +autoplay,
		    	}
		 	});

		})

	}

	creativa_recentsCarousel();

	$(window).on(('load resize'), function() {
     // update size of slider (if you already initialized it before)
     	$('.content-carousel').royalSlider('updateSliderSize', true);
		
		creativa_recentsCarousel();
	});

	$('.quick-view').magnificPopup({
		//type: 'image',
		closeOnContentClick: true,
		mainClass: 'my-mfp-zoom-in',		
		midClick: true,
		closeBtnInside: false,
		image: {
			verticalFit: true
		},
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},  
		removalDelay: 500, //delay removal by X to allow out-animation
	  	callbacks: {
		    beforeOpen: function() {
		      // just a hack that adds mfp-anim class to markup 
		       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		       this.st.iframe.markup = this.st.iframe.markup.replace('mfp-iframe-scaler', 'mfp-iframe-scaler mfp-with-anim');
		       this.st.mainClass = this.st.el.attr('data-effect');
		    }
	  	},
	});

	$('.portfolio__a--gallery').each(function(){
		var galleryID = $(this).attr('data-id'),
			galleryLink = '.gallery-id-'+galleryID;

		$(galleryLink).magnificPopup({
			//type: 'image',
			// delegate: 'a',
			closeOnContentClick: true,
			mainClass: 'my-mfp-zoom-in',		
			midClick: true,
			closeBtnInside: false,
			image: {
				verticalFit: true
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},  
			removalDelay: 500, //delay removal by X to allow out-animation
		  	callbacks: {
			    beforeOpen: function() {
			      // just a hack that adds mfp-anim class to markup 
			       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
			       this.st.iframe.markup = this.st.iframe.markup.replace('mfp-iframe-scaler', 'mfp-iframe-scaler mfp-with-anim');
			       this.st.mainClass = this.st.el.attr('data-effect');
			    }
		  	},
		});
	})



	$('a.magnpopup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'my-mfp-zoom-in',		
		midClick: true,
		closeBtnInside: false,
		image: {
			verticalFit: true
		},
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},  
		removalDelay: 500, //delay removal by X to allow out-animation
	  	callbacks: {
		    beforeOpen: function() {
		      // just a hack that adds mfp-anim class to markup 
		       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		       this.st.iframe.markup = this.st.iframe.markup.replace('mfp-iframe-scaler', 'mfp-iframe-scaler mfp-with-anim');
		       this.st.mainClass = this.st.el.attr('data-effect');
		    }
	  	},
	});

	var isUriImage = function(uri) {
		//make sure we remove any nasty GET params 
		uri = uri.split('?')[0];
		//moving on, split the uri into parts that had dots before them
		var parts = uri.split('.');
		//get the last part ( should be the extension )
		var extension = parts[parts.length-1];
		//define some image types to test against
		var imageTypes = ['jpg','jpeg','tiff','png','gif','bmp'];
		//check if the extension matches anything in the list.
		if(imageTypes.indexOf(extension) !== -1) {
			return true;   
		}
	}

	var WPGalleryHasImage = $('a [class*="wp-image-"]'),
		WPGalleryHasImageURL = WPGalleryHasImage.parent('a'),
		openInLightbox = false;

	WPGalleryHasImage.on('click', function(e){
		var imageURL = $(this).parent('a').attr('href');
		
		openInLightbox = false;

		if (isUriImage(imageURL)) {
			openInLightbox = true;
		}
	});

	WPGalleryHasImageURL.magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'my-mfp-zoom-in',		
		midClick: true,
		closeBtnInside: false,
		image: {
			verticalFit: true
		},
		gallery: {
			enabled: false,
		},  
		removalDelay: 500, //delay removal by X to allow out-animation
		disableOn: function() {
			if (openInLightbox === false) {
				return false;
			}
			return true;
		},
		callbacks: {
			beforeOpen: function() {
				// just a hack that adds mfp-anim class to markup 
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.iframe.markup = this.st.iframe.markup.replace('mfp-iframe-scaler', 'mfp-iframe-scaler mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		},
	});


	// layout fix
	function creativa_stickyHeaderLayoutFix() {
		if ($('body').hasClass('layout-boxed') || $('body').hasClass('layout-bordered')) {
			var layoutWrapWidth = $('.layout-wrapper').width(),
				windowWidth = $(window).width(),
				$navbarSticky = $('#sticky-header'),

				layoutGap = (windowWidth - layoutWrapWidth) / 2;

			// console.log(layoutGap);
			$navbarSticky.css({
				width: layoutWrapWidth,
				left: layoutGap
			});
		}
	}

	// Sticky Header
	function creativa_stickyHeader() {
		if (Modernizr.mq('(min-width: 991px)')) {
			var $navbarSticky = $('#sticky-header'),
				slideSpeed = 200,

				topBar = $("#top-bar").height(),
				navBar = $("#navbar").height(),
				pageTitle = $(".page-title-container").height(),

				lastScrollTop = 0, delta = 5;

				var $header = $('#navbar'),
					headerOff = 0,
					headerTop = 0;

				if ($header.length) {
					headerOff = $header.offset();
					headerTop = headerOff.top;
				}

				var stickyNavShow = topBar + navBar + headerTop + 350;



			creativa_stickyHeaderLayoutFix();
			$(window).resize(function(){
				creativa_stickyHeaderLayoutFix();
			})
		

			// scroll
			$(window).scroll(function(){
			   var st = $(this).scrollTop();

			   if (st >= headerTop) {
				if ($navbarSticky.hasClass('sh-show-alw')) {
					if(st > stickyNavShow ) {
						$navbarSticky.removeClass('sh-hidden').addClass('sh-visible');
					} else {
						$navbarSticky.removeClass('sh-visible').addClass('sh-hidden');
					}
				} 
				else if ($navbarSticky.hasClass('sh-show-scrollup')) {
					if(st > stickyNavShow ) {
						if(Math.abs(lastScrollTop - st) <= delta)
						  return;
						if (st > lastScrollTop){
						   if ($(this).scrollTop() > stickyNavShow ) {
						   		$navbarSticky.removeClass('sh-visible').addClass('sh-hidden');
						   }
						} else {
						  // upscroll code
						  $navbarSticky.removeClass('sh-hidden').addClass('sh-visible');
						}
					} else {
						$navbarSticky.removeClass('sh-visible').addClass('sh-hidden');
					}
					lastScrollTop = st;
				}
			   } else {
			   	$navbarSticky.removeClass('sh-visible').addClass('sh-hidden');
			   }

			});
		}
	}

	creativa_stickyHeader();

	function creativa_searchBar() {
		var openBtn = $('.nav-search a'),
			closeBtn = $('.search-bar .close-btn a'),
			
			searchBarSel = '.search-bar';


		openBtn.click(function(){
			// $(this).parents('#navbar, #sticky-header').find(searchBarSel).addClass('search-bar-visible').removeClass('search-bar-hidden');
			$(this).parents('#navbar, #sticky-header').find(searchBarSel).slideDown(100);
			$(this).parents('#navbar, #sticky-header').find(searchBarSel +' input').focus();
			return false;
		})

		closeBtn.click(function(){
			$(this).parents(searchBarSel).slideUp(100);
			return false;
		})

		$('.content-wrapper').click(function(){
			$(searchBarSel).slideUp(100);
		})

		$(document).keyup(function(e) {
		  if (e.keyCode == 27) { 
		  	$(searchBarSel).slideUp(100);
		  }
		});
	}

	creativa_searchBar();

	function creativa_backToTop() {
		var $backToTopContainer = $('.back-to-top'),
			backToTopBtn = $('.back-to-top-btn, .loprd_sep_btt .loprd_sep_text'),

			windowHeight = $(window).height();

		$(window).scroll(function(){
			var st = $(this).scrollTop();

			if (st > windowHeight) {
				$backToTopContainer.removeClass('btt-hidden').addClass('btt-visible');
			} else {
				$backToTopContainer.removeClass('btt-visible').addClass('btt-hidden');
			}
		})

		backToTopBtn.click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 700);
			return false;
		});
	}

	creativa_backToTop();

	function creativa_vcRowHeightVA() {
		var $vc_va = $('.vc_row_vertical_align');

		$vc_va.each(function(){
			var vcHeight = $(this).outerHeight(),
				vcContHeight = $(this).find('.vc_container_inner').outerHeight(),
				basicHeight = $(this).attr('data-basic-height');

				if (vcContHeight > vcHeight) {
					$(this).css('height', vcContHeight + 40);
				} else {
					if ($(this).hasClass('vc_row_custom_height')) {
						$(this).css('height', basicHeight);
					}
				}
		})
	}

	creativa_vcRowHeightVA();


	function creativa_parallaxBG() {

		$('.vc_bg_has_parallax').each(function(){
			var $this = $(this),
				parallaxWrap = $(this).find('.vc_bg_parallax'),

				parallaxRowHeight = 0,
				windowHeight = 0;

			var pRowTopOffset = 0,
				pRowTop = 0,
				pRowTopStart = 0,

				parallaxHeight = 0;


			parallaxRowHeight = $this.outerHeight();
			windowHeight = $(window).height();

			parallaxHeight = windowHeight + parallaxRowHeight;

			if ($this.length) {
				pRowTopOffset = $this.offset();
				pRowTop = pRowTopOffset.top;
				pRowTopStart = pRowTop - windowHeight;
			}

			$(window).on('scroll', function(){
				parallaxRowHeight = $this.outerHeight();
				windowHeight = $(window).height();

				parallaxHeight = windowHeight + parallaxRowHeight;

				if ($this.length) {
					pRowTopOffset = $this.offset();
					pRowTop = pRowTopOffset.top;
					pRowTopStart = pRowTop - windowHeight;
				}
			});

			var MQ = 0;


			creativa_triggerParallax();
			$(window).on('resize', function(){
				creativa_triggerParallax();
			});

			//bind the scale event to window scroll if window width > $MQ (unbind it otherwise)
			function creativa_triggerParallax(){
				if($(window).width()>= MQ) {
					creativa_parallaxAnimation();

					$(window).on('scroll', function(){
					    window.requestAnimationFrame(creativa_parallaxAnimation);			
					});
				} else {
					$(window).off('scroll');
				}
			}

			//assign a scale transformation to the #cd-background element and reduce its opacity
			function creativa_parallaxAnimation () {
				var scrollPos = ($(window).scrollTop() >= pRowTopStart) ? $(window).scrollTop() - pRowTopStart : 0,
					scrollPercentage = ((scrollPos / parallaxHeight) * 100).toFixed(3);



				if ($(window).scrollTop() >= pRowTopStart && $(window).scrollTop() <= parallaxRowHeight + pRowTop) {
					var scrollValueBg = -30 + 30 * scrollPercentage * 0.01 + '%';

					parallaxWrap.css({
						'transform': 'translateY(' + scrollValueBg + ')'
					});
				}
			}
		})
	}

	creativa_parallaxBG();

	function creativa_pageTitleAnimation() {

			var introSection = $('.page-title--animation'),
				introSectionHeight = introSection.height(),
				//change scaleSpeed if you want to change the speed of the scale effect
				scaleSpeed = 0.3,
				//change opacitySpeed if you want to change the speed of opacity reduction effect
				opacitySpeed = 1.15; 

			if (introSection.length) {
				var introOffset = introSection.offset(),
					introTop = introOffset.top;
			}

			var bgSelector = introSection.find('.page-title-bg, .animated-canvas');
			
			//update this vale if you change this breakpoint in the style.css file (or _layout.scss if you use SASS)
			var MQ = 600;

			creativa_triggerAnimation();
			$(window).on('resize', function(){
				creativa_triggerAnimation();
			});

			//bind the scale event to window scroll if window width > $MQ (unbind it otherwise)
			function creativa_triggerAnimation(){
				if($(window).width()>= MQ) {
					$(window).on('load scroll resize', function(){
					    window.requestAnimationFrame(creativa_animateIntro);			
					});
				} else {
					$(window).off('scroll');
				}
			}

			//assign a scale transformation to the #cd-background element and reduce its opacity
			function creativa_animateIntro () {
				var scrollPos = ($(window).scrollTop() >= introTop) ? $(window).scrollTop() - introTop : 0,
					scrollPercentage = (scrollPos/introSectionHeight).toFixed(5),
					scaleValue = 1 - scrollPercentage*scaleSpeed;

					// console.log(introTop);

				if( $(window).scrollTop() < introSectionHeight + introTop) {
					// console.log('alarm');
					// bg animations
					if (introSection.hasClass('page-title__animation--parallax')) {
						//check if the page-title is still visible
						var scrollValueBg = 30 * scrollPercentage + '%';

						bgSelector.css({
							'transform': 'translate(0, ' + scrollValueBg + ')',
						});
					}
					else if (introSection.hasClass('page-title__animation--scaledown')) {
						//check if the page-title is still visible
						var scaleValue = 1 - scrollPercentage*.15;

						bgSelector.css({
							'transform': 'scale(' + scaleValue + ')',
							'opacity': 1 - scrollPercentage*opacitySpeed
						});
					}
					else if (introSection.hasClass('page-title__animation--scaleup')) {
						//check if the page-title is still visible
						var scaleValue = 1 + scrollPercentage*.15;

						bgSelector.css({
							'transform': 'scale(' + scaleValue + ')',
						});
					}
					else if (introSection.hasClass('page-title__animation--fold')) {
						//check if the page-title is still visible
						var scaleValue = scrollPercentage*90 + 'deg';

						bgSelector.css({
							'transform': 'rotateX(' + scaleValue + ')',
						});
					}
					else if (introSection.hasClass('page-title__animation--fade')) {
						//check if the page-title is still visible

						bgSelector.css({
							'opacity': 1 - scrollPercentage*opacitySpeed,
						});
					}


					// content animations
					if (introSection.hasClass('page-title__animation--content-slidedown')) {
						var scrollValueC = 30 * scrollPercentage + '%';

						$('.page-title--animation .page-title-content').css({
							'transform': 'translateY(' + scrollValueC + ')',
							'opacity': 1 - (scrollPercentage * 1)*opacitySpeed
						});
					}
					else if (introSection.hasClass('page-title__animation--content-stretch')) {
						var scrollValueC = 5 * scrollPercentage + 'px';

						$('.page-title--animation .page-title-content, .page-title--animation .page-title-content h1, .page-title-content h2, .page-title-content h3, .page-title-content h4, .page-title-content h5, .page-title-content h6, .page-title-content p, .page-title-container .breadcrumb').css({
							'letter-spacing': scrollValueC,
							'opacity': 1 - (scrollPercentage * 1.5)*opacitySpeed
						});
					}
					else if (introSection.hasClass('page-title__animation--content-fadedown')) {
						$('.page-title--animation .page-title-content').css({
							'opacity': 1 - (scrollPercentage * 3),
						});
					}
				}
			}
		// }
	}

	creativa_pageTitleAnimation();

	$(window).on('resize', function(){
		creativa_pageTitleAnimation();
	})


	function creativa_loprd_counter() {
		$('.loprd-shortcode-counter').waypoint(function() {
			$('.loprd-counter').each(function(){
				var thousandSepData = $(this).data('separator'),
					thousandSep = ' ';

				if (thousandSepData == 'comma') {
					thousandSep = ',';
				}
				else if (thousandSepData == 'dot') {
					thousandSep = '.';
				}
				else if (thousandSepData == 'none') {
					thousandSep = '';
				}

		    	$(this).countTo({
	                formatter: function (value, options) {
	                    return options.prefix + value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, thousandSep) + options.suffix;
	                }
		    	});
			})
		}, { triggerOnce: true, offset: '90%' })
	};

	creativa_loprd_counter();


	function creativa_loprd_countdown() {
		$('.loprd-countdown').each(function() {
		   var $this = $(this), 
		   finalDate = $(this).data('countdown'),
		   formatter = $(this).data('formatter');
		   $this.countdown(finalDate, function(event) {
		     	$this.html(event.strftime(formatter));
		   });
		});
	}

	creativa_loprd_countdown();

	function creativa_rowEqualHeight(container, column) {
		$(container).each(function(){
			var vcCol = $(this).find(column);

			var maxHeight = -1,
				i = 0;

			vcCol.each(function() {
				vcCol.css('min-height', '');
			    var height = $(this)[0].getBoundingClientRect().height;
			    i++;
			    maxHeight = height > maxHeight ? height : maxHeight;
			});

			if (Modernizr.mq('(min-width: 991px)') && i > 1) {
				if ($(column).closest('.vc_column-table').length) {
					vcCol.css('height', maxHeight);
				} else {
					vcCol.css('min-height', maxHeight);
				}
			} else {
				vcCol.css('min-height', '');
			}
		})
	}

	creativa_rowEqualHeight('.vc_row_common-height', '.vc_column-inner');
	creativa_rowEqualHeight('.vc_inner_common-height', '.vc_inner_column-inner');
	$('.vc_row_common-height, .vc_inner_common-height').on("mresize load", function(){
		creativa_rowEqualHeight('.vc_row_common-height', '.vc_column-inner');
		creativa_rowEqualHeight('.vc_inner_common-height', '.vc_inner_column-inner');
	})

	// VC Shortcodes
	function creativa_vcPieChart() {
		$('.loprd-pie-chart').each(function(){
			$(this).waypoint(function() {
				var $this = $(this),
					pieValAttr = $this.attr('data-value'),
					pieVal = pieValAttr * 0.01,
					pieDur = $this.attr('data-duration'),
					pieBg = $this.attr('data-colorbg'),
					pieSize = $this.attr('data-size'),
					pieThick = $this.attr('data-thickness'),
					pieFill = $this.attr('data-fill'),
					pieCol1 = $this.attr('data-color1'),
					pieCol2 = $this.attr('data-color2'),
					showUnit = $this.attr('data-unit'),
					pieFillColor = '',
					appUnit = '';

					if (pieFill == 'gradient') {
						pieFillColor = { gradient: [""+pieCol2+"", ""+pieCol1+""] };
					}
					else if (pieFill == 'color') {
						pieFillColor = { color: ""+pieCol1+"" };
					}

					if (showUnit == 'true') {
						appUnit = '<i>%</i>';
					}

				$(this).circleProgress({
				    value: pieVal,
				    size: +pieSize,
				    thickness: +pieThick,
				    animation: { 
				    	duration: +pieDur, 
				    	ease: "circleProgressEase" 
				    }, 
				    startAngle: 11,
				    emptyFill: pieBg,
				    fill: pieFillColor,
				}).on('circle-animation-progress', function(event, progress) {
				    $(this).find('.heading').html(parseInt(pieValAttr * progress) + appUnit);
				});
			}, { triggerOnce: true, offset: '90%' })
		})
	}

	creativa_vcPieChart();

	function creativa_progressBar() {
		jQuery('.vc_progress_bar').waypoint(function () {
	        jQuery(this).find('.vc_single_bar').each(function (index) {
	          var $this = jQuery(this),
	            bar = $this.find('.vc_bar'),
	            val = bar.data('percentage-value');

	          setTimeout(function () {
	            bar.css({"width":val + '%'});
	          }, index * 200);
	        });
	    }, { triggerOnce: true, offset:'90%' });
	}

	creativa_progressBar();

	function vc_waypoints() {
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
			jQuery(this).addClass('wpb_start_animation');
			}, { triggerOnce: true, offset:'90%' });
		}
	}

	vc_waypoints();

	if ($('body').hasClass('error404')) {
		!function(e,t){"use strict";function o(r,a){this!==e&&this!==t&&(a=r,r=this),a=a||{};for(var i=0;i<r.length;++i)n(r[i],a);return d||(a.followMouse!==!1&&a.angle===t&&(document.body.addEventListener("mousemove",o.frame),d=!0),e.addEventListener("resize",o.update)),o.frame(),r}function n(e,o){var n=f(e);e={node:e,x:n.x,y:n.y,c:e.getAttribute("data-shadow-color")||o.color,inset:o.inset?"inset":"",inverse:o.inverse?-1:1},o.angle!==t?e.angle=o.angle:(o.pageX!==t&&(e.pageX=o.pageX),o.pageY!==t&&(e.pageY=o.pageY)),e.type=o.type,"drop"===o.type?(p===t&&(p=s("webkit")),e.length=o.length||4,e.opacity=o.opacity||.2):(e.length=o.length||7,e.opacity=o.opacity||.05),"flat"===o.style&&(e.style=o.style,e.length=o.length||40,e.opacity=o.opacity||1),y.push(e)}function r(e,t,o){for(var n,r=new Array(e.length-1),a=Math.cos(t),i=Math.sin(t),l=1;l<e.length;++l)n=("flat"===e.style?l:Math.pow(l,o))*e.inverse,r[l-1]=(n*i|0)+"px "+(n*a|0)+"px "+("flat"===e.style?0:0|Math.pow(l,1.7))+"px rgba("+(e.c||"0,0,0")+","+e.opacity+")"+e.inset;"drop"===e.type?e.node.style.webkitFilter="drop-shadow("+r.join(") drop-shadow(")+")":e.node.style["text"===e.type?"textShadow":"boxShadow"]=r.join(",")}function a(e,t,o,n){if(!e.filter){var r="real-shadow-"+Math.random().toString(36).substr(2),a=(new DOMParser).parseFromString(i(r),"application/xml");e.filter={offset:a.getElementsByTagName("feOffset")[0],blur:a.getElementsByTagName("feGaussianBlur")[0],color:a.getElementsByTagName("feFlood")[0]},document.body.appendChild(a.children[0]),e.node.style.filter="url(#"+r+")"}e.filter.offset.setAttribute("dx",l(t)),e.filter.offset.setAttribute("dy",l(o)),e.filter.blur.setAttribute("stdDeviation",2*n),e.filter.color.setAttribute("flood-color","rgba(0,0,0,"+(.6-n/8)+")")}function i(e){return'<svg height="0" xmlns="http://www.w3.org/2000/svg"><filter id="'+e+'"><feGaussianBlur in="SourceAlpha"/><feOffset result="b"/><feFlood/><feComposite in2="b" operator="in"/><feMerge><feMergeNode/><feMergeNode in="SourceGraphic"/></feMerge></filter></svg>'}function l(e){var t=0===e?0:0>e?1:-1;return t*Math.pow(Math.abs(e),1/3)}function s(e){e=e?"-"+e+"-":"";var t=document.createElement("div");return t.style.cssText=e+"filter:drop-shadow(0 0 0 #000)",t.style.length>0}function f(e){var t=e.clientWidth>>1,o=e.clientHeight>>1;do t+=e.offsetLeft,o+=e.offsetTop;while(e=e.offsetParent);return{x:t,y:o}}var d,p,u=2.3,g=.8,h=1/1500,c=Math.PI,y=[];o.reset=function(){y=[],document.body.removeEventListener("mousemove",o.frame),e.removeEventListener("resize",o.update),d=!1},o.update=function(){for(var e,t=y.length;t--;){e=y[t];var n=f(e.node);e.x=n.x,e.y=n.y}o.frame()},o.frame=function(o){o||(o={pageX:e.innerWidth>>1,pageY:0});for(var n,i=y.length;i--;){n=y[i];var l=(n.pageX===t?o.pageX:n.pageX)-n.x,s=(n.pageY===t?o.pageY:n.pageY)-n.y,f=Math.pow(l*l+s*s,g)*h+1;f>u&&(f=u),"drop"!==n.type||p?r(n,n.angle===t?Math.atan2(l,s)-c:n.angle,f):a(n,l,s,f)}};var m=!1;"function"==typeof e.jQuery&&($.fn.realshadow=o,m=!0),"function"==typeof define&&define.amd&&(define(function(){return o}),m=!0),"undefined"!=typeof module&&module.exports&&(module.exports=o,m=!0),m||(e.realshadow=o)}(window);
		$(".fof-number").realshadow({type: 'text', opacity: .04, length: 5});
	}

	function creativa_footerFixed() {
		if ($('body').hasClass('footer--fixed')) {
			var $footer = $('#footer-wrapper'),
				$content = $('.content-wrapper'),
				footerHeight = $footer.height();

			$content.css('margin-bottom', footerHeight);
		}
	}

	creativa_footerFixed();

	$(window).resize(function(){
		creativa_footerFixed();
	})


	$('.vc_ytvm_video').each(function(){
		var videoUrl = $(this).data('video-url');

		$(this).okvideo({ 
			video: videoUrl, 
			hd: true,
			annotations: false,
			volume: 0,
			loop: true,
			captions: false,
			adproof: true,
		})
	})

	//full width layouts - sidebar height
	function creativa_fullWidthSidebarHeight() {
		var sidebarWrap = $('.blog-width-full .sidebar-wrap, .shop__width-full .sidebar-wrap');

		if (sidebarWrap.length) {
			var contentHeight = $('.blog-width-full .sidebar-content, .shop__width-full .sidebar-content').outerHeight();
			
			sidebarWrap.css('min-height', contentHeight);
		}
	}

	$(window).on('load scroll', function(){
		creativa_fullWidthSidebarHeight();
	})


	// // Visual Composer FrontEnd
	$(window).load(function() {
		creativa_blogMasonry();
	})


	function creativa_creativaShortcodeAnimation() {
		if ( 'undefined' !== typeof(jQuery.fn.waypoint ) ) {
			var $animationContainer = $( '.creativa_shortcode_animation:not(.creativa_animation_start)' );

			$animationContainer.each(function(){
				var animation = $(this),
					animDelay = 0,
					animDelayValue = animation.data('animation-delay');

					if (typeof animDelayValue !== typeof undefined && animDelayValue !== false) {
						animDelay = animDelayValue;
					}

				animation.waypoint(function(){
					setTimeout(function(){
						animation.addClass( 'creativa_animation_start' );
					}, animDelay);
				}, {triggerOnce: true, offset: '85%'})
			})
		}
	}

	creativa_creativaShortcodeAnimation();


})(jQuery);
