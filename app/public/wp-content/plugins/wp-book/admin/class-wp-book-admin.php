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
					'name' => __( 'Books' ),
					'singular_name' => __( 'Book' ),
					'add_new' => __( 'Add New' )
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


		function create_tags_nonhierarchical_taxonomy() {
  
			// Labels part for the GUI
			  
			  $labels = array(
				'name' => _x( 'Tags', 'taxonomy general name' ),
				'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Tags' ),
				'popular_items' => __( 'Popular Tags' ),
				'all_items' => __( 'All Tags' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Tag' ), 
				'update_item' => __( 'Update Tag' ),
				'add_new_item' => __( 'Add New Tag' ),
				'new_item_name' => __( 'New Tag Name' ),
				'separate_items_with_commas' => __( 'Separate tags with commas' ),
				'add_or_remove_items' => __( 'Add or remove tags' ),
				'choose_from_most_used' => __( 'Choose from the most used tags' ),
				'menu_name' => __( 'Tags' ),
			  ); 
			  
			// Now register the non-hierarchical taxonomy like tag
			  
			  register_taxonomy('tags','books',array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array( 'slug' => 'tag' ),
			  ));
			}

			// Add the metabox functionality at the end of the Wp_Book_Admin class
public function add_book_metaboxes() {
    add_meta_box(
        'wp_book_meta',
        'Book Information',
        array($this, 'render_book_meta_box'),
        'books',
        'normal',
        'high'
    );
}

public function render_book_meta_box($post) {
    // Nonce field for security
    wp_nonce_field( 'save_book_meta', 'book_meta_nonce' );

    // Retrieve current meta data
    $author_name = get_post_meta( $post->ID, '_author_name', true );
    $price = get_post_meta( $post->ID, '_price', true );
    $publisher = get_post_meta( $post->ID, '_publisher', true );
    $year = get_post_meta( $post->ID, '_year', true );
    $edition = get_post_meta( $post->ID, '_edition', true );
    $url = get_post_meta( $post->ID, '_url', true );

    // Display the form fields
    ?>
    <table class="form-table">
                <tr>
                    <th><label for="author_name">Author Name</label></th>
                    <td><input type="text" id="author_name" name="author_name" value="<?php echo esc_attr($author_name); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="price">Price</label></th>
                    <td><input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="publisher">Publisher</label></th>
                    <td><input type="text" id="publisher" name="publisher" value="<?php echo esc_attr($publisher); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="year">Year</label></th>
                    <td><input type="text" id="year" name="year" value="<?php echo esc_attr($year); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="edition">Edition</label></th>
                    <td><input type="text" id="edition" name="edition" value="<?php echo esc_attr($edition); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="url">URL</label></th>
                    <td><input type="text" id="url" name="url" value="<?php echo esc_attr($url); ?>" class="regular-text"></td>
                </tr>
            </table>
    <?php
}

public function save_book_meta($post_id) {
    // Check if nonce is set
    if ( ! isset( $_POST['book_meta_nonce'] ) ) {
        return $post_id;
    }

    $nonce = $_POST['book_meta_nonce'];

    // Verify nonce
    if ( ! wp_verify_nonce( $nonce, 'save_book_meta' ) ) {
        return $post_id;
    }

    // Check for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // Check user permissions
    if ( 'books' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    // Sanitize user input
    $author_name = sanitize_text_field( $_POST['author_name'] );
    $price = sanitize_text_field( $_POST['price'] );
    $publisher = sanitize_text_field( $_POST['publisher'] );
    $year = sanitize_text_field( $_POST['year'] );
    $edition = sanitize_text_field( $_POST['edition'] );
    $url = sanitize_text_field( $_POST['url'] );

    // Update the meta fields
    update_post_meta( $post_id, '_author_name', $author_name );
    update_post_meta( $post_id, '_price', $price );
    update_post_meta( $post_id, '_publisher', $publisher );
    update_post_meta( $post_id, '_year', $year );
    update_post_meta( $post_id, '_edition', $edition );
    update_post_meta( $post_id, '_url', $url );
}

}
