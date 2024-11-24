<?php
// Function to extract YouTube Video ID from URL
function getYouTubeVideoId($url) {
    // Adjusted regular expression for YouTube video ID extraction
    $pattern = '/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|(?:.*?[\?&]v=))([A-Za-z0-9_-]{11}))|(?:https?:\/\/(?:www\.)?youtu\.be\/([A-Za-z0-9_-]{11}))/';
    preg_match($pattern, $url, $matches);

    // Return video ID or false if not found
    return isset($matches[1]) ? $matches[1] : (isset($matches[2]) ? $matches[2] : false);
}

// Function to generate YouTube thumbnail URLs
function getYouTubeThumbnails($videoId) {
    // Thumbnail URLs in different qualities
    return [
        'default' => 'https://img.youtube.com/vi/' . $videoId . '/default.jpg', // low quality
        'hight-quality' => 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg', // high quality
        'medium-quality' => 'https://img.youtube.com/vi/' . $videoId . '/mqdefault.jpg', // medium quality
        'standard-quality' => 'https://img.youtube.com/vi/' . $videoId . '/sddefault.jpg', // standard definition
        'maximum-quality' => 'https://img.youtube.com/vi/' . $videoId . '/maxresdefault.jpg', // maximum resolution
    ];
}

// Get YouTube URL from the query parameter
if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = $_GET['url'];

    // Extract video ID from URL
    $videoId = getYouTubeVideoId($url);

    // Check if a valid video ID was extracted
    if ($videoId) {
        // Get thumbnail URLs
        $thumbnails = getYouTubeThumbnails($videoId);

        // Return response in JSON format
        echo json_encode([
            'status' => 'success',
            'video_id' => $videoId,
            'thumbnails' => $thumbnails
        ]);
    } else {
        // Invalid YouTube URL
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid YouTube video URL'
        ]);
    }
} else {
    // No URL provided
    echo json_encode([
        'status' => 'error',
        'message' => 'No URL provided'
    ]);
}
?>
