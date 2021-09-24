<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dashboard-card-component extends Component
{
    public $column;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column)
    {
        $this->column=$column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-card-component');
    }
}
