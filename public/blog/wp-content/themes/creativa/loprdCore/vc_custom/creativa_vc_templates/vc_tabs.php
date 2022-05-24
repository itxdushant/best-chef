<?php
$output = $title = $interval = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (!empty($tab_bg) || !empty($tab_active_color) || !empty($tabs_bg)) {
	
	if ( 'vc_tabs' == $this->shortcode ) {
		$tab_bg_style = '';
		
		if (!empty($tab_bg) || !empty($border_color)) {
			if (!empty($tab_bg)) {
				$tab_bg_style .= 'style="background:'. esc_attr($tab_bg) .'';
			}

			if ($content_border == 'loprd-tabs-nav--border' && !empty($border_color)) {
				$tab_bg_style .= ';border-color:'. esc_attr($border_color) .'';
			}

			$tab_bg_style .= '"';
		}
	} else {
		$tab_bg_style = '';
	}

	$css_active = '';
	$css_reg = '';
	if (!empty($tab_bg)) {
		$css_active .= 'background:'. esc_attr($tab_bg) .';';
	}
	if (!empty($tab_active_color)) {
		$css_active .= 'color:'. esc_attr($tab_active_color) .';';
	}
	if (!empty($tabs_bg)) {
		$css_reg .= 'background:'. esc_attr($tabs_bg) .';';
	}

	$random_class = 'tab-style-'.rand(0, 9999);

	$output .= '<style type="text/css" scoped>';
	if (!empty($tab_bg) || !empty($tab_active_color)) {
		$output .= '.'.$random_class.'>li.ui-tabs-active>a {'. $css_active .'}';
	}
	if (!empty($tabs_bg)) {
		$output .= '.'.$random_class.'>li:not(.ui-tabs-active)>a {'. $css_reg .'}';
	}

	$output .= '</style>';

} else {
	$tab_bg_style = '';
	$random_class = '';
}

$border_color_style = '';
if ( !empty($border_color) ) {
	$border_color_style = 'style="border-color: '. esc_attr($border_color) .' !important;"';
}

wp_enqueue_script( 'jquery-ui-tabs' );

$el_class = $this->getExtraClass( $el_class );

$element = 'wpb_tabs ';
if ( 'vc_tabs' == $this->shortcode ) {
	$element .= $content_border;
}
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$tabs_nav .= '<ul class="wpb_tabs_nav loprd-tabs-nav ui-tabs-nav vc_clearfix '.$random_class.'">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title'])) {
		$tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" '. $border_color_style .' >' . $tab_atts['title'] . '</a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ) . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

$output .= "\n\t" . '<div class="' . $css_class . '" data-interval="' . $interval . '" '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
$output .= "\n\t\t\t" . $tabs_nav;
$output .='<div class="tab-content" '. $tab_bg_style .'>';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .='</div>';

$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

echo ''.$output;
