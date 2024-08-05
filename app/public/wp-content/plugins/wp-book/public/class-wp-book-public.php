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

	
	/**
	 * Register the shortcode.
	 */

	
		public function register_shortcodes() {
			add_shortcode('book', array($this, 'book_shortcode'));
		}
	
		public function book_shortcode($atts) {
			global $wpdb;
		
			// Set up shortcode attributes with default values
			$atts = shortcode_atts(
				array(
					'book_name'   => '',
					'author_name' => '',
					'year'        => '',
					'category'    => '',
					'tag'         => '',
					'publisher'   => '',
				),
				$atts,
				'book'
			);
		
			// Build the SQL query
			$query = "SELECT p.ID, p.post_title, meta_book_name.meta_value AS book_name, meta_author_id.meta_value AS author_id, meta_year.meta_value AS year, meta_pub_id.meta_value AS pub_id
					  FROM {$wpdb->posts} p
					  LEFT JOIN {$wpdb->prefix}book_meta meta_book_name ON p.ID = meta_book_name.post_id AND meta_book_name.meta_key = 'book_name'
					  LEFT JOIN {$wpdb->prefix}book_meta meta_author_id ON p.ID = meta_author_id.post_id AND meta_author_id.meta_key = 'author_id'
					  LEFT JOIN {$wpdb->prefix}book_meta meta_year ON p.ID = meta_year.post_id AND meta_year.meta_key = 'year'
					  LEFT JOIN {$wpdb->prefix}book_meta meta_pub_id ON p.ID = meta_pub_id.post_id AND meta_pub_id.meta_key = 'pub_id'
					  WHERE p.post_type = 'books' AND p.post_status = 'publish'";
		
			// Add filters based on shortcode attributes
			if (!empty($atts['book_name'])) {
				$query .= $wpdb->prepare(" AND meta_book_name.meta_value LIKE %s", '%' . $wpdb->esc_like($atts['book_name']) . '%');
			}
		
			if (!empty($atts['author_name'])) {
				$query .= $wpdb->prepare(" AND meta_author_id.meta_value LIKE %s", '%' . $wpdb->esc_like($atts['author_name']) . '%');
			}
		
			if (!empty($atts['year'])) {
				$query .= $wpdb->prepare(" AND meta_year.meta_value LIKE %s", '%' . $wpdb->esc_like($atts['year']) . '%');
			}
		
			if (!empty($atts['publisher'])) {
				$query .= $wpdb->prepare(" AND meta_pub_id.meta_value LIKE %s", '%' . $wpdb->esc_like($atts['publisher']) . '%');
			}
		
			// Execute the query
			$books = $wpdb->get_results($query);
		
			// Generate the output
			$output = '<div class="wp-book-shortcode">';
			if (!empty($books)) {
				foreach ($books as $book) {
					// Fetch the categories and tags for each book
					$categories = get_the_category_list(', ', '', $book->ID);
					$tags = get_the_terms($book->ID, 'tags');
					$tag_list = '';
					if ($tags && !is_wp_error($tags)) {
						$tag_links = array();
						foreach ($tags as $tag) {
							$tag_links[] = '<a href="' . get_term_link($tag->term_id) . '">' . $tag->name . '</a>';
						}
						$tag_list = join(', ', $tag_links);
					}
		
					// Append book details to the output
					$output .= '<div class="book">';
					$output .= '<h2><strong>' . esc_html($book->post_title) . '</strong></h2>';
					$output .= '<p><strong>' . __('Author:', 'wp-book') . '</strong> ' . esc_html($book->author_id) . '</p>';
					$output .= '<p><strong>' . __('Year:', 'wp-book') . '</strong> ' . esc_html($book->year) . '</p>';
					$output .= '<p><strong>' . __('Publisher:', 'wp-book') . '</strong> ' . esc_html($book->pub_id) . '</p>';
					$output .= '<p><strong>' . __('Category:', 'wp-book') . '</strong> ' . $categories . '</p>';
					$output .= '<p><strong>' . __('Tags:', 'wp-book') . '</strong> ' . $tag_list . '</p>';
					$output .= '</div>';
				}
			} else {
				$output .= '<p>' . __('No books found', 'wp-book') . '</p>';
			}
			$output .= '</div>';
		
			return $output;
		}
		
	}
	

