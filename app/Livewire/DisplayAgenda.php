<?php

namespace App\Livewire;

use App\Models\Agenda;
use Livewire\Component;

class DisplayAgenda extends Component
{
    public $agendas;

    public function mount()
    {
        $this->loadAgendas();
    }

    // Method untuk memuat data agenda
    private function loadAgendas()
    {
        $this->agendas = Agenda::where('tanggal', '>=', now()->startOfDay())
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->take(5)
            ->get();
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-agenda')]
    public function refresh()
    {
        $this->loadAgendas();
    }

    public function render()
    {
        return view('livewire.display-agenda');
    }
}
