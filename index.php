<?php
// URL to fetch the JSON data from
$url = "http://ip-api.com/json/";

// Get the content from the URL
$response = file_get_contents($url);

// Decode the JSON into a PHP array
$data = json_decode($response, true);
$geo = $data["countryCode"] ; 
// Output the raw JSON response
echo "<pre>";

print_r($data['countryCode']);
echo "</pre>";
?>
