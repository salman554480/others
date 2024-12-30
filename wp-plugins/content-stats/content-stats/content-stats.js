jQuery(document).ready(function($) {
    console.log("JavaScript Loaded Successfully!");

    // Function to update content stats
    function updateStats(content) {
        console.log("Updating Stats for content...");
        $.ajax({
            url: contentStats.ajax_url,
            type: 'POST',
            data: {
                action: 'calculate_content_stats',
                content: content
            },
            success: function(response) {
                console.log("AJAX Response: ", response);
                var stats = JSON.parse(response);
                
                // Update the stats on the page
                $('#word-count').text(stats.word_count);
                $('#sentence-count').text(stats.sentence_count);
                $('#char-count').text(stats.char_count);
                $('#paragraph-count').text(stats.paragraph_count);
                $('#avg-word-length').text(stats.average_word_length);
                $('#avg-sentence-length').text(stats.average_sentence_length);
                $('#unique-words').text(stats.unique_words);
                $('#reading-time').text(stats.reading_time);
                $('#speaking-time').text(stats.speaking_time);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: ", status, error);
            }
        });
    }

    // Classic Editor (textarea-based editor)
    if ($('#content').length) {
        // Bind the function to keyup events in the classic editor content area
        $('#content').on('keyup input', function() {
            var content = $(this).val();
            updateStats(content);
        });

        // Initial update
        var initialContent = $('#content').val();
        updateStats(initialContent);
    }

    // Gutenberg (Block Editor) content changes
    if (typeof wp !== 'undefined' && wp.blocks) {
        const { select } = wp.data;

        // Detect content change in Gutenberg Editor
        let previousContent = select('core/editor').getEditedPostContent();

        setInterval(function() {
            const currentContent = select('core/editor').getEditedPostContent();

            // Only update stats if the content has changed
            if (currentContent !== previousContent) {
                previousContent = currentContent;
                updateStats(currentContent);
            }
        }, 1000); // Update stats every second to check for content changes
    }
});
