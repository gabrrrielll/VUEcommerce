<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/gabrrrielll
 * @since      1.0.0
 *
 * @package    Vuecommerce
 * @subpackage Vuecommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vuecommerce
 * @subpackage Vuecommerce/admin
 * @author     Sandu Gabriel <gabrrrielll@gmail.com>
 */
class Vuecommerce_Admin
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
		 * defined in Vuecommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vuecommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/vuecommerce-admin.css', array(), $this->version, 'all');
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
		 * defined in Vuecommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vuecommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/vuecommerce-admin.js', array('jquery'), $this->version, false);
	}



	/*-------------------------------------------------------------------------------*/
	function wpvuecommerce_register_settings()

	{
		$args = array( // Validate and sanitize the meta value.
			// Note: currently (4.7) one of 'string', 'boolean', 'integer',
			// 'number' must be used as 'type'. The default is 'string'.
			'type'         => 'string',
			// Shown in the schema for the meta key.
			'description'  => 'A meta key associated with a string meta value.',
			// Return a single value of the type.
			'single'       => true,
			// Show in the WP REST API response. Default: false.
			'show_in_rest' => true,
		);

		add_option('wpvuecommerce_option_column_number', 'Number.');
		add_option('wpvuecommerce_option_button_color', 'Color.');

		register_setting('wpvuecommerce_options_group2', 'wpvuecommerce_option_column_number',  'wpvuecommerce_callback', $args);
		register_setting('wpvuecommerce_options_group2', 'wpvuecommerce_option_button_color', 'wpvuecommerce_callback', $args);
	}
	// add_action( 'admin_init', 'wpvuecommerce_register_settings' );


	public	function wp_vue_admin_menu_options()
	{
		add_menu_page('VUE Commerce', 'VUE Commerce ', 'manage_options', 'vue-commerce-admin-menu', 'admin_menu_options_display', 'dashicons-products', 56);

		function admin_menu_options_display()
		{
			?>
			<div class="wrap">
				<h2>Options </h2>


				<form method="post" action="options.php">
					<?php settings_fields('wpvuecommerce_options_group2'); ?>

					<table>
						<tr valign="top">
							<th scope="row"><label for="wpvuecommerce_option_column_number">Number of columns</label></th>
							<td><input type="text" id="wpvuecommerce_option_column_number" name="wpvuecommerce_option_column_number" value="<?php echo get_option('wpvuecommerce_option_column_number'); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="wpvuecommerce_option_button_color">Add to cart button color</label></th>
							<td><input type="text" id="wpvuecommerce_option_button_color" name="wpvuecommerce_option_button_color" value="<?php echo get_option('wpvuecommerce_option_button_color'); ?>" /></td>
						</tr>
					</table>
					<?php submit_button(); ?>
				</form>
			</div>

		<?php
				}
			}

			public function wp_vue_create_vue_product()
			{
				$name = 'vueproduct';


				$labels = array(
					'name' => __('Products'),
					'singular_name' => __('Product'),
					'add_new' => __('Add new product'),
					'add_new_item' => __('Add new product'),
					'edit_item' => __('Edit product'),
					'search_items' => __('Search Products'),
					'featured_image'        => __('Featured Image'),
					'set_featured_image'    => __('Set featured image'),
					'remove_featured_image' => __('Remove featured image'),
					'use_featured_image'    => __('Use as featured image'),
					'insert_into_item'      => __('Insert into item', 'vuecommerce'),
					'uploaded_to_this_item' => __('Uploaded to this item'),
					'items_list'            => __('Items list', 'vuecommerce'),
					'items_list_navigation' => __('Items list navigation'),
					'filter_items_list'     => __('Filter items list'),
				);


				$args =  array(
					// 'label'                 => __( 'Product', 'vuecommerce' ),
					//	'description'           => __( 'Post Type Description', 'vuecommerce' ),
					'labels'                => $labels,
					'supports'              => array('title', 'editor', 'thumbnail', 'trackbacks', 'revisions'),
					//	'taxonomies'            => array( 'product_category', 'product_tag' ),
					'hierarchical'          => false,
					'public'                => true,
					'show_ui'               => true,
					'show_in_menu'          => true,
					'menu_position'         => 57,
					'menu_icon'             => 'dashicons-feedback',
					'show_in_admin_bar'     => true,
					'show_in_nav_menus'     => true,
					'can_export'            => true,
					//	'has_archive'           => 'vueproducts',
					'exclude_from_search'   => false,
					'show_in_rest'          => true,

				);


				register_post_type($name, $args);
			}


			// Add metaboxes to product
			public function register_vue_box()
			{

				function price_display()
				{
					global $post;
					$lastprice = get_post_meta($post->ID, 'lastprice', true);
					$price = get_post_meta($post->ID, 'price', true);
					?>

			<label>Last price</label>
			<input type="number" name="lastprice" value="<?php print $lastprice; ?>" /> <br />
			<label>Actual price</label>
			<input type="number" name="price" value="<?php print $price; ?>" />

<?php
		}
		add_meta_box('price', 'Price', 'price_display', 'vueproduct', 'normal');
	}






	//save metaboxes
	public function save_metaboxes($post_id)
	{
		$is_autosave = wp_is_post_autosave($post_id);
		$is_revision = wp_is_post_revision($post_id);

		if ($is_autosave || $is_revision) {
			return;
		};

		$post = get_post($post_id);
		if ($post->post_type == "vueproduct") {
			if (array_key_exists('lastprice', $_POST)) {
				update_post_meta($post_id, 'lastprice', $_POST['lastprice']);
			}
			if (array_key_exists('price', $_POST)) {
				update_post_meta($post_id, 'price', $_POST['price']);
			}
		}
	}



	/**
	 * Create two taxonomies, Product_Categories and Product_Tags for the post type "book".
	 *
	 * @see register_post_type() for registering custom post types.
	 */
	function vue_products_create_taxonomies()
	{
		// Add new taxonomy, make it hierarchical (like Product_categories)
		$labels = array(
			'name'              => __('Products Categories', 'taxonomy general name', 'textdomain'),
			'singular_name'     => __('Product Category', 'taxonomy singular name', 'textdomain'),
			'search_items'      => __('Search Product Categories', 'textdomain'),
			'all_items'         => __('All Products Categories', 'textdomain'),
			'parent_item'       => __('Parent Product Category', 'textdomain'),
			'parent_item_colon' => __('Parent Product Category:', 'textdomain'),
			'edit_item'         => __('Edit Product Category', 'textdomain'),
			'update_item'       => __('Update Product Category', 'textdomain'),
			'add_new_item'      => __('Add New Product Category', 'textdomain'),
			'new_item_name'     => __('New Product Category Name', 'textdomain'),
			'menu_name'         => __('Product Category', 'textdomain'),

		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'product_category'),
			'show_in_rest' => true,
		);

		register_taxonomy('vue_product_category', array('vueproduct'), $args);

		unset($args);
		unset($labels);

		// Add new taxonomy, NOT hierarchical (like Product_tags)
		$labels = array(
			'name'                       => __('Product Tags', 'taxonomy general name', 'textdomain'),
			'singular_name'              => __('Product Tag', 'taxonomy singular name', 'textdomain'),
			'search_items'               => __('Search Product Tags', 'textdomain'),
			'popular_items'              => __('Popular Products Tags', 'textdomain'),
			'all_items'                  => __('All Products Tags', 'textdomain'),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __('Edit Product Tag', 'textdomain'),
			'update_item'                => __('Update Product Tag', 'textdomain'),
			'add_new_item'               => __('Add New Product Tag', 'textdomain'),
			'new_item_name'              => __('New Product Tag Name', 'textdomain'),
			'separate_items_with_commas' => __('Separate Products Tags with commas', 'textdomain'),
			'add_or_remove_items'        => __('Add or remove Products Tags', 'textdomain'),
			'choose_from_most_used'      => __('Choose from the most used Products Tags', 'textdomain'),
			'not_found'                  => __('No Products Tags found.', 'textdomain'),
			'menu_name'                  => __('Products Tags', 'textdomain'),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array('slug' => 'product_tag'),
			'show_in_rest' => true,
		);

		register_taxonomy('vue_product_tag', 'vueproduct', $args);
	}
}
