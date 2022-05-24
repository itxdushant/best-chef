<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'value' => '90',
    'duration' => '2000',
    'size' => '160',
    'thickness' => '5',
    'color_bg' => 'rgba(0,0,0,.1)',
    'color_fill' => 'color',
    'color_1' => '#111111',
    'color_2' => '#888888',
    'value_color' => '',
    'align' => 'center',
    'show_unit' => '',
    'value_text' => '',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$value_size = 'pc-large';
if ($size <= 110 && $size > 80 ) {
	$value_size = 'pc-medium';
} 
elseif ($size <= 80 ) {
    $value_size = 'pc-small';
} 

$value_color_style = '';
if ($value_color!='') {
	$value_color_style = 'style="color:'. esc_attr($value_color) .'"';
}

if ($align == 'left') {
	$align_class = 'loprd-pie-left';
}
elseif ($align == 'right') {
	$align_class = 'loprd-pie-right';
}
elseif ($align == 'center') {
	$align_class = 'loprd-pie-center';
}

$show_unit_attr = '';
if ($show_unit == 'show') {
    $show_unit_attr = 'data-unit="true" ';
}


?>
<div class="loprd-pie-chart-wrapper <?php echo esc_attr($align_class) . creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="loprd-pie-chart" data-value="<?php echo esc_attr($value) ?>" data-duration="<?php echo esc_attr($duration) ?>" data-fill="<?php echo esc_attr($color_fill) ?>" data-color1="<?php echo esc_attr($color_1) ?>" <?php echo ''.($color_fill == 'gradient' ? 'data-color2="'. esc_attr($color_2) .'"' : '') ?> data-colorbg="<?php echo esc_attr($color_bg) ?>" data-size="<?php echo esc_attr($size) ?>" data-thickness="<?php echo esc_attr($thickness) ?>" <?php echo ''.$show_unit_attr // var escaped ?> style="min-height:<?php echo esc_attr($size) ?>px;">
		<div class="loprd-pie-value-wrapper">
			<span class="heading hero <?php echo esc_attr($value_size) ?>" <?php echo ''.$value_color_style // var escaped ?>>0</span>
			<?php if ($size > 110 && !empty($value_text)) { ?><span class="loprd-pie-chart__subtitle font-secondary" <?php echo ''.$value_color_style // var escaped ?>><?php echo esc_html($value_text) ?></span><?php } ?>
		</div>
	</div>
</div>