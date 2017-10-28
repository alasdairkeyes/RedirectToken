<?php

namespace RedirectToken;

use PSR\Http\Message\UriInterface;

class Generator extends AbstractBase
{
    /**
     * @param UriInterface $uri
     * @return string
     */
    public function generateToken(UriInterface $uri)
    {
        return hash($this->hashAlgorithm, $this->secretKey.$uri);
    }
}
