<?php

namespace BeaucalUtilTest;

use BeaucalUtil\ArrayLookup;

class ArrayLookupTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider dataArrayLookup
     */
    public function testArrayLookup($arr, $expected, $keys, $default = null) {
        $inputLookup = new ArrayLookup($arr);
        if (is_null($default)) {
            $this->assertEquals(
            $expected, $inputLookup->get($keys)
            );
        }
        $this->assertEquals(
        $expected, $inputLookup->get($keys, $default)
        );
    }

    public static function dataArrayLookup() {
        $arr = [
            'a1', 'a2',
            'a3' => [
                'b1',
                'b2' => [
                    'c1'
                ]
            ],
            ['b3'], [['c2']],
        ];
        return [
            [$arr, 'a1', 0],
            [$arr, 'a2', 1],
            [$arr, 'b3', [2, 0]],
            [$arr, 'c2', [3, 0, 0]],
            [$arr, ['b1', 'b2' => ['c1']], 'a3'],
            [$arr, null, ['a3', 'b1']],
            [$arr, ['c1'], ['a3', 'b2']],
            [$arr, 'c1', ['a3', 'b2', 0]],
            [$arr, null, 4],
            [$arr, null, $arr],
            [$arr, 'default', 'invalid', 'default'],
            [$arr, null, [0, 0, 0]],
            [$arr, 'default', [2, 'invalid'], 'default'],
        ];
    }

}
