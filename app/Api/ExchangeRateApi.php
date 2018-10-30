<?php

namespace App\Api;

use GuzzleHttp\Client;
use Exception;

class ExchangeRateApi
{
    protected $baseUrl;

    public function __construct(Client $client)
    {
        $this->client  = $client;
        $this->baseUrl = config('url.exchange_rate_api');
    }

    /**
     * Get rates for given base currency
     *
     * @todo better exception handling
     *
     * @param string $baseCurrency
     *
     * @return array
     */
    public function getRates(string $baseCurrency) : array
    {
        try {
            $response = $this->client->get($this->baseUrl . '/latest?base=' . $baseCurrency);
        } catch (Exception $e) {
            throw new Exception('Error fetching exchange rates');
        }

        return json_decode($response->getBody()->getContents(), true)['rates'];
    }
}
