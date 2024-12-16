<?php
// app/Livewire/DisplayJam.php
namespace App\Livewire;

use Livewire\Component;

class DisplayJam extends Component
{
    public $time;

    public function mount()
    {
        $this->time = now()->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.display-jam');
    }
}
