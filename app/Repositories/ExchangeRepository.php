<?php

namespace App\Repositories;

use App\Models\Exchange;

class ExchangeRepository
{

    protected $exchange;

    /**
     * @param Exchange $exchange
     */
    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * Insert all exchange rates
     *
     * @param array $exchangeRates
     *
     * @return null
     */
    public function insertAll(array $exchangeRates)
    {
        $this->exchange->truncate();

        $this->exchange->insert($exchangeRates);
    }
}
