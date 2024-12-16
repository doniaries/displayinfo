<?php

namespace App\Livewire;

use App\Models\RunningText;
use App\Models\Setting;
use Livewire\Component;

class DisplayRunningText extends Component
{
    public $texts;
    public $speed;
    public $logo;

    public function mount()
    {
        $this->loadData();
    }

    // Method untuk memuat data running text
    private function loadData()
    {
        $this->texts = RunningText::latest()->get();
        $setting = Setting::first();
        $this->speed = $setting->kecepatan_teks ?? 10;
        $this->logo = $setting->logo ?? null;
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-running-text')]
    public function refresh()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.display-running-text');
    }
}
