<?php

namespace lib;

/**
 * Class Chance
 * @package lib
 */
class Chance
{
    protected $seed;

    public function __construct($seed = null)
    {
        $this->seed = $seed ?? mktime();
        srand($this->seed);
    }

    /**
     * @return integer
     */
    public function natural($args = [])
    {
        $max = $args['max'] ?? PHP_INT_MAX;
        $min = $args['min'] ?? 0;
        return rand($min, $max);
    }

    /**
     * @return integer
     */
    public function integer($args = [])
    {
        $max = $args['max'] ?? PHP_INT_MAX;
        $min = $args['min'] ?? PHP_INT_MIN;
        return rand($min, $max);
    }

    public function floating($args = [])
    {
        $fixed = $args['fixed'] ?? 4;
        return $this->integer($args) + round(1 / rand(1, 100), $fixed);
    }

    public function string($args = [])
    {
        $len = $args['length'] ?? rand(5, 20);
        $numeric = $args['numeric'] ?? true;
        $symbols = $args['symbols'] ?? true;
        $defaultPool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $defaultPool = $numeric ? $defaultPool . '0123456789' : $defaultPool;
        $defaultPool = $symbols ? $defaultPool . '!@#$%^&*()[]' : $defaultPool;
        $pool = str_split($args['pool'] ?? $defaultPool);

        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $string .= $pool[array_rand($pool)];
        }

        switch ($args['casing']) {
            case 'lower':
                return strtolower($string);
            case 'upper':
                return strtoupper($string);
            default:
                return $string;
        }
    }

    /**
     * @return boolean
     */
    public function bool($args = [])
    {
        return $this->boolean($args);
    }

    /**
     * @return boolean
     */
    public function boolean($args = [])
    {
        $likelihood = $args['likelihood'] ?? 50;
        return (bool) rand(1, 100) <= $likelihood;
    }

    public function falsy($args = [])
    {
        $pool = $args['pool'] ?? [null, false, '', 0, []];
        return $pool[array_rand($pool)];
    }

    public function letter($args = [])
    {
        $casing = $args['casing'];

        if (!$casing) {
            $casing = $this->boolean() ? 'lower' : 'upper';
        }

        $alphabet = $args['alphabet'] ?? str_split('abcdefghijklmnopqrstuvwxyz');
        $letter = $alphabet[array_rand($alphabet)];

        switch ($casing) {
            case 'lower':
                return strtolower($letter);
            case 'upper':
                return strtoupper($letter);
        }
    }

    public function prime($args = [])
    {
        $min = min([$args['min'] ?? 2, 2]);
        $max = min($args['max'] ?? 10000, 10000);
        $sieve = [];
        $primes = [];
        for ($i = $min; $i <= $max; ++$i) {
            if (!$sieve[$i]) {
                $primes[] = $i;
                for ($j = $i << 1; $j <= $max; $j += $i) {
                    $sieve[$j] = true;
                }
            }
        }
        return $primes[array_rand($primes)];
    }

    public function age($args = [])
    {
        switch ($args['type']) {
            case 'child':
                return rand(1, 10);
            case 'teen':
                return rand(11, 20);
            case 'adult':
                return rand(21, 50);
            case 'senior':
                return rand(61, 120);
            default:
                return rand(1, 120);
        }
    }

    public function gender($args = [])
    {
        $extraGenders = $args['extraGenders'] ?? [];
        $genders = array_merge(['Male', 'Female'], $extraGenders);
        return $genders[array_rand($genders)];
    }

    public function coin()
    {
        return $this->boolean() ? 'heads' : 'tails';
    }

    public function color($args = [])
    {
        $bits = [rand(0, 255), rand(0, 255), rand(0, 255)];
        $format = $args['format'] ?? 'hex';

        switch ($format) {
            case 'hex':
                return array_reduce($bits, function ($acc, $bit) {
                    return $acc . dechex($bit);
                }, "#");
            case 'rgb':
                return 'rgb(' . implode(',', $bits) . ')';
        }
    }

    public function word($args = [])
    {
        $len = $args['length'] ?? 7;
        $string = '';
        $vowels = ["a", "e", "i", "o", "u"];
        $consonants = [
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        ];
        $max = $len / 2;
        for ($i = 1; $i <= $max; $i++) {
            $string .= $consonants[rand(0, 19)];
            $string .= $vowels[rand(0, 4)];
        }
        return $string;
    }
}
