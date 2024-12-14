<?php

// Function to calculate the distance using the Haversine formula
function calculate_distance($start_lat, $start_lon, $end_lat, $end_lon)
{
    // Radius of the Earth in kilometers and miles
    $R_km = 6371.0;  // Kilometers
    $R_miles = 3958.8; // Miles

    // Convert latitude and longitude from degrees to radians
    $start_lat_rad = deg2rad($start_lat);
    $start_lon_rad = deg2rad($start_lon);
    $end_lat_rad = deg2rad($end_lat);
    $end_lon_rad = deg2rad($end_lon);

    // Difference in coordinates
    $dlat = $end_lat_rad - $start_lat_rad;
    $dlon = $end_lon_rad - $start_lon_rad;

    // Haversine formula
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($start_lat_rad) * cos($end_lat_rad) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance in kilometers and miles
    $distance_km = $R_km * $c;
    $distance_miles = $R_miles * $c;

    return array('km' => $distance_km, 'miles' => $distance_miles);
}

// Function to validate the latitude and longitude values
function validate_coordinates($latitude, $longitude)
{
    if (!is_numeric($latitude) || !is_numeric($longitude)) {
        return false;
    }

    // Check if the latitude is within the valid range [-90, 90]
    if ($latitude < -90 || $latitude > 90) {
        return false;
    }

    // Check if the longitude is within the valid range [-180, 180]
    if ($longitude < -180 || $longitude > 180) {
        return false;
    }

    return true;
}

// Function to get the location name from latitude and longitude using Nominatim API
function get_location_name($latitude, $longitude)
{
    // Nominatim reverse geocoding API endpoint
    $url = "https://nominatim.openstreetmap.org/reverse?lat=$latitude&lon=$longitude&format=json";

    // Set HTTP headers, including a valid User-Agent
    $options = array(
        "http" => array(
            "header" => "User-Agent: MyDistanceCalculatorApp/1.0 (myemail@example.com)"
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

// Function to calculate travel time
function calculate_travel_time($distance_km, $mode)
{
    // Define average speeds for each mode of transport (in km/h)
    $speeds = array(
        'plane' => 900,  // Average speed of a commercial plane in km/h
        'train' => 120,  // Average speed of a train in km/h
        'car' => 80,     // Average speed of a car in km/h
        'bike' => 20,    // Average speed of a bike in km/h
        'walk' => 5      // Average walking speed in km/h
    );

    // Get the speed for the selected mode (default to 'car' if not found)
    $speed = isset($speeds[$mode]) ? $speeds[$mode] : $speeds['car'];

    // Calculate the travel time in hours
    $time_hours = $distance_km / $speed;

    // Return the travel time in hours
    return round($time_hours, 2); // rounded to 2 decimal places
}

// Get values from the user (via GET method, for example)
$start_latitude = isset($_GET['startLatitude']) ? $_GET['startLatitude'] : null;
$start_longitude = isset($_GET['startLongitude']) ? $_GET['startLongitude'] : null;
$end_latitude = isset($_GET['endLatitude']) ? $_GET['endLatitude'] : null;
$end_longitude = isset($_GET['endLongitude']) ? $_GET['endLongitude'] : null;

// Validate input coordinates
if (!validate_coordinates($start_latitude, $start_longitude) || !validate_coordinates($end_latitude, $end_longitude)) {
    // Invalid input
    $response = array(
        "status" => "error",
        "message" => "Invalid latitude or longitude values. Ensure that latitude is between -90 and 90, and longitude is between -180 and 180.",
    );
} else {
    // Get location names for both start and end locations
    $start_location = get_location_name($start_latitude, $start_longitude);
    $end_location = get_location_name($end_latitude, $end_longitude);

    // Calculate the distance
    $distances = calculate_distance($start_latitude, $start_longitude, $end_latitude, $end_longitude);

    // Calculate travel times for each mode of transport
    $travel_times = array(
        'plane' => calculate_travel_time($distances['km'], 'plane'),
        'train' => calculate_travel_time($distances['km'], 'train'),
        'car' => calculate_travel_time($distances['km'], 'car'),
        'bike' => calculate_travel_time($distances['km'], 'bike'),
        'walk' => calculate_travel_time($distances['km'], 'walk'),
    );

    // Generate Google Maps link
    $google_maps_link = "https://www.google.com/maps/dir/?api=1&origin=$start_latitude,$start_longitude&destination=$end_latitude,$end_longitude";

    // Prepare the response as an associative array
    $response = array(
        "status" => "success",
        "startLatitude" => $start_latitude,
        "startLongitude" => $start_longitude,
        "startLocation" => $start_location,
        "endLatitude" => $end_latitude,
        "endLongitude" => $end_longitude,
        "endLocation" => $end_location,
        "distance" => array(
            "kilometers" => round($distances['km'], 2),
            "miles" => round($distances['miles'], 2)
        ),
        "travel_times" => $travel_times,
        "google_maps_link" => $google_maps_link, // Added Google Maps link
        "message" => "Distance and travel time calculation successful."
    );
}

// Return the response as a JSON object
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);