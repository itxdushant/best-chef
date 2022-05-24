<?php
$output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = '';
extract( shortcode_atts( array(
	'title' => '',
	'type' => 'carousel',
	'transition' => 'move',
	'autoplay' => 0,
	'grid_columns' => 'columns-3',
	'collage_height' => '350',
	'grid_gap' => '10',
	'onclick' => 'link_image',
	'custom_links' => '',
	'custom_links_target' => '',
	'img_size' => 'full',
	'images' => '',
	'el_class' => '',
	// 'interval' => '5',
	'navigation' => 'nav_thumbs',

	'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts ) );
$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';

$el_class = $this->getExtraClass( $el_class );
if ( $type == 'carousel' ) {
	$el_start = '<div class="rsContent">';
	$el_end = '</div>';
	$slides_wrap_start = '<div class="image-slider royalSlider rsCreativa rsNavInner rsArrowHover"" data-nav="'. esc_attr($navigation) .'" data-autoplay="'. intval($autoplay) .'" data-transition="'. esc_attr($transition). '">';
	$slides_wrap_end = '</div>';
	$carousel = true;
} else if ( $type == 'image_grid' ) {

	$grid_gap_wr_style = '';
	$grid_gap_el_style = '';
	if ($grid_gap != '0') {
		$grid_gap_wr_style = 'style="margin:-'. esc_attr($grid_gap) / 2 .'px;"';
		$grid_gap_el_style = 'style="padding:'. esc_attr($grid_gap) / 2 .'px;"';
	}

	$isotope_item = ($grid_columns != 'columns-1') ? 'isotope-item' : 'grid-item';
	$ig_hidden = ($grid_columns != 'columns-1') ? 'ig-hidden' : '';

	$el_start = '<li class="'. $isotope_item .'" '. $grid_gap_el_style .'>';
	$el_end = '</li>';
	$slides_wrap_start = '<ul class="image_grid_ul '. $ig_hidden .' '. esc_attr($grid_columns) .'" '. $grid_gap_wr_style .'>';
	$slides_wrap_end = '</ul>';
	$carousel = false;
} else if ( $type == 'collage' ) {

	$el_start = '<div class="gallery-collage__inner">';
	$el_end = '</div>';
	$slides_wrap_start = '<div class="loprd-gallery__collage--container"><div class="loprd-gallery__collage " data-collage-target="'. intval($collage_height) .'" data-collage-gap="'. intval($grid_gap) .'">';
	$slides_wrap_end = '</div></div>';

	$carousel = false;
}

if ( $images == '' ) $images = '-1,-2,-3';

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}
$images = explode( ',', $images );
$i = - 1;

foreach ( $images as $attach_id ) {
	$i ++;
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
	} else {
		$post_thumbnail = array();
		$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}

	$thumbnail = $post_thumbnail['thumbnail'];
	$p_img_large = wp_get_attachment_image_src( $attach_id, 'full' );
	$link_start = $link_end = '';

	$rsThmb = '';
	if ( $carousel == true && $navigation == 'nav_thumbs') {
		$rsThmb .= wp_get_attachment_image( $attach_id, 'thumbnail', '', array('class' => 'attachment-thumbnail rsTmb'));
	}

	if ( $onclick == 'link_image' ) {
		if ($carousel == true) {
			$link_start = '<a class="magnpopup carousel-view" data-effect="mfp-zoom-in" href="' . esc_url($p_img_large[0]) . '"></a>';
			$link_end = '';
		} else {
			$link_start = '<a class="magnpopup"  data-effect="mfp-zoom-in" href="' . esc_url($p_img_large[0]) . '">';
			$link_end = '</a>';
		}
	} else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' && $custom_links[$i] != '#' ) {

		if ($carousel == true) {
			$link_start = '<a class="img-link carousel-view" href="' . esc_url($custom_links[$i]) . '"' . ( ! empty( $custom_links_target ) ? ' target="' . esc_attr($custom_links_target) . '"' : '' ) . '></a>';
			$link_end = '';
		} else {
			$link_start = '<a class="img-link" href="' . esc_url($custom_links[$i]) . '"' . ( ! empty( $custom_links_target ) ? ' target="' . esc_attr($custom_links_target) . '"' : '' ) . '>';
			$link_end = '</a>';
		}
	}
	$gal_images .= $el_start . $link_start . $thumbnail . $rsThmb . $link_end . $el_end;
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element '. $onclick .' '. $el_class . vc_shortcode_custom_css_class( $css, ' ' ) . ' vc_clearfix', $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

$output .= "\n\t" . '<div class="' . $css_class . '" '. creativaAnimationDelay($css_animation, $css_animation_delay)  .'>';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );
$output .= '<div class="loprd-gallery ' . $type . '" >' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_gallery' );

echo ''.$output;