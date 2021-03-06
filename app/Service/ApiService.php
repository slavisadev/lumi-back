<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ApiService
{
    private $apiUrl = 'http://www.omdbapi.com/';

    public function get($params)
    {
        $response = Http::get($this->apiUrl, $params);

        return $response->body();
    }
}
