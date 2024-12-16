<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Informasi;

class DisplayInformasi extends Component
{
    public $informasiList = [];

    public function mount()
    {
        $this->loadInformasi();
    }

    // Method untuk memuat data informasi
    private function loadInformasi()
    {
        $this->informasiList = Informasi::where('aktif', true)
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'judul' => $item->judul,
                    'isi' => $item->isi
                ];
            })
            ->toArray();
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-informasi')]
    public function refresh()
    {
        $this->loadInformasi();
    }

    public function render()
    {
        return view('livewire.display-informasi');
    }
}
