<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'date' => '2017/02/14',
    'formatter' => '%D %!D:day,days; %-H h %M min %S sec',
    'align' => 'loprd-countdown--left',
    'color' => '',
    'size' => 'hero',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$color_style = '';
if (!empty($color)) {
	$color_style = 'style="color:'. esc_attr($color) .'" ';
}

?>
<div class="loprd-shortcode-countdown <?php echo esc_attr($align) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="loprd-countdown heading <?php echo esc_attr($size) ?>" data-countdown="<?php echo esc_attr($date) ?>" data-formatter="<?php echo esc_attr($formatter) ?>" <?php echo ''.$color_style // var escaped ?>>0</div>
</div>