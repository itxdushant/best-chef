<?php

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;


// Reorganize Elements --------------------


vc_remove_element("vc_images_carousel");
vc_remove_element("vc_button");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_separator");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_masonry_media_grid");

vc_remove_element("vc_btn");
vc_remove_element("vc_cta");

vc_remove_element("vc_tta_tabs");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_accordion");


vc_remove_element("vc_section");







// VC MAP ------------------------------- //

$target_arr = array(
    esc_html__( 'Same window', 'creativa' ) => '_self',
    esc_html__( 'New window', 'creativa' ) => "_blank"
);

$add_css_animation = array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'CSS Animation', 'creativa' ),
    'param_name' => 'css_animation',
    'admin_label' => true,
    'edit_field_class' => 'vc_col-sm-7 vc_column first_line',
    'value' => array(
        esc_html__( 'No', 'creativa' ) => '',
        esc_html__( 'Fade In', 'creativa' ) => "fade-in",
        esc_html__( 'Top to bottom', 'creativa' ) => 'top-to-bottom',
        esc_html__( 'Bottom to top', 'creativa' ) => 'bottom-to-top',
        esc_html__( 'Left to right', 'creativa' ) => 'left-to-right',
        esc_html__( 'Right to left', 'creativa' ) => 'right-to-left',
        esc_html__( 'Appear from center', 'creativa' ) => "appear",
    ),
    'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'creativa' )
);

$add_css_animation_delay = array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Animation Delay', 'creativa' ),
    'param_name' => 'css_animation_delay',
    'value' => '0',
    'edit_field_class' => 'vc_col-sm-5 vc_column',
    'description' => esc_html__( 'Animation Delay in miliseconds. Eg. 1000 - 1sec', 'creativa' ),
    // 'group' => esc_html__( 'Design options', 'creativa' )
);

$canvas_anims = array(
      esc_html__( 'None', 'creativa' ) => 'none',
      esc_html__( 'Animation - Lava Lamp', 'creativa' ) => 'metaBalls',
      esc_html__( 'Animation - Bouncy Polygons', 'creativa' ) => 'bouncyPolygons',
      // esc_html__( 'Animation - Bouncy Bubbles', 'creativa' ) => 'bouncyBalls',
      esc_html__( 'Animation - iBubbles', 'creativa' ) => 'slowBubbles',
      esc_html__( 'Animation - Confetti', 'creativa' ) => 'confetti',
      esc_html__( 'Animation - Lines Rain', 'creativa' ) => 'linesRain',
      esc_html__( 'Animation - Film Grain', 'creativa' ) => 'filmGrain',
);

function creativa_css_animation() {
    return array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'CSS Animation', 'creativa' ),
        'param_name' => 'css_animation',
        'admin_label' => true,
        'edit_field_class' => 'vc_col-sm-7 vc_column first_line',
        'value' => array(
            esc_html__( 'No', 'creativa' ) => '',
            esc_html__( 'Fade In', 'creativa' ) => "fade-in",
            esc_html__( 'Top to bottom', 'creativa' ) => 'top-to-bottom',
            esc_html__( 'Bottom to top', 'creativa' ) => 'bottom-to-top',
            esc_html__( 'Left to right', 'creativa' ) => 'left-to-right',
            esc_html__( 'Right to left', 'creativa' ) => 'right-to-left',
            esc_html__( 'Appear from center', 'creativa' ) => "appear",
        ),
        'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'creativa' )
    );
}

function creativa_css_animation_delay() {
    return array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Animation Delay', 'creativa' ),
        'param_name' => 'css_animation_delay',
        'value' => '0',
        'edit_field_class' => 'vc_col-sm-5 vc_column',
        'description' => esc_html__( 'Animation Delay in miliseconds. Eg. 1000 - 1sec', 'creativa' ),
        // 'group' => esc_html__( 'Design options', 'creativa' )
    );
}

function creativa_canvas_animation() {
    return array(
          esc_html__( 'None', 'creativa' ) => 'none',
          esc_html__( 'Animation - Lava Lamp', 'creativa' ) => 'metaBalls',
          esc_html__( 'Animation - Bouncy Polygons', 'creativa' ) => 'bouncyPolygons',
          // esc_html__( 'Animation - Bouncy Bubbles', 'creativa' ) => 'bouncyBalls',
          esc_html__( 'Animation - iBubbles', 'creativa' ) => 'slowBubbles',
          esc_html__( 'Animation - Confetti', 'creativa' ) => 'confetti',
          esc_html__( 'Animation - Lines Rain', 'creativa' ) => 'linesRain',
          esc_html__( 'Animation - Film Grain', 'creativa' ) => 'filmGrain',
    );
}

