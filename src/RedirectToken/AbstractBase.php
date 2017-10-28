<?php

namespace RedirectToken;

use RedirectToken\Exception\InvalidHashAlgorithmException;
use RedirectToken\Exception\InvalidSecretKeyException;

abstract class AbstractBase
{
    /**
     * @const int
     */
    const SECRET_KEY_MINIMUM_LENGTH = 10;

    /**
     * @const string
     */
    const DEFAULT_HASH_ALGORITHM = 'sha256';

    /**
     * @var string Secret Key for hashing
     */
    protected $secretKey;

    /**
     * @var string Has Algorithm
     */
    protected $hashAlgorithm;

    /**
     * Generator constructor.
     * @param string $secretKey
     * @param string $hashAlgorithm
     * @throws InvalidSecretKeyException
     * @throws InvalidHashAlgorithmException
     */
    public function __construct($secretKey = '', $hashAlgorithm = self::DEFAULT_HASH_ALGORITHM)
    {
        if (!$secretKey || strlen($secretKey) < self::SECRET_KEY_MINIMUM_LENGTH) {
            throw new InvalidSecretKeyException(
                'Secret key must be at least ' . self::SECRET_KEY_MINIMUM_LENGTH . ' characters'
            );
        }
        if (! in_array($hashAlgorithm, hash_algos())) {
            throw new InvalidHashAlgorithmException("Invalid Hash Algorithm");
        }

        $this->secretKey = $secretKey;
        $this->hashAlgorithm = $hashAlgorithm;
    }

    /**
     * @return string
     */
    public function getHashAlgorithm()
    {
        return $this->hashAlgorithm;
    }

}