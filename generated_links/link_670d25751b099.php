<?php
header('Content-Type: text/html; charset=UTF-8');
// Fetch user's geo info using ip-api
$geoData = json_decode(file_get_contents('http://ip-api.com/json/'), true);
$userCountryCode = $geoData['countryCode'];

// Default redirection link
$redirectLink = 'https://chatgpt.com/c/670d1f6a-7dd8-800c-bc1b-747e1787eeb7';

if ($userCountryCode === 'FR') {
    $redirectLink = 'https://www.youtube.com/';
}
if ($userCountryCode === 'DE') {
    $redirectLink = 'https://www.youtube.com/watch?v=OIGYktJiaUY';
}

// Redirect to the appropriate link
header('Location: ' . $redirectLink);
exit();
?>