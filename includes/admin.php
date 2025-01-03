<?php
// Function to add menu
function post_type_analytics_add_admin_menu() {
  add_menu_page(
      'Post Type Analytics',                  // Page title
      'Post Type Analytics',                 // Menu title
      'manage_options',                     //Capability
      'post-type-analytics',               // Menu slug
      'pta_settings_page',                // Callback function 
      'dashicons-admin-tools',           // Icon (optional)
    //   20                             // Position (optional)
  );
}

function pta_settings_page() {
    echo '<h1>Post Type Analytics</h1>';

    // Get all registered post types
    $post_types = get_post_types([], 'objects');
    
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Post Type</th><th>Label</th><th>Count</th></tr>';

    foreach ($post_types as $post_type => $key) {
        $count = wp_count_posts($post_type);
        $published_count = isset($count->publish) ? $count->publish : 0;

        echo '<tr>';
        echo '<td>' . esc_html($post_type) . '</td>';
        echo '<td>' . esc_html($key->label) . '</td>';
        echo '<td>' . esc_html($published_count) . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    echo '<form method="post" action="">';
    echo '<input type="hidden" name="pta_download_report" value="1">';
    echo '<button type="submit" class="button button-primary">Download Report</button>';
    echo '</form>';

}
// Hook the function to the admin_menu action
add_action('admin_menu', 'post_type_analytics_add_admin_menu');