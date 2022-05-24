<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * @var full_width_content
 * @var common_height
 * @var row_height

 * @var bg_style
 * @var background_position
 * @var bg_attachment_fixed
 * @var textarea_video_urls
 * @var bg_overlay_color
 * @var bg_overlay_color_2
 * @var bg_overlay_gradient_dir

 * @var animated_canvas
 * @var animated_canvas_color
 * @var animated_canvas_count

 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_inner',
    'vc_row-fluid',
    'rsContent',

    creativaAnimation($css_animation),
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_classes[] = 'vc_inner_stcontent ';
if ($full_width_content == 'collapsed') {
    $css_classes[] = 'vc_inner_collapsed ';
}

if ($common_height == 'true') {
    $css_classes[] .= 'vc_inner_common-height ';
}

$css_get_url =  strpos($css, 'url');
$vertical_align_class = '';

if (!empty($row_height)) {
    $css_classes[] = 'vc_row_custom_height ';

    if ($vertical_align != 'none') {
        $css_classes[] = 'vc_row_vertical_align vertical_'. esc_attr($vertical_align) .' ';
    }

    if (is_numeric($row_height)) {
        $unit = 'px';
        $row_height_output = $row_height . $unit;
    } else {
        $row_height_output = $row_height;
    }
}

$row_style = '';
if (!empty($row_height) || !empty($background_position) || ($bg_style == 'parallax' && $css_get_url !== false)) {
    $row_style .= 'style="';

    if (!empty($row_height_output)) {
        $row_style .= 'min-height: '. esc_attr($row_height_output) .';';
    }

    if (!empty($background_position)) {
        $row_style .= 'background-position:'. esc_attr($background_position) .' !important;';
    }
    if ($bg_style == 'parallax' && $css_get_url !== false) {
        $row_style .= 'background-image:none !important;';
    }

    $row_style .= '"';
}

$row_parallax_bg_pos = (!empty($background_position)) ? ' background-position:'. esc_attr($background_position) .' !important; ' : '';


if ($bg_style == 'standard') {
    if ($bg_attachment_fixed == 'bg-fixed' ) {
        $css_classes[] = 'vc_bg_standard vc_bg_fixed ';
    } else {
        $css_classes[] = 'vc_bg_standard ';
    }
}
elseif ($bg_style == 'parallax') {
    $css_classes[] = 'vc_bg_has_parallax ';
}
elseif ($bg_style == 'video') {
    $css_classes[] = 'vc_bg_has_video ';
}

$bg_overlay_class = '';
if ($bg_overlay_color) {
    $css_classes[] = 'vc_bg_has_overlay ';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '" '. $row_style .'';
$parallax_css = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_bg_parallax '. $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
if (!empty($row_height) && $vertical_align != 'none') {
    $va_height_style = 'style="height:'. esc_attr($row_height_output) .';"';
    $output .= '<div class="row__vertical-align--wrapper" '. $va_height_style .'><div class="row__vertical-align--container">';
}

if ($bg_style == 'parallax' && $css_get_url !== false) {
    $output .= '<div class="vc_bg_parallax_wrap"><div style="border: 0 !important; padding: 0 !important; margin: 0 !important; '. $row_parallax_bg_pos .' " class="'. $parallax_css .'"></div></div>';
}    


if ($bg_style == 'video') {
    $bg_video_ids = explode(',' , $textarea_video_urls);

    if ($bg_video_ids) {
        $output .= '<div class="bg_video_wrap">';

        if (strpos($bg_video_ids[0], 'youtube') > 0 || strpos($bg_video_ids[0], 'vimeo') > 0) {
            $output .= '<div class="vc_ytvm_video" data-video-url="'. esc_attr($bg_video_ids[0]) .'"></div>';
        } else {
            $output .= '<video class="vc_bg_video" muted loop autoplay>';
            foreach ($bg_video_ids as $bg_video_id) {
                // $video_url =  wp_get_attachment_url($bg_video_id);
                $filetype_ext = wp_check_filetype($bg_video_id);

                if (!empty($filetype_ext['ext'])) {
                    $output .= '<source type="'. esc_attr($filetype_ext['type']) .'" src="'. esc_url($bg_video_id) .'">';
                }
            }
            $output .= '</video>';
        }

        $output .= '</div>';
    }
}

if ($bg_overlay_color) {
    $overlay_color = '';
    if ($bg_overlay_color && $bg_overlay_color_2) {
        $overlay_color = 'background: -moz-linear-gradient('. esc_attr($bg_overlay_gradient_dir) .','. esc_attr($bg_overlay_color) .','. esc_attr($bg_overlay_color_2) .');background: -webkit-linear-gradient('. esc_attr($bg_overlay_gradient_dir) .','. esc_attr($bg_overlay_color) .','. esc_attr($bg_overlay_color_2) .');background: linear-gradient('. esc_attr($bg_overlay_gradient_dir) .','. esc_attr($bg_overlay_color) .','. esc_attr($bg_overlay_color_2) .');';
    }
    elseif ($bg_overlay_color) {
        $overlay_color = 'background: '. esc_attr($bg_overlay_color). ';';
    }
    $output .= '<div class="vc_bg_overlay" style="'. $overlay_color .'"></div>';
}

if ($animated_canvas != 'none') {
    wp_enqueue_script('creativa-canvases'); 
    $output .= '<canvas class="animated-canvas" data-animation="'. esc_attr($animated_canvas) .'" data-color="'. esc_attr($animated_canvas_color) .'" data-balls-count="'. intval($animated_canvas_count) .'"></canvas>';
}

$output .= wpb_js_remove_wpautop( $content );

if (!empty($row_height) && $vertical_align != 'none') {
    $output .= '</div></div> <!-- vertical align end -->';
}
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo ''.$output;