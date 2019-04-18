<?php
class Rise_Customizer{

   /**
	* The object instance.
	*
	* @static
	* @access private
	* @since 1.0.0
	* @var object
	*/
	private static $instance;

	/**
	* The Field array
	*
	* @since  1.0.0
	* @access public
	* @var    array 
	*/
	public static $fields = array();

	/**
	* The Customizer instance
	* 
	* @since  1.0.0
	* @access private
	* @var    object
	*/
	private static $customize;

	/**
	* Custom Section array
	* 
	* @since  1.0.0
	* @access private
	* @var    array
	*/
	private static $sections = array();


	# Some Default sections ids in WordPress 
	private static $default_sections = array( 
		'title_tagline',
		'colors',
		'header_image',
		'background_image',
		'nav',
		'static_front_page',
	);

	/**
	* The Panel array
	* 
	* @since  1.0.0
	* @access private
	* @var    array
	*/
	private static $panels = array();

	/**
	* The Setting array
	* 
	* @since  1.0.0
	* @access private
	* @var    array
	*/
	private static $settings = array();

	/**
	* The Controls array
	* 
	* @since  1.0.0
	* @access private
	* @var    array
	*/
	private static $controls = array();

	/**
	* The defaults array
	* 
	* @since  1.0.0
	* @access private
	* @var    array
	*/
	private static $defaults = array();

	/**
	* Know weather client is using color control
	* 
	* @since  1.0.0
	* @access public
	* @var    bool
	*/
	public static $color_picker = false;

	private static $errors = array();

   /**
	* Gets an instance of this object.
	* Prevents duplicate instances which avoid artefacts and improves performance.
	*
	* @static
	* @access public
	* @since 1.0.0
	* @return object
	*/
	public static function get_instance() {
		if( !self::$instance ) {

			self::$instance = new self();
			add_action( 'admin_notices', array( self::$instance, 'errors' ) );
		}
		return self::$instance;
	}

   /**
	* The Setter function
	*
	* @static
	* @access public
	* @since 1.0.0
	* @return object
	*/
	public static function set( $args ){
		// echo "<pre>";
		// print_r($args);die;

		self::validate_argument( $args );
		if( count( self::$errors ) > 0 )
			return;

		$panel_id = false;
		if( isset( $args[ 'panel' ] ) ){
			$panel_id = $args[ 'panel' ][ 'id' ];
			if( !array_key_exists( $panel_id, self::$panels ) ){
				self::$panels[ $panel_id ] = self::get_panel_arg( $args[ 'panel' ] );
			}
		}

		$section_id = $args[ 'section' ][ 'id' ];
		if( !in_array( $section_id, self::$default_sections ) ){
			self::$sections[ $section_id ] = self::get_section_arg( $panel_id, $args[ 'section' ] );
		}

		foreach( $args[ 'fields' ] as $field ){

			if( isset( $field[ 'id' ] ) ){

				if( isset( $field[ 'default' ] ) ){
					self::$defaults[ $field[ 'id' ] ] = $field[ 'default' ];
				}

				self::$settings[ $field[ 'id' ] ] = self::get_setting_arg( $field );
				self::$controls[ $field[ 'id' ] ] = self::get_control_arg( $args[ 'section' ], $field );

				if( 'color' == $field[ 'type' ] ){
					self::$color_picker = true;
				}
			}
		}
	}

