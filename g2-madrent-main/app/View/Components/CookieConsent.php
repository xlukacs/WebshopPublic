<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;

class CookieConsent extends Component
{
    public $showContainer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showPopup)
    {        
        $this->showContainer = $showPopup;         
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cookie-consent');
    }
}
