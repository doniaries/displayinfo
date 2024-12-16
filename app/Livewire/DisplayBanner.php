<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;

class DisplayBanner extends Component
{
    public $banners;

    public function mount()
    {
        $this->loadBanners();
    }

    // Method untuk memuat data banner
    private function loadBanners()
    {
        $this->banners = Banner::latest()->get();
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-banner')]
    public function refresh()
    {
        $this->loadBanners();
    }

    public function render()
    {
        return view('livewire.display-banner', [
            'banners' => $this->banners
        ]);
    }
}
