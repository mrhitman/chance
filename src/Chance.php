<?php

namespace lib;

/**
 * Class Chance
 * @package lib
 */
class Chance {
    protected $seed;

    public function __construct($seed = null) {
        $this->seed = $seed ?? mktime();
        srand($this->seed);
    }

    /**
     * @return integer
     */
    public function integer($args = []) {
        $max = $args['max'] ?? PHP_INT_MAX;
        $min = $args['min'] ?? PHP_INT_MIN;
        return rand($min, $max);
    }

    public function floating($args = []) {
        $fixed = $args['fixed'] ?? 4;
        return $this->integer($args) + round(1/ rand(1, 100), $fixed);
    }

    /**
     * @return boolean
     */
    public function bool($args = []) {
        return $this->boolean($args);
    }

    /**
     * @return boolean
     */
    public function boolean($args = []) {
        $likelihood = $args['likelihood'] ?? 50;
        return (bool)rand(1, 100) <= $likelihood;
    }

    public function falsy($args = []) {
        $poll = $arg['poll'] ?? [null, false, '', 0, []];
        return $poll[array_rand($poll)];
    }

    public function letter($args = []) {
        $casing = $args['casing'];

        if (!$casing) {
            $casing = $this->boolean() ? 'lower' : 'upper';
        } 

        $alphabet = $args['alphabet'] ?? str_split('abcdefghijklmnopqrstuvwxyz');
        $letter = $alphabet[array_rand($alphabet)];

        switch ($casing) {
            case 'lower': return strtolower($letter);
            case 'upper': return strtoupper($letter);
        }
    }

    public function age($args = []) {
        switch ($args['type']) {
            case 'child': return rand(1, 10);
            case 'teen': return rand(11, 20);
            case 'adult': return rand(21, 50);
            case 'senior': return rand(61, 120);
            default: return rand(1, 120);
        }
    }

    public function gender($args = []) {
        $extraGenders = $args['extraGenders'] ?? [];
        $genders = array_merge(['Male', 'Female'], $extraGenders);
        return $genders[array_rand($genders)];
    }

    public function coin() {
        return $this->boolean() ? 'heads' : 'tails';
    }

    public function color($args = []) {
        $bits = [rand(0, 255), rand(0,255), rand(0,255)];
        return array_reduce($bits, function ($acc, $bit) {
           return $acc . dechex($bit);
        }, "#");
    }
} 