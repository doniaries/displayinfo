<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Setting;

class DisplayLayout extends Component
{
    public $setting;

    public function __construct()
    {
        $this->setting = Setting::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.display-layout');
    }
}