<?php
// app/Livewire/DisplayQuotes.php

namespace App\Livewire;

use App\Models\Quotes;
use Livewire\Component;

class DisplayQuotes extends Component
{
    // Tambahkan refresh interval 5 detik
    #[Polling('5s')]
    public $quotes;

    protected $listeners = ['refresh-quotes' => 'loadQuotes'];

    public function mount()
    {
        $this->loadQuotes();
    }

    public function loadQuotes()
    {
        $this->quotes = Quotes::where('aktif', true)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.display-quotes');
    }
}
