<?php

namespace BeaucalUtil;

/**
 * Concatenates $url and $query with proper concatenation symbol (i.e. '?' or '&')
 *
 * @param string $url
 * @param string $query without leading concatenation symbol
 */
function addQueryString($url, $query) {
    $url = rtrim($url, '?&');
    $query = ltrim($query, '?&');
    $querySeparate = (parse_url($url, PHP_URL_QUERY) == null) ? '?' : '&';
    return rtrim("{$url}{$querySeparate}{$query}", '?&');
}
