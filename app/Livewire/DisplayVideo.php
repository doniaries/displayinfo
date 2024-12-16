<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class DisplayVideo extends Component
{
    public $videos = [];

    public function mount()
    {
        $this->loadVideos();
    }

    // Method untuk memuat data video
    private function loadVideos()
    {
        $this->videos = Video::active()
            ->newest()
            ->get()
            ->map(function ($video) {
                return [
                    'id' => $video->id,
                    'url' => Storage::url($video->file)
                ];
            })
            ->toArray();
    }

    // Method untuk refresh data ketika event diterima
    #[On('refresh-display-video')]
    public function refresh()
    {
        $this->loadVideos();
    }

    public function render()
    {
        return view('livewire.display-video');
    }
}
