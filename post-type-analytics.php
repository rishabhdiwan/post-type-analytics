<?php
/*
 * Plugin Name: Post Type Analytics
 * Description: Post Type Analytics is a WordPress plugin designed to provide comprehensive insights into all the post types on your website. With this plugin, users can view detailed information such as the number of post types, their labels, and the count of published posts in each type.
 * Version: 1.0
 * Author: Rishabh Diwan
 * Author URI: https://rishabhdiwan.netlify.app
 */
///////////////////////////////
// Exit if accessed directly//
/////////////////////////////
if (!defined('ABSPATH')) {
exit;
}

// Inclusion of all necessary files
require_once plugin_dir_path(__FILE__) . 'includes/report-download.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin.php';