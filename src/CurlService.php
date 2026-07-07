<?php

namespace GeniusSystem\CurlFacade;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class CurlService
{
    /**
     * Modern PHP 8+ Constructor: Combines property declaration and parameters.
     * This keeps it 100% optional, safe for your other sites, and removes all editor warnings.
     */
    public function __construct(
        protected ?string $appKey = null,
        protected ?string $keySecret = null
    ) {}

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

    /**
     * Smart client helper: Only adds headers if keys actually exist.
     */
    private function authenticatedClient()
    {
        $client = Http::withHeaders([
            'Accept' => 'application/json',
        ]);

        if ($this->appKey && $this->keySecret) {
            $client = $client->withHeaders([
                'X-App-Key'    => $this->appKey,
                'X-Key-Secret' => $this->keySecret,
            ]);
        }

        return $client;
    }

    public function get(string $connection, string $endpoint)
    {
        return $this->authenticatedClient()->get($this->getBaseUrl($connection) . $endpoint)->json();
    }

    public function post(string $connection, string $endpoint, array $data)
    {
        return $this->authenticatedClient()->post($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function patch(string $connection, string $endpoint, array $data)
    {
        return $this->authenticatedClient()->patch($this->getBaseUrl($connection) . $endpoint, $data)->json();
    }

    public function delete(string $connection, string $endpoint)
    {
        return $this->authenticatedClient()->delete($this->getBaseUrl($connection) . $endpoint)->json();
    }
}
