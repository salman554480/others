<?php
/**
 * Plugin Name: Content Stats for Posts and Pages
 * Description: Displays content statistics (Word Count, Sentence Count, etc.) for posts and pages in the post editor and updates in real-time.
 * Version: 1.2
 * Author: Your Name
 * License: GPL2
 */

// Hook to add a metabox in the post editor
add_action('add_meta_boxes', 'add_content_stats_metabox');

// Function to create the custom metabox
function add_content_stats_metabox() {
    add_meta_box(
        'content_stats',           // Metabox ID
        'Content Stats',           // Metabox Title
        'display_content_stats_metabox', // Callback function to display content inside the metabox
        'post',                    // Post type (you can add 'page' here if you want it for pages as well)
        'side',                    // Context (position of the metabox in the admin panel)
        'default'                  // Priority
    );
}

// Function to display the content statistics inside the metabox
function display_content_stats_metabox($post) {
    ?>
    <div id="content-stats">
        <ul>
            <li><strong>Word Count:</strong> <span id="word-count">0</span></li>
            <li><strong>Sentence Count:</strong> <span id="sentence-count">0</span></li>
            <li><strong>Character Count:</strong> <span id="char-count">0</span></li>
            <li><strong>Paragraph Count:</strong> <span id="paragraph-count">0</span></li>
            <li><strong>Average Word Length:</strong> <span id="avg-word-length">0</span></li>
            <li><strong>Average Sentence Length:</strong> <span id="avg-sentence-length">0</span></li>
            <li><strong>Unique Words:</strong> <span id="unique-words">0</span></li>
            <li><strong>Reading Time:</strong> <span id="reading-time">0</span> minute(s)</li>
            <li><strong>Speaking Time:</strong> <span id="speaking-time">0</span> minute(s)</li>
        </ul>
    </div>
    <?php
}

// Enqueue the necessary JavaScript and AJAX script for real-time stats
add_action('admin_enqueue_scripts', 'enqueue_content_stats_script');

function enqueue_content_stats_script($hook) {
    // Only load the script on the post editor screen
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }
    
    // Enqueue the JavaScript file for content stats
    wp_enqueue_script('content-stats-js', plugin_dir_url(__FILE__) . 'content-stats.js', array('jquery'), null, true);

    // Localize the script to make the AJAX URL available to JavaScript
    wp_localize_script('content-stats-js', 'contentStats', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

// AJAX handler to calculate content stats
add_action('wp_ajax_calculate_content_stats', 'calculate_content_stats');

function calculate_content_stats() {
    // Check for required data (content from the editor)
    if (isset($_POST['content'])) {
        $text = sanitize_text_field($_POST['content']);
        $stats = get_content_stats($text);

        // Return stats as a JSON response
        echo json_encode($stats);
    }
    wp_die(); // End the AJAX request
}

// Function to calculate the content stats
function get_content_stats($text) {
    // Strip HTML tags
    $text = strip_tags($text);

    // Calculate stats
    $word_count = str_word_count($text);
    $sentence_count = substr_count($text, '.') + substr_count($text, '!');
    $char_count = strlen($text);
    $paragraph_count = substr_count($text, "\n");
    $average_word_length = $word_count > 0 ? $char_count / $word_count : 0;
    $average_sentence_length = $sentence_count > 0 ? $word_count / $sentence_count : 0;
    $unique_words = count(array_unique(str_word_count(strtolower($text), 1)));
    $reading_time = ceil($word_count / 200); // Average reading speed of 200 words per minute
    $speaking_time = ceil($word_count / 130); // Average speaking speed of 130 words per minute

    // Return all stats as an array
    return array(
        'word_count' => $word_count,
        'sentence_count' => $sentence_count,
        'char_count' => $char_count,
        'paragraph_count' => $paragraph_count,
        'average_word_length' => number_format($average_word_length, 2),
        'average_sentence_length' => number_format($average_sentence_length, 2),
        'unique_words' => $unique_words,
        'reading_time' => $reading_time,
        'speaking_time' => $speaking_time
    );
}
