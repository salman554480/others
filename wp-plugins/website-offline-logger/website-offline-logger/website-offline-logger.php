<?php
/**
 * Plugin Name: Website Offline Logger
 * Description: Logs when the website goes offline and stores the timestamp in the database, and deletes ongoing downtime records after 1 hour.
 * Version: 1.1
 * Author: Salman Ansari
 * License: GPL2
 */

// Create a table to store the downtime records when the plugin is activated
function wol_create_downtime_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'downtime_logs';
    
    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            downtime_start DATETIME NOT NULL,
            downtime_end DATETIME DEFAULT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'wol_create_downtime_table');

// Log downtime when the website goes offline
function wol_log_downtime() {
    $site_status = wol_check_site_status();

    if (!$site_status) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'downtime_logs';
        
        // Insert downtime record into the table
        $wpdb->insert($table_name, array(
            'downtime_start' => current_time('mysql'),
        ));
    }
}
add_action('wp_footer', 'wol_log_downtime');

// Check if the website is online or not
function wol_check_site_status() {
    $response = wp_remote_get(home_url());

    if (is_wp_error($response)) {
        return false;
    }

    return true;
}

// Store end time of downtime when the site comes back online
function wol_log_uptime() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'downtime_logs';

    // Check if there's an ongoing downtime (check if downtime_end is NULL)
    $downtime_record = $wpdb->get_row("SELECT * FROM $table_name WHERE downtime_end IS NULL ORDER BY downtime_start DESC LIMIT 1");

    if ($downtime_record) {
        // Update downtime_end with the current time when site is back online
        $wpdb->update($table_name, 
            array('downtime_end' => current_time('mysql')),
            array('id' => $downtime_record->id)
        );
    }
}

// Schedule a cron job to check website status every 5 minutes
function wol_schedule_downtime_check() {
    if (!wp_next_scheduled('wol_check_site_status_event')) {
        wp_schedule_event(time(), 'five_minutes', 'wol_check_site_status_event');
    }
}
add_action('wp', 'wol_schedule_downtime_check');

// Custom interval for cron job (every 5 minutes)
function wol_add_custom_cron_interval($schedules) {
    $schedules['five_minutes'] = array(
        'interval' => 5 * 60,  // 5 minutes
        'display'  => 'Every 5 minutes',
    );
    return $schedules;
}
add_filter('cron_schedules', 'wol_add_custom_cron_interval');

// Hook into the scheduled event to check site status
add_action('wol_check_site_status_event', 'wol_log_downtime');

// Deactivate the cron job on plugin deactivation
function wol_deactivate_cron() {
    $timestamp = wp_next_scheduled('wol_check_site_status_event');
    wp_unschedule_event($timestamp, 'wol_check_site_status_event');
}
register_deactivation_hook(__FILE__, 'wol_deactivate_cron');

// Add another cron job to clean up ongoing records every hour
function wol_schedule_cleanup() {
    if (!wp_next_scheduled('wol_cleanup_downtime_event')) {
        wp_schedule_event(time(), 'hourly', 'wol_cleanup_downtime_event');
    }
}
add_action('wp', 'wol_schedule_cleanup');

// Custom interval for hourly cron job
function wol_add_hourly_cron_interval($schedules) {
    $schedules['hourly'] = array(
        'interval' => 60 * 10,  // 10 Min
        'display'  => 'Every 10 Min',
    );
    return $schedules;
}
add_filter('cron_schedules', 'wol_add_hourly_cron_interval');

// Cleanup ongoing downtime records that are older than 1 hour
function wol_cleanup_downtime() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'downtime_logs';

    // Delete records where downtime_end is NULL and the downtime_start is older than 1 hour
    $wpdb->query("
        DELETE FROM $table_name
        WHERE downtime_end IS NULL
        AND downtime_start < NOW() - INTERVAL 1 HOUR
    ");
}
add_action('wol_cleanup_downtime_event', 'wol_cleanup_downtime');

// Add an admin menu to view downtime logs
function wol_admin_menu() {
    add_menu_page(
        'Downtime Logs', 
        'Downtime Logs', 
        'manage_options', 
        'downtime-logs', 
        'wol_downtime_logs_page', 
        'dashicons-clock',
        30
    );
}
add_action('admin_menu', 'wol_admin_menu');

// Display downtime logs on the admin page with pagination
function wol_downtime_logs_page() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'downtime_logs';

    // Define how many records to show per page
    $records_per_page = 10;

    // Get the current page number from the URL query parameter 'paged'
    $paged = isset($_GET['paged']) ? (int)$_GET['paged'] : 1;
    $offset = ($paged - 1) * $records_per_page;

    // Fetch downtime logs from the database with pagination
    $logs = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name ORDER BY downtime_start DESC LIMIT %d OFFSET %d", 
        $records_per_page, $offset
    ));

    // Fetch the total number of records in the downtime logs table
    $total_logs = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    // Calculate total pages
    $total_pages = ceil($total_logs / $records_per_page);

    echo '<h1>Downtime Logs</h1>';
    echo 'This plugin detects downtime based on whether it can access the site via HTTP requests. If the site is down and the request fails, it logs the downtime.';
    echo '<table class="widefat">';
    echo '<thead><tr><th>Start Time</th><th>End Time</th><th>Duration</th></tr></thead>';
    echo '<tbody>';

    foreach ($logs as $log) {
        $duration = $log->downtime_end ? (strtotime($log->downtime_end) - strtotime($log->downtime_start)) / 60 : 'Ongoing';
        echo '<tr>';
        echo '<td>' . esc_html($log->downtime_start) . '</td>';
        echo '<td>' . ($log->downtime_end ? esc_html($log->downtime_end) : 'N/A') . '</td>';
        echo '<td>' . $duration . ' minutes</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    // Pagination controls
    echo '<div class="tablenav bottom">';
    echo '<div class="tablenav-pages">';
    $big = 999999999; // Need an unlikely integer for the pagination URL

    echo paginate_links(array(
        'base' => add_query_arg('paged', '%#%'),
        'format' => '',
        'total' => $total_pages,
        'current' => $paged,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'type' => 'plain',
    ));
    echo '</div>';
    echo '</div>';
}


?>
