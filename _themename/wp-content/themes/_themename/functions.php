<?php
/**
 * _themename functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _themename
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( '_themename_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _themename_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _themename, use a find and replace
		 * to change '_themename' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_themename', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_themename' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'_themename_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', '_themename_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _themename_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_themename_content_width', 640 );
}
add_action( 'after_setup_theme', '_themename_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _themename_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_themename' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_themename' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_themename_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _themename_scripts() {
  wp_enqueue_style( '_themename-style', get_stylesheet_uri(), array(), _S_VERSION );
  wp_style_add_data( '_themename-style', 'rtl', 'replace' );


  wp_enqueue_style('bs-en', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
  wp_enqueue_style('aos-css', '//unpkg.com/aos@2.3.1/dist/aos.css');
  wp_enqueue_script('aos-js', '//unpkg.com/aos@2.3.1/dist/aos.js');

  wp_enqueue_style('slick_css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  wp_enqueue_style('slick_theme_css', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css');
  wp_enqueue_style('source_sans_pro', '//fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap');
  wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
  wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
  wp_enqueue_script('bootstrap-js', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js');
  wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (!strstr($_SERVER['SERVER_NAME'], 'http://localhost/durrah')) {
		wp_enqueue_script('main-factory-js', 'http://localhost:3000/bundled.js', null, '1.0', true);
	} else { 
		wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/undefined'), null, '1.0', true);
		wp_enqueue_script('main-factory-js', get_theme_file_uri('/bundled-assets/scripts.bfc403573692ffb3b5a5.js'), null, '1.0', true);
		wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.bfc403573692ffb3b5a5.css'));
	}
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action( 'wp_enqueue_scripts', '_themename_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

