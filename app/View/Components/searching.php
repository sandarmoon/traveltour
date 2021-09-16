<?php

namespace App\View\Components;

use Illuminate\View\Component;

class searching extends Component
{
   public $cities;
   public $left;
   public $packages
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cities,$left=0,$packages)
    {
        $this->cities=$cities;
        $this->left=$left;
        $this->packages=$packages;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.searchingnew');
    }
}
