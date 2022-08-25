<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\CategoryGroup;

class MainNavBar extends Component
{
    public $activeTabID;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($activeTabID)
    {
        //
        $this->activeTabID = $activeTabID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $tabs = CategoryGroup::all();
        return view('components.main-nav-bar', ['activeTab' => $this->activeTabID, 'tabs' => $tabs]);
    }
}
