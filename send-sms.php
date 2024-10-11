<?php
/**
 * Aquila Features Plugin
 *
 * @package send-sms
 * @author  Raquibul Islam
 *
 * @wordpress-plugin
 * Plugin Name:       Send-sms
 * Plugin URI:        
 * Description:       Sends Sms notification to .
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raquibul Islam
 * Author URI:        
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       Send-SMS
 * Domain Path:       /languages
 */
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Send Sms', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Send Sms', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Send SMS', 'text_domain' ),
		'name_admin_bar'        => __( 'Send SMS', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Send New Notification', 'text_domain' ),
		'add_new'               => __( 'New Notification', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Send Sms', 'text_domain' ),
		'description'           => __( 'Send sms notification', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'send_sms' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
    'menu_icon'             => 'dashicons-testimonial'
    
	);
	register_post_type( 'send_sms', $args );

}
add_action( 'init', 'custom_post_type', 0 );


function wpsx_5688_update_post($post_id, $post) {

  // Make sure the post obj is present and complete. If not, bail.
  if(!is_object($post) || !isset($post->post_type)) {
      return;
  }

  print_r($post);

  $defendant = get_post_meta ( $post_id, 'defendant', true );  
  $date = get_post_meta ( $post_id, 'date', true );  
  $time = get_post_meta ( $post_id, 'time', true );  

  $text = $post->post_title.'  '.$date.' '.$time;
  
  if(get_post_meta ( $post_id, 'opponent', true ))
    $opponent = get_post_meta ( $post_id, 'opponent', true );  

    echo $text.'<br>';
    echo $defendant.'<br>';
    echo $opponent.'<br>';
  //wp_die();

  switch($post->post_type) { // Do different things based on the post type

      case "send_sms":
          // Do your episode gallery stuff
          //file_get_contents("http://66.45.237.70/api.php?username=01717286369&password=286369sms&number=01717286369&message=hi");
          $url = "http://XXXX/api.php?username=XXXX&password=XXXX&number=$defendant&message=".urlencode($text);
          echo $url;
          $smsresult = file_get_contents($url);
          echo $smsresult;
          break;
      default:
          // Do other stuff

  }
 
}
add_action('publish_send_sms', 'wpsx_5688_update_post', 1, 2);
//add_action('update_post', 'wpsx_5688_update_post', 1, 2);