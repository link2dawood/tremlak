<?php
// Define the URL with the query parameter for street lookup
$url = "http://api.geonames.org/streetNameLookupJSON?q=Museum&username=adinaavram";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);            // Set the URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute cURL request and get the response
$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo "Error: " . $e;
} else {
    $decoded = json_decode($resp, true);  

    if (isset($decoded['address']) && count($decoded['address']) > 0) {
        $address = $decoded['address'][0];
        $countryCode = $address['countryCode'] ?? 'No data';
        $adminName1 = $address['adminName1'] ?? 'No data';
        $locality = $address['locality'] ?? 'No data';
        $postalcode = $address['postalcode'] ?? 'No data';
        $street = $address['street'] ?? 'No data';

        // Output the values
        echo "Country Code: $countryCode<br>";
        echo "Admin Name 1: $adminName1<br>";
        echo "Locality: $locality<br>";
        echo "Postal Code: $postalcode<br>";
        echo "Street: $street<br>";
    } else {
        echo 'Address data not found.<br>';
    }
}
curl_close($ch);
?>
