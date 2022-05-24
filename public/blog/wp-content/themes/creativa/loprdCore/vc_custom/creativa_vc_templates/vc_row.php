<?php
$creativa_options = creativa_get_options();

$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $bg_style = $bg_overlay = $bg_overlay_color = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'bg_style'	    => 'standard',
    'background_position' => '',
    'bg_attachment_fixed'      => '',
    // 'bg_video_source' => '',
    // 'bg_overlay'      => '',
    'bg_overlay_color'      => '',
    'bg_overlay_color_2' => '',
    'bg_overlay_gradient_dir' => '180deg',
    // 'bg_shadow'      => '',
    'row_height'     => '',
    'vertical_align' => 'none',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'textarea_video_urls'      => '',
    'css' => '',
    'full_width_content' => 'standard',
    'common_height' => '',
    'el_id' => '',

    'animated_canvas' => 'none',
    'animated_canvas_color' => 'rgba(0,0,0,0.1)',
    'animated_canvas_count' => '15',

    'inner_separator_top' => 0,
    'inner_separator_top_color' => '',
    'inner_separator_bottom' => 0,
    'inner_separator_bottom_color' => '',

    'css_animation' => '',
    'css_animation_delay' => '',
), $atts));




$el_class = $this->getExtraClass($el_class);

$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_row-fluid',
    $el_class,
    creativaAnimation($css_animation),
    vc_shortcode_custom_css_class( $css ),
);


$bg_overlay_class = '';

if ($this->settings('base') != 'vc_row_inner' ) {
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

    if ($bg_overlay_color) {
        $bg_overlay_class = 'vc_bg_has_overlay ';
    } else {
        $bg_overlay_class = '';
    }
}

if (!empty($row_height)) {
    $css_classes[] = 'vc_row_custom_height ';

    if ($vertical_align != 'none') {
        $css_classes[] = 'vc_row_vertical_align vertical_'. esc_attr($vertical_align) .' ';
    } else {
        $css_classes[] = '';
    }

    if (is_numeric($row_height)) {
        $unit = 'px';
        $row_height_output = $row_height . $unit;
    } else {
        $row_height_output = $row_height;
    }
}

$fwc_container_class = 'container ';
$css_classes[] = 'vc_row_stcontent ';

if ($full_width_content == 'full-width') {
    $fwc_container_class = 'full-width-container ';
    $css_classes[] = 'vc_row_fullwidthcontent ';
}
elseif ($full_width_content == 'collapsed') {
    $css_classes[] = 'vc_row_collapsed ';
}


if ($common_height == 'true') {
    $css_classes[] .= 'vc_row_common-height ';
}

$css_get_url =  strpos($css, 'url');

