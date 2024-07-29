<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://http://localhost/customplugin
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Maham Zahid <mahamzahid333@gmail.com>
 */
class Wp_Book_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_book_post_type() {
		register_post_type( 'books',
		// CPT Options
			array(
				'labels' => array(
					'name' => __( 'Book' ),
					'singular_name' => __( 'Book' )
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'books'),
				'show_in_rest' => true,
	
			)
		);
	}




	function custom_post_type() {
  
		// Set UI labels for Custom Post Type
			$labels = array(
				'name'                => _x( 'Books', 'Post Type General Name', 'twentythirteen' ),
				'singular_name'       => _x( 'Book', 'Post Type Singular Name', 'twentythirteen' ),
				'menu_name'           => __( 'Books', 'twentythirteen' ),
				'parent_item_colon'   => __( 'Parent Book', 'twentythirteen' ),
				'all_items'           => __( 'All Books', 'twentythirteen' ),
				'view_item'           => __( 'View Book', 'twentythirteen' ),
				'add_new_item'        => __( 'Add New Book', 'twentythirteen' ),
				'add_new'             => __( 'Add New', 'twentythirteen' ),
				'edit_item'           => __( 'Edit Book', 'twentythirteen' ),
				'update_item'         => __( 'Update Book', 'twentythirteen' ),
				'search_items'        => __( 'Search Book', 'twentythirteen' ),
				'not_found'           => __( 'Not Found', 'twentythirteen' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
			);
			  
		// Set other options for Custom Post Type
			  
			$args = array(
				'label'               => __( 'books', 'twentythirteen' ),
				'description'         => __( 'MBook news and reviews', 'twentythirteen' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'show_in_rest'        => true,
				  
				// This is where we add taxonomies to our CPT
				'taxonomies'          => array( 'category' ),
			);
			  
			// Registering your Custom Post Type
			register_post_type( 'books', $args );
		  
		}





}
