<?php
function url($url = '', $params = array())
{
    $query = http_build_query($params);
    if (strlen($query) > 0) {
        $query = '?' . $query;
    }
    $url = '/' . $url . $query;
    return $url;
}
