<?php

namespace App\Http\Service;

use GuzzleHttp\Client;

class VkApiClient
{
//    protected string $method;
//    protected string $methodName;
//    protected string $queueParams;

    public function __construct()
    {
        $this->apiClient = new Client([
            'base_uri' => 'https://api.vk.com/',
            'timeout' => 3.0,
        ]);
    }
}
