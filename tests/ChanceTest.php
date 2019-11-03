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
}
