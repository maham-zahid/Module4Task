<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://localhost/customplugin
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
class Wp_Book_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-book-admin.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-book-admin.js', array('jquery'), $this->version, false);

	}


	public function register_widgets()
	{
		register_widget('WP_Book_Books_Widget');
	}

	// Our custom post type function
	function create_book_post_type()
	{
		register_post_type(
			'books',
			// CPT Options
			array(
				'labels' => array(
					'name' => __('Books'),
					'singular_name' => __('Book'),
					'add_new' => __('Add New'),
					'add_new_item' => __('Add New Book')
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'books'),
				'show_in_rest' => true,
				'menu_icon' => 'dashicons-book',
			)
		);
	}



	//creating custom post category
	function create_book_category()
	{

		// Set UI labels for Custom Post Type
		$labels = array(
			'name' => _x('Books', 'Post Type General Name', 'wp-book'),
			'singular_name' => _x('Book', 'Post Type Singular Name', 'wp-book'),
			'menu_name' => __('Books', 'wp-book'),
			'parent_item_colon' => __('Parent Book', 'wp-book'),
			'all_items' => __('All Books', 'wp-book'),
			'view_item' => __('View Book', 'wp-book'),
			'add_new_item' => __('Add New Book', 'wp-book'),
			'add_new' => __('Add New', 'wp-book'),
			'edit_item' => __('Edit Book', 'wp-book'),
			'update_item' => __('Update Book', 'wp-book'),
			'search_items' => __('Search Book', 'wp-book'),
			'not_found' => __('Not Found', 'wp-book'),
			'not_found_in_trash' => __('Not found in Trash', 'wp-book'),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label' => __('books', 'wp-book'),
			'description' => __('Manage book reviews and ratings', 'wp-book'),
			'labels' => $labels,
			'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 5,
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'show_in_rest' => true,

			// This is where we add taxonomies to our CPT
			'taxonomies' => array('category'),
		);

		// Registering your Custom Post Type
		register_post_type('books', $args);

	}

	//custom tags function
	function create_book_tags()
	{
		// Labels part for the GUI
		$labels = array(
			'name' => _x('Tags', 'taxonomy general name'),
			'singular_name' => _x('Tag', 'taxonomy singular name'),
			'search_items' => __('Search Tags'),
			'popular_items' => __('Popular Tags'),
			'all_items' => __('All Tags'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Edit Tag'),
			'update_item' => __('Update Tag'),
			'add_new_item' => __('Add New Tag'),
			'new_item_name' => __('New Tag Name'),
			'separate_items_with_commas' => __('Separate tags with commas'),
			'add_or_remove_items' => __('Add or remove tags'),
			'choose_from_most_used' => __('Choose from the most used tags'),
			'not_found' => __('No tags found.'),
			'menu_name' => __('Tags'),
		);

		// Now register the non-hierarchical taxonomy like tag
		register_taxonomy(
			'tags',
			'books',
			array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array('slug' => 'tag'),
			)
		);
	}


	//function to add heading of metabox (book details)
	public function add_bookdetails_meta_box()
	{
		add_meta_box(
			'bookdetails',
			__('Book Details', 'wp-book'),
			array($this, 'bookdetails_meta_box_callback'),
			'books',
			'normal',
			'default'
		);
	}

	//Call back function to generate different fields of book 
	function bookdetails_meta_box_callback($post)
	{
		echo '<div style="border: 1px solid #ccc; padding: 10px; ">';
		wp_nonce_field('bookdetails_data', 'bookdetails_nonce');
		$this->bookdetails_field_generator($post);
		echo '</div>';
	}


	//metabox fields
	private $meta_fields = array(
		array(
			'label' => 'Name of Book',
			'id' => 'book_name',
			'type' => 'text',
		),
		array(
			'label' => 'Author Name',
			'id' => 'author_id',
			'type' => 'text',
		),
		array(
			'label' => 'Price',
			'id' => 'price',
			'type' => 'number',
		),
		array(
			'label' => 'Publisher',
			'id' => 'pub_id',
			'type' => 'text',
		),
		array(
			'label' => 'Year',
			'id' => 'year',
			'type' => 'number',
		),
		array(
			'label' => 'Edition',
			'id' => 'edit_id',
			'type' => 'number',
		),
		array(
			'label' => 'URL',
			'id' => 'url',
			'type' => 'url',
		),
	);

	//Call back used above to create field details
	/**
	 * Generate meta box fields.
	 */
	function bookdetails_field_generator($post)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'book_meta';

		$output = '';
		foreach ($this->meta_fields as $meta_field) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';

			// Fetch value from custom table
			$meta_value = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT meta_value FROM $table_name WHERE post_id = %d AND meta_key = %s",
					$post->ID,
					$meta_field['id']
				)
			);

			if (empty($meta_value) && isset($meta_field['default'])) {
				$meta_value = $meta_field['default'];
			}

			$input = sprintf(
				'<input %s id="%s" name="%s" type="%s" value="%s">',
				$meta_field['type'] !== 'color' ? 'style="width: 50%"' : '',
				$meta_field['id'],
				$meta_field['id'],
				$meta_field['type'],
				esc_attr($meta_value)
			);
			$output .= $this->format_rows($label, $input);
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}




	//function to describe format of all field rows
	function format_rows($label, $input)
	{
		return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
	}

	//function to save details of book

	function save_bookdetails_fields($post_id)
	{
		if (!isset($_POST['bookdetails_nonce']) || !wp_verify_nonce($_POST['bookdetails_nonce'], 'bookdetails_data')) {
			return $post_id;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'book_meta';

		foreach ($this->meta_fields as $meta_field) {
			$meta_key = $meta_field['id'];
			if (isset($_POST[$meta_key])) {
				$meta_value = $_POST[$meta_key];

				// Sanitize the input
				switch ($meta_field['type']) {
					case 'email':
						$meta_value = sanitize_email($meta_value);
						break;
					case 'text':
					case 'url':
						$meta_value = sanitize_text_field($meta_value);
						break;
					case 'number':
						$meta_value = intval($meta_value);
						break;
				}

				// Delete old value
				$wpdb->delete(
					$table_name,
					array(
						'post_id' => $post_id,
						'meta_key' => $meta_key,
					)
				);

				// Insert new value
				$wpdb->insert(
					$table_name,
					array(
						'post_id' => $post_id,
						'meta_key' => $meta_key,
						'meta_value' => $meta_value,
					)
				);
			}
		}
	}



	/**
	 * Add a settings page to the "Books" menu.
	 */
	public function add_settings_page()
	{
		add_submenu_page(
			'edit.php?post_type=books', // Parent slug (Books menu)
			__('Book Settings', 'wp-book'), // Page title
			__('Settings', 'wp-book'), // Menu title
			'manage_options', // Capability
			'wp-book-settings', // Menu slug
			array($this, 'render_settings_page') // Callback function
		);
	}


	/**
	 * Register settings and their fields.
	 */
	public function register_settings()
	{
		register_setting('wp_book_settings_group', 'wp_book_settings');

		add_settings_section(
			'wp_book_settings_section', // ID
			__('Book Settings', 'wp-book'), // Title
			null, // Callback
			'wp-book-settings' // Page
		);

		add_settings_field(
			'wp_book_currency', // ID
			__('Currency', 'wp-book'), // Title
			array($this, 'currency_field_callback'), // Callback
			'wp-book-settings', // Page
			'wp_book_settings_section' // Section
		);

		add_settings_field(
			'wp_book_books_per_page', // ID
			__('Books Per Page', 'wp-book'), // Title
			array($this, 'books_per_page_field_callback'), // Callback
			'wp-book-settings', // Page
			'wp_book_settings_section' // Section
		);
	}



	/**
	 * Render the settings page.
	 */
	public function render_settings_page()
	{
		?>
		<div class="wrap">
			<h1><?php _e('Book Settings', 'wp-book'); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields('wp_book_settings_group');
				do_settings_sections('wp-book-settings');
				submit_button();
				?>
			</form>
		</div>
		<?php
	}


	/**
	 * Render the currency field.
	 */
	public function currency_field_callback()
	{
		$options = get_option('wp_book_settings');
		$currency = isset($options['wp_book_currency']) ? esc_attr($options['wp_book_currency']) : 'Pkr';
		?>
		<input type="text" name="wp_book_settings[wp_book_currency]" value="<?php echo $currency; ?>">
		<?php
	}



	/**
	 * Render the books per page field.
	 */
	public function books_per_page_field_callback()
	{
		$options = get_option('wp_book_settings');
		?>
		<input type="number" name="wp_book_settings[wp_book_books_per_page]"
			value="<?php echo isset($options['wp_book_books_per_page']) ? esc_attr($options['wp_book_books_per_page']) : '10'; ?>">
		<?php
	}




	//dashboard widgets to show 5 book categories based on count
	public function wp_book_add_dashboard_widgets()
	{
		wp_add_dashboard_widget(
			'wp_book_dashboard_widget',
			__('Top 5 Book Categories', 'wp-book'),
			array($this, 'wp_book_dashboard_widget_display')
		);
	}


	public function wp_book_dashboard_widget_display()
	{
		$categories = get_terms(
			array(
				'taxonomy' => 'category',
				'orderby' => 'count',
				'order' => 'DESC',
				'number' => 5,
			)
		);

		if (!empty($categories)) {
			echo '<ul>';
			foreach ($categories as $category) {
				echo '<li>' . esc_html($category->name) . ' (' . esc_html($category->count) . ')</li>';
			}
			echo '</ul>';
		} else {
			echo '<p>' . __('No categories found.', 'wp-book') . '</p>';
		}
	}


}
class WP_Book_Books_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'wp_book_books_widget', // Base ID
			__('Books by Category', 'wp-book'), // Name
			array('description' => __('Displays books from a selected category', 'wp-book')) // Args
		);
	}

	public function widget($args, $instance)
	{
		$static_title = __('Books by Category', 'wp-book');

		echo $args['before_widget'];
		echo $args['before_title'] . $static_title . $args['after_title'];

		$categories = get_terms(
			array(
				'taxonomy' => 'category',
				'hide_empty' => false,
			)
		);

		foreach ($categories as $cat) {
			$query_args = array(
				'post_type' => 'books',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $cat->term_id,
					),
				),
			);

			$query = new WP_Query($query_args);

			if ($query->have_posts()) {
				echo '<h3>' . esc_html($cat->name) . '</h3>';
				echo '<ul style="padding-left: 20px;">'; // Indentation for books
				while ($query->have_posts()) {
					$query->the_post();
					echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				echo '</ul>';
			}
			wp_reset_postdata();
		}

		echo $args['after_widget'];
	}

	public function form($instance)
	{
		// Optionally, you can still allow a custom title to be set, but it won't be used in the widget output
		$title = !empty($instance['title']) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (not used):', 'wp-book'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"
				disabled>
		</p>
		<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

		return $instance;
	}
}