<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'start_value' => '0',
    'end_value' => '1000',
    'decimals' => '0',
    'speed' => '2000',
    'prefix' => '',
    'suffix' => '',
    'subtitle' => '',
    'thousand_sep' => 'space',
    'align' => 'left',
    'size' => 'hero',
    'number_color' => '',
    'subtitle_color' => '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts));

if ($align == 'left') {
	$align_class = 'counter-left ';
}
elseif ($align == 'center') {
	$align_class = 'counter-center ';
}
elseif ($align == 'right') {
	$align_class = 'counter-right ';
}

if (!empty($number_color)) {
	$number_color_style = 'style="color:'. esc_attr($number_color) .'" ';
} else {
	$number_color_style = '';
}

if (!empty($subtitle_color)) {
	$subtitle_color_style = 'style="color:'. esc_attr($subtitle_color) .'" ';
} else {
	$subtitle_color_style = '';
}

?>
<div class="loprd-shortcode-counter <?php echo esc_attr($align_class) . creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<span class="loprd-counter heading <?php echo esc_attr($size) ?>" data-speed="<?php echo esc_attr($speed) ?>" data-from="<?php echo esc_attr($start_value) ?>" data-to="<?php echo esc_attr($end_value) ?>" data-decimals="<?php echo esc_attr($decimals) ?>" data-prefix="<?php echo esc_attr($prefix) ?>" data-suffix="<?php echo esc_attr($suffix) ?>" data-separator="<?php echo esc_attr($thousand_sep) ?>" <?php echo ''.$number_color_style // var escaped ?>><?php echo esc_html($start_value) ?></span>
	<?php 
		if (!empty($subtitle)) {
			echo '<span class="loprd-counter__subtitle font-secondary" '. $subtitle_color_style .'>'. esc_html($subtitle) .'</span>';
		}
	?>
</div>