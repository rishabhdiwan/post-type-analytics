<?php
// Reports Download functionality
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