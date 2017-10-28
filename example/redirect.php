<?php

include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/secret.inc.php');

use RedirectToken\Validator;
use GuzzleHttp\Psr7\Uri;

// Parse the URI Query
parse_str($_SERVER["QUERY_STRING"], $q);

$redirectUri = new Uri($q['uri']);
$token = $q['token'];

// Instantiate validator
$validator = new Validator($secretKey);


if ($validator->validateUriToken($redirectUri, $token)) {
    error_log("Valid redirect request received for " . $redirectUri );
    header('Location: ' . $redirectUri, true, 302);
} else {
    error_log("Invalid redirect request received for " . $redirectUri);
    print "Invalid request";
}

