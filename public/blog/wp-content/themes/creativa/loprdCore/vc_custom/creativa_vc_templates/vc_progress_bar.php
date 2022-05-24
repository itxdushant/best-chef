<?php
$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'values' => '%5B%7B%22label%22%3A%22Development%22%2C%22value%22%3A%2290%22%7D%2C%7B%22label%22%3A%22Design%22%2C%22value%22%3A%2280%22%7D%5D',
	'units' => '%',
	'bgcolor' => 'bar_grey',
	'custombgcolor' => '',
	'title_color' => '',
	'bar_bg_color' => '',
	'options' => '',
	'el_class' => '' ,
    'css' => '',
    
    'css_animation' => '',
    'css_animation_delay' => '',

), $atts ) );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = '';
$options = explode( ",", $options );
if ( in_array( "animated", $options ) ) $bar_options .= " animated";
if ( in_array( "striped", $options ) ) $bar_options .= " striped";

if ( $custombgcolor != '' ) {
	$custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor.' !important' ) . vc_get_css_color( 'color', $custombgcolor.'' ) . '"';
	$bgcolor = "";
}

$title_color_style = (!empty($title_color)) ? 'style="color:'. esc_attr($title_color) .';"' : '';
$bar_bg_style = (!empty($bar_bg_color)) ? 'style="background-color:'. esc_attr($bar_bg_color) .'!important;"' : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_progress_bar wpb_content_element' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

$output = '<div class="' . $css_class . '" '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );

$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) ? '' : $custombgcolor;
	if ( isset( $data['customcolor'] ) && ( ! isset( $data['color'] ) ) ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['customcolor'] ) . '!important; color: '. esc_attr( $data['customcolor'] ) .'"';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {
	$unit = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
	$output .= '<h6 class="vc_label"' . $title_color_style .'>' . $line['label'] /* . $unit */ .'</h6>';
	$output .= '<div class="vc_general vc_single_bar" '. $bar_bg_style .'>';
	if ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	$output .= '<span class="vc_bar " data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . esc_attr( $units ) . '"' . $line['bgcolor'] . '></span>';
	$output .= '</div>';
}

$output .= '</div>';


echo ''.$output . $this->endBlockComment( 'progress_bar' ) . "\n";