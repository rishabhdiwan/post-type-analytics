<?php
/*
 * Plugin Name: Post Type Analytics
 * Description: Post Type Analytics is WordPress Plugin that enables the users to see and download the details about all the Post Types present in the site.
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