<?php
// app/Services/JadwalSholatService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class JadwalSholatService
{
    protected $baseUrl = 'https://api.myquran.com/v2/';


    public function getAllKota()
    {
        $cacheKey = 'all_kota_sholat';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = Http::get($this->baseUrl . 'sholat/kota/semua');

        if ($response->successful()) {
            $data = collect($response->json()['data'])
                ->map(function ($item) {
                    // Pastikan akses key yang benar sesuai response API
                    return [
                        'id' => $item['id'],
                        'nama' => $item['lokasi'] // Hanya gunakan lokasi saja untuk dropdown
                    ];
                })
                ->pluck('nama', 'id')
                ->toArray();

            Cache::put($cacheKey, $data, now()->addMonth());
            return $data;
        }

        return [];
    }


    public function getKota($keyword)
    {
        $response = Http::get($this->baseUrl . 'sholat/kota/cari/' . $keyword);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    public function getJadwalSholat($idKota)
    {
        // Cache key berdasarkan kota dan tanggal
        $cacheKey = 'jadwal_sholat_' . $idKota . '_' . date('Y-m-d');

        // Cek apakah data ada di cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $today = Carbon::now();
        $response = Http::get($this->baseUrl . 'sholat/jadwal/' . $idKota . '/' . $today->year . '/' . $today->month . '/' . $today->day);

        if ($response->successful()) {
            $data = $response->json()['data'];
            // Cache data selama 12 jam
            Cache::put($cacheKey, $data, now()->addHours(12));
            return $data;
        }

        return null;
    }
}