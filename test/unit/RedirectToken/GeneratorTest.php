<?php

namespace Test\RedirectToken;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use RedirectToken\Generator;

class GeneratorTest extends TestCase
{
    /**
     * @var Generator Generator object
     */
    private $generator;

    public function setUp() {
        $this->generator = new Generator(TestEnum::VALID_SECRET_KEY);
    }

    /**
     * Test Instantiation
     */

    public function testInstantiationValid() {
        $generator = new Generator(TestEnum::VALID_SECRET_KEY);

        $this->assertInstanceOf(Generator::class, $generator);
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidSecretKeyException
     */
    public function testInstantiationInvalidKeyTooShort() {
        new Generator(TestEnum::SHORT_SECRET_KEY);
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidSecretKeyException
     */
    public function testInstantiationInvalidKeyNoKey() {
        new Generator();
    }

    /**
     * @expectedException RedirectToken\Exception\InvalidHashAlgorithmException
     */
    public function testInstantiationInvalidHashAlgorithm() {
        new Generator(TestEnum::VALID_SECRET_KEY, 'asdasd');
    }

    /**
     * Test functions
     */

    public function testGetHashAlgorithm() {
        $generator = new Generator(TestEnum::VALID_SECRET_KEY, 'md5');
        $this->assertEquals('md5', $generator->getHashAlgorithm());
    }

    public function testGetHashAlgorithmDefault() {
        $generator = new Generator(TestEnum::VALID_SECRET_KEY);
        $this->assertEquals('sha256', $generator->getHashAlgorithm());
    }

    public function testGenerateFunctionValid() {
        $uriStub = $this->createMock(UriInterface::class);
        $uriStub->method('__toString')->willReturn(TestEnum::MATCHING_URL);

        $this->assertEquals(
            TestEnum::MATCHING_URL_TOKEN,
            $this->generator->generateToken($uriStub)
        );
    }
}
