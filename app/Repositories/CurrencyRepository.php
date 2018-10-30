<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{

    protected $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get the list of currencies
     *
     * @return array
     */
    public function getAll() : array
    {
        return $this->currency->pluck('name')->all();
    }
}
