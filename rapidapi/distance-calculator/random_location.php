<?php

// Function to get the location name from latitude and longitude using Nominatim API
function get_location_name($latitude, $longitude)
{
    // Nominatim reverse geocoding API endpoint
    $url = "https://nominatim.openstreetmap.org/reverse?lat=$latitude&lon=$longitude&format=json";

    // Set HTTP headers, including a valid User-Agent
    $options = array(
        "http" => array(
            "header" => "User-Agent: MyRandomLocationApp/1.0 (myemail@example.com)"
        )
    );
    $context = stream_context_create($options);

    // Perform the API request with the custom context
    $response = file_get_contents($url, false, $context);

    // Check for errors in the response
    if ($response === FALSE) {
        return "Location not found";
    }

    // Decode the JSON response
    $data = json_decode($response, true);

    // Return the address if available
    if (isset($data['address'])) {
        return $data['address']['road'] ?? 'Unknown location';
    } else {
        return 'Location not found';
    }
}

// Function to generate a random latitude and longitude within valid ranges
function generate_random_coordinates()
{
    $latitude = rand(-90000000, 90000000) / 1000000; // Latitude range [-90, 90]
    $longitude = rand(-180000000, 180000000) / 1000000; // Longitude range [-180, 180]

    return array('latitude' => $latitude, 'longitude' => $longitude);
}

// Generate two random locations
$location1 = generate_random_coordinates();
$location2 = generate_random_coordinates();

// Get location names for both random locations
$location1_name = get_location_name($location1['latitude'], $location1['longitude']);
$location2_name = get_location_name($location2['latitude'], $location2['longitude']);

// Prepare the response as an associative array
$response = array(
    "status" => "success",
    "location1" => array(
        "latitude" => $location1['latitude'],
        "longitude" => $location1['longitude'],
        "location_name" => $location1_name
    ),
    "location2" => array(
        "latitude" => $location2['latitude'],
        "longitude" => $location2['longitude'],
        "location_name" => $location2_name
    ),
    "message" => "Random locations generated successfully."
);

// Return the response as a JSON object
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);