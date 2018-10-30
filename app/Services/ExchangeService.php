<?php

namespace App\Services;

use App\Api\ExchangeRateApi;
use App\Repositories\CurrencyRepository;
use App\Repositories\ExchangeRepository;
use Exception;

class ExchangeService
{

    protected $exchangeRateApi;
    protected $currencyRepository;
    protected $exchangeRepository;

    public function __construct(
        ExchangeRateApi $exchangeRateApi,
        CurrencyRepository $currencyRepository,
        ExchangeRepository $exchangeRepository
    ) {
        $this->exchangeRateApi    = $exchangeRateApi;
        $this->currencyRepository = $currencyRepository;
        $this->exchangeRepository = $exchangeRepository;
    }

    /**
     * Get exchange rates
     *
     * @return array
     */
    public function getExchangeRates() : array
    {
        $exchangeRates = [];

        $currencies = $this->currencyRepository->getAll();

        if (empty($currencies)) {
            throw new Exception('No currencies in database');

        }

        foreach ($currencies as $baseCurrency) {
            $allExchangeRates = $this->exchangeRateApi->getRates($baseCurrency);

            foreach ($currencies as $currency) {
                if ($baseCurrency !== $currency) {
                    $exchangeRates[] = [
                        'from_currency' => $baseCurrency,
                        'to_currency' => $currency,
                        'rate' => round($allExchangeRates[$currency], 2)
                    ];
                }
            }
        }

        $this->exchangeRepository->insertAll($exchangeRates);

        return $exchangeRates;
    }
}
