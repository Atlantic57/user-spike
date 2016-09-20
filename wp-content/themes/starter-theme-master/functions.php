<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

add_shortcode( 'member', 'member_check_shortcode' );

function member_check_shortcode( $atts, $content = null ) {
	 if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return $content;
	return 'gotta be logged in';
}

/**
 * Custom Post Types
 */

 add_action( 'init', 'create_challenges' );
 function create_challenges() {
	 register_post_type( 'challenges',
		 array(
			 'labels' => array(
				 'name' => __( 'Challenges' ),
				 'singular_name' => __( 'Challenge' )
			 ),
			 'public' => true,
			 'has_archive' => true,
			 'supports' => array(
				 'title',
				 'editor',
				 'author',
				 'thumbnail',
				 'comments'
			 )
		 )
	 );
 }

 add_action( 'init', 'create_solutions' );
 function create_solutions() {
	 register_post_type( 'solutions',
		 array(
			 'labels' => array(
				 'name' => __( 'Solutions' ),
				 'singular_name' => __( 'Solution' )
			 ),
			 'public' => true,
			 'has_archive' => true,
			 'supports' => array(
				 'title',
				 'editor',
				 'author',
				 'thumbnail',
				 'comments'
			 )
		 )
	 );
 }


/**
 * Routes
 */

 // A listing of users
 Routes::map('users/', function($params){
	 Routes::load('page-users.php', $params, $query);
 });

 // A single user's page
 Routes::map('users/:id', function($params){
	 Routes::load('page-user.php', $params, $query);
 });

 // A single user's page
 Routes::map('users/edit/:id', function($params){
	 Routes::load('page-user-edit.php', $params, $query);
 });

 // A single user's page
 Routes::map('users/update/:id', function($params){
	 Routes::load('page-user-update.php', $params, $query);
 });

 // A single user's page
 Routes::map('login/', function($params){
	 Routes::load('page-user-login.php', $params, $query);
 });

 // Create a Solution (Form)
 Routes::map('solutions/create/:cid', function($params){
	 Routes::load('page-solution-create.php', $params, $query);
 });

 // Create a Solution (Action)
 Routes::map('solutions/insert', function($params){
	 Routes::load('page-solution-insert.php', $params, $query);
 });

 // Upvote Solution (Action)
 Routes::map('solutions/upvote', function($params){
	 Routes::load('page-solution-upvote.php', $params, $query);
 });

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		$context['is_logged_in'] = is_user_logged_in();
		$context['current_user_id'] = get_current_user_id();
		$context['logout_link'] = wp_logout_url( home_url() );
		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}

new StarterSite();
