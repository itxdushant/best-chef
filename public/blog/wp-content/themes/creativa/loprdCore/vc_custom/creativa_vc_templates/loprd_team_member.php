<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'tm_height' => 400,
    'photo' => '',
    'name' => 'Name Lastname',
    'function' => '',
    'member_desc' => '',
    'name_color' => '',
    'name_size' => 'h3-size',
    'function_color' => '',
    'description_color' => '',
    'description_bg_color' => '',

    'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts));

if (!empty($name_color)) {
	$name_color_style = 'style="color:'. esc_attr($name_color) .';"';
} else {
	$name_color_style = '';
}

if (!empty($function_color)) {
	$function_color_style = 'style="color:'. esc_attr($function_color) .';"';
} else {
	$function_color_style = '';
}

if (!empty($description_color)) {
	$desc_text_color_style = 'style="color:'. esc_attr($description_color) .';"';
} else {
	$desc_text_color_style = '';
}

if (!empty($description_bg_color)) {
	$desc_bg_color_style = 'style="background-color:'. esc_attr($description_bg_color) .';"';
} else {
	$desc_bg_color_style = '';
}

$with_desc_class = '';
if (!empty($member_desc)) {
	$with_desc_class = 'team-member--with-desc';
}

$height_style = '';
if (!empty($tm_height)) {
    if (is_numeric($tm_height)) {
        $unit = 'px';
        $row_height_output = $tm_height . $unit;
    } else {
        $row_height_output = $tm_height;
    }
	$height_style = 'style="height:'. esc_attr($row_height_output) .'"';
}

$member_photo_style = '';
if (!empty($photo)) {
	$member_photo = wp_get_attachment_image_src($photo, 'full'); 
	$member_photo_style .= 'style="background-image:url('. esc_attr($member_photo[0]) .');"';
}

?>
<div class="loprd-team-member <?php echo esc_attr($with_desc_class); ?> <?php echo creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?> <?php echo ''.$height_style // escaped ?>>
	<div class="tm-photo" <?php echo ''.$member_photo_style; // escaped ?>></div>

	<div class="team-member__front-name">
		<?php 
			if (!empty($name)) { ?>
				<div class="tm-name">
					<div class="heading <?php echo esc_attr($name_size) ?>"><?php echo esc_html($name) ?></div>
					<?php echo (!empty($function)) ? '<span class="tm__function font-secondary">'. esc_html($function) .'</span>' : '' ?>
				</div>
			<?php }
		?>
	</div>
	<div class="team-member__info--wrapper">
		<div class="team-member__info--content" <?php echo ''.$desc_bg_color_style; // var escaped ?>>
			<?php 
				if (!empty($name)) { ?>
					<div class="tm-name">
						<div class="heading <?php echo esc_attr($name_size) ?>" <?php echo ''.$desc_text_color_style; // var escaped ?>><?php echo esc_html($name) ?></div>
						<?php echo (!empty($function)) ? '<span class="tm__function font-secondary" '. $desc_text_color_style .'>'. esc_html($function) .'</span>' : '' ?>
					</div>
				<?php }
			?>
			<?php 
				if (!empty($member_desc)) { ?>
					<div class="tm-desc" <?php echo ''.$desc_text_color_style; // var escaped ?>>
						<?php echo esc_html($member_desc); //Parse inner shortcodes ?>
					</div>
				<?php }
			?>
		</div>
	</div>
</div>