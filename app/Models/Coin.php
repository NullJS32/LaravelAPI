<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Coin extends Model
{
    protected $fillable = [
        'id',
        'rank',
        'name',
        'symbol',
        'slug',
        'is_active',
        'first_historical_data',
        'last_historical_data',
        'platform_id',
    ];

    public function getCoins()
    {
        $existingCoinsCount = Coin::count();

        $apiUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';
        $apiKey = '01e30a04-633a-4df8-8b98-642e145d39cc';

        $response = Http::get($apiUrl, [
            'limit' => 100,
            'start' => $existingCoinsCount + 1,
            'CMC_PRO_API_KEY' => $apiKey,
        ]);

        $coinsData = $response->json();

        if (isset($coinsData['data']) && is_array($coinsData['data'])) {
            foreach ($coinsData['data'] as $coin) {
                if (!Coin::where('name', $coin['name'])->exists()) {
                    $firstHistoricalData = date('Y-m-d H:i:s', strtotime($coin['first_historical_data']));
                    $lastHistoricalData = date('Y-m-d H:i:s', strtotime($coin['last_historical_data']));

                    // Проверьте, существует ли платформа в базе данных
                    $platform = null;
                    if ($coin['platform'] && $coin['platform']['id']) {
                        $platform = Platform::find($coin['platform']['id']);

                        if (!$platform) {
                            $platform = new Platform([
                                'id' => $coin['platform']['id'],
                                'name' => $coin['platform']['name'],
                                'symbol' => $coin['platform']['symbol'],
                                'slug' => $coin['platform']['slug'],
                                'token_address' => $coin['platform']['token_address'],
                            ]);
                            $platform->save();
                        }
                    }

                    Coin::create([
                        'id' => $coin['id'],
                        'rank' => $coin['rank'],
                        'name' => $coin['name'],
                        'symbol' => $coin['symbol'],
                        'slug' => $coin['slug'],
                        'is_active' => $coin['is_active'],
                        'first_historical_data' => $firstHistoricalData,
                        'last_historical_data' => $lastHistoricalData,
                        'platform_id' => $platform->id ?? null,
                    ]);
                }
            }
        }
    }
}

