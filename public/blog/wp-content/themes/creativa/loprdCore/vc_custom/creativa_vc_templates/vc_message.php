<?php
$output = $color = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'el_class' => '',
    // 'style' => '',

    'css_animation' => '',
    'css_animation_delay' => '',

    'text_color' => '',
    'bg_color' => '',
    'text_color' => '',
    'css' => '',
), $atts));
$el_class = $this->getExtraClass($el_class);

$class = "";
$bg_color_class = '';
if ($color == 'alert-custom') {
    if (!empty($bg_color) || !empty($text_color)) {
        $bg_color_class = 'style="';
        $bg_color_class .= (!empty($bg_color)) ? 'background:'.esc_attr($bg_color).';' : '' ;
        $bg_color_class .= (!empty($text_color)) ? 'color:'.esc_attr($text_color).';' : '' ;
        $bg_color_class .= '"';
    }
}

$class .= ( $color != '' && $color != "alert-block") ? ' '.$color : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'alert ' . $class . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$css_class .= creativaAnimation($css_animation);
?>
<div class="<?php echo ''.$css_class; // var escaped ?>" <?php echo ''.$bg_color_class; // var escaped ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<?php echo wpb_js_remove_wpautop($content, true); ?>
</div>
<?php echo ''.$this->endBlockComment('alert box')."\n";