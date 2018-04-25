<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://atarimtr.com
 * @since      1.0.0
 *
 * @package    Static_Map_With_Content_From_Posts
 * @subpackage Static_Map_With_Content_From_Posts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Static_Map_With_Content_From_Posts
 * @subpackage Static_Map_With_Content_From_Posts/includes
 * @author     Yehuda Tiram <yehuda@atarimtr.co.il>
 */
class Static_Map_With_Content_From_Posts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'static-map-with-content-from-posts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
