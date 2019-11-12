<?php
/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'xlf_setup' ) ) {
	function xlf_setup() {
		add_theme_support( "title-tag" );
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );
		// Enable featured image
		add_theme_support( 'post-thumbnails' );
		// Thumbnail sizes
		add_image_size( 'xlf_single', 800, 493, true ); //(cropped)
		add_image_size( 'xlf_big', 1400, 928, true ); 	//(cropped)
		// Custom menu areas
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'xlf' ),
		) );
		// Load theme languages
		load_theme_textdomain( 'xlf', get_template_directory().'/languages' );
	}
}
add_action( 'after_setup_theme', 'xlf_setup' );

/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'xlf_sidebars' ) ) {
	function xlf_sidebars()	{
		register_sidebar(array( 'name' => esc_html__(
			'Primary', 'xlf' ),'id' => 'primary',
			'description' => esc_html__( 'Normal full width sidebar.', 'xlf' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'));
	}
}
add_action( 'widgets_init', 'xlf_sidebars' );

/*  Include Styles and script
/* ------------------------------------ */
if ( ! function_exists( 'xlf_styles_scripts' ) ) {
	function xlf_style_scripts() {
		//wp_enqueue_script('jquery');
		wp_enqueue_script( 'xlf-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true );
		wp_enqueue_style( 'xlf-roboto','//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i,900,900i&display=swap');
		wp_enqueue_style( 'xlf-normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css');
		wp_enqueue_style( 'xlf', get_template_directory_uri().'/style.css');
	}
}
add_action( 'wp_enqueue_scripts', 'xlf_style_scripts' );

/*  Oembed Responsive
/* ------------------------------------ */
add_filter( 'embed_oembed_html', 'xlf_oembed_filter', 10, 4 ) ;
function xlf_oembed_filter($html, $url, $attr, $post_ID) {
	$return = '<figure class="video-container">'.$html.'</figure>';
	return $return;
}
