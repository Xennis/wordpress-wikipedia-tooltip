<?php
/*
Plugin Name: Wikipedia Tooltip
Plugin URI: https://github.com/XennisBlog/wikipedia-tooltip
Description: 
Version: 0.0.1
Author: Xennis
Text Domain: wikipedia-tooltip
*/

/**
 * Plugin name
 */
define('WT_NAME', dirname(plugin_basename( __FILE__ )));
/**
 * Plugin directory 
 */
define('WT_DIR', WP_PLUGIN_DIR.'/'.WT_NAME);

/**
 * Admin enqueue scripts and styles.
 */
function wt_enqueue_scripts() {
	wp_enqueue_style(WT_NAME.'-style', plugins_url('/dist/'.WT_NAME.'.min.css', __FILE__));
    wp_enqueue_script(WT_NAME.'-tooltipster', plugins_url('/src/js/bower_components/tooltipster/js/jquery.tooltipster.min.js', __FILE__), array('jquery'));
    wp_enqueue_script(WT_NAME.'-script', plugins_url('/src/js/jQuery.mediaWikiTooltip.js', __FILE__), array('jquery'));
}
add_action('wp_enqueue_scripts', 'wt_enqueue_scripts');

/**
 * Plugin action links
 * 
 * @param array $links
 */
//function wt_plugin_action_links( $links ) {
//   $links[] = '<a href="'.admin_url('admin.php?page=wt-settings').'">Settings</a>';
//   return $links;
//}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wt_plugin_action_links');

/*
 * Include scripts
 */
require_once(WT_DIR.'/'.WT_NAME.'.shortcodes.php');