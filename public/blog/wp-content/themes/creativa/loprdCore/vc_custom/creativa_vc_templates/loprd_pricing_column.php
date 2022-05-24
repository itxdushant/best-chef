<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'title' => 'Title',
    'price' => '$19',
    'billing' => '/month',
    'features_list' => '10|Pages,1GB|Storage,Feature #4',
    'choose_btn' => '',
    'choose_btn_style' => 'btn-default',
    'featured' => '',
    'featured_text' => 'Most Popular!',
    'column_bg' => '',
    'column_text' => '',
    'price_color' => '',
    'featured_bg' => '',
    'features_list_bg' => '',
    'featured_color' => '',
    'css' => '',

    'css_animation' => '',
    'css_animation_delay' => '',
), $atts));


if ($featured == 'true') {
	$featured_class = 'pt-featured ';
} else {
	$featured_class = '';
}

$column_bg_style = '';	
if (!empty($column_bg) || !empty($column_text)) {
	$column_bg_style .= 'style="';
	if (!empty($column_bg)) {
		$column_bg_style .= 'background:'. esc_attr($column_bg) .';';
	}
	if (!empty($column_text)) {
		$column_bg_style .= 'color:'. esc_attr($column_text) .';';
	}
	$column_bg_style .= '"';	
}

$price_color_style = '';
if (!empty($price_color)) {
	$price_color_style = 'style="color:'. esc_attr($price_color) .'"';
}


$featured_text_style = '';	
if (!empty($featured_bg) || !empty($featured_color)) {
	$featured_text_style .= 'style="';
	if (!empty($featured_bg)) {
		$featured_text_style .= 'background:'. esc_attr($featured_bg) .';';
	}
	if (!empty($featured_color)) {
		$featured_text_style .= 'color:'. esc_attr($featured_color) .';';
	}
	$featured_text_style .= '"';	
}

$features_list_bg_style = '';
if (!empty($features_list_bg)) {
	$features_list_bg_style = 'style="background-color:'. esc_attr($features_list_bg) .';"';
}




?>
<div class="loprd-pricing-column <?php echo esc_attr($featured_class) .' '. esc_attr($el_class) .' '. creativaAnimation($css_animation) .' '. vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="loprd-pricing-column--wrapper" <?php echo ''.$column_bg_style // var escaped ?>>
		<header class="pt-header" <?php echo ''.$price_color_style // var escaped ?>>
			<?php 
				if (!empty($title)) { ?>
					<h5 class="pt-title">
						<?php echo esc_html($title) ?>
					</h5>
				<?php }
			?>
			<?php 
				$value = $price;
				$price_c[] = '';

				if (strcspn($value, '0123456789') != strlen($value)) {
					preg_match("/^(\D*)\s*([\d,\.]+)\s*(\D*)$/", $value, $price_c);
				}
				else {
				  	$price_c[2] = $value;
				}

				if (!empty($price)) { ?>
					<div class="pt-price" <?php echo ''.$price_color_style // var escaped ?>>
						<h2 class="jumbo"><?php echo (!empty($price_c[1]) ? '<span class="currency-bef">'. esc_html($price_c[1]) .'</span>' : '') ?><?php echo esc_html($price_c[2]); ?><?php echo (!empty($price_c[3]) ? '<span class="currency-aft">'. esc_html($price_c[3]) .'</span>' : '') ?></h2>
						<?php echo (!empty($billing)) ? '<span class="font-secondary">'. esc_html($billing) .'</span>' : '' ?>
					</div>
				<?php }
			?>		
			<?php 
			if ($featured == 'true' && !empty($featured_text)) { ?>
				<div class="pt-featured-text" <?php echo ''.$featured_text_style // var escaped ?>>
					<span>
						<?php echo esc_html($featured_text); ?>
					</span>
				</div>
			<?php }
		?>
		</header>
		<?php if (!empty($features_list)) { ?>
		<div class="pt-features" <?php echo ''.$features_list_bg_style // var escaped ?>>
			<?php 
				$get_features = explode(',', $features_list);

				echo '<ul>';
				foreach ($get_features as $feature) {
					if (strpos($feature,'|') !== false) {
					    $feature_sep = explode('|', $feature);
					} else {
						$feature_sep[0] = '';
						$feature_sep[1] = $feature;
					}

					echo '<li>'. (!empty($feature_sep[0]) ? '<span class="qty">'. esc_html($feature_sep[0]) .' </span>' : '') .''. esc_html($feature_sep[1]) .'</li>';
				}
				echo '</ul>';
			?>	
		</div>
		<?php } ?>
		<?php 
			$href = vc_build_link($choose_btn);

			if ($featured == 'true' && !empty($featured_text)) {
				$btn_style = 'btn-default';
			} else {
				$btn_style = 'btn-outlined';
			}

			if (!empty($href['url'])) { ?>
			<footer>
				<div class="pt-choose">
					<a href="<?php echo esc_url($href['url']) ?>" class="btn btn-sm <?php echo esc_attr($btn_style) .' '. esc_attr($choose_btn_style) ?>" <?php echo (!empty($href['target']) ? 'target='. esc_attr($href['target']) .'' : '') ?>><?php echo esc_html($href['title']) ?></a>
				</div>
			</footer>
			<?php }
		?>
	</div>
</div>