<?php
// Define the URL with the ICAO code for the airport and username
$icao = 'LSZH';  // ICAO code for Zurich-Kloten Airport
$url = "http://api.geonames.org/weatherIcaoJSON?formatted=true&ICAO=$icao&username=adinaavram";

// Initialize cURL session
$ch = curl_init();

// Set cURL options for the GET request
curl_setopt($ch, CURLOPT_URL, $url);            // Set the URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute cURL request and get the response
$resp = curl_exec($ch);

// Check for errors in the cURL request
if ($e = curl_error($ch)) {
    echo "Error: " . $e;  // If there's an error, display it
} else {
    // Decode the JSON response into an associative array
    $decoded = json_decode($resp, true);

    // Check if the 'weatherObservation' key exists in the response
    if (isset($decoded['weatherObservation'])) {
        $weatherObservation = $decoded['weatherObservation']; // Access the weather data

        // Access the required fields
        $stationName = isset($weatherObservation['stationName']) ? $weatherObservation['stationName'] : 'No data';
        $countryCode = isset($weatherObservation['countryCode']) ? $weatherObservation['countryCode'] : 'No data';
        $temperature = isset($weatherObservation['temperature']) ? $weatherObservation['temperature'] : 'No data';
        $humidity = isset($weatherObservation['humidity']) ? $weatherObservation['humidity'] : 'No data';
        $windSpeed = isset($weatherObservation['windSpeed']) ? $weatherObservation['windSpeed'] : 'No data';
        $clouds = isset($weatherObservation['clouds']) ? $weatherObservation['clouds'] : 'No data';

        // Output the values
        echo "Station Name: " . $stationName . "<br>";
        echo "Country Code: " . $countryCode . "<br>";
        echo "Temperature: " . $temperature . "°C<br>";
        echo "Humidity: " . $humidity . "%<br>";
        echo "Wind Speed: " . $windSpeed . " KT<br>";
        echo "Clouds: " . $clouds . "<br>";
    } else {
        echo 'Weather observation data not found.<br>';
    }
}

// Close cURL session
curl_close($ch);
?>
