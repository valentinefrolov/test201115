<?php

function parseUrl(string $url) : string {
    $parts = explode('?', $url);
    if(count($parts) > 2) {
        throw new RuntimeException("wrong url");
    }
    $base = $parts[0];
    $params = [];
    if(!empty($parts[1])) {
        foreach(explode('&', $parts[1]) as $item) {
            $pair = explode('=', $item);
            if(!isset($pair[1])) {
                $pair[1] = null;
            }
            if($pair[1] != '3') {
                $params[$pair[0]] = $pair[1];
            }
        }
    }
    asort($params);
    preg_match('/^((http(s?):\/\/)?)([^\/]+\/)(.+)$/', $base, $matches);
    if(count($matches) && !empty($matches[4])) {
        $base = $matches[1].$matches[4];
        $url ='/'.$matches[5];
        $params['url'] = $url;
    }
    return $base . (count($params) ? '?' . http_build_query($params, '', '&') : '');
}


echo parseUrl('https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3');


