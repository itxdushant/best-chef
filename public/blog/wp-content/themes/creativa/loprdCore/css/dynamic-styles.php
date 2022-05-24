<?php 

function creativa_minify( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
	return trim( $css );
}

function creativa_checkHex( $hex ) {
    // Strip # sign is present
    $color = str_replace("#", "", $hex);
    // Make sure it's 6 digits
    if( strlen($color) == 3 ) {
        $color = $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
    } else if( strlen($color) != 6 ) {
        // throw new Exception("You leave some color field with empty value!");
    }
    return $color;
}


function creativa_hexConvert( $color, $alpha ) {

    // Sanity check
    $color = creativa_checkHex($color);

    // Convert HEX to DEC
    $R = hexdec($color[0].$color[1]);
    $G = hexdec($color[2].$color[3]);
    $B = hexdec($color[4].$color[5]);

    // $HSLA = array();
    $RGBA = array();

    $var_R = ($R / 255);
    $var_G = ($G / 255);
    $var_B = ($B / 255);

    $var_Min = min($var_R, $var_G, $var_B);
    $var_Max = max($var_R, $var_G, $var_B);
    $del_Max = $var_Max - $var_Min;

    $L = ($var_Max + $var_Min)/2;

    if ($del_Max == 0)
    {
        $H = 0;
        $S = 0;
    }
    else
    {
        if ( $L < 0.5 ) $S = $del_Max / ( $var_Max + $var_Min );
        else            $S = $del_Max / ( 2 - $var_Max - $var_Min );

        $del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
        $del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
        $del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

        if      ($var_R == $var_Max) $H = $del_B - $del_G;
        else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B;
        else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R;

        if ($H<0) $H++;
        if ($H>1) $H--;
    }

   	$A = $alpha;

    $RGBA['R'] = $R;
    $RGBA['G'] = $G;
    $RGBA['B'] = $B;
    $RGBA['A'] = $A;

    $output = 'rgba('.implode(', ', $RGBA).')';
    	
    return $output;  
}

