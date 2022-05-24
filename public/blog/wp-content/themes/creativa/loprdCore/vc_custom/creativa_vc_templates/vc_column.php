<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var horizontal_align
 * @var vertical_align
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 * @var css_animation
 * @var css_animation_delay
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
    creativaAnimation($css_animation),
);

if ($horizontal_align != 'none') {
	$css_classes[] = 'creativa_column_hor_align-'. esc_attr($horizontal_align) .'';
}
if ($vertical_align != 'none') {
	$flex_row = true;
	$css_classes[] = 'creativa_column_ver_align-'. esc_attr($vertical_align) .'';
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = ' vc_column-table';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
//creativa_vc_column-inner
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' '. creativaAnimationDelay($css_animation, $css_animation_delay) .'>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo ''.$output;
