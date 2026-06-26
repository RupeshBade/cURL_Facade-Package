<?php

namespace GeniusSystem\CurlFacade;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;  

class CurlService
{
    /**
     * Perform an HTTP request based on a defined connection name.
     */
    private function getBaseUrl(string $connection): string
    {
        $baseUrl = Config::get("curl-facade.connections.$connection.base_url");

        if (!$baseUrl) {
            throw new \InvalidArgumentException("Connection [{$connection}] is not defined in your config file.");
        }

        return $baseUrl;
    }

    public function get(string $connection, string $endpoint)
    {
        return Http::get($this->getBaseUrl($connection) . $endpoint)->json();
    }

    public function post(string $connection, string $endpoint, array $data)
    {
        return Http::post($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function patch(string $connection, string $endpoint, array $data)
    {
        return Http::patch($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function delete(string $connection, string $endpoint)
    {
        return Http::delete($this->getBaseUrl($connection) . $endpoint)->json();
    }
}
