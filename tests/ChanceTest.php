<?php

use PHPUnit\Framework\TestCase;
use lib\Chance;

class ChanceTest extends TestCase
{
    public function testInteger()
    {
        $chance = new lib\Chance(0);

        $v = $chance->integer(['min'=> 1, 'max' => 100]);
        $this->assertSame($v, 45);

        $v = $chance->integer();
        $this->assertSame($v, 1712680880219530869);
    }
    
    public function testLetter()
    {
        $chance = new lib\Chance(0);

        $v = $chance->letter();
        $this->assertSame($v, 'p');

        $v = $chance->letter(['casing' => 'upper']);
        $this->assertSame($v, 'B');
    }
}