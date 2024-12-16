<?php

namespace App\Livewire;

use App\Models\Setting;
use Carbon\Carbon;
use Livewire\Component;
use App\Services\JadwalSholatService;
use Illuminate\Support\Facades\Cache;

class DisplayJadwalSholat extends Component
{
    public $jadwal;
    public $lokasi;
    public $tanggal;
    private $jadwalService;

    public function boot(JadwalSholatService $jadwalService)
    {
        $this->jadwalService = $jadwalService;
    }

    public function mount()
    {
        $this->updateJadwal();
    }

    private function updateJadwal()
    {
        $pengaturan = Setting::first();
        if ($pengaturan && $pengaturan->lokasi) {
            $idKota = $pengaturan->lokasi;
            $this->jadwal = $this->jadwalService->getJadwalSholat($idKota);

            // Untuk menampilkan nama kota, ambil dari cache
            $kotaList = Cache::get('all_kota_sholat', []);
            $this->lokasi = $kotaList[$idKota] ?? '';

            $this->tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        }
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-jadwal')]
    public function refresh()
    {
        $this->updateJadwal();
    }

    public function render()
    {
        return view('livewire.display-jadwal-sholat');
    }
}
