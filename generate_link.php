<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mainLink = $_POST['main-link'];  // Main link entered by the user
    $geoLinks = json_decode($_POST['geo-links'], true);  // GEO-specific links as JSON

    // Generate a unique filename for the new PHP file
    $uniqueId = uniqid();  // Generates a unique ID
    $filename = "generated_links/link_$uniqueId.php";

    // Create PHP content for redirection logic
    $phpContent = "<?php\n";
    $phpContent .= "header('Content-Type: text/html; charset=UTF-8');\n";
    $phpContent .= "// Fetch user's geo info using ip-api\n";
    $phpContent .= "\$geoData = json_decode(file_get_contents('http://ip-api.com/json/'), true);\n";
    $phpContent .= "\$userCountryCode = \$geoData['countryCode'];\n\n";

    // Set default to main link
    $phpContent .= "// Default redirection link\n";
    $phpContent .= "\$redirectLink = '$mainLink';\n\n";

    // GEO-specific redirection logic (only if provided)
    foreach ($geoLinks as $geoLink) {
        $geo = $geoLink['geo'];
        $link = $geoLink['link'];

        $phpContent .= "if (\$userCountryCode === '$geo') {\n";
        $phpContent .= "    \$redirectLink = '$link';\n";
        $phpContent .= "}\n";
    }

    // Final redirection to the selected link
    $phpContent .= "\n// Redirect to the appropriate link\n";
    $phpContent .= "header('Location: ' . \$redirectLink);\n";
    $phpContent .= "exit();\n";
    $phpContent .= "?>";

    // Write the generated content to the new PHP file
    file_put_contents($filename, $phpContent);

    // Output the generated link to the user (admin)
    $generatedLink = "http://127.0.0.1/tracker/$filename";
    echo "Generated Link: <a href='$generatedLink'>$generatedLink</a>";
}