// Row --------------------
vc_map( array(
    'name' => esc_html__( 'Row', 'creativa' ),
    'base' => 'vc_row',
    'weight' => 10,
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'show_settings_on_create' => false,
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Place content elements inside the row', 'creativa' ),
    'params' => array(
        array(
            'type' => 'el_id',
            'heading' => esc_html__( 'Row ID', 'creativa' ),
            'param_name' => 'el_id',
            'description'   => sprintf( wp_kses( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%1$s" target="_blank">w3c specification</a>)', 'creativa' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'http://www.w3schools.com/tags/att_global_id.asp' ) ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Row Content', 'creativa' ),
            'param_name' => 'full_width_content',
            'value' => array(
                esc_html__('Standard with Container', 'creativa') => 'standard',
                esc_html__('Collapsed Columns', 'creativa') => 'collapsed',
                esc_html__('Full Window Width', 'creativa') => 'full-width',
            ),
            'std' => 'standard',
            // 'group' => esc_html__( 'Design options', 'creativa' ),
            // "admin_label" => true,
        ),

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'common_height',
            'value' => array(
                              esc_html__( 'Columns Equal Height', 'creativa' ) => 'true',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            // 'dependency' => array( 'element' => 'full_width_content', 'value' => array('full-width', 'collapsed')),
            // 'group' => esc_html__( 'Design options', 'creativa' )
            'std' => '',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Row Min Height', 'creativa' ),
            'param_name' => 'row_height',
            'description' => esc_html__( 'Type minimum height of the row. (Note: CSS measurement units and "calc" allowed)', 'creativa' ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Row Vertical Align', 'creativa' ),
            'param_name' => 'vertical_align',
            'value' => array(
                esc_html__('None', 'creativa') => 'none',
                esc_html__('Top', 'creativa') => 'top',
                esc_html__('Middle', 'creativa') => 'middle',
                esc_html__('Bottom', 'creativa') => 'bottom',
            ),
            'std' => 'none',
            'dependency' => array( 'element' => 'row_height', 'not_empty' => true),
            // 'group' => esc_html__( 'Design options', 'creativa' ),
            // "admin_label" => true,
        ),


        $add_css_animation,
        $add_css_animation_delay,


        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
        ),

        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Style', 'creativa' ),
            'param_name' => 'bg_style',
            'value' => array(
                              esc_html__( 'Standard Background', 'creativa' ) => 'standard',
                              esc_html__( 'Parallax Background', 'creativa' ) => 'parallax',
                              esc_html__( 'Video Background', 'creativa' ) => 'video',
                        ),
            'description' => esc_html__( 'Select background style.', 'creativa' ),
            //'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Position', 'creativa' ),
            'param_name' => 'background_position',
            'value' => array(
                              '-' => '',
                              esc_html__( 'Left Top', 'creativa' ) => 'left top',
                              esc_html__( 'Left Center ', 'creativa' ) => 'left center',
                              esc_html__( 'Left Bottom ', 'creativa' ) => 'left bottom',
                              esc_html__( 'Center Top ', 'creativa' ) => 'center top',
                              esc_html__( 'Center Center ', 'creativa' ) => 'center center',
                              esc_html__( 'Center Bottom ', 'creativa' ) => 'center bottom',
                              esc_html__( 'Right Top ', 'creativa' ) => 'right top',
                              esc_html__( 'Right Center ', 'creativa' ) => 'right center',
                              esc_html__( 'Right Bottom ', 'creativa' ) => 'right bottom',
                        ),
            'std' => '',
            'dependency' => array( 'element' => 'bg_style', 'value' => array('standard', 'parallax')),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'bg_attachment_fixed',
            'value' => array(
                              esc_html__( 'Background Attachment: Fixed', 'creativa' ) => 'bg-fixed',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            'dependency' => array( 'element' => 'bg_style', 'value' => 'standard'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__( 'Video Sources', 'creativa' ),
            'param_name' => 'textarea_video_urls',
            'description' => esc_html__( 'Paste here .mp4/.webm/.ogg video urls* or vimeo/youtube url*.<br> *<i>one url in one line.</i><br>**<i>only one youtube or vimeo video per page!</i>', 'creativa' ),
            'dependency' => array( 'element' => 'bg_style', 'value' => 'video'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Overlay Color', 'creativa' ),
            'param_name' => 'bg_overlay_color',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_overlay', 'not_empty' => true),
            'edit_field_class' => 'vc_col-sm-6 vc_column first_line',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Overlay Gradient Color 2 (optional)', 'creativa' ),
            'param_name' => 'bg_overlay_color_2',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            'dependency' => array( 'element' => 'bg_overlay_color', 'not_empty' => true),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Overlay Gradient Direction', 'creativa' ),
            'param_name' => 'bg_overlay_gradient_dir',
            'value' => array(
                  esc_html__( 'Top to Bottom', 'creativa' ) => '180deg',
                  esc_html__( 'Left to Right', 'creativa' ) => '90deg',
                  esc_html__( 'Top-Left to Bottom-Right', 'creativa' ) => '135deg',
            ),
            'std' => '180deg',
            'dependency' => array( 'element' => 'bg_overlay_color_2', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        // 1:metaBalls
        // 2:bouncyPolygons,
        // 3:bouncyBalls,
        // 4:slowBubbles,
        // 5:confetti,
        // 'Animation - Lava Lamp',
        // 'Animation - Bouncy Polygons',
        // 'Animation - Bouncy Bubbles',
        // 'Animation - iBubbles',
        // 'Animation - Confetti',

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Animation', 'creativa' ),
            'param_name' => 'animated_canvas',
            'value' => $canvas_anims,
            'std' => 'none',
            // 'dependency' => array( 'element' => 'bg_style', 'value' => array('standard', 'parallax')),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Animation Color', 'creativa' ),
            'param_name' => 'animated_canvas_color',
            'value' => 'rgba(0,0,0,0.1)',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            'dependency' => array( 'element' => 'animated_canvas', 'value' => array('metaBalls','bouncyPolygons','bouncyBalls','slowBubbles','confetti','linesRain')),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Animation Elements Count', 'creativa' ),
            'param_name' => 'animated_canvas_count',
            'value' => '15',
            'dependency' => array( 'element' => 'animated_canvas', 'value' => array('metaBalls','bouncyPolygons','bouncyBalls','slowBubbles')),
            'description' => esc_html__( 'Integer number of elements.', 'creativa' ),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),

        // - row-separator--top--slanted-1l
        // - row-separator--top--slanted-1r
        // - row-separator--top--slanted-2l
        // - row-separator--top--slanted-2r
        // - row-separator--top--zigzag
        // - row-separator--top--boxes
        // - row-separator--top--arrow
        // - row-separator--top--svg
        // -- triangle_convex_top
        // -- triangle_concave_top
        // -- curve_convex_top
        // -- curve_concave_top

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Top Separator', 'creativa' ),
            'param_name' => 'inner_separator_top',
            // "admin_label" => true,
            // "holder"    => "h3",
            // 'edit_field_class' => 'vc_col-sm-8 vc_column',
            'value' => array(
                        esc_html__( 'None', 'creativa' ) => 0,
                        esc_html__( 'Slanted 1Deg Left', 'creativa' ) => 1,
                        esc_html__( 'Slanted 1Deg Right', 'creativa' ) => 2,
                        esc_html__( 'Slanted 2Deg Left', 'creativa' ) => 3,
                        esc_html__( 'Slanted 2Deg Right', 'creativa' ) => 4,
                        esc_html__( 'Zigzag', 'creativa' ) => 5,
                        esc_html__( 'Boxes', 'creativa' ) => 6,
                        esc_html__( 'Arrow', 'creativa' ) => 7,
                        esc_html__( 'Triangle Convex', 'creativa' ) => 8,
                        esc_html__( 'Triangle Concave', 'creativa' ) => 9,
                        esc_html__( 'Curve Convex', 'creativa' ) => 10,
                        esc_html__( 'Curve Concave', 'creativa' ) => 11,
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            "std"    => 0,
            'group' => esc_html__( 'Inner Row Separator', 'creativa' ),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Top Separator Color', 'creativa' ),
            'param_name' => 'inner_separator_top_color',
            'value' => '',
            'description' => esc_html__( 'Default: same as theme .content background', 'creativa' ),
            'dependency' => array( 'element' => 'inner_separator_top', 'value' => array('1','2','3','4','5','6','7','8','9','10','11')),
            'group' => esc_html__( 'Inner Row Separator', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Bottom Separator', 'creativa' ),
            'param_name' => 'inner_separator_bottom',
            // "admin_label" => true,
            // "holder"    => "h3",
            // 'edit_field_class' => 'vc_col-sm-8 vc_column',
            'value' => array(
                        esc_html__( 'None', 'creativa' ) => 0,
                        esc_html__( 'Slanted 1Deg Left', 'creativa' ) => 1,
                        esc_html__( 'Slanted 1Deg Right', 'creativa' ) => 2,
                        esc_html__( 'Slanted 2Deg Left', 'creativa' ) => 3,
                        esc_html__( 'Slanted 2Deg Right', 'creativa' ) => 4,
                        esc_html__( 'Zigzag', 'creativa' ) => 5,
                        esc_html__( 'Boxes', 'creativa' ) => 6,
                        esc_html__( 'Arrow', 'creativa' ) => 7,
                        esc_html__( 'Triangle Convex', 'creativa' ) => 8,
                        esc_html__( 'Triangle Concave', 'creativa' ) => 9,
                        esc_html__( 'Curve Convex', 'creativa' ) => 10,
                        esc_html__( 'Curve Concave', 'creativa' ) => 11,
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            "std"    => 0,
            'group' => esc_html__( 'Inner Row Separator', 'creativa' ),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Bottom Separator Color', 'creativa' ),
            'param_name' => 'inner_separator_bottom_color',
            'value' => '',
            'description' => esc_html__( 'Default: same as theme .content background', 'creativa' ),
            'dependency' => array( 'element' => 'inner_separator_bottom', 'value' => array('1','2','3','4','5','6','7','8','9','10','11')),
            'group' => esc_html__( 'Inner Row Separator', 'creativa' ),
        ),
    ),
    'js_view' => 'VcRowView'
) );

vc_map( array(
    'name' => esc_html__( 'Row', 'creativa' ), //Inner Row
    'base' => 'vc_row_inner',
    'content_element' => false,
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'weight' => 1000,
    'show_settings_on_create' => false,
    'description' => esc_html__( 'Place content elements inside the row', 'creativa' ),
    'params' => array(
        array(
            'type' => 'el_id',
            'heading' => esc_html__( 'Row ID', 'creativa' ),
            'param_name' => 'el_id',
            'description'   => sprintf( wp_kses( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%1$s" target="_blank">w3c specification</a>)', 'creativa' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'http://www.w3schools.com/tags/att_global_id.asp' ) ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Row Content', 'creativa' ),
            'param_name' => 'full_width_content',
            'value' => array(
                esc_html__('Standard with Container', 'creativa') => 'standard',
                esc_html__('Collapsed Columns', 'creativa') => 'collapsed',
            ),
            'std' => 'standard',
            // 'group' => esc_html__( 'Design options', 'creativa' ),
            // "admin_label" => true,
        ),

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'common_height',
            'value' => array(
                              esc_html__( 'Columns Equal Height', 'creativa' ) => 'true',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            // 'dependency' => array( 'element' => 'full_width_content', 'value' => array('full-width', 'collapsed')),
            // 'group' => esc_html__( 'Design options', 'creativa' )
            'std' => '',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Row Min Height', 'creativa' ),
            'param_name' => 'row_height',
            'description' => esc_html__( 'Type minimum height of the row. (Note: CSS measurement units and "calc" allowed)', 'creativa' ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Row Vertical Align', 'creativa' ),
            'param_name' => 'vertical_align',
            'value' => array(
                esc_html__('None', 'creativa') => 'none',
                esc_html__('Top', 'creativa') => 'top',
                esc_html__('Middle', 'creativa') => 'middle',
                esc_html__('Bottom', 'creativa') => 'bottom',
            ),
            'std' => 'none',
            'dependency' => array( 'element' => 'row_height', 'not_empty' => true),
            // 'group' => esc_html__( 'Design options', 'creativa' ),
            // "admin_label" => true,
        ),

        $add_css_animation,
        $add_css_animation_delay,


        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Style', 'creativa' ),
            'param_name' => 'bg_style',
            'value' => array(
                              esc_html__( 'Standard Background', 'creativa' ) => 'standard',
                              esc_html__( 'Parallax Background', 'creativa' ) => 'parallax',
                              esc_html__( 'Video Background', 'creativa' ) => 'video',
                        ),
            'description' => esc_html__( 'Select background style.', 'creativa' ),
            //'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Position', 'creativa' ),
            'param_name' => 'background_position',
            'value' => array(
                              '-' => '',
                              esc_html__( 'Left Top', 'creativa' ) => 'left top',
                              esc_html__( 'Left Center ', 'creativa' ) => 'left center',
                              esc_html__( 'Left Bottom ', 'creativa' ) => 'left bottom',
                              esc_html__( 'Center Top ', 'creativa' ) => 'center top',
                              esc_html__( 'Center Center ', 'creativa' ) => 'center center',
                              esc_html__( 'Center Bottom ', 'creativa' ) => 'center bottom',
                              esc_html__( 'Right Top ', 'creativa' ) => 'right top',
                              esc_html__( 'Right Center ', 'creativa' ) => 'right center',
                              esc_html__( 'Right Bottom ', 'creativa' ) => 'right bottom',
                        ),
            'std' => '',
            'dependency' => array( 'element' => 'bg_style', 'value' => array('standard', 'parallax')),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),


        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'bg_attachment_fixed',
            'value' => array(
                              esc_html__( 'Background Attachment: Fixed', 'creativa' ) => 'bg-fixed',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            'dependency' => array( 'element' => 'bg_style', 'value' => 'standard'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__( 'Video Sources', 'creativa' ),
            'param_name' => 'textarea_video_urls',
            'description' => esc_html__( 'Paste here .mp4/.webm/.ogg video urls* or vimeo/youtube url*.<br> *<i>one url in one line.</i><br>**<i>only one youtube or vimeo video per page!</i>', 'creativa' ),
            'dependency' => array( 'element' => 'bg_style', 'value' => 'video'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Overlay Color', 'creativa' ),
            'param_name' => 'bg_overlay_color',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_overlay', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Overlay Gradient Color 2 (optional)', 'creativa' ),
            'param_name' => 'bg_overlay_color_2',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            'dependency' => array( 'element' => 'bg_overlay_color', 'not_empty' => true),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Overlay Gradient Direction', 'creativa' ),
            'param_name' => 'bg_overlay_gradient_dir',
            'value' => array(
                  esc_html__( 'Top to Bottom', 'creativa' ) => '180deg',
                  esc_html__( 'Left to Right', 'creativa' ) => '90deg',
                  esc_html__( 'Top-Left to Bottom-Right', 'creativa' ) => '135deg',
            ),
            'std' => '180deg',
            'dependency' => array( 'element' => 'bg_overlay_color_2', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Position', 'creativa' ),
            'param_name' => 'animated_canvas',
            'value' => $canvas_anims,
            'std' => 'none',
            // 'dependency' => array( 'element' => 'bg_style', 'value' => array('standard', 'parallax')),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Overlay Color', 'creativa' ),
            'param_name' => 'animated_canvas_color',
            'value' => 'rgba(0,0,0,0.1)',
            'description' => esc_html__( 'Select overlay layer color', 'creativa' ),
            'dependency' => array( 'element' => 'animated_canvas', 'value' => array('metaBalls','bouncyPolygons','bouncyBalls','slowBubbles','confetti','linesRain')),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Elements Count', 'creativa' ),
            'param_name' => 'animated_canvas_count',
            'value' => '15',
            'dependency' => array( 'element' => 'animated_canvas', 'value' => array('metaBalls','bouncyPolygons','bouncyBalls','slowBubbles')),
            'description' => esc_html__( 'Integer number of elements.', 'creativa' ),
            'group' => esc_html__( 'Animated Canvas', 'creativa' )
        ),
    ),
    'js_view' => 'VcRowView'
) );

// Timeline --------------------
vc_map( array(
    "name" => esc_html__("Timeline", "creativa"),
    "base" => "loprd_timeline",
    "icon" => "loprd-icon-timeline",
    'category' => esc_html__( 'Content', 'creativa' ),
    "as_parent" => array('only' => 'loprd_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => true,
    'description' => esc_html__( 'A list of events in chronological order.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Timeline Axis Position', 'creativa' ),
            'param_name' => 'timeline_style',
            'value' => array(
                              esc_html__( 'Left', 'creativa' ) => 'left',
                              esc_html__( 'Center', 'creativa' ) => 'center',
                              esc_html__( 'Right', 'creativa' ) => 'right',
                        ),
            'std' => 'center',
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Line Color', 'creativa' ),
            'param_name' => 'line_color',
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icons Color', 'creativa' ),
            'param_name' => 'line_icons',
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => esc_html__("Timeline Block", "creativa"),
    "base" => "loprd_timeline_block",
    "icon" => "loprd-icon-timeline",
    'category' => esc_html__( 'Content', 'creativa' ),
    "content_element" => true,
    "as_child" => array('only' => 'loprd_timeline'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),

        $add_css_animation,
        $add_css_animation_delay,

        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "creativa"),
            "param_name" => "title",
            'value' => esc_html__('Timeline Block Header', 'creativa'),
            // "admin_label" => true,
            "holder"    => "h4",
            "description" => esc_html__("Timeline Block Title", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Date", "creativa"),
            "param_name" => "date",
            'value' => esc_html__('November 2015', 'creativa'),
            "admin_label" => true,
            "description" => esc_html__("Timeline Block Date", "creativa")
        ),
        array(
            "type" => "textarea_html",
            "heading" => esc_html__("Timeline Block Content", "creativa"),
            "param_name" => "content",
            'value' => 'Morbi facilisis risus id malesuada accumsan. Ut at augue condimentum, blandit ante in, luctus eros.',
            "holder"    => "p",
            // "admin_label" => true,
        ),


        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title Color', 'creativa' ),
            'param_name' => 'tb_title_color',
            // 'value' => '#262626',
            // 'description' => esc_html__( 'Select background color', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_loprd_timeline extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_timeline_block extends WPBakeryShortCode {
    }
}




// Icon Box -----------------------------
vc_map( array(
    "name" => esc_html__("Icon Box", "creativa"),
    "base" => "loprd_iconbox",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-iconbox",
    "show_settings_on_create" => true,
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Content block with icon.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'creativa' ),
            "admin_label" => true,
            'value' => array(
                esc_html__( 'Font Awesome', 'creativa' ) => 'fontawesome',
                esc_html__( 'Open Iconic', 'creativa' ) => 'openiconic',
                esc_html__( 'Typicons', 'creativa' ) => 'typicons',
                esc_html__( 'Entypo', 'creativa' ) => 'entypo',
                esc_html__( 'Linecons', 'creativa' ) => 'linecons',
                esc_html__( 'Mono Social', 'creativa' ) => 'monosocial',
                esc_html__( 'Material', 'creativa' ) => 'material',
                esc_html__( 'Upload Custom Image', 'creativa' ) => 'upload_image',
            ),
            'param_name' => 'icon',
            'description' => esc_html__( 'Select icon library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_fontawesome',
            // "admin_label" => true,
            'value' => 'fa fa-info-circle',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_openiconic',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'openiconic',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_typicons',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
            'element' => 'icon',
            'value' => 'typicons',
        ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_entypo',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 300, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_linecons',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'linecons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_monosocial',
            'value' => 'vc-mono vc-mono-fivehundredpx',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'monosocial',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'monosocial',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_material',
            'value' => 'vc-material vc-material-cake',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'material',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'material',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Upload Image', 'creativa' ),
            'param_name' => 'icon_img',
            "admin_label" => true,
            'description' => esc_html__( 'Upload your own image instead icon.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'upload_image',
            ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "creativa"),
            "param_name" => "iconbox_title",
            // "admin_label" => true,
            'value' => '',
            "holder"    => "h4",
            //"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "textarea_html",
            "heading" => esc_html__("Content", "creativa"),
            "param_name" => "content",
            'value' => '',
            "holder"    => "p",
            // "admin_label" => true,
        ),
        array(
            "type" => "vc_link",
            "heading" => esc_html__("Button Link", "creativa"),
            "param_name" => "iconbox_readmore_link",
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // "admin_label" => true,
            // "holder"    => "a",
            //"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Button Text", "creativa"),
            "param_name" => "iconbox_readmore_text",
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // "admin_label" => true,
            'value' => esc_html__('Read more', 'creativa'),
            // "holder"    => "h4",
            //"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),


        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Box Style', 'creativa' ),
            'param_name' => 'iconbox_title_style',
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6',
            'value' => array(
                        esc_html__( 'Block', 'creativa' ) => 'block',
                        esc_html__( 'Inline', 'creativa' ) => 'inline',
                        ),
            // 'description' => esc_html__( 'Select style of iconbox title.', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Box Layout', 'creativa' ),
            'param_name' => 'iconbox_border',
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                              esc_html__( 'Simple', 'creativa' ) => '',
                              esc_html__( 'Boxed', 'creativa' ) => 'border',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            // 'dependency' => array( 'element' => 'row_height', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Iconbox Align', 'creativa' ),
            'param_name' => 'iconbox_align',
            // "admin_label" => true,
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'left',
                        esc_html__( 'Center', 'creativa' ) => 'center',
                        esc_html__( 'Right', 'creativa' ) => 'right',
                        ),
            'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Iconbox Inline Align', 'creativa' ),
            'param_name' => 'iconbox_inline_align',
            // "admin_label" => true,
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'left',
                        esc_html__( 'Right', 'creativa' ) => 'right',
                        ),
            'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'std' => 'left',
            'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'inline'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Iconbox Header Size', 'creativa' ),
            'param_name' => 'ib_header_size',
            // 'edit_field_class' => 'vc_col-sm-8 vc_column',
            // "admin_label" => true,
            'value' => array(
                        // esc_html__( 'H1', 'creativa' ) => 'h1',
                        esc_html__( 'H2', 'creativa' ) => 'h2',
                        esc_html__( 'H3', 'creativa' ) => 'h3',
                        esc_html__( 'H4', 'creativa' ) => 'h4',
                        esc_html__( 'H5', 'creativa' ) => 'h5',
                        esc_html__( 'H6', 'creativa' ) => 'h6',
                        ),
            'std' => 'h4',
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Header Color', 'creativa' ),
            'param_name' => 'ib_title_color',
            // 'edit_field_class' => 'vc_col-sm-4 vc_column',
            // 'value' => '#262626',
            // 'description' => esc_html__( 'Select background color', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Style', 'creativa' ),
            'param_name' => 'ib_icon_style',
            // "admin_label" => true,
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                        esc_html__( 'No Background', 'creativa' ) => 'no-bg',
                        esc_html__( 'Square Background', 'creativa' ) => 'bg-square',
                        esc_html__( 'Circle Background', 'creativa' ) => 'bg-circle',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Size', 'creativa' ),
            'param_name' => 'ib_icon_size',
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            // "admin_label" => true,
            'value' => array(
                        esc_html__( 'Normal', 'creativa' ) => 'normal',
                        esc_html__( 'Large', 'creativa' ) => 'large',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon Color', 'creativa' ),
            'param_name' => 'ib_icon_color',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // 'value' => '#262626',
            // 'description' => esc_html__( 'Select background color', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon BG Color', 'creativa' ),
            'param_name' => 'ib_icon_bg',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // 'value' => '#262626',
            // 'description' => esc_html__( 'Select background color', 'creativa' ),
            'dependency' => array( 'element' => 'ib_icon_style', 'value' => array('bg-square', 'bg-circle') ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background Color', 'creativa' ),
            'param_name' => 'ib_border_bg',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // 'value' => '#ffffff',
            // 'description' => esc_html__( 'Select background color', 'creativa' ),
            'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'creativa' ),
            'param_name' => 'ib_border_bcolor',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Select border color', 'creativa' ),
            'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_iconbox extends WPBakeryShortCode {
    }
}





// Blog -----------------------------

$get_blog_categories = get_categories();
$blog_categories = array();
foreach ($get_blog_categories as $type) {
    $blog_categories[$type->name] = $type->cat_ID;
}

$get_blog_tags = get_tags();
$blog_tags = array();
foreach ($get_blog_tags as $type) {
    $blog_tags[$type->name] = $type->term_id;
}

$allUsers = get_users('orderby=post_count&order=DESC');
$users = array();
$authors_list = array();
foreach($allUsers as $currentUser) {
    if(in_array( 'author', $currentUser->roles ) 
    || in_array( 'administrator', $currentUser->roles ) 
    || in_array( 'editor', $currentUser->roles ) 
    || in_array( 'contributor', $currentUser->roles ) ) {
        $users[] = $currentUser;
    }
}
foreach ($users as $user) {
    $authors_list[$user->display_name] = $user->ID;
}


$order = array(
    esc_html__('ASC - lowest to highest', 'creativa') => 'ASC',
    esc_html__('DESC - highest to lowest', 'creativa') => 'DESC',
);

$orderby = array(
    esc_html__('Date', 'creativa') => 'date',
    esc_html__('Comment Count', 'creativa') => 'comment_count',
    esc_html__('Random', 'creativa') => 'rand',
    esc_html__('Post ID', 'creativa') => 'ID',
    esc_html__('Post Title', 'creativa') => 'title',
    esc_html__('Author', 'creativa') => 'author',
    esc_html__('Last Modified', 'creativa') => 'modified',
);

vc_map( array(
    "name" => esc_html__("Blog", "creativa"),
    "base" => "loprd_blog",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "show_settings_on_create" => false,
    'category' => esc_html__( 'Loop', 'creativa' ),
    'description' => esc_html__( 'Place Blog content.', 'creativa' ),
    "icon" => "loprd-icon-blog",
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class Here:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Blog Settings', 'creativa' ),
            'param_name' => 'blog_ovr_settings',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Global Theme Settings', 'creativa' ) => 'global',
                        esc_html__( 'Custom Settings', 'creativa' ) => 'custom',
                        ),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'std' => 'global',
        ),

        // array(
        //     'type' => 'separator',
        //     'heading' => '',
        //     'param_name' => rand(0, 99),
        //     'value' => '',
        //     'group' => esc_html__( 'Display settings', 'creativa' ),
        // ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Posts per Page", "creativa"),
            "param_name" => "posts_number",
            // "admin_label" => true,
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
            'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
            'value' => 0,
            // "holder"    => "h4",
            'group' => esc_html__( 'Display settings', 'creativa' ),
            "description" => esc_html__("'-1' - shows all posts. '0' to get global theme settings.", "creativa"),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Order By', 'creativa' ),
            'param_name' => 'orderby',
            // "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
            'value' => $orderby,
            "std"    => 'date',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Order', 'creativa' ),
            'param_name' => 'order',
            // "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
            'value' => $order,
            "std"    => 'DESC',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Blog Layout', 'creativa' ),
            'param_name' => 'blog_ovr_style',
            'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Standard', 'creativa' ) => 1,
                        esc_html__( 'Masonry', 'creativa' ) => 2,
                        ),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'std' => 1,
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),


        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Posts Thumbnails/Media', 'creativa' ),
            'param_name' => 'display_ovr_media',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 1,
                        esc_html__( 'Hide', 'creativa' ) => 0,
                        ),
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element first_line',
            "std"    => 1,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Custom post media styles', 'creativa' ),
            'param_name' => 'allow_ovr_media_styles',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Enabled', 'creativa' ) => 1,
                        esc_html__( 'Disabled', 'creativa' ) => 0,
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
            "std"    => 1,
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content settings', 'creativa' ),
            'param_name' => 'content_ovr_settings',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display Full', 'creativa' ) => 0,
                        esc_html__( 'Display Excerpt', 'creativa' ) => 1,
                        ),
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element first_line',
            'dependency' => array( 'element' => 'display_content', 'value' => 'display-content'),
            "std"    => 1,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Category/Categories', 'creativa' ),
            'param_name' => 'display_ovr_categories',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 1,
                        esc_html__( 'Hide', 'creativa' ) => 0,
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column first_line',
            "std"    => true,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Date', 'creativa' ),
            'param_name' => 'display_ovr_date',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 1,
                        esc_html__( 'Hide', 'creativa' ) => 0,
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            "std"    => true,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Comments Count', 'creativa' ),
            'param_name' => 'display_ovr_comments',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 1,
                        esc_html__( 'Hide', 'creativa' ) => 0,
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            "std"    => 1,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Author', 'creativa' ),
            'param_name' => 'display_ovr_author',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 1,
                        esc_html__( 'Hide', 'creativa' ) => 0,
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            "std"    => 1,
            'group' => esc_html__( 'Display settings', 'creativa' ),
            'dependency' => array( 'element' => 'blog_ovr_settings', 'value' => 'custom'),
        ),






        array(
            "type" => "checkbox",
            "heading" => '<strong style="color:red">' . esc_html__('Leave fields unchecked to display all.', 'creativa') . '</strong><br><br>' . esc_html__("Categories", "creativa"),
            "param_name" => "categories",
            "value" => $blog_categories,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // 'description' => '<strong style="color:red">' . esc_html__('Leave fields unchecked to display all.', 'creativa') . '</strong>',
            // "description" => esc_html__("For All Categories leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Tags", "creativa"),
            "param_name" => "tags",
            "value" => $blog_tags,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Authors", "creativa"),
            "param_name" => "authors",
            "value" => $authors_list,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'exclude_by',
            'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
            'value' => array(
                              esc_html__( 'Select to exclude', 'creativa' ) => 'exclude',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            'std' => '',
            'group' => esc_html__( 'Filter by', 'creativa' ),
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Categories", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_categories",
            "value" => $blog_categories,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Categories leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Tags", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_tags",
            'group' => esc_html__( 'Filter by', 'creativa' ),
            "value" => $blog_tags,
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Authors", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_authors",
            'group' => esc_html__( 'Filter by', 'creativa' ),
            "value" => $authors_list,
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),


    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_blog extends WPBakeryShortCode {
    }
}

// Recent Posts -----------------------------
vc_map( array(
    "name" => esc_html__("Posts Grid", "creativa"),
    "base" => "loprd_posts",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-recentposts",
    "show_settings_on_create" => true,
    'category' => esc_html__( 'Loop', 'creativa' ),
    'description' => esc_html__( 'Grid of Posts.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element


        array(
            "type" => "textfield",
            "heading" => esc_html__("Number of Posts", "creativa"),
            "param_name" => "posts_number",
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => 8,
            // "holder"    => "h4",
            "description" => esc_html__("Value '-1' Shows all posts.", "creativa"),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Posts Offset", "creativa"),
            "param_name" => "posts_offset",
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => 0,
            // "holder"    => "h4",
            "description" => esc_html__("Number of post to displace or pass over. 'Number of Posts' must be different than '-1'", "creativa"),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Order By', 'creativa' ),
            'param_name' => 'orderby',
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => $orderby,
            "std"    => 'date',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Order', 'creativa' ),
            'param_name' => 'order',
            "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => $order,
            "std"    => 'DESC',
        ),
        // array(
        //     'type' => 'separator',
        //     'heading' => '',
        //     'param_name' => rand(0, 99),
        //     'value' => '<hr>',
        // ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => '<strong style="color:red">' . esc_html__('Leave fields unchecked to display all.', 'creativa') . '</strong><br><br>' . esc_html__("Categories", "creativa"),
            "param_name" => "categories",
            "value" => $blog_categories,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Categories leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Tags", "creativa"),
            "param_name" => "tags",
            "value" => $blog_tags,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Authors", "creativa"),
            "param_name" => "authors",
            "value" => $authors_list,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'exclude_by',
            'value' => array(
                              esc_html__( 'Select to exclude', 'creativa' ) => 'exclude',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            'std' => '',
            'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
            'group' => esc_html__( 'Filter by', 'creativa' ),
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Categories", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_categories",
            "value" => $blog_categories,
            'group' => esc_html__( 'Filter by', 'creativa' ),
            // "description" => esc_html__("For All Categories leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Tags", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_tags",
            'group' => esc_html__( 'Filter by', 'creativa' ),
            "value" => $blog_tags,
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Exclude Authors", "creativa"),
            'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
            "param_name" => "excluded_authors",
            'group' => esc_html__( 'Filter by', 'creativa' ),
            "value" => $authors_list,
            // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
        ),


        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns', 'creativa' ),
            'param_name' => 'columns',
            "admin_label" => true,
            'value' => array(
                        esc_html__( '1 Column', 'creativa' ) => 1,
                        esc_html__( '2 Columns', 'creativa' ) => 2,
                        esc_html__( '3 Columns', 'creativa' ) => 3,
                        esc_html__( '4 Columns', 'creativa' ) => 4,
                        esc_html__( '5 Columns', 'creativa' ) => 5,
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            "std"    => 3,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Posts Style', 'creativa' ),
            'param_name' => 'rp_style',
            "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Masonry', 'creativa' ) => 'masonry',
                        esc_html__( 'Grid', 'creativa' ) => 'grid',
                        esc_html__( 'Carousel', 'creativa' ) => 'carousel',
                        ),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            // 'edit_field_class' => 'vc_col-sm-4 vc_column',
            'std' => 'masonry',
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Arrows Position', 'creativa' ),
            'param_name' => 'carousel_arrows_pos',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Sides', 'creativa' ) => 'sides',
                        esc_html__( 'Top Right', 'creativa' ) => 'top',
                        esc_html__( 'Hidden', 'creativa' ) => 'hidden',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'hidden',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            'group' => esc_html__( 'Display settings', 'creativa' ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Slides Transition', 'creativa' ),
            'param_name' => 'carousel_transition',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Move', 'creativa' ) => 'move',
                        esc_html__( 'Fade', 'creativa' ) => 'fade',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            "std"    => 'move',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Carousel Autoplay", "creativa"),
            "param_name" => "slides_autoplay",
            'value' => 0,
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            'group' => esc_html__( 'Display settings', 'creativa' ),
            "description" => esc_html__("Carousel autoplay in miliseconds. E.g: 5000. 0 to disable.", "creativa")
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Posts Thumbnails/Media', 'creativa' ),
            'param_name' => 'display_media',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-media',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-media',
                        ),
            'edit_field_class' => 'vc_col-sm-6 vc_column first_line first_element',
            "std"    => 'display-media',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Custom post media styles', 'creativa' ),
            'param_name' => 'allow_media_styles',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Enabled', 'creativa' ) => 'show',
                        esc_html__( 'Disabled', 'creativa' ) => 'hide',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'display_media', 'value' => 'display-media'),
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            "std"    => 'show',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Post Content', 'creativa' ),
            'param_name' => 'display_content',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-content',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-content',
                        ),
            'edit_field_class' => 'vc_col-sm-6 vc_column first_line first_element',
            "std"    => 'display-content',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content settings', 'creativa' ),
            'param_name' => 'content_settings',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display Full', 'creativa' ) => 'content-full',
                        esc_html__( 'Display Excerpt', 'creativa' ) => 'content-excerpt',
                        ),
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'dependency' => array( 'element' => 'display_content', 'value' => 'display-content'),
            "std"    => 'content-excerpt',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Category/Categories', 'creativa' ),
            'param_name' => 'display_categories',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-categories',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-categories',
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column first_line sep_element',
            "std"    => 'display-categories',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Date', 'creativa' ),
            'param_name' => 'display_date',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-date',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-date',
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column sep_element',
            "std"    => 'display-date',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Comments Count', 'creativa' ),
            'param_name' => 'display_comments',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-comments',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-comments',
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column sep_element',
            "std"    => 'display-comments',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Author', 'creativa' ),
            'param_name' => 'display_author',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Display', 'creativa' ) => 'display-author',
                        esc_html__( 'Hide', 'creativa' ) => 'hide-author',
                        ),
            'edit_field_class' => 'vc_col-sm-3 vc_column sep_element',
            "std"    => 'display-author',
            'group' => esc_html__( 'Display settings', 'creativa' ),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title Color', 'creativa' ),
            'param_name' => 'title_color',
            // 'value' => '#cccccc',
            'description' => esc_html__( 'Post Title color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Content/Meta Color', 'creativa' ),
            'param_name' => 'text_color',
            // 'value' => '#cccccc',
            'description' => esc_html__( 'Content text and meta info color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Post Title Size', 'creativa' ),
            'param_name' => 'title_size',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Default', 'creativa' ) => '',
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => '',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_posts extends WPBakeryShortCode {
    }
}


//Portfolio
if ( class_exists('Portfolio_Post_Type') ) {


    $portfolio_categories_url = admin_url( 'edit-tags.php?taxonomy=portfolio_category&post_type=portfolio' );
    $portfolio_tags_url = admin_url( 'edit-tags.php?taxonomy=portfolio_tag&post_type=portfolio' );

    vc_map( array(
        "name" => esc_html__("Portfolio", "creativa"),
        "base" => "loprd_portfolio",
        // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        // "content_element" => true,
        "show_settings_on_create" => true,
        "icon" => "loprd-icon-portfolio",
        'category' => esc_html__( 'Loop', 'creativa' ),
        'description' => esc_html__( 'Place Portfolio content.', 'creativa' ),
        "params" => array(
            // add params same as with any other content element   
            array(
                "type" => "textfield",
                "heading" => esc_html__("Custom Class Here:", "creativa"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
            ),    

            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Settings', 'creativa' ),
                'param_name' => 'portfolio_ovr_settings',
                "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Global Theme Settings', 'creativa' ) => 'global',
                            esc_html__( 'Custom Settings', 'creativa' ) => 'custom',
                            ),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                'std' => 'global',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Layout', 'creativa' ),
                'param_name' => 'portfolio_layout',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-8 vc_column',
                'value' => array(
                            esc_html__( '1 Column', 'creativa' ) => 1,
                            esc_html__( '2 Columns', 'creativa' ) => 2,
                            esc_html__( '3 Columns', 'creativa' ) => 3,
                            esc_html__( '4 Columns', 'creativa' ) => 4,
                            esc_html__( 'Masonry', 'creativa' ) => 5,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 3,
                'dependency' => array( 'element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Masonry Size', 'creativa' ),
                'param_name' => 'portfolio_masonry_size',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Medium', 'creativa' ) => 1,
                            esc_html__( 'Large', 'creativa' ) => 2,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 2,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Items Gap', 'creativa' ),
                'param_name' => 'portfolio_gap',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( '0px - No Gap', 'creativa' )    => 0,
                            esc_html__( '5px', 'creativa' )             => 5,
                            esc_html__( '10px', 'creativa' )            => 10,
                            esc_html__( '15px', 'creativa' )            => 15,
                            esc_html__( '20px', 'creativa' )            => 20,
                            esc_html__( '25px', 'creativa' )            => 25,
                            esc_html__( '30px', 'creativa' )            => 30,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 30,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Projects to display/per Page", "creativa"),
                "param_name" => "portfolio_ppage",
                // "admin_label" => true,
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
                'value' => -1,
                "description" => esc_html__("'-1' - shows all posts.", "creativa"),
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Projects Offset", "creativa"),
                "param_name" => "projects_offset",
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'value' => 0,
                // "holder"    => "h4",
                'group' => esc_html__( 'Display settings', 'creativa' ),
                "description" => esc_html__("Number of post to displace or pass over. 'Number of Posts' must be different than '-1'", "creativa"),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order By', 'creativa' ),
                'param_name' => 'orderby',
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => $orderby,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                "std"    => 'date',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order', 'creativa' ),
                'param_name' => 'order',
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                'value' => $order,
                "std"    => 'DESC',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Pagination', 'creativa' ),
                'param_name' => 'portfolio_paginate',
                // "admin_label" => true,
                // "holder"    => "h3",
                // 'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Enabled', 'creativa' ) => 1,
                            esc_html__( 'Disabled', 'creativa' ) => 0,
                            ),
                'description' => esc_html__( 'Works only when "Offset" is set to "0".', 'creativa' ),
                "std"    => 0,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),


            array(
                'type' => 'dropdown',
                'heading' => '<strong>'. esc_html__('Items Settings:', 'creativa') .'</strong><br><br>'. esc_html__( 'Item Style', 'creativa' ),
                'param_name' => 'portfolio_item_style',
                // "admin_label" => true,
                // "holder"    => "h3",
                // 'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Portfolio Item OnHover', 'creativa' ) => 1,
                            esc_html__( 'Portfolio Item Overlay', 'creativa' ) => 2,
                            esc_html__( 'Portfolio Item Bottom', 'creativa' ) => 3,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Categories Display', 'creativa' ),
                'param_name' => 'portfolio_item_categories',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column first_line',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Quick View Button Display', 'creativa' ),
                'param_name' => 'portfolio_item_quickview',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Like Button Display', 'creativa' ),
                'param_name' => 'portfolio_item_like',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'dependency' => array('element' => 'portfolio_ovr_settings', 'value' => 'custom'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),


            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Filtering', 'creativa' ),
                'param_name' => 'portfolio_filtering',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 0,
                'group' => esc_html__( 'Filtering settings', 'creativa' ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Sorting', 'creativa' ),
                'param_name' => 'portfolio_filtering_sorting',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                "std"    => 1,
                'group' => esc_html__( 'Filtering settings', 'creativa' ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Filtering Position', 'creativa' ),
                'param_name' => 'portfolio_filtering_position',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => array(
                            esc_html__( 'Left', 'creativa' ) => 1,
                            esc_html__( 'Center', 'creativa' ) => 2,
                            esc_html__( 'Right', 'creativa' ) => 3,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                "std"    => 1,
                'group' => esc_html__( 'Filtering settings', 'creativa' ),
            ),


            array(
                "type" => "textfield",
                "heading" => '<strong style="color:red">' . esc_html__('Leave fields unchecked to display all.', 'creativa') . '</strong><br><br>' . esc_html__("Categories", "creativa"),
                "param_name" => "categories",
                "value" => '',
                "description" => esc_html__("Type specific category/categories. Separate with comas. (E.g Case Study, Website etc.)", "creativa") . ' <a href="'. $portfolio_categories_url .'">'. esc_html__('Categories List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Tags", "creativa"),
                "param_name" => "tags",
                "value" => '',
                "description" => esc_html__("Type specific tag/tags names. Separate with comas. (E.g black, large etc.)", "creativa") . ' <a href="'. $portfolio_tags_url .'">'. esc_html__('Tags List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__("Authors", "creativa"),
                "param_name" => "authors",
                "value" => $authors_list,
                'group' => esc_html__( 'Filter by', 'creativa' ),
                // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
            ),

            array(
                'type' => 'checkbox',
                // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
                'param_name' => 'exclude_by',
                'value' => array(
                                  esc_html__( 'Select to exclude', 'creativa' ) => 'exclude',
                            ),
                // 'description' => esc_html__( 'Select background style.', 'creativa' ),
                'std' => '',
                'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Exclude Categories", "creativa"),
                "param_name" => "excluded_categories",
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "value" => '',
                "description" => esc_html__("Type specific category/categories. Separate with comas. (E.g Case Study, Website etc.)", "creativa") . ' <a href="'. $portfolio_categories_url .'">'. esc_html__('Categories List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Exclude Tags", "creativa"),
                "param_name" => "excluded_tags",
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "value" => '',
                "description" => esc_html__("Type specific tag/tags names. Separate with comas. (E.g black, large etc.)", "creativa") . ' <a href="'. $portfolio_tags_url .'">'. esc_html__('Tags List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__("Exclude Authors", "creativa"),
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "param_name" => "excluded_authors",
                'group' => esc_html__( 'Filter by', 'creativa' ),
                "value" => $authors_list,
                // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
            ),


            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title/Categories Color', 'creativa' ),
                'param_name' => 'title_color',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                // 'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Hover Background Color', 'creativa' ),
                'param_name' => 'hover_bg',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'dependency' => array( 'element' => 'portfolio_item_style', 'value' => array('1','2')),
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                // 'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                'dependency' => array( 'element' => 'portfolio_item_style', 'value' => array('1','2')),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Bottom Style: Title Background Color', 'creativa' ),
                'param_name' => 'bottom_title_bg',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                // 'dependency' => array( 'element' => 'portfolio_item_style', 'value' => '3'),
                'dependency' => array( 'element' => 'portfolio_item_style', 'value' => '3'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Filtering: Categories Color', 'creativa' ),
                'param_name' => 'filtering_color',
                'edit_field_class' => 'vc_col-sm-4 vc_column first_line sep_element',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Filtering: Categories Color - Active', 'creativa' ),
                'param_name' => 'filtering_color_active',
                'edit_field_class' => 'vc_col-sm-4 vc_column sep_element',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Filtering: Sorting Color', 'creativa' ),
                'param_name' => 'sorting_color',
                'edit_field_class' => 'vc_col-sm-4 vc_column sep_element',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_filtering', 'value' => '1'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'creativa' ),
                'param_name' => 'css',
                // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
                'group' => esc_html__( 'CSS Options', 'creativa' )
            ),
        )
    ) );
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_loprd_portfolio extends WPBakeryShortCode {
        }
    }

    //Recent Projects
    vc_map( array(
        "name" => esc_html__("Projects Grid", "creativa"),
        "base" => "loprd_projects",
        // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        // "content_element" => true,
        "icon" => "loprd-icon-recprojects",
        'category' => esc_html__( 'Loop', 'creativa' ),
        'description' => esc_html__( 'Projects grid.', 'creativa' ),
        "show_settings_on_create" => true,
        "params" => array(


            array(
                "type" => "textfield",
                "heading" => esc_html__("Number of Posts", "creativa"),
                "param_name" => "projects_number",
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
                'value' => 6,
                // "holder"    => "h4",
                "description" => esc_html__("Value '-1' Shows all posts.", "creativa"),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Posts Offset", "creativa"),
                "param_name" => "projects_offset",
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => 0,
                // "holder"    => "h4",
                "description" => esc_html__("Number of post to displace or pass over. 'Number of Posts' must be different than '-1'", "creativa"),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order By', 'creativa' ),
                'param_name' => 'orderby',
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => $orderby,
                "std"    => 'date',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order', 'creativa' ),
                'param_name' => 'order',
                "admin_label" => true,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'value' => $order,
                "std"    => 'DESC',
            ),

            $add_css_animation,
            $add_css_animation_delay,
            array(
                "type" => "textfield",
                "heading" => esc_html__("Custom Class:", "creativa"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
            ),


            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Projects Grid Layout', 'creativa' ),
                'param_name' => 'portfolio_layout',
                // "admin_label" => true,
                // "holder"    => "h3",
                // 'edit_field_class' => 'vc_col-sm-8 vc_column',
                'value' => array(
                            esc_html__( '1 Column', 'creativa' ) => 1,
                            esc_html__( '1 Column (Squared Block)', 'creativa' ) => 10,
                            esc_html__( '2 Columns', 'creativa' ) => 2,
                            esc_html__( '3 Columns', 'creativa' ) => 3,
                            esc_html__( '4 Columns', 'creativa' ) => 4,
                            esc_html__( '5 Columns', 'creativa' ) => 5,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 3,
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Style', 'creativa' ),
                'param_name' => 'rp_style',
                "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Grid', 'creativa' ) => 'grid',
                            esc_html__( 'Carousel', 'creativa' ) => 'carousel',
                            ),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                'std' => 'grid',
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                // 'group' => esc_html__( 'Design options', 'creativa' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Carousel Arrows Position', 'creativa' ),
                'param_name' => 'carousel_arrows_pos',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Sides', 'creativa' ) => 'sides',
                            esc_html__( 'Top Right', 'creativa' ) => 'top',
                            esc_html__( 'Hidden', 'creativa' ) => 'hidden',
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                "std"    => 'hidden',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'group' => esc_html__( 'Display settings', 'creativa' ),
                // 'group' => esc_html__( 'Design options', 'creativa' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Carousel Bottom Navigation', 'creativa' ),
                'param_name' => 'navigation',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Bullets', 'creativa' ) => 'bullets',
                            esc_html__( 'None', 'creativa' ) => 'none',
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                "std"    => 'bullets',
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Carousel Slides Transition', 'creativa' ),
                'param_name' => 'carousel_transition',
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( 'Move', 'creativa' ) => 'move',
                            esc_html__( 'Fade', 'creativa' ) => 'fade',
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                "std"    => 'move',
                // 'group' => esc_html__( 'Design options', 'creativa' )
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Carousel Autoplay", "creativa"),
                "param_name" => "slides_autoplay",
                'value' => 0,
                'edit_field_class' => 'vc_col-sm-6 vc_column',
                'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
                'group' => esc_html__( 'Display settings', 'creativa' ),
                "description" => esc_html__("Carousel autoplay in miliseconds. E.g: 5000. 0 to disable.", "creativa")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Portfolio Items Gap', 'creativa' ),
                'param_name' => 'portfolio_gap',
                // "admin_label" => true,
                // "holder"    => "h3",
                'value' => array(
                            esc_html__( '0px - No Gap', 'creativa' )    => 0,
                            esc_html__( '5px', 'creativa' )             => 5,
                            esc_html__( '10px', 'creativa' )            => 10,
                            esc_html__( '15px', 'creativa' )            => 15,
                            esc_html__( '20px', 'creativa' )            => 20,
                            esc_html__( '25px', 'creativa' )            => 25,
                            esc_html__( '30px', 'creativa' )            => 30,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 30,
                'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),


            array(
                'type' => 'dropdown',
                'heading' => '<strong>'. esc_html__('Items Settings:', 'creativa') .'</strong><br><br>'. esc_html__( 'Item Style', 'creativa' ),
                'param_name' => 'portfolio_item_style',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
                'value' => array(
                            esc_html__( 'Portfolio Item OnHover', 'creativa' ) => 1,
                            esc_html__( 'Portfolio Item Overlay', 'creativa' ) => 2,
                            esc_html__( 'Portfolio Item Bottom', 'creativa' ) => 3,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Categories Display', 'creativa' ),
                'param_name' => 'portfolio_item_categories',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column first_line',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Quick View Button Display', 'creativa' ),
                'param_name' => 'portfolio_item_quickview',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Like Button Display', 'creativa' ),
                'param_name' => 'portfolio_item_like',
                // "admin_label" => true,
                // "holder"    => "h3",
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'value' => array(
                            esc_html__( 'Enable', 'creativa' ) => 1,
                            esc_html__( 'Disable', 'creativa' ) => 0,
                            ),
                // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
                // 'dependency' => array( 'element' => 'iconbox_title_style', 'value' => 'block'),
                "std"    => 1,
                'group' => esc_html__( 'Display settings', 'creativa' ),
            ),


            array(
                "type" => "textfield",
                "heading" => '<strong style="color:red">' . esc_html__('Leave fields unchecked to display all.', 'creativa') . '</strong><br><br>' . esc_html__("Categories", "creativa"),
                "param_name" => "categories",
                "value" => '',
                "description" => esc_html__("Type specific category/categories. Separate with comas. (E.g Case Study, Website etc.)", "creativa") . ' <a href="'. $portfolio_categories_url .'">'. esc_html__('Categories List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Tags", "creativa"),
                "param_name" => "tags",
                "value" => '',
                "description" => esc_html__("Type specific tag/tags names. Separate with comas. (E.g black, large etc.)", "creativa") . ' <a href="'. $portfolio_tags_url .'">'. esc_html__('Tags List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__("Authors", "creativa"),
                "param_name" => "authors",
                "value" => $authors_list,
                'group' => esc_html__( 'Filter by', 'creativa' ),
                // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
            ),

            array(
                'type' => 'checkbox',
                // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
                'param_name' => 'exclude_by',
                'value' => array(
                                  esc_html__( 'Select to exclude', 'creativa' ) => 'exclude',
                            ),
                // 'description' => esc_html__( 'Select background style.', 'creativa' ),
                'std' => '',
                'edit_field_class' => 'vc_col-sm-12 vc_column sep_element',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),

            array(
                "type" => "textfield",
                "heading" => esc_html__("Exclude Categories", "creativa"),
                "param_name" => "excluded_categories",
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "value" => '',
                "description" => esc_html__("Type specific category/categories. Separate with comas. (E.g Case Study, Website etc.)", "creativa") . ' <a href="'. $portfolio_categories_url .'">'. esc_html__('Categories List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Exclude Tags", "creativa"),
                "param_name" => "excluded_tags",
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "value" => '',
                "description" => esc_html__("Type specific tag/tags names. Separate with comas. (E.g black, large etc.)", "creativa") . ' <a href="'. $portfolio_tags_url .'">'. esc_html__('Tags List', 'creativa') .'</a>',
                'group' => esc_html__( 'Filter by', 'creativa' ),
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__("Exclude Authors", "creativa"),
                'dependency' => array( 'element' => 'exclude_by', 'value' => 'exclude'),
                "param_name" => "excluded_authors",
                'group' => esc_html__( 'Filter by', 'creativa' ),
                "value" => $authors_list,
                // "description" => esc_html__("For All Tags leave this fields unchecked.", "creativa")
            ),

            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title/Categories Color', 'creativa' ),
                'param_name' => 'title_color',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                // 'dependency' => array( 'element' => 'portfolio_item_style', 'value' => '3'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Hover Background Color', 'creativa' ),
                'param_name' => 'hover_bg',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'dependency' => array( 'element' => 'portfolio_item_style', 'value' => array('1','2')),
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_item_style', 'value' => array('1','2')),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Bottom Style: Title Background Color', 'creativa' ),
                'param_name' => 'bottom_title_bg',
                // 'edit_field_class' => 'vc_col-sm-6 vc_column',
                // 'value' => '#cccccc',
                // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
                'dependency' => array( 'element' => 'portfolio_item_style', 'value' => '3'),
                'group' => esc_html__( 'Design Options', 'creativa' )
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'creativa' ),
                'param_name' => 'css',
                // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
                'group' => esc_html__( 'CSS Options', 'creativa' )
            ),

        )
    ) );
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_loprd_projects extends WPBakeryShortCode {
        }
    }
    
} // endif portfolio post type


// Testimonials -------------
vc_map( array(
    "name" => esc_html__("Testimonial", "creativa"),
    "base" => "loprd_testimonials",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-testimonial",
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Simple or bubbled testimonial block.', 'creativa' ),
    "show_settings_on_create" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textarea",
            "heading" => esc_html__("Quote", "creativa"),
            "param_name" => "testi_content",
            'value' => 'The natural desire of good men is knowledge.',
            "holder"    => "p",
            // "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Author", "creativa"),
            "param_name" => "author",
            'value' => 'John Doe',
            "holder"    => "h5",
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Function", "creativa"),
            "param_name" => "function",
            // 'value' => 'Artist',
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Author Avatar', 'creativa' ),
            'param_name' => 'avatar',
            'description' => esc_html__( 'Select avatar/photo/logo for quote author.', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class Here:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Testimonial Style', 'creativa' ),
            'param_name' => 'testi_style',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Standard', 'creativa' ) => 'standard',
                        esc_html__( 'Bordered/Bubble', 'creativa' ) => 'bordered',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'top',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Testimonial Alignment', 'creativa' ),
            'param_name' => 'testi_align',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'blockquote-left',
                        esc_html__( 'Center', 'creativa' ) => 'blockquote-center',
                        esc_html__( 'Right', 'creativa' ) => 'blockquote-right',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'blockquote-left',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Quote Size', 'creativa' ),
            'param_name' => 'quote_size',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Default', 'creativa' ) => 'testimonial-default',
                        esc_html__( 'Hero', 'creativa' ) => 'h1-size',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'testimonial-default',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Quote Color', 'creativa' ),
            'param_name' => 'quote_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'creativa' ),
            'param_name' => 'border_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Backgound Color', 'creativa' ),
            'param_name' => 'border_bg',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Author/Function Color', 'creativa' ),
            'param_name' => 'author_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'iconbox_border', 'value' => 'border'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_testimonials extends WPBakeryShortCode {
    }
}

// Pricing Table --------------------
vc_map( array(
    "name" => esc_html__("Pricing Table", "creativa"),
    "base" => "loprd_pricing_table",
    "as_parent" => array('only' => 'loprd_pricing_column'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    'category' => esc_html__( 'Content', 'creativa' ),
    "icon" => "loprd-icon-pt",
    "show_settings_on_create" => true,
    'description' => esc_html__( 'Pricing Table', 'creativa' ),
    "params" => array(
        // add params same as with any other content element
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Pricing Table Style', 'creativa' ),
            'param_name' => 'pt_style',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Bordered', 'creativa' ) => 'pricing-table--bordered',
                        esc_html__( 'Simple', 'creativa' ) => 'pricing-table--simple',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'pricing-table--bordered',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Table Border Color', 'creativa' ),
            'param_name' => 'border_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'dependency' => array( 'element' => 'pt_style', 'value' => 'pricing-table--bordered'),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Pricing Table Align', 'creativa' ),
            'param_name' => 'pt_alignment',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Center', 'creativa' ) => 'pricing-table--center',
                        esc_html__( 'Side', 'creativa' ) => 'pricing-table--side',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'pricing-table--center',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    // 'custom_markup' => '<h1>Slide</h1>',
    "js_view" => 'VcColumnView'
) );

$features_list_values = '10|Pages
1GB|Storage
Feature #4';

vc_map( array(
    "name" => esc_html__("Pricing Column", "creativa"),
    "base" => "loprd_pricing_column",
    "content_element" => true,
    'category' => esc_html__( 'Content', 'creativa' ),
    "icon" => "loprd-icon-pt",
    "as_child" => array('only' => 'loprd_pricing_table'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element

        array(
            'type' => 'checkbox',
            // 'heading' => esc_html__( 'Show Overlay', 'creativa' ),
            'param_name' => 'featured',
            'value' => array(
                              esc_html__( 'Featured Column', 'creativa' ) => 'true',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_style', 'value' => 'standard'),
            'std' => '',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Featured Text", "creativa"),
            "param_name" => "featured_text",
            'value' => 'Most Popular!',
            'dependency' => array( 'element' => 'featured', 'value' => 'true'),
            // "holder"    => "h4",
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "creativa"),
            "param_name" => "title",
            'value' => 'Title',
            "holder"    => "h4",
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Price", "creativa"),
            "param_name" => "price",
            'value' => '$19',
            "holder"    => "span",
            "description" => esc_html__("E.g. $19, 19 EUR, 19zl, etc.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Billing", "creativa"),
            "param_name" => "billing",
            'value' => '/month',
            "holder"    => "span",
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__( 'Features List', 'creativa' ),
            'param_name' => 'features_list',
            'value' => $features_list_values,
            "holder"    => "p",
            'description' => esc_html__( 'Quantity|Feature Name', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_style', 'value' => 'video'),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "vc_link",
            "heading" => esc_html__("Choose/Sign up Button", "creativa"),
            "param_name" => "choose_btn",
            'value' => 'url:|title:'. esc_html__('Choose Plan', 'creativa') .'',
            // 'value' => '',
            // "admin_label" => true,
            // "holder"    => "a",
            //"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Choose/Sign up Button Color Style', 'creativa' ),
            'param_name' => 'choose_btn_style',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Accent', 'creativa' ) => 'btn-default',
                        esc_html__( 'Dark', 'creativa' ) => 'btn-dark',
                        esc_html__( 'Light', 'creativa' ) => 'btn-light',
                        ),
            "std"    => 'btn-default',
        ),
        
        $add_css_animation,
        $add_css_animation_delay,

        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background Color', 'creativa' ),
            'param_name' => 'column_bg',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Text Color', 'creativa' ),
            'param_name' => 'column_text',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Price/Title Color', 'creativa' ),
            'param_name' => 'price_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Features List Background Color', 'creativa' ),
            'param_name' => 'features_list_bg',
            // 'value' => '#cccccc',
            'description' => esc_html__( 'Displayed for "bordered" pricing layout.', 'creativa' ),
            // 'dependency' => array( 'element' => 'testi_style', 'value' => 'bordered'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Featured Text Background Color', 'creativa' ),
            'param_name' => 'featured_bg',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'dependency' => array( 'element' => 'featured', 'value' => 'true'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Featured Text Color', 'creativa' ),
            'param_name' => 'featured_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'dependency' => array( 'element' => 'featured', 'value' => 'true'),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_loprd_pricing_table extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_pricing_column extends WPBakeryShortCode {
    }
}

// Team Member --------------------
vc_map( array(
    "name" => esc_html__("Team Member", "creativa"),
    "base" => "loprd_team_member",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-team",
    'category' => esc_html__( 'Content', 'creativa' ),
    "show_settings_on_create" => true,
    'description' => esc_html__( 'Simple team member block with photo and description.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Team Member Box Height", "creativa"),
            "param_name" => "tm_height",
            "value" => 400,
            "admin_label" => true,
            'description' => esc_html__( 'Default: 400px. Type height of the team member box. (Note: CSS measurement units and "calc" allowed)', 'creativa' ),
            // 'group' => esc_html__( 'Design options', 'creativa' ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Member Photography', 'creativa' ),
            'param_name' => 'photo',
            'description' => esc_html__( 'Select team member photography.', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Name", "creativa"),
            "param_name" => "name",
            'value' => 'Name Lastname',
            "holder"    => "h4",
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Function", "creativa"),
            "param_name" => "function",
            'value' => '',
            "holder"    => "small",
            "description" => esc_html__("Eg. Chief Executive Officer", "creativa")
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Member Bio/Description", "creativa"),
            "param_name" => "member_desc",
            'value' => '',
            "holder"    => "p",
            // "admin_label" => true,
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Name Size', 'creativa' ),
            'param_name' => 'name_size',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => 'h3-size',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Name Color', 'creativa' ),
            'param_name' => 'name_color',
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            // 'dependency' => array( 'element' => 'name', 'not_empty' => true),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Function Color', 'creativa' ),
            'param_name' => 'function_color',
            // 'dependency' => array( 'element' => 'function', 'not_empty' => true),
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Description Text Color', 'creativa' ),
            'param_name' => 'description_color',
            // 'dependency' => array( 'element' => 'function', 'not_empty' => true),
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Description BG Color', 'creativa' ),
            'param_name' => 'description_bg_color',
            // 'dependency' => array( 'element' => 'function', 'not_empty' => true),
            // 'value' => '#cccccc',
            // 'description' => esc_html__( 'Post Background color.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_team_member extends WPBakeryShortCode {
    }
}

// Social Icons --------------------
vc_map( array(
    "name" => esc_html__("Social Icons", "creativa"),
    "base" => "loprd_social_icons",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-social",
    'category' => esc_html__( 'Content', 'creativa' ),
    "show_settings_on_create" => true,
    'description' => esc_html__( 'Social websites linked icons.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icons Size', 'creativa' ),
            'param_name' => 'icons_size',
            "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Normal', 'creativa' ) => 'si-normal ',
                        esc_html__( 'Large', 'creativa' ) => 'si-large ',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'si-normal ',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icons Position', 'creativa' ),
            'param_name' => 'icons_position',
            "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'si-left ',
                        esc_html__( 'Center', 'creativa' ) => 'si-center ',
                        esc_html__( 'Right', 'creativa' ) => 'si-right ',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'si-left ',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Facebook Profile URL", "creativa"),
            "param_name" => "url_facebook",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Twitter Profile URL", "creativa"),
            "param_name" => "url_twitter",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Google Plus Profile URL", "creativa"),
            "param_name" => "url_google_plus",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Flickr Profile URL", "creativa"),
            "param_name" => "url_flickr",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("LinkedIn Profile URL", "creativa"),
            "param_name" => "url_linkedin",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Pinterest Profile URL", "creativa"),
            "param_name" => "url_pinterest",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Instagram Profile URL", "creativa"),
            "param_name" => "url_instagram",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Behance Profile URL", "creativa"),
            "param_name" => "url_behance",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Dribbble Profile URL", "creativa"),
            "param_name" => "url_dribbble",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Tumblr Profile URL", "creativa"),
            "param_name" => "url_tumblr",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("YouTube Profile URL", "creativa"),
            "param_name" => "url_youtube",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Vimeo Profile URL", "creativa"),
            "param_name" => "url_vimeo",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Vine Profile URL", "creativa"),
            "param_name" => "url_vine",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("LastFM Profile URL", "creativa"),
            "param_name" => "url_lastfm",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("DeviantArt Profile URL", "creativa"),
            "param_name" => "url_deviantart",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Digg Profile URL", "creativa"),
            "param_name" => "url_digg",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Dropbox Profile URL", "creativa"),
            "param_name" => "url_dropbox",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("FourSquare Profile URL", "creativa"),
            "param_name" => "url_foursquare",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("GitHub Profile URL", "creativa"),
            "param_name" => "url_github",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Reddit Profile URL", "creativa"),
            "param_name" => "url_reddit",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Skype Profile URL", "creativa"),
            "param_name" => "url_skype",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("SoundCloud Profile URL", "creativa"),
            "param_name" => "url_soundcloud",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Spotify Profile URL", "creativa"),
            "param_name" => "url_spotify",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Steam Profile URL", "creativa"),
            "param_name" => "url_steam",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("StumbleUpon Profile URL", "creativa"),
            "param_name" => "url_stumbleupon",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("VK Profile URL", "creativa"),
            "param_name" => "url_vk",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("WordPress Profile URL", "creativa"),
            "param_name" => "url_wordpress",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Medium Profile URL", "creativa"),
            "param_name" => "url_medium",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("Twitch Profile URL", "creativa"),
            "param_name" => "url_twitch",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            "type" => "href",
            "heading" => esc_html__("WhatsApp Profile URL", "creativa"),
            "param_name" => "url_whatsapp",
            "admin_label" => true,
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),

        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_social_icons extends WPBakeryShortCode {
    }
}

// Counter --------------------
vc_map( array(
    "name" => esc_html__("Counter", "creativa"),
    "base" => "loprd_counter",
    // "content_element" => true,
    "icon" => "loprd-icon-counter",
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Animated counter.', 'creativa' ),
    "show_settings_on_create" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Start Value", "creativa"),
            "param_name" => "start_value",
            "value" => '0',
            "admin_label" => true,
            "description" => esc_html__("E.g. 0, 10.45 etc.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("End Value", "creativa"),
            "param_name" => "end_value",
            "admin_label" => true,
            "value" => '1000',
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Decimals", "creativa"),
            "param_name" => "decimals",
            "admin_label" => true,
            "value" => '0',
            "description" => esc_html__("Set the number of decimal places (E.g. '1'). <br>Important: start value must be different than 0 (E.g '0.1')", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Prefix", "creativa"),
            "param_name" => "prefix",
            "admin_label" => true,
            "description" => esc_html__("Text before counter number. E.g. $, Number:, etc.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Suffix", "creativa"),
            "param_name" => "suffix",
            "admin_label" => true,
            "description" => esc_html__("Text after counter number. E.g. %, Countries, etc.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Subtitle", "creativa"),
            "admin_label" => true,
            "param_name" => "subtitle",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Counter Speed", "creativa"),
            "param_name" => "speed",
            "value" => '1500',
            "admin_label" => true,
            "description" => esc_html__("Counter speed in miliseconds.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Thousand Separator', 'creativa' ),
            'param_name' => 'thousand_sep',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Space', 'creativa' ) => 'space',
                        esc_html__( 'Comma', 'creativa' ) => 'comma',
                        esc_html__( 'Dot', 'creativa' ) => 'dot',
                        esc_html__( 'None', 'creativa' ) => 'none',
                        ),
            "std"    => 'space',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Counter Align', 'creativa' ),
            'param_name' => 'align',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'left',
                        esc_html__( 'Center', 'creativa' ) => 'center',
                        esc_html__( 'Right', 'creativa' ) => 'right',
                        ),
            "std"    => 'left',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Counter Number Size', 'creativa' ),
            'param_name' => 'size',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => 'hero',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Number Color', 'creativa' ),
            'param_name' => 'number_color',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Subtitle Color', 'creativa' ),
            'param_name' => 'subtitle_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_counter extends WPBakeryShortCode {
    }
}



/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map( array(
    "name" => esc_html__( 'Tabs', 'creativa' ),
    'base' => 'vc_tabs',
    'show_settings_on_create' => false,
    'is_container' => true,
    'icon' => 'icon-wpb-ui-tab-content',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Tabbed content', 'creativa' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Auto rotate tabs', 'creativa' ),
            'param_name' => 'interval',
            'value' => array( esc_html__( 'Disable', 'creativa' ) => 0, 3, 5, 10, 15 ),
            'std' => 0,
            'description' => esc_html__( 'Auto rotate tabs each X seconds.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content Style', 'creativa' ),
            // "admin_label" => true,
            'value' => array(
                esc_html__( 'With Border', 'creativa' ) => 'loprd-tabs-nav--border',
                esc_html__( 'No Border', 'creativa' ) => 'loprd-tabs-nav--no-border',
            ),
            'param_name' => 'content_border',
            'group' => esc_html__( 'Design options', 'creativa' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background/Active Tab Color', 'creativa' ),
            'param_name' => 'tab_bg',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Active Tab Text Color', 'creativa' ),
            'param_name' => 'tab_active_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Tabs Background', 'creativa' ),
            'param_name' => 'tabs_bg',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'creativa' ),
            'param_name' => 'border_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
    'default_content' => '
[vc_tab title="' . esc_html__( 'Tab 1', 'creativa' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . esc_html__( 'Tab 2', 'creativa' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
    'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
) );

/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
WPBMap::map( 'vc_tour', array(
    'name' => esc_html__( 'Tour', 'creativa' ),
    'base' => 'vc_tour',
    'show_settings_on_create' => false,
    'is_container' => true,
    'container_not_allowed' => true,
    'icon' => 'icon-wpb-ui-tab-content-vertical',
    'category' => esc_html__( 'Content', 'creativa' ),
    'wrapper_class' => 'vc_clearfix',
    'description' => esc_html__( 'Vertical tabbed content', 'creativa' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Auto rotate slides', 'creativa' ),
            'param_name' => 'interval',
            'value' => array( esc_html__( 'Disable', 'creativa' ) => 0, 3, 5, 10, 15 ),
            'std' => 0,
            'description' => esc_html__( 'Auto rotate slides each X seconds.', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Active Tab Text Color', 'creativa' ),
            'param_name' => 'tab_active_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Active Tab Background Color', 'creativa' ),
            'param_name' => 'tab_bg',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Tabs Background', 'creativa' ),
            'param_name' => 'tabs_bg',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Tabs Border Color', 'creativa' ),
            'param_name' => 'border_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_clearfix vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
    'default_content' => '
[vc_tab title="' . esc_html__( 'Tab 1', 'creativa' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . esc_html__( 'Tab 2', 'creativa' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
    'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
) );

vc_map( array(
    'name' => esc_html__( 'Tab', 'creativa' ),
    'base' => 'vc_tab',
    'allowed_container_element' => 'vc_row',
    'is_container' => true,
    'content_element' => false,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Tab title.', 'creativa' )
        ),
        array(
            'type' => 'tab_id',
            'heading' => esc_html__( 'Tab ID', 'creativa' ),
            'param_name' => "tab_id"
        )
    ),
    'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35'
) );

/* Accordion block
---------------------------------------------------------- */
vc_map( array(
    'name' => esc_html__( 'Accordion', 'creativa' ),
    'base' => 'vc_accordion',
    'show_settings_on_create' => false,
    'is_container' => true,
    'icon' => 'icon-wpb-ui-accordion',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Collapsible content panels', 'creativa' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Active section', 'creativa' ),
            'param_name' => 'active_tab',
            'description' => esc_html__( 'Enter section number to be active on load or enter false to collapse all sections.', 'creativa' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Allow collapsible all', 'creativa' ),
            'param_name' => 'collapsible',
            'description' => esc_html__( 'Select checkbox to allow all sections to be collapsible.', 'creativa' ),
            'value' => array( esc_html__( 'Allow', 'creativa' ) => 'yes' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Disable keyboard interactions', 'creativa' ),
            'param_name' => 'disable_keyboard',
            'description' => esc_html__( 'Disables keyboard arrows interactions LEFT/UP/RIGHT/DOWN/SPACES keys.', 'creativa' ),
            'value' => array( esc_html__( 'Disable', 'creativa' ) => 'yes' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Accordion Background', 'creativa' ),
            'param_name' => 'acc_bg',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Accordion Border Color', 'creativa' ),
            'param_name' => 'acc_border',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Accordion Header Color', 'creativa' ),
            'param_name' => 'acc_color',
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'subtitle', 'not_empty' => true),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . esc_html__( 'Add section', 'creativa' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . esc_html__( 'Add section', 'creativa' ) . '</span></a>
</div>
',
    'default_content' => '
    [vc_accordion_tab title="' . esc_html__( 'Section 1', 'creativa' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . esc_html__( 'Section 2', 'creativa' ) . '"][/vc_accordion_tab]
',
    'js_view' => 'VcAccordionView'
) );
vc_map( array(
    'name' => esc_html__( 'Section', 'creativa' ),
    'base' => 'vc_accordion_tab',
    'allowed_container_element' => 'vc_row',
    'is_container' => true,
    'content_element' => false,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Accordion section title.', 'creativa' )
        ),
    ),
    'js_view' => 'VcAccordionTabView'
) );

/* Single image */
vc_map( array(
    'name' => esc_html__( 'Single Image', 'creativa' ),
    'base' => 'vc_single_image',
    'icon' => 'icon-wpb-single-image',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Simple image with CSS animation', 'creativa' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'creativa' ),
            'param_name' => 'image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'creativa' ),
            'param_name' => 'img_size',
            'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Image alignment', 'creativa' ),
            'param_name' => 'alignment',
            'value' => array(
                esc_html__( 'Align left', 'creativa' ) => 'left',
                esc_html__( 'Align right', 'creativa' ) => 'right',
                esc_html__( 'Align center', 'creativa' ) => 'center'
            ),
            'description' => esc_html__( 'Select image alignment.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Image style', 'creativa' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__( 'Regular', 'creativa' ) => '',
                // esc_html__( 'Bordered', 'creativa' ) => 'img_bordered',
                esc_html__( 'Rounded', 'creativa' ) => 'img_rounded',
                // esc_html__( 'Rounded Bordered', 'creativa' ) => 'img_rounded-bordered',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Image Link', 'creativa' ),
            'param_name' => 'image_link',
            'value' => array(
                esc_html__( 'None', 'creativa' ) => 'none',
                esc_html__( 'Link to large Image', 'creativa' ) => 'full_image',
                esc_html__( 'Custom Link', 'creativa' ) => 'custom_link',
            ),
            'std' => 'none',
        ),

        array(
            "type" => "vc_link",
            "heading" => esc_html__("Image Link", "creativa"),
            "param_name" => "link",
            'dependency' => array(
                'element' => 'image_link',
                'value' => 'custom_link',
            ),
            'description' => esc_html__( 'Enter URL if you want this image to have a link.', 'creativa' ),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Hide Linked Image Overlay', 'creativa' ),
            'param_name' => 'hide_overlay',
            'description' => esc_html__( 'If linked, hide image overlay', 'creativa' ),
            'value' => array( esc_html__( 'Yes, do not display overlay', 'creativa' ) => 'hide' ),
            'dependency' => array(
                'element' => 'image_link',
                'value' => array('custom_link', 'full_image'),
            ),
            'std' => '',
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
    )
) );

/* Gallery/Slideshow
---------------------------------------------------------- */
vc_map( array(
    'name' => esc_html__( 'Image Gallery', 'creativa' ),
    'base' => 'vc_gallery',
    'icon' => 'icon-wpb-images-stack',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Responsive image gallery', 'creativa' ),
    'params' => array(
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'creativa' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Gallery type', 'creativa' ),
            'param_name' => 'type',
            'value' => array(
                esc_html__( 'Carousel', 'creativa' ) => 'carousel',
                esc_html__( 'Image grid', 'creativa' ) => 'image_grid',
                esc_html__( 'Collage', 'creativa' ) => 'collage',
            ),
            'description' => esc_html__( 'Select gallery type.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Gallery Transition', 'creativa' ),
            'param_name' => 'transition',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Move', 'creativa' ) => 'move',
                        esc_html__( 'Fade', 'creativa' ) => 'fade',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'move',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'type',
                'value' => 'carousel',
            ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Autoplay", "creativa"),
            "param_name" => "autoplay",
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => 0,
            'dependency' => array(
                'element' => 'type',
                'value' => 'carousel',
            ),
            "description" => esc_html__("Autoplay Delay in ms. (E.g. '2000' = 2seconds, '0' Disable autoplay).", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Grid Columns', 'creativa' ),
            'param_name' => 'grid_columns',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'creativa' ) => 'columns-1',
                esc_html__( '2 Columns', 'creativa' ) => 'columns-2',
                esc_html__( '3 Columns', 'creativa' ) => 'columns-3',
                esc_html__( '4 Columns', 'creativa' ) => 'columns-4',
                esc_html__( '5 Columns', 'creativa' ) => 'columns-5',
                esc_html__( '6 Columns', 'creativa' ) => 'columns-6',
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'image_grid',
            ),
            'std' => 'columns-3',
            // 'description' => esc_html__( 'Select gallery type.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Collage Row Target Height', 'creativa' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'collage_height',
            'value' => '350',
            'dependency' => array(
                'element' => 'type',
                'value' => 'collage',
            ),
            'description' => esc_html__( 'Collage row target height in pixels. E.g 350', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Grid Images Gap', 'creativa' ),
            'param_name' => 'grid_gap',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '0px - No Gap', 'creativa' ) => '0',
                esc_html__( '5px', 'creativa' ) => '5',
                esc_html__( '10px', 'creativa' ) => '10',
                esc_html__( '15px', 'creativa' ) => '15',
                esc_html__( '20px', 'creativa' ) => '20',
                esc_html__( '25px', 'creativa' ) => '25',
                esc_html__( '30px', 'creativa' ) => '30',
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => array('image_grid','collage'),
            ),
            'std' => '10',
            // 'description' => esc_html__( 'Select gallery type.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Navigation', 'creativa' ),
            'param_name' => 'navigation',
            'value' => array(
                esc_html__( 'Thumbnails', 'creativa' ) => 'nav_thumbs',
                esc_html__( 'Bullets', 'creativa' ) => 'nav_bullets',
                esc_html__( 'None', 'creativa' ) => 'nav_none'
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'carousel',
            ),
            'std' => 'nav_thumbs',
            'description' => esc_html__( 'Select gallery type.', 'creativa' )
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'creativa' ),
            'param_name' => 'img_size',
            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x0 (Width x Height - 0 set image height to auto). Leave empty to use "thumbnail" size.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'On click', 'creativa' ),
            'param_name' => 'onclick',
            'value' => array(
                esc_html__( 'Open Full Image/Magnific Popup', 'creativa' ) => 'link_image',
                esc_html__( 'Open custom link', 'creativa' ) => 'custom_link',
                esc_html__( 'Do nothing', 'creativa' ) => 'link_no',
            ),
            'description' => esc_html__( 'Define action for onclick event if needed.', 'creativa' )
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__( 'Custom links', 'creativa' ),
            'param_name' => 'custom_links',
            'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'creativa' ),
            'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' )
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Custom link target', 'creativa' ),
            'param_name' => 'custom_links_target',
            'description' => esc_html__( 'Select where to open  custom links.', 'creativa' ),
            'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' )
            ),
            'value' => $target_arr
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );

vc_map( array(
    'name' => esc_html__( 'Button', 'creativa' ),
    'base' => 'vc_button2',
    'icon' => 'icon-wpb-ui-button',
    'category' => array(
        esc_html__( 'Content', 'creativa' )),
    'description' => esc_html__( 'Eye catching button', 'creativa' ),
    'params' => array(
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'creativa' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Button link.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text on the button', 'creativa' ),
            'holder' => 'button',
            'class' => 'vc_btn',
            'param_name' => 'title',
            'value' => esc_html__( 'Text on the button', 'creativa' ),
            'description' => esc_html__( 'Text on the button.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'creativa' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__( 'Default', 'creativa' ) => 'btn-standard',
                esc_html__( 'Outlined', 'creativa' ) => 'btn-outlined',
                esc_html__( 'Squared', 'creativa' ) => 'btn-squared',
                esc_html__( 'Squared Outlined', 'creativa' ) => 'btn-squared btn-outlined',
                esc_html__( 'Rounded', 'creativa' ) => 'btn-rounded',
                esc_html__( 'Rounded Outlined', 'creativa' ) => 'btn-outlined btn-rounded',
            ),
            'description' => esc_html__( 'Button style.', 'creativa' ),
            'std' => 'btn-standard',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Color', 'creativa' ),
            'param_name' => 'color',
            'value' => array(
                esc_html__( 'Default (Accent Color)', 'creativa' ) => 'btn-default',
                esc_html__( 'Light', 'creativa' ) => 'btn-light',
                esc_html__( 'Dark', 'creativa' ) => 'btn-dark',
                esc_html__( 'Success', 'creativa' ) => 'btn-success',
                esc_html__( 'Info', 'creativa' ) => 'btn-info',
                esc_html__( 'Warning', 'creativa' ) => 'btn-warning',
                esc_html__( 'Danger', 'creativa' ) => 'btn-danger',
            ),
            'description' => esc_html__( 'Button color.', 'creativa' ),
            // 'param_holder_class' => 'vc_colored-dropdown'
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Size', 'creativa' ),
            'param_name' => 'size',
            'value' => array(
                esc_html__( 'Extra Large (Full Width)', 'creativa' ) => 'btn-full',
                esc_html__( 'Large', 'creativa' ) => 'btn-lg',
                esc_html__( 'Standard', 'creativa' ) => 'btn-md',
                esc_html__( 'Small', 'creativa' ) => 'btn-sm',
                esc_html__( 'Extra small', 'creativa' ) => 'btn-xs',
            ),
            'std' => 'btn-md',
            'description' => esc_html__( 'Button size.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'creativa' ),
            'param_name' => 'alignment',
            'value' => array(
                esc_html__( 'Left', 'creativa' ) => 'btn-left',
                esc_html__( 'Center', 'creativa' ) => 'btn-center',
                esc_html__( 'Right', 'creativa' ) => 'btn-right',
                esc_html__( 'Inline', 'creativa' ) => 'btn-inline',
            ),
            'std' => 'btn-inline',
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'js_view' => 'VcButton2View'
) );


vc_map( array(
    'name' => esc_html__( 'Message Box', 'creativa' ),
    'base' => 'vc_message',
    'icon' => 'icon-wpb-information-white',
    'wrapper_class' => 'alert',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Notification box', 'creativa' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Message box type', 'creativa' ),
            'param_name' => 'color',
            'value' => array(
                esc_html__( 'Informational', 'creativa' ) => 'alert-info',
                esc_html__( 'Warning', 'creativa' ) => 'alert-warning',
                esc_html__( 'Success', 'creativa' ) => 'alert-success',
                esc_html__( 'Error', 'creativa' ) => "alert-danger",
                esc_html__( 'Custom', 'creativa' ) => "alert-custom",
            ),
            'description' => esc_html__( 'Select message type.', 'creativa' ),
            'param_holder_class' => 'vc_message-type'
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Background Color', 'creativa' ),
            'param_name'  => 'bg_color',
            // 'description' => esc_html__( 'Custom separator color for your element.', 'creativa' ),
            'value' => '',
            'dependency'  => array(
             'element' => 'color',
             'value'   => array( 'alert-custom' )
            ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Text Color', 'creativa' ),
            'param_name'  => 'text_color',
            // 'description' => esc_html__( 'Custom separator color for your element.', 'creativa' ),
            'value' => '',
            'dependency'  => array(
             'element' => 'color',
             'value'   => array( 'alert-custom' )
            ),
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),

        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'class' => 'messagebox_text',
            'heading' => esc_html__( 'Message text', 'creativa' ),
            'param_name' => 'content',
            'value' => esc_html__( '<p>I am message box. Click edit button to change this text.</p>', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'js_view' => 'VcMessageView'
) );

vc_map( array(
    'name' => esc_html__( 'Call to Action Box', 'creativa' ),
    'base' => 'vc_cta_button2',
    'icon' => 'icon-wpb-call-to-action',
    'category' => array( esc_html__( 'Content', 'creativa' ) ),
    'description' => esc_html__( 'Catch visitors attention with CTA block', 'creativa' ),
    'params' => array(
        array(
            'type' => 'textarea_html',
            //holder' => 'div',
            //'admin_label' => true,
            'heading' => esc_html__( 'Promotional text', 'creativa' ),
            'holder' => 'p',
            'param_name' => 'content',
            'value' => esc_html__( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'creativa' )
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'creativa' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Button link.', 'creativa' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text on the button', 'creativa' ),
            //'holder' => 'button',
            //'class' => 'wpb_button',
            'param_name' => 'title',
            'value' => esc_html__( 'Text on the button', 'creativa' ),
            'description' => esc_html__( 'Text on the button.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Button style', 'creativa' ),
            'param_name' => 'btn_style',
            'value' => array(
                esc_html__( 'Standard (Squared)', 'creativa' ) => 'btn-standard',
                esc_html__( 'Outlined', 'creativa' ) => 'btn-outlined',
                esc_html__( 'Rounded', 'creativa' ) => 'btn-rounded',
                esc_html__( 'Rounded Outlined', 'creativa' ) => 'btn-outlined btn-rounded',
            ),
            'std' => 'btn-standard',
            'description' => esc_html__( 'Button style.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Color', 'creativa' ),
            'param_name' => 'color',
            'value' => array(
                esc_html__( 'Default (Accent Color)', 'creativa' ) => 'btn-default',
                esc_html__( 'Light', 'creativa' ) => 'btn-light',
                esc_html__( 'Dark', 'creativa' ) => 'btn-dark',
                esc_html__( 'Success', 'creativa' ) => 'btn-success',
                esc_html__( 'Info', 'creativa' ) => 'btn-info',
                esc_html__( 'Warning', 'creativa' ) => 'btn-warning',
                esc_html__( 'Danger', 'creativa' ) => 'btn-danger',
            ),
            'description' => esc_html__( 'Button color.', 'creativa' ),
            'std' => 'btn-default',
            'param_holder_class' => 'vc_colored-dropdown'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Size', 'creativa' ),
            'param_name' => 'size',
            'value' => array(
                esc_html__( 'Large', 'creativa' ) => 'btn-lg',
                esc_html__( 'Standard', 'creativa' ) => 'btn-md',
                esc_html__( 'Small', 'creativa' ) => 'btn-sm',
                esc_html__( 'Extra small', 'creativa' ) => 'btn-xs',
            ),
            'std' => 'btn-md',
            'description' => esc_html__( 'Button size.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Button position', 'creativa' ),
            'param_name' => 'position',
            'value' => array(
                esc_html__( 'Align right', 'creativa' ) => 'right',
                esc_html__( 'Align left', 'creativa' ) => 'left',
                esc_html__( 'Align bottom', 'creativa' ) => 'bottom'
            ),
            'std' => 'bottom',
            'description' => esc_html__( 'Select button alignment.', 'creativa' )
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background Color', 'creativa' ),
            'param_name' => 'bg_color',
            'description' => esc_html__( 'Select background color for your element.', 'creativa' ),
            'group' => esc_html__( 'Design Options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'creativa' ),
            'param_name' => 'border_color',
            'description' => esc_html__( 'Select border color for your element.', 'creativa' ),
            'group' => esc_html__( 'Design Options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );

/* Textual block
---------------------------------------------------------- */
vc_map( array(
    'name' => esc_html__( 'Separator', 'creativa' ),
    'base' => 'vc_text_separator',
    'icon' => 'icon-wpb-ui-separator-label',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Horizontal separator line with heading', 'creativa' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'creativa' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Border', 'creativa') => '',
                esc_html__('Dashed', 'creativa') => 'dashed',
                esc_html__('Dotted', 'creativa') => 'dotted',
                esc_html__('Double', 'creativa') => 'double',
                esc_html__('Wave', 'creativa') => 'wave',
                esc_html__('Shadow', 'creativa') => 'shadow',
            ),
            'description' => esc_html__( 'Separator style.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Separator width', 'creativa' ),
            'param_name' => 'el_width',
            'value' => array(
                esc_html__('Wide (100% width)', 'creativa') => 'wide',
                esc_html__('Medium (50% width)', 'creativa') => 'medium',
                esc_html__('Small (20% width)', 'creativa') => 'small',
            ),
            'description' => esc_html__( 'Separator element width.', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Separator alignment', 'creativa' ),
            'param_name' => 'sep_position',
            'value' => array(
                esc_html__('Left', 'creativa') => 'left',
                esc_html__('Center', 'creativa') => 'center',
                esc_html__('Right', 'creativa') => 'right',
            ),
            'std' => 'center',
            'dependency' => array( 'element' => 'el_width', 'value' => array('medium', 'small')),
        ),

        $add_css_animation,
        $add_css_animation_delay,
        
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'creativa' ),
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // "admin_label" => true,
            'holder' => 'div',
            'value' => array(
                esc_html__( 'No Icon', 'creativa' ) => '',
                esc_html__( 'Font Awesome', 'creativa' ) => 'fontawesome',
                esc_html__( 'Open Iconic', 'creativa' ) => 'openiconic',
                esc_html__( 'Typicons', 'creativa' ) => 'typicons',
                esc_html__( 'Entypo', 'creativa' ) => 'entypo',
                esc_html__( 'Linecons', 'creativa' ) => 'linecons',
                esc_html__( 'Mono Social', 'creativa' ) => 'monosocial',
                esc_html__( 'Material', 'creativa' ) => 'material',
            ),
            'param_name' => 'icon',
            'description' => esc_html__( 'Select icon library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_fontawesome',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // "admin_label" => true,
            // 'holder' => 'div',
            'value' => '',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_openiconic',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // 'holder' => 'div',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'openiconic',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_typicons',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // 'holder' => 'div',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
            'element' => 'icon',
            'value' => 'typicons',
        ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_entypo',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // 'holder' => 'div',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 300, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_linecons',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // 'holder' => 'div',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'linecons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_monosocial',
            'value' => 'vc-mono vc-mono-fivehundredpx',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'monosocial',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'monosocial',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'creativa' ),
            'param_name' => 'icon_material',
            'value' => 'vc-material vc-material-cake',
            'group' => esc_html__( 'Text separator', 'creativa' ),
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'material',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon',
                'value' => 'material',
            ),
            'description' => esc_html__( 'Select icon from library.', 'creativa' ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'creativa' ),
            'param_name' => 'title',
            'holder' => 'div',
            // 'value' => esc_html__( 'Title', 'creativa' ),
            'description' => esc_html__( 'Separator title.', 'creativa' ),
            'group' => esc_html__( 'Text separator', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Title position', 'creativa' ),
            'param_name' => 'title_align',
            'value' => array(
                esc_html__( 'Align center', 'creativa' ) => 'separator_align_center',
                esc_html__( 'Align left', 'creativa' ) => 'separator_align_left',
                esc_html__( 'Align right', 'creativa' ) => "separator_align_right"
            ),
            'description' => esc_html__( 'Select title location.', 'creativa' ),
            'group' => esc_html__( 'Text separator', 'creativa' )
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Text/Icon as Back to Top Button', 'creativa' ),
            'param_name' => 'back_to_top',
            'value' => array(
                              esc_html__( 'Yes, Please', 'creativa' ) => 'btt-btn',
                        ),
            // 'description' => esc_html__( 'Select background style.', 'creativa' ),
            // 'dependency' => array( 'element' => 'bg_style', 'value' => 'standard'),
            'group' => esc_html__( 'Text separator', 'creativa' )
        ),

        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Line Color', 'creativa' ),
            'param_name'  => 'accent_color',
            'description' => esc_html__( 'Custom separator color for your element.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency'  => array(
            //     'element' => 'color',
            //     'value'   => array( 'custom' )
            // ),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Text Color', 'creativa' ),
            'param_name'  => 'text_color',
            'description' => esc_html__( 'Custom text color.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency'  => array(
            //     'element' => array('title', 'icon'),
            //     'not_empty'   => true
            // ),
        ),

        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'js_view' => 'VcTextSeparatorView'
) );



// Icon Box -----------------------------
vc_map( array(
    "name" => esc_html__("Pie Chart", "creativa"),
    "base" => "loprd_piechart",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-piechart",
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Animated pie chart.', 'creativa' ),
    "show_settings_on_create" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Value", "creativa"),
            "param_name" => "value",
            "value" => '90',
            'admin_label' => true,
            "description" => esc_html__("Pie Value. (0-100 Integer)", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Name", "creativa"),
            "param_name" => "value_text",
            'admin_label' => true,
            "value" => '',
            "description" => esc_html__("Text under value.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Duration", "creativa"),
            "param_name" => "duration",
            'admin_label' => true,
            "value" => '2000',
            // "description" => esc_html__("Pie Value. (0-100 Integer)", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Size", "creativa"),
            "param_name" => "size",
            'admin_label' => true,
            "value" => '160',
            "description" => esc_html__("Pie Size in pixels.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Pie Thickness", "creativa"),
            "param_name" => "thickness",
            'admin_label' => true,
            "value" => '5',
            "description" => esc_html__("Pie Thickness in pixels", "creativa")
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show "%" Unit', 'creativa' ),
            'param_name' => 'show_unit',
            'value' => array(
                esc_html__( 'Yes, please', 'creativa' ) => 'show',
            ),
            'std' => '',
        ),

        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Pie Color options', 'creativa' ),
            'param_name' => 'color_fill',
            'value' => array(
                esc_html__( 'Solid Color', 'creativa' ) => 'color',
                esc_html__( 'Gradient Color', 'creativa' ) => 'gradient',
            ),
            'std' => 'color',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Pie Color', 'creativa' ),
            'param_name'  => 'color_1',
            'value' => '#111111',
            'group' => esc_html__( 'Design options', 'creativa' ),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Pie Second Color', 'creativa' ),
            'param_name'  => 'color_2',
            'value' => '#888888',
            'group' => esc_html__( 'Design options', 'creativa' ),
            'dependency' => array( 'element' => 'color_fill', 'value' => 'gradient'),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Pie Background Color', 'creativa' ),
            'param_name'  => 'color_bg',
            'value' => 'rgba(0,0,0,.1)',
            'group' => esc_html__( 'Design options', 'creativa' ),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => esc_html__( 'Pie value Color', 'creativa' ),
            'param_name'  => 'value_color',
            'value' => '',
            'group' => esc_html__( 'Design options', 'creativa' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Pie Alignment', 'creativa' ),
            'param_name' => 'align',
            'value' => array(
                esc_html__( 'Left', 'creativa' ) => 'left',
                esc_html__( 'Center', 'creativa' ) => 'center',
                esc_html__( 'Right', 'creativa' ) => 'right',
            ),
            'std' => 'center',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),

    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_piechart extends WPBakeryShortCode {
    }
}





// Google Maps -----------------------------
vc_map( array(
    "name" => esc_html__("Google Map", "creativa"),
    "base" => "loprd_maps",
    // "as_parent" => array('only' => 'elise_timeline_block'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    // "content_element" => true,
    "icon" => "loprd-icon-maps",
    'category' => esc_html__( 'Content', 'creativa' ),
    "show_settings_on_create" => true,
    'description' => esc_html__( 'Custom google map.', 'creativa' ),
    "params" => array(
        // add params same as with any other content element
        
        array(
            "type" => "textarea",
            "heading" => '<strong style="color:red">' . esc_html__('Google API key required. Go to Theme Options -> Google API key to learn more.', 'creativa') . '</strong><br><br>' . esc_html__("Address/Addresses", "creativa"),
            "param_name" => "address",
            "holder" => 'p',
            "value" => '1111 5th Avenue, New York',
            "description" => esc_html__("Address or Coordinates here.  To add multiple markers separate addresses with | (E.g. 1111 5th Avenue, New York|40.785439,-73.959254). ", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Map Zoom', 'creativa' ),
            'param_name' => 'zoom',
            'value' => array(
                'Auto Zoom' => 'autozoom',
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7' => 7,
                '8' => 8,
                '9' => 9,
                '10' => 10,
                '11' => 11,
                '12' => 12,
                '13' => 13,
                '14' => 14,
                '15' => 15,
                '16' => 16,
                '17' => 17,
                '18' => 18,
                '19' => 19,
                '20' => 20,
                '21' => 21,
            ),
            'std' => 'autozoom',
            "admin_label" => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Map Type', 'creativa' ),
            'param_name' => 'map_type',
            'value' => array(
                esc_html__('ROADMAP', 'creativa') => 'ROADMAP',
                esc_html__('HYBRID', 'creativa') => 'HYBRID',
                esc_html__('SATELLITE', 'creativa') => 'SATELLITE',
                esc_html__('TERRAIN', 'creativa') => 'TERRAIN',
            ),
            'std' => 'ROADMAP',
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Map Height", "creativa"),
            "param_name" => "height",
            "value" => 500,
            "admin_label" => true,
            'description' => esc_html__( 'Default: 500px. Type minimum height of the map. (Note: CSS measurement units and "calc" allowed)', 'creativa' ),
            // 'group' => esc_html__( 'Design options', 'creativa' ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Custom Marker', 'creativa' ),
            'param_name' => 'marker',
            'description' => esc_html__( 'Select marker .png image', 'creativa' )
        ),

        // array(
        //     "type" => "textarea_raw_html",
        //     "heading" => esc_html__("Map Style", "creativa"),
        //     "param_name" => "style",
        //     'description'   => sprintf( wp_kses( __( 'JSON style code here. Go to <a href="%1$s" target="_blank">http://snazzymaps.com/</a> for map styles or create your own.', 'creativa' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'http://snazzymaps.com/' ) ),

        //     // "holder"    => "p",
        //     // "admin_label" => true,
        //     'group' => esc_html__( 'Design options', 'creativa' )
        // ),

        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),

    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_maps extends WPBakeryShortCode {
    }
}
vc_map( array(
    'name' => esc_html__( 'Progress Bar', 'creativa' ),
    'base' => 'vc_progress_bar',
    'icon' => 'icon-wpb-graph',
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Animated progress bar', 'creativa' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'creativa' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'creativa' )
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Values', 'creativa' ),
            'param_name' => 'values',
            'description' => esc_html__( 'Enter values for graph - value, title and color.', 'creativa' ),
            'value' => urlencode( json_encode( array(
                array(
                    'label' => esc_html__( 'Development', 'creativa' ),
                    'value' => '90',
                ),
                array(
                    'label' => esc_html__( 'Design', 'creativa' ),
                    'value' => '80',
                ),
            ) ) ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Label', 'creativa' ),
                    'param_name' => 'label',
                    'description' => esc_html__( 'Enter text used as title of bar.', 'creativa' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Value', 'creativa' ),
                    'param_name' => 'value',
                    'description' => esc_html__( 'Enter value of bar.', 'creativa' ),
                    'admin_label' => true,
                ),

                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Custom color', 'creativa' ),
                    'param_name' => 'customcolor',
                    'description' => esc_html__( 'Select custom single bar background color.', 'creativa' ),
                    // 'dependency' => array(
                    //     'element' => 'color',
                    //     'value' => array( 'custom' )
                    // ),
                ),

            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Units', 'creativa' ),
            'param_name' => 'units',
            'value' => '%',
            'description' => esc_html__( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Bar custom color', 'creativa' ),
            'param_name' => 'custombgcolor',
            'description' => esc_html__( 'Select custom background color for bars.', 'creativa' ),
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Bar title color', 'creativa' ),
            'param_name' => 'title_color',
            'description' => esc_html__( 'Select custom title color for bars.', 'creativa' ), 
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Bar background color', 'creativa' ),
            'param_name' => 'bar_bg_color',
            'description' => esc_html__( 'Select custom bar background color.', 'creativa' ), 
            'group' => esc_html__( 'Design options', 'creativa' ),
            // 'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),


        $add_css_animation,
        $add_css_animation_delay,

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'creativa' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );




// Countdown --------------------
vc_map( array(
    "name" => esc_html__("Countdown", "creativa"),
    "base" => "loprd_countdown",
    // "content_element" => true,
    "icon" => "loprd-icon-countdown",
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Countdown timer.', 'creativa' ),
    "show_settings_on_create" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => esc_html__("Countdown to Date", "creativa"),
            "param_name" => "date",
            "value" => '2017/02/14',
            "admin_label" => true,
            "description" => esc_html__("YYYY/MM/DD hh:mm:ss* (* time is optional)", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Countdown display format", "creativa"),
            "param_name" => "formatter",
            "admin_label" => true,
            "value" => '%D %!D:day,days; %-H h %M min %S sec',
            "description" => 'Counter format. <br>
                %Y - '. esc_html__('Years left', 'creativa' ) .'</br>
                %m - '. esc_html__('Months left', 'creativa' ) .'</br>
                %w - '. esc_html__('Weeks left', 'creativa' ) .'</br>
                %d - '. esc_html__('Days left (taking away weeks)', 'creativa' ) .'</br>
                %D - '. esc_html__('Total amount of days left', 'creativa' ) .'</br>
                %H - '. esc_html__('Hours left', 'creativa' ) .'</br>
                %h - '. esc_html__('Total amount of hours left', 'creativa' ) .'</br>
                %M - '. esc_html__('Minutes left', 'creativa' ) .'</br>
                %n - '. esc_html__('Total amount of minutes left', 'creativa' ) .'</br>
                %S - '. esc_html__('Seconds left', 'creativa' ) .'</br>
                %s - '. esc_html__('Total amount of seconds left', 'creativa' ) .'</br>
                <a href="http://hilios.github.io/jQuery.countdown/documentation.html#formatter">Read more about Formatter.</a>',
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Countdown Alignment', 'creativa' ),
            'param_name' => 'align',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Left', 'creativa' ) => 'loprd-countdown--left',
                        esc_html__( 'Center', 'creativa' ) => 'loprd-countdown--center',
                        esc_html__( 'Right', 'creativa' ) => 'loprd-countdown--right',
                        ),
            "std"    => 'loprd-countdown--left',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Countdown Size', 'creativa' ),
            'param_name' => 'size',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => 'hero',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Counter Color', 'creativa' ),
            'param_name' => 'color',
            'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_countdown extends WPBakeryShortCode {
    }
}

// Countdown --------------------
vc_map( array(
    "name" => esc_html__("Hover Box", "creativa"),
    "base" => "loprd_hoverbox",
    // "content_element" => true,
    "icon" => "loprd-icon-hoverbox",
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Interactive text/image block.', 'creativa' ),
    "show_settings_on_create" => true,
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "vc_link",
            "heading" => esc_html__("Hoverbox Link", "creativa"),
            "param_name" => "link",
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            // "admin_label" => true,
            // "holder"    => "a",
            "description" => esc_html__("URL to page. You can leave this field empty.", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Box Height", "creativa"),
            "param_name" => "height",
            "admin_label" => true,
            'value' => 320,
            "description" => esc_html__('Height of hoverbox in pixels. E.g 320. (Note: CSS measurement units and "calc" allowed)', "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content Position', 'creativa' ),
            'param_name' => 'content_position',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                  esc_html__( 'Left Top', 'creativa' ) => 'left-top',
                  esc_html__( 'Left Center ', 'creativa' ) => 'left-center',
                  esc_html__( 'Left Bottom ', 'creativa' ) => 'left-bottom',
                  esc_html__( 'Center Top ', 'creativa' ) => 'center-top',
                  esc_html__( 'Center Center ', 'creativa' ) => 'center-center',
                  esc_html__( 'Center Bottom ', 'creativa' ) => 'center-bottom',
                  esc_html__( 'Right Top ', 'creativa' ) => 'right-top',
                  esc_html__( 'Right Center ', 'creativa' ) => 'right-center',
                  esc_html__( 'Right Bottom ', 'creativa' ) => 'right-bottom',
            ),
            "std"    => 'center-center',
            "description" => esc_html__("Position of content on hoverbox.", "creativa")
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),

        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Custom Class:", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),


        // Front 

        array(
            "type" => "textfield",
            "heading" => esc_html__("Front Title", "creativa"),
            "param_name" => "front_title",
            // "admin_label" => true,
            "holder"    => "h6",
            'edit_field_class' => 'vc_col-sm-8 vc_column first_element',
            'group' => esc_html__( 'Front', 'creativa' )
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Title Size', 'creativa' ),
            'param_name' => 'front_title_size',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => 'h4-size',
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Front Text", "creativa"),
            "param_name" => "front_content",
            // "holder"    => "h3",
            "admin_label" => true,
            // 'edit_field_class' => 'vc_col-sm-8 vc_column',
            'group' => esc_html__( 'Front', 'creativa' )
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Front Title/Text Color', 'creativa' ),
            'param_name' => 'front_content_color',
            // "admin_label" => true,
            // 'edit_field_class' => 'vc_col-sm-4 vc_column',
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Front BG Color', 'creativa' ),
            'param_name' => 'front_bg_color',
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Front BG Overlay', 'creativa' ),
            'param_name' => 'front_bg_overlay',
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Front BG Image', 'creativa' ),
            'param_name' => 'front_bg_img',
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'creativa' ),
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Position', 'creativa' ),
            'param_name' => 'front_bg_img_pos',
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => array(
                              '-' => '',
                              esc_html__( 'Left Top', 'creativa' ) => 'left top',
                              esc_html__( 'Left Center', 'creativa' ) => 'left center',
                              esc_html__( 'Left Bottom', 'creativa' ) => 'left bottom',
                              esc_html__( 'Center Top', 'creativa' ) => 'center top',
                              esc_html__( 'Center Center', 'creativa' ) => 'center center',
                              esc_html__( 'Center Bottom', 'creativa' ) => 'center bottom',
                              esc_html__( 'Right Top', 'creativa' ) => 'right top',
                              esc_html__( 'Right Center', 'creativa' ) => 'right center',
                              esc_html__( 'Right Bottom', 'creativa' ) => 'right bottom',
                        ),
            'std' => '',
            'dependency' => array( 'element' => 'front_bg_img', 'not_empty' => true),
            'group' => esc_html__( 'Front', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Size', 'creativa' ),
            'param_name' => 'front_bg_img_size',
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => array(
                              esc_html__( 'Cover', 'creativa' ) => 'cover',
                              esc_html__( 'Repeat', 'creativa' ) => 'repeat',
                              esc_html__( 'Repeat-X', 'creativa' ) => 'repeat-x',
                              esc_html__( 'Repeat-Y', 'creativa' ) => 'repeat-y',
                              esc_html__( 'No Repeat', 'creativa' ) => 'no-repeat',
                        ),
            'std' => 'cover',
            'dependency' => array( 'element' => 'front_bg_img', 'not_empty' => true),
            'group' => esc_html__( 'Front', 'creativa' )
        ),


        // Hover 

        array(
            "type" => "textfield",
            "heading" => esc_html__("Hover Title", "creativa"),
            "param_name" => "hover_title",
            "holder"    => "h6",
            // "admin_label" => true,
            'edit_field_class' => 'vc_col-sm-8 vc_column first_element',
            'group' => esc_html__( 'Hover', 'creativa' )
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Title Size', 'creativa' ),
            'param_name' => 'hover_title_size',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Jumbo', 'creativa' ) => 'jumbo',
                        esc_html__( 'Hero', 'creativa' ) => 'hero',
                        esc_html__( 'H2', 'creativa' ) => 'h2-size',
                        esc_html__( 'H3', 'creativa' ) => 'h3-size',
                        esc_html__( 'H4', 'creativa' ) => 'h4-size',
                        esc_html__( 'H5', 'creativa' ) => 'h5-size',
                        esc_html__( 'H6', 'creativa' ) => 'h6-size',
                        ),
            "std"    => 'h4-size',
            'group' => esc_html__( 'Hover', 'creativa' )
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Hover Text", "creativa"),
            "param_name" => "hover_content",
            "admin_label" => true,
            // 'edit_field_class' => 'vc_col-sm-8 vc_column',
            'group' => esc_html__( 'Hover', 'creativa' )
            // "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Hover Title/Text Color', 'creativa' ),
            'param_name' => 'hover_content_color',
            // 'edit_field_class' => 'vc_col-sm-4 vc_column',
            'group' => esc_html__( 'Hover', 'creativa' )
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Hover BG Color', 'creativa' ),
            'param_name' => 'hover_bg_color',
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
            'group' => esc_html__( 'Hover', 'creativa' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Hover BG Overlay', 'creativa' ),
            'param_name' => 'hover_bg_overlay',
            'edit_field_class' => 'vc_col-sm-6 vc_column sep_element',
            'group' => esc_html__( 'Hover', 'creativa' )
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Hover BG Image', 'creativa' ),
            'param_name' => 'hover_bg_img',
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'creativa' ),
            'group' => esc_html__( 'Hover', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Position', 'creativa' ),
            'param_name' => 'hover_bg_img_pos',
            'edit_field_class' => 'vc_col-sm-6 vc_column first_element',
            'value' => array(
                              '-' => '',
                              esc_html__( 'Left Top', 'creativa' ) => 'left top',
                              esc_html__( 'Left Center', 'creativa' ) => 'left center',
                              esc_html__( 'Left Bottom', 'creativa' ) => 'left bottom',
                              esc_html__( 'Center Top', 'creativa' ) => 'center top',
                              esc_html__( 'Center Center', 'creativa' ) => 'center center',
                              esc_html__( 'Center Bottom', 'creativa' ) => 'center bottom',
                              esc_html__( 'Right Top', 'creativa' ) => 'right top',
                              esc_html__( 'Right Center', 'creativa' ) => 'right center',
                              esc_html__( 'Right Bottom', 'creativa' ) => 'right bottom',
                        ),
            'std' => '',
            'dependency' => array( 'element' => 'front_bg_img', 'not_empty' => true),
            'group' => esc_html__( 'Hover', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Size', 'creativa' ),
            'param_name' => 'hover_bg_img_size',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                              esc_html__( 'Cover', 'creativa' ) => 'cover',
                              esc_html__( 'Repeat', 'creativa' ) => 'repeat',
                              esc_html__( 'Repeat-X', 'creativa' ) => 'repeat-x',
                              esc_html__( 'Repeat-Y', 'creativa' ) => 'repeat-y',
                              esc_html__( 'No Repeat', 'creativa' ) => 'no-repeat',
                        ),
            'std' => 'cover',
            'dependency' => array( 'element' => 'front_bg_img', 'not_empty' => true),
            'group' => esc_html__( 'Hover', 'creativa' )
        ),

        // Animations

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Content Animation', 'creativa' ),
            'param_name' => 'content_animation',
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                              esc_html__( 'None', 'creativa' ) => 'none',
                              esc_html__( 'Fade', 'creativa' ) => 'fade',
                              esc_html__( 'Slide Left', 'creativa' ) => 'slide-left',
                              esc_html__( 'Slide Right', 'creativa' ) => 'slide-right',
                              esc_html__( 'Slide Up', 'creativa' ) => 'slide-up',
                              esc_html__( 'Slide Down', 'creativa' ) => 'slide-down',
                        ),
            'std' => '',
            'group' => esc_html__( 'Animations', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Background Animation', 'creativa' ),
            'param_name' => 'bg_animation',
            // 'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                              esc_html__( 'None', 'creativa' ) => 'none',
                              esc_html__( 'Fade', 'creativa' ) => 'fade',
                              esc_html__( 'Slide Left', 'creativa' ) => 'slide-left',
                              esc_html__( 'Slide Right', 'creativa' ) => 'slide-right',
                              esc_html__( 'Slide Up', 'creativa' ) => 'slide-up',
                              esc_html__( 'Slide Down', 'creativa' ) => 'slide-down',
                        ),
            'std' => '',
            'group' => esc_html__( 'Animations', 'creativa' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),

    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_hoverbox extends WPBakeryShortCode {
    }
}

vc_map( array(
    'name' => esc_html__( 'Carousel', 'creativa' ),
    'base' => 'loprd_carousel_tab',
    'icon' => 'loprd-icon-carousel',
    // 'is_container' => true,
    "content_element" => true,
    'show_settings_on_create' => false,
    'as_parent' => array(
        'only' => 'vc_tta_section'
    ),
    'category' => esc_html__( 'Content', 'creativa' ),
    'description' => esc_html__( 'Place content inside Carousel', 'creativa' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Arrows Position', 'creativa' ),
            'param_name' => 'carousel_arrows_pos',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Sides', 'creativa' ) => 'sides',
                        esc_html__( 'Top Right', 'creativa' ) => 'top',
                        esc_html__( 'None', 'creativa' ) => 'none',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'none',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Bottom Navigation', 'creativa' ),
            'param_name' => 'navigation',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Bullets', 'creativa' ) => 'bullets',
                        esc_html__( 'None', 'creativa' ) => 'none',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'bullets',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Bullets Color Style', 'creativa' ),
            'param_name' => 'bullets_color',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Dark (default)', 'creativa' ) => 'dark',
                        esc_html__( 'Light', 'creativa' ) => 'light',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            'dependency' => array( 'element' => 'navigation', 'value' => 'bullets'),
            "std"    => 'dark',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Carousel Slides Transition', 'creativa' ),
            'param_name' => 'transition',
            // "admin_label" => true,
            // "holder"    => "h3",
            'value' => array(
                        esc_html__( 'Move', 'creativa' ) => 'move',
                        esc_html__( 'Fade', 'creativa' ) => 'fade',
                        ),
            // 'description' => esc_html__( 'Select alignment of elements in iconbox.', 'creativa' ),
            // 'dependency' => array( 'element' => 'rp_style', 'value' => 'carousel'),
            "std"    => 'move',
            // 'group' => esc_html__( 'Design options', 'creativa' )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Autoplay", "creativa"),
            "param_name" => "autoplay",
            'value' => 0,
            "description" => esc_html__("Autoplay Delay in ms. (E.g. '2000' = 2seconds, '0' Disable autoplay).", "creativa")
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Slides Gap", "creativa"),
            "param_name" => "slides_gap",
            'value' => 30,
            "description" => esc_html__("Gap between slides in pixels. Default: 30", "creativa")
        ),
        $add_css_animation,
        $add_css_animation_delay,
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "creativa"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "creativa")
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'creativa' ),
            'param_name' => 'css',
            // 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'creativa' ),
            'group' => esc_html__( 'CSS Options', 'creativa' )
        ),
    ),
    'js_view' => 'VcBackendTtaPageableView',
    'custom_markup' => '
<div class="vc_tta-container vc_tta-o-non-responsive" data-vc-action="collapse">
    <div class="vc_general vc_tta vc_tta-tabs vc_tta-pageable vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
        <div class="vc_tta-tabs-container">'
                       . '<ul class="vc_tta-tabs-list">'
                       . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
                       . '</ul>
        </div>
        <div class="vc_tta-panels vc_clearfix {{container-class}}">
          {{ content }}
        </div>
    </div>
</div>',
    'default_content' => '
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'creativa' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'creativa' ), 2 ) . '"][/vc_tta_section]
    ',
    'admin_enqueue_js' => array(
        vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' )
    )
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_loprd_carousel_tab extends WPBakeryShortCode {
    }
}


/**
 * @param $css_animation
 *
 * @return string
 */
function creativaAnimation( $css_animation ) {
    $output = '';
    if ( '' !== $css_animation ) {
        wp_enqueue_script( 'waypoints' );
        $output = ' creativa_shortcode_animation creativa_anim_' . $css_animation;
    }

    return $output;
}

/**
 * @param $css_animation
 *
 * @return string
 */
function creativaAnimationDelay( $css_animation, $css_animation_delay ) {
    $output = '';
    if ( '' !== $css_animation &&  '' !== $css_animation_delay ) {
        $output = 'data-animation-delay='. intval($css_animation_delay) .'';
    }

    return $output;
}


$attributes = array(
    $add_css_animation,
    $add_css_animation_delay,
);
vc_add_params( 'vc_column', $attributes );
vc_add_params( 'vc_column_inner', $attributes ); 
vc_add_params( 'vc_column_text', $attributes ); 

$columns_alignment = array(
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Column Horizontal Align', 'creativa' ),
        'param_name' => 'horizontal_align',
        'value' => array(
            esc_html__('None', 'creativa') => 'none',
            esc_html__('Left', 'creativa') => 'left',
            esc_html__('Center', 'creativa') => 'center',
            esc_html__('Right', 'creativa') => 'right',
        ),
        'std' => 'none',
    ),
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Column Vertical Align', 'creativa' ),
        'description' => esc_html__('Vertical align works only width Row\'s equal columns.', 'creativa'),
        'param_name' => 'vertical_align',
        'value' => array(
            esc_html__('None', 'creativa') => 'none',
            esc_html__('Top', 'creativa') => 'top',
            esc_html__('Middle', 'creativa') => 'middle',
            esc_html__('Bottom', 'creativa') => 'bottom',
        ),
        'std' => 'none',
    ),
);  

vc_add_params( 'vc_column', $columns_alignment );
vc_add_params( 'vc_column_inner', $columns_alignment ); 




?>