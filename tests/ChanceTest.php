<?php

use PHPUnit\Framework\TestCase;
use lib\Chance;

class ChanceTest extends TestCase
{
    protected $chance;

    protected function setUp(): void
    {
        $this->chance = new Chance(0);
    }

    public function testInteger()
    {
        $v = $this->chance->integer(['min' => 1, 'max' => 100]);
        $this->assertSame($v, 45);

        $v = $this->chance->integer();
        $this->assertSame($v, 1712680880219530869);
    }

    public function testLetter()
    {
        $v = $this->chance->letter();
        $this->assertSame($v, 'p');

        $v = $this->chance->letter(['casing' => 'upper']);
        $this->assertSame($v, 'B');
    }

    public function testColor()
    {
        $v = $this->chance->color();
        $this->assertSame($v, '#ac2f75');

        $v = $this->chance->color(['format' => 'rgb']);
        $this->assertSame($v, 'rgb(192,67,251)');
    }

    public function testWord()
    {
        $v = $this->chance->word();
        $this->assertSame($v, 'gusafu');

        $v = $this->chance->word(['length' => 10]);
        $this->assertSame($v, 'koxocewuye');
    }

    public function testPrime()
    {
        $v = $this->chance->prime();
        $this->assertSame($v, 379);

        $v = $this->chance->prime(['max' => 10]);
        $this->assertSame($v, 7);
        $v = $this->chance->prime(['max' => 10]);
        $this->assertSame($v, 3);
    }

    public function testDomain()
    {
        $v = $this->chance->domain();
        $this->assertSame($v, 'zobozi.net');

        $v = $this->chance->domain(['tld' => 'com']);
        $this->assertSame($v, 'fifeje.com');
    }

    public function testEmail()
    {
        $v = $this->chance->email();
        $this->assertSame($v, 'fifeje@zobozi.net');

        $v = $this->chance->email(['domain' => 'mailinator.com']);
        $this->assertSame($v, 'zowelu@mailinator.com');

        $v = $this->chance->email(['length' => 6, 'domain' => 'mailinator.com']);
        $this->assertSame($v, 'sezetu@mailinator.com');
    }

    public function testIp()
    {
        $v = $this->chance->ip();
        $this->assertSame($v, '172.47.117.192');
    }
}
