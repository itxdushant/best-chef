<?php
extract( shortcode_atts( array(
	'link' => '',
	'title' => esc_html__( 'Text on the button', 'creativa' ),
	'color' => 'btn-default',
	// 'icon' => '',
	'size' => 'btn-md',
	'style' => 'btn-standard',
	'alignment' => 'btn-inline',
	'el_class' => '',
	'css_animation' => '',
    'css_animation_delay' => '',
    'css' => '',
), $atts ) );

$class = 'btn';
//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];

$class .= ( $color != '' ) ? ' ' . $color : '';
$class .= ( $size != '' ) ? ' ' . $size : '';
$class .= ( $style != '' ) ? ' ' . $style : '';

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'loprd-shortcode-btn ' . $class . vc_shortcode_custom_css_class( $css, ' ' ) .' '. $el_class, $this->settings['base'], $atts );
$css_class .= creativaAnimation($css_animation);

?>

<?php 
	if ($alignment != 'btn-inline') {
		echo '<div class="btn-alignment-wrapper '. esc_attr($alignment) .'">';
	}
?>
<a class="<?php echo esc_attr( trim( $css_class ) ); ?>" href="<?php echo esc_url( $a_href ); ?>" <?php echo (!empty($a_title)) ? 'title="'. esc_attr( $a_title ) .'"' : ''; ?> <?php echo (!empty($a_target)) ? 'target="'. esc_attr( $a_target ) .'"' : ''; ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>><?php echo esc_html($title); ?></a>
<?php 
	if ($alignment != 'btn-inline') {
		echo '</div>';
	}
?>
<?php echo ''.$this->endBlockComment( 'vc_button' ) . "\n";