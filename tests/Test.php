<?php

namespace BeaucalUtilTest;

use BeaucalUtil;

class Test extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider dataAddQueryString
     */
    public function testAddQueryString($url, $query, $expected) {
        $result = BeaucalUtil\addQueryString($url, $query);
        $this->assertEquals($expected, $result);
    }

    public static function dataAddQueryString() {
        $tricky = urlencode('`~!@#$%^&*()_+-=[]\\{}|;\':",./<>?');
        return [
            ['url', '', 'url'],
            ['url?', '', 'url'],
            ['url?param=1', '', 'url?param=1'],
            ['url?param=1&param=2', '', 'url?param=1&param=2'],
            ['url', 'param=1', 'url?param=1'],
            ['url?', 'param=1', 'url?param=1'],
            ['url?param=1', 'param=2', 'url?param=1&param=2'],
            ['url?param=1&param=2', 'param=3', 'url?param=1&param=2&param=3'],
            ['url', "param={$tricky}", "url?param={$tricky}"],
            ['url', "?leading=true", "url?leading=true"],
        ];
    }

}