$row_style = '';
if (!empty($row_height_output) || !empty($background_position) || ($bg_style == 'parallax' && $css_get_url !== false)) {
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


// top-separators 
// - row-separator--top--slanted-1l
// - row-separator--top--slanted-1r
// - row-separator--top--slanted-2l
// - row-separator--top--slanted-2r
// - row-separator--top--zigzag
// - row-separator--top--boxes
// - row-separator--top--arrow
// - row-separator--top--svg
// -- triangle_convex_top
// -- triangle_concave_top
// -- curve_convex_top
// -- curve_concave_top

// bottom-separators 
// - row-separator--bottom--slanted-1l
// - row-separator--bottom--slanted-1r
// - row-separator--bottom--slanted-2l
// - row-separator--bottom--slanted-2r
// - row-separator--bottom--zigzag
// - row-separator--bottom--boxes
// - row-separator--bottom--arrow
// - row-separator--bottom--svg
// -- triangle_convex_bottom
// -- triangle_concave_bottom
// -- curve_convex_bottom
// -- curve_concave_bottom

$separator_svg_top = '';
$separator_svg_bottom = '';


if ($inner_separator_top == 1) {
    $css_classes[] = ' row-separator--top--slanted-1l';
}
if ($inner_separator_top == 2) {
    $css_classes[] = ' row-separator--top--slanted-1r';
}
if ($inner_separator_top == 3) {
    $css_classes[] = ' row-separator--top--slanted-2l';
}
if ($inner_separator_top == 4) {
    $css_classes[] = ' row-separator--top--slanted-2r';
}
if ($inner_separator_top == 5) {
    $css_classes[] = ' row-separator--top--zigzag';
}
if ($inner_separator_top == 6) {
    $css_classes[] = ' row-separator--top--boxes';
}
if ($inner_separator_top == 7) {
    $css_classes[] = ' row-separator--top--arrow';
}
if ($inner_separator_top == 8) { // SVG Triangle Convex
    $css_classes[] = ' row-separator--top--svg';
    $triangle_convex_top = '<svg id="TriangleTopConvex" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L50 100 L100 0 Z"></path></svg>';
    $separator_svg_top = $triangle_convex_top;
}
if ($inner_separator_top == 9) { // SVG Triangle Concave
    $css_classes[] = ' row-separator--top--svg';
    $triangle_concave_top = '<svg id="TriangleTopConcave" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 100 L0 0 L100 0 L100 100 L50 0 Z"></path></svg>';
    $separator_svg_top = $triangle_concave_top;
}
if ($inner_separator_top == 10) { // SVG Curve Convex
    $css_classes[] = ' row-separator--top--svg';
    $curve_convex_top = '<svg id="CurveTopConvex" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 S50 200 100 0 Z"></path></svg>';
    $separator_svg_top = $curve_convex_top;
}
if ($inner_separator_top == 11) { // SVH Curve Concave
    $css_classes[] = ' row-separator--top--svg';
    $curve_concave_top = '<svg id="CurveTopConcave" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L100 0 L100 100 S50 -100 0 100 Z"></path></svg>';
    $separator_svg_top = $curve_concave_top;
}


if ($inner_separator_bottom == 1) {
    $css_classes[] = ' row-separator--bottom--slanted-1l';
}
if ($inner_separator_bottom == 2) {
    $css_classes[] = ' row-separator--bottom--slanted-1r';
}
if ($inner_separator_bottom == 3) {
    $css_classes[] = ' row-separator--bottom--slanted-2l';
}
if ($inner_separator_bottom == 4) {
    $css_classes[] = ' row-separator--bottom--slanted-2r';
}
if ($inner_separator_bottom == 5) {
    $css_classes[] = ' row-separator--bottom--zigzag';
}
if ($inner_separator_bottom == 6) {
    $css_classes[] = ' row-separator--bottom--boxes';
}
if ($inner_separator_bottom == 7) {
    $css_classes[] = ' row-separator--bottom--arrow';
}
if ($inner_separator_bottom == 8) { // SVG Triangle Convex
    $css_classes[] = ' row-separator--bottom--svg';
    $triangle_convex_bottom = '<svg id="TriangleBottomConvex" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 100 L50 0 L100 100 Z"></path></svg>';
    $separator_svg_bottom = $triangle_convex_bottom;
}
if ($inner_separator_bottom == 9) { // SVG Triangle Concave
    $css_classes[] = ' row-separator--bottom--svg';
    $triangle_concave_bottom = '<svg id="TriangleBottomConcave" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 100 L0 0 L50 100 L100 0 L100 100 Z"></path></svg>';
    $separator_svg_bottom = $triangle_concave_bottom;
}
if ($inner_separator_bottom == 10) { // SVG Curve Convex
    $css_classes[] = ' row-separator--bottom--svg';
    $curve_convex_bottom = '<svg id="CurveBottomConvex" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 100 S50 -100 100 100 Z"></path></svg>';
    $separator_svg_bottom = $curve_convex_bottom;
}
if ($inner_separator_bottom == 11) { // SVH Curve Concave
    $css_classes[] = ' row-separator--bottom--svg';
    $curve_concave_bottom = '<svg id="CurveBottomConcave" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 100 L0 0 S50 200 100 0 L100 100 Z"></path></svg>';
    $separator_svg_bottom = $curve_concave_bottom;
}


// $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. $fwc_content_class . $bg_style_class . $bg_overlay_class .  $row_height_class . $vertical_align_class .''. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner rsContent ' : '' ) . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$parallax_css = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_bg_parallax '. $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );


$row_id_output = '';
if (isset( $el_id ) && ! empty( $el_id )) {
    $row_id_output = 'id="'. esc_attr($el_id) .'"';
}


$output .= '<div '. $row_id_output .' class="'. $css_class .'" '. $row_style . ' '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
if (is_page_template( 'template-full-width.php') || vc_is_frontend_editor() || (is_singular('portfolio') && $creativa_options['opt-project-layout'] == 4) || (is_singular('post') && $creativa_options['opt-blog-page-style'] == 3) || (is_singular('product'))) {
    if ($this->settings('base') != 'vc_row_inner') {

        if ($inner_separator_top != 0) {
            $separator_top_color = ($inner_separator_top_color) ? 'style="color:'. esc_attr($inner_separator_top_color) .';"' : '';
            $output .= '<div class="row__separator--top" '. $separator_top_color .'>'. $separator_svg_top .'</div>';
        }
        if ($inner_separator_bottom != 0) {
            $separator_bottom_color = ($inner_separator_bottom_color) ? 'style="color:'. esc_attr($inner_separator_bottom_color) .';"' : '';
            $output .= '<div class="row__separator--bottom" '. $separator_bottom_color .'>'. $separator_svg_bottom .'</div>';
        }

        if (!empty($row_height_output) && $vertical_align != 'none') {
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

                        if (!empty($bg_video_id)) {
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

        $output .= '<div class="vc_container_inner '. esc_attr($fwc_container_class) .'"><div class="row">';
    }
}
$output .= wpb_js_remove_wpautop($content);
if (is_page_template( 'template-full-width.php') || vc_is_frontend_editor() || (is_singular('portfolio') && $creativa_options['opt-project-layout'] == 4) || (is_singular('post') && $creativa_options['opt-blog-page-style'] == 3) || (is_singular('product'))) {
    if ($this->settings('base') != 'vc_row_inner') {

        $output .= '</div></div> <!-- vc_container_inner end -->';

        if (!empty($row_height) && $vertical_align != 'none') {
            $output .= '</div></div> <!-- vertical align end -->';
        }
    }
}
$output .= '</div>'.$this->endBlockComment('row');

echo ''.$output;