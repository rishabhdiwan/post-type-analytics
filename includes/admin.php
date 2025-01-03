<?php
// Function to add menu
function post_type_analytics_add_admin_menu() {
  add_menu_page(
      'Post Type Analytics',                     // Page title
      'Post Type Analytics',                    // Menu title
      'manage_options',                      // Capability
      'post-type-analytics',                  // Menu slug
      'post_type_analytics_settings_page',   // Callback function
      'dashicons-admin-tools',            // Icon (optional)
    //   20                              // Position (optional)
  );
}

function post_type_analytics_settings_page() {
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

function pta_handle_report_download() {
    // Check if the report download request is submitted
    if (isset($_POST['pta_download_report'])) {
        // Get the current date and time
        $current_datetime = current_time('mysql'); // Uses WordPress timezone
        $formatted_datetime = current_time('Y-m-d_H-i-s'); // For file name
        
        // Gather data
        $post_types = get_post_types([], 'objects');

        // Build CSV content
        $csv_data = "Report Generated On,{$current_datetime}\n\n"; // Add date and time at the top

        foreach ($post_types as $post_type => $object) {
            $count = wp_count_posts($post_type);
            $published_count = isset($count->publish) ? $count->publish : 0;
            $csv_data .= "{$object->label} ({$post_type}),{$published_count}\n";
        }

        // Set file name with date and time
        $file_name = "analytics_report_{$formatted_datetime}.csv";

        // Download CSV file
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename=\"{$file_name}\"");
        echo $csv_data;
        exit;
    }
}
// Handle report download
add_action('admin_init', 'pta_handle_report_download');