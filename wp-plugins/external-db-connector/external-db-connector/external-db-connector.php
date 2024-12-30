<?php
/**
 * Plugin Name: External DB Connector
 * Description: A plugin to connect to a remote MySQL database and display records using a shortcode.
 * Version: 1.0
 * Author: Salman Ansari
 * Author URI: https://yourwebsite.com
 * License: GPL2
 */

// Include necessary files
include_once(ABSPATH . 'wp-admin/includes/upgrade.php');

// Add settings page to the WordPress Admin
function edc_create_menu() {
    add_menu_page(
        'External DB Connector', // Page Title
        'External DB Connector', // Menu Title
        'manage_options',        // Capability
        'external-db-connector', // Menu Slug
        'edc_settings_page',     // Function to display the settings page
        'dashicons-database',    // Icon
        80                       // Position
    );

    add_action('admin_init', 'edc_register_settings');
}

add_action('admin_menu', 'edc_create_menu');

// Register plugin settings
function edc_register_settings() {
    register_setting('edc_settings_group', 'edc_db_host');
    register_setting('edc_settings_group', 'edc_db_username');
    register_setting('edc_settings_group', 'edc_db_password');
    register_setting('edc_settings_group', 'edc_db_name');
    register_setting('edc_settings_group', 'edc_db_table');
}

// Display the settings page
function edc_settings_page() {
    ?>
    <div class="wrap">
        <h1>External DB Connector Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('edc_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Server Host</th>
                    <td><input type="text" name="edc_db_host" value="<?php echo esc_attr(get_option('edc_db_host')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Username</th>
                    <td><input type="text" name="edc_db_username" value="<?php echo esc_attr(get_option('edc_db_username')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Password</th>
                    <td><input type="password" name="edc_db_password" value="<?php echo esc_attr(get_option('edc_db_password')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Database Name</th>
                    <td><input type="text" name="edc_db_name" value="<?php echo esc_attr(get_option('edc_db_name')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Table Name</th>
                    <td><input type="text" name="edc_db_table" value="<?php echo esc_attr(get_option('edc_db_table')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Shortcode to display data from external database
function edc_display_table($atts) {
    // Get the database connection details from settings
    $db_host = get_option('edc_db_host');
    $db_username = get_option('edc_db_username');
    $db_password = get_option('edc_db_password');
    $db_name = get_option('edc_db_name');
    $db_table = get_option('edc_db_table');

    // Connect to the remote database
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        return 'Connection failed: ' . $conn->connect_error;
    }

    // Fetch data from the specified table
    $sql = "SELECT * FROM $db_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start HTML table
        $output = '<table border="1"><tr>';
        
        // Get the column names
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $output .= "<th>{$field->name}</th>";
        }

        $output .= '</tr>';

        // Fetch rows
        while ($row = $result->fetch_assoc()) {
            $output .= '<tr>';
            foreach ($row as $column) {
                $output .= "<td>{$column}</td>";
            }
            $output .= '</tr>';
        }
        $output .= '</table>';
    } else {
        $output = 'No records found.';
    }

    // Close the database connection
    $conn->close();

    return $output;
}

add_shortcode('edc_db_table', 'edc_display_table');
