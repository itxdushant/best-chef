<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'carousel_arrows_pos' => 'none',
    'navigation' => 'bullets',
    'transition' => 'move',
    'autoplay' => 0,
    'slides_gap' => 30,
    'bullets_color' => 'dark',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));

if ($carousel_arrows_pos == 'sides') {
	$arrow_pos_class = 'rsNavOuter ';
} 
elseif ($carousel_arrows_pos == 'top' ) {
	$arrow_pos_class = 'rsNavTop ';
}
elseif ($carousel_arrows_pos = 'none') {
    $arrow_pos_class = 'rsNoArrows ';
}

$navigation_attr = 'data-carousel-nav="none" ';
if ($navigation == 'bullets') {
	$navigation_attr = 'data-carousel-nav="bullets"';
}

$carousel_custom_bg = '';

$bullets_style_class = '';
if ($navigation == 'bullets') {
    $bullets_style_class = 'rsBulletsDark';

    if ($bullets_color == 'light') {
        $bullets_style_class = 'rsBulletsLight';
    }
}

?>


<div class="loprd_shortcode_carousel content-carousel royalSlider rsCreativa <?php echo esc_attr($bullets_style_class) ?> <?php echo esc_attr($arrow_pos_class) . creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo ''.$navigation_attr // var escaped ?> data-autoplay="<?php echo intval($autoplay) ?>" data-transition="<?php echo esc_attr($transition) ?>" data-gap="<?php echo esc_attr($slides_gap) ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay) ?>>
	<?php echo wpb_js_remove_wpautop($content); //Parse inner shortcodes ?>
</div>


