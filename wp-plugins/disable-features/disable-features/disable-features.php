<?php
/**
 * Plugin Name: Disable Features
 * Description: A plugin to disable right-click, text selection, dragging, and developer tools on the site.
 * Version: 1.0
 * Author: Salman Ansari
 * Author URI: https://yourwebsite.com
 * License: GPL2
 */

// Hook to enqueue the JavaScript
function disable_features_enqueue_script() {
    // Add the custom JavaScript file
    wp_register_script('disable-features-js', '', [], '', true);
    wp_enqueue_script('disable-features-js');
    
    // Add the JavaScript code directly to the footer
    $script = "
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault(); // Disable right-click context menu
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault(); // Prevent text selection
        });

        document.addEventListener('dragstart', function(e) {
            e.preventDefault(); // Disable image dragging
        });

        document.addEventListener('keydown', function(e) {
            if (e.keyCode === 123 || (e.ctrlKey && e.shiftKey && e.keyCode === 73)) {
                e.preventDefault(); // Disable F12 and Ctrl+Shift+I (DevTools shortcut)
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault(); // Disable printing
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
                e.preventDefault(); // Disable view source
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 123)) {
                e.preventDefault();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'I' && e.ctrlKey && e.shiftKey) {
                e.preventDefault(); // Disable DevTools inspect element shortcut
            }
        });
    ";
    wp_add_inline_script('disable-features-js', $script);
}

add_action('wp_enqueue_scripts', 'disable_features_enqueue_script');
