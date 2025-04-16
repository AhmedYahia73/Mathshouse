<?php

namespace App\Console\Commands;

use App\Models\Currancy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exchange rates from an external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
         $apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD'; // Example API
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            $rates = $data['rates'];
                
            foreach ($rates as $code => $rate) {
                $amount = $rate * 100;
                $data = Currancy::where('currency',$code)->updateOrCreate(
                    ['exchange_rate' => $rates,'currency'=>$code,'amount'=>$rate] // Update exchange rate
                );
                Log::info("Exchange $data updated successfully.".$code.$rate );
            }

            $this->info('Exchange rates updated successfully.');
        } else {
            $this->error('Failed to fetch exchange rates.');
        }

        return 0;
    }
}
