<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => esc_html__("Section", 'creativa'),
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="loprd-accordion-header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="loprd-accordion-content ui-accordion-content vc_clearfix">';
        $output .= ($content=='' || $content==' ') ? esc_html__("Empty section. Edit page to add content here.", 'creativa') : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo ''.$output;