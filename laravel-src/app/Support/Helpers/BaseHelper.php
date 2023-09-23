<?php
use Jaybizzle\CrawlerDetect\CrawlerDetect;

function is_crawler() {
    $crawler_detect = new CrawlerDetect;
    return $crawler_detect->isCrawler();
}

function api_request($edge, $params = [], $method = 'GET', $abort = true) {
    $default_options = [
        'method' => 'GET',
        'url' => config('path.back_url'),
        'edge' => '/',
        'headers' => [],
        'params' => [],
    ];

    $options = array_merge($default_options, compact('edge', 'params', 'method'));
    extract($options);

    //prepare curl
    $curl = curl_init();

    //build url
    $url .= $edge;

    //set request type
    if ( $method == 'GET' ) {
        $url .= (preg_match('/\?/', $url) ? '&' : '?').http_build_query($params);
    }
    else if ( $method == 'POST' ) {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
    }
    else if ( $method == 'PUT' ) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
    }
    else if ( $method == 'DELETE' ) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        $url .= (preg_match('/\?/', $url) ? '&' : '?').http_build_query($params);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);

    //set headers
    if ( count($headers) ) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    //exec curl
    $response = curl_exec($curl);
    curl_close($curl);

    //decode response
    $response = json_decode($response);

    if ( !$response || !$response->success ) {
        if ( $abort ) {
            abort(404, implode(', ', $response->errors));
        }

        return null;
    }

    return $response->data;
}
