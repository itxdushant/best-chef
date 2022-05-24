<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $css_animation = $css = '';

extract( shortcode_atts( array(
	'title' => '',
	'image' => $image,
	'img_size' => 'full',
	// 'img_link_large' => '',
	'image_link' => 'none',
	// 'img_link' => '',
	'link' => '',
	'img_link_target' => '_self',
	'alignment' => 'left',
	'el_class' => '',

	'css_animation' => '',
    'css_animation_delay' => '',

	'style' => '',
	'hide_overlay' => '',
	'css' => ''
), $atts ) );

$style = ( $style != '' ) ? $style : '';

$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => $style) );
if ( $img == NULL ) $img['thumbnail'] = '<img class="' . $style. '" src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';

$el_class = $this->getExtraClass( $el_class );

if ($hide_overlay == 'hide') {
	$style .= ' no_overlay ';
}

$hover_link = vc_build_link($link);

$a_class = '';
$mfp_data = '';
if ($hover_link['target'] == '' && empty($hover_link['url'])) {
	$a_class = ' class="magnpopup '.$style.'"';
	$mfp_data = 'data-effect="mfp-zoom-in" ';
}

$link_to = '';
if ( $image_link == 'full_image' ) {
	$link_to = wp_get_attachment_image_src( $img_id, 'full' );
	$link_to = $link_to[0];
} else if ( $image_link == 'custom_link' && strlen($hover_link['url']) > 0 ) {
	$link_to = $hover_link['url'];
	$a_class = ' class="img-link '.$style.'"';
	$mfp_data = '';
} 


$img_output = $img['thumbnail'];
$link_target = (!empty($hover_link['target'])) ? 'target="'. esc_attr($hover_link['target']) .'"' : '';
$link_title = (!empty($hover_link['title'])) ? 'target="'. esc_attr($hover_link['title']) .'"' : '';
$image_string = ! empty( $link_to ) ? '<a' . $a_class . ' '. $mfp_data .' href="' . esc_url($link_to) . '"' . ' '. $link_target .' '. $link_title .'>' . $img_output . '</a>' : $img_output;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_single_image wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

$css_class .= ' vc_align_' . $alignment;

$output .= "\n\t" . '<div class="' . $css_class . '" '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
$output .= "\n\t\t" . '<div class="wpb_wrapper single-img-wrapper">';
$output .= "\n\t\t\t" . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_singleimage_heading' ) );

$output .= "\n\t\t\t" . $image_string;
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_single_image' );

echo ''.$output;