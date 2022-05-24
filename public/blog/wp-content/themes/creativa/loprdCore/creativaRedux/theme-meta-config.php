<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "creativa_options";


if ( !function_exists( "creativa_add_metaboxes" ) ):
    function creativa_add_metaboxes($metaboxes) {

    $images_path = get_template_directory_uri() . '/loprdCore/creativaRedux/options_img';

    // Post Formats
    // Post Format Video
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Add Video', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-video',
        'fields' => array(

            array(
                'id'       => 'opt-format-video-type',
                'type'     => 'select',
                'title'    => esc_html__('Video Type', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                // 'subtitle' => esc_html__('', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Youtube/Vimeo',
                    '2' => 'Embed Code'
                ),
                'default'  => '1',
            ),

            array(
                'id'        => 'opt-format-video-url',
                'type'      => 'text',
                'required'      => array('opt-format-video-type', "=", 1),
                'title'     => esc_html__('URL to Video', 'creativa'),
                'subtitle'  => esc_html__('Link to video - Youtube or Vimeo only', 'creativa'),
                'validate'  => 'url',
                'default'   => '',
                'desc'      => esc_html__('e.g. <i>https://www.youtube.com/watch?v=I8lttV53XOo</i> or <i>http://vimeo.com/99124075</i>', 'creativa'),
            ),

            array(
                'id'        => 'opt-format-video-embed',
                'type'      => 'textarea',
                'required'      => array('opt-format-video-type', "=", 2),
                'title'     => esc_html__('Video Embed', 'creativa'),
                'subtitle'  => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here.', 'creativa'),
                'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
                'validate'  => 'html',
                'default'   => '',
            ),
        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );    
  
    $metaboxes[] = array(
        'id' => 'post-format-video',
        'title' => esc_html__('Video Post Format', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        'post_format' => array('video'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );




    // Post Format Audio
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Add Audio', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-music',
        'fields' => array(

            array(
                'id'       => 'opt-format-audio-type',
                'type'     => 'select',
                'title'    => esc_html__('Audio Type', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                // 'subtitle' => esc_html__('', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'External Embed (SoundCloud etc.)',
                    '2' => 'Custom Audio'
                ),
                'default'  => '1',
            ),

            array(
                'id'        => 'opt-format-audio-embed',
                'type'      => 'textarea',
                'required'      => array('opt-format-audio-type', "=", 1),
                'title'     => esc_html__('Audio Embed', 'creativa'),
                'subtitle'  => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here.', 'creativa'),
                'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
                'validate'  => 'html',
                'default'   => '',
            ),

            array(
                'id'        => 'opt-format-audio-mp3',
                'type'      => 'media',
                'url'       => false,
                'required'  => array('opt-format-audio-type', "=", 2),
                'title'     => esc_html__('MP3 Audio File - required', 'creativa'),
                'subtitle'  => esc_html__('Audio file with .mp3 extension.', 'creativa'),
                'mode'      => 'audio', // toDo
                'default'   => '',
            ),

            array(
                'id'        => 'opt-format-audio-oga',
                'type'      => 'media',
                'url'       => false,
                'required'  => array('opt-format-audio-type', "=", 2),
                'title'     => esc_html__('OGA Audio File', 'creativa'),
                'subtitle'  => esc_html__('Audio file with .ogg extension.', 'creativa'),
                'mode'      => 'audio', // toDo
                'default'   => '',
            ),

            array(
                'id'        => 'opt-format-audio-author',
                'type'      => 'text',
                'title'     => esc_html__('Song Author', 'creativa'),
                'required'  => array('opt-format-audio-type', "=", 2),
                'default'   => '',
                //'subtitle'  => esc_html__('Name of the Quote Author', 'creativa'),
                //'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
            ),

            array(
                'id'        => 'opt-format-audio-title',
                'type'      => 'text',
                'title'     => esc_html__('Song Title', 'creativa'),
                'required'  => array('opt-format-audio-type', "=", 2),
                'default'   => '',
                //'subtitle'  => esc_html__('Name of the Quote Author', 'creativa'),
                //'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
            ),


        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );   
  
    $metaboxes[] = array(
        'id' => 'post-format-audio',
        'title' => esc_html__('Audio Post Format', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        'post_format' => array('audio'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );



    // Post Format Quote
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Quote', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-quotes',
        'fields' => array(

            array(
                'id'        => 'opt-format-quote-content',
                'type'      => 'textarea',
                'title'     => esc_html__('Quote', 'creativa'),
                'subtitle'  => esc_html__('Content of Quote', 'creativa'),
                'default'   => '',
                //'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
            ),

            array(
                'id'        => 'opt-format-quote-author',
                'type'      => 'text',
                'title'     => esc_html__('Quote Author', 'creativa'),
                'subtitle'  => esc_html__('Name of the Quote Author', 'creativa'),
                'default'   => '',
                //'desc'      => esc_html__('&lt;iframe&gt; &lt;/iframe&gt; embed here. Sizes will automatically adjusted.', 'creativa'),
            ),
        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );  
  
    $metaboxes[] = array(
        'id' => 'post-format-quote',
        'title' => esc_html__('Quote Post Format', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        'post_format' => array('quote'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );


    // Post Format Link
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Link Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-link',
        'fields' => array(

            array(
                'id'        => 'opt-format-link-url',
                'type'      => 'text',
                'title'     => esc_html__('URL', 'creativa'),
                'subtitle'  => esc_html__('Url to website', 'creativa'),
                'validate'  => 'url',
                'default'   => '',
            ),

            array(
                'id'        => 'opt-format-link-url-title',
                'type'      => 'text',
                'title'     => esc_html__('URL Title (optional)', 'creativa'),
                'validate'  => 'url',
                'default'   => '',
            ),
        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );  
  
    $metaboxes[] = array(
        'id' => 'post-format-link',
        'title' => esc_html__('Link Post Format', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        'post_format' => array('link'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );


    // Post Format Gallery
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Add Gallery', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-picture',
        'fields' => array(

            array(
                'id' => 'opt-meta-post-gallery',
                'type' => 'gallery',
                'title' => esc_html__('Add/Edit Post Gallery', 'creativa'),
                'subtitle' => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'creativa'),
                'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'default' => '',
            ),
        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );  
  
    $metaboxes[] = array(
        'id' => 'post-format-gallery',
        'title' => esc_html__('Gallery Post Format', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        'post_format' => array('gallery'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );

    // Post Format Gallery
    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Subtitle/Introduction Content', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-picture',
        'fields' => array(

            array(
                'id'        => 'opt-single-subtitle',
                'type'      => 'editor',
                // 'title'     => esc_html__('Top Bar Text', 'creativa'),
                // 'subtitle'  => esc_html__('Additional information text.', 'creativa'),
                'default'   => '',
                'args'   => array(
                    'wpautop'          => true,
                    'textarea_rows'    => 4,
                    'media_buttons'    => false
                )
            ),

            array(
                'id'        => 'opt-single-subtitle-display',
                'type'      => 'switch',
                'title'     => esc_html__('Display as Excerpt', 'creativa'),
                'subtitle'  => esc_html__('Display subtitle/introduction content as excerpt on blog page.', 'creativa'),
                'default'   => true,
            ),
        )
    );

    $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );  
  
    $metaboxes[] = array(
        'id' => 'post-subtitle',
        'title' => esc_html__('Subtitle/Introduction', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        // 'post_format' => array('gallery'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );
















    // Portfolio metaboxes 


    $boxSections = array();

    $boxSections[] = array(
        'title' => esc_html__('Project Gallery', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        // 'icon' => 'el-icon-home',
        'fields' => array(  

            array(
                'id' => 'opt-meta-project-gallery',
                'type' => 'gallery',
                'title' => esc_html__('Add/Edit Project Gallery', 'creativa'),
                'subtitle' => esc_html__('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'creativa'),
                'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'default' => '',
            ),
        )
    );

    $boxSections[] = array(
        'title' => esc_html__('Project Info', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        // 'icon' => 'el-icon-home',
        'fields' => array(  

            array(
                'id'        => 'opt-meta-project-year',
                'type'      => 'text',
                'title'     => esc_html__('Project Date', 'creativa'),
                'default'   => '',
                // 'subtitle'  => esc_html__('Write here cutom page title.', 'creativa'),
            ),

            array(
                'id'        => 'opt-meta-project-client',
                'type'      => 'text',
                'title'     => esc_html__('Client', 'creativa'),
                'default'   => '',
                // 'subtitle'  => esc_html__('Write here cutom page title.', 'creativa'),
            ),

            array(
                'id'        => 'opt-meta-project-custom',
                'type'      => 'multi_text',
                'title'     => esc_html__('Custom Info Fields', 'creativa'),
                'default'   => '',
                'show_empty' => true,
                'subtitle'  => esc_html__('Field Name|Field Info (E.g. Author|John Doe)', 'creativa'),
                // 'desc'      => esc_html__('', 'creativa')
            ),   

            array(
                'id'        => 'opt-meta-project-url',
                'type'      => 'text',
                'title'     => esc_html__('Project URL', 'creativa'),
                'default'   => '',
                'subtitle'  => esc_html__('Url to Project, ex. http://project.com', 'creativa'),
                'validate'  => 'url'
            ),

            array(
                'id'        => 'opt-meta-project-url-text',
                'type'      => 'text',
                'title'     => esc_html__('Project URL Button Text', 'creativa'),
                'subtitle'  => esc_html__('E.g. Launch Project', 'creativa'),
                        // 'required'  => array(
                        //     array('opt-meta-project-url', "not_empty_and", 'http://'),
                        // ),
                // 'validate'  => 'url'
                'default'     => esc_html__('Launch Project', 'creativa'),
            ),
       
        )
    );

    $metaboxes[] = array(
        'id' => 'portfolio-metaboxes',
        'title' => esc_html__('Portfolio Options', 'creativa'),
        'post_types' => array('portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $boxSections
    );
    $boxSections = array();

    if ( class_exists('Portfolio_Post_Type') ) {

        // Portfolio Page filtering metaboxes 
        $boxSections = array();


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
            $authors_list[$user->ID] = $user->display_name;
        }


        // Portfolio Page filtering metaboxes 
        $boxSections = array();

        $boxSections[] = array(
            'title' => esc_html__('Filter by', 'creativa'),
            //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
            // 'icon' => 'el-icon-home',
            'fields' => array(  
                array(
                    'id'        => 'opt-portfolio-sel-categories',
                    'type'      => 'select',
                    'data'      => 'terms',
                    'args'      => array('taxonomies'=>'portfolio_category'),
                    'multi'     => true,
                    'placeholder' => esc_html__('Select category/categories', 'creativa'),
                    'title'     => esc_html__('Categories', 'creativa'),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ),   
                array(
                    'id'        => 'opt-portfolio-sel-tags',
                    'type'      => 'select',
                    'data'      => 'terms',
                    'args'      => array('taxonomies'=>'portfolio_tag'),
                    'multi'     => true,
                    'placeholder' => esc_html__('Select tag/tags', 'creativa'),
                    'title'     => esc_html__('Tags', 'creativa'),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ),  
                array(
                    'id'        => 'opt-portfolio-sel-authors',
                    'type'      => 'select',
                    // 'data'      => 'terms',
                    // 'args'      => array('taxonomies'=>'portfolio_tag'),
                    'options'   => $authors_list,
                    'multi'     => true,
                    'placeholder' => esc_html__('Select author/authors', 'creativa'),
                    'title'     => esc_html__('Authors', 'creativa'),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ), 

                array(
                    'id'        => 'opt-portfolio-exc',
                    'type'      => 'switch',
                    'title'     => esc_html__('Select to Exclude', 'creativa'),
                    // 'subtitle'  => esc_html__('Enable/Disable like button on portfolio item.', 'creativa'),
                    'default'   => false,
                ), 
                array(
                    'id'        => 'opt-portfolio-exc-categories',
                    'type'      => 'select',
                    'data'      => 'terms',
                    'args'      => array('taxonomies'=>'portfolio_category'),
                    'multi'     => true,
                    'placeholder' => esc_html__('Select category/categories', 'creativa'),
                    'title'     => esc_html__('Exclude Categories', 'creativa'),
                    'required'      => array('opt-portfolio-exc', "=", 1),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ),   
                array(
                    'id'        => 'opt-portfolio-exc-tags',
                    'type'      => 'select',
                    'data'      => 'terms',
                    'args'      => array('taxonomies'=>'portfolio_tag'),
                    'multi'     => true,
                    'placeholder' => esc_html__('Select tag/tags', 'creativa'),
                    'required'    => array('opt-portfolio-exc', "=", 1),
                    'title'     => esc_html__('Exclude Tags', 'creativa'),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ),  
                array(
                    'id'        => 'opt-portfolio-exc-authors',
                    'type'      => 'select',
                    // 'data'      => 'terms',
                    // 'args'      => array('taxonomies'=>'portfolio_tag'),
                    'options'   => $authors_list,
                    'multi'     => true,
                    'placeholder' => esc_html__('Select author/authors', 'creativa'),  
                    'required'    => array('opt-portfolio-exc', "=", 1),
                    'title'     => esc_html__('Exclude Authors', 'creativa'),
                    'default'   => '',
                    // 'subtitle'  => esc_html__('Specific categories which will show up on this page.', 'creativa'),
                    // 'desc'      => esc_html__('For all categories left this field empty', 'creativa'),
                ), 
            )
        );

        $boxSections[] = array(
            'title' => esc_html__('Portfolio Settings', 'creativa'),
            //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
            // 'icon' => 'el-icon-home',
            'fields' => array(  
               
                    array(
                        'id'        => 'opt-portfolio-layout',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => esc_html__('Portfolio Layout', 'creativa'),
                        'options'   => array(
                            '1' => array('alt' => '1 Column', 'img' => $images_path .'/option_portfolio-1col.jpg'),
                            '2' => array('alt' => '2 Columns',  'img' => $images_path .'/option_portfolio-2col.jpg'),
                            '3' => array('alt' => '3 Columns',  'img' => $images_path .'/option_portfolio-3col.jpg'),
                            '4' => array('alt' => '4 Columns', 'img' => $images_path .'/option_portfolio-4col.jpg'),
                            '5' => array('alt' => 'Masonry', 'img' => $images_path .'/option_portfolio-masonry.jpg')
                        ),
                    ),

                    array(
                        'id'       => 'opt-masonry-size',
                        'type'     => 'select',
                        'title'    => esc_html__('Masonry Items Size', 'creativa'), 
                        'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                        //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                        // Must provide key => value pairs for select options
                        'required'      => array('opt-portfolio-layout', "=", 5),
                        'options'  => array(
                            '1' => 'Medium',
                            '2' => 'Large',
                        ),
                    ),

                    array(
                        'id'        => 'opt-portfolio-fullwidth',
                        'type'      => 'switch',
                        'title'     => esc_html__('Full Width Portfolio', 'creativa'),
                    ),

                    array(
                        'id'            => 'opt-portfolio-items-gap',
                        'type'          => 'slider',
                        'title'         => esc_html__('Portfolio Items Gap', 'creativa'),                      
                        'desc'          => esc_html__('Gap size. Min: 0, max: 30, default value: 30', 'creativa'),
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 30,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'opt-portfolio-pagination',
                        'type'      => 'switch',
                        'title'     => esc_html__('Portfolio Pagination', 'creativa'),
                    ),

                    array(
                        'id'            => 'opt-portfolio-pper-page',
                        'type'          => 'slider',
                        'required'      => array('opt-portfolio-pagination', "=", 1),
                        'title'         => esc_html__('Projects per Page', 'creativa'),
                        'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 20,
                        'display_value' => 'text'
                    ),

                    array(
                        'id' => 'section-meta-filtering-start',
                        'type' => 'section',
                        'title' => esc_html__('Portfolio Filtering Settings', 'creativa'),
                        //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                        'indent' => false 
                    ),


                    array(
                        'id'        => 'opt-portfolio-filtering',
                        'type'      => 'switch',
                        'title'     => esc_html__('Portfolio Filtering', 'creativa'),
                    ),

                    array(
                        'id'        => 'opt-portfolio-filtering-pos',
                        'type'      => 'button_set',
                        'title'     => esc_html__('FIltering Position', 'creativa'),
                        // 'subtitle'  => esc_html__('Position of page title on title bar.', 'creativa'),
                        'required'  => array('opt-portfolio-filtering', "=", 1),
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => 'Left', 
                            '2' => 'Center',
                            '3' => 'Right',
                        ), 
                    ),

                    array(
                        'id'        => 'opt-portfolio-sorting',
                        'type'      => 'switch',
                        'title'     => esc_html__('Portfolio Sorting', 'creativa'),
                        'subtitle'  => esc_html__('Enable/Disable portfolio sorting.', 'creativa'),
                        'required'  => array('opt-portfolio-filtering', "=", 1),
                    ),

                    array(
                        'id' => 'section-meta-filtering-end',
                        'type' => 'section',
                        'indent' => false 
                    ),

                    array(
                        'id' => 'section-meta-item-display-start',
                        'type' => 'section',
                        'title' => esc_html__('Project Item Display Settings', 'creativa'),
                        'indent' => false 
                    ),

                    array(
                        'id'        => 'opt-portfolio-style',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => esc_html__('Portfolio Items Style', 'creativa'),
                        'options'   => array(
                            '1' => array('alt' => 'Portfolio Item OnHover', 'img' => $images_path .'/option_project-item-hover.jpg'),
                            '2' => array('alt' => 'Portfolio Item Overlay', 'img' => $images_path .'/option_project-item-overlay.jpg'),
                            '3' => array('alt' => 'Portfolio Item Bottom',  'img' => $images_path .'/option_project-item-bottom.jpg')
                        ),
                    ),

                    array(
                        'id'        => 'opt-porfolio-item-categories',
                        'type'      => 'switch',
                        'title'     => esc_html__('Categories Names', 'creativa'),
                    ),

                    array(
                        'id'        => 'opt-quick-view',
                        'type'      => 'switch',
                        'title'     => esc_html__('Quick View Button', 'creativa'),
                    ),

                    array(
                        'id'        => 'opt-like-button',
                        'type'      => 'switch',
                        'title'     => esc_html__('Like Button', 'creativa'),
                    ),

                    array(
                        'id' => 'section-meta-item-display-end',
                        'type' => 'section',
                        'indent' => false 
                    ),
            )
        );

    $boxSections[] = array(
        'title' => esc_html__('Project Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        // 'icon' => 'el-icon-home',
        'fields' => array(  
                    // ),

                    array(
                        'id'       => 'opt-portfolio1-heading-color',
                        'type'     => 'color',
                        'required'  => array('opt-portfolio-style', "!=", 3),
                        'title'    => esc_html__( 'Portfolio Item Heading Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-portfolio3-heading-color',
                        'type'     => 'color',
                        'required'  => array('opt-portfolio-style', "=", 3),
                        'title'    => esc_html__( 'Portfolio Item Heading Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'        => 'opt-portfolio3-heading-bg',
                        'type'      => 'color_rgba',
                        'required'  => array('opt-portfolio-style', "=", 3),
                        'title'    => esc_html__( 'Portfolio Item Heading Background', 'creativa' ),
                        'transparent' => true,
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),
                    array(
                        'id'        => 'opt-portfolio-th-over',
                        'type'      => 'color_rgba',
                        'required'  => array('opt-portfolio-style', "!=", 3),
                        'title'    => esc_html__( 'Overlay Color', 'creativa' ),
                        'transparent' => true,
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id' => 'section-meta-filtering-start',
                        'type' => 'section',
                        'title' => esc_html__('Portfolio Filtering', 'creativa'),
                        'indent' => false 
                    ),

                    array(
                        'id'       => 'opt-portfolio-filters-color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Portfolio Filtering Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-portfolio-filters-color-active',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Portfolio Filtering Color - Active', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-portfolio-sorting-color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Portfolio Sorting Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'section-meta-filtering-end',
                        'type' => 'section',
                        'indent' => false 
                    ),
       
        )
    );

        $metaboxes[] = array(
            'id' => 'portfolio-settings',
            'title' => esc_html__('Portfolio Settings', 'creativa'),
             'post_types' => array('page'),
            'page_template' => array('portfolio.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sidebar' => true, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $boxSections
        );
        $boxSections = array();

    }




    // Portfolio Page filtering metaboxes 
    $boxSections = array();

    $boxSections[] = array(
        //'title' => esc_html__('Portfolio Categories', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        // 'icon' => 'el-icon-home',
        'fields' => array(  

            array(
                'id'        => 'opt-side-navigation-position',
                'type'      => 'button_set',
                'title'     => esc_html__('Side Navigation Position', 'creativa'),
                'subtitle'  => esc_html__('Select side navigation position', 'creativa'),                   
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => esc_html__('Left', 'creativa'), 
                    '2' => esc_html__('Right', 'creativa')
                ), 
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-side-navigation-title',
                'type'      => 'text',
                'title'     => esc_html__('Navigation Title', 'creativa'),
                'subtitle'  => esc_html__('Side Nav Title, will show up above the side nav.', 'creativa'),
                //'desc'      => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'default'   => esc_html__('Pages', 'creativa'),
            ),
        )
    );

    $metaboxes[] = array(
        'id' => 'side-navigation',
        'title' => esc_html__('Side Navigation', 'creativa'),
         'post_types' => array('page'),
        'page_template' => array('template-side-navigation.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'low', // high, core, default, low
        'sidebar' => true, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $boxSections
    );
    $boxSections = array();







    // Page Metaboxes
    $boxSections = array();
    
    $boxSections[] = array(
        'title' => esc_html__('Page Title', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-fontsize',
        'fields' => array(

                array(
                    'id'        => 'opt-title-bar',
                    'type'      => 'switch',
                    'title'     => esc_html__('Title Bar', 'creativa'),
                    // 'subtitle'  => esc_html__('Showing title bar on every page.', 'creativa'),
                ),

                array(
                    'id'        => 'opt-title-bar-centered',
                    'type'      => 'button_set',
                    'title'     => esc_html__('Page Title Position', 'creativa'),
                    // 'subtitle'  => esc_html__('Position of page title on title bar.', 'creativa'),
                    'required'  => array('opt-title-bar', "=", 1),
                    //Must provide key => value pairs for radio options
                    'options'   => array(
                        '1' => 'Side', 
                        '2' => 'Center'
                    ), 
                ),

                array(
                    'id'        => 'opt-page-subtitle',
                    'type'      => 'text',
                    'title'     => esc_html__('Page Subtitle', 'creativa'),
                    'required'  => array('opt-title-bar', "=", 1),
                    'subtitle'  => esc_html__('Your custom page subtitle.', 'creativa'),
                    //'desc'      => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                    'default'   => '',
                ),

                array(
                    'id'        => 'opt-custom-page-title',
                    'type'      => 'editor',
                    'title'     => esc_html__('Custom Page Title Text', 'creativa'),
                    // 'subtitle'  => esc_html__('', 'creativa'),
                    // 'desc'      => esc_html__('H1 - default title Heading Tag', 'creativa'),
                    'required'  => array('opt-title-bar', "=", 1),
                        'args'   => array(
                            'wpautop'          => false,
                            'textarea_rows'    => 5,
                            'media_buttons'    => false,
                            'teeny'            => false,
                            // 'tinymce'          => array(
                            //         'toolbar1' => 'bold'
                            //     )
                        ),
                    'default' => '',
                ),

        )
    );   
    
    $boxSections[] = array(
        'title' => esc_html__('Page Title Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-text-width',
        'fields' => array(

            array(
                'id'     => 'opt-titlebar-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                // 'required' => array('opt-title-bar', "=", 0),
                // 'required'  => array( 
                //     array('opt-navigation-transparency', "<", 100),
                //     array('opt-title-bar', "=", 0)
                // ),
                'required'  => array('opt-title-bar', "=", 0),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Title Bar Info.', 'creativa' ),
                'desc'   => esc_html__( 'Title bar is disabled for this page, but will be still visible as background for transparent navigation if you set this page as blog or portfolio template.', 'creativa' )
            ),


            array(
                'id'       => 'opt-pagetitle-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Text Color', 'creativa' ),
                // 'required'      => array('opt-title-bar', "=", 1),
                // 'subtitle' => esc_html__( 'Pick top bar text color. (default: #ffffff)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'        => 'opt-pt-bg',
                'type'      => 'background',
                'title'     => esc_html__('Page Title Background', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                // 'subtitle'  => esc_html__('Pick Page Title background color or image.', 'creativa'),
                'preview_height' => '110px',
                'preview'   => true,
                'preview_media' => true,
            ),

            array(
                'id'        => 'opt-pt-border',
                'type'      => 'border',
                'title'     => esc_html__('Page Title Bottom Border', 'creativa'),
                // 'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle'  => esc_html__('Pick borders settings for footer widget area. (default: none)', 'creativa'),
                'all'       => false,
                'bottom'    => true,
                'top'       => false,
                'left'       => false,
                'right'       => false,
            ),

            array(
                'id'       => 'opt-title-bar-padding',
                'type'     => 'spacing',
                // 'required'  => array('opt-title-bar', "=", 1),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                // 'display_units' => true,   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Title Bar Margin', 'creativa' ),
                'subtitle' => esc_html__( 'Title Bar top and bottom margin size.', 'creativa' ),
            ),

            array(
                'id'        => 'opt-title-bar-custom-height',
                'type'      => 'switch',
                // 'required'  => array('opt-navbar-style', "!=", 3),
                'required'  => array('opt-title-bar', "=", 1),
                'title'     => esc_html__('Title Bar Custom Height', 'creativa'),
                'subtitle'  => esc_html__('Enable/disable bar above header.', 'creativa'),
            ),

            array(
                'id'       => 'opt-title-bar-height',
                'type'     => 'dimensions',
                'units'    => array('px','%'),
                'required'  => array('opt-title-bar-custom-height', '=', 1),
                'title'    => esc_html__('Title Bar Custom Height', 'creativa'),
                'subtitle' => esc_html__('Allow to set page title custom height.', 'creativa'),
                'width'    => false,
                'height'   => true,
            ),

            array(
                'id'       => 'opt-page-title-bar-align',
                'type'     => 'select',
                'required'  => array('opt-title-bar-custom-height', '=', 1),
                'title'    => esc_html__('Title Bar Content Vertical Alignment', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => esc_html__('Top', 'creativa'),
                    '2' => esc_html__('Middle', 'creativa'),
                    '3' => esc_html__('Bottom', 'creativa'),
                ),
            ),   

            array(
                'id'        => 'opt-pt-overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Page Title image bg Overlay', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                // 'subtitle'  => esc_html__('Show overlay on title bar image background. (default: #000000, alpha: 0.8)', 'creativa'),
            ),




            array(
                'id' => 'section-pt-overlay-start',
                'type' => 'section',
                'class' => 'aaa',
                // 'title' => esc_html__('Title Bar', 'creativa'),
                'indent' => true 
            ),

            array(
                'id'       => 'opt-pt-overlay-color-style',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Color Style', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array('opt-pt-overlay', "=", 1),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Solid',
                    '2' => 'Gradient',
                ),
            ),

            array(
                'id'        => 'opt-pt-overlay-bg',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color', 'creativa' ),
                'required'  => array('opt-pt-overlay', "=", 1),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-pt-overlay-bg2',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color 2', 'creativa' ),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-pt-overlay-gradient-dir',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Gradient Direction', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '180' => 'Top to Bottom',
                    '90' => 'Left to Right',
                    '135' => 'Top-Left to Bottom-Right',
                ),
            ),

            array(
                'id' => 'section-pt-overlay-end',
                'type' => 'section',
                'indent' => false 
            ),

                    array(
                        'id' => 'section-animations-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Animations', 'creativa'),
                        //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                        'indent' => false 
                    ),

                    array(
                        'id'       => 'opt-page-title-animation',
                        'type'     => 'select',
                        'required'  => array(
                            array('opt-title-bar', "=", 1),
                        ),
                        'title'    => esc_html__('Scroll Animation - Background', 'creativa'), 
                        'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                        'subtitle' => esc_html__('Select scroll animation for page title background.', 'creativa'),
                        //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '0' => esc_html__('None', 'creativa'),
                            '1' => esc_html__('Parallax', 'creativa'),
                            '2' => esc_html__('Scaledown', 'creativa'),
                            '3' => esc_html__('Scaleup', 'creativa'),
                            '4' => esc_html__('Fold', 'creativa'),
                            '5' => esc_html__('Fade Out', 'creativa'),
                        ),
                    ),    

                    array(
                        'id'       => 'opt-page-title-animation-content',
                        'type'     => 'select',
                        'required'  => array(
                            array('opt-title-bar', "=", 1),
                        ),
                        'title'    => esc_html__('Scroll Animation - Content', 'creativa'), 
                        'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                        'subtitle' => esc_html__('Select scroll animation for page title content.', 'creativa'),
                        //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '0' => esc_html__('None', 'creativa'),
                            '1' => esc_html__('Slide Down/Fade Out', 'creativa'),
                            '2' => esc_html__('Stretch/Fade Out', 'creativa'),
                            '3' => esc_html__('Fade Out', 'creativa'),
                        ),
                    ),    

                    // 1:metaBalls
                    // 2:bouncyPolygons,
                    // 3:bouncyBalls,
                    // 4:slowBubbles,
                    // 5:confetti,

                    array(
                        'id'       => 'opt-animated-canvas-type',
                        'type'     => 'select',
                        'required'  => array(
                            array('opt-title-bar', "=", 1),
                        ),
                        'title'    => esc_html__('Canvas Animation', 'creativa'), 
                        'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                        'subtitle' => esc_html__('Select animation for canvas.', 'creativa'),
                        //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '0' => esc_html__('None', 'creativa'),
                            '1' => esc_html__('Animation - Lava Lamp', 'creativa'),
                            '2' => esc_html__('Animation - Bouncy Polygons', 'creativa'),
                            // '3' esc_html__(=> 'Animation - Bouncy Bubbles', 'creativa'),
                            '4' => esc_html__('Animation - iBubbles', 'creativa'),
                            '5' => esc_html__('Animation - Confetti', 'creativa'),
                            '6' => esc_html__('Animation - Lines Rain', 'creativa'),
                            '7' => esc_html__('Animation - Film Grain', 'creativa'),
                        ),
                    ),

                    array(
                        'id' => 'section-canvas-start',
                        'type' => 'section',
                        // 'title' => esc_html__('Single Post/Project Cover', 'creativa'),
                        //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                        'indent' => true 
                    ),

                    array(
                        'id'        => 'opt-animated-canvas-color',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Animated Canvas - Color', 'creativa' ),
                        'required'  => array(
                            array('opt-title-bar', "=", 1),
                            array('opt-animated-canvas-type', "!=", 0),
                            array('opt-animated-canvas-type', "!=", 7),
                        ),
                        'subtitle' => esc_html__( 'Select color of animated canvas elements.', 'creativa' ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'            => 'opt-animated-canvas-count',
                        'type'          => 'slider',
                        'title'         => esc_html__('Animated Canvas - Elements Count', 'creativa'),
                        'required'  => array(
                            array('opt-title-bar', "=", 1),
                            array('opt-animated-canvas-type', "!=", 5),
                            array('opt-animated-canvas-type', "!=", 6),
                            array('opt-animated-canvas-type', "!=", 0),
                            array('opt-animated-canvas-type', "!=", 7),
                        ),
                        // 'subtitle'      => esc_html__('Default cover image height size.', 'creativa'),
                        'desc'          => esc_html__('Min: 2, max: 30, default value: 15', 'creativa'),
                        'min'           => 1,
                        'max'           => 50,
                        'step'          => 1,
                        'display_value' => 'text'
                    ),

                    array(
                        'id' => 'section-canvas-end',
                        'type' => 'section',
                        'indent' => false 
                    ),


                    array(
                        'id' => 'section-animations-end',
                        'type' => 'section',
                        'indent' => false 
                    ),


        )
    );   

    $boxSections[] = array(
        // 'title' => esc_html__('Content Padding', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                // 'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );    

    $boxSections[] = array(
        'title' => esc_html__('Content Padding', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-resize-vertical',
        'fields' => array(  

            array(
                'id'       => 'opt-content-padding',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                // 'display_units' => true,   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Content Padding', 'creativa' ),
            ),
        )
    );    


    $metaboxes[] = array(
        'id' => 'page-title-options',
        'title' => esc_html__('Page Options', 'creativa'),
        'post_types' => array('page'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );

    $boxSections = array();
    $boxSections[] = array(
        'title' => esc_html__('Single Page Title Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-text-width',
        'fields' => array(

            array(
                'id'        => 'opt-title-bar-centered',
                'type'      => 'button_set',
                'title'     => esc_html__('Page Title Position', 'creativa'),
                // 'subtitle'  => esc_html__('Position of page title on title bar.', 'creativa'),
                'required'  => array('opt-title-bar', "=", 1),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Side', 
                    '2' => 'Center'
                ), 
            ),

            array(
                'id'       => 'opt-title-bar-padding',
                'type'     => 'spacing',
                // 'required'  => array('opt-title-bar', "=", 1),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                // 'display_units' => true,   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Title Bar Margin', 'creativa' ),
                'subtitle' => esc_html__( 'Title Bar top and bottom margin size. (default: top: 45px, bottom: 45px)', 'creativa' ),
            ),


                    array(
                        'id' => 'section-single-background-start',
                        'type' => 'section',
                        'title' => esc_html__('Background', 'creativa'),
                        //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                        'indent' => false 
                    ),

            array(
                'id'       => 'opt-pagetitle-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Text Color', 'creativa' ),
                // 'required'      => array('opt-title-bar', "=", 1),
                // 'subtitle' => esc_html__( 'Pick top bar text color. (default: #ffffff)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'        => 'opt-pt-bg',
                'type'      => 'background',
                'title'     => esc_html__('Page Title Background', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                // 'subtitle'  => esc_html__('Pick Page Title background color or image.', 'creativa'),
                'preview_height' => '110px',
                'preview'   => true,
                'preview_media' => true,
            ),

            array(
                'id' => 'section-pt-overlay-start',
                'type' => 'section',
                'class' => 'aaa',
                'title' => esc_html__('Background Overlay', 'creativa'),
                'indent' => false 
            ),


            array(
                'id'        => 'opt-pt-overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Page Title image bg Overlay', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                // 'subtitle'  => esc_html__('Show overlay on title bar image background. (default: #000000, alpha: 0.8)', 'creativa'),
            ),

            array(
                'id'       => 'opt-pt-overlay-color-style',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Color Style', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array('opt-pt-overlay', "=", 1),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Solid',
                    '2' => 'Gradient',
                ),
            ),

            array(
                'id'        => 'opt-pt-overlay-bg',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color', 'creativa' ),
                'required'  => array('opt-pt-overlay', "=", 1),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-pt-overlay-bg2',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color 2', 'creativa' ),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-pt-overlay-gradient-dir',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Gradient Direction', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '180' => 'Top to Bottom',
                    '45' => 'Left to Right',
                    '90' => 'Top-Left to Bottom-Right',
                ),
            ),

            array(
                'id' => 'section-pt-overlay-end',
                'type' => 'section',
                'indent' => false 
            ),

            array(
                'id' => 'section-single-background-end',
                'type' => 'section',
                'indent' => false 
            ),
        )
    );  

     $boxSections[] = array(
        //'title' => esc_html__('General Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        //'icon' => 'el-icon-home',
        'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_63',
                //'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide'
            )
        )
    );  


    $metaboxes[] = array(
        'id' => 'single-title-options',
        'title' => esc_html__('Single Title Options', 'creativa'),
        'post_types' => array('post', 'portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );





    // Advanced Page Options
    $boxSections = array();

    $boxSections[] = array(
        'title' => esc_html__('Info', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-info-sign',
        //'type' => 'divide',
        'fields' => array(  

            array(
                'id'   =>'divider_1',
                'desc' => esc_html__('Advanced Page Options.', 'creativa'),
                'type' => 'divide'
            )
        )
    );    

    $boxSections[] = array(
        'title' => esc_html__('Custom Logo', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-home-alt',
        'fields' => array(  

            array(
                'id'        => 'opt-logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Logo Image', 'creativa'),
                'mode'      => 'image',
            ),

            array(
                'id'        => 'opt-logo-stickyh',
                'type'      => 'media',
                'url'       => true,
                'required'  => array('opt-show-sticky-header', "=", 1),
                'title'     => esc_html__('Sticky Header Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Sticky Header Custom Logo Image (overwrite main logo).', 'creativa'),
                'mode'      => 'image',
            ),

            array(
                'id'        => 'opt-logo-mobile',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Mobile Navigation Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Mobile/Full Width Custom Logo Image (overwrite main logo).', 'creativa'),
                'mode'      => 'image',
            ),
        )
    );       

    $boxSections[] = array(
        'title' => esc_html__('Header/Footer', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-minus',
        'fields' => array(  

            array(
                'id'        => 'opt-show-header',
                'type'      => 'switch',
                // 'required'      => array('opt-navbar-style','!=','4'),
                'title'     => esc_html__('Enable/Disable Header', 'creativa'),
                'default'   => true,
                'subtitle'  => esc_html__('Enable or Disable all Header elements.', 'creativa'),
            ),

            array(
                'id'        => 'opt-show-footer',
                'type'      => 'switch',
                'default'   => true,
                'title'     => esc_html__('Enable/Disable Footer', 'creativa'),
                'subtitle'  => esc_html__('Enable or Disable all Footer elements.', 'creativa'),
            ),


            array(
                'id'        => 'opt-show-top-bar',
                'type'      => 'switch',
                'title'     => esc_html__('Show Top Bar', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable bar above header.', 'creativa'),
            ),

            array(
                'id'        => 'opt-show-sticky-header',
                'type'      => 'switch',
                // 'required'  => array('opt-title-bar', "=", 1),
                'required'  => array('opt-nav-layout', "=", 1),
                'title'     => esc_html__('Show Sticky Header', 'creativa'),
            ),

            array(
                'id'        => 'opt-page-share',
                'type'      => 'switch',
                'title'     => esc_html__('Page Shares button', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable page shares button.', 'creativa'),
            ),

            array(
                'id'        => 'opt-footer-widget-area',
                'type'      => 'switch',
                'title'     => esc_html__('Show Widget Area', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Widget Area in Footer.', 'creativa'),
            ),
        )
    );       


    $boxSections[] = array(
        'title' => esc_html__('Custom Header', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-chevron-up',
        'fields' => array( 

            array(
                'id'        => 'opt-meta-custom-menu',
                'type'      => 'select',
                'data'      => 'menus',
                'title'     => esc_html__('Custom Menu', 'creativa'),
                'subtitle'      => esc_html__('This Menu will be visible only on this page.', 'creativa'),
                'default' => '',
            ), 


            array(
                'id'        => 'opt-navbar-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Navigation Bar Style', 'creativa'),
                'subtitle'  => esc_html__('Main Navbar style.', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'options'   => array(
                    '1' => array('alt' => 'Header Standard',       'img' => $images_path .'/option_header-standard.jpg'),
                    '3' => array('alt' => 'Header Splitted','img' => $images_path .'/option_header-splitted.jpg'),
                    '4' => array('alt' => 'Header Bar',  'img' => $images_path .'/option_header-bar.jpg'),
                    '2' => array('alt' => 'Header Centered', 'img' => $images_path .'/option_header-centered.jpg'),
                ),
            ),

            array(
                'id'        => 'opt-nav-full-width',
                'type'      => 'switch',
                'title'     => esc_html__('Navigation Bar - Full Width', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Enable/Disable Full Window Width navigation bar.', 'creativa'),
            ),


            array(
                'id'            => 'opt-navbar-height',
                'type'          => 'slider',
                'title'         => esc_html__('Navbar Height', 'creativa'),
                'required' => array( 
                                array('opt-navbar-style','!=','2'), 
                                array('opt-navbar-style','!=','4') 
                ),                        
                'subtitle'      => esc_html__('Navbar height in pixels.', 'creativa'),
                'desc'          => esc_html__('Navbar height. Min: 60, max: 300, default value: 90', 'creativa'),
                'min'           => 60,
                'step'          => 5,
                'max'           => 300,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-height',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','2'),
                'title'         => esc_html__('Header Height', 'creativa'),
                'subtitle'      => esc_html__('Header height in pixels.', 'creativa'),
                'desc'          => esc_html__('Navbar height. Min: 120, max: 500, default value: 150', 'creativa'),
                'min'           => 120,
                'step'          => 5,
                'max'           => 500,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-bar-height',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','4'),
                'title'         => esc_html__('Header Bar Height', 'creativa'),
                'subtitle'      => esc_html__('Header bar height in pixels.', 'creativa'),
                'desc'          => esc_html__('Min: 60, max: 200, default value: 80', 'creativa'),
                'min'           => 60,
                'step'          => 5,
                'max'           => 200,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-bar-gap',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','4'),
                'title'         => esc_html__('Header Bar Gap', 'creativa'),
                'subtitle'      => esc_html__('Header bar top gap.', 'creativa'),
                'desc'          => esc_html__('Min: 30, max: 60, default value: 30', 'creativa'),
                'min'           => 0,
                'step'          => 5,
                'max'           => 60,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-menu-position',
                'type'      => 'button_set',
                'title'     => esc_html__('Menu Position', 'creativa'),
                'subtitle'  => esc_html__('Menu position on navbar.', 'creativa'),  
                'required'  => array('opt-nav-layout', '=', '1'),                 
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Left', 
                    '2' => 'Center', 
                    '3' => 'Right'
                ), 
            ),

            array(
                'id'        => 'opt-hover-style',
                'type'      => 'image_select',
                'compiler'  => true,
                // 'required' => array('opt-navbar-style','!=','2'),    
                'title'     => esc_html__('Hover Style', 'creativa'),
                'subtitle'  => esc_html__('Main Menu hover style.', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'options'   => array(
                    '1' => array('alt' => 'Hover Block',       'img' => $images_path .'/option_hover-block.jpg'),
                    '2' => array('alt' => 'Hover Boxed',  'img' => $images_path .'/option_hover-boxed.jpg')
                ),
            ),
            array(
                'id'        => 'opt-nav-separators',
                'type'      => 'switch',
                'title'     => esc_html__('Header separators', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable header extra separator lines.', 'creativa'),
            ),      



            array(
                'id' => 'section-icons-start',
                'type' => 'section',
                'title' => esc_html__('Nav Icons', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'        => 'opt-nav-search',
                'type'      => 'switch',
                'title'     => esc_html__('Search Icon', 'creativa'),
                'subtitle'  => esc_html__('Search icon in Navbar', 'creativa'),
            ),

            array(
                'id'        => 'opt-secondary-nav',
                'type'      => 'switch',
                // 'required'  => array('opt-title-bar', "=", 1),
                'title'     => esc_html__('Hamburger Icon', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Show "Hamburger" icon for secondary/mobile navigation', 'creativa'),
            ),

            array(
                'id'        => 'opt-woo-shop-nav-icon',
                'type'      => 'switch',
                'title'     => esc_html__('Shopping Bag Icon / Cart', 'creativa'),
                'subtitle'  => esc_html__('WooCommerce - Show shopping bag icon and cart in main navigation.', 'creativa'),
            ),

            array(
                'id'       => 'opt-nav-icons-style',
                'type'     => 'select',
                'title'    => esc_html__('Icons style', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Icons with text',
                    '2' => 'Small Icons',
                    '3' => 'Large Icons',
                ),
            ),

            array(
                'id' => 'section-icons-end',
                'type' => 'section',
                'indent' => false 
            ),

            array(
                'id' => 'section-stickyh-settings-start',
                'type' => 'section',
                'title' => esc_html__('Sticky Header', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'            => 'opt-sticky-header-height',
                'type'          => 'slider',
                'title'         => esc_html__('Sticky Header Height', 'creativa'),
                'required'  => array('opt-show-sticky-header', "=", 1),    
                'subtitle'      => esc_html__('Sticky Header height in pixels.', 'creativa'),
                'desc'          => esc_html__('Sticky Header height. Min: 60, max: 300, default value: 80', 'creativa'),
                'min'           => 60,
                'step'          => 5,
                'max'           => 300,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-sticky-header-style',
                'type'      => 'button_set',
                'title'     => esc_html__('Sticky Header Style', 'creativa'),
                'required'  => array('opt-show-sticky-header', "=", 1),
                'subtitle'  => esc_html__('Sticky header is visible on:', 'creativa'),                   
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => esc_html__('Scroll', 'creativa'), 
                    '2' => esc_html__('Scroll Up', 'creativa')
                ), 
            ),
            array(
                'id' => 'section-stickyh-settings-end',
                'type' => 'section',
                'indent' => false 
            ),
                    
        )
    );   

    $boxSections[] = array(
        'title' => esc_html__('Custom Header Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-magic',
        'fields' => array(  

                    array(
                        'id'       => 'opt-navigation-color-bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Navigation Background Color', 'creativa' ),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'            => 'opt-navigation-transparency',
                        'type'          => 'slider',
                        'title'         => esc_html__('Header Transparency', 'creativa'),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        // 'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'        => 'opt-navigation-side-bg',
                        'type'      => 'background',
                        'title'     => esc_html__('Side Navigation Background', 'creativa'),
                        'required'  => array('opt-nav-layout', '=', '2'),
                        'preview_height' => '110px',
                        'preview'   => true,
                        'preview_media' => true,
                    ),

                    array(
                        'id'        => 'opt-navigation-side-overlay',
                        'type'      => 'switch',
                        'title'     => esc_html__('Side Navigation Background Overlay', 'creativa'),
                        'required'  => array('opt-nav-layout', '=', '2'),
                    ),

                    array(
                        'id' => 'section-nav-side-ovr-start',
                        'type' => 'section',
                        'title' => '',
                        'indent' => true 
                    ),

                    array(
                        'id'        => 'opt-navigation-side-overlay-color',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Side Navigation Background Overlay Color', 'creativa' ),
                        'required'  => array('opt-navigation-side-overlay','=','1'),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),
                    array(
                        'id' => 'section-nav-side-ovr-end',
                        'type' => 'section',
                        'indent' => false 
                    ),

                    array(
                        'id'        => 'opt-navbar-border',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Navigation Bottom Border Color', 'creativa' ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'        => 'opt-navigation-separator-color',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Header Separators Color', 'creativa' ),
                        'required'  => array(
                            // array('opt-nav-layout', '=', '1'),
                            array('opt-nav-separators', '=', '1')
                        ),
                        'subtitle' => esc_html__( 'Pick menu link bg color. (default rgba(0,0,0,0.15))', 'creativa' ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'       => 'opt-navigation-color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Menu Links Colors', 'creativa' ),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => true, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                    ),

                    array(
                        'id'        => 'opt-navigation-color-active-bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Menu - Active Link Background', 'creativa'),
                        // 'required'  => array('opt-nav-layout', '=', '1'),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'       => 'opt-navigation-padding',
                        'type'     => 'dimensions',
                        'units'    => array('em','px','%'),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        'title'    => esc_html__('Navigation Items Padding', 'creativa'),
                        'width'    => true,
                        'height'   => false,
                    ),

                    array(
                        'id'       => 'opt-navigation-side-padding',
                        'type'     => 'dimensions',
                        'units'    => array('em','px','%'),
                        'required'  => array('opt-nav-layout', '=', '2'),
                        'title'    => esc_html__('Navigation Items Padding', 'creativa'),
                        'width'    => false,
                        'height'   => true,
                    ),

                    array(
                        'id'       => 'opt-navigation-submenu-color-bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Submenu Background Color', 'creativa' ),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-navigation-submenu-color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Submenu Links Colors', 'creativa' ),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                    ),

                    array(
                        'id'        => 'opt-navigation-submenu-border',
                        'type'      => 'color_rgba',
                        'required'  => array('opt-nav-layout', '=', '1'),
                        'title'     => esc_html__('Submenu Item Bottom Border Line', 'creativa'),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'       => 'opt-navigation-submenu-padding',
                        'type'     => 'dimensions',
                        'units'    => array('em','px','%'),
                        'required'  => array('opt-nav-layout', '=', '1'),
                        'title'    => esc_html__('Submenu Item Padding', 'creativa'),
                        'width'    => true,
                        'height'   => true,
                    ),


                    // Sticky Header -------------------------------------- /
                    array(
                        'id' => 'section-sticky-h-start',
                        'type' => 'section',
                        'title' => esc_html__('Sticky Header', 'creativa'),
                        'indent' => false 
                    ),

                    array(
                        'id'        => 'opt-stickyh-settings',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Sticky Header Colors', 'creativa'),
                        'required'  => array(
                                    array('opt-nav-layout', '=', '1'),
                                    array('opt-show-sticky-header','=','1'),
                            ),
                        // 'subtitle'  => esc_html__('Select overlay backgroud color style.', 'creativa'),
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            '1' => esc_html__('Same As Navigation Bar', 'creativa'), 
                            '2' => esc_html__('Custom Colors', 'creativa')
                        ), 
                    ),

                    array(
                        'id'       => 'opt-stickyheader-bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Sticky Header Background', 'creativa' ),
                        'required'      => array('opt-stickyh-settings','=','2'),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'        => 'opt-stickyheader-border-color',
                        'type'      => 'color_rgba',
                        'required'      => array('opt-stickyh-settings','=','2'),
                        'title'    => esc_html__( 'Sticky Header Bar Separator/Bottom Border Color', 'creativa' ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'        => 'opt-stickyheader-separator-color',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Sticky Header Header Separators Color', 'creativa' ),
                        'required'  => array(
                            array('opt-nav-separators', '=', '1'),
                            array('opt-stickyh-settings','=','2'),
                        ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'       => 'opt-stickyh-color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Sticky Header Menu Colors', 'creativa' ),
                        'required'      => array('opt-stickyh-settings','=','2'),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => true, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                    ),

                    array(
                        'id'        => 'opt-stickyh-color-active-bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Sticky Header - Menu Active Link Background', 'creativa'),
                        // 'required'  => array('opt-nav-layout', '=', '1'),
                        'required'      => array('opt-stickyh-settings','=','2'),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'            => 'opt-stickyh-transparency',
                        'type'          => 'slider',
                        'title'         => esc_html__('Sticky Header Transparency', 'creativa'),
                        'required'  => array(
                                    array('opt-nav-layout', '=', '1'),
                                    array('opt-show-sticky-header','=','1'),
                            ),
                        // 'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'
                    ),

                    array(
                        'id'     => 'opt-sticky-info',
                        'type'   => 'info',
                        'notice' => true,
                        'style'  => 'info',
                        'required'  => array(
                                    array('opt-show-sticky-header','=','0'),
                            ),
                        'icon'   => 'el-icon-info-sign',
                        'title'  => esc_html__( 'Sticky Header is Disabled.', 'creativa' ),
                        'desc'   => esc_html__( 'Go to Header -> Sticky Header Section to Enabled Sticky Header.', 'creativa' )
                    ),

                    array(
                        'id' => 'section-sticky-h-end',
                        'type' => 'section',
                        'indent' => false 
                    ),


                    // Top Bar ------------------------------------------- /
                    array(
                        'id' => 'section-topbar-start',
                        'type' => 'section',
                        'title' => esc_html__('Top Bar', 'creativa'),
                        'indent' => false 
                    ),

                    array(
                        'id'       => 'opt-topbar-background',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Top Bar Background', 'creativa' ),
                        'required'  => array('opt-show-top-bar', "=", 1),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-topbar-color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Top Bar Text Color', 'creativa' ),
                        'required'  => array('opt-show-top-bar', "=", 1),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-topbar-links',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Top Bar Links', 'creativa' ),
                        'required'  => array('opt-show-top-bar', "=", 1),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                    ),

                    array(
                        'id'        => 'opt-topbar-border-color',
                        'type'      => 'color_rgba',
                        'required'  => array('opt-show-top-bar', "=", 1),
                        'title'     => esc_html__('Top Bar Bottom Border', 'creativa'),
                        'transparent' => true,
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),

                    array(
                        'id'     => 'opt-topbar-info',
                        'type'   => 'info',
                        'notice' => true,
                        'style'  => 'info',
                        'required'  => array('opt-show-top-bar', "=", 0),
                        'icon'   => 'el-icon-info-sign',
                        'title'  => esc_html__( 'Top Bar is Disabled.', 'creativa' ),
                        'desc'   => esc_html__( 'Go to Header -> Top Bar Section to Enabled Top Bar', 'creativa' )
                    ),

                    array(
                        'id' => 'section-topbar-end',
                        'type' => 'section',
                        'indent' => false 
                    ),

        )
    ); 

    $boxSections[] = array(
        'title' => esc_html__('Basic Color Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-tint',
        'fields' => array(  

                    array(
                        'id'       => 'opt-color-body-bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Body Background Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'opt-color-body-grey-bg',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Separated Section BG Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-color-body-text',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Body Text Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-color-headings',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Headings Color', 'creativa' ),
                        'transparent' => false,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'opt-link-colors',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Colors', 'creativa' ),
                        //'regular'   => false, // Disable Regular Color
                        //'hover'     => false, // Disable Hover Color
                        'active'    => false, // Disable Active Color
                        //'visited'   => true,  // Enable Visited Color
                    ),

                    array(
                        'id'        => 'opt-border-colors',
                        'type'      => 'color_rgba',
                        'title'    => esc_html__( 'Border Colors', 'creativa' ),                
                        'subtitle' => esc_html__( 'Separators (hr) and elements border colors. (default: rgba(0,0,0,0.07)).', 'creativa' ),
                        'options' => array(
                            'allow_empty' => false,
                            'clickout_fires_change' => true,
                        ),
                        'validate'  => 'colorrgba',
                    ),
        )
    );  

    $boxSections[] = array(
        'title' => esc_html__('Footer Styling', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-css',
        'fields' => array(  

            array(
                'id'       => 'opt-footer-effect',
                'type'     => 'select',
                'title'    => esc_html__('Footer Effects', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select footer extra effect.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                // 'required'      => array('opt-portfolio-layout', "=", 5),
                'options'  => array(
                    '1' => 'None',
                    '2' => 'Fixed',
                ),
            ),

            array(
                'id' => 'section-footer-meta-widget-start',
                'type' => 'section',
                'title' => esc_html__('Widget Area', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-footer-widgets-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Background', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area background. (default: #252525)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-heading',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Heading Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #696969)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Text Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #a0a0a0)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer Widgets Area Link Colors', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick widget area link colors (default: #a0a0a0/#a0a0a0)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
            ),

            array(
                'id'       => 'opt-footer-widgets-widget-border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Footer Widgets Borders Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick widgets border colors. (Default: rgba(255,255,255,0.14))', 'creativa' ),
                'transparent' => false,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-footer-widgets-border',
                'type'      => 'border',
                'title'     => esc_html__('Footer Widget Area Borders', 'creativa'),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle'  => esc_html__('Pick borders settings for footer widget area. (default: 1px solid #3a3a3a)', 'creativa'),
                'all'       => false,
                'bottom'    => true,
                'top'       => true,
                'left'       => false,
                'right'       => false,
            ),

            array(
                'id'     => 'opt-footer-widget-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required'  => array('opt-footer-widget-area','=','0'),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Widget Area is Disabled.', 'creativa' ),
                'desc'   => esc_html__( 'Go to Footer Section to Enabled Widget Area.', 'creativa' )
            ),

            array(
                'id' => 'section-footer-meta-widget-end',
                'type' => 'section',
                'indent' => false 
            ),

            array(
                'id' => 'section-footer-meta-copy-start',
                'type' => 'section',
                'title' => esc_html__('Copyrights Area', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-footer-copyrights-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Area Background', 'creativa' ),
                'subtitle' => esc_html__( 'Pick footer widget area background. (default: #1c1c1c)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-copyrights-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Area Text Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #999999)', 'creativa' ),
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-copyrights-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer Copyright Area Link Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick copyrights widget area link colors (default: #cccccc/#cccccc)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
            ),

            array(
                'id' => 'section-footer-meta-copy-end',
                'type' => 'section',
                'indent' => false 
            ),
        )
    );     


    $boxSections[] = array(
        'title' => esc_html__('Custom Layout', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-website',
        'fields' => array(  

            array(
                'id'        => 'opt-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Layout', 'creativa'),
                'subtitle'  => esc_html__('Theme layout.', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Wide', 'alt' => 'Wide',       'img' => $images_path .'/option_layout-wide.jpg'),
                    '2' => array('title'=>'Boxed', 'alt' => 'Boxed', 'img' => $images_path .'/option_layout-boxed.jpg'),
                    '3' => array('title'=>'Bordered', 'alt' => 'Bordered','img' => $images_path .'/option_layout-bordered.jpg'),
                ),
            ),

            array(
                'id'            => 'opt-boxed-gap',
                'type'          => 'slider',
                //'required'      => array('opt-title-bar', "=", 1),
                'title'         => esc_html__('Boxed Container Gap', 'creativa'),
                'required'      => array('opt-layout','=','2'),
                'subtitle'      => esc_html__('Gap between content and background.', 'creativa'),
                'desc'          => esc_html__('Min: 30, max: 150, default value: 60', 'creativa'),
                'min'           => 30,
                'step'          => 5,
                'max'           => 150,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-border-size',
                'type'          => 'slider',
                //'required'      => array('opt-title-bar', "=", 1),
                'title'         => esc_html__('Layout Border Size', 'creativa'),
                'required'      => array('opt-layout','=','3'),
                'subtitle'      => esc_html__('Bordered layout - border padding.', 'creativa'),
                'desc'          => esc_html__('Min: 10, max: 60, default value: 30', 'creativa'),
                'min'           => 10,
                'step'          => 5,
                'max'           => 60,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-body-bg',
                'type'      => 'background',
                'title'     => esc_html__('Body Background', 'creativa'),
                'required'      => array('opt-layout','!=','1'),
                'subtitle'  => esc_html__('Body background color or image.', 'creativa'),
                //'preview_height' => '100px',
                'preview'   => true,
                'preview_media' => true,
                'transparent' => false,
            ),
        )
    ); 

    $boxSections[] = array(
        'title' => esc_html__('Custom CSS', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon' => 'el-icon-css',
        'fields' => array(  

            array(
                'id'        => 'opt-meta-ace-editor-css',
                'type'      => 'ace_editor',
                'title'     => esc_html__('Custom CSS Code', 'creativa'),
                'subtitle'  => esc_html__('Add your CSS code here.', 'creativa'),
                'mode'      => 'css',
                'theme'     => 'monokai',
                'default'   => ""
            ),
        )
    );     

    if ( class_exists('RevSliderFunctions') ) {

        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();

        $revsliders = array();
        if ( $arrSliders ) {
            $revsliders['none'] =  esc_html__( 'None', 'creativa' );
            foreach ( $arrSliders as $slider ) {
                /** @var $slider RevSlider */
                // $revsliders[ $slider->getTitle() ] = $slider->getAlias();
                $revsliders[ $slider->getAlias() ] = $slider->getTitle();
            }
        } else {
            $revsliders['none'] = esc_html__( 'No sliders found', 'creativa' );
        }

        $boxSections[] = array(
            'title' => esc_html__('Slider above Header', 'creativa'),
            //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
            'icon' => 'el-icon-css',
            'fields' => array(  


                array(
                    'id'       => 'opt-slider-header',
                    'type'     => 'select',
                    'title'    => esc_html__('Slider above Header', 'creativa'), 
                    'required'  => array('opt-nav-layout', "=", 1),
                    'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                    'subtitle' => esc_html__('Select slider which will show up above header.', 'creativa'),
                    //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                    // Must provide key => value pairs for select options
                    'options'  => $revsliders,
                    'default'   => 'none',
                ),

                array(
                    'id'     => 'opt-slider-header-info',
                    'type'   => 'info',
                    'notice' => true,
                    'style'  => 'info',
                    'required'  => array('opt-nav-layout', "=", 2),
                    'icon'   => 'el-icon-info-sign',
                    'title'  => esc_html__( 'Option not available for this layout.', 'creativa' ),
                ),
            )
        ); 

    }




    $metaboxes[] = array(
        'id' => 'advanced-page-options',
        'title' => esc_html__('Advanced Page Options', 'creativa'),
        'post_types' => array('page','post','portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );












    // layout section
    $boxSections = array();
    $boxSections[] = array(
        //'title' => esc_html__('Home Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(


                    array(
                        'id'       => 'opt-project-link',
                        'type'     => 'select',
                        'title'    => esc_html__('Project Link Action', 'creativa'), 
                        'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                        'subtitle' => esc_html__('Select action after click on project item.', 'creativa'),
                        //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => 'Project Page',
                            '2' => 'Lightbox Gallery',
                            '3' => 'Custom URL',
                        ),
                        'default' => '1',
                    ),

                    array(
                        'id'        => 'opt-project-link-url',
                        'type'      => 'text',
                        'title'     => esc_html__('Custom project URL', 'creativa'),
                        'subtitle'  => esc_html__("Start with 'http://'", 'creativa'),
                        'validate'  => 'url',
                        'required' => array('opt-project-link', "=", 3),
                        'default'   => ''
                    ),

                    array(
                        'id'        => 'opt-project-link-target',
                        'type'      => 'switch',
                        'title'     => esc_html__('Open link in new Window', 'creativa'),
                        'required'  => array('opt-project-link', "=", 3),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'opt-project-layout',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => esc_html__('Project page Layout', 'creativa'),
                        'subtitle'  => esc_html__('Single project page layout.', 'creativa'),
                        'options'   => array(
                            '1' => array('title' => 'Large Images', 'alt' => 'Large',       'img' => $images_path .'/option_project-standard.jpg'),
                            '2' => array('title' => 'Medium Images', 'alt' => 'Medium',  'img' => $images_path .'/option_project-sidebar.jpg'),
                            '3' => array('title' => 'Wide Images', 'alt' => 'Wide',  'img' => $images_path .'/option_project-wide.jpg'),
                            '4' => array('title' => 'Clean Page', 'alt' => 'Clean',  'img' => $images_path .'/option_pp-layout-clean.jpg'),
                        ),
                    ),

                    array(
                        'id'        => 'opt-project-layout-med-sidebar',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => esc_html__('Medium Layout Sidebar Position', 'creativa'),
                        'required' => array('opt-project-layout', "=", 2),
                        'options'   => array(
                            '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_sidebar-right.jpg'),
                            '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_sidebar-left.jpg'),
                        ),
                    ),

                    array(
                        'id'        => 'opt-project-image-gallery',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'required' => array(
                                array('opt-project-layout', "!=", 3),
                                array('opt-project-layout', "!=", 4)
                            ),
                        'title'     => esc_html__('Project Image Gallery', 'creativa'),
                        'subtitle'  => esc_html__('Project images gallery Layout.', 'creativa'),
                        'options'   => array(
                            '1' => array('alt' => 'Slider',  'img' => $images_path .'/option_project-gallery-slider.jpg'),
                            '2' => array('alt' => 'List',  'img' => $images_path .'/option_project-gallery-list.jpg')
                        ),
                    ),

        )
    );
  
    $metaboxes[] = array(
        'id' => 'project-layout',
        //'title' => esc_html__('Cool Options', 'creativa'),
        'post_types' => array('portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );


    // thumb size select for single portfolio
    $boxSections = array();
    $boxSections[] = array(
        //'title' => esc_html__('Home Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(

            array(
                'id'       => 'opt-masonry-thumb-size',
                'type'     => 'select',
                'title'    => esc_html__('Masonry Thumb Size', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Thumbnail size when Portfolio Page layout is masonry', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Standard',
                    '2' => 'Wide',
                    '3' => 'Tall',
                    '4' => 'Large'
                ),
                'default'  => '1',
            )
        )
    );
  
    $metaboxes[] = array(
        'id' => 'masonry-thumb',
        //'title' => esc_html__('Cool Options', 'creativa'),
        'post_types' => array('portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'low', // high, core, default, low
        'sections' => $boxSections
    );





    // sidebar selection for template-sidebar.php
    $page_options = array();
    $page_options[] = array(
        //'title'         => esc_html__('General Settings', 'creativa'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id' => 'opt-meta-select-sidebar',
                'title' => esc_html__( 'Sidebar', 'creativa' ),
                'desc' => 'Please select the sidebar you would like to display on this page. Note: You must first create the sidebar under Appearance > Widgets.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'None',
            ),

            array(
                'id'        => 'opt-meta-template-sidebar-position',
                'type'      => 'button_set',
                'title'     => esc_html__('Sidebar position', 'creativa'),
                'subtitle'  => esc_html__('Select sidebar position', 'creativa'),                   
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => esc_html__('Left', 'creativa'), 
                    '2' => esc_html__('Right', 'creativa')
                ), 
                'default'   => '2'
            ),
        ),
    );

    $metaboxes[] = array(
        'id'            => 'sidebar-selection',
        'title'         => esc_html__( 'Select Sidebar', 'creativa' ),
        'post_types'    => array( 'page'),
        'page_template' => array('template-page-sidebar.php'),
        //'post_format' => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'low', // high, core, default, low
        'sidebar'       => true, // enable/disable the sidebar in the normal/advanced positions
        'sections'      => $page_options,
    );




    // post display settings
    $boxSections = array();
    $boxSections[] = array(
        //'title' => esc_html__('Home Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(

            array(
                'id'        => 'opt-blog-display-media',
                'type'      => 'image_select',
                'title'     => esc_html__('Post Media Display Style*', 'creativa'),
                'subtitle'  => esc_html__('Post display style. <strong>*Required featured image!</strong>', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Large', 'alt' => 'Large','img' => $images_path .'/option_post-display-standard.jpg'),
                    '2' => array('title'=>'Portrait', 'alt' => 'Portrait', 'img' => $images_path .'/option_post-display-portrait.jpg'),
                    '3' => array('title'=>'Background', 'alt' => 'Background', 'img' => $images_path .'/option_post-display-bg.jpg'),
                ),
            ),

        )
    );
  
    $metaboxes[] = array(
        'id' => 'post-display-settings',
        'title' => esc_html__('Post Display Settings', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $boxSections
    );

    // single post layout section
    $boxSections = array();
    $boxSections[] = array(
        //'title' => esc_html__('Home Settings', 'creativa'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'creativa'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(

            array(
                'id'        => 'opt-blog-page-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Single Post Layout', 'creativa'),
                'subtitle'  => esc_html__('Blog page style.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_post-layout-right.jpg'),
                    '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_post-layout-left.jpg'),
                    '3' => array('alt' => 'Clean Page', 'img' => $images_path .'/option_pp-layout-clean.jpg'),
                ),
            ),

            array(
                'id'        => 'opt-single-display-media',
                'type'      => 'switch',
                'title'     => esc_html__('Display Media/Thumbnails', 'creativa'),
                'required'      => array('opt-blog-page-style', "!=", 3),
                'subtitle'  => esc_html__('Enable/Disable media/thumbnails on single post page.', 'creativa'),
            ),

            array(
                'id'        => 'opt-single-clean-meta',
                'type'      => 'switch',
                'required'      => array('opt-blog-page-style', "=", 3),
                'title'     => esc_html__('Display Meta Info', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable meta box with author and share buttons.', 'creativa'),
                'default'   => true,
            ),

        )
    );
  
    $metaboxes[] = array(
        'id' => 'single-post-layout',
        'title' => esc_html__('Post Layout', 'creativa'),
        'post_types' => array('post'),
        //'page_template' => array('page-test.php'),
        //'post_format' => array('image'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'low', // high, core, default, low
        'sections' => $boxSections
    );




    // Kind of overkill, but ahh well.  ;)
    //$metaboxes = apply_filters( 'your_custom_redux_metabox_filter_here', $metaboxes );

    return $metaboxes;
  }
  add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'creativa_add_metaboxes');
endif;