   /**
	* Checks wheather the arguments are eligible for customizer
	* Adds error if invalid arguments
	* @static
	* @access private
	* @param arrau
	* @since 1.0.0
	* @return void
	*/
	private static function validate_argument( $args ){

		if( !is_array( $args ) ){
			self::add_error( esc_html__( 'You must pass array as an argument in set method.', 'rise-customizer' ) );
			return;
		}elseif( !isset( $args[ 'fields' ] ) ){
			self::add_error( esc_html__( 'No fields found.', 'rise-customizer' ) );
		}elseif( !is_array( $args[ 'fields' ] ) ){
			self::add_error( sprintf( '<em>%s</em> argument must be a set of array.',
				__( 'fields', 'rise-customizer' )
			));
		}elseif( !isset( $args[ 'section' ] ) ){
			self::add_error( esc_html__( 'No section found.', 'rise-customizer' ) );
			
		}elseif( !is_array( $args[ 'section' ] ) ){
			self::add_error( sprintf( '<em>%s</em> argument must be a an array with atleast an id, title...',
				__( 'section', 'rise-customizer' )
			));
		}elseif( !isset( $args[ 'section' ][ 'id' ] ) ){
			self::add_error( sprintf( '<em>%s</em> argument must have an id.',
				__( 'section', 'rise-customizer' )
			));
		}

		if( isset( $args[ 'panel' ] ) ){
			if( !is_array( $args[ 'panel' ] ) ){
				self::add_error( esc_html__( 'Panel argument must be an array.', 'rise-customizer' ) );
			}elseif( !isset( $args[ 'panel' ][ 'id' ] ) ){
				self::add_error( esc_html__( 'Missing panel id.', 'rise-customizer' ) );
			}
		}
	}

   /**
	* Adds Errors in a static variable
	*
	* @static
	* @access private
	* @param string
	* @since 1.0.0
	* @return void
	*/
	private static function add_error( $msg ){
		self::$errors[] = $msg;
	}

   /**
	* Print errors in dashboard
	*
	* @static
	* @access public
	* @since 1.0.0
	* @return void
	*/
	public static function errors(){

		if( count( self::$errors ) > 0 ){
			?>
			<div class="error">
				<?php foreach ( self::$errors as $key => $value ): ?>
					<p>
						<?php  
							echo sprintf( '<strong>%s</strong> %s', 
								__( 'Rise Customizer:' ),
								$value 
							);  
						?>
					</p>
				<?php endforeach; ?>
			</div>
			<?php
			die;
		}
	}

    /**
	* Retrives all default values
	* 
	* @access public
	* @since  1.0.0
	* @return array
	*/
    public static function get_defaults(){
    	return self::$defaults;
    }

    /**
	* Retrives all default value by id
	* 
	* @access public
	* @since  1.0.0
	* @return string|int|bool
	*/

    public static function get_default( $id ){
    	return self::$defaults[ $id ];
    }

	/**
	* Sanitization function.
	*
	* @access public
	* @since 1.0.0
	* @return number
	*/

    public static function sanitize_number( $input, $setting ){
    	$sanitized_text = sanitize_text_field( $input );
    	# If the input is an number, return it; otherwise, return the default
    	return ( is_numeric( $sanitized_text ) ? $sanitized_text : $setting->default );
    }

	/**
	* Sanitization function.
	*
	* @access public
	* @since 1.0.0
	* @return boolean
	*/

    public static function sanitize_checkbox( $checked ) {
    	return ( ( isset( $checked ) && true === $checked ) ? true : false );
    }

    /**
    * Sanitization function.
    *
    * @access public
    * @since 1.0.0
    * @return string
    */

