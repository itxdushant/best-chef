<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1',
    'acc_bg' => '',
    'acc_border' => '',
    'acc_color' => '',
    'disable_keyboard' => 'no',

    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));

if (!empty($acc_bg) || !empty($acc_color) || !empty($acc_border)) {
	$random_class = 'accordion-style-'.rand(0, 9999);

	$output .= '<style type="text/css" scoped>';
	if (!empty($acc_bg)) {
		$output .= '.'.$random_class.' .wpb_accordion_section {background:'. esc_attr($acc_bg) .';}';
	}
	if (!empty($acc_border)) {
		$output .= '.'.$random_class.' .wpb_accordion_section {border-color:'. esc_attr($acc_border) .';}';
	}
	if (!empty($acc_color)) {
		$output .= '.'.$random_class.' .wpb_accordion_section h3 a {color:'. esc_attr($acc_color) .';}';
	}
	$output .= '</style>';

} else {
	$tab_bg_style = '';
	$random_class = '';
}

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element '. esc_attr($random_class) . esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ) . ' not-column-inherit', $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

$output .= "\n\t".'<div class="'.$css_class.'" data-collapsible="'.$collapsible.'" data-vc-disable-keydown="' . ( esc_attr( ( 'yes' == $disable_keyboard ? 'true' : 'false' ) ) ) . '" data-active-tab="'.$active_tab.'" '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>'; //data-interval="'.$interval.'"
$output .= "\n\t\t".'<div class="wpb_wrapper loprd-accordion wpb_accordion_wrapper ui-accordion">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');

echo ''.$output;