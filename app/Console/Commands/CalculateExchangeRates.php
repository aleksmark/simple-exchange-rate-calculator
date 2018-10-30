<?php

namespace App\Console\Commands;

use App\Services\ExchangeService;
use Illuminate\Console\Command;

class CalculateExchangeRates extends Command
{
    protected $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        parent::__construct();

        $this->exchangeService = $exchangeService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:get-exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get exchange rates';

    /**
     * Execute the console command.
     *
     * @return null
     */
    public function handle()
    {
        $this->info("\nFetching exchange rates...\n");

        $this->table(['from', 'to', 'rate'], $this->exchangeService->getExchangeRates());

        $this->info("\nSuccess. Exchange rates saved into database.\n");
    }
}
