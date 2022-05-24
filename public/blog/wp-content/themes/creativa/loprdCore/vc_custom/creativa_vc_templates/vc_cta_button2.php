<?php
extract(shortcode_atts(array(
    // 'h2' => '',
    // 'h4' => '',
    // 'el_width' => '',
    // 'style' => '',
    // 'txt_align' => '',
    'bg_color' => '',
    'border_color' => '',
    'link' => '',
    'title' => esc_html__('Text on the button', 'creativa'),
    'color' => 'btn-default',
    'size' => 'btn-md',
    'btn_style' => 'btn-standard',
    'position' => 'bottom',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$class = "loprd-call-to-action wpb_content_element";

$link = ($link=='||') ? '' : $link;

$class .= ($position!='') ? ' loprd-cta-btn-pos-'.$position : '';
$class .= ($color!='') ? ' vc_cta_'.$color : '';

$inline_css = '';
if (!empty($bg_color) || !empty($border_color)) {
    $inline_css .= 'style="';
    if (!empty($bg_color)) {
        $inline_css .= vc_get_css_color('background-color', $bg_color);
    }
    if (!empty($border_color)) {
        $inline_css .= vc_get_css_color('border-color', $border_color);
    }
    $inline_css .= '"';
}


$class .= $this->getExtraClass($el_class) . vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);
?>
<div <?php echo ''.$inline_css; // var escaped ?> class="<?php echo esc_attr(trim($css_class)); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
    <?php if ($link!='' && $position!='bottom') echo do_shortcode('[vc_button2 link="'.$link.'" title="'.$title.'" color="'.$color.'" size="'.$size.'" style="'.$btn_style.'" el_class="cta-btn"]'); ?>
    <?php 
    echo '<div class="cta-content">';
    echo wpb_js_remove_wpautop($content, true); 
    echo '</div>';
    ?>
    <?php if ($link!='' && $position=='bottom') echo do_shortcode('[vc_button2 link="'.$link.'" title="'.$title.'" color="'.$color.'" size="'.$size.'" style="'.$btn_style.'" el_class="cta-btn"]'); ?>
</div>
<?php $this->endBlockComment('.vc_call_to_action') . "\n";