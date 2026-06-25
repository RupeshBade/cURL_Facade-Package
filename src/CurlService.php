<?php

namespace GeniusSystem\CurlFacade;

use Illuminate\Support\Facades\Http;

class CurlService
{
    private string $baseUrl = 'https://6a2912e8f59cb8f65f1c674f.mockapi.io/api/v1';

    public function get(string $endpoint)
    {
        return Http::get($this->baseUrl . $endpoint)->json();
    }

    public function post(string $endpoint, array $data)
    {
        return Http::post($this->baseUrl . $endpoint, $data)->json();
    }

    public function patch(string $endpoint, array $data)
    {
        return Http::patch($this->baseUrl . $endpoint, $data)->json();
    }

    public function delete(string $endpoint)
    {
        return Http::delete($this->baseUrl . $endpoint)->json();
    }
}
