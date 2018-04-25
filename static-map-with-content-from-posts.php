<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://atarimtr.com
 * @since             1.0.0
 * @package           Static_Map_With_Content_From_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Static Map With Content From Posts
 * Plugin URI:        http://atarimtr.com
 * Description:       Add an image map and define places on it that will load asynchronously the relevant post for each point on a separate element in the page when clicked. The plugin has two shortcodes, one for the image map with the points [map_and_posts_map] and second for the presentation of the post related to the clicked point [map_and_posts_post]. It also has a command that reloads Avada's image slider for the reloaded posts of Avada that has an image slider.
 * Version:           1.0.0
 * Author:            Yehuda Tiram
 * Author URI:        http://atarimtr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       static-map-with-content-from-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STATIC_MAP_WITH_CONTENT_FROM_POSTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-static-map-with-content-from-posts-activator.php
 */
function activate_static_map_with_content_from_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-static-map-with-content-from-posts-activator.php';
	Static_Map_With_Content_From_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-static-map-with-content-from-posts-deactivator.php
 */
function deactivate_static_map_with_content_from_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-static-map-with-content-from-posts-deactivator.php';
	Static_Map_With_Content_From_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_static_map_with_content_from_posts' );
register_deactivation_hook( __FILE__, 'deactivate_static_map_with_content_from_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-static-map-with-content-from-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_static_map_with_content_from_posts() {

	$plugin = new Static_Map_With_Content_From_Posts();
	$plugin->run();

}
run_static_map_with_content_from_posts();
