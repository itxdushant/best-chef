<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'pt_style' => 'pricing-table--bordered',
    'pt_alignment' => 'pricing-table--center',
    'border_color' => '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$border_color_style = '';
if (!empty($border_color) && $pt_style == 'pricing-table--bordered') {
	$border_color_style = 'style="border-color:'. esc_attr($border_color) .';"';
}

?>
<div class="loprd-pricing-table <?php echo esc_attr($pt_style) .' '. esc_attr($pt_alignment) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo ''.$border_color_style // var escaped ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<?php echo wpb_js_remove_wpautop($content); //Parse inner shortcodes ?>
</div>