<?php

/* ------------------------------------------------------------ */
/* TinyMce Creativa Custom */
/* ------------------------------------------------------------ */

function creativa_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'creativa_mce_editor_buttons' );

// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'creativa_formats_tinymce' ) ) {
	function creativa_formats_tinymce( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title'	=> esc_html__( 'Typography Styles', 'creativa' ),
				'items'	=> array(
					array(
						'title'		=> esc_html__('Secondary Font','creativa'),
						'inline' => 'span',
						'classes'	=> 'font-secondary',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Text Color - Accent','creativa'),
						'inline' => 'span',
						'classes'	=> 'color-accent',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Highlight - Accent Color','creativa'),
						'inline' => 'span',
						'classes'	=> 'highlight-accent',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Highlight - Default (Yellow)','creativa'),
						'inline' => 'span',
						'classes'	=> 'highlight-default',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Highlight - Dark','creativa'),
						'inline' => 'span',
						'classes'	=> 'highlight-dark',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Highlight - Light','creativa'),
						'inline' => 'span',
						'classes'	=> 'highlight-light',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Highlight - Grey','creativa'),
						'inline' => 'span',
						'classes'	=> 'highlight-grey',
						'wrapper'	=> true,
					),
				),
			),
			array(
				'title'	=> esc_html__( 'Typography Sizes', 'creativa' ),
				'items'	=> array(
					array(
						'title'		=> esc_html__('Jumbo Class','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'jumbo',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Hero Class - H1 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'hero',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('H2 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'h2-size',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('H3 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'h3-size',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('H4 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'h4-size',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('H5 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'h5-size',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('H6 size','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'h6-size',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Page Title Class','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'creativa-title',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Page Subtitle Class','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'creativa-subtitle',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Post Title Class','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'single__title',
						'wrapper'	=> true,
					),
					array(
						'title'		=> esc_html__('Post Subtitle Class','creativa'),
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'single__post-subtitle',
						'wrapper'	=> true,
					),
				),
			),
			array(
				'title'	=> esc_html__( 'Margin Bottom', 'creativa' ),
				'items'	=> array(
					array(
						'title'		=> '0px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '0px'),
					),
					array(
						'title'		=> '5px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '5px'),
					),
					array(
						'title'		=> '10px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '10px'),
					),
					array(
						'title'		=> '15px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '15px'),
					),
					array(
						'title'		=> '20px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '20px'),
					),
					array(
						'title'		=> '30px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '30px'),
					),
					array(
						'title'		=> '40px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '40px'),
					),
					array(
						'title'		=> '50px',
						'selector'	=> 'p,h1,h2,h3,h4,h5,h6,div,hr',
						'styles'	=> array('margin-bottom' => '50px'),
					),
				),
			),
			array(
				'title'	=> esc_html__( 'Font Weights', 'creativa' ),
				'items'	=> array(
					array(
						'title'		=> esc_html__('Font Weight - 100','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-100',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 200','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-200',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 300','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-300',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 400','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-400',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 500','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-500',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 600','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-600',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 700','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-700',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 800','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-800',
						'wrapper'	=> true,
						'inline' => 'span',
					),
					array(
						'title'		=> esc_html__('Font Weight - 900','creativa'),
						// 'selector'	=> 'p,h1,h2,h3,h4,h5,h6,small',
						'classes'	=> 'font-weight-900',
						'wrapper'	=> true,
						'inline' => 'span',
					),
				),
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = true;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );
		$settings['preview_styles'] = '';

		// Return New Settings
		return $settings;

	}
}
add_filter( 'tiny_mce_before_init', 'creativa_formats_tinymce' );

function creativa_add_my_editor_style() {
	add_editor_style( THEMEROOT.'/loprdCore/css/editor-style.css');
}
add_action( 'admin_init', 'creativa_add_my_editor_style' );

?>