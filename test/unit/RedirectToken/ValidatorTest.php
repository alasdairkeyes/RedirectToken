<?php

namespace Test\RedirectToken;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use RedirectToken\Validator;

class ValidatorTest extends TestCase
{
    /**
     * @var Validator Validator object
     */
    private $Validator;

    public function setUp() {
        $this->Validator = new Validator(TestEnum::VALID_SECRET_KEY);
    }

    /*
     * Test Instantiation
     */

    public function testInstantiationValid() {
        $Validator = new Validator(TestEnum::VALID_SECRET_KEY);

        $this->assertInstanceOf(Validator::class, $Validator);
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidSecretKeyException
     */
    public function testInstantiationInvalidKeyTooShort() {
        new Validator(TestEnum::SHORT_SECRET_KEY);
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidSecretKeyException
     */
    public function testInstantiationInvalidKeyNoKey() {
        new Validator();
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidHashAlgorithmException
     */
    public function testInstantiationInvalidHashAlgorithm() {
        new Validator(TestEnum::VALID_SECRET_KEY, 'asdasd');
    }

    /**
     * Test functions
     */

    public function testGetHashAlgorithm() {
        $validator = new Validator(TestEnum::VALID_SECRET_KEY, 'md5');
        $this->assertEquals('md5', $validator->getHashAlgorithm());
    }

    public function testGetHashAlgorithmDefault() {
        $generator = new Validator(TestEnum::VALID_SECRET_KEY);
        $this->assertEquals('sha256', $generator->getHashAlgorithm());
    }

    public function testValidateUriTokenValid() {
        $uriStub = $this->createMock(UriInterface::class);
        $uriStub->method('__toString')->willReturn(TestEnum::MATCHING_URL);

        $this->assertTrue(
            $this->Validator->validateUriToken($uriStub, TestEnum::MATCHING_URL_TOKEN)
        );
    }

    public function testValidateUriTokenInvalid() {
        $uriStub = $this->createMock(UriInterface::class);
        $uriStub->method('__toString')->willReturn(TestEnum::MATCHING_URL);

        $this->assertFalse(
            $this->Validator->validateUriToken($uriStub, TestEnum::UNMATCHING_URL_TOKEN)
        );
    }

}