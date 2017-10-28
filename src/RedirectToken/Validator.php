<?php

namespace RedirectToken;

use PSR\Http\Message\UriInterface;

class Validator extends AbstractBase
{
    /**
     * @param UriInterface $uri
     * @param string $token
     * @return bool
     */
    public function validateUriToken(UriInterface $uri, $token = '') {
        if (hash($this->hashAlgorithm, $this->secretKey.$uri) == $token) {
            return true;
        }
        return false;
    }
}