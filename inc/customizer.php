<?php
/**
 * rise_business Theme Customizer
 *
 * @package rise_business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rise_business_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'rise_business_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'rise_business_customize_partial_blogdescription',
		) );
	}
	//pannel theme setting
	$wp_customize->add_panel( 'theme_setting', array(
		'priority'       => 2,
		'theme_supports' => '',
		'title'          => __( 'Theme Setting', 'rise_business' ),
		'description'    => __( 'Set editable text for Theme header section', 'rise_business' ),
	) );
	//pannel homepage setting
	$wp_customize->add_panel( 'home_page', array(
		'priority'       => 1,
		'theme_supports' => '',
		'title'          => __( 'Home Page Setting', 'rise_business' ),
		'description'    => __( 'Set editable text for homepage section', 'rise_business' ),
	) );

	//customizer for phone number
	$wp_customize->add_section( 
		'contact-info' ,
		 array(
			'title'    => __('Contact Information','rise_business'),
			'panel'    => 'theme_setting',
			'priority' => 10
	) );
	//customizer for phone number
	$wp_customize->add_setting( 'phone_block', array(
		 'default'           => __( 'Phone', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 10,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'phone', /*unique id*/
		    array(
		        'label'    => __( 'Phone number', 'rise_business' ),
		        'section'  => 'contact-info',
		        'settings' => 'phone_block',
		        'type'     => 'text'
		    )
	    )
	);
	//selective refresh and add pensil icon for phone number
	$wp_customize->selective_refresh->add_partial('phone_block', array(
        'selector' => 'span#phone_number', // You can also select a css class
        'render_callback' => 'rise_business_selective_phone_block',
    ));

	//customizer for email
	$wp_customize->add_setting( 'email_block', array(
		 'default'           => __( 'Email', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'email', /*unique id*/
		    array(
		        'label'    => __( 'Email', 'rise_business' ),
		        'section'  => 'contact-info',
		        'settings' => 'email_block',
		        'type'     => 'text'
		    )
	    )
	);
	//selective refresh and add pensil icon for email
	$wp_customize->selective_refresh->add_partial('email_block', array(
        'selector' => 'span#email', // You can also select a css class
        'render_callback' => 'rise_business_selective_phone_block',
    ));
	//customizer for work
	$wp_customize->add_section( 
		'work' ,
		 array(
			'title'    => __('Work Section','rise_business'),
			'panel'    => 'home_page',
			'priority' => 15
	) );
	// radio button to on/off work section
	$wp_customize->add_setting( 'radio_work', array(
		'capability' => 'edit_theme_options',
		// 'default' => 'blue',
		// 'sanitize_callback' => 'sanitize_radio',
	) );

	$wp_customize->add_control( 'radio_work', array(
		'type' => 'radio',
		'section' => 'work', // Add a default or your own section
		'setting' => 'radio_work',
		'label' => __( 'Manage work section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	//customizer for Title field
	$wp_customize->add_setting( 'title', array(
		 'default'           => __( 'Title', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'title', /*unique id*/
		    array(
		        'label'    => __( 'Title', 'rise_business' ),
		        'section'  => 'work',
		        'settings' => 'title',
		        'type'     => 'text',
				'active_callback'=>'rise_business_hide_input_field_of_work_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for title in work section
	$wp_customize->selective_refresh->add_partial('title', array(
        'selector' => 'span#title_work', // You can also select a css class
        'render_callback' => 'rise_business_title_work',
    ));
	//customizer for description field
	$wp_customize->add_setting( 'description', array(
		 'default'           => __( 'description', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'description', /*unique id*/
		    array(
		        'label'    => __( 'Description', 'rise_business' ),
		        'section'  => 'work',
		        'settings' => 'description',
		        'type'     => 'textarea',
				'active_callback'=>'rise_business_hide_input_field_of_work_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for description in work section
	$wp_customize->selective_refresh->add_partial('description', array(
        'selector' => 'span#description_work', // You can also select a css class
        'render_callback' => 'rise_business_description_work',
    ));

	//customizer for Founder
	$wp_customize->add_setting( 'founder', array(
		 'default'           => __( 'founder', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'founder', /*unique id*/
		    array(
		        'label'    => __( 'Founder', 'rise_business' ),
		        'section'  => 'work',
		        'settings' => 'founder',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_work_section'
		    )
	    )
	);

	//selective refresh and add pensil icon for founder in work section
	$wp_customize->selective_refresh->add_partial('founder', array(
        'selector' => 'span#founder', // You can also select a css class
        'render_callback' => 'rise_business_founder',
    ));
	//customizer for position
	$wp_customize->add_setting( 'position', array(
		 'default'           => __( 'position', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 20,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'position', /*unique id*/
		    array(
		        'label'    => __( 'Position', 'rise_business' ),
		        'section'  => 'work',
		        'settings' => 'position',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_work_section'
		    )
	    )
	);

	//selective refresh and add pensil icon for position in work section
	$wp_customize->selective_refresh->add_partial('position', array(
        'selector' => 'span#position', // You can also select a css class
        'render_callback' => 'rise_business_position',
    ));


	//customize subscribe section
	$wp_customize->add_section( 
		'subscribe' ,
		 array(
			'title'    => __('Subscribe Section','rise_business'),
			'panel'    => 'home_page',
			'priority' => 40
	) );

	$wp_customize->add_setting( 'radio_subscribe', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_subscribe', array(
		'type' => 'radio',
		'section' => 'subscribe', // Add a default or your own section
		'setting' => 'radio_subscribe',
		'label' => __( 'Manage subscribe section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	//customizer for Title field
	$wp_customize->add_setting( 'subscribe_title', array(
		 'default'           => __( 'Title', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'subscribe_title', /*unique id*/
		    array(
		        'label'    => __( 'Title', 'rise_business' ),
		        'section'  => 'subscribe',
		        'settings' => 'subscribe_title',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_subscribe_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for title in subscribe section
	$wp_customize->selective_refresh->add_partial('subscribe_title', array(
        'selector' => 'span#subscribe_title', // You can also select a css class
        'render_callback' => 'rise_business_subscribe_title',
    ));
	//customizer for description in subscriibe field
	$wp_customize->add_setting( 'subscribe_description', array(
		 'default'           => __( 'Description', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'subscribe_description', /*unique id*/
		    array(
		        'label'    => __( 'Description', 'rise_business' ),
		        'section'  => 'subscribe',
		        'settings' => 'subscribe_description',
		        'type'     => 'textarea',
		        'active_callback'=>'rise_business_hide_input_field_of_subscribe_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for description in subscribe section
	$wp_customize->selective_refresh->add_partial('subscribe_description', array(
        'selector' => 'span#subscribe_description', // You can also select a css class
        'render_callback' => 'rise_business_subscribe_description',
    ));

    	//customizer for Title field
	$wp_customize->add_setting( 'shortcode', array(
		 'default'           => __( 'Enter shortcode', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'shortcode', /*unique id*/
		    array(
		        'label'    => __( 'Enter shortcode', 'rise_business' ),
		        'section'  => 'subscribe',
		        'settings' => 'shortcode',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_subscribe_section'
		    )
	    )
	);

	//customizer About Us
	$wp_customize->add_section( 
		'about_us' ,
		 array(
			'title'     => __('About US Section','rise_business'),
			'panel'	=>'home_page',
			'priority' => 10
	) );
	$wp_customize->add_setting( 'radio_about_us', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_about_us', array(
		'type' => 'radio',
		'section' => 'about_us', // Add a default or your own section
		'setting' => 'radio_about_us',
		'label' => __( 'Manage About Us section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	//add Title
	$wp_customize->add_setting( 'page_info', array(
		 'default'           => __( 'Title', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'page', /*unique id*/
		    array(
		        'label'    => __( 'Add Page to display', 'rise_business' ),
		        'section'  => 'about_us',
		        'settings' => 'page_info',
		        'type'     => 'dropdown-pages',
		        'active_callback'=>'rise_business_hide_input_field_of_about_us_section'
		    )
	    )
	);

	//button link for about us page
	$wp_customize->add_setting( 'about_button_link', array(
		 'default'           => __( 'Page Link', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'about_button_link', /*unique id*/
		    array(
		        'label'    => __( 'Add page Link', 'rise_business' ),
		        'section'  => 'about_us',
		        'settings' => 'about_button_link',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_about_us_section'
		    )
	    )
	);

	//image for about us sedtion
	for($i=1;$i<=4;$i++){
		$wp_customize->add_setting('about_us_image-'.$i, array(
	        // 'default-image' => get_template_directory_uri() . '/assest/imgs/featureProducts/product1.png',
	        'transport'     => 'refresh',
	        'height'        => 180,
	        'width'        => 160,
	    ));

	    $wp_customize->add_control( 
	    	new WP_Customize_Image_Control( 
	    		$wp_customize,
	    		'about_us_image-'.$i, 
	    		array(
	        		'label' => __('Choose Image', 'rise_business'),
	        		'section' => 'about_us',
	        		'settings' => 'about_us_image-'.$i,
	        		'active_callback'=>'rise_business_hide_input_field_of_about_us_section'
	    		)
	    	)
	    );
	}

	//customize title section
	//customizer service title
	$wp_customize->add_section( 
		'service' ,
		 array(
			'title'     => __('Service Section','rise_business'),
			'panel'	=>'home_page',
			'priority' => 20
	) );

	$wp_customize->add_setting( 'radio_service', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_service', array(
		'type' => 'radio',
		'section' => 'service', // Add a default or your own section
		'setting' => 'radio_service',
		'label' => __( 'Manage sevice section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	$wp_customize->add_setting( 'service_title', array(
		 'default'           => __( 'Title of service section', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'service_title', /*unique id*/
		    array(
		        'label'    => __( 'Edit Service title', 'rise_business' ),
		        'section'  => 'service',
		        'settings' => 'service_title',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_service_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for title in service section
	$wp_customize->selective_refresh->add_partial('service_title', array(
        'selector' => 'span#service_title', // You can also select a css class
        'render_callback' => 'rise_business_service_title',
    ));

	$wp_customize->add_setting('service_image', array(
        // 'default-image' => get_template_directory_uri() . '/assest/imgs/featureProducts/product1.png',
        'transport'     => 'refresh',
        'height'        => 180,
        'width'        => 160,
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'service_image', array(
        'label' => __('Choose Image', 'rise_business'),
        'section' => 'service',
        'settings' => 'service_image',
        'active_callback'=>'rise_business_hide_input_field_of_service_section'
    )));

	//customizer expert title
	$wp_customize->add_section( 
		'expert' ,
		 array(
			'title'     => __('Expert Section','rise_business'),
			'panel'	=>'home_page',
			'priority' => 20
	) );

	$wp_customize->add_setting( 'radio_expert', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_expert', array(
		'type' => 'radio',
		'section' => 'expert', // Add a default or your own section
		'setting' => 'radio_expert',
		'label' => __( 'Manage expert section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	$wp_customize->add_setting( 'title_expert', array(
		 'default'           => __( 'Title of expert section', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'title_expert', /*unique id*/
		    array(
		        'label'    => __( 'Edit expert title', 'rise_business' ),
		        'section'  => 'expert',
		        'settings' => 'title_expert',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_expert_section'
		    )
	    )
	);

	//selective refresh and add pensil icon for title in expert section
	$wp_customize->selective_refresh->add_partial('title_expert', array(
        'selector' => 'span#title_expert', // You can also select a css class
        'render_callback' => 'rise_business_title_expert',
    ));

	//customizer partner title
	$wp_customize->add_section( 
		'partner' ,
		 array(
			'title'     => __('Partner Section','rise_business'),
			'panel'	=>'home_page',
			'priority' => 40
	) );

	$wp_customize->add_setting( 'radio_partner', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_partner', array(
		'type' => 'radio',
		'section' => 'partner', // Add a default or your own section
		'setting' => 'radio_partner',
		'label' => __( 'Manage partner section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	$wp_customize->add_setting( 'title_partner', array(
		 'default'           => __( 'Title of partner section', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'title_partner', /*unique id*/
		    array(
		        'label'    => __( 'Title', 'rise_business' ),
		        'section'  => 'partner',
		        'settings' => 'title_partner',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_patrner_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for title in partner section
	$wp_customize->selective_refresh->add_partial('title_partner', array(
        'selector' => 'span#title_partner', // You can also select a css class
        'render_callback' => 'rise_business_title_partner',
    ));


	//customizer expert description
	$wp_customize->add_setting( 'description_partner', array(
		 'default'           => __( 'Description of partner section', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 30,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'description_partner', /*unique id*/
		    array(
		        'label'    => __( 'Description', 'rise_business' ),
		        'section'  => 'partner',
		        'settings' => 'description_partner',
		        'type'     => 'textarea',
		        'active_callback'=>'rise_business_hide_input_field_of_patrner_section'
		    )
	    )
	);

	//selective refresh and add pensil icon for description in partner section
	$wp_customize->selective_refresh->add_partial('description_partner', array(
        'selector' => 'span#description_partner', // You can also select a css class
        'render_callback' => 'rise_business_description_partner',
    ));

	//image partner section
	for($i=1;$i<=4;$i++){
		$wp_customize->add_setting('partner_image-'.$i, array(
	        // 'default-image' => get_template_directory_uri() . '/assest/imgs/featureProducts/product1.png',
	        'transport'     => 'refresh',
	        'height'        => 180,
	        'width'        => 160,
	    ));

	    $wp_customize->add_control( 
	    	new WP_Customize_Image_Control( 
	    		$wp_customize,
	    		'partner_image-'.$i, 
	    		array(
	        		'label' => __('Choose Image-'.$i, 'rise_business'),
	        		'section' => 'partner',
	        		'settings' => 'partner_image-'.$i,
	        		'active_callback'=>'rise_business_hide_input_field_of_patrner_section'
	    		)
	    	)
	    );
	    //image partner visiting link
		$wp_customize->add_setting( 'partner_visiting_link-'.$i, array(
			 'default'           => __( 'Visiting Link', 'rise_business' ),
			 'sanitize_callback' => 'sanitize_text_field',
			 'priority' 		=> 15
		) );

		$wp_customize->add_control( new WP_Customize_Control(
		    $wp_customize,
			'partner_visiting_link-'.$i, /*unique id*/
			    array(
			        'label'    => __( 'Visiting link for image-'.$i, 'rise_business' ),
			        'section'  => 'partner',
			        'settings' => 'partner_visiting_link-'.$i,
			        'type'     => 'text',
			        'active_callback'=>'rise_business_hide_input_field_of_patrner_section'
			    )
		    )
		);
	}

	//news section
	//customizer news title
	$wp_customize->add_section( 
		'news' ,
		 array(
			'title'     => __('News Section ','rise_business'),
			'panel'	=>'home_page',
			'priority' => 45,
	) );

	$wp_customize->add_setting( 'radio_news', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_news', array(
		'type' => 'radio',
		'section' => 'news', // Add a default or your own section
		'setting' => 'radio_news',
		'label' => __( 'Manage news section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	// Title Field
	$wp_customize->add_setting( 'news_title', array(
		 'default'           => __( 'Title of news section', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15,
		'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'news_title', /*unique id*/
		    array(
		        'label'    => __( 'Edit news title', 'rise_business' ),
		        'section'  => 'news',
		        'settings' => 'news_title',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_news_section'
		    )
	    )
	);
	//selective refresh and add pensil icon for title in news section
	$wp_customize->selective_refresh->add_partial('news_title', array(
        'selector' => 'span#news_title', // You can also select a css class
        'render_callback' => 'rise_business_news_title',
    ));
	//button link
	$wp_customize->add_setting( 'news_button_link', array(
		 'default'           => __( 'Link of button', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 15
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'button_link', /*unique id*/
		    array(
		        'label'    => __( 'Button Link', 'rise_business' ),
		        'section'  => 'news',
		        'settings' => 'news_button_link',
		        'type'     => 'text',
		        'active_callback'=>'rise_business_hide_input_field_of_news_section'
		    )
	    )
	);

	//Footer text
	$wp_customize->add_section( 
		'footer' ,
		 array(
			'title'    => __('Footer Text','rise_business'),
			'panel'    => 'theme_setting',
			'priority' => 10
	) );
	//customizer for footer description
	$wp_customize->add_setting( 'footer_description', array(
		 'default'           => __( 'Footer Text', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 10,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'footer_description', /*unique id*/
		    array(
		        'label'    => __( 'Description', 'rise_business' ),
		        'section'  => 'footer',
		        'settings' => 'footer_description',
		        'type'     => 'text'
		    )
	    )
	);
	//selective refresh and add pensil icon for footer description
	$wp_customize->selective_refresh->add_partial('footer_description', array(
        'selector' => 'span#footer_description', // You can also select a css class
        'render_callback' => 'rise_business_footer_description',
    ));

	//customizer for theme name
	$wp_customize->add_setting( 'footer_theme_name', array(
		 'default'           => __( 'Theme Name', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		 => 10,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'footer_theme_name', /*unique id*/
		    array(
		        'label'    => __( 'Theme Name', 'rise_business' ),
		        'section'  => 'footer',
		        'settings' => 'footer_theme_name',
		        'type'     => 'text'
		    )
	    )
	);
	//selective refresh and add pensil icon for footer theme name
	$wp_customize->selective_refresh->add_partial('footer_theme_name', array(
        'selector' => 'span#footer_theme_name', // You can also select a css class
        'render_callback' => 'rise_business_footer_theme_name',
    ));

	//customizer for footer link
	$wp_customize->add_setting( 'footer_link', array(
		 'default'           => __( 'Link', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 10
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'footer_link', /*unique id*/
		    array(
		        'label'    => __( 'Please enter link here', 'rise_business' ),
		        'section'  => 'footer',
		        'settings' => 'footer_link',
		        'type'     => 'text'
		    )
	    )
	);

	//customizer counter title
	$wp_customize->add_section( 
		'counter' ,
		 array(
			'title'     => __('Counter Section ','rise_business'),
			'panel'	=>'home_page',
			'priority' => 23,
	) );

	$wp_customize->add_setting( 'radio_counter', array(
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'radio_counter', array(
		'type' => 'radio',
		'section' => 'counter', // Add a default or your own section
		'setting' => 'radio_counter',
		'label' => __( 'Manage counter section' ),
		'description' => __( 'Select the option to show or hide this section' ),
		'choices' => array(
				'show' => __( 'Show' ),
				'hide' => __( 'Hide' ),
			),
	) );

	// blog page setting
	$wp_customize->add_section( 
		'blog_setting' ,
		 array(
			'title'    => __('Blog Page Setting','rise_business'),
			'panel'    => 'theme_setting',
			'priority' => 30
	) );

	$wp_customize->add_setting( 'blog_setting_selector', array(
		 'default'           => __( 'Footer Text', 'rise_business' ),
		 'sanitize_callback' => 'sanitize_text_field',
		 'priority' 		=> 10,
		 'transport'        => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'blog_setting_selector', /*unique id*/
		    array(
		        'label'    => __( 'Description', 'rise_business' ),
		        'section'  => 'blog_setting',
		        'settings' => 'blog_setting_selector',
		        'type'     => 'radio',
		        'label' => __( 'Manage Selector to display post' ),
				'description' => __( 'Select the option to manage section' ),
				'choices' => array(
					'pagination' => __( 'Pagination' ),
					'ajax_loader' => __( 'Ajax Loader' ),
				),
		    )
	    )
	);
}
add_action( 'customize_register', 'rise_business_customize_register' );


require_once get_template_directory() . '/inc/function_of_customizer.php';


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function rise_business_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function rise_business_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rise_business_customize_preview_js() {
	wp_enqueue_script( 'rise_business-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'rise_business_customize_preview_js' );

// apply_filter( 'add_pannel', 'rise_business_add_panel', 10, 3, 'title','description');
