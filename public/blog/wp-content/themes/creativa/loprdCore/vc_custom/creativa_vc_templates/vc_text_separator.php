<?php
$el_class = $icon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = '';
extract(shortcode_atts(array(
    'title' => '',  

    'icon' => '',
    'icon_fontawesome' => '',
    'icon_openiconic' => '',
    'icon_typicons' => '',
    'icon_entypoicons' => '',
    'icon_linecons' => '',
    'icon_entypo' => '',
    'icon_material' => 'vc-material vc-material-cake',
    'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',

    'title_align' => 'separator_align_center',
    'el_width' => 'wide',
    'sep_position' => 'center',
    'style' => '',
    'color' => '',
    'accent_color' => '',
    'text_color' => '',
    'el_class' => '',
    'back_to_top' => '',
    // 'margin_bottom' => '', 

    'css_animation' => '',
    'css_animation_delay' => '',

    'css' => '',
), $atts));
$class = "loprd_separator wpb_content_element";

vc_icon_element_fonts_enqueue( $icon );

$class .= ($title_align!='') ? ' loprd_'.$title_align : '';
$class .= ($el_width!='') ? ' loprd_el_width_'.$el_width : '';
$class .= ($el_width!='wide') ? ' loprd_sep_position_'.$sep_position : '';
$class .= ($style!='') ? ' loprd_sep_'.$style : '';
$class .= ($back_to_top!='') ? ' loprd_sep_btt' : '';

$inline_css = ( $accent_color!='') ? ' style="'.vc_get_css_color('border-color', $accent_color).'"' : '';
$text_inline_css = ( $text_color!='') ? ' style="'.vc_get_css_color('color', $text_color).'"' : '';

$class .= $this->getExtraClass($el_class) . vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
    <div class="loprd_sep_wrapper">
        <div class="loprd_sep_container">
	       <span class="loprd_sep_holder loprd_sep_holder_l"><span<?php echo ''.$inline_css; // var escaped ?> class="loprd_sep_line"></span></span>
	       <?php if($title!='' || $icon!=''): ?><span class="loprd_sep_text" <?php echo ''.$text_inline_css; // var escaped ?>><?php echo ''.( $icon!='' ? '<i class="'. esc_attr( ${"icon_" . $icon} ) .'"></i> ' : ''); ?><?php echo ''.( $title!='' ? '<span class="sep_title">'.esc_html($title).'</span>' : ''); ?></span><?php endif; ?>
	       <span class="loprd_sep_holder loprd_sep_holder_r"><span<?php echo ''.$inline_css; // var escaped ?> class="loprd_sep_line"></span></span>
        </div>
    </div>
</div>
<?php echo ''.$this->endBlockComment('separator')."\n";