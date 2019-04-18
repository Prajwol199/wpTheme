<?php
/**
 * rise_business functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rise_business
 */

if ( ! function_exists( 'rise_business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rise_business_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rise_business, use a find and replace
		 * to change 'rise_business' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rise_business', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Top', 'rise_business' ),
		) );
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Primary', 'rise_business' ),
		) );
		register_nav_menus( array(
			'menu-3' => esc_html__( 'Footer', 'rise_business' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rise_business_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'rise_business_setup' );

function theme_script_enqueue() {
	wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0.0', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style('slickcss', get_template_directory_uri() . '/css/slick.css', array(), '1.0.0', 'all');
	wp_enqueue_style('maincss', get_template_directory_uri() . '/css/main.css', array(), '1.0.0', 'all');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.js', array(), '1.0.0', true);
	wp_enqueue_script('mainjs', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
	wp_enqueue_script('slickjs', get_template_directory_uri() . '/js/slick.js', array(), '1.0.0', true);
	wp_enqueue_script('jqueryscript', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'theme_script_enqueue');


// Add new post type by calling add_post_type() function in helper_class/Post_type.php
require get_template_directory() . '/helper_class/Post_type.php';
$post_type = new Post_type;

$post_type->add_post_type('slider',									//slug of post type
	apply_filters(
		'rise_business_test_post_type_lable_parameters', 			//lables prameters
		array(
			'add_new' => 'Add Slider',
			'all_items' => 'All Slider',
		)
 	)
) ;

$post_type->add_post_type('work');
$post_type->add_post_type('counter');
$post_type->add_post_type('experts');
$post_type->add_post_type('service');

function rise_business_custom_post_type (){
/*	$labels = array(
		'name' => 'Slider',
		'singular_name' => 'Slider',
		'add_new' => 'Add Slider',
		'all_items' => 'All Slider',
		'add_new_item' => 'Add Slider',
		'edit_item' => 'Edit Slider',
		'new_item' => 'New Slider',
		'view_item' => 'View Slider',
		'search_item' => 'Search Slider',
		'not_found' => 'No slider found',
		'not_found_in_trash' => 'No slider found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('slider',$args);*/

	//post work
/*	$condition = array(
		'name' => 'Our works',
		'singular_name' => 'Work',
		'add_new' => 'Add Work',
		'all_items' => 'All Works',
		'add_new_item' => 'Add Work',
		'edit_item' => 'Edit Work',
		'new_item' => 'New Work',
		'view_item' => 'View Work',
		'search_item' => 'Search Work',
		'not_found' => 'No Work found',
		'not_found_in_trash' => 'No Work found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$arguments = array(
		'labels' => $condition,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('Work',$arguments);*/

	//counter post type
/*	$labels_counter = array(
		'name' => 'Counter',
		'singular_name' => 'Counter',
		'add_new' => 'Add Counter',
		'all_items' => 'All Counter',
		'add_new_item' => 'Add Counter',
		'edit_item' => 'Edit Counter',
		'new_item' => 'New Counter',
		'view_item' => 'View Counter',
		'search_item' => 'Search Counter',
		'not_found' => 'No Counter found',
		'not_found_in_trash' => 'No Counter found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$arguments_counter = array(
		'labels' => $labels_counter,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('counter',$arguments_counter);*/

	//experts post type
/*	$labels_experts = array(
		'name' => 'Experts',
		'singular_name' => 'Experts',
		'add_new' => 'Add Experts',
		'all_items' => 'All Experts',
		'add_new_item' => 'Add Experts',
		'edit_item' => 'Edit Experts',
		'new_item' => 'New Experts',
		'view_item' => 'View Experts',
		'search_item' => 'Search Experts',
		'not_found' => 'No Experts found',
		'not_found_in_trash' => 'No Experts found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$arguments_experts = array(
		'labels' => $labels_experts,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('experts',$arguments_experts);*/

	//service post type
/*	$labels_service = array(
		'name' => 'Service',
		'singular_name' => 'Service',
		'add_new' => 'Add Service',
		'all_items' => 'All Service',
		'add_new_item' => 'Add Service',
		'edit_item' => 'Edit Service',
		'new_item' => 'New Service',
		'view_item' => 'View Service',
		'search_item' => 'Search Service',
		'not_found' => 'No Service found',
		'not_found_in_trash' => 'No Service found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$arguments_service = array(
		'labels' => $labels_service,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('service',$arguments_service);*/
}
add_action('init','rise_business_custom_post_type');

function rise_business_metabox_for_experts() {
	  add_meta_box(
      'class_meta_box',                    // $id
      'Add Links',                         // $title
      'rise_class_meta_box_for_experts',   // $callback
      'experts',                           // $page
      'normal',                            // $context
      'high'                               // $priority
  );
}
add_action('add_meta_boxes','rise_business_metabox_for_experts');

function rise_class_meta_box_for_experts ( $post ){
	$values = get_post_custom( $post->ID );
    $facebook_text = isset( $values['my_meta_box_facebook_link'] ) ? esc_attr( $values['my_meta_box_facebook_link'][0] ): "";
    $twitter_text = isset( $values['my_meta_box_facebook_link'] ) ? esc_attr( $values['my_meta_box_twitter_link'][0] ): "";
    $linkedin_text = isset( $values['my_meta_box_facebook_link'] ) ? esc_attr( $values['my_meta_box_linkedin_link'][0] ): "";
    wp_nonce_field( 'my_meta_box_nonce','meta_box_nonce_experts' );
?>
    <label for="my_meta_box_facebook_link">Enter Facebook link </label>
     <p>
       <input type="text" name="my_meta_box_facebook_link" id="my_meta_box_facebook_link" value="<?php echo $facebook_text; ?>" />
   </p>
   <label for="my_meta_box_twitter_link">Enter Twitter link </label>
     <p>
       <input type="text" name="my_meta_box_twitter_link" id="my_meta_box_twitter_link" value="<?php echo $twitter_text; ?>" />
   </p>
   <label for="my_meta_box_linkedin_link">Enter Linkedin link </label>
     <p>
       <input type="text" name="my_meta_box_linkedin_link" id="my_meta_box_linkedin_link" value="<?php echo $linkedin_text; ?>" />
   </p>
    <?php
}

function rise_meta_box_experts_save ( $post_id ){
	if ( defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce_experts'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_experts'], 'my_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post',$post_id ) ) return;

    if( isset( $_POST['my_meta_box_facebook_link'] ) )
       update_post_meta( $post_id, 'my_meta_box_facebook_link', wp_kses( $_POST['my_meta_box_facebook_link'], $allowed ) );

   if( isset( $_POST['my_meta_box_twitter_link'] ) )
       update_post_meta( $post_id, 'my_meta_box_twitter_link', wp_kses( $_POST['my_meta_box_twitter_link'], $allowed ) );

   if( isset( $_POST['my_meta_box_linkedin_link'] ) )
       update_post_meta( $post_id, 'my_meta_box_linkedin_link', wp_kses( $_POST['my_meta_box_linkedin_link'], $allowed ) );
}
add_action( 'save_post', 'rise_meta_box_experts_save' );
//<--------------- meta box for work and counter
function rise_meta_box_for_fontawesome() {
  $posttypes = array( 'Work','counter' );
  add_meta_box(
      'class_meta_box',       // $id
      'Add Class',            // $title
      'rise_class_meta_box',  // $callback
       $posttypes,            // $page
      'normal',               // $context
      'high'                  // $priority
  );
}
add_action('add_meta_boxes', 'rise_meta_box_for_fontawesome');

function rise_class_meta_box( $post ) {

    $values = get_post_custom( $post->ID );
    $text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ): "";
    wp_nonce_field( 'my_meta_box_nonce','meta_box_nonce' );
?>
    <label for="my_meta_box_text">Add icon Class</label>
     <p>
       <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $text; ?>" />
   </p>

    <?php
}

function rise_meta_box_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post',$post_id ) ) return;

    if( isset( $_POST['my_meta_box_text'] ) )
       update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );

}
add_action( 'save_post', 'rise_meta_box_save' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rise_business_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rise_business_content_width', 640 );
}
add_action( 'after_setup_theme', 'rise_business_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rise_business_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget-1', 'rise_business' ),
		'id'            => 'footer_widget_1',
		'description'   => esc_html__( 'Add widgets here.', 'rise_business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget-2', 'rise_business' ),
		'id'            => 'footer_widget_2',
		'description'   => esc_html__( 'Add widgets here.', 'rise_business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget-3', 'rise_business' ),
		'id'            => 'footer_widget_3',
		'description'   => esc_html__( 'Add menu here.', 'rise_business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rise_business_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rise_business_scripts() {
	wp_enqueue_style( 'rise_business-style', get_stylesheet_uri() );

	wp_enqueue_script( 'rise_business-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rise_business-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rise_business_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custome Widget added.
 */
require get_template_directory() . '/widgets/social_site_widget.php';
/**
 * Seperate Templates for section
 */
require get_template_directory() . '/section_templates/template.php';
/**
 * helper classes
 */
// require get_template_directory() . '/helper_class/Post_Type.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// add ... Read more in long line
function rise_business_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'rise_business_excerpt_length',15 );

function rise_business_excerpt_more($more) {
global $post;
   return '... <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'rise_business_excerpt_more');

//<------------------ load more button --------------------->

function rise_business_load_more_scripts() {
	global $wp_query; 

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'rise_business_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );

	wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'rise_business_load_more_scripts' );



function rise_business_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page']; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here

	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop ?> 
		<section class="rt-news-section rt-bg-light py-7">
			<div class="container">
				<div class="row">
					<?php while( have_posts() ): the_post();
		 
					// look into your theme code how the posts are inserted, but you can use your own HTML of course
					// do you remember? - my example is adapted for Twenty Seventeen theme ?>
							<?php get_template_part( 'template-parts/blog-template', get_post_format() ); ?>
					<?php
					// for the test purposes comment the line above and uncomment the below one
					// the_title();
		 
		 
				    endwhile; ?>
				</div>
			</div><!-- container -->
		</section><!-- blog section -->

	<?php endif;
	die; // here we exit the script and even no wp_reset_query() required!
} 
 
add_action('wp_ajax_loadmore', 'rise_business_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'rise_business_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}



//<-------------------- TESR CUSTOMIZER FRAME WORK------------------------------------->
require get_stylesheet_directory() . '/framework.php';
// echo(get_stylesheet_directory());die;

Rise_Customizer::set(array(
    'panel' => array(
        'id' => 'my-panel-id',
        'title' => 'My Panel',
        'priority' => 10
    ),
    'section' => array(
        'id'       => 'colorsss',
        'title'    => 'Test',
        'priority' => 10
    ),
    'fields' => array(
        array(
            'id' => 'font-sizess',
            'label'       => 'Font Size',
            'default'     => 23,
            'description' => 'Font size description',
            'type'        => 'radio',
            'default' => 'b',
            'choices' => array(
                'a' => 'A',
                'b' => 'B'
            )
        ),        
        array(
            'id' => 'font-color',
            'label'       => 'Font Color',
            'default'     => '#333',
            'description' => 'Font color description',
            'type'        => 'color',
        ),
    ),
));

Rise_Customizer::set(array(
    'panel' => array( 'id' => 'my-panel-id' ),
    'section' => array(
        'id'       => 'test2',
        'title'    => 'Test 2',
        'priority' => 10
    ),
    'fields' => array(
        array(
            'id' => 'font-size1',
            'label'       => 'Font Size',
            'default'     => 3,
            'description' => 'Font size description',
            'type'        => 'text',
        ),        
        array(
            'id' => 'font-color1',
            'label'       => 'Font Color',
            'default'     => '#333',
            'description' => 'Font color description',
            'type'        => 'text',
        ),
    ),
));