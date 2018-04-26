<?php

/**
* The public-facing functionality of the plugin.
*
* @link       http://atarimtr.com
* @since      1.0.0
*
* @package    Static_Map_With_Content_From_Posts
* @subpackage Static_Map_With_Content_From_Posts/public
*/

/**
* The public-facing functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the public-facing stylesheet and JavaScript.
*
* @package    Static_Map_With_Content_From_Posts
* @subpackage Static_Map_With_Content_From_Posts/public
* @author     Yehuda Tiram <yehuda@atarimtr.co.il>
*/
class Static_Map_With_Content_From_Posts_Public {

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
	* Create shortcode for the map part and set its properties.
	*
	* @since    1.0.0
	* @param      string    $plugin_name       The name of the plugin.
	* @param      string    $version    The version of this plugin.
	*/	
	public function map_and_posts_map_shortcode(  ) {
		/*
			The ID of the theme wrapper for the Map is "map_and_posts_map_wrapper"
		*/
		ob_start();
		?>	
		<!--<img class="map-and-posts-map-img" src="http://selashaked.co.il/wp-content/plugins/static-map-with-content-from-posts/public/images/map-1.svg" />-->
  <figure class="align-center">
    <svg  height="100%" width="100%" id="image-map" class="image-map" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" xml:space="preserve" class="eatwell-plate">
		<image  height="100%" width="100%" id="map_and_posts_map_bg_image" xlink:href="http://selashaked.co.il/wp-content/plugins/static-map-with-content-from-posts/public/images/map-1.svg" x="0" y="0"  preserveAspectRatio="none" />
<!--		<image id="1551" xlink:href="http://selashaked.co.il/wp-content/plugins/static-map-with-content-from-posts/public/images/map-tack-icon-red.png" x="380" y="150" height="48px" width="48px" />
		<image id="1547" xlink:href="http://selashaked.co.il/wp-content/plugins/static-map-with-content-from-posts/public/images/map-tack-icon-red.png" x="350" y="250" height="48px" width="48px" />-->
		<?php 
		if( have_rows('projects') ):
			while ( have_rows('projects') ) : the_row();
				echo '<image class="map-tack-icon trigger" id="' . get_sub_field("post_id") . '" xlink:href="http://selashaked.co.il/wp-content/plugins/static-map-with-content-from-posts/public/images/map-tack-icon-red.png" x="' . get_sub_field("pin_position_left") . '" y="'. get_sub_field("pin_position_top") . '" height="6" width="6" />';
			endwhile;
		else :
			// no rows found 
		endif;
		?>			
		
		
	</svg>
  </figure>
		<!--<a href="#" class="map-tack-icon" alt="Load related posts" data-post_id="1547" id="map-and-posts-post-loader-btn-1"></a>
		<a href="#" class="map-tack-icon" alt="Load related posts" data-post_id="1551" id="map-and-posts-post-loader-btn-2"></a>-->
		<?php 
		// if( have_rows('projects') ):
			// while ( have_rows('projects') ) : the_row();
				// echo '<a style="top:'. get_sub_field("pin_position_top") . '%;left:' . get_sub_field("pin_position_left") . '%;" href="#" class="map-tack-icon trigger" data-post_id="' . get_sub_field("post_id") . '" id="' . get_sub_field("post_id") . '"  title="Tooltips Are Fun!"><div style="display:none;" class="map-tack-icon-tooltip">' . get_sub_field("project_name") . '<br />' . get_sub_field("location")  . '<br />' . get_sub_field("units_quantity") . '</div></a>';
			// endwhile;
		// else :
			// // no rows found 
		// endif;
		?>			
	
		<div class="map-and-posts-spinner"></div>
		<!--<div id="portfolio-posts-container"></div>-->
		<?php 
		//echo ob_get_clean();
		return ob_get_clean(); 
		
	}

	/**
	* Create shortcode for the map post display part and set its properties.
	*
	* @since    1.0.0
	* @param      string    $plugin_name       The name of the plugin.
	* @param      string    $version    The version of this plugin.
	*/	
	public function map_and_posts_post_shortcode(  ) {
		/***********************************************************/
		/*The ID of the theme wrapper for the Post is "map_and_posts_post_wrapper"
		/************************************************************/	
		$first_post = '';
		if( have_rows('projects') ):
			while ( have_rows('projects') ) : the_row();
				$first_post = get_sub_field("post_id");
			endwhile;
		else :
			$first_post = '0';
		endif;		
		ob_start();
		$post   = get_post( $first_post );
		$output =  apply_filters( 'the_content', $post->post_content );
		echo $output;
		//echo ob_get_clean();
		return ob_get_clean(); 
		
	}
	public function map_and_posts_localize_script() {

		wp_localize_script($this->plugin_name, 'magicalData', array(
		'nonce' => wp_create_nonce('wp_rest'),
		'siteURL' => get_site_url()
		));
		
	}
	
	/**
	* Register the stylesheets for the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/static-map-with-content-from-posts-public.css', array(), $this->version, 'all' );
	}

	/**
	* Register the JavaScript for the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/static-map-with-content-from-posts-public.js', array( 'jquery' ), $this->version, false );
	}

}
