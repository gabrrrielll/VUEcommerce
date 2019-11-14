<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/gabrrrielll
 * @since      1.0.0
 *
 * @package    Vuecommerce
 * @subpackage Vuecommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vuecommerce
 * @subpackage Vuecommerce/public
 * @author     Sandu Gabriel <gabrrrielll@gmail.com>
 */
class Vuecommerce_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{


		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/vuecommerce-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{


		wp_enqueue_script("vue", plugin_dir_url(__DIR__) . 'vue/dist/scripts/index.bundle.js', [], $this->version, false);
	}

	public function vueproduc_search()
	{
		register_rest_route('wpvue', 'search', array(
			'methods' => WP_REST_SERVER::READABLE,
			'callback' => 'display_results'
		));

		function display_results()
		{
			$products_search = new WP_Query(array(
				'post_type' => 'vueproduct'
			));

			$results = array();

			while ($products_search->have_posts()) {
				$products_search->the_post();
				array_push($results, array(
					'id_product' => $post_id = get_the_ID(),
					'title' => get_the_title(),
					'permalink' => get_the_permalink(),
					'description' => get_the_content(),
					'lastprice' => get_post_meta(get_the_ID(), 'lastprice', true),
					'price' => get_post_meta(get_the_ID(), 'lastprice', true),
					'categories' => wp_get_object_terms(get_the_ID(), 'vue_product_category'),
					'tags' => wp_get_object_terms(get_the_ID(), 'vue_product_tag'),
					'featured' =>  wp_get_attachment_url(get_post_thumbnail_id($post_id))
				));
			}

			return  $results;
		}
	}

	function vue_options_rute()
	{
		register_rest_route('wpvue', 'options', array(
			'methods' => WP_REST_SERVER::READABLE,
			'callback' => 'extract_results'
		));

		function extract_results()
		{


			$results = array();

			array_push($results, array(
				'wpvuecommerce_option_name' =>  get_option('wpvuecommerce_option_name'),
				'wpvuecommerce_option_nam' => get_option('wpvuecommerce_option_nam'),
			));


			return  $results;
		}
	}
}









//Return string for shortcode
function func_add_shortcode_wp_vue()
{

	//Return to display
	return ('<div id="app">VUE will render here</div>');
} // end function 

//Add shortcode to WordPress
add_shortcode('wpvue', 'func_add_shortcode_wp_vue');
