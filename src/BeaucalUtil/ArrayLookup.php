<?php

namespace BeaucalUtil;

/**
 * Query a nested array, nice & safe.
 * 
 * $lookup = new ArrayLookup(['first' => ['second' => 'value']]);
 * $lookup->get(['first', 'second']); // returns "value"
 * $lookup->get(['first', 'junk', 'junk'], 'not found'); // returns "not found"
 * $lookup->get('junk'); // returns null
 */
class ArrayLookup {

    /**
     * @var array
     */
    protected $arr;

    public function __construct(array $arr) {
        $this->arr = $arr;
    }

    /**
     * @param string|array $keys  single key or multi-dimensional keys in sequence
     * @param mixed $default
     * @return mixed specified array item otherwise default
     */
    public function get($keys, $default = null) {
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        $array = $this->arr;
        $result = array_reduce($keys,
        function($carry, $key) use ($array) {
            return (is_array($carry) && isset($carry[$key])) ? $carry[$key] : null;
        }, $array);
        return ($result !== null) ? $result : $default;
    }

}
