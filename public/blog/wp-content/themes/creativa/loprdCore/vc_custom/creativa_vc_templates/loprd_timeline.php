<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'timeline_style' => 'center',
    'line_color' => '',
    'line_icons' => '',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$timeline_class = '';
if ($timeline_style == 'left') {
	$timeline_class = 'timeline-left ';
}
elseif ($timeline_style == 'center') {
	$timeline_class = 'timeline-center timeline-hidden ';
}
elseif ($timeline_style == 'right') {
	$timeline_class = 'timeline-right ';
}

$line_style = '';
if (!empty($line_color) || !empty($line_icons)) {
	$line_style .= 'style="';
	if (!empty($line_color)) {
		$line_style .= 'background-color:'. esc_attr($line_color) .';';
	}
	if (!empty($line_icons)) {
		$line_style .= 'color:'. esc_attr($line_icons) .';';
	}
	$line_style .= '"';
}

?>
<div class="loprd_timeline_wrapper <?php echo esc_attr($timeline_class) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="timeline_line" <?php echo ''.$line_style; // var escaped ?>></div>
	<div class="timeline-stamp"></div>
	<?php echo wpb_js_remove_wpautop($content); //Parse inner shortcodes ?>
</div> <!-- Timeline End -->