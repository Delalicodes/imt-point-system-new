<?php

$url = 'https://yourdomain.com/automate-reset';

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);

// Execute the request
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Output the response
echo $response;
