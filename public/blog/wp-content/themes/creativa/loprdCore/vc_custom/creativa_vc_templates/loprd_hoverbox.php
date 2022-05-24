<?php
$el_class = '';
extract(shortcode_atts(array(
	'link' => '',
	'height' => 320,
	'content_position' => 'center-center',

	'front_title' => '',
	'front_title_size' => 'h4-size',
	'front_content' => '',
	'front_content_color' => '',
	'front_bg_color' => '',
	'front_bg_overlay' => '',
	'front_bg_img' => '',
	'front_bg_img_pos' => '',
	'front_bg_img_size' => 'cover',

	'hover_title' => '',
	'hover_title_size' => 'h4-size',
	'hover_content' => '',
	'hover_content_color' => '',
	'hover_bg_color' => '',
	'hover_bg_overlay' => '',
	'hover_bg_img' => '',
	'hover_bg_img_pos' => '',
	'hover_bg_img_size' => 'cover',

	'content_animation' => 'none',
	'bg_animation' => 'none',

    'el_class' => '',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));


$hover_link = vc_build_link($link);

$front_image_src = wp_get_attachment_image_src($front_bg_img, 'full');
$front_image_style = '';
if ($front_image_src[0] || $front_bg_color) {
	$front_image_style .= 'style="';

	if ($front_image_src[0]) {
		$front_image_style .= 'background-image:url('. esc_url($front_image_src[0]) .');';

		if ($front_bg_img_pos) {
			$front_image_style .= 'background-position:'. esc_attr($front_bg_img_pos) .';';
		}
		if ($front_bg_img_size) {
			if ($front_bg_img_size == 'cover') {
				$front_image_style .= 'background-size:'. esc_attr($front_bg_img_size) .';';
			} else {
				$front_image_style .= 'background-repeat:'. esc_attr($front_bg_img_size) .';';
			}
		}
	}
	if ($front_bg_color) {
		$front_image_style .= 'background-color:'. esc_attr($front_bg_color) .';';
	}

	$front_image_style .= '"';
}

$hover_image_src = wp_get_attachment_image_src($hover_bg_img, 'full');
$hover_image_style = '';
if ($hover_image_src[0] || $hover_bg_color) {
	$hover_image_style .= 'style="';

	if ($hover_image_src[0]) {
		$hover_image_style .= 'background-image:url('. esc_url($hover_image_src[0]) .');';

		if ($hover_bg_img_pos) {
			$hover_image_style .= 'background-position:'. esc_attr($hover_bg_img_pos) .';';
		}
		if ($hover_bg_img_size) {
			if ($hover_bg_img_size == 'cover') {
				$hover_image_style .= 'background-size:'. esc_attr($hover_bg_img_size) .';';
			} else {
				$hover_image_style .= 'background-repeat:'. esc_attr($hover_bg_img_size) .';';
			}
		}
	}
	if ($hover_bg_color) {
		$hover_image_style .= 'background-color:'. esc_attr($hover_bg_color) .';';
	}

	$hover_image_style .= '"';
}

$classes = '';
$classes .= 'loprd-hoverbox--'.$content_position; // content position
$classes .= ' loprd-hoverbox--content--'.$content_animation; // content animation
$classes .= ' loprd-hoverbox--bg--'.$bg_animation; // bg animation


$height_style = '';
if (is_numeric($height)) {
    $unit = 'px';
    $height_style = 'style="height:'. intval($height) . $unit .';"';
} else {
    $height_style = 'style="height:'. esc_attr($height) .';"';
}

$front_content_color_style = '';
if ($front_content_color) {
	$front_content_color_style = 'style="color:'. esc_attr($front_content_color) .';"';
}

$hover_content_color_style = '';
if ($hover_content_color) {
	$hover_content_color_style = 'style="color:'. esc_attr($hover_content_color) .';"';
}

?>
<div class="loprd-shortcode-hoverbox loprd-hoverbox <?php echo esc_attr($classes) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo ''.$height_style // var escaped ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="loprd-hoverbox__bg--wrapper">
		<div class="loprd-hoverbox__front__bg">
			<?php if ($front_image_src[0] || $front_bg_color) { ?>
				<div class="loprd-hoverbox__front__bg__container" <?php echo ''.$front_image_style // var escaped ?>></div>
			<?php } ?>
			<?php if ($front_bg_overlay) { ?>
				<div class="loprd-hoverbox__front__bg__overlay" style="background-color:<?php echo esc_attr($front_bg_overlay) ?>;"></div>
			<?php } ?>
		</div>
		<div class="loprd-hoverbox__hover__bg">
			<?php if ($hover_image_src[0] || $hover_bg_color) { ?>
				<div class="loprd-hoverbox__hover__bg__container" <?php echo ''.$hover_image_style // var escaped ?>></div>
			<?php } ?>
			<?php if ($hover_bg_overlay) { ?>
				<div class="loprd-hoverbox__hover__bg__overlay" style="background-color:<?php echo esc_attr($hover_bg_overlay) ?>;"></div>
			<?php } ?>
		</div>
	</div>
	<div class="loprd-hoverbox__content--wrapper">
		<?php if ($front_title || $front_content) { ?>
			<div class="loprd-hoverbox__front__content">
				<div class="loprd-hoverbox__front__content__inner" <?php echo ''.$front_content_color_style // var escaped ?>>
					<?php if ($front_title) { ?>
						<div class="hoverbox-title heading <?php echo esc_attr($front_title_size) ?>"><?php echo esc_html($front_title) ?></div>
					<?php } ?>
					<?php echo wpautop($front_content) ?>
				</div>
			</div>
		<?php } ?>
		<?php if ($hover_title || $hover_content) { ?>
			<div class="loprd-hoverbox__hover__content">
				<div class="loprd-hoverbox__hover__content__inner" <?php echo ''.$hover_content_color_style // var escaped ?>>
					<?php if ($hover_title) { ?>
						<div class="hoverbox-title heading <?php echo esc_attr($hover_title_size) ?>"><?php echo esc_html($hover_title) ?></div>
					<?php } ?>
					<?php echo wpautop($hover_content) ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php if ($hover_link['url']) { ?>
		<a href="<?php echo esc_url($hover_link['url']) ?>" class="loprd-hoverbox__anchor" <?php echo ''.($hover_link['target']) ? 'target="'. esc_attr($hover_link['target']) .'"' : '' ?> <?php echo ''.($hover_link['title']) ? 'title="'. esc_attr($hover_link['title']) .'"' : '' ?>></a>
	<?php } ?>
</div>