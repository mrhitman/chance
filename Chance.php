<?php

class Chance {
    public constructor($seed=0) {
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
        $casing = $args['casing'] ?? false;
    }
} 

$c = new Chance();

print_r($c->floating(['max' => 100, 'min' => 0]));