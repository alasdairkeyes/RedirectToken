# redirecttoken
PHP Package to generate tokens for validating redirections

## Description

Track clicks to external links on your site by linking to a local file that handles redirection.

From
```
<a href="https://someothersite.com/">Click me</a>
```

```
<a href="/redirect?uri=<remoteurl>&token=<validationtoken>">Click me</a>
```

This package provides the means to generate a validation token so that unscrupulous bots don't use your
redirect as a redirect for nefarious means.


## Installation

* Add the following to your `composer.json` file
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/alasdairkeyes/redirecttoken"
        }
    ],
    "require": {
        "alasdairkeyes/redirecttoken": "dev-master"
    }
}
```

* Run composer install

```
composer.phar install
```

## Example

### Generate Token for URL to redirect

```
    # Or any other Class that implements Psr\Http\Message\UriInterface
use GuzzleHttp\Psr7\Uri;
use RedirectToken\Generator;

$secretKey = 'fgsdkjghsekugkserg';
$redirectUri = new Uri('https://www.google.co.uk/');

$generator = new Generator($secretKey);
$token = $generator->generateToken($redirectUri);

print '<a href="redirect.php?uri=' . urlencode($redirectUri) . '&token=' . $token . '">Valid redirect</a>';
```

### Validate Token

```
    # Or any other Class that implements Psr\Http\Message\UriInterface
use GuzzleHttp\Psr7\Uri;
use RedirectToken\Validator;

// Parse the URI Query
parse_str($_SERVER["QUERY_STRING"], $q);

$redirectUri = new Uri($q['uri']);
$token = $q['token'];

// Instantiate validator
$validator = new Validator($secretKey);

if ($validator->validateUriToken($redirectUri, $token)) {
    header('Location: ' . $redirectUri, true, 302);
} else {
    print "Invalid request";
}

```

### Prebuilt

If you've cloned the repository, you can test with PHP's builtin webserver

```
cd example
php -S localhost:8080
```

Goto `localhost:8080` in a web browser


## Changelog

* 2017-10-29 :: 0.1.0   :: First Release


## Site

https://github.com/alasdairkeyes/redirecttoken


## Author

* Alasdair Keyes - https://akeyes.co.uk/


## License

Released under GPL V3 - See included license file.
