<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://http://localhost/customplugin
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 * @author     Maham Zahid <mahamzahid333@gmail.com>
 */
class Wp_Book_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-public.js', array( 'jquery' ), $this->version, false );

	}

	public function register_shortcodes() {
		add_shortcode( 'book', array( $this, 'render_book_shortcode' ) );
	}
	
	public function render_book_shortcode( $atts ) {
		// Shortcode attributes with default values
		$atts = shortcode_atts(
			array(
				'id' => '',
				'author_name' => '',
				'year' => '',
				'category' => '',
				'tag' => '',
				'publisher' => ''
			),
			$atts,
			'book'
		);
	
		$args = array(
			'post_type' => 'books',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_query' => array(
				'relation' => 'AND'
			)
		);
	
		if ( ! empty( $atts['id'] ) ) {
			$args['p'] = intval( $atts['id'] );
		}
	
		if ( ! empty( $atts['author_name'] ) ) {
			$args['meta_query'][] = array(
				'key'     => '_author_name',
				'value'   => sanitize_text_field( $atts['author_name'] ),
				'compare' => 'LIKE'
			);
		}
	
		if ( ! empty( $atts['year'] ) ) {
			$args['meta_query'][] = array(
				'key'     => '_year',
				'value'   => sanitize_text_field( $atts['year'] ),
				'compare' => '='
			);
		}
	
		if ( ! empty( $atts['publisher'] ) ) {
			$args['meta_query'][] = array(
				'key'     => '_publisher',
				'value'   => sanitize_text_field( $atts['publisher'] ),
				'compare' => 'LIKE'
			);
		}
	
		if ( ! empty( $atts['category'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $atts['category'] ),
			);
		}
	
		if ( ! empty( $atts['tag'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'tags',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $atts['tag'] ),
			);
		}
	
		$query = new WP_Query( $args );
	
		ob_start();
	
		if ( $query->have_posts() ) {
			echo '<ul class="books-list">';
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<li>
					<h2><?php the_title(); ?></h2>
					<p><strong>Author:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_author_name', true ) ); ?></p>
					<p><strong>Year:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_year', true ) ); ?></p>
					<p><strong>Publisher:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_publisher', true ) ); ?></p>
				</li>
				<?php
			}
			echo '</ul>';
		} else {
			echo '<p>No books found.</p>';
		}
	
		wp_reset_postdata();
	
		return ob_get_clean();
	}
	

}