<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocationService
{
    protected $baseUrl = 'https://api.myquran.com/v2/sholat/kota/semua';

    public function getLocations()
    {
        return Cache::remember('prayer_locations', 86400, function () {
            try {
                $response = Http::get($this->baseUrl);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['data'])) {
                        return collect($data['data'])
                            ->mapWithKeys(function ($item) {
                                return [$item['id'] => $item['lokasi']];
                            })
                            ->toArray();
                    }
                }

                return [
                    '1219' => 'Sijunjung', // Default option
                ];
            } catch (\Exception $e) {
                return [
                    '1219' => 'Sijunjung', // Default option
                ];
            }
        });
    }
}