<?php
$el_class = $icon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'icon_image_sel' => 'icon',

	'icon' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_openiconic' => '',
	'icon_typicons' => '',
	'icon_entypoicons' => '',
	'icon_linecons' => '',
	'icon_entypo' => '',
	'icon_material' => 'vc-material vc-material-cake',
	'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',

    'icon_img' => '',
    'iconbox_title_style' => 'block',
    'iconbox_inline_align' => 'left',
    'ib_icon_size' => 'normal',
    'iconbox_title' => '',
    'iconbox_align' => 'left',
    'iconbox_border' => '',
    'ib_border_bg' => '',
    'ib_border_bcolor' => '',
    'ib_title_color' => '',
    'ib_icon_style' => 'no-bg',
    // 'ib_icon_shadow' => '',
    'ib_icon_color' => '',
    'ib_icon_bg' => '',
    'iconbox_readmore_link' => '',
    'iconbox_readmore_text' => esc_html__('Read more', 'creativa'),
    'ib_header_size' => 'h4',
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));


vc_icon_element_fonts_enqueue( $icon );

if ($iconbox_title_style == 'block') {
	$iconbox_style_class = 'iconbox-block ';

	if ($iconbox_align == 'left') {
		$iconbox_align_class = 'iconbox-left ';
	}
	elseif ($iconbox_align == 'center') {
		$iconbox_align_class = 'iconbox-center ';
	}
	elseif ($iconbox_align == 'right') {
		$iconbox_align_class = 'iconbox-right ';
	}

	if ($ib_icon_size == 'normal') {
		$iconbox_icon_size_class = '';
	} 
	elseif ($ib_icon_size == 'large') {
		$iconbox_icon_size_class = 'icon-large ';
	}
}
elseif ($iconbox_title_style == 'inline') {
	$iconbox_style_class = 'iconbox-inline ';
	if ($iconbox_inline_align == 'left') {
		$iconbox_style_class = 'iconbox-inline ii-left ';
	}
	if ($iconbox_inline_align == 'right') {
		$iconbox_style_class = 'iconbox-inline ii-right ';
	}

	$iconbox_align_class = '';
	$iconbox_icon_size_class = '';
}

if ($iconbox_border == 'border') {
	$iconbox_border_class = 'iconbox-border ';

	if (!empty($ib_border_bg) ) {
		$border_bg_style = 'background: '. esc_attr($ib_border_bg) .';';
	} else {
		$border_bg_style = '';
	}

	if (!empty($ib_border_bcolor) ) {
		$border_color_style = 'border-color: '. esc_attr($ib_border_bcolor) .';';
	} else {
		$border_color_style = '';
	}

} else {
	$iconbox_border_class = '';
}

if ($ib_icon_style == 'no-bg') {
	$ib_icon_style_class = '';
} 
elseif ($ib_icon_style == 'bg-square') {
	$ib_icon_style_class = 'icon-bg ';
}
elseif ($ib_icon_style == 'bg-circle') {
	$ib_icon_style_class = 'icon-bg icon-circle ';
} else {
	$ib_icon_style_class = '';
}

$icon_image_class = '';
if (!empty($icon_img)) {
	$icon_image_class = 'iconbox-image ';
}

$icon_bg_style = '';
if ($ib_icon_style != 'no-bg' && (!empty($ib_icon_bg) || !empty($ib_icon_color))) {
	$icon_bg_style .= 'style="';
	if (!empty($ib_icon_color)) {
		$icon_bg_style .= 'color:'. esc_attr($ib_icon_color) .';';
	}
	if (!empty($ib_icon_bg)) {
		$icon_bg_style .= 'background:'. esc_attr($ib_icon_bg) .';';
	}
	$icon_bg_style .= '"';
}


?>
<!-- Icon box -->
<div class="loprd-iconbox <?php echo esc_attr($iconbox_border_class) . esc_attr($iconbox_style_class) . esc_attr($icon_image_class) . esc_attr($iconbox_align_class); echo creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); echo esc_attr($iconbox_icon_size_class); ?>" <?php echo ''.($iconbox_border == 'border' && (!empty($ib_border_bg) || !empty($ib_border_bcolor))) ? 'style="'. $border_bg_style . $border_color_style .'"' : ''; ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay) ?>>
  <div class="loprd-iconbox-icon" <?php echo ( !empty($ib_icon_color) ? 'style="color: '. esc_attr($ib_icon_color) .';"' : '' ) ?>>
	<?php 
	if ($iconbox_title_style == 'block') {
		if (!empty($icon_img) && $icon == 'upload_image') {

			$img_url = wp_get_attachment_url( $icon_img );
			echo '<img src="'. $img_url .'" alt="'. esc_attr__('Icon Image', 'creativa') .'" />';

		} else {

			if (!empty($icon)) { ?>
			<span class="iconbox-icon-wrap <?php echo esc_attr($ib_icon_style_class) ?>" <?php echo /* escaped */ ''.$icon_bg_style ?>>
				<?php
				echo '<i class="'. esc_attr( ${"icon_" . $icon} ) .'"></i>'; ?>

			</span>
				<?php 
			}

		}
	} // block endif
	else { ?>

	<?php 
		if (!empty($icon)) { ?>
		<span class="iconbox-icon-wrap <?php echo esc_attr($ib_icon_style_class) ?>" <?php echo ''.( $ib_icon_style != 'no-bg' && !empty($ib_icon_bg) ? 'style="background: '. esc_attr($ib_icon_bg) .';"' : '' ) ?>>
			<?php
			echo '<i class="'. esc_attr( ${"icon_" . $icon} ) .'"></i>'; ?>
		</span>
			<?php 
		}
	?>

	<?php } ?>
  </div>
  	<?php 
		if (!empty($iconbox_title)) { ?>
	  <<?php echo esc_html($ib_header_size); ?> class="iconbox-header" <?php echo ( !empty($ib_title_color) ? 'style="color: '. esc_attr($ib_title_color) .';"' : '' ) ?>>
				<?php echo esc_html($iconbox_title); ?>
	  </<?php echo esc_html($ib_header_size); ?>>
		<?php }
	?>
	<?php 
		if (!empty($content)) {
  			echo wpb_js_remove_wpautop($content, true); 
		}
	?>

	<?php 
	$href = vc_build_link($iconbox_readmore_link);

	if (!empty($href['url'])) {

		echo '<div class="loprd-iconbox-more">';
		echo '<a href="'. esc_url($href['url']) .'" title="'. esc_attr($href['title']) .'" '. ( !empty($ib_title_color) ? 'style="color: '. esc_attr($ib_title_color) .';"' : '' ) .' class="btn btn-outlined btn-default btn-sm" '. (!empty($href['target']) ? 'target='. esc_attr($href['target']) .'' : '') .'>'. (!empty($iconbox_readmore_text) ?  $iconbox_readmore_text : esc_html__('Read more', 'creativa')) .'</a>';
		echo '</div>';
	}
	?>

</div><!-- Icon box End -->