    public static function sanitize_choice( $input, $setting ){

    	# Ensure input is a slug.
    	$input = sanitize_key( $input );
    	# Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;

    	# If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    /**
	* Retrives value by id
	* 
	* @since  1.0.0
	* @access public
	* @param  string $id
	* @return string | false
	*/
	public static function get( $id ){

		$defaults = self::get_defaults();

		if( isset( $defaults[ $id ] ) ){
			$default = $defaults[ $id ];
		}else{
			$default = false;
		}

		return get_theme_mod( $id, $default );
	}

    /**
	* Returns Sanitization function
	* 
	* @since  1.0.0
	* @access private
	* @param  string $type
	* @return string
	*/
	private static function get_sanitize_callback( $type ){

		switch ( $type ) {
			case 'text':
				return 'sanitize_text_field';

			case 'url':
				return 'esc_url_raw';

			case 'email':
				return 'sanitize_email';

			case 'number':
				return array( self::get_instance(), 'sanitize_number' );

			case 'checkbox':
				return array( self::get_instance(), 'sanitize_checkbox' );

			case 'select':
			case 'radio':
				return array( self::get_instance(), 'sanitize_choice' );

			case 'textarea':
				return 'esc_textarea';

			case 'colors':
				return 'sanitize_hex_color';

			case 'dropdown-pages':
			case 'dropdown-posts':
			case 'dropdown-categories':
				return 'absint';
		}
	}

    /**
	* Returns args for panels
	* 
	* @since  1.0.0
	* @access private
	* @param  array $panel
	* @return array
	*/
	private static function get_panel_arg( $panel ){

		$args = array(
		    'title' => empty( $panel[ 'title' ] ) ? esc_html( 'No Title Specified.', 'rise-customizer' ) : $panel[ 'title' ],
		);

		if( isset( $panel[ 'description' ] ) ){
			$args[ 'description' ] = $panel[ 'description' ];
		}

		if( isset( $panel[ 'priority' ] ) ){
			$args[ 'priority' ] = $panel[ 'priority' ];
		}

		if( isset( $panel[ 'active_callback' ] ) ) {
            $args[ 'active_callback' ] = $panel[ 'active_callback' ];
        }

        if( isset( $panel[ 'theme_supports' ] ) ) {
            $args[ 'theme_supports' ] = $panel[ 'theme_supports' ];
        }

        if( isset( $panel[ 'capability' ] ) ) {
            $args[ 'capability' ] = $panel[ 'capability' ];
        }

        return $args;
	}


    /**
	* Returns args for settings
	* 
	* @since  1.0.0
	* @access private
	* @param  array $field
	* @return array
	*/
	private static function get_setting_arg( $field ){

		$args = array();

		if( isset( self::$defaults[ $field[ 'id' ] ] ) )
			$args[ 'default' ] = self::$defaults[ $field[ 'id' ] ];
		else
			$args[ 'default' ] = '';

		if( isset( $field[ 'setting_type' ] ) || !empty( $field[ 'setting_type' ] ) ){
			$args[ 'type' ] = $field[ 'setting_type' ];
		}

		if( isset( $field[ 'capability' ] ) && !empty( $field[ 'capability' ] ) ){
			$args[ 'capability' ] = $field[ 'capability' ];
		}

		if( isset( $field[ 'theme_supports' ] ) && !empty( $field[ 'theme_supports' ] ) ){
			$args[ 'theme_supports' ] = $field[ 'theme_supports' ];
		}

		if( isset( $field[ 'transport' ] ) || !empty( $field[ 'transport' ] ) ){
			$args[ 'transport' ] = $field[ 'transport' ];
		}

		if( isset( $field[ 'sanitize_callback' ] ) && !empty( $field[ 'sanitize_callback' ] ) ){
			$args[ 'sanitize_callback' ] = $field[ 'sanitize_callback' ];
		}else{
			$args[ 'sanitize_callback' ] = self::get_sanitize_callback( $field[ 'type' ] );
		}

		if( isset( $field[ 'sanitize_js_callback' ] ) && !empty( $field[ 'sanitize_js_callback' ] ) ){
			$args[ 'sanitize_js_callback' ] = $field[ 'sanitize_js_callback' ];
		}

		return $args;
	}


    /**
	* Returns args for control
	* 
	* @since  1.0.0
	* @access private
	* @param  array $panel
	* @param  array $field
	* @return array
	*/
	private static function get_control_arg( $section, $field ){
		$args = array();

		if( isset( $field[ 'type' ] ) && !empty( $field[ 'type' ] ) ){
			$args[ 'type' ] = $field[ 'type' ];
		}

		if( isset( $field[ 'label' ] ) && !empty( $field[ 'label' ] ) ){
			$args[ 'label' ] = $field[ 'label' ];
		}

		if( isset( $field[ 'description' ] ) && !empty( $field[ 'description' ] ) ){
			$args[ 'description' ] = $field[ 'description' ];
		}

		if( is_array( $section ) && isset( $section[ 'id' ] ) ){
			$args[ 'section' ] = $section[ 'id' ];
		}

		if( isset( $field[ 'priority' ] ) && !empty( $field[ 'priority' ] ) ){
			$args[ 'priority' ] = $field[ 'priority' ];
		}

		if( isset( $field[ 'active_callback' ] ) ) {
            $args[ 'active_callback' ] = $field[ 'active_callback' ];
        }

		if( isset( $field[ 'settings' ] ) && !empty( $field[ 'settings' ] ) ){
			$args[ 'settings' ] = $field[ 'settings' ];
		}

		if( isset( $field[ 'choices' ] ) && is_array( $field[ 'choices' ] ) ){
			$args[ 'choices' ] = $field[ 'choices' ];
		}

		if( isset( $field[ 'height' ] ) && !empty( $field[ 'height' ] ) ){
			$args[ 'height' ] = $field[ 'height' ];
		}

		if( isset( $field[ 'width' ] ) && !empty( $field[ 'width' ] ) ){
			$args[ 'width' ] = $field[ 'width' ];
		}

		if( isset( $field[ 'input_attrs' ] ) && !empty( $field[ 'input_attrs' ] ) ){
			$args[ 'input_attrs' ] = $field[ 'input_attrs' ];
		}

		return $args;
	}

	/**
	* adds Customizer's sections.
	* 
	* @since  1.0.0
	* @access private
	* @link   https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section 
	* @return void
	*/
	private static function get_section_arg( $panel_id=false, $section ){

		$args = array(
			'title' => empty( $section[ 'title' ] ) ? esc_html__( 'No Title Specified.', 'rise-customizer' ) : $section[ 'title' ],
		);

		if( isset( $section[ 'priority' ] ) ){
			$args[ 'priority' ] = $section[ 'priority' ];
		}

		if( isset( $section[ 'description' ] ) ){
			$args[ 'description' ] = $section[ 'description' ];
		}

		if( isset( $section[ 'active_callback' ] ) ){
			$args[ 'active_callback' ] = $section[ 'active_callback' ];
		}

		if( $panel_id ){
			$args[ 'panel' ] = $panel_id;
		}

		return $args;
	}

	/**
	* Equeue necessary scripts or styles for customizer
	* 
	* @since  1.0.0
	* @access public
	* @return void
	*/
	public static function scripts(){
		if( self::$color_picker ){
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker');
		}
	}

	/**
	* Register panels, sections, controls and settings
	* 
	* @since  1.0.0
	* @param  object ( $wp_customize )
	* @access public
	* @return void
	*/
	public static function register( $wp_customize ) {

		if( count( self::$errors ) > 0 )
			return;

		add_action( 'admin_enqueue_scripts', array( self::get_instance(), 'scripts' ) );

		do_action( 'rise_customize_register', $wp_customize );

		foreach( self::$panels as $id => $args ){
			$wp_customize->add_panel( $id, $args );
		}

		foreach( self::$sections as $id => $args ){
			$wp_customize->add_section( $id, $args );
		}
		
		foreach( self::$settings as $id => $args ){

			$wp_customize->add_setting( $id, $args );

			$control = self::$controls[ $id ];

			switch( $control[ 'type' ] ){

				case 'colors':
						
					unset( $control[ 'type' ] );

					$wp_customize->add_control( new WP_Customize_Color_Control( 
						$wp_customize, 
						$id, 
						$control
					));

					break;

				case 'file':

					$wp_customize->add_control( new WP_Customize_Upload_Control( 
						$wp_customize, 
						$id, 
						$control
					) );

					break;	

				case 'image':

					$wp_customize->add_control( new WP_Customize_Image_Control(
						$wp_customize, 
						$id, 
						$control
			        ) );

					break;

				default:
					$wp_customize->add_control( $id, $control );
				break;
			}
		}
	}
}

add_action( 'customize_register', array( Rise_Customizer::get_instance(), 'register' ) );
