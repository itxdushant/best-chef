<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class'  => '',
    'title' 	=> 'Timeline Block Header',
    'date'		=> 'November 2015',
    // 'tb_bg' => '',
    // 'tb_bcolor' => '',
    'tb_title_color' => '', 

    'css' => '',
    'css_animation' => '',
    'css_animation_delay' => '',
), $atts));


?>
<div class="loprd_timeline_block_wrap tl_block_left <?php echo esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ) .' '. creativaAnimation($css_animation) ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<span class="loprd_timeline_block--point " <?php echo (!empty($tb_title_color) ? 'style="background-color:'. esc_attr($tb_title_color) .';"' : '') ?>></span>
	<div class="loprd_timeline_block">
		<?php 
			if (!empty($title) || !empty($date)) {
				echo '<h4 class="timeline_block_title" '. (!empty($tb_title_color) ? 'style="color:'. esc_attr($tb_title_color) .';"' : '') .' >';
				if (!empty($title)) {
					echo '<span class="tl-title">';
					echo esc_html($title);
					echo '</span>';
				}
				if (!empty($date)) {
					echo '<span class="tl-date font-secondary">';
					echo esc_html($date);
					echo '</span>';
				}
				echo '</h4>';
			}
		?>
		<?php 
			if (!empty($content)) { ?>
				<div class="loprd_timeline_content">
					<?php echo wpb_js_remove_wpautop( $content, true );?>
				</div>
			<?php }
		?>
	</div>
</div>