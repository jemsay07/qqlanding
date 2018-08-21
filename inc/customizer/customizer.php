<?php 
/**
 * QQLanding Theme Customizer
 *
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @package QQLanding
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function qqlanding_customizer_register( $wp_customize ){
	$wp_customize->get_setting( 'blogname' )->transport 				= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 			= 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport 		= 'postMessage';
	$wp_customize->remove_control('display_header_text');	// Remove the default site title & tag.

 	// Load custom controls.
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/customizer_controls.php' );

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'QQLanding_Customize_Radio_Image' );

	/**
	 * # Header Panel
	 *----------------------------*/

	$wp_customize->add_panel( 'qqlanding_header_panel',
		array( 
			'priority' 		=> 25,
			'title'			=> __( 'Header Settings', 'qqLanding' ),
			'description' 	=> __( 'Use this panel to set your header settings.', 'qqLanding' ),
	) );

		/**
		 * ## Logo Settings
		 *----------------------------*/
		$wp_customize->add_setting( 'site_logo',
			array(
				'sanitize_callback' => 'qqlanding_sanitize_image'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'site_logo',
					array(
						'label'		=> __( 'Site Logo', 'qqLanding' ),
						'section'	=> 'title_tagline',
						'setting'	=> 'site_logo',
						'description' => __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'qqLanding' )
					)
				)
			);

		/**
		 * ## Logo, Title & tagline chooser
		 *----------------------------*/
		$wp_customize->add_setting( 'site_title_option',
			array(
				'default'			=> 'text-only',
				'sanitize_callback'	=> 'qqlanding_sanitize_logo_title_select',
				'transport'			=> 'refresh'
			)
		);
			$wp_customize->add_control( 'site_title_option',
				array(
		            'label'     	=> __( 'Display site title / logo.', 'qqLanding' ),
		            'section'   	=> 'title_tagline',
		            'type'      	=> 'radio',
		            'description'	=> __( 'Choose your preferred option.', 'qqLanding' ),
		            'choices'   => array (
		                'text-only' 	=> __( 'Display site title and description only.', 'qqLanding' ),
		                'logo-only'     => __( 'Display site logo image only.', 'qqLanding' ),
		                'text-logo'		=> __( 'Display both site title and logo image.', 'qqLanding' ),
		                'display-none'	=> __( 'Display none', 'qqLanding' )
		            )
				)
			);


	/**
	 * # General Settings
	 *-------------------------------------*/

	$wp_customize->add_panel(
		'qqlanding_theme_options',
		array(
			'priority'		=> 20,
			'capability' 	=> 'edit_theme_options',
			'theme_support'	=> '',
			'title'			=> __( 'Theme Settings',  'qqlanding' ),
			'description'	=> esc_html__( 'Use this section to set Theme options/settings of the site.', 'qqlanding' ),
		)
	);

		/**
		 * ## Social Media
		 *-------------------------------------*/
		$wp_customize->add_section(
			'qqlanding_socialMedia_settings',
			array(
				'priority'		=> 3,
				'title'			=> esc_html__( 'Social Media', 'qqlanding' ),
				'description' 	=> esc_html__( 'Use this panel settings to set your social media.', 'qqlanding' ),
				'panel'			=> 'qqlanding_theme_options'
			)
		);

		$wp_customize->add_setting(
			'qqlanding_display_smedia_icon',
			array(
				'default' => false,
				'sanitize_callback' => 'qqlanding_sanitize_checkbox'
			)
		);
		$wp_customize->add_control(
			'qqlanding_display_smedia_icon',
			array(
				'section' => 'qqlanding_socialMedia_settings',
				'setting' => 'qqlanding_display_smedia_icon',
				'type'	 => 'checkbox',
				'label' => __( 'Display social icons?', 'qqlanding' ),
			)
		);

			//facebook
			$wp_customize->add_setting(
				'facebook_url',
				array(
					'default'	=> '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'facebook_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'facebook_url',
					'type'	 => 'url',
					'label' => __( 'Facebook URL', 'qqlanding' ),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://facebook.com', 'qqlanding' )
					)
				)
			);

			//twitter
			$wp_customize->add_setting(
				'twitter_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'twitter_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'twitter_url',
					'type' => 'url',
					'label' => __('Twitter URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://twitter.com/QID', 'qqlanding' )
					)
				)
			);

			//instagram
			$wp_customize->add_setting(
				'instagram_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'instagram_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'instagram_url',
					'type' => 'url',
					'label' => __('Instagram URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://instagram.com/QID', 'qqlanding' )
					)
				)
			);

			//linkedin
			$wp_customize->add_setting(
				'linkedin_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'linkedin_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'linkedin_url',
					'type' => 'url',
					'label' => __('Linkedin URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'https://www.linkedin.com/in/QID', 'qqlanding' )
					)
				)
			);

			//youtube
			$wp_customize->add_setting(
				'youtube_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'youtube_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'youtube_url',
					'type' => 'url',
					'label' => __('Youtube URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://www.youtube.com/watch?v=awEwrR1', 'qqlanding' )
					)
				)
			);

			//google-plus
			$wp_customize->add_setting(
				'googleplus_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'googleplus_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'googleplus_url',
					'type' => 'url',
					'label' => __('Google Plus URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://plus.google.com/104605854646', 'qqlanding' )
					)
				)
			);

			//pinterest
			$wp_customize->add_setting(
				'pinterest_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'pinterest_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'pinterest_url',
					'type' => 'url',
					'label' => __('Pinterest URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://www.pinterest.com/QID/', 'qqlanding' )
					)
				)
			);

			//rss
			$wp_customize->add_setting(
				'rss_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'rss_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'rss_url',
					'type' => 'url',
					'label' => __('RSS URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://www.example.com/QID/', 'qqlanding' )
					)
				)
			);

			//flickr
			$wp_customize->add_setting(
				'flickr_url',
				array(
					'default' => '',
					'sanitize_callback' => 'qqlanding_sanitize_url'
				)
			);
			$wp_customize->add_control(
				'flickr_url',
				array(
					'section' => 'qqlanding_socialMedia_settings',
					'setting' => 'flickr_url',
					'type' => 'url',
					'label' => __('Flickr URL?', 'qqlanding'),
					'input_attrs' => array(
						'placeholder' => __( 'Eg: https://www.flickr.com/photos/QID', 'qqlanding' )
					)
				)
			);
		/**
		 * ## Blogs Section
		 *-------------------------------------*/
		$wp_customize->add_section(
			'qqlanding_blog_options',
			array(
				'priority'	=> 4,
				'title'		=> esc_html__( 'Blogs Settings', 'qqlanding' ),
				'panel'		=> 'qqlanding_theme_options'
			)
		);
			//Side-bar layout Setting
			$wp_customize->add_setting(
				'qqlanding_blog_sidebar_layout',
				array(
					'default' => 'both',
					'sanitize_callback' => 'qqlanding_sanitize_radio'
				)
			);

			$wp_customize->add_control(
				new QQLanding_Customize_Radio_Image(
					$wp_customize, 'qqlanding_blog_sidebar_layout',
					array(
						'label'		=> __( 'Sidebar Layouts', 'qqlanding' ),
						'section'	=> 'qqlanding_blog_options',
						'settings'	=> 'qqlanding_blog_sidebar_layout',
						'description' => esc_html__( 'Choose a layout for the sidebar.', 'qqlanding' ),
						'choices'	=> array(
							'right'	=> array(
								'label'		=> esc_html__( 'Right Sidebar', 'qqlanding' ),
								'url'		=> '%sright.jpg'
							),
							'left'	=> array(
								'label'		=> esc_html__( 'Left Sidebar', 'qqlanding' ),
								'url'		=> '%sleft.jpg'
							),
							'both'	=> array(
								'label'		=> esc_html__( 'Both Sidebar', 'qqlanding' ),
								'url'		=> '%sboth.jpg'
							),
							'none'	=> array(
								'label'		=> esc_html__( 'No Sidebar', 'qqlanding' ),
								'url'		=> '%snone.jpg'
							),
						)
					)
				)
			);


		/**
		 * ## Footer Section
		 *-------------------------------------*/
		$wp_customize->add_section( 'qqlanding_footer_options',
			array(
				'priority' 	=> 9,
				'title'		=> esc_html__( 'Footer Settings', 'qqlanding' ),
				'description' => esc_html__( '', 'qqlanding' ),
				'panel'		=> 'qqlanding_theme_options'
			)
		);

			//Footer Settings
			$wp_customize->add_setting( 'qqlanding_footer_settings',
				array(
					'default'	=> sprintf( __( 'Copyright %s. All rights reserved.', 'qqlanding' ), esc_html( get_bloginfo( 'name' ) ) ),
					'sanitize_callback'		=> 'qqlanding_sanitize_html'
				)
			);

			//Footer Controls
			$wp_customize->add_control( 'qqlanding_footer_settings',
				array(	
					'type'		=> 'textarea',
					'label'		=> esc_html__( 'Footer Copyright Editor', 'qqlanding' ),
					'description'		=> esc_html__( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'qqlanding' ),
					'section' => 'qqlanding_footer_options',
				)
			);
}
add_action( 'customize_register', 'qqlanding_customizer_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function qqlanding_customize_preview_js() {
	wp_enqueue_script( 'qqlanding-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'qqlanding_customize_preview_js' );