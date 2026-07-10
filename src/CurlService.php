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

    
    private function clientForConnection(string $connection)
    {
        $client = Http::withHeaders([
            'Accept' => 'application/json',
        ]);

        // Dynamically pull keys for the current active connection
        $appKey    = Config::get("curl-facade.connections.$connection.app_key");
        $keySecret = Config::get("curl-facade.connections.$connection.key_secret");

        // If this specific connection has credentials, attach them!
        if ($appKey && $keySecret) {
            $client = $client->withHeaders([
                'X-App-Key'    => $appKey,
                'X-Key-Secret' => $keySecret,
            ]);
        }

        return $client;
    }

    public function get(string $connection, string $endpoint)
    {
        return $this->clientForConnection($connection)->get($this->getBaseUrl($connection) . $endpoint)->json();
    }

    public function post(string $connection, string $endpoint, array $data)
    {
        return $this->clientForConnection($connection)->post($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function patch(string $connection, string $endpoint, array $data)
    {
        return $this->clientForConnection($connection)->patch($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function delete(string $connection, string $endpoint)
    {
        return $this->clientForConnection($connection)->delete($this->getBaseUrl($connection) . $endpoint)->json();
    }
}
