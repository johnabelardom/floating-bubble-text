<?php
   /*
   Plugin Name: Floating Bubble Text
   Description: Floating bubble text anywhere using shortcode
   Version: 1.0.6
   License: GPL2
   */



/**
 * The main class that handles the entire output, content filters, etc., for this plugin.
 *
 * @package Floating Bubble Text
 * @since 1.0
 */
class Floating_Bubble_Text {

	private $fbt_screen_name;
	private static $instance;

	/** Constructor */
	function __construct() {

		register_activation_hook( __FILE__, array( $this, 'activation_hook' ) );
		add_action('admin_menu', array($this, 'add_plugin_menu'));	
		add_shortcode('fbt', array($this, 'floating_bubble_shortcode'));
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_links_scripts' ) );
	}

	function activation_hook() {
	    global $wpdb;
	    $table_name = $wpdb->prefix . "floating_bubble_text";
	    $charset_collate = $wpdb->get_charset_collate();
	    $sql = "CREATE TABLE $table_name (
	            id int(11) NOT NULL AUTO_INCREMENT,
	            `name` varchar(50) CHARACTER SET utf8 NOT NULL,
	            `picture_link` varchar(1000) CHARACTER SET utf8 NOT NULL,
	            PRIMARY KEY (`id`)
	          ) $charset_collate; ";

	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	    dbDelta($sql);
	}

	function wp_enqueue_links_scripts() {
		wp_enqueue_style( 'floating-bubble-text-styling', plugins_url( '/assets/style.css', __FILE__  ) );
		wp_enqueue_script( 'floating-bubble-text-script', plugins_url('/assets/floating-bubble-text-script.js', __FILE__ ), array(), '1.0.0', true );
	}

	public function add_plugin_menu() {
 		add_menu_page('Floating Bubble Text', 'Floating Bubble Text', 'manage_options', 'floating-bubble-main', array($this, 'render_fbt_main_page'), 'dashicons-format-status');
 		add_submenu_page(
 			'floating-bubble-main', //parent slug
			'Add New Bubble', //page title
			'Add New', //menu title
			'manage_options', //capability
			'floating-bubble-create', //menu slug
			array($this, 'fbt_create') //function
		); 
 		add_submenu_page(
 			null, //parent slug
			'Update Bubble', //page title
			'Update', //menu title
			'manage_options', //capability
			'floating-bubble-update', //menu slug
			array($this, 'fbt_update') //function
		); 
	}

	public function render_fbt_main_page(){
		// echo "asduywhgaghsdyugwua";
		include( plugin_dir_path( __FILE__ ) . 'pages/main-menu.php');
	}


	// Additional Pages functions
	function fbt_create() {
		include( plugin_dir_path( __FILE__ ) . 'pages/add-new-menu.php');
	}

	function fbt_update() {
		include( plugin_dir_path( __FILE__ ) . 'pages/update-menu.php');
	}
	
	// Function to add subscribe text to posts and pages
	function floating_bubble_shortcode( $atts ) {
	    extract( shortcode_atts( array(
	        'fbt_id' => 'No ID provided',
	        'limit' => '3',
	        'category' => '',
	        'post_type' => 'post',
	        'seconds' => '3000',
	        'bubble_position' => 'top',
	        'bubble_color' => '#ddd',
	        'picture_align' => 'center'
	    ), $atts, 'fbt' ) );
	    // exit($bubble_position);
	    // begin output buffering
	    ob_start();

	    $fbt_vars = $fbt_id != '' ? $this->get_record_by_id( $fbt_id ) : null;
	    $fbt_content = $this->get_latest_posts( $limit, $category, $post_type );


		include( plugin_dir_path( __FILE__ ) . 'floating/floating-bubble.php');

		// end output buffering, grab the buffer contents, and empty the buffer
    	return ob_get_clean();
	}

	function get_record_by_id( $id ) {
	    global $wpdb;
	    $table_name = $wpdb->prefix . "floating_bubble_text";
	    $rows = $wpdb->get_results("SELECT id, name, picture_link FROM $table_name WHERE id = $id");
	    return $rows;
	}

	function get_latest_posts( $limit = 5, $category = '', $post_type = "post") {
	    global $wpdb;

	    if ( $post_type != 'post' && ! post_type_exists( $post_type ) ) {
	    	echo "Post type '$post_type' doesn't exists.";
	    	return;
	    }

	    if ( $category != '' && ! term_exists($category, 'category') ) {
	    	echo "Category '$category' doesn't exists.";
	    	return;
	    }

		$query = "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_type = '$post_type' AND $wpdb->posts.post_status = 'publish' ORDER BY $wpdb->posts.ID DESC LIMIT $limit";
		$pageposts = $wpdb->get_results($query);
	    if ( $category != "" ) {
			$pageposts = new WP_Query( array( 'category_name' => $category, 'posts_per_page' => $limit, 'post_status' => 'publish' ) );
			$pageposts = $pageposts->posts;
	    }
		return $pageposts;
	}


}
	
	

$Floating_Bubble_Text = new Floating_Bubble_Text;


