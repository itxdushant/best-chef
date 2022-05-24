<?php
$output = $title = $el_class = $open = $css_animation = '';

$inverted = false;
/**
 * @var string $title
 * @var string $el_class
 * @var string $style
 * @var string $color
 * @var string $size
 * @var string $open
 * @var string $css_animation
 *
 * @var array $atts
 */
extract( shortcode_atts( array(
	'title' => esc_html__( "Click to toggle", 'creativa' ),
	'el_class' => '',
	'style' => 'default',
	'color' => 'default',
	'size' => '',
	'open' => 'false',
	'css_animation' => '',
    'css_animation_delay' => '',
), $atts ) );

// checking is color inverted
$style = str_replace( '_outline', '', $style, $inverted );
/**
 * class wpb_toggle removed since 4.4
 * @since 4.4
 */
$elementClass = array(
	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_toggle loprd-toggle-wrapper ', $this->settings['base'], $atts ),
	// TODO: check this code, don't know how to get base class names from params
	'style' => 'vc_toggle_' . $style,
	'color' => ( $color ) ? 'vc_toggle_color_' . $color : '',
	'inverted' => ( $inverted ) ? 'vc_toggle_color_inverted' : '',
	'size' => ( $size ) ? 'vc_toggle_size_' . $size : '',
	'open' => ( $open == 'true' ) ? 'vc_toggle_active' : '',
	'extra' => $this->getExtraClass( $el_class ),
	'css_animation' => creativaAnimation($css_animation), // @todo remove getCssAnimation as function in helpers
);

$elementClass = trim( implode( ' ', $elementClass ) );

$title_size_class = 'h4-size';
if ($size == 'sm') {
	$title_size_class = 'h5-size';
}
if ($size == 'lg') {
	$title_size_class = 'h3-size';
}

?>
<div class="<?php echo esc_attr( $elementClass ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="vc_toggle_title loprd-toggle-title">
		<h4 class="<?php echo esc_attr( $title_size_class ) ?>"><?php echo esc_html( $title ) ?></h4>
		<i class="vc_toggle_icon"></i>
	</div>
	<div class="vc_toggle_content loprd-toggle-content"><?php echo wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true ); ?></div>
</div>