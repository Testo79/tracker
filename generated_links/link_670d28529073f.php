<?php
header('Content-Type: text/html; charset=UTF-8');
// Fetch user's geo info using ip-api
$geoData = json_decode(file_get_contents('http://ip-api.com/json/'), true);
$userCountryCode = $geoData['countryCode'];

// Default redirection link
$redirectLink = 'https://www.google.com/';

if ($userCountryCode === 'HR') {
    $redirectLink = 'https://www.youtube.com/';
}
if ($userCountryCode === 'FR') {
    $redirectLink = 'https://chatgpt.com/';
}

// Redirect to the appropriate link
header('Location: ' . $redirectLink);
exit();
?>