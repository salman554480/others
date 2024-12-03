<?php
// Database connection parameters
require_once('../db.php');

// Get the filter parameters from the URL or POST data
$age_group = isset($_GET['age_group']) ? $_GET['age_group'] : null;
$platform = isset($_GET['platform']) ? $_GET['platform'] : null;
$developer = isset($_GET['developer']) ? $_GET['developer'] : null;
$publisher = isset($_GET['publisher']) ? $_GET['publisher'] : null;
$release_year = isset($_GET['release_year']) ? $_GET['release_year'] : null;
$genre = isset($_GET['genre']) ? $_GET['genre'] : null;
$multiplayer = isset($_GET['multiplayer']) ? $_GET['multiplayer'] : null;
$game_mode = isset($_GET['game_mode']) ? $_GET['game_mode'] : null;
$page_no = isset($_GET['page_no']) ? (int)$_GET['page_no'] : 1;  // Default to page 1 if not provided

// Set the number of records per page
$records_per_page = 10;

// Calculate the OFFSET for the SQL query
$offset = ($page_no - 1) * $records_per_page;

// Start building the SQL query
$query = "SELECT * FROM video_game_reviews WHERE 1";

// Apply filters based on the passed parameters
if ($age_group) {
    $query .= " AND age_group = '$age_group'";
}
if ($platform) {
    $query .= " AND platform = '$platform'";
}
if ($developer) {
    $query .= " AND developer = '$developer'";
}
if ($publisher) {
    $query .= " AND publisher = '$publisher'";
}
if ($release_year) {
    $query .= " AND release_year = '$release_year'";
}
if ($genre) {
    $query .= " AND genre = '$genre'";
}
if ($multiplayer) {
    $query .= " AND multiplayer = '$multiplayer'";
}
if ($game_mode) {
    $query .= " AND game_mode = '$game_mode'";
}

// Add LIMIT and OFFSET to the query for pagination
$query .= " LIMIT $records_per_page OFFSET $offset";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $games = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch the game title from the `game` table using the game ID
        $game_id = $row['game_id'];  // Assuming game_id is the key
        $game_title_query = "SELECT game_title FROM video_game_reviews WHERE game_id = $game_id";
        $game_title_result = mysqli_query($conn, $game_title_query);
        if ($game_title_result && mysqli_num_rows($game_title_result) > 0) {
            $game_title_row = mysqli_fetch_assoc($game_title_result);
            $game_title = $game_title_row['game_title'];

            // Create the download URL using the game title
            $download_url = "https://torrentgalaxy.to/torrents.php?c10=1&search=" . urlencode($game_title);

            // Add the download URL to the row
            $row['download_url'] = $download_url;
        } else {
            $row['download_url'] = null; // If the game title is not found, set the URL to null
        }

        // Collect the data into an array
        $games[] = $row;
    }

    // Get the total number of records (for pagination info)
    $total_query = "SELECT COUNT(*) AS total FROM video_game_reviews WHERE 1";

    if ($age_group) {
        $total_query .= " AND age_group = '$age_group'";
    }
    if ($platform) {
        $total_query .= " AND platform = '$platform'";
    }
    if ($developer) {
        $total_query .= " AND developer = '$developer'";
    }
    if ($developer) {
        $total_query .= " AND publisher = '$publisher'";
    }
    if ($release_year) {
        $total_query .= " AND release_year = '$release_year'";
    }
    if ($genre) {
        $total_query .= " AND genre = '$genre'";
    }
    if ($multiplayer) {
        $total_query .= " AND multiplayer = '$multiplayer'";
    }
    if ($game_mode) {
        $total_query .= " AND game_mode = '$game_mode'";
    }

    // Execute the total records query
    $total_result = mysqli_query($conn, $total_query);

    // Check if the query was successful
    if ($total_result) {
        $total_row = mysqli_fetch_assoc($total_result);
        $total_records = $total_row['total'];

        // Calculate total number of pages
        $total_pages = ceil($total_records / $records_per_page);

        // Send the response with pagination info
        $pagination_info = [
            "total_records" => $total_records,
            "total_pages" => $total_pages,
            "current_page" => $page_no
        ];

        // Combine the game data and pagination info in the response
        $response = [
            "pagination" => $pagination_info,
            "games" => $games
        ];

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    } else {
        // If there was an error with the total query
        echo json_encode(["error" => "Unable to fetch total records from the database."]);
    }
} else {
    // If there was an error in the query, send an error response
    echo json_encode(["error" => "Unable to fetch data from the database."]);
}

// Close the database connection
mysqli_close($conn);
