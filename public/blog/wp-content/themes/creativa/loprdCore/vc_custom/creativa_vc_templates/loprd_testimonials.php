<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'avatar' => '',
    'author' => 'John Doe',
    'function' => '',
    'testi_content' => 'The natural desire of good men is knowledge.',
    'testi_style' => 'standard',
    'quote_size' => 'testimonial-default',
    'testi_align' => 'blockquote-left',
    'quote_color' => '',
    'author_color' => '',
    'border_color' => '',
    'border_bg' => '',

    'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts));

$footer_class = '';
if (empty($avatar) && !empty($author) || !empty($avatar) && empty($author)) {
	$footer_class = 'class="f_full"';
	$avatar_size = 'full';
}
elseif (!empty($avatar) && !empty($author)) {
	$footer_class = 'class="f_w-avatar"';
	$avatar_size = 'thumbnail';
}

$bordered_style = '';
if ($testi_style == 'standard') {
	$testi_style_class = 'blockquote-standard';
	$border_bg_style = '';

	if (!empty($quote_color)) {
		$bordered_style .= 'style="';
		if (!empty($quote_color)) {
			$bordered_style .= 'color: '. esc_attr($quote_color) .';';
		}
		$bordered_style .= '"';
	}
} 
elseif ($testi_style == 'bordered') {
	$testi_style_class = 'blockquote-bordered';

	if (!empty($border_bg) || !empty($border_color) || !empty($quote_color)) {
		$bordered_style .= 'style="';
		if (!empty($border_bg)) {
			$bordered_style .= 'background-color: '. esc_attr($border_bg) .';';
		}
		if (!empty($border_color)) {
			$bordered_style .= 'border-color: '. esc_attr($border_color) .';';
		}
		if (!empty($quote_color)) {
			$bordered_style .= 'color: '. esc_attr($quote_color) .';';
		}
		$bordered_style .= '"';
	}
}

if (!empty($author_color)) {
	$author_color_style = 'style="color:'. $author_color .'" ';
} else {
	$author_color_style = '';
}

?>
<div class="loprd-shortcode-testimonial <?php echo creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>

	<blockquote class="<?php echo esc_attr($testi_style_class) .' '. esc_attr($testi_align); ?>">
		<p class="<?php echo esc_attr($quote_size) ?>" <?php echo ''.$bordered_style // var escaped ?>><?php echo esc_html($testi_content); ?>
			<?php if ($testi_style == 'bordered' && (!empty($avatar) || !empty($author))) { ?>
				<span class="author-arrow"></span>
			<?php } ?>
		</p>
		<footer <?php echo ''.$footer_class // var escaped ?>>
			<?php 
				if (!empty($avatar)) { ?>
					<div class="avatar"><?php echo wp_get_attachment_image($avatar, $avatar_size); ?></div>
				<?php }
			?>

			<?php 
				if (!empty($author)) { ?>
					<div class="author heading-color" <?php echo ''.$author_color_style; // var escaped ?>>
						<?php echo esc_html($author) ?>
						<?php 
							if (!empty($function)) { ?>
								<span class="author__function font-secondary" <?php echo ''.$author_color_style; // var escaped ?>><?php echo esc_html($function); ?></span>
							<?php }
						?>
						
					</div>
				<?php }
			?>
			
		</footer>
	</blockquote>
</div>