<?php

include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/secret.inc.php');

use RedirectToken\Generator;
use GuzzleHttp\Psr7\Uri;

$redirectUri = new Uri('https://www.google.co.uk/');

// Instantiate token generator and create token
$generator = new Generator($secretKey);
$token = $generator->generateToken($redirectUri);

// Output
print '<a href="redirect.php?uri=' . urlencode($redirectUri) . '&token=' . $token . '">Valid redirect</a>' . PHP_EOL;
print "<br/>";
print '<a href="redirect.php?uri=' . urlencode($redirectUri) . '&token=sdfagasdgasdgasdgasdgsdg">Invalid redirect</a>' . PHP_EOL;