// Styles
function creativa_custom_style_inline() {
	global $creativa_options, $post;
	$c_css = '';


	// Navbar settings
	$navbar_style = $creativa_options['opt-navbar-style'];
	$nav_hover_style = $creativa_options['opt-hover-style'];

	if ($navbar_style == 1 || $navbar_style == 3) { // standard or splitted navbar
		$navbar_height = $creativa_options['opt-navbar-height'];

		if ($navbar_height != 100) {
			$c_css .= '
				.header-standard #navbar, .header-splitted #navbar, .header-splitted #navbar .col-md-12 .nav-container { height: '. $navbar_height .'px; }
				.header-standard #navbar .theme-logo a img, .header-splitted #navbar .theme-logo a img { max-height: '. ( $navbar_height - 20) .'px; }
				.header-transparent.header-splitted #page-shares, .header-transparent.header-standard #page-shares { top: '. $navbar_height .'px; }
			';

			if ($nav_hover_style == 2) {
				$c_css .= '
					.header-standard #navbar .hover-boxed, 
					.header-splitted #navbar .hover-boxed {
						padding-top: '. (($navbar_height - 60) / 2) .'px;
						padding-bottom: '. (($navbar_height - 60) / 2) .'px;
					}
				';
			}
		}
	}
	
	if ($navbar_style == 2) { // centered navbar
		$header_height = $creativa_options['opt-header-height'];

		if ($header_height != 150) {
			$c_css .= '
				.header-centered #navbar { height: '. $header_height .'px; }
				.header-centered #navbar .theme-logo a img { max-height: '. ($header_height - 80) .'px; }
				.header-transparent.header-centered #page-shares { top: '. $header_height .'px; }
			';
		}
	}
	
	if ($navbar_style == 4) { // bar navbar
		$navbar_height = $creativa_options['opt-header-bar-height'];
		$navbar_gap = $creativa_options['opt-header-bar-gap'];

		if ($navbar_height != 100 || $navbar_gap != 30) {
			$c_css .= '
				.header-bar #navbar { 
					height: '. $navbar_height .'px; 
					top: '. $navbar_gap .'px;
				}
				.header-bar #navbar .theme-logo a img { 
					max-height: '. $navbar_height .'px; 
				}
				.header-bar #page-shares { top: '. ($navbar_height + $navbar_gap + 30) .'px; }
			';
		}

		if ($navbar_height != 100 && $nav_hover_style == 2) {
			$c_css .= '
				.header-bar #navbar .hover-boxed {
					padding-top: '. (($navbar_height - 60) / 2) .'px;
					padding-bottom: '. (($navbar_height - 60) / 2) .'px;
				}
			';
		}
	}

	$sticky_header = $creativa_options['opt-show-sticky-header'];
	if ($sticky_header == 1) {
		$sticky_header_height = $creativa_options['opt-sticky-header-height'];

		if ($sticky_header_height != 80) {
			$c_css .= '
				.navbar-sticky, .header-splitted #sticky-header .col-md-12 .nav-container {
					height: '. $sticky_header_height .'px;
				}

				.navbar-sticky .logo-sticky a img { max-height: '. ($sticky_header_height - 20) .'px; }
			';

			if ($nav_hover_style == 2) {
				$c_css .= '
					#sticky-header .hover-boxed {
						padding-top: '. (($sticky_header_height - 60) / 2) .'px;
						padding-bottom: '. (($sticky_header_height - 60) / 2) .'px;
					}
				';
			}
		}
	}

	$header_transparency = $creativa_options['opt-navigation-transparency'];

	// title bar
	// -- title bar height
	if ((is_page() && $creativa_options['opt-title-bar'] == 1) || is_archive() || is_404() || is_search() || (!is_front_page() && is_home() && $creativa_options['opt-title-bar'] == 1) || (is_singular('portfolio') && $creativa_options['opt-project-layout'] != 4) || (is_singular('post') && $creativa_options['opt-blog-page-style'] != 3) || is_singular('product')) {
	
		$title_bar_padding = $creativa_options['opt-title-bar-padding'];

		if ($title_bar_padding['padding-top'] != '100px' || $title_bar_padding['padding-bottom'] != '100px') {
			$c_css .= '
				.page-title {
					margin-top: '. $title_bar_padding['padding-top'] .';
					margin-bottom: '. $title_bar_padding['padding-bottom'] .';
				}
			';
		}

		if ($header_transparency != 100) {
			if (($navbar_style == 1 || $navbar_style == 3) && $creativa_options['opt-navbar-height'] != 100) {
				$c_css .= '
					.header-standard.header-transparent .page-title-content, 
					.header-splitted.header-transparent .page-title-content {
						padding-top: '. $creativa_options['opt-navbar-height'] .'px;
					}
				';
			}
			elseif ($navbar_style == 2 && $creativa_options['opt-header-height'] != 150) {
				$c_css .= '
					.header-centered.header-transparent .page-title-content {
						padding-top: '. $creativa_options['opt-header-height'] .'px;
					}
				';
			}
		}

		$header_bar_height = $creativa_options['opt-header-bar-height'];
		$header_bar_gap = $creativa_options['opt-header-bar-gap'];

		if ($navbar_style == 4 && ($header_bar_height != 100 || $header_bar_gap != 30) ) {

			$c_css .= '
				.header-bar.header-transparent .page-title-content {
					padding-top: '. ($header_bar_height + $header_bar_gap) .'px;
				}
			';
		}

		if ($creativa_options['opt-title-bar-custom-height'] == 1) {
			$title_bar_height = $creativa_options['opt-title-bar-height'];
			$title_bar_align = $creativa_options['opt-page-title-bar-align'];
			// print_r($title_bar_height);

			if ($title_bar_height['units'] == 'px') {
				$c_css .= '
					.page-title-container .page-title {
						height: '. ($title_bar_height['height'] - ($title_bar_padding['padding-top'] + $title_bar_padding['padding-bottom'])).'px;
					}
				';
			}


			if ($title_bar_height['units'] == '%') {
				$plain_height = filter_var($title_bar_height['height'], FILTER_SANITIZE_NUMBER_INT);
				$height_calc = $navbar_height + $title_bar_padding['padding-top'] + $title_bar_padding['padding-bottom'];
				$c_css .= '
					.page-title-container .page-title {
						height: calc('. $plain_height .'vh - '. $height_calc .'px);
					}
				';
			}

			if ($title_bar_align == 1) {
				$c_css .= '
					.page-title .title-wrap {
						vertical-align: top;
					}
				';
			}
			elseif ($title_bar_align == 2) {
				$c_css .= '
					.page-title .title-wrap {
						vertical-align: middle;
					}
				';
			}
			elseif ($title_bar_align == 3) {
				$c_css .= '
					.page-title .title-wrap {
						vertical-align: bottom;
					}
				';
			}

			
		}
	} 

	if ($header_transparency != 100) {
		$header_bg = $creativa_options['opt-navigation-color-bg'];
		$header_alpha = $header_transparency / 100;

		$c_css .= '
			.header-standard.header-transparent #navbar, 
			.header-splitted.header-transparent #navbar,
			.header-centered.header-transparent #navbar,
			.header-bar.header-transparent #navbar .header-bar-container {
				background: '. creativa_hexConvert($header_bg, $header_alpha) .';
			}

		';
	}


	if ($creativa_options['opt-content-width'] != 1300) {
		$c_css .= '
			@media (min-width: '. ($creativa_options['opt-content-width'] + 30) .'px) {
				.container,
				.vc_creativa_row_fullwidth {
					width: '. $creativa_options['opt-content-width'] .'px;
				}
			}

			.header-full-width .main-nav ul .creativa-mega-menu > ul {
			    padding: 10px calc((100% - '. $creativa_options['opt-content-width'] .'px) / 2) 13px;
			}

			#lang_sel_footer {
				padding: 0px calc((100% - ('. $creativa_options['opt-content-width'] .'px - 10px)) / 2) 10px;
			}

			@media (min-width: '. $creativa_options['opt-content-width'] .'px) { .vc_row_fullwidthcontent .loprd-portfolio-shortcode .project-filtering-wrap { 
				width: '. $creativa_options['opt-content-width'] .'px; } 
			}
		';
	}


	// Content padding
	$content_padding = $creativa_options['opt-content-padding'];

	if($content_padding['padding-top'] != '100px' || $content_padding['padding-bottom'] != '100px') {
		$c_css .= '
			.section,
			.blog-width-full .sidebar-wrap,
			.blog-width-full .blog-large .post-wrap,
			.shop__width-full .sidebar-content, .shop__width-full .no-sidebar,
			.shop__width-full .sidebar-wrap {
				padding-top: '. $content_padding['padding-top'] .';
				padding-bottom: '. $content_padding['padding-bottom'] .';
			}
		';
	}


	// portfolio items gap
	$portfolio_items_gap = $creativa_options['opt-portfolio-items-gap'];

	if (is_page_template('portfolio.php')) {
		if ($portfolio_items_gap != 30) {
			$c_css .= '
				.portfolio-items--container .row {
					margin-right: '. - $portfolio_items_gap / 2 .'px;
					margin-left: '. - $portfolio_items_gap / 2 .'px;
				}

				.portfolio-items--container .row [class*="col-"] {
					padding-left: '. $portfolio_items_gap / 2 .'px;
					padding-right: '. $portfolio_items_gap / 2 .'px;
					margin-bottom: '. $portfolio_items_gap / 2 .'px;
					margin-top: '. $portfolio_items_gap / 2 .'px;
				}
			';

			if ( $creativa_options['opt-portfolio-filtering'] == true) {
				$c_css .= '
					.project-filtering-wrap.project-filtering--standard + .portfolio,
					.project-filtering-wrap.project-filtering--fullwidth + .portfolio-fullwidth {
						margin-top: -'. $portfolio_items_gap / 2 .'px;
					}
				';
			}

			if ($creativa_options['opt-portfolio-fullwidth'] == true) {
				$c_css .= '
					.portfolio-fullwidth {
						padding: '. $portfolio_items_gap / 2 .'px '. $portfolio_items_gap .'px;
					}
				';
			}
		}

		if ($creativa_options['opt-portfolio-fullwidth'] == false) {
			if($content_padding['padding-top'] != '100px' || $content_padding['padding-bottom'] != '100px' || $portfolio_items_gap != 30) {
				$c_css .= '
					.section.portfolio {
						padding: '. ($content_padding['padding-top'] - $portfolio_items_gap / 2) .'px 0 '. ($content_padding['padding-bottom'] - $portfolio_items_gap / 2) .'px 0;
					}
				';
			}
		}


	}

	// Custom Typography
	function creativa_body_typography() {
		global $creativa_options;

		//Body
		$body_typography = $creativa_options['opt-typo-body'];
		
		$body_c_css = '';
		if ($body_typography['font-family'] != 'Poppins') {
			$body_c_css .= '
					font-family: "'.$body_typography['font-family'].'";
				';
		}
		if ($body_typography['font-weight'] != '300' && !empty($body_typography['font-weight'])) {
			$body_c_css .= '
					font-weight: '.$body_typography['font-weight'].';
				';
		}
		if ($body_typography['font-size'] != '14px' && !empty($body_typography['font-size'])) {
			$body_c_css .= '
					font-size: '.$body_typography['font-size'].';
				';
		}
		if ($body_typography['line-height'] != '26px' && !empty($body_typography['line-height'])) {
			$body_c_css .= '
					line-height: '.$body_typography['line-height'].';
				';
		}
		if (!empty($body_typography['font-style'])) {
			$body_c_css .= '
					font-style: '.$body_typography['font-style'].';
				';
		}

		return $body_c_css;
	}

	if (creativa_body_typography()) {
		$c_css .= '
			body {
				'. creativa_body_typography() .'
			}
		';
	}

	$typo_a_weight = $creativa_options['opt-typo-a-weight'];
	// print_r($typo_a_weight);

	if ($typo_a_weight != '400') {
		$c_css .= '
			a, b, strong, dt, th,
			.entry-info .comments-number, 
			.entry-info .single__entry-info--categories a, 
			.entry-info .single__portfolio-categories,
			.format-quote blockquote footer, 
			.single-format-quote blockquote footer,
			#comments #reply-title, 
			#comments #cancel-comment-reply-link,
			.portfolio__style--onhover .portfolio-item a .portfolio_hover--meta .portfolio-item__cats,
			.portfolio__style--overlay .portfolio-item a .portfolio_hover--meta .portfolio-item__cats,
			.portfolio__style--bottom .portfolio-item a .portfolio_hover--meta .portfolio-item__cats,
			.project--info .project--info__title,
			.btn, input[type="submit"], 
			.woocommerce #respond input#submit,
			.nav > li > a, .loprd-tabs-nav > li > a,
			blockquote footer,
			.vc_progress_bar .vc_single_bar .vc_bar::after,
			.loprd-accordion .loprd-accordion-header a,
			.widget_recent_comments ul li .url, 
			.widget_recent_entries ul li .url, 
			.widget_rss ul li .url,
			.widget_recent_comments .comment-author-link, 
			.widget_rss h6 .rsswidget, 
			.widget_recent_posts_tab .nav > li > a,
			.widget_recent_posts_tab .recent_posts li .comment-author-tab > span, 
			.widget_recent_posts_tab .popular_posts li .comment-author-tab > span, 
			.widget_recent_posts_tab .recent_comments li .comment-author-tab > span {
				font-weight: '. $typo_a_weight .';
			}
		';


		if (function_exists('is_woocommerce')) {
			$c_css .= '
				.woocommerce input.button, .woocommerce button.button, .woocommerce a.button, .woocommerce-page input.button, .woocommerce-page button.button, .woocommerce-page a.button,
				.woocommerce div.product .woo__creativa--single-cat a,
				.woocommerce .widget_price_filter .price_label .from, .woocommerce .widget_price_filter .price_label .to, .woocommerce-page .widget_price_filter .price_label .from, .woocommerce-page .widget_price_filter .price_label .to,
				.woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button,
				.woocommerce .widget_shopping_cart ul li a, .woocommerce .widget_products ul li a, .woocommerce .widget_recently_viewed_products ul li a, .woocommerce .widget_recent_reviews ul li a, .woocommerce .widget_top_rated_products ul li a, .woocommerce-page .widget_shopping_cart ul li a, .woocommerce-page .widget_products ul li a, .woocommerce-page .widget_recently_viewed_products ul li a, .woocommerce-page .widget_recent_reviews ul li a, .woocommerce-page .widget_top_rated_products ul li a {
					font-weight: '. $typo_a_weight .';
				}
			';
		}
	}

	function creativa_body_font_family() {
		global $creativa_options;

		//Body
		$body_typography = $creativa_options['opt-typo-body'];
		
		$body_c_css = '';
		if ($body_typography['font-family'] != 'Poppins') {
			$body_c_css .= '
					font-family: "'.$body_typography['font-family'].'";
				';
		}

		return $body_c_css;
	}

	if (creativa_body_font_family()) {
		$c_css .= '
			.the-comment .comment-content .meta .comment-reply-link,
			.the-comment .comment-content .meta .comment-author, 
			.the-comment .comment-content .meta .comment-author a,
			.woocommerce .woocommerce-shipping-calculator, 
			.woocommerce-page .woocommerce-shipping-calculator,
			.woocommerce .cart-collaterals .cart_totals table tr td small, 
			.woocommerce table.shop_table td small, 
			.woocommerce .widget_shopping_cart_content .total small, 
			.woocommerce-page .cart-collaterals .cart_totals table tr td small, 
			.woocommerce-page table.shop_table td small, 
			.woocommerce-page .widget_shopping_cart_content .total small {
				'. creativa_body_font_family() .'
			}
		';
	}

	// Secondary Font
	function creativa_secondary_font_typo() {
		global $creativa_options;

		$secondary_font_typo = $creativa_options['opt-typo-body-secondary'];
		// print_r($secondary_font_typo);
		$fw_css = '';

		if (!empty($secondary_font_typo['font-family']) && $secondary_font_typo['font-family'] != 'Rosarivo') {
			$fw_css .= 'font-family: '. $secondary_font_typo['font-family'] .'; ';
		}
		if (!empty($secondary_font_typo['font-weight']) && $secondary_font_typo['font-weight'] != '400') {
			$fw_css .= 'font-weight: '. $secondary_font_typo['font-weight'] .'; ';
		}
		if (!empty($secondary_font_typo['font-style']) && $secondary_font_typo['font-style'] != 'normal') {
			$fw_css .= 'font-style: '. $secondary_font_typo['font-style']  .' ';
		}


		return $fw_css;
	}


	$woo_secondary_font = '';
	if (function_exists('is_woocommerce')) {
		$woo_secondary_font = ',
			.woocommerce-pagination .page-numbers > li > a, 
			.woocommerce-pagination .page-numbers > li > span,
			.woocommerce table.shop_table .product-name .variation dd, 
			.woocommerce-page table.shop_table .product-name .variation dd,
			.woocommerce table.shop_table .amount, .woocommerce-page table.shop_table .amount,
			.woocommerce .shipping td, .woocommerce-page .shipping td,
			.woocommerce .cart_totals .amount, .woocommerce-page .cart_totals .amount,
			.woocommerce .cart_totals .order-total .amount, .woocommerce-page .cart_totals .order-total .amount,
			.creativa_woo_title .price,
			.woocommerce div.product .creativa_woo_sp_pricing,
			.woocommerce div.product .creativa_woo_sp_pricing p.price, .woocommerce div.product .creativa_woo_sp_pricing span.price,
			.woocommerce .woo__creativa--description__content table.shop_attributes td p,
			.woocommerce .woo__creativa--description__content #reviews #comments ol.commentlist li .comment-text p.meta time,
			.woocommerce div.product form.cart .variations select,
			.woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce .widget_layered_nav ul li.chosen a, .woocommerce-page .widget_layered_nav ul li.chosen a,
			.woocommerce .widget_layered_nav_filters ul li a .amount, .woocommerce-page .widget_layered_nav_filters ul li a .amount,
			.woocommerce .widget_shopping_cart ul li .quantity, .woocommerce .widget_products ul li .quantity, .woocommerce .widget_recently_viewed_products ul li .quantity, .woocommerce .widget_recent_reviews ul li .quantity, .woocommerce .widget_top_rated_products ul li .quantity, .woocommerce-page .widget_shopping_cart ul li .quantity, .woocommerce-page .widget_products ul li .quantity, .woocommerce-page .widget_recently_viewed_products ul li .quantity, .woocommerce-page .widget_recent_reviews ul li .quantity, .woocommerce-page .widget_top_rated_products ul li .quantity,
			.woocommerce .widget_shopping_cart ul li .amount, .woocommerce .widget_products ul li .amount, .woocommerce .widget_recently_viewed_products ul li .amount, .woocommerce .widget_recent_reviews ul li .amount, .woocommerce .widget_top_rated_products ul li .amount, .woocommerce-page .widget_shopping_cart ul li .amount, .woocommerce-page .widget_products ul li .amount, .woocommerce-page .widget_recently_viewed_products ul li .amount, .woocommerce-page .widget_recent_reviews ul li .amount, .woocommerce-page .widget_top_rated_products ul li .amount,
			.woocommerce .widget_shopping_cart .total .amount, .woocommerce-page .widget_shopping_cart .total .amount,
			.nav-shopping-bag .nav-shopping-cart .cart_list li a';
	}

	if (creativa_secondary_font_typo()) {
		$c_css .= '
			.font-secondary,
			.nav-icons ul li .nav-shopping-cart li p.total .amount,
			.wp-caption, .gallery-caption,
			.wp-caption p.wp-caption-text,
			.pagination > li > a, .pagination > li > span, 
			.wp_link_pages li,
			.comment-nav-section,
			.widget_calendar #wp-calendar caption
			'. $woo_secondary_font .' {
				'.creativa_secondary_font_typo().'
			}
		';
	}

	// Headings Typography Basic
	function creativa_headings_typo_basic($typo_attr) {
		global $creativa_options;

		//Headings Basic
		$headings_typo_basic = $creativa_options['opt-typo-basic-headings'];

		$h_c_css = '';
		if ($typo_attr == 'font-family' || $typo_attr == 'all' ) {
			if ($headings_typo_basic['font-family'] != 'Montserrat') {
				$h_c_css .= '
						font-family: "'.$headings_typo_basic['font-family'].'";
					';
			}
		}
		if ($typo_attr == 'font-weight' || $typo_attr == 'all' ) {
			if ($headings_typo_basic['font-weight'] != '700' && !empty($headings_typo_basic['font-weight'])) {
				$h_c_css .= '
						font-weight: '.$headings_typo_basic['font-weight'].';
					';
			}
		}

		if ($typo_attr == 'text-transform' || $typo_attr == 'all' ) {
			if (isset($headings_typo_basic['text-transform']) && $headings_typo_basic['text-transform']) {
				$h_c_css .= '
						text-transform: '.$headings_typo_basic['text-transform'].';
					';
			}
		}
		if ($typo_attr == 'letter-spacing' || $typo_attr == 'all' ) {
			if (!empty($headings_typo_basic['letter-spacing'])) {
				$h_c_css .= '
						letter-spacing: '.$headings_typo_basic['letter-spacing'].';
					';
			}
		}
		return $h_c_css;
	}

	if (creativa_headings_typo_basic('all')) {
		$c_css .= '
			h1, h2, h3, h4, h5, h6, small, label, .heading {
				'. creativa_headings_typo_basic('font-family') .'
				'. creativa_headings_typo_basic('font-weight') .'
				'. creativa_headings_typo_basic('text-transform') .'
				'. creativa_headings_typo_basic('letter-spacing') .'
			}
		';
	}

	if (creativa_headings_typo_basic('font-family')) {
		$c_css .= '
			.btn, input[type="submit"], .woocommerce #respond input#submit,
			.woocommerce input.button, .woocommerce button.button, .woocommerce a.button, 
			.woocommerce-page input.button, .woocommerce-page button.button, .woocommerce-page a.button {
				'. creativa_headings_typo_basic('font-family') .'
			}
		';
	}

	function creativa_headings_basic_single($hsize, $important = null) {
		global $creativa_options;

		$h_basic = $creativa_options['opt-typo-basic-'.$hsize.''];

		if ($hsize == 'h1' ) {
			$h_fs_def = '44px';
			$h_lh_def = '48px';
		}
		elseif ($hsize == 'h2' ) {
			$h_fs_def = '32px';
			$h_lh_def = '38px';
		}
		elseif ($hsize == 'h3' ) {
			$h_fs_def = '26px';
			$h_lh_def = '34px';
		}
		elseif ($hsize == 'h4' ) {
			$h_fs_def = '18px';
			$h_lh_def = '28px';
		}
		elseif ($hsize == 'h5' ) {
			$h_fs_def = '15px';
			$h_lh_def = '24px';
		}
		elseif ($hsize == 'h6' ) {
			$h_fs_def = '12px';
			$h_lh_def = '20px';
		}

		$imp_attr = '';
		if ($important == true) {
			$imp_attr = '!important';
		}

		$hsingle_c_css = '';
		if ($h_basic['font-size'] != $h_fs_def && !empty($h_basic['font-size'])) {
			$hsingle_c_css .= '
					font-size: '. $h_basic['font-size'] .' '. $imp_attr .';
			';
		}
		if ($h_basic['line-height'] != $h_lh_def && !empty($h_basic['line-height'])) {
			$hsingle_c_css .= '
					line-height: '. $h_basic['line-height'] .' '. $imp_attr .';
			';
		}

		return $hsingle_c_css;
	}

	if (creativa_headings_basic_single('h1')) {
		$c_css .= 'h1 {'.creativa_headings_basic_single('h1'). '}';
		$c_css .= '.hero, .h1-size {'.creativa_headings_basic_single('h1', true). '}';
	}
	if (creativa_headings_basic_single('h2')) {
		$c_css .= 'h2 {'.creativa_headings_basic_single('h2'). '}';
		$c_css .= '.h2-size {'.creativa_headings_basic_single('h2', true). '}';
	}
	if (creativa_headings_basic_single('h3')) {
		$c_css .= 'h3 {'.creativa_headings_basic_single('h3'). '}';
		$c_css .= '.h3-size {'.creativa_headings_basic_single('h3', true). '}';
	}
	if (creativa_headings_basic_single('h4')) {
		$c_css .= 'h4 {'.creativa_headings_basic_single('h4'). '}';
		$c_css .= '.h4-size {'.creativa_headings_basic_single('h4', true). '}';
	}
	if (creativa_headings_basic_single('h5')) {
		$c_css .= 'h5 {'.creativa_headings_basic_single('h5'). '}';
		$c_css .= '.h5-size {'.creativa_headings_basic_single('h5', true). '}';
	}
	if (creativa_headings_basic_single('h6')) {
		$c_css .= 'h6, small {'.creativa_headings_basic_single('h6'). '}';
		$c_css .= '.h6-size {'.creativa_headings_basic_single('h6', true). '}';
	}

	// Main Nav Typo 
	function creativa_main_nav_typography() {
		global $creativa_options;

		$main_nav_typo = $creativa_options['opt-typo-main-nav'];
		$mn_css = '';

		if ($main_nav_typo['font-family'] != 'Montserrat') {
			$mn_css .= 'font-family: '. $main_nav_typo['font-family'] .'; ';
		}
		if ($main_nav_typo['font-size'] != '16px') {
			$mn_css .= 'font-size: '. $main_nav_typo['font-size'] .'; ';
		}
		if ($main_nav_typo['font-weight'] != '400' && !empty($main_nav_typo['font-weight'])) {
			$mn_css .= 'font-weight: '. $main_nav_typo['font-weight'] .'; ';
		}
		if (!empty($main_nav_typo['text-transform']) && $main_nav_typo['text-transform'] != 'none') {
			$mn_css .= 'text-transform: '. $main_nav_typo['text-transform'] .'; ';
		}
		if ($main_nav_typo['letter-spacing'] != '0px') {
			$mn_css .= 'letter-spacing: '. $main_nav_typo['letter-spacing'] .'; ';
		}

		return $mn_css;
	}

	if (creativa_main_nav_typography()) {
		$c_css .= '
			.main-nav ul li a,
			.sidebar-nav ul li a,
			.nav-side__mobile-menu,
			.main-nav ul .creativa-mega-menu > ul > li > a,
			.main-nav ul .creativa-mega-menu > ul .menu-header > a {
				'.creativa_main_nav_typography().'
			}
		';
	}

	function creativa_main_nav_submenu_typography() {
		global $creativa_options;

		$main_nav_sub_typo = $creativa_options['opt-typo-main-submenu'];
		$main_nav_typo = $creativa_options['opt-typo-main-nav'];
		$mn_css = '';

		if ($main_nav_sub_typo['font-size'] != '12px') {
			$mn_css .= 'font-size: '. $main_nav_sub_typo['font-size'] .'; ';
		}
		if (!empty($main_nav_sub_typo['font-weight']) && $main_nav_sub_typo['font-weight'] != '400') {
			$mn_css .= 'font-weight: '. $main_nav_sub_typo['font-weight'] .'; ';
		}
		if (!empty($main_nav_sub_typo['text-transform']) && $main_nav_sub_typo['text-transform'] != 'none') {
			$mn_css .= 'text-transform: '. $main_nav_sub_typo['text-transform'] .'; ';
		}
		if ($main_nav_sub_typo['letter-spacing'] != '0px') {
			$mn_css .= 'letter-spacing: '. $main_nav_sub_typo['letter-spacing'] .'; ';
		}

		return $mn_css;
	}


	if (creativa_main_nav_submenu_typography()) {
		$c_css .= '
			.main-nav ul li ul li a {
				'.creativa_main_nav_submenu_typography().'
			}
		';
	}
	// Main Nav Typo 
	function creativa_full_width_typo() {
		global $creativa_options;

		$full_width_typo = $creativa_options['opt-typo-fullw-nav'];
		$fw_css = '';

		if ($full_width_typo['font-family'] != 'Montserrat') {
			$fw_css .= 'font-family: '. $full_width_typo['font-family'] .'; ';
		}
		if ($full_width_typo['font-size'] != '22px') {
			$fw_css .= 'font-size: '. $full_width_typo['font-size'] .'; ';
		}
		if ($full_width_typo['font-weight'] != '400' && !empty($full_width_typo['font-weight'])) {
			$fw_css .= 'font-weight: '. $full_width_typo['font-weight'] .'; ';
		}
		if (!empty($full_width_typo['text-transform']) && $full_width_typo['text-transform'] != 'none') {
			$fw_css .= 'text-transform: '. $full_width_typo['text-transform'] .'; ';
		}
		if ($full_width_typo['letter-spacing'] != '0px') {
			$fw_css .= 'letter-spacing: '. $full_width_typo['letter-spacing'] .'; ';
		}

		return $fw_css;
	}

	if (creativa_full_width_typo()) {
		$c_css .= '
			.full-nav ul li a {
				'.creativa_full_width_typo().'
			}
		';
	}

	function creativa_full_width_submenu_typo() {
		global $creativa_options;

		$full_width_submenu_typo = $creativa_options['opt-typo-fullw-nav-submenu'];
		$fw_sub_css = '';

		if ($full_width_submenu_typo['font-size'] != '14px') {
			$fw_sub_css .= 'font-size: '. $full_width_submenu_typo['font-size'] .'; ';
		}
		if (!empty($full_width_submenu_typo['font-weight']) && $full_width_submenu_typo['font-weight'] != '400') {
			$fw_sub_css .= 'font-weight: '. $full_width_submenu_typo['font-weight'] .'; ';
		}
		if (!empty($full_width_submenu_typo['text-transform']) && $full_width_submenu_typo['text-transform'] != 'none') {
			$fw_sub_css .= 'text-transform: '. $full_width_submenu_typo['text-transform'] .'; ';
		}
		if (!empty($full_width_submenu_typo['letter-spacing'])) {
			$fw_sub_css .= 'letter-spacing: '. $full_width_submenu_typo['letter-spacing'] .'; ';
		}

		return $fw_sub_css;
	}

	if (creativa_full_width_submenu_typo()) {
		$c_css .= '
			.full-nav ul li ul li a {
				'.creativa_full_width_submenu_typo().'
			}
		';
	}

	// Page Title
	if ($creativa_options['opt-custom-page-title-typo'] == true ) {
		function creativa_page_title_typo() {
			global $creativa_options;

			$page_title_typo = $creativa_options['opt-page-title-heading'];
			$fw_css = '';

			if (!empty($page_title_typo['font-family'])) {
				$fw_css .= 'font-family: "'. $page_title_typo['font-family'] .'"; ';
			}
			if (!empty($page_title_typo['font-weight'])) {
				$fw_css .= 'font-weight: '. $page_title_typo['font-weight'] .'; ';
			}
			if (!empty($page_title_typo['font-style'])) {
				$fw_css .= 'font-style: '. $page_title_typo['font-style'] .'; ';
			}
			if (!empty($page_title_typo['text-transform'])) {
				$fw_css .= 'text-transform: '. $page_title_typo['text-transform'] .'; ';
			}
			if (!empty($page_title_typo['letter-spacing'])) {
				$fw_css .= 'letter-spacing: '. $page_title_typo['letter-spacing'] .'; ';
			}
			if (!empty($page_title_typo['font-size'])) {
				$fw_css .= 'font-size: '. $page_title_typo['font-size'] .'; ';
			}
			if (!empty($page_title_typo['line-height'])) {
				$fw_css .= 'line-height: '. $page_title_typo['line-height'] .'; ';
			}

			return $fw_css;
		}

		if (creativa_page_title_typo()) {
			$c_css .= '
				.creativa-title {
					'.creativa_page_title_typo().'
				}

			';
		}

		// Page Subtitle
		function creativa_page_subtitle_typo() {
			global $creativa_options;

			$page_subtitle_typo = $creativa_options['opt-page-subtitle-heading'];
			$fw_css = '';

			if (!empty($page_subtitle_typo['font-size'])) {
				$fw_css .= 'font-size: '. $page_subtitle_typo['font-size'] .'; ';
			}
			if (!empty($page_subtitle_typo['line-height'])) {
				$fw_css .= 'line-height: '. $page_subtitle_typo['line-height'] .'; ';
			}

			return $fw_css;
		}

		if (creativa_page_subtitle_typo()) {
			$c_css .= '
				.creativa-subtitle {
					'.creativa_page_subtitle_typo().'
				}
			';
		}
	}


	// Blog Title
	if ($creativa_options['opt-custom-post-title'] == true ) {
		function creativa_post_title_typo() {
			global $creativa_options;

			$post_title_typo = $creativa_options['opt-post-title'];
			$fw_css = '';

			if (!empty($post_title_typo['font-family'])) {
				$fw_css .= 'font-family: "'. $post_title_typo['font-family'] .'"; ';
			}
			if (!empty($post_title_typo['font-weight'])) {
				$fw_css .= 'font-weight: '. $post_title_typo['font-weight'] .'; ';
			}
			if (!empty($post_title_typo['font-style'])) {
				$fw_css .= 'font-style: '. $post_title_typo['font-style'] .'; ';
			}
			if (!empty($post_title_typo['text-transform'])) {
				$fw_css .= 'text-transform: '. $post_title_typo['text-transform'] .'; ';
			}
			if (!empty($post_title_typo['letter-spacing'])) {
				$fw_css .= 'letter-spacing: '. $post_title_typo['letter-spacing'] .'; ';
			}
			if (!empty($post_title_typo['font-size'])) {
				$fw_css .= 'font-size: '. $post_title_typo['font-size'] .'; ';
			}
			if (!empty($post_title_typo['line-height'])) {
				$fw_css .= 'line-height: '. $post_title_typo['line-height'] .'; ';
			}

			return $fw_css;
		}

		if (creativa_post_title_typo()) {
			$c_css .= '
				.blog-header .post-title,
				.blog-header .post-title a {
					'.creativa_post_title_typo().'
				}
			';
		}
	}

	// Portfolio Item Title
	if ($creativa_options['opt-custom-portfolio-title'] == true ) {
		function creativa_portfolio_item_title_typo() {
			global $creativa_options;

			$portfolio_item_title_typo = $creativa_options['opt-portfolio-title'];
			$fw_css = '';

			if (!empty($portfolio_item_title_typo['font-family'])) {
				$fw_css .= 'font-family: "'. $portfolio_item_title_typo['font-family'] .'"; ';
			}
			if (!empty($portfolio_item_title_typo['font-weight'])) {
				$fw_css .= 'font-weight: '. $portfolio_item_title_typo['font-weight'] .'; ';
			}
			if (!empty($portfolio_item_title_typo['font-style'])) {
				$fw_css .= 'font-style: '. $portfolio_item_title_typo['font-style'] .'; ';
			}
			if (!empty($portfolio_item_title_typo['text-transform'])) {
				$fw_css .= 'text-transform: '. $portfolio_item_title_typo['text-transform'] .'; ';
			}
			if (!empty($portfolio_item_title_typo['letter-spacing'])) {
				$fw_css .= 'letter-spacing: '. $portfolio_item_title_typo['letter-spacing'] .'; ';
			}
			if (!empty($portfolio_item_title_typo['font-size'])) {
				$fw_css .= 'font-size: '. $portfolio_item_title_typo['font-size'] .'; ';
			}
			if (!empty($portfolio_item_title_typo['line-height'])) {
				$fw_css .= 'line-height: '. $portfolio_item_title_typo['line-height'] .'; ';
			}

			return $fw_css;
		}

		if (creativa_portfolio_item_title_typo()) {
			$c_css .= '
				.portfolio-item__title {
					'.creativa_portfolio_item_title_typo().'
				}
			';
		}
	}








	// Colors ---------------------------------------------- /
	// Layout Settings
	if ($creativa_options['opt-layout'] != 1) {
		function creativa_creativa_boxbor_bg() {
			global $creativa_options;

			$body_background = $creativa_options['opt-body-bg'];
			$c_css = '';

			if (!empty($body_background) && $body_background['background-color'] != '#282828') {
				$c_css .= '
					background-color: '. $body_background['background-color'] .';
				';
			}
			if (!empty($body_background['background-image'])) {
				$c_css .= '
					background-image: url('. $body_background['background-image'] .');
				';

				if (!empty($body_background['background-repeat'])) {
					$c_css .= '
						background-repeat: '. $body_background['background-repeat'] .';
					';
				}
				if (!empty($body_background['background-size'])) {
					$c_css .= '
						background-size: '. $body_background['background-size'] .';
					';
				}
				if (!empty($body_background['background-attachment'])) {
					$c_css .= '
						background-attachment: '. $body_background['background-attachment'] .';
					';
				}
				if (!empty($body_background['background-position'])) {
					$c_css .= '
						background-position: '. $body_background['background-position'] .';
					';
				}
			}

			return $c_css;
		}

		if (creativa_creativa_boxbor_bg()) {
			$c_css .= '
				.layout-boxed, .layout-bordered  {
					'. creativa_creativa_boxbor_bg() .'
				}
			';
		}

		if ($creativa_options['opt-layout'] == 2) {
			if ($creativa_options['opt-boxed-gap'] != 60) {
				$boxed_width = ($creativa_options['opt-content-width'] + ($creativa_options['opt-boxed-gap'] * 2));
				$c_css .= '
					@media (min-width: '. ($boxed_width + 20) .'px) { 
						.layout-boxed .layout-wrapper,
						.layout-boxed .layout-wrapper #navbar {
							width: '. $boxed_width .'px;
						}
					}

					@media (max-width: '. ($boxed_width + 19) .'px) { 
						.layout-boxed .layout-wrapper,
						.layout-boxed .layout-wrapper #navbar {
							width: 100%;
						}
					}
				';

			}
		}

		if ($creativa_options['opt-layout'] == 3) {
			if ($creativa_options['opt-border-size'] != 20) {
				// if ($creativa_options['opt-responsive'] == 1) {
				$c_css .= '
					@media (min-width: '. ($creativa_options['opt-content-width'] + 60 + $creativa_options['opt-border-size']) .'px) {
						.layout-bordered .layout-wrapper {
							margin: '. ($creativa_options['opt-border-size']) .'px;
						}
					}
				';
			}
		}
	}


	// Basic Colors
	$body_content_bg = $creativa_options['opt-color-body-bg'];
	$body_content_sep_bg = $creativa_options['opt-color-body-grey-bg'];
	$body_content_text = $creativa_options['opt-color-body-text'];
	$body_content_headings = $creativa_options['opt-color-headings'];
	$body_content_links = $creativa_options['opt-link-colors'];
	$accent_color = $creativa_options['opt-color-accent'];

	if (!empty($body_content_bg) && $body_content_bg != '#ffffff') {
		$c_css .= '
			.content,
			.prev-next__project li a,
			.prev-next_posts li a,
			.mfp-bg {
				background: '. $body_content_bg .';
			}

			.row__separator--top, .row__separator--bottom {
				color: '. $body_content_bg .';
			}
		';
	}

	if (!empty($body_content_sep_bg) && $body_content_sep_bg != '#fafafa') {
		$c_css .= '
			.content-separated,
			.woocommerce .woo__creativa--tabs-wrapper .nav-tabs > li.active > a,
			.blog-width-full .sidebar-wrap,
			.shop__width-full .sidebar-wrap {
				background: '. $body_content_sep_bg .';
			}
		';
	}

	if (!empty($body_content_text) && $body_content_text != '#8a8a8a') {
		$c_css .= '
			body {
				color: '. $body_content_text .';
			}
		';
	}

	if (!empty($body_content_headings) && $body_content_headings != '#111111') {
		$c_css .= '
			h1, h2, h3, h4, h5, h6, small, label, .heading, .heading-color, .pt-header {
				color: '. $body_content_headings .';
			}
		';
	}

	if (!empty($body_content_links['regular']) && $body_content_links['regular'] != '#111111') {
		$c_css .= '
			a,
			.single__portfolio__url {
				color: '. $body_content_links['regular'] .';
			}
		';
	}
	if (!empty($body_content_links['hover']) && $body_content_links['hover'] != '#111111') {
		$c_css .= '
			a:hover,
			a:focus {
				color: '. $body_content_links['hover'] .';
			}
		';
	}

	$body_border_color = $creativa_options['opt-border-colors'];
	if ($body_border_color['color'] != '#000000' || $body_border_color['alpha'] != 0.05) {
		$c_css .= '
			.post,
			.result,
			.widget_recent_posts_tab .nav-tabs > li.active > a, 
			.widget_recent_posts_tab .nav-tabs > li.active > a:hover, 
			.widget_recent_posts_tab .nav-tabs > li.active > a:focus,
			.widget_recent_posts_tab .nav > li > a,
			.widget_recent_posts_tab .tab-content,
			.format-quote .post-media, .single-format-quote .post-media,
			.format-link .post-media, .single-format-link .post-media,
			.widget_calendar #wp-calendar caption,
			.widget_calendar #calendar_wrap,
			.widget_calendar #wp-calendar thead,
			.widget_tag_cloud .tagcloud a,
			.blog-width-full .blog-large .post-wrap,
			.vc_row_fullwidthcontent .loprd-shortcode-blog .blog-large .post-wrap,
			hr,
			.comment-respond,
			.commentslist li .comment-body,
			.commentslist .children li::before,
			.commentslist .children li::after,
			.single__title--wrap,
			.prev-next_posts li a,
			.prev-next__project li a,
			.woocommerce .widget_shopping_cart ul li, .woocommerce .widget_products ul li, 
			.woocommerce .widget_recently_viewed_products ul li, 
			.woocommerce .widget_recent_reviews ul li, 
			.woocommerce .widget_top_rated_products ul li, 
			.woocommerce-page .widget_shopping_cart ul li, 
			.woocommerce-page .widget_products ul li, 
			.woocommerce-page .widget_recently_viewed_products ul li, 
			.woocommerce-page .widget_recent_reviews ul li, 
			.woocommerce-page .widget_top_rated_products ul li,
			.woocommerce nav.woocommerce-pagination,
			.woocommerce div.product .creativa_woo_sp_pricing p.price, 
			.woocommerce div.product .creativa_woo_sp_pricing span.price,
			.woocommerce table.shop_table td, .woocommerce-page table.shop_table td,
			.woocommerce .cart-collaterals .cart_totals tr td, 
			.woocommerce .cart-collaterals .cart_totals tr th, 
			.woocommerce-page .cart-collaterals .cart_totals tr td, 
			.woocommerce-page .cart-collaterals .cart_totals tr th,
			.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th,
			.addresses .address,
			.wpb_tabs.loprd-tabs-nav--border .tab-content,
			.wpb_tabs.loprd-tabs-nav--border .nav-tabs > li > a, .wpb_tabs.loprd-tabs-nav--border .loprd-tabs-nav > li > a,
			.loprd-accordion .wpb_accordion_section,
			.loprd-accordion .loprd-accordion-content,
			.loprd-toggle-wrapper,
			.loprd-toggle-wrapper:last-child,
			.iconbox-border,
			blockquote.blockquote-bordered p, 
			blockquote.blockquote-bordered h1, 
			blockquote.blockquote-bordered h2, 
			blockquote.blockquote-bordered h3, 
			blockquote.blockquote-bordered h4, 
			blockquote.blockquote-bordered h5, 
			blockquote.blockquote-bordered h6,
			.loprd_separator .loprd_sep_holder .loprd_sep_line,
			.loprd-pricing-table.pricing-table--bordered,
			.loprd-call-to-action,
			.woocommerce div.product form.cart .variations tr:first-child,
			.woocommerce div.product form.cart .variations tr,
			.woocommerce div.product form.cart .group_table tr,
			.woocommerce div.product form.cart .group_table tr:first-child,
			.woocommerce table.shop_attributes td, .woocommerce table.shop_attributes th,
			.woocommerce table.shop_attributes,
			.project--info ul,
			pre,
			.post-content blockquote {
				border-color: '. $body_border_color['rgba'] .';
			}

			.widget_recent_posts_tab .nav-tabs > li:last-child > a,
			.prev-next__project li:first-child a,
			.wpb_tour .loprd-tabs-nav > li > a,
			.wpb_tour .loprd-tabs-nav > li:first-child a,
			.woocommerce .woo__creativa--description__content #review_form #respond p.stars a {
				border-color: '. $body_border_color['rgba'] .' !important;
			}
		';
	}

	$woo_colors = '';
	$woo_bg = '';
	$woo_bg_alpha = '';
	if (function_exists('is_woocommerce')) {
		$woo_colors = ',.creativa_woo_title .price .amount, 
		.woocommerce .widget_price_filter .price_slider_amount .button, 
		.woocommerce-page .widget_price_filter .price_slider_amount .button,
		.woocommerce span.onsale,
		.woocommerce .widget_shopping_cart ul li .amount, 
		.woocommerce .widget_products ul li .amount, 
		.woocommerce .widget_recently_viewed_products ul li .amount, 
		.woocommerce .widget_recent_reviews ul li .amount, 
		.woocommerce .widget_top_rated_products ul li .amount, 
		.woocommerce-page .widget_shopping_cart ul li .amount, 
		.woocommerce-page .widget_products ul li .amount, 
		.woocommerce-page .widget_recently_viewed_products ul li .amount, 
		.woocommerce-page .widget_recent_reviews ul li .amount, 
		.woocommerce-page .widget_top_rated_products ul li .amount,
		.woocommerce .widget_layered_nav ul li.chosen a, 
		.woocommerce-page .widget_layered_nav ul li.chosen a,
		.woocommerce div.product .creativa_woo_sp_pricing p.price, 
		.woocommerce div.product .creativa_woo_sp_pricing span.price,
		.woocommerce .star-rating span,
		.woocommerce .cart_totals .order-total .amount, 
		.woocommerce-page .cart_totals .order-total .amount,
		.woocommerce-pagination .page-numbers li .current, 
		.woocommerce-pagination .page-numbers li .current:hover,
		.woocommerce .woocommerce-info:before,
		.woocommerce-pagination .page-numbers li span.current,
		.woocommerce nav.woocommerce-pagination ul li span.current';
		$woo_bg = ',.woo_creativa_thumb-overlay,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce input.button.alt, 
		.woocommerce button.button.alt, 
		.woocommerce a.button.alt, 
		.woocommerce-page input.button.alt, 
		.woocommerce-page button.button.alt, 
		.woocommerce-page a.button.alt,
		.nav-icons ul .nav-bag > a .menu-a-inner > span .nav__cart-items,
		.woocommerce form.login, .woocommerce form.register';
		$woo_bg_alpha = ',.woocommerce .widget_price_filter .price_slider_amount .button:hover, 
		.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
		.woocommerce input.button.alt:hover, 
		.woocommerce button.button.alt:hover, 
		.woocommerce a.button.alt:hover, 
		.woocommerce-page input.button.alt:hover, 
		.woocommerce-page button.button.alt:hover, 
		.woocommerce-page a.button.alt:hover';
	}

	if (!empty($accent_color) && $accent_color != '#21ce99') {
		$c_css .= '
			.color-accent,
			.back-to-top-btn,
			.timeline_line,
			.loprd-iconbox .loprd-iconbox-icon,
			.btn-outlined.btn-default,
			.project--sorting > a,
			.vc_progress_bar .vc_single_bar .vc_bar,
			.format-quote blockquote footer, 
			.single-format-quote blockquote footer,
			.format-link .post-title--link a:hover, 
			.format-link .post-title--link a:focus, 
			.single-format-link .post-title--link a:hover, 
			.single-format-link .post-title--link a:focus,
			.pagination li .current, 
			.pagination li .current:hover, 
			.pagination li span.current,
			.nav-icons ul li .nav-shopping-cart li p.total .amount,
			ul.checked li:before, ul li.checked:before, ul.unchecked li:before, ul li.unchecked:before, ul.plus li:before, ul li.plus:before, ul.minus li:before, ul li.minus:before,
			.sticky .blog-header .post-title::before
			'. $woo_colors .' {
				color:  '. $accent_color .';
			}

			.nav-icons ul li .nav-shopping-cart li .product_list_widget li:not(.empty) .remove {
				color:  '. $accent_color .' !important;
			}

			#page-shares ul li a,
			.portfolio-item .portfolio_info .info_icon, 
			.portfolio-item .portfolio_info .jm-post-like,
			.btn-default, input[type="submit"], 
			.woocommerce #respond input#submit,
			.rsCreativa .rsArrowIcn,
			.shares-list li .like,
			.back-to-top-btn:hover, .back-to-top-btn:focus,
			.nav-icons ul li .nav-shopping-cart li p.buttons a.checkout,
			.loprd_timeline_block_wrap .loprd_timeline_block--point,
			.pt-featured-text,
			.project--sorting ul,
			.rsCreativa .rsBullet span:hover,
			.jp-play-bar, .jp-volume-bar-value,
			.iconbox-block .icon-bg, .iconbox-inline .icon-bg
			'. $woo_bg .' {
				background:  '. $accent_color .';
			}

			::-moz-selection {
				background:  '. $accent_color .';
			}
			::selection {
				background:  '. $accent_color .';
			}

			.vc_progress_bar .vc_single_bar .vc_bar,
			.nav-icons ul li .nav-shopping-cart li .product_list_widget li:not(.empty) .remove:hover,
			.bg-accent {
				background:  '. $accent_color .' !important;
			}

			.highlight-accent,
			.portfolio-item .portfolio_info .info_icon:hover, 
			.portfolio-item .portfolio_info .jm-post-like:hover,
			.btn-default:hover, .btn-default:focus, input[type="submit"]:hover, input[type="submit"]:focus, 
			.woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus,
			.nav-icons ul li .nav-shopping-cart li p.buttons a.checkout:hover,
			.btn-link:hover, .btn-link:focus, .btn-outlined.btn-default:hover, .btn-outlined.btn-default:focus,
			a.magnpopup:not(.carousel-view):not(.no_overlay):hover::before, 
			a.img-link:not(.carousel-view):not(.no_overlay):hover::before,
			.prev-next_posts li a .prev-next-post_thumb::after,
			.blog-media-bg.has-post-thumbnail:not(.format-quote):not(.format-link) .post-content-wrap
			'. $woo_bg_alpha .' {
				background:  '. creativa_hexConvert($accent_color, 0.9) .';
			}

			.team-member__info--content {
				background:  '. creativa_hexConvert($accent_color, 0.95) .';
			}

			.jp-progress, .jp-seek-bar {
				background:  '. creativa_hexConvert($accent_color, 0.2) .';
			}

			.btn-outlined.btn-default {
		 		background: transparent;
		 	}

		 	.btn-outlined.btn-default {
		 		-webkit-box-shadow: inset 0 0 0 1px '. $accent_color .';
		 		-moz-box-shadow: inset 0 0 0 1px '. $accent_color .';
		 		box-shadow: inset 0 0 0 1px '. $accent_color .';
		 	}

		 	.highlight-accent {
		 		-webkit-box-shadow: 3px 0 0 '. $accent_color .', -3px 0 0 '. $accent_color .';
		 		-moz-box-shadow: 3px 0 0 '. $accent_color .', -3px 0 0 '. $accent_color .';
		 		box-shadow: 3px 0 0 '. $accent_color .', -3px 0 0 '. $accent_color .';
		 	}

		 	.woocommerce ul.products li.product:hover .creativa_woo_item--wrapper, 
		 	.woocommerce-page ul.products li.product:hover .creativa_woo_item--wrapper,
		 	.woocommerce #order_review, .woocommerce-page #order_review {
		 		outline-color: '. $accent_color .';
		 	}

		 	.woocommerce table.shop_table.cart thead th, 
		 	.woocommerce-page table.shop_table.cart thead th,
		 	.woocommerce table.shop_table.cart tfoot td, 
		 	.woocommerce-page table.shop_table.cart tfoot td,
		 	.bypostauthor .avatar img,
		 	.woocommerce .woocommerce-info,
		 	.rsCreativa .rsBullet.rsNavSelected span {
		 		border-color: '. $accent_color .'; 
		 	}

		 	.nav-icons ul li .nav-shopping-cart li .product_list_widget li:not(.empty) .remove:hover {
		 		border-color: '. $accent_color .' !important; 
		 	}

		';
	}



	// Page Title
	if ((is_page() && $creativa_options['opt-title-bar'] == 1) || is_archive() || is_404() || is_search() || is_home() || !is_page_template( 'template-full-width.php' )) {
		function creativa_creativa_page_title_bg() {
			global $creativa_options;

			$page_title_background = $creativa_options['opt-pt-bg'];
			$c_css = '';

			if (!empty($page_title_background['background-color']) && $page_title_background['background-color'] != '#fafafa') {
				$c_css .= '
					background-color: '. $page_title_background['background-color'] .';
				';
			}
			return $c_css;
		}

		function creativa_creativa_page_title_img() {
			global $creativa_options;

			$page_title_background = $creativa_options['opt-pt-bg'];
			$c_css = '';

			if (!empty($page_title_background['background-color']) && $page_title_background['background-color'] != '#fafafa') {
				$c_css .= '
					background-color: '. $page_title_background['background-color'] .';
				';
			}
			if (!empty($page_title_background['background-image'])) {
				$c_css .= '
					background-image: url('. $page_title_background['background-image'] .');
				';

				if (!empty($page_title_background['background-repeat'])) {
					$c_css .= '
						background-repeat: '. $page_title_background['background-repeat'] .';
					';
				}
				if (!empty($page_title_background['background-size'])) {
					$c_css .= '
						background-size: '. $page_title_background['background-size'] .';
					';
				}
				if (!empty($page_title_background['background-attachment'])) {
					$c_css .= '
						background-attachment: '. $page_title_background['background-attachment'] .';
					';
				}
				if (!empty($page_title_background['background-position'])) {
					$c_css .= '
						background-position: '. $page_title_background['background-position'] .';
					';
				}
			}

			return $c_css;
		}

		if (creativa_creativa_page_title_bg()) {
			$c_css .= '
				.page-title-container {
					'. creativa_creativa_page_title_bg() .'
				}
			';
		}

		if (creativa_creativa_page_title_img()) {
			$c_css .= '
				.page-title-bg {
					'. creativa_creativa_page_title_img() .'
				}
			';
		}



		$pt_border = $creativa_options['opt-pt-border'];
		// print_r($pt_border);
		if ($pt_border['border-bottom'] != '0px' || $pt_border['border-style'] != 'none' || $pt_border['border-color'] != '#f3f3f3' ) {
			$c_css .= '
				.page-title-container {
					border-bottom: '. $pt_border['border-bottom'] .' '. $pt_border['border-style'] .' '. $pt_border['border-color'] .';
				}
			';
		}

		if ($creativa_options['opt-pt-overlay'] == 1) {
			$pt_overlay_style = $creativa_options['opt-pt-overlay-color-style'];
			$pt_overlay_color1 = $creativa_options['opt-pt-overlay-bg'];
			$pt_overlay_color2 = $creativa_options['opt-pt-overlay-bg2'];
			$pt_overlay_gradient_dir = $creativa_options['opt-pt-overlay-gradient-dir'];


			// print_r($pt_overlay);

			if ($pt_overlay_style == 1) {
				if (!empty($pt_overlay_color1) && $pt_overlay_color1['color'] != '#000000' || $pt_overlay_color1['alpha'] != 0.3) {
					$c_css .= '
						.page-title-container .page-title__overlay {
							background: '. $pt_overlay_color1['rgba'] .';
						}
					';
				}
			}

			if ($pt_overlay_style == 2) {

				if (isset($pt_overlay_color1['rgba']) && (($pt_overlay_color1['color'] != '#000000' || $pt_overlay_color1['alpha'] != 0.3) || ($pt_overlay_color2['color'] != '#000000' || $pt_overlay_color2['alpha'] != 0.9))) {
					$c_css .= '
						.page-title-container .page-title__overlay {
							background: -moz-linear-gradient('. $pt_overlay_gradient_dir .'deg, '. $pt_overlay_color1['rgba'] .', '. $pt_overlay_color2['rgba'] .');
    						background: -webkit-linear-gradient('. $pt_overlay_gradient_dir .'deg, '. $pt_overlay_color1['rgba'] .', '. $pt_overlay_color2['rgba'] .');
    						background: linear-gradient('. $pt_overlay_gradient_dir .'deg, '. $pt_overlay_color1['rgba'] .', '. $pt_overlay_color2['rgba'] .');
						}
					';
				}
			}
		}
	
		$pt_color = $creativa_options['opt-pagetitle-color'];

		if (!empty($pt_color) && $pt_color != '#111111') {
			$c_css .= '
				.page-title-container {
					color: '. $pt_color .';
				}
			';

		}
	} 


	// Navigation
	$navigation_layout = $creativa_options['opt-nav-layout'];

	if ($navigation_layout == 1) {
		$nav_bg = $creativa_options['opt-navigation-color-bg'];
		if ($nav_bg != '#ffffff' && !empty($nav_bg)) {
			$c_css .= '
				#navbar, .header-bar #navbar .header-bar-container {
					background: '. $nav_bg .';
				}

				.navbar-sticky, .header-bar #sticky-header .header-bar-container {
					background: '. creativa_hexConvert($nav_bg, 0.96) .';
				}
			';
		}
	}

	if ($navigation_layout == 2) {

		function creativa_side_nav_bg() {
			global $creativa_options;

			$side_nav_bg = $creativa_options['opt-navigation-side-bg'];
			$c_css = '';

			if (!empty($side_nav_bg['background-color']) && $side_nav_bg['background-color'] != '#ffffff') {
				$c_css .= '
					background-color: '. $side_nav_bg['background-color'] .';
				';
			}
			if (!empty($side_nav_bg['background-image'])) {
				$c_css .= '
					background-image: url('. $side_nav_bg['background-image'] .');
				';

				if (!empty($side_nav_bg['background-repeat'])) {
					$c_css .= '
						background-repeat: '. $side_nav_bg['background-repeat'] .';
					';
				}
				if (!empty($side_nav_bg['background-size'])) {
					$c_css .= '
						background-size: '. $side_nav_bg['background-size'] .';
					';
				}
				if (!empty($side_nav_bg['background-attachment'])) {
					$c_css .= '
						background-attachment: '. $side_nav_bg['background-attachment'] .';
					';
				}
				if (!empty($side_nav_bg['background-position'])) {
					$c_css .= '
						background-position: '. $side_nav_bg['background-position'] .';
					';
				}
			}

			return $c_css;
		}

		if (creativa_side_nav_bg()) {
			$c_css .= '
				.nav-layout-side .nav-side {
					'. creativa_side_nav_bg() .'
				}
			';
		}

		if ($creativa_options['opt-navigation-side-overlay'] == 1) {
			$nav_side_overlay_color = $creativa_options['opt-navigation-side-overlay-color'];

			if ($nav_side_overlay_color['color'] != '#000000' || $nav_side_overlay_color['alpha'] != 0.2) {
				$c_css .= '
					.nav-layout-side .nav-side__overlay {
						background: '. $nav_side_overlay_color['rgba'] .';
					}
				';
			}
		}
	}

	$nav_bar_border = $creativa_options['opt-navbar-border'];
	if (!empty($nav_bar_border) && !empty($nav_bar_border['rgba']) && ($nav_bar_border['color'] != '#000000' || $nav_bar_border['alpha'] != '0.05')) {
		if ($navigation_layout == 1) {
			$c_css .= '
				#navbar {
					-moz-box-shadow: 0 1px 0 '. $nav_bar_border['rgba'] .';
	 				-webkit-box-shadow: 0 1px 0 '. $nav_bar_border['rgba'] .';
	  				box-shadow: 0 1px 0 '. $nav_bar_border['rgba'] .';
				}
			';

		} 


		if ($navigation_layout == 2) {
			if ($creativa_options['opt-nav-side-position'] == 1) { // left
				$c_css .= '
					.nav-layout-side.nav-layout-side--left .nav-side {
						-moz-box-shadow: 1px 0 0 '. $nav_bar_border['rgba'] .';
					    -webkit-box-shadow: 1px 0 0 '. $nav_bar_border['rgba'] .';
					    box-shadow: 1px 0 0 '. $nav_bar_border['rgba'] .';
					}
				';
			}
			if ($creativa_options['opt-nav-side-position'] == 2) { // right
				$c_css .= '
					.nav-layout-side.nav-layout-side--right .nav-side {
						-moz-box-shadow: -1px 0 0 '. $nav_bar_border['rgba'] .';
					    -webkit-box-shadow: -1px 0 0 '. $nav_bar_border['rgba'] .';
					    box-shadow: -1px 0 0 '. $nav_bar_border['rgba'] .';
					}
				';
			}
		}

	}

	// Separators
	$separators_color = $creativa_options['opt-navigation-separator-color'];

	if ($creativa_options['opt-nav-separators'] == 1) {
		if (isset($separators_color['rgba']) && !empty($separators_color) && ($separators_color['color'] != '#000000' || $separators_color['alpha'] != 0.15)) {
			if ($navigation_layout == 1) {
				$c_css .= '
					.with-nav-separators .navbar-inner {
						border-color: '. $separators_color['rgba'] .';
					}
				';
			}
			if ($navigation_layout == 2) {
				$c_css .= '
					.nav-side.with-nav-separators .nav-side__logo,
					.nav-side .nav-icons ul li a,
					.nav-layout-side .nav-side__bottom--wrap input, 
					.nav-layout-side .nav-side__bottom--wrap .input-group-addon {
						border-color: '. $separators_color['rgba'] .' !important;
					}
				';
			}
		}
	}

	// main-nav
	$nav_menu_colors = $creativa_options['opt-navigation-color'];
	if (!empty($nav_menu_colors['regular']) && $nav_menu_colors['regular'] != '#3e3e3e') {
		$c_css .= '
			.main-nav ul li a,
			.nav-side__mobile-menu {
				color: '.$nav_menu_colors['regular'].';
			}
		';

		if ($navigation_layout == 2) {
			$c_css .= '
				.sidebar-nav ul li a,
				.nav-layout-side .nav-side__bottom--wrap input, 
				.nav-layout-side .nav-side__bottom--wrap .input-group-addon {
					color: '.$nav_menu_colors['regular'].';
				}
			';
		}
	}
	if (!empty($nav_menu_colors['hover']) && $nav_menu_colors['hover'] != '#919191') {
		$c_css .= '
			.main-nav ul li > a:hover, 
			.main-nav ul li > a:focus,
			.main-nav ul li:hover > a,
			.main-nav div > ul > .current-menu-ancestor > a:hover,
			.main-nav div > ul > .current-menu-item > a:hover,
			.nav-icons ul li:hover > a .menu-a-inner .nav__cart-subtotal,
			.nav-icons ul li > a .menu-a-inner .nav__cart-subtotal {
				color: '.$nav_menu_colors['hover'].';
			}
		';

		if ($navigation_layout == 2) {
			$c_css .= '
				.sidebar-nav ul li a:hover,
				.sidebar-nav ul li:hover > a {
					color: '.$nav_menu_colors['hover'].';
				}
			';
		}
	}
	if (!empty($nav_menu_colors['active']) && $nav_menu_colors['active'] != '#ffffff') {
		$c_css .= '
			.main-nav div > ul > .current-menu-ancestor > a, 
			.main-nav div > ul > .current-menu-item > a,
			.main-nav div > ul > .current-menu-ancestor > a span,
			.main-nav div > ul > .current-menu-item > a span {
				color: '.$nav_menu_colors['active'].';
			}
		';

		if ($navigation_layout == 2) {
			$c_css .= '
				.sidebar-nav div > ul > .current-menu-ancestor > a,
				.sidebar-nav div > ul > .current-menu-item > a,
				.main-nav div > ul > .current-menu-ancestor > a span,
				.main-nav div > ul > .current-menu-item > a span {
					color: '.$nav_menu_colors['active'].';
				}
			';
		}
	}

	$nav_link_active_bg = $creativa_options['opt-navigation-color-active-bg'];
	// print_r($nav_link_active_bg);
	if ($nav_link_active_bg['color'] != '#111111' || $nav_link_active_bg['alpha'] != 1) {
		$c_css .= '
			.main-nav div > ul > .current-menu-ancestor > a span,
			.main-nav div > ul > .current-menu-item > a span  {
				background: '. $nav_link_active_bg['rgba'] .';
			}
		';

		if ($nav_link_active_bg['alpha'] == 0) {
			$c_css .= '
				.main-nav div > ul > .current-menu-ancestor > a span,
				.main-nav div > ul > .current-menu-item > a span,
				#sticky-header .main-nav div>ul>.current-menu-ancestor>a span, 
				#sticky-header .main-nav div>ul>.current-menu-item>a span {
					background: transparent !important;
					padding: 0;
					-moz-border-radius: 0;
				    -webkit-border-radius: 0;
				    border-radius: 0;
				}
			';
		}

		if ($navigation_layout == 2) {
			$c_css .= '
				.sidebar-nav div > ul > .current-menu-ancestor > a span,
				.sidebar-nav div > ul > .current-menu-item > a span {
					background: '. $nav_link_active_bg['rgba'] .';
				}
			';

			if ($nav_link_active_bg['alpha'] == 0) {
				$c_css .= '
					.sidebar-nav div > ul > .current-menu-ancestor > a span,
					.sidebar-nav div > ul > .current-menu-item > a span {
						background: transparent;
						padding: 0;
						-moz-border-radius: 0;
					    -webkit-border-radius: 0;
					    border-radius: 0;
					}
				';
			}
		}
	}

	if ($navigation_layout == 1) {
		$navigation_padding = $creativa_options['opt-navigation-padding'];
		if ((isset($navigation_padding['width']) && $navigation_padding['width'] != 15) || (isset($navigation_padding['units']) && $navigation_padding['units'] != 'px')) {
			$c_css .= '
				.main-nav ul li a {
					padding: 0 '. $navigation_padding['width'] .';
				}
			';
		}
	}
	if ($navigation_layout == 2) {
		$navigation_padding = $creativa_options['opt-navigation-side-padding'];
		if ((isset($navigation_padding['height']) && $navigation_padding['height'] != 10) || (isset($navigation_padding['units']) && $navigation_padding['units'] != 'px')) {
			$c_css .= '
				.nav-side .main-nav ul li > a,
				.nav-side .sidebar-nav ul li > a {
					padding: '. $navigation_padding['height'] .' 40px;
				}
			';
		}
	}

	$submenu_padding = $creativa_options['opt-navigation-submenu-padding'];
	if ((isset($submenu_padding['width']) && $submenu_padding['width'] != 15) || (isset($submenu_padding['height']) && $submenu_padding['height'] != 10) || (isset($submenu_padding['units']) && $submenu_padding['units'] != 'px')) {
		$c_css .= '
			.main-nav ul li ul li a,
			.nav-side .main-nav ul li ul li a {
				padding: '. $submenu_padding['height'] .' '. $submenu_padding['width'] .';
			}
		';
	}



	// submenu
	$nav_submenu_bg = $creativa_options['opt-navigation-submenu-color-bg'];
	if (!empty($nav_submenu_bg) && $nav_submenu_bg != '#111111') {
		$c_css .= '
			.main-nav ul li ul {
				background: '. $nav_submenu_bg .';
			}
		';
	}
			
	
	$nav_submenu_colors = $creativa_options['opt-navigation-submenu-color'];
	if (!empty($nav_submenu_colors['regular']) && $nav_submenu_colors['regular'] != '#ffffff') {
		$c_css .= '
			.main-nav ul li ul li a,
			.nav-icons ul li .nav-shopping-cart li p.total .amount,
			.nav-icons ul li .nav-shopping-cart {
				color: '.$nav_submenu_colors['regular'].';
			}

			.main-nav ul .creativa-mega-menu > ul > li > a,
			.main-nav ul .creativa-mega-menu > ul .menu-header > a {
				color: '.$nav_submenu_colors['regular'].' !important;
			}
		';
	}
	if (!empty($nav_submenu_colors['hover']) && $nav_submenu_colors['hover'] != '#21ce99') {
		$c_css .= '
			.main-nav ul li ul li a:hover,
			.main-nav ul li:hover ul li:hover > a {
				color: '.$nav_submenu_colors['hover'].';
			}
		';
	}

	$nav_submenu_border = $creativa_options['opt-navigation-submenu-border'];
	if (!empty($nav_submenu_border) && ($nav_submenu_border['color'] != '#ffffff' || $nav_submenu_border['alpha'] != 0.1)) {
		$c_css .= '
			.main-nav ul li ul li a,
			.main-nav ul li ul li:last-child ul li a,
			.main-nav ul .creativa-mega-menu > ul > li > a span,
			.main-nav ul .creativa-mega-menu > ul .menu-header > a span,
			.nav-icons ul li .nav-shopping-cart li .product_list_widget li:not(.empty) {
				border-bottom-color: '. $nav_submenu_border['rgba'] .';
			}

			.nav-icons ul li .nav-shopping-cart li .product_list_widget li:not(.empty) {
				background-color: '. $nav_submenu_border['rgba'] .';
			}
		';
	}

	$stickyh_bg_transparency = $creativa_options['opt-stickyh-transparency'];
	$stickyh_bg_alpha = $stickyh_bg_transparency / 100;

	if ($stickyh_bg_transparency != 96) {
		$c_css .= '
			#sticky-header, .header-bar #sticky-header .header-bar-container {
				background: '. creativa_hexConvert($nav_bg, $stickyh_bg_alpha) .';
			}
		';
	}


	// Sticky Header
	if ($creativa_options['opt-show-sticky-header'] == 1) {
		if ($creativa_options['opt-stickyh-settings'] == 2) {
			$stickyh_bg = $creativa_options['opt-stickyheader-bg'];
			$stickyh_links = $creativa_options['opt-stickyh-color'];

			$stickyh_link_active_bg = $creativa_options['opt-stickyh-color-active-bg'];

			$c_css .= '
				#sticky-header, .header-bar #sticky-header .header-bar-container {
					background: '. creativa_hexConvert($stickyh_bg, $stickyh_bg_alpha) .';
				}
			';

			if (!empty($stickyh_links)) {
				$c_css .= '
					#sticky-header .main-nav ul li a {
						color: '.$stickyh_links['regular'].';
					}

					#sticky-header .main-nav ul li > a:hover, 
					#sticky-header .main-nav ul li > a:focus,
					#sticky-header .main-nav ul li:hover > a,
					#sticky-header .main-nav div > ul > .current-menu-ancestor > a:hover,
					#sticky-header .main-nav div > ul > .current-menu-item > a:hover,
					#sticky-header .nav-icons ul li:hover > a .menu-a-inner .nav__cart-subtotal,
					#sticky-header .nav-icons ul li > a .menu-a-inner .nav__cart-subtotal {
						color: '.$stickyh_links['hover'].';
					}

					#sticky-header .main-nav div > ul > .current-menu-ancestor > a,
					#sticky-header .main-nav div > ul > .current-menu-item > a,
					#sticky-header .main-nav div > ul > .current-menu-ancestor > a span,
					#sticky-header .main-nav div > ul > .current-menu-item > a span {
						color: '.$stickyh_links['active'].';
					}
					
					#sticky-header .main-nav ul li ul li a,
					#sticky-header .nav-icons ul li .nav-shopping-cart li p.total .amount {
						color: '.$nav_submenu_colors['regular'].';
					}

					#sticky-header .main-nav ul .creativa-mega-menu > ul > li > a,
					#sticky-header .main-nav ul .creativa-mega-menu > ul .menu-header > a {
						color: '.$nav_submenu_colors['regular'].' !important;
					}

					#sticky-header .main-nav ul li ul li a:hover,
					#sticky-header .main-nav ul li:hover ul li:hover > a {
						color: '.$nav_submenu_colors['hover'].';
					}
				';
			}

			if (isset($stickyh_link_active_bg['rgba']) && !empty($stickyh_link_active_bg)) {
				$c_css .= '
					#sticky-header .main-nav div > ul > .current-menu-ancestor > a span,
					#sticky-header .main-nav div > ul > .current-menu-item > a span {
						background: '. $stickyh_link_active_bg['rgba'] .';
					}
				';

			}





			$stickyh_bar_border = $creativa_options['opt-stickyheader-border-color'];
			if (isset($stickyh_bar_border['rgba'])) {

				$c_css .= '
					.navbar-sticky {
						-moz-box-shadow: 0 1px 0 '. $stickyh_bar_border['rgba'] .';
					    -webkit-box-shadow: 0 1px 0 '. $stickyh_bar_border['rgba'] .';
					    box-shadow: 0 1px 0 '. $stickyh_bar_border['rgba'] .';
					}
				';
			}

			$stickyh_separators = $creativa_options['opt-stickyheader-separator-color'];
			if ($creativa_options['opt-nav-separators'] == 1 && isset($stickyh_separators['rgba'])) {
				$c_css .= '
					#sticky-header.with-nav-separators .navbar-inner {
						border-color: '. $stickyh_separators['rgba'] .';
					}
				';
			} 


		}
	}


	// Full Width Navigation
	$fw_style = $creativa_options['opt-secondary-nav-style'];

	if ($navigation_layout == 1) {

		if ($fw_style == 1) {
			$fw_sidebar_bg = $creativa_options['opt-fwnav-sidebar-background'];
			if (!empty($fw_sidebar_bg) && $fw_sidebar_bg != '#ffffff') {
				$c_css .= '
					.sidebar-nav-wrap {
						background: '. $fw_sidebar_bg .';
					}
				';
			}

			$fw_sidebar_links = $creativa_options['opt-fwnav-sidebar-links'];
			if (!empty($fw_sidebar_links['regular']) && $fw_sidebar_links['regular'] != '#3e3e3e') {
				$c_css .= '
					.sidebar-nav ul li a,
					.sidebar-nav-wrap,
					.sidebar-nav-wrap .widget .widgettitle,
					.sidebar-nav-wrap a {
						color: '. $fw_sidebar_links['regular'] .';
					}
				';
			}
			if (!empty($fw_sidebar_links['hover']) && $fw_sidebar_links['hover'] != '#919191') {
				$c_css .= '
					.sidebar-nav ul li a:hover,
					.sidebar-nav ul li:hover > a,
					.sidebar-nav-wrap a:hover {
						color: '. $fw_sidebar_links['hover'] .';
					}
				';
			}
			if (!empty($fw_sidebar_links['active']) && $fw_sidebar_links['active'] != '#ffffff') {
				$c_css .= '
					.sidebar-nav div > ul > .current-menu-ancestor > a,
					.sidebar-nav div > ul > .current-menu-item > a,
					.sidebar-nav div > ul > .current-menu-ancestor > a span,
					.sidebar-nav div > ul > .current-menu-item > a span {
						color: '. $fw_sidebar_links['active'] .';
					}
				';
			}

			$fw_sidebar_active_bg = $creativa_options['opt-fwnav-sidebar-links-active'];
			// print_r($fw_sidebar_active_bg);
			if ($fw_sidebar_active_bg['color'] != '#111111' || $fw_sidebar_active_bg['alpha'] != 1) {
				$c_css .= '
					.sidebar-nav div > ul > .current-menu-ancestor > a span,
					.sidebar-nav div > ul > .current-menu-item > a span {
						background: '. $fw_sidebar_active_bg['rgba'] .';
					}
				';
			}

			$mobile_nav_overlay = $creativa_options['opt-fwnav-overlay-side'];

			if ($mobile_nav_overlay['color'] != '#000000' || $mobile_nav_overlay['alpha'] != 0.2) {
				$c_css .= '
					.sidebar-navigation .sec-nav-overlay {
						background: '. $mobile_nav_overlay['rgba'] .';
					}
				';
			}
		}
		elseif ($fw_style == 2) {
			$fw_full_links = $creativa_options['opt-fwnav-fw-links'];
			if (!empty($fw_full_links['regular']) && $fw_full_links['regular'] != '#ffffff') {
				$c_css .= '
					.full-nav ul li a {
						color: '. $fw_full_links['regular'] .';
					}
				';
			}
			if (!empty($fw_full_links['hover']) && $fw_full_links['hover'] != '#21ce99') {
				$c_css .= '
					.full-nav ul li a:hover,
					 .full-nav ul li:hover > a{
						color: '. $fw_full_links['hover'] .';
					}
				';
			}
			if (!empty($fw_full_links['active']) && $fw_full_links['active'] != '#21ce99') {
				$c_css .= '
					.full-nav div > ul > .current-menu-ancestor > a,
					.full-nav div > ul > .current-menu-item > a {
						color: '. $fw_full_links['active'] .';
					}
				';
			}

			$mobile_nav_overlay = $creativa_options['opt-fwnav-overlay-full'];
			if ($mobile_nav_overlay['color'] != '#000000' || $mobile_nav_overlay['alpha'] != 0.8) {
				$c_css .= '
					.full-navigation .sec-nav-overlay {
						background: '. $mobile_nav_overlay['rgba'] .';
					}
				';
			}

			$fw_full_links_padding = $creativa_options['opt-fwnav-fw-padding'];
			if ((isset($fw_full_links_padding['height']) && $fw_full_links_padding['height'] != 25) || (isset($fw_full_links_padding['units']) && $fw_full_links_padding['units'] != 'px')) {
				$c_css .= '
					.full-nav ul li a {
						padding: '. $fw_full_links_padding['height'] .' 0;
					}
				';
			}
		}
	
	}


	// Top Bar
	if ($creativa_options['opt-show-top-bar'] == 1) {
		$top_bar_bg = $creativa_options['opt-topbar-background'];
		if (!empty($top_bar_bg) && $top_bar_bg != '#ffffff') {
			$c_css .= '
				#top-bar {
					background: '. $top_bar_bg .';
				}
			';
		}

		$top_bar_color = $creativa_options['opt-topbar-color'];
		if (!empty($top_bar_color) && $top_bar_color != '#aaaaaa') {
			$c_css .= '
				#top-bar {
					color: '. $top_bar_color .';
				}
			';
		}

		$top_bar_links = $creativa_options['opt-topbar-links'];
		if (!empty($top_bar_links['regular'])) {
			$c_css .= '
				#top-bar a,
				#top-bar .woo-settings-cog, 
				#top-bar .woo-settings-login {
					color: '. $top_bar_links['regular'] .';
				}
			';
		}
		if (!empty($top_bar_links['hover'])) {
			$c_css .= '
				#top-bar a:hover {
					color: '. $top_bar_links['hover'] .';
				}
			';
		}

		$top_bar_border = $creativa_options['opt-topbar-border-color'];

		if ($top_bar_border['color'] != '#000000' || $top_bar_border['alpha'] != 0.05) {
			$c_css .= '
				#top-bar {
					border-bottom: 1px solid '. $top_bar_border['rgba'] .';
				}

				#top-bar .woo-settings {
					background: '. $top_bar_border['rgba'] .';
				}
			';
		}
	}


	// Blog
	$blog_header_links = $creativa_options['opt-blog-heading-color'];
	$blog_cats_color = $creativa_options['opt-blog-cats-color'];
	$blog_entry_color = $creativa_options['opt-blog-info-color'];

	if ($blog_header_links['regular'] != '#111111') {
		$c_css .= '
			.blog-header .post-title a {
				color: '. $blog_header_links['regular'] .';
			}
		';
	}
	if ($blog_header_links['hover'] != '#21ce99') {
		$c_css .= '
			.blog-header .post-title a:hover {
				color: '. $blog_header_links['hover'] .';
			}
		';
	}

	if ($blog_cats_color != '#111111') {
		$c_css .= '
			.single__entry-info--categories a {
				color: '. $blog_cats_color .';
			}
		';
	}

	if ($blog_entry_color != '#6a6a6a') {
		$c_css .= '
			.entry-info {
				color: '. $blog_entry_color .';
			}
		';
	}

	// Portfolio
	if (is_page_template('portfolio.php') || (is_a( $post, 'WP_Post' ) && (has_shortcode( $post->post_content, 'loprd_portfolio') || has_shortcode( $post->post_content, 'loprd_projects')))) {
		$portfolio_item_style = $creativa_options['opt-portfolio-style'];


		$portfolio12_heading_color = $creativa_options['opt-portfolio1-heading-color'];
		$portfolio12_thumb_color = $creativa_options['opt-portfolio-th-over'];

		if ($portfolio12_heading_color != '#ffffff') {
			$c_css .= '
				.portfolio__style--onhover .portfolio-item a .portfolio_hover--meta,
				.portfolio__style--overlay .portfolio-item a .portfolio_hover--meta {
					color: '. $portfolio12_heading_color .';
				}
			';
		}

		if ($portfolio12_thumb_color['color'] != '#000000' || $portfolio12_thumb_color['alpha'] != 0.2) {
			$c_css .= '
				.portfolio__style--onhover .portfolio-item a .portfolio_hover,
				.portfolio__style--overlay .portfolio-item a .portfolio_hover {
					background-color: '. $portfolio12_thumb_color['rgba'] .';
				}
			';
		} 
		$portfolio3_heading_color = $creativa_options['opt-portfolio3-heading-color'];
		$portfolio3_heading_bg = $creativa_options['opt-portfolio3-heading-bg'];

		if ($portfolio3_heading_color != '#111111') {
		 	$c_css .= '
		 		.portfolio__style--bottom .portfolio-item a .portfolio_hover--meta {
		 			color: '. $portfolio3_heading_color .';
		 		}
		 	';
		}
		if ($portfolio3_heading_bg['color'] != '#ffffff' || $portfolio3_heading_bg['alpha'] != 1) {
		 	$c_css .= '
		 		.portfolio__style--bottom .portfolio-item a .portfolio_hover--meta {
		 			background-color: '. $portfolio3_heading_bg['rgba'] .';
		 		}
		 	';
		}

		$portfolio_filter_color = $creativa_options['opt-portfolio-filters-color'];
		$portfolio_filter_color_active = $creativa_options['opt-portfolio-filters-color-active'];
		$portfolio_sorting_color = $creativa_options['opt-portfolio-sorting-color'];
		
		
		if ($portfolio_filter_color != '#bbbbbb') {
			$c_css .= '
				.filters > .project--filters > a {
					color: '. $portfolio_filter_color .';
				}
			';
		}
		
		if ($portfolio_filter_color_active != '#111111') {
			$c_css .= '
				.filters > .project--filters .active {
					color: '. $portfolio_filter_color_active .';
				}
			';
		}
		if ($portfolio_sorting_color != '#21ce99') {
			$c_css .= '
				.project--sorting > a {
					color: '. $portfolio_sorting_color .';
				}
			';
		}
	}


	// Footer 
	if ($creativa_options['opt-footer-widget-area'] == 1) { 
		$footer_w_bg = $creativa_options['opt-footer-widgets-bg'];
		if ($footer_w_bg != '#252525') {
			$c_css .= '
				#footer-widget-area,
				#footer-widget-area .widget_recent_posts_tab .tab-content,
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a, 
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a:hover, 
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a:focus {
					background: '. $footer_w_bg .';
				}
			';
		}

		$footer_w_heading = $creativa_options['opt-footer-widgets-heading'];
		if ($footer_w_heading != '#696969') {
			$c_css .= '
				#footer-widget-area .widget .widgettitle {
					color: '. $footer_w_heading .';
				}
			';
		}

		$footer_w_color = $creativa_options['opt-footer-widgets-text'];
		if ($footer_w_color != '#a0a0a0') {
			$c_css .= '
				#footer-widget-area {
					color: '. $footer_w_color .';
				}
			';
		}

		$footer_w_links = $creativa_options['opt-footer-widgets-links'];
		if ($footer_w_links['regular'] != '#a0a0a0') {
			$c_css .= '
				#footer-widget-area a {
					color: '. $footer_w_links['regular'] .';
				}
			';
		}
		if ($footer_w_links['hover'] != '#a0a0a0') {
			$c_css .= '
				#footer-widget-area a:hover {
					color: '. $footer_w_links['hover'] .';
				}
			';
		}

		$footer_w_widgets_border = $creativa_options['opt-footer-widgets-widget-border'];
		if ($footer_w_widgets_border['color'] != '#ffffff' || $footer_w_widgets_border['alpha'] != 0.14) {
			$c_css .= '
				#footer-widget-area .widget_calendar #wp-calendar caption,
				#footer-widget-area .widget_calendar #calendar_wrap,
				#footer-widget-area .widget_calendar #wp-calendar thead,
				#footer-widget-area input, #footer-widget-area textarea, 
				#footer-widget-area select, 
				#footer-widget-area .select2-container .select2-choice,
				#footer-widget-area .widget_recent_posts_tab .tab-content,
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a, 
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a:hover, 
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li.active > a:focus,
				#footer-widget-area .widget_recent_posts_tab .nav > li > a,
				#footer-widget-area .input-group-addon {
					border-color: '. $footer_w_widgets_border['rgba'] .' !important;
				}
				#footer-widget-area .widget_recent_posts_tab .nav-tabs > li:last-child > a {
					border-color: '. $footer_w_widgets_border['rgba'] .' !important;
				}
			';
		}

		$footer_w_borders = $creativa_options['opt-footer-widgets-border'];
		if ($footer_w_borders['border-bottom'] != '0px' || $footer_w_borders['border-top'] != '0px' || $footer_w_borders['border-style'] != 'none' || $footer_w_borders['border-color'] != '#3a3a3a' ) {
			$c_css .= '
				#footer-widget-area {
					border-bottom: '. $footer_w_borders['border-bottom'] .' '. $footer_w_borders['border-style'] .' '. $footer_w_borders['border-color'] .';
					border-top: '. $footer_w_borders['border-top'] .' '. $footer_w_borders['border-style'] .' '. $footer_w_borders['border-color'] .';
				}
			';
		}
	}

	$footer_c_bg = $creativa_options['opt-footer-copyrights-bg'];
	if ($footer_c_bg != '#1c1c1c') {
		$c_css .= '
			#copyrights,
			#lang_sel_footer {
				background: '. $footer_c_bg .';
			}
		';
	}

	$footer_c_color = $creativa_options['opt-footer-copyrights-text'];
	if ($footer_c_color != '#999999') {
		$c_css .= '
			#copyrights,
			#lang_sel_footer {
				color: '. $footer_c_color .';
			}
		';
	}

	$footer_c_links = $creativa_options['opt-footer-copyrights-links'];
	if ($footer_c_links['regular'] != '#cccccc') {
		$c_css .= '
			#copyrights a,
			#lang_sel_footer a {
				color: '. $footer_c_links['regular'] .';
			}
		';
	}
	if ($footer_c_links['hover'] != '#cccccc') {
		$c_css .= '
			#copyrights a:hover,
			#lang_sel_footer a:hover {
				color: '. $footer_c_links['hover'] .';
			}
		';
	}


	// Widgets
	$widgets_links = $creativa_options['opt-widgets-links'];
	if (!empty($widgets_links['regular']) && $widgets_links['regular'] != '#9a9a9a') {
		$c_css .= '
			.widget a {
				color: '. $widgets_links['regular'] .';
			}
		';
	}
	if (!empty($widgets_links['hover']) && $widgets_links['hover'] != '#9a9a9a') {
		$c_css .= '
			.widget a:hover {
				color: '. $widgets_links['hover'] .';
			}
		';
	}



	// Misc 
	$form_text = $creativa_options['opt-misc-form-text'];
	if ($form_text != '#111111') {
		$c_css .= '
			input, textarea, select, select option, textarea,
			.input-group-addon,
			.woocommerce-checkout input, 
			.woocommerce-checkout .select2-container 
			.select2-choice, .woocommerce-checkout textarea {
				color: '. $form_text .';
			}
		';
	}

	$form_bg = $creativa_options['opt-misc-form-bg'];
	if ($form_bg['color'] != '#ffffff' || $form_bg['alpha'] != 1) {
		$c_css .= '
			input, textarea, select, select option, textarea,
			.input-group-addon,
			.woocommerce-checkout input, 
			.woocommerce-checkout .select2-container 
			.select2-choice, .woocommerce-checkout textarea {
				background: '. $form_bg['rgba'] .';
			}
		';
	}

	$form_border = $creativa_options['opt-misc-form-border'];
	if ($form_border['color'] != '#000000' || $form_border['alpha'] != 0.13) {
		$c_css .= '
			input, textarea, select, select option, textarea,
			.input-group-addon,
			.woocommerce-checkout input, 
			.woocommerce-checkout .select2-container 
			.select2-choice, .woocommerce-checkout textarea {
				border-color: '. $form_border['rgba'] .' !important;
			}
		';
	}








	// options custom css
	$creativa_custom_css = $creativa_options['opt-ace-editor-css'];
	if ($creativa_custom_css) {
		$c_css .= $creativa_custom_css;
	}

	// meta options custom css
	$creativa_custom_meta_css = $creativa_options['opt-meta-ace-editor-css'];
	if ($creativa_custom_meta_css) {
		$c_css .= $creativa_custom_meta_css;
	}


	return creativa_minify(sanitize_text_field($c_css));
}



function creativa_custom_styles() {
	wp_enqueue_style(
		'custom-style',
		get_template_directory_uri() . '/css/custom-style.css'
	);

$custom_css = creativa_custom_style_inline();

        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'creativa_custom_styles', 999 );

?>