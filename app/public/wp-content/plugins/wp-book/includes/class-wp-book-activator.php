<?php

/**
 * Fired during plugin activation
 *
 * @link       https://http://localhost/customplugin
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Maham Zahid <mahamzahid333@gmail.com>
 */
class Wp_Book_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

/**
 * Fired during plugin activation
 *
 * @link       https://http://localhost/customplugin
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Maham Zahid <mahamzahid333@gmail.com>
 */
	public static function activate() {
		
        self::create_book_meta_table();
	}

    private static function create_book_meta_table() {
       global $wpdb;

       $table_name = $wpdb->prefix . 'book_meta'; 
       $charset_collate = $wpdb->get_charset_collate();

       $sql = "CREATE TABLE $table_name (
        meta_id bigint(20) unsigned NOT NULL auto_increment,
        post_id bigint(20) unsigned NOT NULL,
        meta_key varchar(255) DEFAULT '' NOT NULL,
        meta_value longtext DEFAULT '' NOT NULL,
        PRIMARY KEY  (meta_id),
        KEY post_id (post_id),
        KEY meta_key (meta_key)
    )  $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
}
	